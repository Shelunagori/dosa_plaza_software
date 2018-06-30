<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MasterOffers Controller
 *
 * @property \App\Model\Table\MasterOffersTable $MasterOffers
 *
 * @method \App\Model\Entity\MasterOffer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MasterOffersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('admin');
        $masterOffers = $this->paginate($this->MasterOffers);
        $this->set(compact('masterOffers'));
    }

    public function add($id = null)
    {
		$this->viewBuilder()->layout('admin');
		if(!$id){
			$masterOffer = $this->MasterOffers->newEntity();
		}
		else{
			$masterOffer = $this->MasterOffers->get($id, [
				'contain' => []
			]);
		}
        if ($this->request->is(['patch', 'post', 'put'])) {
            $masterOffer = $this->MasterOffers->patchEntity($masterOffer, $this->request->getData());
			 
            if ($this->MasterOffers->save($masterOffer)) {
                $this->Flash->success(__('The master offer has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The master offer could not be saved. Please, try again.'));
        }
		$masterOfferslist = $this->paginate($this->MasterOffers->find()->where(['is_deleted'=>0]));
        $this->set(compact('masterOffer','id','masterOfferslist'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Master Offer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('admin');
        $masterOffer = $this->MasterOffers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $masterOffer = $this->MasterOffers->patchEntity($masterOffer, $this->request->getData());
            if ($this->MasterOffers->save($masterOffer)) {
                $this->Flash->success(__('The master offer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The master offer could not be saved. Please, try again.'));
        }
        $this->set(compact('masterOffer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Master Offer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $masterOffer = $this->MasterOffers->get($id, [
            'contain' => []
        ]);
		$masterOffer = $this->MasterOffers->patchEntity($masterOffer, $this->request->getData());
		$masterOffer->is_deleted=1;
		if ($this->MasterOffers->save($masterOffer)) {
            $this->Flash->success(__('The master offer has been deleted.'));
        } else {
            $this->Flash->error(__('The master offer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
