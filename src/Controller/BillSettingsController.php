<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BillSettings Controller
 *
 * @property \App\Model\Table\BillSettingsTable $BillSettings
 *
 * @method \App\Model\Entity\BillSetting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BillSettingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $query = $this->BillSettings->query();
            $query->update()
                ->set([
                    'header' => $data['header'],
                    'footer' => $data['footer']
                ])
                ->where(['id' => 1])
                ->execute();
        }

        $BillSetting = $this->BillSettings->get(1);

        $this->set(compact('billSettings', 'BillSetting'));
    }

    /**
     * View method
     *
     * @param string|null $id Bill Setting id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $billSetting = $this->BillSettings->get($id, [
            'contain' => []
        ]);

        $this->set('billSetting', $billSetting);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $billSetting = $this->BillSettings->newEntity();
        if ($this->request->is('post')) {
            $billSetting = $this->BillSettings->patchEntity($billSetting, $this->request->getData());
            if ($this->BillSettings->save($billSetting)) {
                $this->Flash->success(__('The bill setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bill setting could not be saved. Please, try again.'));
        }
        $this->set(compact('billSetting'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bill Setting id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $billSetting = $this->BillSettings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $billSetting = $this->BillSettings->patchEntity($billSetting, $this->request->getData());
            if ($this->BillSettings->save($billSetting)) {
                $this->Flash->success(__('The bill setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bill setting could not be saved. Please, try again.'));
        }
        $this->set(compact('billSetting'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bill Setting id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $billSetting = $this->BillSettings->get($id);
        if ($this->BillSettings->delete($billSetting)) {
            $this->Flash->success(__('The bill setting has been deleted.'));
        } else {
            $this->Flash->error(__('The bill setting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
