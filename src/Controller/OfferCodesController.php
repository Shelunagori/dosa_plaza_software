<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OfferCodes Controller
 *
 * @property \App\Model\Table\OfferCodesTable $OfferCodes
 *
 * @method \App\Model\Entity\OfferCode[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OfferCodesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $offerCodes = $this->paginate($this->OfferCodes);

        $this->set(compact('offerCodes'));
    }

    /**
     * View method
     *
     * @param string|null $id Offer Code id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $offerCode = $this->OfferCodes->get($id, [
            'contain' => []
        ]);

        $this->set('offerCode', $offerCode);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $offerCode = $this->OfferCodes->newEntity();
        if ($this->request->is('post')) {
            $offerCode = $this->OfferCodes->patchEntity($offerCode, $this->request->getData());
            if ($this->OfferCodes->save($offerCode)) {
                $this->Flash->success(__('The offer code has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The offer code could not be saved. Please, try again.'));
        }
        $this->set(compact('offerCode'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Offer Code id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $offerCode = $this->OfferCodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $offerCode = $this->OfferCodes->patchEntity($offerCode, $this->request->getData());
            if ($this->OfferCodes->save($offerCode)) {
                $this->Flash->success(__('The offer code has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The offer code could not be saved. Please, try again.'));
        }
        $this->set(compact('offerCode'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Offer Code id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $offerCode = $this->OfferCodes->get($id);
        if ($this->OfferCodes->delete($offerCode)) {
            $this->Flash->success(__('The offer code has been deleted.'));
        } else {
            $this->Flash->error(__('The offer code could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
