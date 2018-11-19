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
    public function index($id=null)
    {
        $this->viewBuilder()->layout('admin');
        $offerCode = $this->OfferCodes->newEntity();
        
        if ($this->request->is('post')) {
            $offerCode = $this->OfferCodes->patchEntity($offerCode, $this->request->getData());
            if ($this->OfferCodes->save($offerCode)) {
                $this->Flash->success(__('The offer code has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The offer code could not be saved. Please, try again.'));
        }

        $offerCodes = $this->OfferCodes->find()->order(['OfferCodes.is_enabled' => 'DESC']);

        $this->set(compact('offerCodes', 'offerCode', 'id'));
    }

    /**
     * View method
     *
     * @param string|null $id Offer Code id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function disable($id = null)
    {
        $offerCode = $this->OfferCodes->get($id);
        $offerCode->is_enabled=0;
        $this->OfferCodes->save($offerCode);
        $this->Flash->success(__('The offer code has been disabled.'));
        return $this->redirect(['action' => 'index']);
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
    public function checkOffer()
    {
        $this->viewBuilder()->layout('');
        $offer_code=$this->request->query('offer_code');

        $OfferCode=$this->OfferCodes->find()->Where(['OfferCodes.offer_code' => $offer_code, 'OfferCodes.is_enabled' => 1])->first();
        if($OfferCode){
            $Response=['valid'=>'yes', 'per'=>$OfferCode->discount_per, 'offer_id'=>$OfferCode->id];
        }else{
            $Response=['valid'=>'no'];
        }
        
        echo json_encode($Response);
        exit;
    }
}
