<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RawMaterialCategories Controller
 *
 * @property \App\Model\Table\RawMaterialCategoriesTable $RawMaterialCategories
 *
 * @method \App\Model\Entity\RawMaterialCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RawMaterialCategoriesController extends AppController
{

     
    public function add($id = null)
    {
        $this->viewBuilder()->layout('admin');
        if(!$id)
        {               
            $rawMaterialCategory = $this->RawMaterialCategories->newEntity();
        }
        else
        {
            $rawMaterialCategory = $this->RawMaterialCategories->get($id, [
                'contain' => []
            ]);
        } 
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rawMaterialCategory = $this->RawMaterialCategories->patchEntity($rawMaterialCategory, $this->request->getData());
            if ($this->RawMaterialCategories->save($rawMaterialCategory)) {
                $this->Flash->success(__('The raw material category has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The raw material category could not be saved. Please, try again.'));
        }
        $rawMaterialCategories = ($this->RawMaterialCategories->find());
        $this->set(compact('rawMaterialCategory','rawMaterialCategories','id'));
    }

     
    public function edit($id = null)
    {
        $rawMaterialCategory = $this->RawMaterialCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rawMaterialCategory = $this->RawMaterialCategories->patchEntity($rawMaterialCategory, $this->request->getData());
            if ($this->RawMaterialCategories->save($rawMaterialCategory)) {
                $this->Flash->success(__('The raw material category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The raw material category could not be saved. Please, try again.'));
        }
        $this->set(compact('rawMaterialCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Raw Material Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $rawMaterialCategory = $this->RawMaterialCategories->get($id, [
            'contain' => []
        ]);
        $rawMaterialCategory = $this->RawMaterialCategories->patchEntity($rawMaterialCategory, $this->request->getData());
        $rawMaterialCategory->is_deleted=1;
        if ($this->RawMaterialCategories->save($rawMaterialCategory)) {
            $this->Flash->success(__('The category has been freezed.'));
        } else {
            $this->Flash->error(__('The category could not be freezed. Please, try again.'));
        }
        return $this->redirect(['action' => 'add']);
    }
    public function undelete($id = null)
    {
        $rawMaterialCategory = $this->RawMaterialCategories->get($id, [
            'contain' => []
        ]);
        $rawMaterialCategory = $this->RawMaterialCategories->patchEntity($rawMaterialCategory, $this->request->getData());
        $rawMaterialCategory->is_deleted=0;
        if ($this->RawMaterialCategories->save($rawMaterialCategory)) {
            $this->Flash->success(__('The category has been freezed.'));
        } else {
            $this->Flash->error(__('The category could not be freezed. Please, try again.'));
        }
        return $this->redirect(['action' => 'add']);
    }
}
