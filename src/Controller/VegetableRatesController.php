<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VegetableRates Controller
 *
 * @property \App\Model\Table\VegetableRatesTable $VegetableRates
 *
 * @method \App\Model\Entity\VegetableRate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VegetableRatesController extends AppController
{


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $month = $this->request->query('month');
        $month1 = explode('-', $month);
        $this->viewBuilder()->layout('admin');

        $Vegetables = $this->VegetableRates->Vegetables->find()->order(['name'=>'ASC']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $rates = $this->request->data()['rate'];
            
            //Delete VegetableRecords
            $this->VegetableRates->deleteAll([ 'month' => $month1[0], 'year' => $month1[1] ]);

            foreach ($rates as $vegetable_id => $rate) {
                $VegetableRate = $this->VegetableRates->newEntity();
                $VegetableRate->vegetable_id = $vegetable_id;
                $VegetableRate->rate = $rate;
                $VegetableRate->month = $month1[0];
                $VegetableRate->year = $month1[1];
                $this->VegetableRates->save($VegetableRate);
            }
        }

        $VegetableRates = $this->VegetableRates->find()->where([ 'month' => $month1[0], 'year' => $month1[1] ]);
        $data=[];
        foreach ($VegetableRates as $VegetableRate) {
            $data[$VegetableRate->vegetable_id]=$VegetableRate->rate;
        }

        

        $this->set(compact('Vegetables', 'month', 'data'));
    }

    /**
     * View method
     *
     * @param string|null $id Vegetable Rate id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vegetableRate = $this->VegetableRates->get($id, [
            'contain' => ['Vegetables']
        ]);

        $this->set('vegetableRate', $vegetableRate);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vegetableRate = $this->VegetableRates->newEntity();
        if ($this->request->is('post')) {
            $vegetableRate = $this->VegetableRates->patchEntity($vegetableRate, $this->request->getData());
            if ($this->VegetableRates->save($vegetableRate)) {
                $this->Flash->success(__('The vegetable rate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vegetable rate could not be saved. Please, try again.'));
        }
        $vegetables = $this->VegetableRates->Vegetables->find('list', ['limit' => 200]);
        $this->set(compact('vegetableRate', 'vegetables'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vegetable Rate id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vegetableRate = $this->VegetableRates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vegetableRate = $this->VegetableRates->patchEntity($vegetableRate, $this->request->getData());
            if ($this->VegetableRates->save($vegetableRate)) {
                $this->Flash->success(__('The vegetable rate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vegetable rate could not be saved. Please, try again.'));
        }
        $vegetables = $this->VegetableRates->Vegetables->find('list', ['limit' => 200]);
        $this->set(compact('vegetableRate', 'vegetables'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vegetable Rate id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vegetableRate = $this->VegetableRates->get($id);
        if ($this->VegetableRates->delete($vegetableRate)) {
            $this->Flash->success(__('The vegetable rate has been deleted.'));
        } else {
            $this->Flash->error(__('The vegetable rate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
