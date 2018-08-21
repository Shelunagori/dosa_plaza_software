<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 *
 * @method \App\Model\Entity\Item[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController
{   
	public function index(){
		$this->viewBuilder()->layout('admin');
		$this->paginate = [
            'contain' => ['ItemSubCategories']
        ];
        $itemslist = $this->Items->find();
		$this->set(compact('itemslist'));
	}

    public function add($id = null)
    {
		$this->viewBuilder()->layout('admin');
		if(!$id)
		{				
			$item = $this->Items->newEntity();
		}
		else
		{
			$item = $this->Items->get($id, [
				'contain' => ['ItemRows']
			]);
		}
		$loginId=$this->Auth->User('id'); 
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
			$item->created_by=$loginId;
			$item->rate=$this->request->getData('rate'); 
			$item->discount_applicable=$this->request->getData('discount_applicable'); 
            //pr($item); exit;
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
		if($id)
        {
            $itemSubCategories = $this->Items->ItemSubCategories->find('list', ['limit' => 200])
                ->where(['is_deleted'=>0])
                ->orWhere(['ItemSubCategories.id IN' => $item->item_sub_category_id])
                ->order(['ItemSubCategories.id'=>'ASC']);
        }
        else{
           $itemSubCategories = $this->Items->ItemSubCategories->find('list', ['limit' => 200])
                ->where(['is_deleted'=>0])
                ->order(['ItemSubCategories.id'=>'ASC']);
        }
        
        
        $Taxes = $this->Items->Taxes->find('list', ['limit' => 200])->order(['Taxes.id'=>'ASC']);
        
        if($id)
        {  
            $itemslist=array();
            foreach($item->item_rows as $raw_materials){
                $itemslist[]=$raw_materials->raw_material_id;
            }

            $raw_materials = $this->Items->ItemRows->RawMaterials->find()->contain(['PrimaryUnits','SecondaryUnits' ])
                            ->where(['RawMaterials.is_deleted'=>0])
                            ->orWhere(['RawMaterials.id IN' => $itemslist])
                            ->order(['RawMaterials.name'=>'ASC']);;
        }
        else{
            $raw_materials = $this->Items->ItemRows->RawMaterials->find()->contain(['PrimaryUnits','SecondaryUnits' ])
                            ->where(['RawMaterials.is_deleted'=>0])
                            ->order(['RawMaterials.name'=>'ASC']);;
        }
        
        $option=[];
        foreach($raw_materials as $raw_material)
        {
            
            if($raw_material->recipe_unit_type=="primary"){
                $unit_name = $raw_material->primary_unit->name;
            }else if($raw_material->recipe_unit_type=="secondary"){
                $unit_name = $raw_material->secondary_unit->name;
            }
            $option[] = [
                            'value'=>$raw_material->id,
                            'text'=>$raw_material->name, 
                            'unit_name'=>$unit_name,
                        ];
        }

        
        $this->set(compact('item', 'itemSubCategories','id','Taxes','option'));

    }
 
    public function delete($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => []
        ]);
		$item = $this->Items->patchEntity($item, $this->request->getData());
		$item->is_deleted=1;
		if ($this->Items->save($item)) {
            $this->Flash->success(__('The item has been freeze.'));
        } else {
            $this->Flash->error(__('The item could not be freeze. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function undelete($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => []
        ]);
        $item = $this->Items->patchEntity($item, $this->request->getData());
        $item->is_deleted=0;
        if ($this->Items->save($item)) {
            $this->Flash->success(__('The item has been unfreezed.'));
        } else {
            $this->Flash->error(__('The item could not be unfreezed. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function foodCostingReport(){
        $this->viewBuilder()->layout('admin');

        $from_date=$this->request->query('from_date');
        $to_date=$this->request->query('to_date');


        $BillRows=$this->Items->BillRows->find()->where(['BillRows.item_id = Items.id']);
        $BillRows->matching('Bills', function($q) use($from_date, $to_date){
            return $q->where(['Bills.transaction_date >=' => $from_date, 'Bills.transaction_date <=' => $to_date]);
        });
        $BillRows->select([$BillRows->func()->sum('BillRows.quantity')]);

        $BillRows2=$this->Items->BillRows->find()->where(['BillRows.item_id = Items.id']);
        $BillRows2->matching('Bills', function($q) use($from_date, $to_date){
            return $q->where(['Bills.transaction_date >=' => $from_date, 'Bills.transaction_date <=' => $to_date]);
        });
        $BillRows2->select([$BillRows2->func()->sum('BillRows.net_amount')]);

        $StockLedger=$this->Items->ItemRows->RawMaterials->StockLedgers->find()->where(['RawMaterials.id = StockLedgers.raw_material_id'])->where(['StockLedgers.voucher_name'=> 'Purchase Voucher']);
        $StockLedger->select([$StockLedger->func()->sum('StockLedgers.quantity*StockLedgers.rate')]);
 
        $StockLedger2=$this->Items->ItemRows->RawMaterials->StockLedgers->find()->where(['RawMaterials.id = StockLedgers.raw_material_id'])->where(['StockLedgers.voucher_name'=> 'Purchase Voucher']);
        $StockLedger2->select([$StockLedger2->func()->sum('StockLedgers.quantity*StockLedgers.quantity')]);

        $Items = $this->Items->find();
        $Items->select([
            'selling_quantity' => $BillRows,
            'selling_amount' => $BillRows2,
        ])
        ->contain(['ItemRows' => ['RawMaterials' => function($q) use($StockLedger, $StockLedger2){
            return $q
            ->select([
                'total_amount' => $StockLedger,
                'total_quantity' => $StockLedger2,
            ])
            ->autoFields(true);
        } ]])
        ->where(['Items.is_deleted'=>0])
        ->autoFields(true);

        //pr($Items->toArray()); exit;
        $this->set(compact('Items', 'from_date', 'to_date'));
    }

    public function favorite($item_id=null){
        $Item = $this->Items->get($item_id);
        $Item->is_favorite=1;
        $this->Items->save($Item);
        return $this->redirect(['action' => 'index']);
    }

    public function unfavorite($item_id=null){
        $Item = $this->Items->get($item_id);
        $Item->is_favorite=0;
        $this->Items->save($Item);
        return $this->redirect(['action' => 'index']);
    }

}
