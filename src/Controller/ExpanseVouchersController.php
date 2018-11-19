<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExpanseVouchers Controller
 *
 * @property \App\Model\Table\ExpanseVouchersTable $ExpanseVouchers
 *
 * @method \App\Model\Entity\ExpanseVoucher[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExpanseVouchersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin');

        $where=[];

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));
        if(!empty($date_from_to)){
            $where['ExpanseVouchers.transaction_date >=']=$from_date;
            $where['ExpanseVouchers.transaction_date <=']=$to_date;
        }

        $expanseVouchers = $this->paginate($this->ExpanseVouchers->find()->where($where));
        $this->set(compact('expanseVouchers', 'exploded_date_from_to'));
    }

    /**
     * View method
     *
     * @param string|null $id Expanse Voucher id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $this->viewBuilder()->layout('admin');
        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));

        $condition=array();
        if(!empty($from_date) && !empty($to_date))
        {
            $condition['ExpanseVouchers.transaction_date >=']=$from_date;
            $condition['ExpanseVouchers.transaction_date <=']=$to_date;
        }
        $ExpanseVoucherRows=$this->ExpanseVouchers->ExpanseVoucherRows->find();
        $ExpanseVoucherRows->matching('ExpanseVouchers',function($q)use($condition){
            return $q->where($condition);
        })
        ->group('ExpanseVoucherRows.expanse_head_id')
        ->select([
            'total_amount'=>$ExpanseVoucherRows->func()->sum('ExpanseVoucherRows.amount')
        ])
        ->contain(['ExpanseHeads'])
        ->autoFields(true);;
        //pr($ExpanseVoucherRows->toArray());   exit;
        $this->set(compact('ExpanseVoucherRows','from_date','to_date', 'exploded_date_from_to'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->layout('admin');
        $expanseVoucher = $this->ExpanseVouchers->newEntity();
        if ($this->request->is('post')) {
            $expanseVoucher = $this->ExpanseVouchers->patchEntity($expanseVoucher, $this->request->getData());
            $transaction_date=$this->request->getData('transaction_date');
            $expanseVoucher->transaction_date=date('Y-m-d',strtotime($transaction_date));

            //Voucher Number Increment
            $last_voucher_no=$this->ExpanseVouchers->find()->select(['voucher_no'])->order(['voucher_no' => 'DESC'])->first();
            if($last_voucher_no){
                $expanseVoucher->voucher_no=$last_voucher_no->voucher_no+1;
            }else{
                $expanseVoucher->voucher_no=1;
            }
            $expanse_voucher_rows=$this->request->getData('expanse_voucher_rows');
            $total_amount=0;
            foreach ($expanse_voucher_rows as $key => $value) {
                $total_amount+=$value['amount'];
            }
            $expanseVoucher->total_amount=$total_amount; 
            if ($this->ExpanseVouchers->save($expanseVoucher)) {
                $this->Flash->success(__('The expanse voucher has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expanse voucher could not be saved. Please, try again.'));
        }

        $ExpanseHeads = $this->ExpanseVouchers->ExpanseVoucherRows->ExpanseHeads->find('list');
        $this->set(compact('expanseVoucher', 'ExpanseHeads'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Expanse Voucher id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->layout('admin');
        $expanseVoucher = $this->ExpanseVouchers->get($id, [
            'contain' => ['ExpanseVoucherRows']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expanseVoucher = $this->ExpanseVouchers->patchEntity($expanseVoucher, $this->request->getData());
            //pr($expanseVoucher);exit;
            $transaction_date=$this->request->getData('transaction_date');
            $expanseVoucher->transaction_date=date('Y-m-d',strtotime($transaction_date));
             
            $expanse_voucher_rows=$this->request->getData('expanse_voucher_rows');
            $total_amount=0;
            foreach ($expanse_voucher_rows as $key => $value) {
                $total_amount+=$value['amount'];
            }
            $expanseVoucher->total_amount=$total_amount;
            if ($this->ExpanseVouchers->save($expanseVoucher)) {
                $this->Flash->success(__('The expanse voucher has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expanse voucher could not be updated. Please, try again.'));
        }
        $ExpanseHeads = $this->ExpanseVouchers->ExpanseVoucherRows->ExpanseHeads->find('list');
        $this->set(compact('expanseVoucher', 'ExpanseHeads'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Expanse Voucher id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expanseVoucher = $this->ExpanseVouchers->get($id);
        if ($this->ExpanseVouchers->delete($expanseVoucher)) {
            $this->Flash->success(__('The expanse voucher has been deleted.'));
        } else {
            $this->Flash->error(__('The expanse voucher could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
