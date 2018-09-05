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
        $expanseVouchers = $this->paginate($this->ExpanseVouchers);

        $this->set(compact('expanseVouchers'));
    }

    /**
     * View method
     *
     * @param string|null $id Expanse Voucher id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expanseVoucher = $this->ExpanseVouchers->get($id, [
            'contain' => ['ExpanseVoucherRows']
        ]);

        $this->set('expanseVoucher', $expanseVoucher);
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
        $expanseVoucher = $this->ExpanseVouchers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expanseVoucher = $this->ExpanseVouchers->patchEntity($expanseVoucher, $this->request->getData());
            if ($this->ExpanseVouchers->save($expanseVoucher)) {
                $this->Flash->success(__('The expanse voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expanse voucher could not be saved. Please, try again.'));
        }
        $this->set(compact('expanseVoucher'));
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
