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
		$itemCategories = $this->paginate($this->ItemCategories->find()->where(['is_deleted'=>0]));
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
}
