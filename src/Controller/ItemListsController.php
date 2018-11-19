<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemLists Controller
 *
 * @property \App\Model\Table\ItemListsTable $ItemLists
 *
 * @method \App\Model\Entity\ItemList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemListsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
        $this->viewBuilder()->layout('admin');
        if($id){
            $itemList = $this->ItemLists->get($id);
        }else{
            $itemList = $this->ItemLists->newEntity();
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemList = $this->ItemLists->patchEntity($itemList, $this->request->getData());
            if ($this->ItemLists->save($itemList)) {
                $this->Flash->success(__('The item list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item list could not be saved. Please, try again.'));
        }

        $itemLists = $this->ItemLists->find();

        $this->set(compact('itemList', 'itemLists', 'id'));
    }

    /**
     * View method
     *
     * @param string|null $id Item List id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemList = $this->ItemLists->get($id, [
            'contain' => []
        ]);

        $this->set('itemList', $itemList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemList = $this->ItemLists->newEntity();
        if ($this->request->is('post')) {
            $itemList = $this->ItemLists->patchEntity($itemList, $this->request->getData());
            if ($this->ItemLists->save($itemList)) {
                $this->Flash->success(__('The item list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item list could not be saved. Please, try again.'));
        }
        $this->set(compact('itemList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemList = $this->ItemLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemList = $this->ItemLists->patchEntity($itemList, $this->request->getData());
            if ($this->ItemLists->save($itemList)) {
                $this->Flash->success(__('The item list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item list could not be saved. Please, try again.'));
        }
        $this->set(compact('itemList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemList = $this->ItemLists->get($id);
        if ($this->ItemLists->delete($itemList)) {
            $this->Flash->success(__('The item list has been deleted.'));
        } else {
            $this->Flash->error(__('The item list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
