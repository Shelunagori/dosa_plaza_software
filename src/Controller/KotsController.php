<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Kots Controller
 *
 * @property \App\Model\Table\KotsTable $Kots
 *
 * @method \App\Model\Entity\Kot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class KotsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tables']
        ];
        $kots = $this->paginate($this->Kots);

        $this->set(compact('kots'));
    }

    /**
     * View method
     *
     * @param string|null $id Kot id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $kot = $this->Kots->get($id, [
            'contain' => ['Tables', 'KotRows']
        ]);

        $this->set('kot', $kot);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$myJSON=$this->request->query('myJSON');
		$table_id=$this->request->query('table_id');
		$q = json_decode($myJSON, true);
		/* foreach($q as $row){
			pr($row['item_id']);
		}
		exit; */
        $kot = $this->Kots->newEntity();
			
		$last_voucher_no=$this->Kots->find()->select(['voucher_no'])->order(['id' => 'DESC'])->first();
		if($last_voucher_no){
			$kot->voucher_no=$last_voucher_no->voucher_no+1;
		}else{
			$kot->voucher_no=1;
		}
			
		$kot->table_id=1;
		$kot->table_id=$table_id;
		if ($this->Kots->save($kot)) {
			$this->Flash->success(__('The kot has been saved.'));

			return $this->redirect(['action' => 'index']);
		}
		$this->Flash->error(__('The kot could not be saved. Please, try again.'));
        $tables = $this->Kots->Tables->find('list', ['limit' => 200]);
        $this->set(compact('kot', 'tables'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Kot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $kot = $this->Kots->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $kot = $this->Kots->patchEntity($kot, $this->request->getData());
            if ($this->Kots->save($kot)) {
                $this->Flash->success(__('The kot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kot could not be saved. Please, try again.'));
        }
        $tables = $this->Kots->Tables->find('list', ['limit' => 200]);
        $this->set(compact('kot', 'tables'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Kot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $kot = $this->Kots->get($id);
        if ($this->Kots->delete($kot)) {
            $this->Flash->success(__('The kot has been deleted.'));
        } else {
            $this->Flash->error(__('The kot could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
