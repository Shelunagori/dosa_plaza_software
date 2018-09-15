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

        // $date=$this->request->query('date');
        // $date1=date('Y-m-d', strtotime($date));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $date = date('Y-m-d', strtotime($this->request->data['date']));

            //Delete Attendance
            $this->InventoryRecords->deleteAll(['transaction_date' => $date]);

            $projections = $this->request->data['projection'];
            $malls = $this->request->data['mall'];
            $roads = $this->request->data['road'];
            $closing_balances = $this->request->data['closing_balance'];
            $item_lists = $this->request->data['item_list'];

            foreach ($projections as $key => $projection) {
                $inventoryRecord = $this->InventoryRecords->newEntity();
                $inventoryRecord->transaction_date = $date;
                $inventoryRecord->item_list_id = $item_lists[$key];
                $inventoryRecord->projection = $projections[$key];
                $inventoryRecord->mall = $malls[$key];
                $inventoryRecord->road = $roads[$key];
                $inventoryRecord->closing_balance = $closing_balances[$key];
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
            $TodayOBData[$TodayInventoryRecord->item_list->id]['mall']=$TodayInventoryRecord->mall;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['road']=$TodayInventoryRecord->road;
            $TodayOBData[$TodayInventoryRecord->item_list->id]['closing_balance']=$TodayInventoryRecord->closing_balance;
        }



        $ItemLists = $this->InventoryRecords->ItemLists->find();
        $this->set(compact('date', 'ItemLists', 'OBData', 'TodayOBData'));
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
    public function edit($id = null)
    {
        $inventoryRecord = $this->InventoryRecords->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
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
