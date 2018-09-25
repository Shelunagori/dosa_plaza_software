<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ManualStocks Controller
 *
 * @property \App\Model\Table\ManualStocksTable $ManualStocks
 *
 * @method \App\Model\Entity\ManualStock[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ManualStocksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin');

        $date = date('Y-m-d');

        if ($this->request->is(['patch', 'post', 'put'])) {
            
            //Delete Attendance
            $this->ManualStocks->deleteAll(['transaction_date' => $date]);

            $physicals = $this->request->data['physical'];

            foreach ($physicals as $key => $physical) {
                $ManualStock = $this->ManualStocks->newEntity();
                $ManualStock->transaction_date = $date;
                $ManualStock->raw_material_id = $key;
                $ManualStock->physical = $physical;
                $this->ManualStocks->save($ManualStock);
            }
        }

        $data=[];
        $ManualStocks = $this->ManualStocks->find()->where(['ManualStocks.transaction_date' => $date]);
        foreach ($ManualStocks as $ManualStock) {
            $data[$ManualStock->raw_material_id] = $ManualStock->physical;
        }
        
        
        $q=$this->ManualStocks->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'in']);
        $q->select([$q->func()->sum('StockLedgers.quantity')]);
        
        $q2=$this->ManualStocks->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'out']);
        $q2->select([$q2->func()->sum('StockLedgers.quantity')]);

        $q3=$this->ManualStocks->RawMaterials->StockLedgers->find()
            ->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'in', 'StockLedgers.purchase_voucher_id >' => '0'])
            ->order(['StockLedgers.transaction_date' => 'DESC'])
            ->limit(1);
        $q3->select(['StockLedgers.transaction_date']);
        
        $RawMaterials = $this->ManualStocks->RawMaterials->find();
        $RawMaterials->select([
            'total_in' => $q,
            'total_out' => $q2,
            'last_purchase' => $q3
        ])
        ->contain(['PrimaryUnits', 'RawMaterialSubCategories'])
        ->where(['RawMaterials.is_deleted'=>0])
        ->order(['RawMaterialSubCategories.Name' => 'ASC'])
        ->autoFields(true);

        $this->set(compact('RawMaterials', 'data'));
    }

    /**
     * View method
     *
     * @param string|null $id Manual Stock id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $manualStock = $this->ManualStocks->get($id, [
            'contain' => ['RawMaterials']
        ]);

        $this->set('manualStock', $manualStock);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $manualStock = $this->ManualStocks->newEntity();
        if ($this->request->is('post')) {
            $manualStock = $this->ManualStocks->patchEntity($manualStock, $this->request->getData());
            if ($this->ManualStocks->save($manualStock)) {
                $this->Flash->success(__('The manual stock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The manual stock could not be saved. Please, try again.'));
        }
        $rawMaterials = $this->ManualStocks->RawMaterials->find('list', ['limit' => 200]);
        $this->set(compact('manualStock', 'rawMaterials'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Manual Stock id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $manualStock = $this->ManualStocks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $manualStock = $this->ManualStocks->patchEntity($manualStock, $this->request->getData());
            if ($this->ManualStocks->save($manualStock)) {
                $this->Flash->success(__('The manual stock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The manual stock could not be saved. Please, try again.'));
        }
        $rawMaterials = $this->ManualStocks->RawMaterials->find('list', ['limit' => 200]);
        $this->set(compact('manualStock', 'rawMaterials'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Manual Stock id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $manualStock = $this->ManualStocks->get($id);
        if ($this->ManualStocks->delete($manualStock)) {
            $this->Flash->success(__('The manual stock has been deleted.'));
        } else {
            $this->Flash->error(__('The manual stock could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
