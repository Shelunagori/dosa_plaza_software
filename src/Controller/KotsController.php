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
        $kots = $this->Kots->find()->where(['table_id'=>$table_id, 'bill_pending'=>'yes', 'is_deleted'=>0])
            ->contain(['KotRows'=>function($q){
                return $q->where(['KotRows.is_deleted'=>0])->contain(['Items']);
            }]);
        $this->set(compact('kots','table_id','order'));
    }

    public function generate($table_id=null,$order_type=null)
    {
        $this->viewBuilder()->layout('counter');
        $ItemCategories =   $this->Kots->ItemCategories->find()
                            ->contain(['ItemSubCategories'=>['Items'=>function($q){
                                return $q->where(['Items.is_deleted'=>0]);
                            }]])
                            ->where(['ItemCategories.is_deleted'=>0]);
        $Items = $this->Kots->ItemCategories->ItemSubCategories->Items->find()
                    ->where(['Items.is_deleted'=>0])
                    ->order(['Items.name'=>'ASC']);

        $Kots=$this->Kots->find()->where(['Kots.table_id'=>$table_id,'Kots.bill_pending'=>'yes','Kots.is_deleted'=>0])
              ->contain(['KotRows'=>['Items'=>['Taxes']]]);
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
        $this->set(compact('Table_data','itemsList','Tables', 'ItemCategories', 'Items', 'table_id', 'Comments','order_type','Employees'));
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

		$Kots=$this->Kots->find()->where(['table_id'=>$table_id, 'bill_pending'=>'yes'])->contain(['KotRows'=>['Items'=>['Taxes']]]);
		if($table_id>0){
    		$Table=$this->Kots->Tables->get($table_id);
        }
		$taxes=$this->Kots->Taxes->find();
		$this->set(compact('Kots', 'Table', 'taxes','searchbox','searchBy'));
    }

    public function viewkot($kot_id=null)
    {
        $this->viewBuilder()->layout('');
        $Kots=$this->Kots->find()->where(['Kots.id'=>$kot_id, 'Kots.bill_pending'=>'yes'])->contain(["Tables",'KotRows'=>['Items'=>['Taxes']]])->first();
        //pr($Kots->toArray());exit;
        $this->set(compact('Kots'));
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
		
        $kot = $this->Kots->newEntity();
			
		$last_voucher_no=$this->Kots->find()->select(['voucher_no'])->order(['id' => 'DESC'])->first();
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
            $kot = $this->Kots->patchEntity($kot, $this->request->getData());
            $kot->is_deleted=1;
            $kot->delete_time=date('Y-m-d h:i:s');
            if ($this->Kots->save($kot)) {
                $this->Flash->success(__('The kot has been deleted.'));
                $query = $this->Kots->KotRows->query();
                $query->update()
                        ->set(['is_deleted' => 1,'delete_time'=>date('Y-m-d h:i:s')])
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
            $kot = $this->Kots->KotRows->patchEntity($kot, $this->request->getData());
            $kot->is_deleted=1;
            $kot->delete_time=date('Y-m-d h:i:s');
            if ($this->Kots->KotRows->save($kot)) {
                $this->Flash->success(__('The item has been deleted.'));
                return $this->redirect(['action' => 'generate/'.$Tid.'/'.$Order]);
            }
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }
    }
}
