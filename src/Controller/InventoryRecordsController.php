<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InventoryRecords Controller
 *
 * @property \App\Model\Table\InventoryRecordsTable $InventoryRecords
 *
 * @method \App\Model\Entity\InventoryRecord[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InventoryRecordsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin');

        $date_from=$this->request->query('date_from');
        $date_from1=date('Y-m-d', strtotime($date_from));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $date = date('Y-m-d', strtotime($this->request->data['date']));

            //Delete Attendance
            $this->InventoryRecords->deleteAll(['transaction_date' => $date]);

            $projections = $this->request->data['projection'];
            $adjustments = $this->request->data['adjustment'];
            $malls = $this->request->data['mall'];
            $roads = $this->request->data['road'];
            $wastages = $this->request->data['wastage'];
            $closing_balances = $this->request->data['closing_balance'];
            $consumptions = $this->request->data['consumption'];
            $item_lists = $this->request->data['item_list'];

            foreach ($projections as $key => $projection) {
                $inventoryRecord = $this->InventoryRecords->newEntity();
                $inventoryRecord->transaction_date = $date;
                $inventoryRecord->item_list_id = $item_lists[$key];
                $inventoryRecord->projection = $projections[$key];
                $inventoryRecord->adjustment = $adjustments[$key];
                $inventoryRecord->mall = $malls[$key];
                $inventoryRecord->road = $roads[$key];
                $inventoryRecord->wastage = $wastages[$key];
                $inventoryRecord->closing_balance = $closing_balances[$key];
                $inventoryRecord->consumption = $consumptions[$key];
                $this->InventoryRecords->save($inventoryRecord);
            }
        }


        $currentDate = date('Y-m-d');
        $OldInventoryRecords = $this->InventoryRecords->find()
                                ->where(['transaction_date' => date('Y-m-d', strtotime('-1 day', strtotime($currentDate))) ])
                                ->contain(['ItemLists']);
       
        $OBData=[];
        foreach ($OldInventoryRecords as $OldInventoryRecord) {
            $OBData[$OldInventoryRecord->item_list->id]=$OldInventoryRecord->closing_balance;
        }

        $TodayInventoryRecords = $this->InventoryRecords->find()
                                ->where(['transaction_date' => $currentDate ])
                                ->contain(['ItemLists']);
        $TodayOBData=[];
        foreach ($TodayInventoryRecords as $TodayInventoryRecord) {
            $TodayOBData[$TodayInventoryRecord->item_list->id]['projection']=$TodayInventoryRecord->projection;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['adjustment']=$TodayInventoryRecord->adjustment;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['mall']=$TodayInventoryRecord->mall;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['road']=$TodayInventoryRecord->road;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['wastage']=$TodayInventoryRecord->wastage;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['closing_balance']=$TodayInventoryRecord->closing_balance;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['consumption']=$TodayInventoryRecord->consumption;
        }

        $OldInventoryRecords = $this->InventoryRecords->find()
                                ->where(['transaction_date >=' => $date_from1, 'transaction_date <' => $currentDate])
                                ->order(['transaction_date'=>'ASC'])
                                ->contain(['ItemLists']);
        
        $OldData=[];
        foreach ($OldInventoryRecords as $OldInventoryRecord) {
            $OldData[strtotime($OldInventoryRecord->transaction_date)][$OldInventoryRecord->item_list->id]['projection']=$OldInventoryRecord->projection;

            $OldData[strtotime($OldInventoryRecord->transaction_date)][$OldInventoryRecord->item_list->id]['adjustment']=$OldInventoryRecord->adjustment;

            $OldData[strtotime($OldInventoryRecord->transaction_date)][$OldInventoryRecord->item_list->id]['mall']=$OldInventoryRecord->mall;

            $OldData[strtotime($OldInventoryRecord->transaction_date)][$OldInventoryRecord->item_list->id]['road']=$OldInventoryRecord->road;
            
            $OldData[strtotime($OldInventoryRecord->transaction_date)][$OldInventoryRecord->item_list->id]['wastage']=$OldInventoryRecord->wastage;

            $OldData[strtotime($OldInventoryRecord->transaction_date)][$OldInventoryRecord->item_list->id]['closing_balance']=$OldInventoryRecord->closing_balance;

            $OldData[strtotime($OldInventoryRecord->transaction_date)][$OldInventoryRecord->item_list->id]['consumption']=$OldInventoryRecord->consumption;
        }



        $ItemLists = $this->InventoryRecords->ItemLists->find();
        $this->set(compact('date_from', 'ItemLists', 'OBData', 'TodayOBData', 'OldData'));
    }

    public function edit($tdate){
        $this->viewBuilder()->layout('admin');

        $t_date = date('Y-m-d', ($tdate));

        if ($this->request->is(['patch', 'post', 'put'])) {

            //Delete Attendance
            $this->InventoryRecords->deleteAll(['transaction_date' => $t_date]);
            $projections = $this->request->data['projection'];
            $adjustments = $this->request->data['adjustment'];
            $malls = $this->request->data['mall'];
            $roads = $this->request->data['road'];
            $wastages = $this->request->data['wastage'];
            $closing_balances = $this->request->data['closing_balance'];
            $consumptions = $this->request->data['consumption'];
            $item_lists = $this->request->data['item_list'];

            foreach ($projections as $key => $projection) {
                $inventoryRecord = $this->InventoryRecords->newEntity();
                $inventoryRecord->transaction_date = $t_date;
                $inventoryRecord->item_list_id = $item_lists[$key];
                $inventoryRecord->projection = $projections[$key];
                $inventoryRecord->adjustment = $adjustments[$key];
                $inventoryRecord->mall = $malls[$key];
                $inventoryRecord->road = $roads[$key];
                $inventoryRecord->wastage = $wastages[$key];
                $inventoryRecord->closing_balance = $closing_balances[$key];
                $inventoryRecord->consumption = $consumptions[$key];
                $this->InventoryRecords->save($inventoryRecord);
            }

            $OldInventoryRecords = $this->InventoryRecords->find()
                                    ->where(['transaction_date' => date('Y-m-d', strtotime('-1 day', strtotime($t_date))) ]);
           
            $OBData2=[];
            foreach ($OldInventoryRecords as $OldInventoryRecord) {
                $OBData2[$OldInventoryRecord->item_list_id]=$OldInventoryRecord->closing_balance;
            }

            $InventoryRecords=$this->InventoryRecords->find()->where(['transaction_date >' => $t_date])->order(['transaction_date' => 'ASC']);
            foreach ($InventoryRecords as $InventoryRecord) {
                $IR=$this->InventoryRecords->get($InventoryRecord->id);

                $OldInventoryRecord = $this->InventoryRecords->find()
                                    ->where([
                                        'transaction_date' => date('Y-m-d', strtotime('-1 day', strtotime($InventoryRecord->transaction_date))),
                                        'item_list_id' => $InventoryRecord->item_list_id
                                    ])->first();
                $OB=$OldInventoryRecord->closing_balance;

                $CB=$OB+$IR->projection+$IR->adjustment-$IR->mall-$IR->road-$IR->wastage-$IR->consumption;

                $IR->closing_balance=$CB;
                $this->InventoryRecords->save($IR);
            }

            return $this->redirect(['action' => 'index']);
        }

        $OldInventoryRecords = $this->InventoryRecords->find()
                                ->where(['transaction_date' => date('Y-m-d', strtotime('-1 day', strtotime($t_date))) ])
                                ->contain(['ItemLists']);
       
        $OBData=[];
        foreach ($OldInventoryRecords as $OldInventoryRecord) {
            $OBData[$OldInventoryRecord->item_list->id]=$OldInventoryRecord->closing_balance;
        }

        $TodayInventoryRecords = $this->InventoryRecords->find()
                                ->where(['transaction_date' => $t_date ])
                                ->contain(['ItemLists']);
        $TodayOBData=[];
        foreach ($TodayInventoryRecords as $TodayInventoryRecord) {
            $TodayOBData[$TodayInventoryRecord->item_list->id]['projection']=$TodayInventoryRecord->projection;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['adjustment']=$TodayInventoryRecord->adjustment;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['mall']=$TodayInventoryRecord->mall;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['road']=$TodayInventoryRecord->road;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['wastage']=$TodayInventoryRecord->wastage;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['closing_balance']=$TodayInventoryRecord->closing_balance;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['consumption']=$TodayInventoryRecord->consumption;
        }

        $ItemLists = $this->InventoryRecords->ItemLists->find();
        $this->set(compact('t_date', 'ItemLists', 'OBData', 'TodayOBData'));
    }

    public function report(){
        $this->viewBuilder()->layout('admin');

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));

        $openingInventoryRecords = $this->InventoryRecords->find()
                            ->where(['InventoryRecords.transaction_date' => date('Y-m-d', strtotime('-1 day', strtotime($from_date))) ]);
        $openingData=[];
        foreach ($openingInventoryRecords as $openingInventoryRecord) {
            $openingData[$openingInventoryRecord->item_list_id] = $openingInventoryRecord->closing_balance;
        }

        $InventoryRecords = $this->InventoryRecords->find();
        $InventoryRecords->select([
            'total_projection' => $InventoryRecords->func()->sum('InventoryRecords.projection'),
            'total_adjustment' => $InventoryRecords->func()->sum('InventoryRecords.adjustment'),
            'total_mall' => $InventoryRecords->func()->sum('InventoryRecords.mall'),
            'total_road' => $InventoryRecords->func()->sum('InventoryRecords.road'),
            'total_wastage' => $InventoryRecords->func()->sum('InventoryRecords.wastage'),
            'total_consumption' => $InventoryRecords->func()->sum('InventoryRecords.consumption')
        ])
        ->where([
            'InventoryRecords.transaction_date >=' => $from_date,
            'InventoryRecords.transaction_date <=' => $to_date
        ])
        ->contain(['ItemLists'])
        ->group(['item_list_id'])
        ->autoFields(true);
        //pr($InventoryRecords->toArray()); exit;

        $this->set(compact('exploded_date_from_to', 'InventoryRecords', 'from_date', 'to_date', 'openingData'));
    }

    /**
     * View method
     *
     * @param string|null $id Inventory Record id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inventoryRecord = $this->InventoryRecords->get($id, [
            'contain' => ['ItemLists']
        ]);

        $this->set('inventoryRecord', $inventoryRecord);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inventoryRecord = $this->InventoryRecords->newEntity();
        if ($this->request->is('post')) {
            $inventoryRecord = $this->InventoryRecords->patchEntity($inventoryRecord, $this->request->getData());
            if ($this->InventoryRecords->save($inventoryRecord)) {
                $this->Flash->success(__('The inventory record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory record could not be saved. Please, try again.'));
        }
        $itemLists = $this->InventoryRecords->ItemLists->find('list', ['limit' => 200]);
        $this->set(compact('inventoryRecord', 'itemLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Inventory Record id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
   

    /**
     * Delete method
     *
     * @param string|null $id Inventory Record id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inventoryRecord = $this->InventoryRecords->get($id);
        if ($this->InventoryRecords->delete($inventoryRecord)) {
            $this->Flash->success(__('The inventory record has been deleted.'));
        } else {
            $this->Flash->error(__('The inventory record could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
