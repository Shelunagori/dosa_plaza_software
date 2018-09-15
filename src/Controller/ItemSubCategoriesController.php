<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemSubCategories Controller
 *
 * @property \App\Model\Table\ItemSubCategoriesTable $ItemSubCategories
 *
 * @method \App\Model\Entity\ItemSubCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemSubCategoriesController extends AppController
{    
    public function add($id = null)
    {
		$this->viewBuilder()->layout('admin');
		if(!$id)
		{				
			$itemSubCategory = $this->ItemSubCategories->newEntity();
		}
		else
		{
			$itemSubCategory = $this->ItemSubCategories->get($id, [
				'contain' => ['ItemCategories']
			]);
		} 
        if ($this->request->is(['patch','post','put'])){
            $itemSubCategory = $this->ItemSubCategories->patchEntity($itemSubCategory, $this->request->getData());
            if ($this->ItemSubCategories->save($itemSubCategory)) {
                $this->Flash->success(__('The item sub category has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The item category could not be saved. Please, try again.'));
        }
		$this->paginate = [
            'contain' => ['ItemCategories']
        ];
		if($id)
        {
             $itemCategories = $this->ItemSubCategories->ItemCategories->find('list', ['limit' => 200])
                ->where(['ItemCategories.is_deleted'=>0])
                ->orWhere(['ItemCategories.id IN' => $itemSubCategory->item_category_id]);
        }
        else{
            $itemCategories = $this->ItemSubCategories->ItemCategories->find('list', ['limit' => 200])
                ->where(['ItemCategories.is_deleted'=>0]);
        }
		$ItemSubCategoriesList = $this->paginate($this->ItemSubCategories->find()->order(['ItemSubCategories.id'=>'ASC']));

		
        $this->set(compact('itemSubCategory','ItemSubCategoriesList','itemCategories','id'));
    }
 
    public function delete($id = null)
    {
        $itemSubCategory = $this->ItemSubCategories->get($id, [
            'contain' => []
        ]);
        
		$itemSubCategory = $this->ItemSubCategories->patchEntity($itemSubCategory, $this->request->getData());
		$itemSubCategory->is_deleted=1;
		if ($this->ItemSubCategories->save($itemSubCategory)) {
            $this->Flash->success(__('The item sub category has been Freezed.'));
        } else {
            $this->Flash->error(__('The item sub category could not be Freezed. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
    public function undelete($id = null)
    {
        $itemSubCategory = $this->ItemSubCategories->get($id, [
            'contain' => []
        ]);
        
        $itemSubCategory = $this->ItemSubCategories->patchEntity($itemSubCategory, $this->request->getData());
        $itemSubCategory->is_deleted=0;
        if ($this->ItemSubCategories->save($itemSubCategory)) {
            $this->Flash->success(__('The item sub category has been unfreezed.'));
        } else {
            $this->Flash->error(__('The item sub category could not be unfreezed. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }

    public function subGroupItemReportSearch(){
        $this->viewBuilder()->layout('admin');
    }

    public function subGroupItemReport(){
        $this->viewBuilder()->layout('');

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));

        $Total_qty=$this->ItemSubCategories->Items->BillRows->find()
                    ->where(['BillRows.item_id = Items.id'])
                    ->matching('Bills', function($q) use($from_date, $to_date){
                        return $q->where([
                                        'Bills.transaction_date >=' => $from_date, 
                                        'Bills.transaction_date <=' => $to_date
                                    ]);
                    });
        $Total_qty->select([$Total_qty->func()->sum('BillRows.quantity')]);


        $Total_Net=$this->ItemSubCategories->Items->BillRows->find()
                    ->where(['BillRows.item_id = Items.id'])
                    ->matching('Bills', function($q) use($from_date, $to_date){
                        return $q->where([
                                        'Bills.transaction_date >=' => $from_date, 
                                        'Bills.transaction_date <=' => $to_date
                                    ]);
                    });
        $Total_Net->select([$Total_Net->func()->sum('BillRows.net_amount')]);

        $ItemSubCategories = $this->ItemSubCategories->find();
        $ItemSubCategories->contain([
            'Items' =>function($q) use($Total_qty, $Total_Net){
                return $q->select([
                            'Items.id',
                            'Items.item_sub_category_id',
                            'Total_qty' => $Total_qty,
                            'Total_Net' => $Total_Net,
                        ])
                        ->autoFields(true);
            }
        ])
        ->autoFields(true);

        //pr($ItemSubCategories->toArray()); exit; 

        $this->set(compact('date_from_to', 'exploded_date_from_to', 'ItemSubCategories'));
    }
}
