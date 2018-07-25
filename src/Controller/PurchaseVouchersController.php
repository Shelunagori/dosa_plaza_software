<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseVouchers Controller
 *
 * @property \App\Model\Table\PurchaseVouchersTable $PurchaseVouchers
 *
 * @method \App\Model\Entity\PurchaseVoucher[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseVouchersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('admin');
        $this->paginate = [
            'contain' => ['Vendors']
        ];
        $purchaseVouchers = $this->paginate($this->PurchaseVouchers);

        $this->set(compact('purchaseVouchers'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Voucher id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('admin');
        $purchaseVoucher = $this->PurchaseVouchers->get($id, [
            'contain' => ['Vandors', 'PurchaseVoucherRows']
        ]);

        $this->set('purchaseVoucher', $purchaseVoucher);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('admin');
        $purchaseVoucher = $this->PurchaseVouchers->newEntity();
		if ($this->request->is('post')) {
			
			  
            $purchaseVoucher = $this->PurchaseVouchers->patchEntity($purchaseVoucher,$this->request->getData()); 
			$lastvoucherno= $this->PurchaseVouchers->lastvoucherno();
			$purchaseVoucher->transaction_date=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
			$purchaseVoucher->voucher_no=$lastvoucherno;
			pr($purchaseVoucher->purchase_voucher_row);Exit;
			if ($this->PurchaseVouchers->save($purchaseVoucher)) {
				
                $this->Flash->success(__('The purchase voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase voucher could not be saved. Please, try again.'));
        }
		
		$raw_materials = $this->PurchaseVouchers->PurchaseVoucherRows->RawMaterials->find()->contain(['Taxes'])->order(['RawMaterials.id'=>'ASC']);
		$option=[];
		foreach($raw_materials as $raw_material)
			{
				$option[] =['value'=>$raw_material->id,'text'=>$raw_material->name,'tax'=>$raw_material->tax->tax_per];
			}
		 $Vendors = $this->PurchaseVouchers->Vendors->find('list' );
		
		 $this->set(compact('purchaseVoucher', 'Vendors','raw_materials','option'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Voucher id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('admin');
        $purchaseVoucher = $this->PurchaseVouchers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseVoucher = $this->PurchaseVouchers->patchEntity($purchaseVoucher, $this->request->getData());
            if ($this->PurchaseVouchers->save($purchaseVoucher)) {
                $this->Flash->success(__('The purchase voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase voucher could not be saved. Please, try again.'));
        }
        $Vendors = $this->PurchaseVouchers->Vendors->find('list');
        $this->set(compact('purchaseVoucher', 'Vendors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Voucher id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseVoucher = $this->PurchaseVouchers->get($id);
        if ($this->PurchaseVouchers->delete($purchaseVoucher)) {
            $this->Flash->success(__('The purchase voucher has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase voucher could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
