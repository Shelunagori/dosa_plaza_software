<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RawMaterials Controller
 *
 * @property \App\Model\Table\RawMaterialsTable $RawMaterials
 *
 * @method \App\Model\Entity\RawMaterial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RawMaterialsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('admin');
        $rawMaterials = $this->paginate($this->RawMaterials);

        $this->set(compact('rawMaterials'));
    }

    public function add()
    {
		$this->viewBuilder()->layout('admin');
        $rawMaterial = $this->RawMaterials->newEntity();
        if ($this->request->is('post')) {
            $rawMaterial = $this->RawMaterials->patchEntity($rawMaterial, $this->request->getData());
           // pr($rawMaterial);exit;
            if ($this->RawMaterials->save($rawMaterial)) {
                $this->Flash->success(__('The raw material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The raw material could not be saved. Please, try again.'));
        }
		$Taxes = $this->RawMaterials->Taxes->find('list');
        $units = $this->RawMaterials->SecondaryUnits->find()->where(['is_deleted'=>0]);
        $this->set(compact('rawMaterial','Taxes','units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Raw Material id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rawMaterial = $this->RawMaterials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rawMaterial = $this->RawMaterials->patchEntity($rawMaterial, $this->request->getData());
            if ($this->RawMaterials->save($rawMaterial)) {
                $this->Flash->success(__('The raw material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The raw material could not be saved. Please, try again.'));
        }
        $this->set(compact('rawMaterial'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Raw Material id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rawMaterial = $this->RawMaterials->get($id);
        if ($this->RawMaterials->delete($rawMaterial)) {
            $this->Flash->success(__('The raw material has been deleted.'));
        } else {
            $this->Flash->error(__('The raw material could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	public function stock_adjustment(){
		
		
		
	}
}
