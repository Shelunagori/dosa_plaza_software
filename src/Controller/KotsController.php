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
        $table_id=$this->request->query('table_id');
        $order=$this->request->query('order');
        $kots = $this->Kots->find()->where(['table_id'=>$table_id, 'bill_pending'=>'yes', 'is_deleted'=>0, 'order_type'=>$order])
            ->contain(['KotRows'=>function($q){
                return $q->where(['KotRows.is_deleted'=>0])->contain(['Items']);
            }]);
        $this->set(compact('kots','table_id','order'));
    }

    public function generate($table_id=null,$order_type=null)
    {
        $this->viewBuilder()->layout('counter');


        if ($this->request->is(['patch', 'post', 'put'])) {
            $table_id = $this->request->data()['table_id']; 
            $c_name = $this->request->data()['c_name']; 
            $c_mobile_no = $this->request->data()['c_mobile_no']; 
            $dob = date('Y-m-d', strtotime($this->request->data()['dob'])); 
            $anniversary = date('Y-m-d', strtotime($this->request->data()['doa'])); 
            $c_email = $this->request->data()['c_email']; 
            $c_address = $this->request->data()['c_address']; 

            $Customer=$this->Kots->Customers->find()->where(["Customers.mobile_no" => $c_mobile_no])->first();
            if($Customer){
                $query = $this->Kots->Tables->query();
                $query->update()
                    ->set(['customer_id' => $Customer->id])
                    ->where(['Tables.id' => $table_id])
                    ->execute();

                $query = $this->Kots->Customers->query();
                $query->update()
                    ->set(['name' => $c_name, 'address' => $c_address, 'mobile_no' => $c_mobile_no, 'dob' => $dob, 'anniversary' => $anniversary, 'email' => $c_email])
                    ->where(['Customers.id' => $Customer->id])
                    ->execute();
            }else{
                $Customer = $this->Kots->Customers->newEntity();
                $Customer->name = $c_name;
                $Customer->address = $c_address;
                $Customer->mobile_no = $c_mobile_no;
                $Customer->dob = $dob;
                $Customer->anniversary = $anniversary;
                $Customer->email = $c_email;
                

                $lastCustomer=$this->Kots->Customers->find()->order(['Customers.id' => 'DESC'])->first();
                if($lastCustomer){
                    $Customer->customer_code = $lastCustomer->customer_code+1;
                }else{
                    $Customer->customer_code = 2001;
                }

                $this->Kots->Customers->save($Customer);

                $query = $this->Kots->Tables->query();
                $query->update()
                    ->set(['customer_id' => $Customer->id])
                    ->where(['Tables.id' => $table_id])
                    ->execute();
            }

        }

        $ItemCategories =   $this->Kots->ItemCategories->find()
                            ->contain(['ItemSubCategories'=>['Items'=>function($q){
                                return $q->where(['Items.is_deleted'=>0]);
                            }]])
                            ->where(['ItemCategories.is_deleted'=>0]);
        $Items = $this->Kots->ItemCategories->ItemSubCategories->Items->find()
                    ->where(['Items.is_deleted'=>0])
                    ->order(['Items.name'=>'ASC']);

        $Kots=$this->Kots->find()->where(['Kots.table_id'=>$table_id,'Kots.bill_pending'=>'yes','Kots.is_deleted'=>0])
              ->contain(['KotRows'=>function($q){
                    return $q->where(['KotRows.is_deleted' => 0])->contain(['Items'=>['Taxes']]);
              }]);
        $itemsList=[]; $kotIDs=[];
        $Table_data=array();
        if($table_id){
            $Table_data=$this->Kots->Tables->get($table_id);  
        }
        
        foreach($Kots as $Kot){
            $kotIDs[$Kot->id]=$Kot->id;
            foreach($Kot->kot_rows as $kot_row){
                $itemsList[$kot_row->item_id]=['quantity'=>@$itemsList[$kot_row->item_id]['quantity']+$kot_row->quantity, 'rate'=>$kot_row->rate, 'name'=>$kot_row->item->name , 'tax_name'=>$kot_row->item->tax->name, 'tax_per'=>$kot_row->item->tax->tax_per , 'dis_applicable'=>$kot_row->item->discount_applicable];
            }
        }       
 
        $Comments = $this->Kots->Comments->find('list');
        $Employees = $this->Kots->Tables->Employees->find('list')->where(['Employees.is_deleted'=>0]);

        $Customers = $this->Kots->Customers->find('list', 
                            [
                                'keyField' => 'id',
                                'valueField' => function ($row) {
                                    return $row['name'] . '  (' . $row['mobile_no'].')';
                                }
                            ]);
        $this->set(compact('Table_data','itemsList','Tables', 'ItemCategories', 'Items', 'table_id', 'Comments','order_type','Employees', 'Customers'));
    }
 
    /**
     * View method
     *
     * @param string|null $id Kot id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $table_id=$this->request->query('table_id');
        $search_mobile=$this->request->query('search_mobile');
        $search_code=$this->request->query('search_code');
		
        $searchBy=array();
        $searchbox=0;
        if(!empty($search_mobile) || !empty($search_code))
        {
            $searchBy=$this->Kots->Tables->Customers->find()
                 ->where(['OR' => array(
                            array("Customers.mobile_no" => $search_mobile),
                            array("Customers.customer_code" => $search_code)
                        )])
                 ->first();
            if(!empty($searchBy)){
                $searchbox=1;  
            }
        }
        //pr($searchBy);exit;

		$Kots=$this->Kots->find()->where(['table_id'=>$table_id, 'bill_pending'=>'yes', 'Kots.is_deleted'=>'0'])->contain(['KotRows'=> function($q){
                    return $q->where(['KotRows.is_deleted'=>'0'])->contain(['Items'=>['Taxes']]);
                }]);
		if($table_id>0){
    		$Table=$this->Kots->Tables->get($table_id);
            if($Table->customer_id){
                $Customer = $this->Kots->Tables->Customers->get($Table->customer_id);
            }
            
        }
		$taxes=$this->Kots->Taxes->find();
		$this->set(compact('Kots', 'Table', 'taxes','searchbox','searchBy', 'Customer'));
    }

    public function viewkot($kot_id=null)
    {
        $this->viewBuilder()->layout('');
        $Kots=$this->Kots->find()->where(['Kots.id'=>$kot_id, 'Kots.bill_pending'=>'yes'])->contain(["Tables" => ['Employees'],'KotRows'=>['Items'=>['Taxes']]])->first();

        if($Kots->order_type == "delivery"){
            $last_voucher_no=$this->Kots->Bills->find()
                            ->select(['delivery_no'])->order(['delivery_no' => 'DESC'])->where(['order_type' => 'delivery', 'transaction_date' => date('Y-m-d')])->first();
        }

        if($Kots->order_type == "takeaway"){
            $last_voucher_no=$this->Kots->Bills->find()
                            ->select(['take_away_no'])->order(['take_away_no' => 'DESC'])->where(['order_type' => 'takeaway', 'transaction_date' => date('Y-m-d')])->first();
        }
        
        
        $this->set(compact('Kots', 'last_voucher_no'));
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
        $one_comment=$this->request->query('one_comment');
        $order_type=$this->request->query('order_type'); 
		$q = json_decode($myJSON, true);
		
        if(!$table_id){
            $table_id=0;
        }
        $kot = $this->Kots->newEntity();
			
		$last_voucher_no=$this->Kots->find()->select(['voucher_no'])
                        ->where(['Kots.table_id' => $table_id, 'Kots.order_type' => $order_type, 'Kots.bill_pending' => 'yes'])
                        ->order(['id' => 'DESC'])->first();
		if($last_voucher_no){
			$kot->voucher_no=$last_voucher_no->voucher_no+1;
		}else{
			$kot->voucher_no=1;
		}
			
        $kot->table_id=$table_id;
		$kot->one_comment=$one_comment;
        $kot->order_type=$order_type;
		
		$kot_rows=[];
		foreach($q as $row){
			$kot_row = $this->Kots->KotRows->newEntity();
			$kot_row->item_id=$row['item_id'];
			$kot_row->quantity=$row['quantity'];
			$kot_row->rate=$row['rate'];
            $kot_row->amount=$row['amount'];
			$kot_row->item_comment=$row['comment'];
			$kot_rows[]=$kot_row;
		}
		$kot->kot_rows=$kot_rows;
		if ($data=$this->Kots->save($kot)) {
			echo $data->id;
		}else{
			echo '0';
		}
		exit;
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

    public function customer($id = null,$search=null,$search_mobile=null,$searchbox=null)
    {
        $this->viewBuilder()->layout('');
        $id=$this->request->query('table_id');
        $search=$this->request->query('search');
        if($id){
            $table = $this->Kots->Tables->get($id);
        }
       
        $searchBy=array();
        $searchbox=0;
        if(!empty($search))
        {
            $searchBy=$this->Kots->Bills->Customers->find()
                 ->where(['OR' => array(
                            array("Customers.mobile_no" => $search),
                            array("Customers.customer_code" => $search)
                        )])
                 ->first();


            if(!empty($searchBy))
            {
                $query = $this->Bills->Tables->query();
                $query->update()
                    ->set(['c_name' => $searchBy->name, 'c_mobile' => $searchBy->mobile_no, 'email' => $searchBy->email, 'c_address' => $searchBy->address])
                    ->where(['Tables.id' => $id])
                    ->execute();
                $table = $this->Kots->Tables->get($id);
                
                $searchbox=1;  
            }
            else
            {
                $searchbox=2; 
            }
            
        }
            $mobile=@$table->c_mobile;
            $favorite_item=array();
            if(!empty($mobile)){
                $IsCustomerExist=$this->Kots->Bills->Customers->find()->where(['Customers.mobile_no' => $mobile])->first();
              
                if($IsCustomerExist){
                    $customer_id=$IsCustomerExist->id;
                    $BillRows= $this->Kots->Bills->BillRows->find();
                    $BillRows->select(['TotalQuantity' => $BillRows->func()->SUM('BillRows.quantity')])
                                ->group(['BillRows.item_id'])
                                ->order(['TotalQuantity' => 'DESC'])
                                ->matching('Bills', function($q) use($customer_id){
                                    return $q->where(['Bills.customer_id' => $customer_id]);
                                })
                                ->limit(3)
                                ->contain(['Items'])
                                ->autoFields(true);


                    $Bills= $this->Kots->Bills->find();
                    $Bills->select(['TotalAmount' => $Bills->func()->SUM('Bills.grand_total')])
                    ->group(['Bills.customer_id'])
                    ->where(['Bills.customer_id' => $customer_id])
                    ->first();

                    $TotalAmount = @$Bills->toArray()[0]['TotalAmount'];



                    $currentDate=date('Y-m');
                    $lastDate=date("Y-m-t", strtotime($currentDate));
                    $Bills= $this->Kots->Bills->find();
                    $Bills->select(['TotalAmount' => $Bills->func()->SUM('Bills.grand_total')])
                    ->group(['Bills.customer_id'])
                    ->where(['Bills.customer_id' => $customer_id])
                    ->where([
                        'Bills.transaction_date >=' => $currentDate.'-1', 
                        'Bills.transaction_date <=' => $lastDate, 
                    ])
                    ->first();

                    $TotalAmountMonth = @$Bills->toArray()[0]['TotalAmount'];


                    

                    $Bills= $this->Kots->Bills->find();
                    $Bills->where(['Bills.customer_id' => $customer_id])
                    ->order(['Bills.voucher_no' => 'DESC'])
                    ->first();

                    $LastBillAmount = @$Bills->toArray()[0]['grand_total'];
                    
                }
            }    

        $this->set(compact('table','searchBy','searchbox', 'search', 'BillRows', 'TotalAmount', 'TotalAmountMonth', 'LastBillAmount'));
    }

    public function deletekot($id = null,$Tid = null,$Order = null)
    {
        $kot = $this->Kots->get($id, [
            'contain' => ['KotRows']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $delete_comment = $this->request->getData()['delete_comment'];
            $kot = $this->Kots->patchEntity($kot, $this->request->getData());
            $kot->is_deleted=1;
            $kot->delete_time=date('Y-m-d h:i:s');
            if ($this->Kots->save($kot)) {
                $this->Flash->success(__('The kot has been deleted.'));
                $query = $this->Kots->KotRows->query();
                $query->update()
                        ->set(['is_deleted' => 1,'delete_time'=>date('Y-m-d h:i:s'), 'delete_comment' => $delete_comment ])
                        ->where(['KotRows.kot_id'=>$id])
                        ->execute();
                return $this->redirect(['action' => 'generate/'.$Tid.'/'.$Order]);
            }
            $this->Flash->error(__('The kot could not be deleted. Please, try again.'));
        }
    }

    public function deletekotitem($id = null,$Tid = null,$Order = null)
    {
        $kot = $this->Kots->KotRows->get($id); 
        if ($this->request->is(['patch', 'post', 'put'])) {

            $KotRow = $this->Kots->KotRows->patchEntity($kot, $this->request->getData());
            $KotRow->is_deleted=1;
            $KotRow->delete_time=date('Y-m-d h:i:s');
            $KotRow->delete_comment=$this->request->getData()['delete_comment'];

            if ($this->Kots->KotRows->save($KotRow)) {

                $kot = $this->Kots->find()->where(['Kots.id' => $KotRow->kot_id])
                        ->contain(['KotRows' => function($q){
                            return $q->where(['KotRows.is_deleted' => 0]);
                        }])
                        ->first();

                if(sizeof($kot->kot_rows)==0){
                    $Kot=$this->Kots->get($kot->id);
                    $Kot->is_deleted=1;
                    $Kot->delete_time=date('Y-m-d h:i:s');
                    $this->Kots->save($Kot);
                }

                $this->Flash->success(__('The item has been deleted.'));
                return $this->redirect(['action' => 'generate/'.$Tid.'/'.$Order]);
            }
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }
    }

    public function deleteReport(){
        $this->viewBuilder()->layout('admin');

        $from_date=$this->request->query('from_date');
        $from_date1=date('Y-m-d', strtotime($from_date));
        $to_date=$this->request->query('to_date');
        $to_date1=date('Y-m-d', strtotime($to_date));

        $deletedRows=$this->Kots->KotRows->find()
                    ->where([
                        'KotRows.kot_id = Kots.id',
                        'KotRows.is_deleted' => '1'
                    ]);
        $deletedRows->select([$deletedRows->func()->count('KotRows.id')]);

        $Kots = $this->Kots->find()
                ->select([
                    'deleted_rows' => $deletedRows
                ])
                ->where([
                    'created_on >=' => $from_date1.' 00:00:00',
                    'created_on <=' => $to_date1.' 23:59:59'
                ])
                ->contain([
                    'Tables',
                    'KotRows'=> function($q){
                        return $q->where(['KotRows.is_deleted' => 1])->contain(['Items']);
                    } 
                ])
                ->autoFields(true);
        $this->set(compact('Kots', 'from_date', 'to_date'));
    }

    public function deleteReportExcel(){
        $this->viewBuilder()->layout('');

        if ($this->request->is(['patch','post','put'])){
            $excel_box = $this->request->data['excel_box'];

            $date= date("d-m-Y"); 
            $time=date('h:i:a',time());

            $filename="KOT-Delete-History-Report-".$date.'_'.$time;

            header ("Expires: 0");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/vnd.ms-excel");
            header ("Content-Disposition: attachment; filename=".$filename.".xls");
            header ("Content-Description: Generated Report" );

            echo $excel_box;
        }
        exit;
    }

    public function kotReport(){
        $this->viewBuilder()->layout('admin');

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));

        $emWhere=[];
        $employee_id = $this->request->query('employee_id');
        if($employee_id){
            $emWhere['Bills.employee_id'] = $employee_id;

            $Employee = $this->Kots->Employees->get($employee_id);
        }
        

        $Kots = $this->Kots->find()
                ->where([
                    'Kots.created_on >=' => $from_date.' 00:00:00',
                    'Kots.created_on <=' => $to_date.' 23:59:59',
                    'Kots.is_deleted' => 0
                ])
                ->contain([
                    'Tables',
                    'Bills' => ['Employees'],
                    'KotRows'=> function($q){
                        return $q->where(['KotRows.is_deleted' => 0])->contain(['Items']);
                    } 
                ])
                ->matching('Bills', function($q) use($emWhere){
                        return $q->where($emWhere);
                    })
                ->autoFields(true);

        $employees = $this->Kots->Employees->find('list');

        $KotRows = $this->Kots->KotRows->find();
        $KotRows->matching('Kots', function($q) use($from_date, $to_date){
            return $q->where([
                'Kots.created_on >=' => $from_date.' 00:00:00',
                'Kots.created_on <=' => $to_date.' 23:59:59',
                'Kots.is_deleted' => 0
            ]);
        })
        ->select([
            'Total_Kot_Amount' => $KotRows->func()->sum('amount'),
        ]);
        $Total_Kot_Amount = $KotRows->toArray()[0]['Total_Kot_Amount']; 


        $this->set(compact('Kots', 'exploded_date_from_to', 'employees', 'employee_id', 'Total_Kot_Amount', 'Employee'));
    }

    public function kotReportExcel(){
        $this->viewBuilder()->layout('');

        if ($this->request->is(['patch','post','put'])){
            $excel_box = $this->request->data['excel_box'];

            $date= date("d-m-Y"); 
            $time=date('h:i:a',time());

            $filename="KOT-Report-".$date.'_'.$time;

            header ("Expires: 0");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/vnd.ms-excel");
            header ("Content-Disposition: attachment; filename=".$filename.".xls");
            header ("Content-Description: Generated Report" );

            echo $excel_box;
        }
        exit;
    }

    public function updateKot(){
        $myJSON=$this->request->query('myJSON');
        $overallComment=$this->request->query('overallComment');
        $kot_id=$this->request->query('kot_id');

        $q = json_decode($myJSON, true);

        foreach($q as $row){
            $query = $this->Kots->KotRows->query();
            $query->update()
                ->set([
                    'quantity' => $row['quantity'],
                    'rate' => $row['rate'],
                    'amount' => $row['amount'],
                    'item_comment' => $row['comment'],
                ])
                ->where(['KotRows.id' => $row['kot_row_id']])
                ->execute();
        }

        $query = $this->Kots->query();
        $query->update()
            ->set([
                'one_comment' => $overallComment,
            ])
            ->where(['Kots.id' => $kot_id])
            ->execute();

        echo 1; exit;

    }




}
