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
        $employee_id = $this->Auth->User('employee_id'); 
        $designation_id = $this->Auth->User('employee.designation_id');

        $date = date('Y-m-d');
        $fromDate=date('Y-m-d', strtotime('-10 day', strtotime($date)));
        $toDate=date('Y-m-d', strtotime('-1 day', strtotime($date)));
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            //Delete Attendance
            $this->ManualStocks->deleteAll(['transaction_date' => $date]);

            $physicals = $this->request->data['physical'];
            $old_physicals = $this->request->data['old_physical'];
            
            foreach ($old_physicals as $tdate => $value) {
                foreach ($value as $rm_id => $qty) {
                    $ManualStock = $this->ManualStocks->newEntity();
                    $ManualStock->transaction_date = date('Y-m-d', $tdate);
                    $ManualStock->raw_material_id = $rm_id;
                    $ManualStock->physical = $qty;
                    $this->ManualStocks->save($ManualStock);
                }
            }

            foreach ($physicals as $key => $physical) {
                $ManualStock = $this->ManualStocks->newEntity();
                $ManualStock->transaction_date = $date;
                $ManualStock->raw_material_id = $key;
                $ManualStock->physical = $physical;
                $this->ManualStocks->save($ManualStock);
            }
        }


        $data=[]; $RawMaterials=[];

		$ManualStocks = $this->ManualStocks->find()->where(['ManualStocks.transaction_date' => $date]);
		foreach ($ManualStocks as $ManualStock) {
			$data[$ManualStock->raw_material_id] = $ManualStock->physical;
		}			
		
        $start_date=$fromDate;
        $end_date=$toDate;
        while (strtotime($start_date) <= strtotime($end_date)) {
            $in[strtotime($start_date)]=$this->ManualStocks->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'in', 'StockLedgers.transaction_date <=' => date('Y-m-d', strtotime($start_date)) ]);
            $in[strtotime($start_date)]->select([$in[strtotime($start_date)]->func()->sum('StockLedgers.quantity')]);
            $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
        }

        

		$q=$this->ManualStocks->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'in']);
		$q->select([$q->func()->sum('StockLedgers.quantity')]);
		
		$q2=$this->ManualStocks->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'out']);
		$q2->select([$q2->func()->sum('StockLedgers.quantity')]);
		
        $select=[];
        $select['total_in'] = $q;
        $select['total_out'] = $q2;

        $start_date=$fromDate;
        $end_date=$toDate;
        while (strtotime($start_date) <= strtotime($end_date)) {
            $select['total_in'.strtotime($start_date)] = $in[strtotime($start_date)];

            $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
        }
        

		$RawMaterials = $this->ManualStocks->RawMaterials->find();
		$RawMaterials->select($select)
		->contain(['PrimaryUnits', 'RawMaterialSubCategories'])
		->where(['RawMaterials.is_deleted'=>0])
		->order(['RawMaterialSubCategories.Name' => 'ASC'])
		->autoFields(true);

        //pr($RawMaterials->toArray()); exit();

        $OldComputerData=[];
        foreach ($RawMaterials as $RawMaterial) {
            $start_date=$fromDate;
            $end_date=$toDate;
            while (strtotime($start_date) <= strtotime($end_date)) {
                //$in = 'total_in'.strtotime($start_date);
                if($RawMaterial->total_in){
                    $OldComputerData[strtotime($start_date)][$RawMaterial->id] = $RawMaterial->toArray()['total_in'.strtotime($start_date)];
                }
                
                $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
            }
        }
        //pr($OldComputerData); exit();

         
        //$designation_id=2;
		
        $ManualStocks = $this->ManualStocks->find()->where(['transaction_date >=' => $fromDate, 'transaction_date <=' => $toDate]);
        $OldPhysical=[];
        foreach ($ManualStocks as $ManualStock) {
            $OldPhysical[strtotime($ManualStock->transaction_date)][$ManualStock->raw_material_id] = $ManualStock->physical;
        }

        $this->set(compact('RawMaterials', 'data','designation_id','date', 'fromDate', 'toDate', 'OldPhysical', 'OldComputerData', 'designation_id'));
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
