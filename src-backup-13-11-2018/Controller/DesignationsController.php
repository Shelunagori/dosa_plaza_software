<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Designations Controller
 *
 * @property \App\Model\Table\DesignationsTable $Designations
 *
 * @method \App\Model\Entity\Designation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DesignationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('admin');
        $designations = $this->paginate($this->Designations);

        $this->set(compact('designations'));
    }

    /**
     * View method
     *
     * @param string|null $id Designation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $designation = $this->Designations->get($id, [
            'contain' => []
        ]);

        $this->set('designation', $designation);
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
			$Designation = $this->Designations->newEntity();
		}
		else
		{
			$Designation = $this->Designations->get($id, [
				'contain' => []
			]);
		} 
        if ($this->request->is(['patch','post','put'])) {
            $Designation = $this->Designations->patchEntity($Designation, $this->request->getData());
			
            if ($this->Designations->save($Designation)) {
				
                $this->Flash->success(__('The Designation has been saved.'));
				
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The Designation could not be saved. Please, try again.'));
        }
		$Designations = $this->paginate($this->Designations->find());

		$this->set(compact('Designation','Designations','id'));
		
	 }

    /**
     * Edit method
     *
     * @param string|null $id Designation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $designation = $this->Designations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $designation = $this->Designations->patchEntity($designation, $this->request->getData());
            if ($this->Designations->save($designation)) {
                $this->Flash->success(__('The designation has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The designation could not be saved. Please, try again.'));
        }
        $this->set(compact('designation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Designation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $designation = $this->Designations->get($id);
        if ($this->Designations->delete($designation)) {
            $this->Flash->success(__('The designation has been deleted.'));
        } else {
            $this->Flash->error(__('The designation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
