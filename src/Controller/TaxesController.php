<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Taxes Controller
 *
 * @property \App\Model\Table\TaxesTable $Taxes
 *
 * @method \App\Model\Entity\Tax[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TaxesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('admin');
        $taxes = $this->paginate($this->Taxes);

        $this->set(compact('taxes'));
    }

    /**
     * View method
     *
     * @param string|null $id Tax id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $Tax = $this->Taxes->get($id, [
            'contain' => ['RawMaterials']
        ]);

        $this->set('Tax', $Tax);
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
			$Tax = $this->Taxes->newEntity();
		}
		else
		{
			$Tax = $this->Taxes->get($id, [
				'contain' => []
			]);
		} 
        if ($this->request->is(['patch','post','put'])) {
            $Tax = $this->Taxes->patchEntity($Tax, $this->request->getData());
			
			
            if ($this->Taxes->save($Tax)) {
                $this->Flash->success(__('The Tax has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The Tax could not be saved. Please, try again.'));
        }
		$Taxes = $this->paginate($this->Taxes->find());
        $this->set(compact('Tax','Taxes','id'));
    }
	

    /**
     * Edit method
     *
     * @param string|null $id Tax id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $Tax = $this->Taxes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $Tax = $this->Taxes->patchEntity($Tax, $this->request->getData());
            if ($this->Taxes->save($Tax)) {
                $this->Flash->success(__('The Tax has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Tax could not be saved. Please, try again.'));
        }
        $this->set(compact('Tax'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tax id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $Tax = $this->Taxes->get($id);
        if ($this->Taxes->delete($Tax)) {
            $this->Flash->success(__('The Tax has been deleted.'));
        } else {
            $this->Flash->error(__('The Tax could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
