<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemCategories Controller
 *
 * @property \App\Model\Table\ItemCategoriesTable $ItemCategories
 *
 * @method \App\Model\Entity\ItemCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemCategoriesController extends AppController
{ 
    public function add($id = null)
    {
		
		$this->viewBuilder()->layout('admin');
		if(!$id)
		{				
			$itemCategory = $this->ItemCategories->newEntity();
		}
		else
		{
			$itemCategory = $this->ItemCategories->get($id, [
				'contain' => []
			]);
		} 
        if ($this->request->is(['patch','post','put'])){
            $itemCategory = $this->ItemCategories->patchEntity($itemCategory, $this->request->getData());
            if ($this->ItemCategories->save($itemCategory)) {
                $this->Flash->success(__('The item category has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The item category could not be saved. Please, try again.'));
        }
		$itemCategories = ($this->ItemCategories->find());
        $this->set(compact('itemCategory','itemCategories','id'));
    }
 
    public function delete($id = null)
    {
        $itemCategory = $this->ItemCategories->get($id, [
            'contain' => []
        ]);
		$itemCategory = $this->ItemCategories->patchEntity($itemCategory, $this->request->getData());
		$itemCategory->is_deleted=1;
		if ($this->ItemCategories->save($itemCategory)) {
            $this->Flash->success(__('The item category has been deleted.'));
        }else {
            $this->Flash->error(__('The item category could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'add']);
    }
    public function undelete($id = null)
    {
        $itemCategory = $this->ItemCategories->get($id, [
            'contain' => []
        ]);
        $itemCategory = $this->ItemCategories->patchEntity($itemCategory, $this->request->getData());
        $itemCategory->is_deleted=0;
        if ($this->ItemCategories->save($itemCategory)) {
            $this->Flash->success(__('The item category has been deleted.'));
        }else {
            $this->Flash->error(__('The item category could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'add']);
    }

    public function groupReport()
    {
        $this->viewBuilder()->layout('admin');

        $from_date=$this->request->query('from_date');
        $to_date=$this->request->query('to_date');

        $Total_qty=$this->ItemCategories->ItemSubCategories->Items->BillRows->find()
                    ->where(['BillRows.item_id = Items.id'])
                    ->matching('Bills', function($q) use($from_date, $to_date){
                        return $q->where([
                                        'Bills.transaction_date >=' => $from_date, 
                                        'Bills.transaction_date <=' => $to_date
                                    ]);
                    });
        $Total_qty->select([$Total_qty->func()->sum('BillRows.quantity')]);


        $Total_Amount=$this->ItemCategories->ItemSubCategories->Items->BillRows->find()
                    ->where(['BillRows.item_id = Items.id'])
                    ->matching('Bills', function($q) use($from_date, $to_date){
                        return $q->where([
                                        'Bills.transaction_date >=' => $from_date, 
                                        'Bills.transaction_date <=' => $to_date
                                    ]);
                    });
        $Total_Amount->select([$Total_Amount->func()->sum('BillRows.amount')]);

        $Total_Discount=$this->ItemCategories->ItemSubCategories->Items->BillRows->find()
                    ->where(['BillRows.item_id = Items.id'])
                    ->matching('Bills', function($q) use($from_date, $to_date){
                        return $q->where([
                                        'Bills.transaction_date >=' => $from_date, 
                                        'Bills.transaction_date <=' => $to_date
                                    ]);
                    });
        $Total_Discount->select([$Total_Discount->func()->sum('BillRows.discount_amount')]);

        $Total_Net=$this->ItemCategories->ItemSubCategories->Items->BillRows->find()
                    ->where(['BillRows.item_id = Items.id'])
                    ->matching('Bills', function($q) use($from_date, $to_date){
                        return $q->where([
                                        'Bills.transaction_date >=' => $from_date, 
                                        'Bills.transaction_date <=' => $to_date
                                    ]);
                    });
        $Total_Net->select([$Total_Net->func()->sum('BillRows.net_amount')]);

        $ItemCategories = $this->ItemCategories->find();
        $ItemCategories->contain([
            'ItemSubCategories' => [
                'Items' =>function($q) use($Total_qty, $Total_Amount, $Total_Discount, $Total_Net){
                    return $q->select([
                                'Items.id',
                                'Items.item_sub_category_id',
                                'Total_qty' => $Total_qty,
                                'Total_Amount' => $Total_Amount,
                                'Total_Discount' => $Total_Discount,
                                'Total_Net' => $Total_Net,
                            ])
                            ->autoFields(true);
                }
            ]
        ])
        ->autoFields(true);

        //pr($ItemCategories->toArray()); exit;

        $this->set(compact('from_date', 'to_date', 'ItemCategories'));

    }

}
