<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bills Controller
 *
 * @property \App\Model\Table\BillsTable $Bills
 *
 * @method \App\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BillsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin');

        $where=[];

        $bill_no=$this->request->query('bill_no');
        if(!empty($bill_no)){
            $where['Bills.voucher_no']=$bill_no;
        }

        $from_date=$this->request->query('from_date');
        if(!empty($from_date)){
            $from_date=date("Y-m-d",strtotime($this->request->query('from_date')));
            $where['Bills.transaction_date >=']=$from_date;
        }

        $to_date=$this->request->query('to_date');
        if(!empty($to_date)){
            $to_date=date("Y-m-d",strtotime($this->request->query('to_date')));
            $where['Bills.transaction_date <=']=$to_date;
        }

        $amount_from=$this->request->query('amount_from');
        if(!empty($amount_from)){
            $where['Bills.grand_total >=']=$amount_from;
        }

        $amount_to=$this->request->query('amount_to');
        if(!empty($amount_to)){
            $where['Bills.grand_total <=']=$amount_to;
        }

        $customer_name=$this->request->query('customer_name');
        if(!empty($customer_name)){
            $where['Customers.name LIKE']='%'.$customer_name.'%';
        }

        $mobile_no=$this->request->query('mobile_no');
        if(!empty($mobile_no)){
            $where['Customers.mobile_no LIKE']='%'.$mobile_no.'%';
        }

        $customer_code=$this->request->query('customer_code');
        if(!empty($customer_code)){
            $where['Customers.customer_code']=$customer_code;
        }

        $this->paginate = [
            'contain' => ['Tables', 'Customers']
        ];
        $bills = $this->paginate(
            $this->Bills->find()->where($where)
        );

        $this->set(compact('bills', 'bill_no', 'from_date', 'to_date', 'amount_from', 'amount_to', 'customer_name', 'mobile_no', 'customer_code'));
    }

    /**
     * View method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
		$this->viewBuilder()->layout('');
		$bill_id=$this->request->query('bill-id');
		
        $bill = $this->Bills->get($bill_id, [
            'contain' => ['BillRows'=>['Items'], 'Customers', 'Tables'=>['Employees']]
        ]);

        $this->set('bill', $bill);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $qwerty=$this->request->query('qwerty');
        if($qwerty==1){
            $c_mobile_no=$this->request->query('c_mobile_no');
        }else{
            $c_name=$this->request->query('c_name');
            $c_mobile_no=$this->request->query('c_mobile_no');
            $c_pax=$this->request->query('c_pax');
            $dob=$this->request->query('dob');
            $doa=$this->request->query('doa');
            $c_email=$this->request->query('c_email');
            $c_address=$this->request->query('c_address');
        }
        $order_type=$this->request->query('order_type');

        $IsCustomerExist=$this->Bills->Customers->find()->where(['mobile_no' => $c_mobile_no])->first();
        if($qwerty==1 && $IsCustomerExist){
            $c_name=@$IsCustomerExist->name;
            $c_mobile_no=@$IsCustomerExist->mobile_no;
            $dob=@$IsCustomerExist->dob;
            $doa=@$IsCustomerExist->anniversary;
            $c_email=@$IsCustomerExist->email;
            $c_address=@$IsCustomerExist->address;
            
        }
        if($IsCustomerExist){
            $Customer=$this->Bills->Customers->get($IsCustomerExist->id);
            $Customer->name=$c_name;
            $Customer->mobile_no=$c_mobile_no;
            $Customer->dob=$dob;
            $Customer->anniversary=$doa;
            $Customer->email=$c_email;
            $Customer->address=$c_address;
            $this->Bills->Customers->save($Customer);
        }else{

            $Customer = $this->Bills->Customers->newEntity();
            $Customer->name=$c_name;
            $Customer->address=$c_address;
            $Customer->dob=$dob;
            $Customer->anniversary=$doa;
            $Customer->email=$c_email;
            $Customer->address=$c_address;
            $Customer->mobile_no=$c_mobile_no;
            
            $last_Customer=$this->Bills->Customers->find()
                            ->order(['customer_code' => 'DESC'])->first();
            if($last_Customer){
                $Customer->customer_code=$last_Customer->customer_code+1;
            }else{
                $Customer->customer_code=2001;
            }
            if($Customer->mobile_no){
                $this->Bills->Customers->save($Customer);
            }
            
        }

		$myJSON=$this->request->query('myJSON');

		$table_id=$this->request->query('table_id');
		$total=$this->request->query('total'); 
		$roundOff=$this->request->query('roundOff');
        $net=$this->request->query('net');
        $customer_id=@$Customer->id;
		$kot_ids=explode(',', $this->request->query('kot_ids'));
		$q = json_decode($myJSON, true);
        $bill = $this->Bills->newEntity();
		
		$last_voucher_no=$this->Bills->find()
                        ->select(['voucher_no'])->order(['id' => 'DESC'])->first();
		if($last_voucher_no){
			$bill->voucher_no=$last_voucher_no->voucher_no+1;
		}else{
			$bill->voucher_no=1;
		}
		
        $bill->transaction_date=date('Y-m-d');
		$bill->table_id=$table_id;

        
		$bill->total=$total; 
		$bill->round_off=$roundOff;
        $bill->grand_total=$net;
		$bill->customer_id=$customer_id;
		$bill->order_type=$order_type;
       
        $bill_rows=[];
		foreach($q as $row){
			$bill_row = $this->Bills->BillRows->newEntity();
			$bill_row->item_id=$row['item_id'];
			$bill_row->quantity=$row['quantity'];
			$bill_row->rate=$row['rate'];
			$bill_row->amount=$row['amount'];
			$bill_row->discount_per=$row['discount_per'];
            $bill_row->discount_amount=$row['discount_amt'];
			$bill_row->net_amount=$row['net_amount'];
            $bill_row->tax_per=$row['percen'];            
			$bill_rows[]=$bill_row;
		}
		$bill->bill_rows=$bill_rows;
        if($table_id>0){
            $Table = $this->Bills->Tables->get($table_id);
            $bill->occupied_time=$Table->occupied_time;
        }
        else{
            $bill->occupied_time=date("Y-m-d h:i:s");
        }
        $bill->payment_status='no';
        
        $bill->employee_id=@$employee_id=$this->request->query('employee_id');;
        $bill->offer_id=@$offer_id=@$this->request->query('offer_id');

        if($table_id){
            $bill->no_of_pax=@$Table->no_of_pax;
        }
        
        if($bill->order_type == "delivery"){
            $last_voucher_no=$this->Bills->find()
                        ->select(['delivery_no'])->order(['delivery_no' => 'DESC'])->where(['order_type' => 'delivery', 'transaction_date' => date('Y-m-d')])->first();
            if($last_voucher_no){
                $bill->delivery_no=$last_voucher_no->delivery_no+1;
            }else{
                $bill->delivery_no=1;
            }
        }

        if($bill->order_type == "takeaway"){
            $last_voucher_no=$this->Bills->find()
                        ->select(['take_away_no'])->order(['take_away_no' => 'DESC'])->where(['order_type' => 'takeaway', 'transaction_date' => date('Y-m-d')])->first();
            if($last_voucher_no){
                $bill->take_away_no=$last_voucher_no->take_away_no+1;
            }else{
                $bill->take_away_no=1;
            }
        }

		if ($this->Bills->save($bill)) {
			$query = $this->Bills->Kots->query();
			$query->update()
				->set(['bill_pending' => 'no'])
				->where(['table_id' => $table_id])
				->execute();
			echo $bill->id;

            foreach ($kot_ids as $key => $kot_id) {
                $query = $this->Bills->Kots->query();
                $query->update()
                    ->set(['bill_id' => $bill->id])
                    ->where(['id' => $kot_id])
                    ->execute();
            }

            if($table_id>0){
                $Table->payment_status='no';
                $Table->bill_id=$bill->id;
                $this->Bills->Tables->save($Table);  
            }

            //Stock Impact Start//
            foreach ($bill->bill_rows as $bill_row) {
                $Items = $this->Bills->BillRows->Items->get($bill_row->item_id, [
                            'contain' => ['ItemRows' => ['RawMaterials']]
                        ]);
                foreach ($Items->item_rows as $item_row) {
                    if($item_row->raw_material->recipe_unit_type=='primary'){
                        $outQty=$item_row->quantity*$bill_row->quantity;
                    }else if($item_row->raw_material->recipe_unit_type=='secondary'){
                        $outQty=($item_row->quantity*$bill_row->quantity)/$item_row->raw_material->formula;
                    }
                    $stockLedger = $this->Bills->BillRows->StockLedgers->newEntity();
                    $stockLedger->transaction_date = $bill->transaction_date;
                    $stockLedger->raw_material_id = $item_row->raw_material_id;
                    $stockLedger->quantity = $outQty;
                    $stockLedger->rate = 0;//To Be Calculate
                    $stockLedger->status = 'out';
                    $stockLedger->effected_on = date( "Y-m-d H:i:s" );
                    $stockLedger->voucher_name = 'Bill';
                    $stockLedger->adjustment_commant = '';
                    $stockLedger->wastage_commant = '';
                    $stockLedger->purchase_voucher_row_id = 0;
                    $stockLedger->purchase_voucher_id = 0;
                    $stockLedger->bill_id = $bill->id;
                    $stockLedger->bill_row_id = $bill_row->id;
                    $this->Bills->BillRows->StockLedgers->save($stockLedger);
                } 

            }
            //Stock Impact End//
            
		}else{
			echo '0';
		}
		exit;
    }

    /**
     * Edit method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->layout('admin');

        $bill = $this->Bills->get($id, [
            'contain' => [ 'BillRows' => ['Items'] ]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bill = $this->Bills->patchEntity($bill, $this->request->getData());
            if ($this->Bills->save($bill)) {
                $this->Flash->success(__('The bill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bill could not be saved. Please, try again.'));
        }
        $tables = $this->Bills->Tables->find('list', ['limit' => 200]);
        $this->set(compact('bill', 'tables'));
    }

    public function updateBill(){
        $this->viewBuilder()->layout('');

        $bill_id = $this->request->query('bill_id');
        $total = $this->request->query('total');
        $roundOff = $this->request->query('roundOff');
        $net = $this->request->query('net');
        $myJSON=$this->request->query('myJSON');

        $q = json_decode($myJSON, true);

        $bill=$this->Bills->get($bill_id, [
                    'contain' => ['BillRows']
                ]);
        $bill->total=$total;
        $bill->round_off=$roundOff;
        $bill->grand_total=$net;
        $this->Bills->save($bill);

        $this->Bills->BillRows->StockLedgers->deleteAll(['bill_id' => $bill_id]);
        $this->Bills->BillRows->deleteAll(['bill_id' => $bill_id]);
        
        foreach($q as $row){
            $bill_row = $this->Bills->BillRows->newEntity();
            $bill_row->item_id=$row['item_id'];
            $bill_row->quantity=$row['quantity'];
            $bill_row->rate=$row['rate'];
            $bill_row->amount=$row['amount'];
            $bill_row->discount_per=$row['discount_per'];
            $bill_row->discount_amount=$row['discount_amt'];
            $bill_row->net_amount=$row['net_amount'];
            $bill_row->tax_per=$row['percen'];            
            $bill_row->bill_id=$bill_id;            
            $this->Bills->BillRows->save($bill_row);

            $Items = $this->Bills->BillRows->Items->get($bill_row->item_id, [
                        'contain' => ['ItemRows' => ['RawMaterials']]
                    ]);
            foreach ($Items->item_rows as $item_row) {
                if($item_row->raw_material->recipe_unit_type=='primary'){
                    $outQty=$item_row->quantity*$bill_row->quantity;
                }else if($item_row->raw_material->recipe_unit_type=='secondary'){
                    $outQty=($item_row->quantity*$bill_row->quantity)/$item_row->raw_material->formula;
                }
                $stockLedger = $this->Bills->BillRows->StockLedgers->newEntity();
                $stockLedger->transaction_date = $bill->transaction_date;
                $stockLedger->raw_material_id = $item_row->raw_material_id;
                $stockLedger->quantity = $outQty;
                $stockLedger->rate = 0;//To Be Calculate
                $stockLedger->status = 'out';
                $stockLedger->effected_on = date( "Y-m-d H:i:s" );
                $stockLedger->voucher_name = 'Bill';
                $stockLedger->adjustment_commant = '';
                $stockLedger->wastage_commant = '';
                $stockLedger->purchase_voucher_row_id = 0;
                $stockLedger->purchase_voucher_id = 0;
                $stockLedger->bill_id = $bill_id;
                $stockLedger->bill_row_id = $bill_row->id;
                $this->Bills->BillRows->StockLedgers->save($stockLedger);
            } 
        }

        echo 1;
        exit;
    }

    /**
     * Delete method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bill = $this->Bills->get($id);
        $this->Bills->BillRows->StockLedgers->deleteAll(['bill_id' => $bill->id]);
        $this->Bills->BillRows->deleteAll(['bill_id' => $bill->id]);
        if ($this->Bills->delete($bill)) {
            $this->Flash->success(__('The bill has been canceled.'));
        } else {
            $this->Flash->error(__('The bill could not be canceled. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function customerinfo($bill_id=null){
        $this->viewBuilder()->layout('admin');
        $Customer = $this->Bills->Customers->newEntity();
        $Bills = $this->Bills->find()->where(['id'=>$bill_id])->first();;
        $customer_id = $Bills->customer_id;
        $Customers=$this->Bills->Customers->find()->where(['Customers.id'=>$customer_id])->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
           

            $IsCustomerExist=$this->Bills->Customers->find()->where(['mobile_no' => $this->request->getData('mobile_no')])->first();
           
            if($IsCustomerExist){
                $Customer=$this->Bills->Customers->get($IsCustomerExist->id);
                $Customer->name=$this->request->getData('name');
                $Customer->address=$this->request->getData('address');
                $Customer->dob=$this->request->getData('dob');
                $Customer->anniversary=$this->request->getData('anniversary');
                $Customer->email=$this->request->getData('email');
                $Customer->address=$this->request->getData('address');
                $Customer->mobile_no=$this->request->getData('mobile_no');
                $this->Bills->Customers->save($Customer);
            }else{

                $Customer = $this->Bills->Customers->newEntity();
                $Customer->name=$this->request->getData('name');
                $Customer->address=$this->request->getData('address');
                $Customer->dob=$this->request->getData('dob');
                $Customer->anniversary=$this->request->getData('anniversary');
                $Customer->email=$this->request->getData('email');
                $Customer->address=$this->request->getData('address');
                $Customer->mobile_no=$this->request->getData('mobile_no');
                
                $last_Customer=$this->Bills->Customers->find()
                                ->order(['customer_code' => 'DESC'])->first();
                if($last_Customer){
                    $Customer->customer_code=$last_Customer->customer_code+1;
                }else{
                    $Customer->customer_code=2001;
                }
                if($Customer->mobile_no){
                    $IsCustomerExist = $this->Bills->Customers->save($Customer);
                }                
            }
            $BillsData=$this->Bills->get($Bills->id);
            $BillsData->customer_id=$IsCustomerExist->id;
            $BillsData->no_of_pax=$this->request->getData('no_of_pax');
            if ($this->Bills->save($BillsData)) {
                $this->Flash->success(__('Customer info update successfully'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Customer info could not be updated. Please, try again.'));
            }
        }
        $this->set(compact( 'Customers','Customer','Bills'));
    }



    public function salesReportSearch(){
        $this->viewBuilder()->layout('admin');

        $Tables = $this->Bills->Tables->find('list');
        $Employees = $this->Bills->Employees->find('list');
        $Customers = $this->Bills->Customers->find('list');
        $this->set(compact( 'Tables', 'Employees', 'Customers'));
    }

    public function salesReport(){
        $this->viewBuilder()->layout('admin');

        $urls=$this->request->here();
        $seturl=explode('?',$urls);
        $this->set(compact('seturl'));

        $where=[];

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));
        if(!empty($date_from_to)){
            $where['Bills.transaction_date >=']=$from_date;
            $where['Bills.transaction_date <=']=$to_date;
        }

        $no_of_pax=$this->request->query('no_of_pax');
        $no_of_pax_parameter=$this->request->query('no_of_pax_parameter');
        if(!empty($no_of_pax)){
            if($no_of_pax_parameter=="Equal-to"){
                $where['Bills.no_of_pax']=$no_of_pax;
            }else if($no_of_pax_parameter=="Greater-than"){
                $where['Bills.no_of_pax >']=$no_of_pax;
            }else if($no_of_pax_parameter=="Less-than"){
                $where['Bills.no_of_pax <']=$no_of_pax;
            }
        }

        $payment_type=$this->request->query('payment_type');
        if(!empty($payment_type)){
            $where['Bills.payment_type']=$payment_type;
        }

        $order_type=$this->request->query('order_type');
        if(!empty($order_type)){
            $where['Bills.order_type']=$order_type;
        }

        $table_id=$this->request->query('table_id');
        if(!empty($table_id)){
            $where['Bills.table_id']=$table_id;
        }

        $employee_id=$this->request->query('employee_id');
        if(!empty($employee_id)){
            $where['Bills.employee_id']=$employee_id;
        }

        $customer_id=$this->request->query('customer_id');
        if(!empty($customer_id)){
            $where['Bills.customer_id']=$customer_id;
        }

        $bill_amount=$this->request->query('bill_amount');
        $bill_amount_parameter=$this->request->query('bill_amount_parameter');
        if(!empty($bill_amount)){
            if($bill_amount_parameter=="Equal-to"){
                $where['Bills.grand_total']=$bill_amount;
            }else if($bill_amount_parameter=="Greater-than"){
                $where['Bills.grand_total >']=$bill_amount;
            }else if($bill_amount_parameter=="Less-than"){
                $where['Bills.grand_total <']=$bill_amount;
            }
        }

        //pr($where); exit;

        $Bills = $this->paginate(
                    $this->Bills->find()
                    ->where($where)
                    ->autoFields(true)
                    ->contain(['Tables', 'Employees', 'Customers', 'BillRows'=>['Items'] ])
                );

        $q=$this->Bills->find()->where($where);
        $q->select([$q->func()->sum('Bills.grand_total')]);

        $Total_grand_total = $this->Bills->find()->select(['Total_grand_total' => $q ])->first();

        $Tables = $this->Bills->Tables->find('list');
        $Employees = $this->Bills->Employees->find('list');
        $Customers = $this->Bills->Customers->find('list');

        $this->set(compact('exploded_date_from_to', 'Bills', 'Total_grand_total', 'Tables', 'Employees', 'Customers'));
    }


    public function salesReportExcel(){
        $this->viewBuilder()->layout('');

        


        $where=[];

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));
        if(!empty($date_from_to)){
            $where['Bills.transaction_date >=']=$from_date;
            $where['Bills.transaction_date <=']=$to_date;
        }

        $no_of_pax=$this->request->query('no_of_pax');
        $no_of_pax_parameter=$this->request->query('no_of_pax_parameter');
        if(!empty($no_of_pax)){
            if($no_of_pax_parameter=="Equal-to"){
                $where['Bills.no_of_pax']=$no_of_pax;
            }else if($no_of_pax_parameter=="Greater-than"){
                $where['Bills.no_of_pax >']=$no_of_pax;
            }else if($no_of_pax_parameter=="Less-than"){
                $where['Bills.no_of_pax <']=$no_of_pax;
            }
        }

        $payment_type=$this->request->query('payment_type');
        if(!empty($payment_type)){
            $where['Bills.payment_type']=$payment_type;
        }

        $order_type=$this->request->query('order_type');
        if(!empty($order_type)){
            $where['Bills.order_type']=$order_type;
        }

        $table_id=$this->request->query('table_id');
        if(!empty($table_id)){
            $where['Bills.table_id']=$table_id;
        }

        $employee_id=$this->request->query('employee_id');
        if(!empty($employee_id)){
            $where['Bills.employee_id']=$employee_id;
        }

        $customer_id=$this->request->query('customer_id');
        if(!empty($customer_id)){
            $where['Bills.customer_id']=$customer_id;
        }

        $bill_amount=$this->request->query('bill_amount');
        $bill_amount_parameter=$this->request->query('bill_amount_parameter');
        if(!empty($bill_amount)){
            if($bill_amount_parameter=="Equal-to"){
                $where['Bills.grand_total']=$bill_amount;
            }else if($bill_amount_parameter=="Greater-than"){
                $where['Bills.grand_total >']=$bill_amount;
            }else if($bill_amount_parameter=="Less-than"){
                $where['Bills.grand_total <']=$bill_amount;
            }
        }

        //pr($where); exit;
        $Bills =  $this->Bills->find()
                    ->where($where)
                    ->autoFields(true)
                    ->contain(['Tables', 'Employees', 'Customers', 'BillRows'=>['Items'] ]);
        //pr($Bills->toArray()); exit;

        $q=$this->Bills->find()->where($where);
        $q->select([$q->func()->sum('Bills.grand_total')]);

        $Total_grand_total = $this->Bills->find()->select(['Total_grand_total' => $q ])->first();

        $Tables = $this->Bills->Tables->find('list');
        $Employees = $this->Bills->Employees->find('list');
        $Customers = $this->Bills->Customers->find('list');

        $this->set(compact('exploded_date_from_to', 'Bills', 'Total_grand_total', 'Tables', 'Employees', 'Customers'));
    }


    function delivery(){
        $this->viewBuilder()->layout('counter');
        $Bills = $this->Bills->find()
                    ->where(['Bills.order_type' => 'delivery', 'Bills.payment_type' => ''])
                    ->contain(['Customers'])
                    ->order(['Bills.created_on' => 'ASC']);
        $this->set(compact('Bills'));
    }

    function takeAway(){
        $this->viewBuilder()->layout('counter');
        $Bills = $this->Bills->find()
                    ->where(['Bills.order_type' => 'takeaway', 'Bills.payment_type' => ''])
                    ->contain(['Customers'])
                    ->order(['Bills.created_on' => 'ASC']);
        $this->set(compact('Bills'));
    }


    function paymentinfo(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bill_id = $this->request->data()['bill_id'];
            $payment_type = $this->request->data()['payment_type'];

            $Bill = $this->Bills->get($bill_id);
            $Bill->payment_type = $payment_type;
            $this->Bills->save($Bill);
            return $this->redirect(['action' => 'delivery']);
        }
    }

    function paymentinfo2(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bill_id = $this->request->data()['bill_id'];
            $payment_type = $this->request->data()['payment_type'];

            $Bill = $this->Bills->get($bill_id);
            $Bill->payment_type = $payment_type;
            $this->Bills->save($Bill);
            return $this->redirect(['action' => 'takeAway']);
        }
    }

    public function billWiseSales(){
        $this->viewBuilder()->layout('admin');

        $urls=$this->request->here();
        $seturl=explode('?',$urls);
        $this->set(compact('seturl'));

        $where=[];

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));
        if(!empty($date_from_to)){
            $where['Bills.transaction_date >=']=$from_date;
            $where['Bills.transaction_date <=']=$to_date;
        }

       
        $Bills = $this->Bills->find()
                    ->where($where)
                    ->autoFields(true)
                    ->contain(['Tables', 'Employees', 'Customers', 'BillRows'=>['Items'] ]);
        

        $q=$this->Bills->find()->where($where);
        $q->select([$q->func()->sum('Bills.grand_total')]);

        $Total_grand_total = $this->Bills->find()->select(['Total_grand_total' => $q ])->first();

        

        $this->set(compact('exploded_date_from_to', 'Bills', 'Total_grand_total'));
    }

    public function billWiseSalesExcel(){
        $this->viewBuilder()->layout('');

        $where=[];

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));
        if(!empty($date_from_to)){
            $where['Bills.transaction_date >=']=$from_date;
            $where['Bills.transaction_date <=']=$to_date;
        }

       
        $Bills = $this->Bills->find()
                    ->where($where)
                    ->autoFields(true)
                    ->contain(['Tables', 'Employees', 'Customers', 'BillRows'=>['Items'] ]);
        

        $q=$this->Bills->find()->where($where);
        $q->select([$q->func()->sum('Bills.grand_total')]);

        $Total_grand_total = $this->Bills->find()->select(['Total_grand_total' => $q ])->first();

        

        $this->set(compact('exploded_date_from_to', 'Bills', 'Total_grand_total'));
    }

    public function billWiseSalesPdf(){
        $this->viewBuilder()->layout('');

        if ($this->request->is(['patch','post','put'])){
            $excel_box = $this->request->data['excel_box'];
            $this->set(compact('excel_box'));
        }
    }

    public function hourlyReport(){
        $this->viewBuilder()->layout('admin');
        $date=$this->request->query('date');
        $date1=date('Y-m-d', strtotime($date));

        $Bills = $this->Bills->find();
        $Bills->select([
            'Hourly_sales' => $Bills->func()->sum('grand_total'),
            'Hourly_pax' => $Bills->func()->sum('no_of_pax'),
            'Hourly_bill' => $Bills->func()->count('id'),
            'hour' => 'HOUR(created_on)'
        ])
        ->where(['Bills.transaction_date' => $date1])
        ->group(['HOUR(created_on)'])
        ->order(['Bills.created_on' => 'ASC']);

        $HoyrlySalesData=[];
        $HoyrlyPaxData=[];
        $HoyrlyBillData=[];
        foreach ($Bills as $Bill) {
            $HoyrlySalesData[$Bill->hour] = $Bill->Hourly_sales;
            $HoyrlyPaxData[$Bill->hour] = $Bill->Hourly_pax;
            $HoyrlyBillData[$Bill->hour] = $Bill->Hourly_bill;
        }

        $this->set(compact('date', 'HoyrlySalesData', 'HoyrlyPaxData', 'HoyrlyBillData'));
    }

    public function hourlyReportExcel(){
        $this->viewBuilder()->layout('');

        if ($this->request->is(['patch','post','put'])){
            $excel_box = $this->request->data['excel_box'];

            $date= date("d-m-Y"); 
            $time=date('h:i:a',time());

            $filename="Hourly-Sales-Report-".$date.'_'.$time;

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

    public function dateWiseSales(){
        $this->viewBuilder()->layout('admin');

        $urls=$this->request->here();
        $seturl=explode('?',$urls);
        $this->set(compact('seturl'));


        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));
        if(!empty($date_from_to)){
            $where['Bookings.booking_date >=']=$from_date;
            $where['Bookings.booking_date <=']=$to_date;
        }


        // $TotalAmount = $this->Bills->BillRows->find()->Where(['BillRows.bill_id = Bills.id']);
        // $TotalAmount->select([$TotalAmount->func()->sum('BillRows.amount')]);

        $BillRows   = $this->Bills->BillRows->find();
        $BillRows->matching('Bills')->group(['Bills.transaction_date']);
        $BillRows->select([
            'TotalAmount' => $BillRows->func()->sum('BillRows.amount'),
            'TotalDiscountAmount' => $BillRows->func()->sum('BillRows.discount_amount'),
            'TotalNetAmount' => $BillRows->func()->sum('BillRows.net_amount'),
        ])
        ->autoFields(true);

        $data = [];
        foreach ($BillRows as $BillRow) {
            $data[ strtotime($BillRow->_matchingData['Bills']->transaction_date) ] = ['TotalAmount' => $BillRow->TotalAmount, 'TotalDiscountAmount' => $BillRow->TotalDiscountAmount, 'TotalNetAmount' => $BillRow->TotalNetAmount];
        } 
        

       

        $this->set(compact('exploded_date_from_to', 'data'));
    }

    public function dateWiseSalesExcel(){
        $this->viewBuilder()->layout('');

        
        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));
        if(!empty($date_from_to)){
            $where['Bookings.booking_date >=']=$from_date;
            $where['Bookings.booking_date <=']=$to_date;
        }


        // $TotalAmount = $this->Bills->BillRows->find()->Where(['BillRows.bill_id = Bills.id']);
        // $TotalAmount->select([$TotalAmount->func()->sum('BillRows.amount')]);

        $BillRows   = $this->Bills->BillRows->find();
        $BillRows->matching('Bills')->group(['Bills.transaction_date']);
        $BillRows->select([
            'TotalAmount' => $BillRows->func()->sum('BillRows.amount'),
            'TotalDiscountAmount' => $BillRows->func()->sum('BillRows.discount_amount'),
            'TotalNetAmount' => $BillRows->func()->sum('BillRows.net_amount'),
        ])
        ->autoFields(true);

        $data = [];
        foreach ($BillRows as $BillRow) {
            $data[ strtotime($BillRow->_matchingData['Bills']->transaction_date) ] = ['TotalAmount' => $BillRow->TotalAmount, 'TotalDiscountAmount' => $BillRow->TotalDiscountAmount, 'TotalNetAmount' => $BillRow->TotalNetAmount];
        } 
        

        $this->set(compact('exploded_date_from_to', 'data'));
    }

    public function dateWiseSalesPdf(){
        $this->viewBuilder()->layout('');

        if ($this->request->is(['patch','post','put'])){
            $excel_box = $this->request->data['excel_box'];
            $this->set(compact('excel_box'));
        }
    }


    
}
