<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExpanseHeads Controller
 *
 * @property \App\Model\Table\ExpanseHeadsTable $ExpanseHeads
 *
 * @method \App\Model\Entity\ExpanseHead[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExpanseHeadsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
        $this->viewBuilder()->layout('admin');
        if(!$id)
        {               
            $expanseHead = $this->ExpanseHeads->newEntity();
        }
        else
        {
            $expanseHead = $this->ExpanseHeads->get($id, [
                'contain' => []
            ]);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $expanseHead = $this->ExpanseHeads->patchEntity($expanseHead, $this->request->getData());
            if ($this->ExpanseHeads->save($expanseHead)) {
                $this->Flash->success(__('The expanse head has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expanse head could not be saved. Please, try again.'));
        }

        $expanseHeads = $this->ExpanseHeads->find();

        $this->set(compact('expanseHead', 'expanseHeads', 'id'));
    }

    /**
     * View method
     *
     * @param string|null $id Expanse Head id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expanseHead = $this->ExpanseHeads->get($id, [
            'contain' => ['ExpanseVoucherRows']
        ]);

        $this->set('expanseHead', $expanseHead);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $expanseHead = $this->ExpanseHeads->newEntity();
        if ($this->request->is('post')) {
            $expanseHead = $this->ExpanseHeads->patchEntity($expanseHead, $this->request->getData());
            if ($this->ExpanseHeads->save($expanseHead)) {
                $this->Flash->success(__('The expanse head has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expanse head could not be saved. Please, try again.'));
        }
        $this->set(compact('expanseHead'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Expanse Head id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $expanseHead = $this->ExpanseHeads->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expanseHead = $this->ExpanseHeads->patchEntity($expanseHead, $this->request->getData());
            if ($this->ExpanseHeads->save($expanseHead)) {
                $this->Flash->success(__('The expanse head has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expanse head could not be saved. Please, try again.'));
        }
        $this->set(compact('expanseHead'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Expanse Head id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expanseHead = $this->ExpanseHeads->get($id);
        if ($this->ExpanseHeads->delete($expanseHead)) {
            $this->Flash->success(__('The expanse head has been deleted.'));
        } else {
            $this->Flash->error(__('The expanse head could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
