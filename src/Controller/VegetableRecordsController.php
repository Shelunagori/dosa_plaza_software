<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VegetableRecords Controller
 *
 * @property \App\Model\Table\VegetableRecordsTable $VegetableRecords
 *
 * @method \App\Model\Entity\VegetableRecord[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VegetableRecordsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin');

        $month = $this->request->query('month');
        $month1 = explode('-', $month);

        $firstDate = $month1[1].'-'.$month1[0].'-1';
        $lastDate = date("Y-m-t", strtotime($firstDate));

        if ($this->request->is(['patch', 'post', 'put'])) {

            $vegetables = $this->request->data['vegetable'];
            $quantitys = $this->request->data['quantity'];
            $amounts = $this->request->data['amount'];
            $vendor_amounts = $this->request->data['vendor_amount'];
            //pr($vendor_amounts); exit();
            foreach ($vegetables as $vegetable_id) {
                foreach ($amounts[$vegetable_id] as $tdate => $amount) {
                    //Delete VegetableRecords
                    $this->VegetableRecords->deleteAll(['transaction_date' => date('Y-m-d', $tdate), 'vegetable_id' => $vegetable_id]);

                    if($amount>0){
                        $VegetableRecord = $this->VegetableRecords->newEntity();
                        $VegetableRecord->vegetable_id = $vegetable_id;
                        $VegetableRecord->transaction_date = date('Y-m-d', $tdate);
                        $VegetableRecord->quantity = $quantitys[$vegetable_id][$tdate];
                        $VegetableRecord->amount = $amount;
                        $this->VegetableRecords->save($VegetableRecord);
                    }
                }

                foreach ($vendor_amounts as $tdate => $vendor_amount) {
                    $VendorAmount = $this->VegetableRecords->VendorAmounts->newEntity();
                    $VendorAmount->transaction_date = date('Y-m-d', $tdate);
                    $VendorAmount->amount = $vendor_amount;
                    $this->VegetableRecords->VendorAmounts->save($VendorAmount);
                }
            }
        }

        $Vegetables = $this->VegetableRecords->Vegetables->find()->contain([
            'VegetableRates' => function($q) use($month1){
                return $q->where(['VegetableRates.month' => $month1[0], 'VegetableRates.year' => $month1[1] ]);
            }
            ])
        ->order(['Vegetables.name' => 'ASC']);

        $VegetableRecords = $this->VegetableRecords->find()->where(['transaction_date >=' => $firstDate, 'transaction_date <=' => $lastDate]);

        $data=[]; $data2=[];
        foreach ($VegetableRecords as $VegetableRecord) {
            $data[$VegetableRecord->vegetable_id][strtotime($VegetableRecord->transaction_date)] = $VegetableRecord->amount;
            $data2[$VegetableRecord->vegetable_id][strtotime($VegetableRecord->transaction_date)] = $VegetableRecord->quantity;
        }

        $VendorAmounts=$this->VegetableRecords->VendorAmounts->find()->where(['transaction_date >=' => $firstDate, 'transaction_date <=' => $lastDate]);
        $VendorData=[];
        foreach ($VendorAmounts as $VendorAmount) {
            $VendorData[strtotime($VendorAmount->transaction_date)] = $VendorAmount->amount;
        }

        $this->set(compact('Vegetables', 'month', 'month1', 'data', 'data2', 'VendorData'));
    }

    /**
     * View method
     *
     * @param string|null $id Vegetable Record id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vegetableRecord = $this->VegetableRecords->get($id, [
            'contain' => []
        ]);

        $this->set('vegetableRecord', $vegetableRecord);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vegetableRecord = $this->VegetableRecords->newEntity();
        if ($this->request->is('post')) {
            $vegetableRecord = $this->VegetableRecords->patchEntity($vegetableRecord, $this->request->getData());
            if ($this->VegetableRecords->save($vegetableRecord)) {
                $this->Flash->success(__('The vegetable record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vegetable record could not be saved. Please, try again.'));
        }
        $this->set(compact('vegetableRecord'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vegetable Record id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vegetableRecord = $this->VegetableRecords->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vegetableRecord = $this->VegetableRecords->patchEntity($vegetableRecord, $this->request->getData());
            if ($this->VegetableRecords->save($vegetableRecord)) {
                $this->Flash->success(__('The vegetable record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vegetable record could not be saved. Please, try again.'));
        }
        $this->set(compact('vegetableRecord'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vegetable Record id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vegetableRecord = $this->VegetableRecords->get($id);
        if ($this->VegetableRecords->delete($vegetableRecord)) {
            $this->Flash->success(__('The vegetable record has been deleted.'));
        } else {
            $this->Flash->error(__('The vegetable record could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
