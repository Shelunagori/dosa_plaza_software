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
		
		$ItemSubCategoriesList = $this->paginate($this->ItemSubCategories->find()->where(['ItemSubCategories.is_deleted'=>0])->order(['ItemSubCategories.id'=>'ASC']));
		$itemCategories = $this->ItemSubCategories->ItemCategories->find('list', ['limit' => 200]);
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
            $this->Flash->success(__('The item sub category has been deleted.'));
        } else {
            $this->Flash->error(__('The item sub category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
