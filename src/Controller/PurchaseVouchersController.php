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
			$purchaseVoucher = $this->PurchaseVouchers->patchEntity($purchaseVoucher, $this->request->getData()); 
			
            //Voucher Number Increment
            $last_voucher_no=$this->PurchaseVouchers->find()->select(['voucher_no'])->order(['voucher_no' => 'DESC'])->first();
            if($last_voucher_no){
                $purchaseVoucher->voucher_no=$last_voucher_no->voucher_no+1;
            }else{
                $purchaseVoucher->voucher_no=1;
            }

			if ($this->PurchaseVouchers->save($purchaseVoucher)) {
                foreach ($purchaseVoucher->purchase_voucher_rows as $purchase_voucher_row) {
                    $stockLedger = $this->PurchaseVouchers->PurchaseVoucherRows->StockLedgers->newEntity();
                    $stockLedger->raw_material_id = $purchase_voucher_row->raw_material_id;
                    $stockLedger->quantity = $purchase_voucher_row->quantity;
                    $stockLedger->rate = $purchase_voucher_row->taxable_value/$purchase_voucher_row->quantity;
                    $stockLedger->status = 'in';
                    $stockLedger->effected_on = date( "Y-m-d H:i:s" );
                    $stockLedger->voucher_name = 'Purchase Voucher';
                    $stockLedger->adjustment_commant = '';
                    $stockLedger->wastage_commant = '';
                    $stockLedger->purchase_voucher_row_id = $purchase_voucher_row->id;
                    $stockLedger->purchase_voucher_id = $purchaseVoucher->id;
                    $this->PurchaseVouchers->PurchaseVoucherRows->StockLedgers->save($stockLedger);
                }
				//Stock Impact End//
                $this->Flash->success(__('The stock-in voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('The stock-in voucher could not be saved. Please, try again.'));
        }
		
		$raw_materials = $this->PurchaseVouchers->PurchaseVoucherRows->RawMaterials->find()
                            ->contain(['Taxes', 'PrimaryUnits', 'SecondaryUnits' ])
                            ->order(['RawMaterials.name'=>'ASC']);
		$option=[];
		foreach($raw_materials as $raw_material)
		{
            if($raw_material->purchase_voucher_unit_type=="primary"){
                $unit_name = $raw_material->primary_unit->name;
            }else if($raw_material->purchase_voucher_unit_type=="secondary"){
                $unit_name = $raw_material->secondary_unit->name;
            }
			$option[] =  [
                            'value'=>$raw_material->id,
                            'text'=>$raw_material->name,
                            'tax'=>$raw_material->tax->tax_per,
                            'unit_name'=>$unit_name,
                        ];
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
            'contain' => ['PurchaseVoucherRows']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseVoucher = $this->PurchaseVouchers->patchEntity($purchaseVoucher, $this->request->getData()); 
            
            if ($this->PurchaseVouchers->save($purchaseVoucher)) {
                //Delete old stock impact//
                $this->PurchaseVouchers->PurchaseVoucherRows->StockLedgers->deleteAll(['purchase_voucher_id' => $purchaseVoucher->id]);
                //Stock Impact Start//
                //Stock Impact Start//
                foreach ($purchaseVoucher->purchase_voucher_rows as $purchase_voucher_row) {
                    $stockLedger = $this->PurchaseVouchers->PurchaseVoucherRows->StockLedgers->newEntity();
                    $stockLedger->raw_material_id = $purchase_voucher_row->raw_material_id;
                    $stockLedger->quantity = $purchase_voucher_row->quantity;
                    $stockLedger->rate = $purchase_voucher_row->taxable_value/$purchase_voucher_row->quantity;
                    $stockLedger->status = 'in';
                    $stockLedger->effected_on = date( "Y-m-d H:i:s" );
                    $stockLedger->voucher_name = 'Purchase Voucher';
                    $stockLedger->adjustment_commant = '';
                    $stockLedger->wastage_commant = '';
                    $stockLedger->purchase_voucher_row_id = $purchase_voucher_row->id;
                    $stockLedger->purchase_voucher_id = $purchaseVoucher->id;
                    $this->PurchaseVouchers->PurchaseVoucherRows->StockLedgers->save($stockLedger);
                }
                //Stock Impact End//
                $this->Flash->success(__('The stock-in voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock-in voucher could not be saved. Please, try again.'));
        }
         
        $itemslist=array();
        foreach($purchaseVoucher->purchase_voucher_rows as $raw_materia){
            $itemslist[]=$raw_materia->raw_material_id;
        } 
        $raw_materials = $this->PurchaseVouchers->PurchaseVoucherRows->RawMaterials->find()
                            ->contain(['Taxes', 'PrimaryUnits', 'SecondaryUnits' ])
                            ->where(['RawMaterials.is_deleted'=>0])
                            ->orwhere(['RawMaterials.id IN'=>$itemslist])
                            ->order(['RawMaterials.name'=>'ASC']);
        $option=[];
        foreach($raw_materials as $raw_material)
        {
            if($raw_material->purchase_voucher_unit_type=="primary"){
                $unit_name = $raw_material->primary_unit->name;
            }else if($raw_material->purchase_voucher_unit_type=="secondary"){
                $unit_name = $raw_material->secondary_unit->name;
            }
            $option[] =  [
                            'value'=>$raw_material->id,
                            'text'=>$raw_material->name,
                            'tax'=>$raw_material->tax->tax_per,
                            'unit_name'=>$unit_name,
                        ];
        }

        $Vendors = $this->PurchaseVouchers->Vendors->find('list')
            ->where(['Vendors.is_deleted'=>0])
            ->orWhere(['Vendors.id IN'=>$purchaseVoucher->vendor_id]);
        $this->set(compact('purchaseVoucher', 'Vendors','raw_materials','option'));
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
