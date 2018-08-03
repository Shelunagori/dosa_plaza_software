<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tables Controller
 *
 * @property \App\Model\Table\TablesTable $Tables
 *
 * @method \App\Model\Entity\Table[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TablesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('counter');
        $q = $this->Tables->Kots->KotRows->find();
        $q->select([$q->func()->sum('KotRows.amount')]);
        $Kots = $this->Tables->Kots->find()
                ->select(['kot_amout' => $q->where(['KotRows.kot_id = Kots.id'])])
                ->where(['Kots.bill_pending' => 'yes'])
                ->autoFields(true);
        $tableWiseAmount=array(); 
        $tAmount=array(); 
         foreach ($Kots as $value) {
            $table_id=$value->table_id;
            $kot_amout=$value->kot_amout;
             $tableWiseAmount[$table_id][]=$kot_amout;
        } 
        $Tables=$this->Tables->find();     
        $Employees = $this->Tables->Employees->find('list')->where(['Employees.is_deleted'=>0]);
        $this->set(compact('Tables', 'Employees','tableWiseAmount'));
    }

    public function saveTable()
    {
        $this->viewBuilder()->layout('');
        
        $c_name=$this->request->query('c_name');
        $c_mobile=$this->request->query('c_mobile');
        $c_pax=$this->request->query('c_pax');
        $table_id=$this->request->query('table_id');
        $Table=$this->Tables->get($table_id);
        $Table->status='occupied';
        $Table->c_name=$c_name;
        $Table->c_mobile=$c_mobile;
        $Table->no_of_pax=$c_pax;
        $Table->occupied_time=date( "Y-m-d H:i:s" );
        if($this->Tables->save($Table)){
            echo '1';
        }else{
            echo '0';
        }
        exit;
    }

    public function saveCustomer()
    {
        $this->viewBuilder()->layout('');

        $table_id=$this->request->query('table_id');
        
        $Table=$this->Tables->get($table_id);
        
        $Table->c_name=$this->request->query('c_name');
        $Table->c_mobile=$this->request->query('c_mobile_no');
        $Table->no_of_pax=$this->request->query('c_pax');
        $Table->dob=$this->request->query('dob');
        $Table->doa=$this->request->query('doa');
        $Table->email=$this->request->query('c_email');
        $Table->c_address=$this->request->query('c_address');
        if($this->Tables->save($Table)){
            echo '1';
        }else{
            echo '0';
        }
        exit;
    }

    public function saveSteward()
    {
        $this->viewBuilder()->layout('');
        $table_id=$this->request->query('table_id');
        $steward_id=$table_id=$this->request->query('steward_id');

        $Table=$this->Tables->get($table_id);
        $Table->employee_id=$steward_id;
        if($this->Tables->save($Table)){
            echo '1';
        }else{
            echo '0';
        }
        exit;
    }

    /**
     * View method
     *
     * @param string|null $id Table id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('admin');
        $table = $this->Tables->get($id, [
            'contain' => []
        ]);

        $this->set('table', $table);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
		$this->viewBuilder()->layout('admin');
		if(!$id)
		{				
			$Table = $this->Tables->newEntity();
		}
		else
		{
			$Table = $this->Tables->get($id, [ 
				'contain' => []
			]);
		} 
        if ($this->request->is(['patch','post','put'])) {
            $Table = $this->Tables->patchEntity($Table, $this->request->getData());
            if ($this->Tables->save($Table)) {
                $this->Flash->success(__('The Table has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The Table could not be saved. Please, try again.'));
        }
		$Tables = $this->paginate($this->Tables->find());
        $this->set(compact('Table','Tables','id'));
    }
	/**
     * Edit method
     *
     * @param string|null $id Table id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('admin');
        $table = $this->Tables->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $table = $this->Tables->patchEntity($table, $this->request->getData());
            if ($this->Tables->save($table)) {
                $this->Flash->success(__('The table has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The table could not be saved. Please, try again.'));
        }
        $this->set(compact('table'));
    }

    public function customer($id = null,$search_code=null,$search_mobile=null,$searchbox=null)
    {
        $this->viewBuilder()->layout('');
        $searchBy=array();
        $searchbox=0;
        if(!empty($search_mobile) || !empty($search_code))
        {
            $searchBy=$this->Tables->Customers->find()
                 ->where(['OR' => array(
                            array("Customers.mobile_no" => $search_mobile),
                            array("Customers.customer_code" => $search_code)
                        )])
                 ->first();
            if(!empty($searchBy)){
                $searchbox=1;  
            }
            
        }
         
        $table = $this->Tables->get($id);
        $this->set(compact('table','searchBy','searchbox'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Table id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $table = $this->Tables->get($id);
        if ($this->Tables->delete($table)) {
            $this->Flash->success(__('The table has been deleted.'));
        } else {
            $this->Flash->error(__('The table could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
