<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BillRows Controller
 *
 * @property \App\Model\Table\BillRowsTable $BillRows
 *
 * @method \App\Model\Entity\BillRow[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BillRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bills', 'Items']
        ];
        $billRows = $this->paginate($this->BillRows);

        $this->set(compact('billRows'));
    }

    /**
     * View method
     *
     * @param string|null $id Bill Row id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $billRow = $this->BillRows->get($id, [
            'contain' => ['Bills', 'Items']
        ]);

        $this->set('billRow', $billRow);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $billRow = $this->BillRows->newEntity();
        if ($this->request->is('post')) {
            $billRow = $this->BillRows->patchEntity($billRow, $this->request->getData());
            if ($this->BillRows->save($billRow)) {
                $this->Flash->success(__('The bill row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bill row could not be saved. Please, try again.'));
        }
        $bills = $this->BillRows->Bills->find('list', ['limit' => 200]);
        $items = $this->BillRows->Items->find('list', ['limit' => 200]);
        $this->set(compact('billRow', 'bills', 'items'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bill Row id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $billRow = $this->BillRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $billRow = $this->BillRows->patchEntity($billRow, $this->request->getData());
            if ($this->BillRows->save($billRow)) {
                $this->Flash->success(__('The bill row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bill row could not be saved. Please, try again.'));
        }
        $bills = $this->BillRows->Bills->find('list', ['limit' => 200]);
        $items = $this->BillRows->Items->find('list', ['limit' => 200]);
        $this->set(compact('billRow', 'bills', 'items'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bill Row id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $billRow = $this->BillRows->get($id);
        if ($this->BillRows->delete($billRow)) {
            $this->Flash->success(__('The bill row has been deleted.'));
        } else {
            $this->Flash->error(__('The bill row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
