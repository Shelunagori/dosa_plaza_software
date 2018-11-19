<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RawMaterialSubCategories Controller
 *
 * @property \App\Model\Table\RawMaterialSubCategoriesTable $RawMaterialSubCategories
 *
 * @method \App\Model\Entity\RawMaterialSubCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RawMaterialSubCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RawMaterialCategories']
        ];
        $rawMaterialSubCategories = $this->paginate($this->RawMaterialSubCategories);

        $this->set(compact('rawMaterialSubCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Raw Material Sub Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rawMaterialSubCategory = $this->RawMaterialSubCategories->get($id, [
            'contain' => ['RawMaterialCategories']
        ]);

        $this->set('rawMaterialSubCategory', $rawMaterialSubCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $this->viewBuilder()->layout('admin');
        if(!$id)
        {               
            $rawMaterialSubCategory = $this->RawMaterialSubCategories->newEntity();
        }
        else
        {
            $rawMaterialSubCategory = $this->RawMaterialSubCategories->get($id, [
                'contain' => []
            ]);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rawMaterialSubCategory = $this->RawMaterialSubCategories->patchEntity($rawMaterialSubCategory, $this->request->getData());
            if ($this->RawMaterialSubCategories->save($rawMaterialSubCategory)) {
                $this->Flash->success(__('The raw material sub category has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The raw material sub category could not be saved. Please, try again.'));
        }
        $this->paginate = [
            'contain' => ['RawMaterialCategories']
        ];
        $rawMaterialSubCategories = $this->paginate($this->RawMaterialSubCategories);

        $rawMaterialCategories = $this->RawMaterialSubCategories->RawMaterialCategories->find('list', ['limit' => 200]);
        $this->set(compact('rawMaterialSubCategory', 'rawMaterialCategories','id','rawMaterialSubCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Raw Material Sub Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rawMaterialSubCategory = $this->RawMaterialSubCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rawMaterialSubCategory = $this->RawMaterialSubCategories->patchEntity($rawMaterialSubCategory, $this->request->getData());
            if ($this->RawMaterialSubCategories->save($rawMaterialSubCategory)) {
                $this->Flash->success(__('The raw material sub category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The raw material sub category could not be saved. Please, try again.'));
        }
        $rawMaterialCategories = $this->RawMaterialSubCategories->RawMaterialCategories->find('list', ['limit' => 200]);
        $this->set(compact('rawMaterialSubCategory', 'rawMaterialCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Raw Material Sub Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $rawMaterialSubCategory = $this->RawMaterialSubCategories->get($id, [
            'contain' => []
        ]);
        $rawMaterialSubCategory = $this->RawMaterialSubCategories->patchEntity($rawMaterialSubCategory, $this->request->getData());
        $rawMaterialSubCategory->is_deleted=1;
        if ($this->RawMaterialSubCategories->save($rawMaterialSubCategory)) {
            $this->Flash->success(__('The raw material sub category has been deleted.'));
        } else {
            $this->Flash->error(__('The raw material sub category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
    public function undelete($id = null)
    {
        $rawMaterialSubCategory = $this->RawMaterialSubCategories->get($id, [
            'contain' => []
        ]);
        $rawMaterialSubCategory = $this->RawMaterialSubCategories->patchEntity($rawMaterialSubCategory, $this->request->getData());
        $rawMaterialSubCategory->is_deleted=0;
        if ($this->RawMaterialSubCategories->save($rawMaterialSubCategory)) {
            $this->Flash->success(__('The sub category has been freezed.'));
        } else {
            $this->Flash->error(__('The sub category could not be freezed. Please, try again.'));
        }
        return $this->redirect(['action' => 'add']);
    }
}
