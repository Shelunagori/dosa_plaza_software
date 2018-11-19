<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseVoucherRows Controller
 *
 * @property \App\Model\Table\PurchaseVoucherRowsTable $PurchaseVoucherRows
 *
 * @method \App\Model\Entity\PurchaseVoucherRow[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseVoucherRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RawMaterials', 'PurchaseVouchers']
        ];
        $purchaseVoucherRows = $this->paginate($this->PurchaseVoucherRows);

        $this->set(compact('purchaseVoucherRows'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Voucher Row id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseVoucherRow = $this->PurchaseVoucherRows->get($id, [
            'contain' => ['RawMaterials', 'PurchaseVouchers']
        ]);

        $this->set('purchaseVoucherRow', $purchaseVoucherRow);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchaseVoucherRow = $this->PurchaseVoucherRows->newEntity();
        if ($this->request->is('post')) {
            $purchaseVoucherRow = $this->PurchaseVoucherRows->patchEntity($purchaseVoucherRow, $this->request->getData());
			 if ($this->PurchaseVoucherRows->save($purchaseVoucherRow)) {
                $this->Flash->success(__('The purchase voucher row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase voucher row could not be saved. Please, try again.'));
        }
        $rawMaterials = $this->PurchaseVoucherRows->RawMaterials->find('list');
        $purchaseVouchers = $this->PurchaseVoucherRows->PurchaseVouchers->find('list');
        $this->set(compact('purchaseVoucherRow', 'rawMaterials', 'purchaseVouchers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Voucher Row id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseVoucherRow = $this->PurchaseVoucherRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseVoucherRow = $this->PurchaseVoucherRows->patchEntity($purchaseVoucherRow, $this->request->getData());
            if ($this->PurchaseVoucherRows->save($purchaseVoucherRow)) {
                $this->Flash->success(__('The purchase voucher row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase voucher row could not be saved. Please, try again.'));
        }
        $rawMaterials = $this->PurchaseVoucherRows->RawMaterials->find('list', ['limit' => 200]);
        $purchaseVouchers = $this->PurchaseVoucherRows->PurchaseVouchers->find('list', ['limit' => 200]);
        $this->set(compact('purchaseVoucherRow', 'rawMaterials', 'purchaseVouchers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Voucher Row id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseVoucherRow = $this->PurchaseVoucherRows->get($id);
        if ($this->PurchaseVoucherRows->delete($purchaseVoucherRow)) {
            $this->Flash->success(__('The purchase voucher row has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase voucher row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
