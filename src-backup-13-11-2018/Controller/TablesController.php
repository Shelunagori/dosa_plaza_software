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
        $Tables=$this->Tables->find()->order(['Tables.name' => 'ASC'])->contain(['Employees', 'Customers']);
        $BillAmountArray=array();
        foreach ($Tables as $data) {
            $table_id=$data['id'];
            $bill_id=$data['bill_id'];
            $grand_total=0;
            if($bill_id>0){
               $Bills=$this->Tables->Bills->find()->where(['Bills.id'=>$bill_id])->first();
               $grand_total=$Bills->grand_total;
            }
            $BillAmountArray[$table_id]=$grand_total;
        } 
         
        $Employees = $this->Tables->Employees->find('list')->where(['Employees.is_deleted'=>0]);
        $this->set(compact('Tables', 'Employees','tableWiseAmount', 'BillAmountArray'));
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
    public function saveCustomeronbill()
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

        $IsCustomerExist=$this->Tables->Customers->find()->where(['mobile_no' => $this->request->query('c_mobile_no')])->first();
        if($IsCustomerExist){
            $Customer=$this->Tables->Customers->get($IsCustomerExist->id);
            $Customer->name=$this->request->query('c_name');
            $Customer->mobile_no=$this->request->query('c_mobile_no');
            $Customer->email=$this->request->query('c_email');
            $Customer->address=$this->request->query('c_address');
            $this->Tables->Customers->save($Customer);
        }else{
            $Customer = $this->Tables->Customers->newEntity();
            
            $Customer->name=$this->request->query('c_name');
            $Customer->mobile_no=$this->request->query('c_mobile_no');
            $Customer->email=$this->request->query('c_email');
            $Customer->address=$this->request->query('c_address');
            
            $last_Customer=$this->Tables->Customers->find()
                            ->order(['customer_code' => 'DESC'])->first();
            if($last_Customer){
                $Customer->customer_code=$last_Customer->customer_code+1;
            }else{
                $Customer->customer_code=2001;
            }
            if($Customer->mobile_no){
                $this->Tables->Customers->save($Customer);
            }            
        }
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
        $steward_id=$this->request->query('steward_id');

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

    public function swifttable()
    {
        $this->viewBuilder()->layout('counter');

        $table_id = $this->request->query('table_id');
        $Table = $this->Tables->newEntity();
        if ($this->request->is(['patch','post','put'])) {
            $occupiedtable=$this->request->getData('occupiedtable');
            $vacanttable=$this->request->getData('vacanttable');
            //$OTables=$this->Tables->find()->where(['id'=>$occupiedtable])->toArray();
            $OTables = $this->Tables->get($occupiedtable, [
                'contain' => []
            ]);

            //**
            $Updatetable = $this->Tables->get($vacanttable, [
                'contain' => []
            ]);
            $Updatetable->status=$OTables['status'];
            $Updatetable->c_name=$OTables['c_name'];
            $Updatetable->c_mobile=$OTables['c_mobile'];
            $Updatetable->no_of_pax=$OTables['no_of_pax'];
            $Updatetable->occupied_time=$OTables['occupied_time'];
            $Updatetable->dob=$OTables['dob'];
            $Updatetable->doa=$OTables['doa'];
            $Updatetable->email=$OTables['email'];
            $Updatetable->employee_id=$OTables['employee_id'];
            $Updatetable->c_address=$OTables['c_address']; 
            $this->Tables->save($Updatetable);

            //**
            $Oqtable = $this->Tables->get($occupiedtable, [
                'contain' => []
            ]);
            $Oqtable->status = 'vacant';
            $Oqtable->c_name = '';
            $Oqtable->c_mobile = '';
            $Oqtable->no_of_pax = '';
            $Oqtable->occupied_time = '';
            $Oqtable->dob = '';
            $Oqtable->doa = '';
            $Oqtable->email = '';
            $Oqtable->c_address = '';
            $Oqtable->employee_id = 0;
            $this->Tables->save($Oqtable); 

            //** KOTS
            $BillData=  $this->Tables->Kots->find()
                        ->where(['Kots.table_id'=>$occupiedtable,'Kots.bill_pending'=>'yes'])
                        ->count();
            if($BillData>0){
                $query = $this->Tables->Kots->query();
                $query->update()
                        ->set(['table_id' => $vacanttable ])
                        ->where(['Kots.table_id'=>$occupiedtable,'Kots.bill_pending'=>'yes'])
                        ->execute();
            }
            $this->Flash->success(__('Table successfully swifted'));

            return $this->redirect(['action' => 'index']);
        }
        $TB=$this->Tables->get($table_id);
        $vacantTables =$this->Tables->find()->where(['status'=>'vacant']);
        $occupiedTables =$this->Tables->find()->where(['status'=>'occupied']);
        $this->set(compact('vacantTables','occupiedTables','Table', 'table_id', 'TB'));
    }
    public function paymentinfo()
    {
        $this->viewBuilder()->layout('');
        $table_id=$this->request->getData('payment_table_id');
        $bill_id=$this->request->getData('payment_bill_id');
        $payment_type=$this->request->getData('payment_type');

        if($table_id>0){
            $Table = $this->Tables->get($table_id);
            $Table->payment_status='';
            $Table->bill_id='';
            $Table->employee_id='';
            $Table->status = 'vacant';
            $Table->c_name = '';
            $Table->c_mobile = '';
            $Table->no_of_pax = '';
            $Table->occupied_time = '';
            $Table->dob = '';
            $Table->doa = '';
            $Table->email = '';
            $Table->c_address = '';
            $Table->customer_id = '';
            $this->Tables->save($Table);  
        }
        if($table_id>0){
            $bills = $this->Tables->Bills->get($bill_id);
            $bills->payment_status='yes';
            $bills->payment_type=$payment_type;
             
            $this->Tables->Bills->save($bills);  
        } 
        return $this->redirect(['action' => 'index']);
    }

    public function freeTable(){
        $this->viewBuilder()->layout('');
        $table_id=$this->request->query('table_id');

        $KotsCount=$this->Tables->Kots->find()->where(['Kots.table_id' => $table_id, 'Kots.is_deleted' => 0, 'Kots.bill_pending' => 'yes'])->count();
        if($KotsCount==0){
           $Table = $this->Tables->get($table_id);
           $Table->status = 'vacant';
           $Table->c_name = '';
           $Table->c_mobile = '';
           $Table->no_of_pax = '';
           $Table->occupied_time = '';
           $Table->dob = '';
           $Table->doa = '';
           $Table->email = '';
           $Table->c_address = '';
           $Table->employee_id = '';
           $Table->payment_status = '';
           $Table->bill_id = '';
           $Table->customer_id = null;
           $this->Tables->save($Table);
           echo 1;
        }else{
            echo 0;
        }
        exit;
    }

    public function linkCustomer(){
        $customer_id = $this->request->query('customer_id');
        $table_id = $this->request->query('table_id');

        $Table = $this->Tables->get($table_id);
        $Table->customer_id = $customer_id;
        $this->Tables->save($Table);

        echo 1; exit;
    }

    public function customerForm($table_id){
        $this->viewBuilder()->layout('counter');

        $table = $this->Tables->get($table_id);

        if($table->customer_id){
            $Customers = $this->Tables->Customers->get($table->customer_id);
        }else{
            $Customers = '';
        }


        $this->set(compact('table_id', 'Customers', 'table'));
    }



}
