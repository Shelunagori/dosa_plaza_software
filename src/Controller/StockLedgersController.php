<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StockLedgers Controller
 *
 * @property \App\Model\Table\StockLedgersTable $StockLedgers
 *
 * @method \App\Model\Entity\StockLedger[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StockLedgersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RawMaterials']
        ];
        $stockLedgers = $this->paginate($this->StockLedgers);

        $this->set(compact('stockLedgers'));
    }

    /**
     * View method
     *
     * @param string|null $id Stock Ledger id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockLedger = $this->StockLedgers->get($id, [
            'contain' => ['RawMaterials']
        ]);

        $this->set('stockLedger', $stockLedger);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stockLedger = $this->StockLedgers->newEntity();
        if ($this->request->is('post')) {
            $stockLedger = $this->StockLedgers->patchEntity($stockLedger, $this->request->getData());
            if ($this->StockLedgers->save($stockLedger)) {
                $this->Flash->success(__('The stock ledger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock ledger could not be saved. Please, try again.'));
        }
        $rawMaterials = $this->StockLedgers->RawMaterials->find('list', ['limit' => 200]);
        $this->set(compact('stockLedger', 'rawMaterials'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock Ledger id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stockLedger = $this->StockLedgers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockLedger = $this->StockLedgers->patchEntity($stockLedger, $this->request->getData());
            if ($this->StockLedgers->save($stockLedger)) {
                $this->Flash->success(__('The stock ledger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock ledger could not be saved. Please, try again.'));
        }
        $rawMaterials = $this->StockLedgers->RawMaterials->find('list', ['limit' => 200]);
        $this->set(compact('stockLedger', 'rawMaterials'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stock Ledger id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockLedger = $this->StockLedgers->get($id);
        if ($this->StockLedgers->delete($stockLedger)) {
            $this->Flash->success(__('The stock ledger has been deleted.'));
        } else {
            $this->Flash->error(__('The stock ledger could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function userlog(){
        $this->viewBuilder()->layout('admin');
        $from_date=$this->request->query('from_date');
        $from_date=date('Y-m-d', strtotime($from_date));
        $to_date=$this->request->query('to_date');
        $to_date=date('Y-m-d', strtotime($to_date));
        $rm_id=$this->request->query('rm_id');

        $StockLedgers=$this->StockLedgers->find()->Where(['transaction_date >='=>$from_date, 'transaction_date <='=>$to_date,'raw_material_id'=>$rm_id,'quantity !='=>0,'voucher_name'=>'stock adjustment'])->order(['transaction_date'=>'ASC'])->contain(['Users']);
        $this->set(compact('StockLedgers'));
    }
}
