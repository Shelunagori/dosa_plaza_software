<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bills Controller
 *
 * @property \App\Model\Table\BillsTable $Bills
 *
 * @method \App\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BillsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tables']
        ];
        $bills = $this->paginate($this->Bills);

        $this->set(compact('bills'));
    }

    /**
     * View method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
		$this->viewBuilder()->layout('');
		$bill_id=$this->request->query('bill_id');
		
        $bill = $this->Bills->get($bill_id, [
            'contain' => ['BillRows']
        ]);

        $this->set('bill', $bill);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$myJSON=$this->request->query('myJSON');
		$table_id=$this->request->query('table_id');
		$total=$this->request->query('total');
		$tax_id=$this->request->query('tax_id');
		$roundOff=$this->request->query('roundOff');
        $net=$this->request->query('net');
        $customer_id=$this->request->query('customer_id');
		$kot_ids=explode(',', $this->request->query('kot_ids'));
		$q = json_decode($myJSON, true);
		
        $bill = $this->Bills->newEntity();
		
		$last_voucher_no=$this->Bills->find()->select(['voucher_no'])->order(['id' => 'DESC'])->first();
		if($last_voucher_no){
			$bill->voucher_no=$last_voucher_no->voucher_no+1;
		}else{
			$bill->voucher_no=1;
		}
		
		$bill->table_id=$table_id;
		$bill->total=$total;
		$bill->tax_id=$tax_id;
		$bill->round_off=$roundOff;
        $bill->grand_total=$net;
		$bill->customer_id=$customer_id;
		
        $bill_rows=[];
		foreach($q as $row){
			$bill_row = $this->Bills->BillRows->newEntity();
			$bill_row->item_id=$row['item_id'];
			$bill_row->quantity=$row['quantity'];
			$bill_row->rate=$row['rate'];
			$bill_row->amount=$row['amount'];
			$bill_row->discount_per=$row['discount_per'];
			$bill_row->net_amount=$row['net_amount'];
			$bill_rows[]=$bill_row;
		}
		$bill->bill_rows=$bill_rows;
		if ($this->Bills->save($bill)) {
			$query = $this->Bills->Kots->query();
			$query->update()
				->set(['bill_pending' => 'no'])
				->where(['table_id' => $table_id])
				->execute();
			echo $bill->id;

            foreach ($kot_ids as $key => $kot_id) {
                $query = $this->Bills->Kots->query();
                $query->update()
                    ->set(['bill_id' => $bill->id])
                    ->where(['id' => $kot_id])
                    ->execute();
            }
		}else{
			echo '0';
		}
		exit;
    }

    /**
     * Edit method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bill = $this->Bills->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bill = $this->Bills->patchEntity($bill, $this->request->getData());
            if ($this->Bills->save($bill)) {
                $this->Flash->success(__('The bill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bill could not be saved. Please, try again.'));
        }
        $tables = $this->Bills->Tables->find('list', ['limit' => 200]);
        $this->set(compact('bill', 'tables'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bill = $this->Bills->get($id);
        if ($this->Bills->delete($bill)) {
            $this->Flash->success(__('The bill has been deleted.'));
        } else {
            $this->Flash->error(__('The bill could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
