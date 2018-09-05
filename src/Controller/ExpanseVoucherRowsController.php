<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExpanseVoucherRows Controller
 *
 * @property \App\Model\Table\ExpanseVoucherRowsTable $ExpanseVoucherRows
 *
 * @method \App\Model\Entity\ExpanseVoucherRow[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExpanseVoucherRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ExpanseVouchers', 'ExpanseHeads']
        ];
        $expanseVoucherRows = $this->paginate($this->ExpanseVoucherRows);

        $this->set(compact('expanseVoucherRows'));
    }

    /**
     * View method
     *
     * @param string|null $id Expanse Voucher Row id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expanseVoucherRow = $this->ExpanseVoucherRows->get($id, [
            'contain' => ['ExpanseVouchers', 'ExpanseHeads']
        ]);

        $this->set('expanseVoucherRow', $expanseVoucherRow);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $expanseVoucherRow = $this->ExpanseVoucherRows->newEntity();
        if ($this->request->is('post')) {
            $expanseVoucherRow = $this->ExpanseVoucherRows->patchEntity($expanseVoucherRow, $this->request->getData());
            if ($this->ExpanseVoucherRows->save($expanseVoucherRow)) {
                $this->Flash->success(__('The expanse voucher row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expanse voucher row could not be saved. Please, try again.'));
        }
        $expanseVouchers = $this->ExpanseVoucherRows->ExpanseVouchers->find('list', ['limit' => 200]);
        $expanseHeads = $this->ExpanseVoucherRows->ExpanseHeads->find('list', ['limit' => 200]);
        $this->set(compact('expanseVoucherRow', 'expanseVouchers', 'expanseHeads'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Expanse Voucher Row id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $expanseVoucherRow = $this->ExpanseVoucherRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expanseVoucherRow = $this->ExpanseVoucherRows->patchEntity($expanseVoucherRow, $this->request->getData());
            if ($this->ExpanseVoucherRows->save($expanseVoucherRow)) {
                $this->Flash->success(__('The expanse voucher row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expanse voucher row could not be saved. Please, try again.'));
        }
        $expanseVouchers = $this->ExpanseVoucherRows->ExpanseVouchers->find('list', ['limit' => 200]);
        $expanseHeads = $this->ExpanseVoucherRows->ExpanseHeads->find('list', ['limit' => 200]);
        $this->set(compact('expanseVoucherRow', 'expanseVouchers', 'expanseHeads'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Expanse Voucher Row id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expanseVoucherRow = $this->ExpanseVoucherRows->get($id);
        if ($this->ExpanseVoucherRows->delete($expanseVoucherRow)) {
            $this->Flash->success(__('The expanse voucher row has been deleted.'));
        } else {
            $this->Flash->error(__('The expanse voucher row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
