<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Vegetables Controller
 *
 * @property \App\Model\Table\VegetablesTable $Vegetables
 *
 * @method \App\Model\Entity\Vegetable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VegetablesController extends AppController
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
            $vegetable = $this->Vegetables->get($id);
        }else{
            $vegetable = $this->Vegetables->newEntity();
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vegetable = $this->Vegetables->patchEntity($vegetable, $this->request->getData());
            if ($this->Vegetables->save($vegetable)) {
                $this->Flash->success(__('The vegetable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vegetable could not be saved. Please, try again.'));
        }

        $vegetables = $this->Vegetables->find();

        $this->set(compact('vegetable', 'vegetables', 'id'));
    }

    /**
     * View method
     *
     * @param string|null $id Vegetable id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vegetable = $this->Vegetables->get($id, [
            'contain' => ['VegetableRecords', 'VegetableRates']
        ]);

        $this->set('vegetable', $vegetable);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vegetable = $this->Vegetables->newEntity();
        if ($this->request->is('post')) {
            $vegetable = $this->Vegetables->patchEntity($vegetable, $this->request->getData());
            if ($this->Vegetables->save($vegetable)) {
                $this->Flash->success(__('The vegetable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vegetable could not be saved. Please, try again.'));
        }
        $this->set(compact('vegetable'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vegetable id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vegetable = $this->Vegetables->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vegetable = $this->Vegetables->patchEntity($vegetable, $this->request->getData());
            if ($this->Vegetables->save($vegetable)) {
                $this->Flash->success(__('The vegetable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vegetable could not be saved. Please, try again.'));
        }
        $this->set(compact('vegetable'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vegetable id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vegetable = $this->Vegetables->get($id);
        if ($this->Vegetables->delete($vegetable)) {
            $this->Flash->success(__('The vegetable has been deleted.'));
        } else {
            $this->Flash->error(__('The vegetable could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
