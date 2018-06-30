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
        $itemslist = $this->paginate($this->Items->find()->where(['Items.is_deleted'=>0]));
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
				'contain' => []
			]);
		}
		$loginId=$this->Auth->User('id'); 
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
			$item->created_by=$loginId;
			$item->rate=$this->request->getData('rate'); 
			$item->discount_applicable=$this->request->getData('discount_applicable'); 
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
		
        $itemSubCategories = $this->Items->ItemSubCategories->find('list', ['limit' => 200])->where(['is_deleted'=>0]);
        $this->set(compact('item', 'itemSubCategories','id'));
    }
 
    public function delete($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => []
        ]);
		$item = $this->Items->patchEntity($item, $this->request->getData());
		$item->is_deleted=1;
		if ($this->Items->save($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
