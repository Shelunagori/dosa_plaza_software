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
         $where['Bills.is_deleted']='no';

        $bill_no=$this->request->query('bill_no');
        if(!empty($bill_no)){
            $where['Bills.voucher_no']=$bill_no;
        }

        $from_date=$this->request->query('from_date');
        if(empty($from_date)){
            $from_date=date('Y-m-d');
        }
        if(!empty($from_date)){
            $from_date=date("Y-m-d",strtotime($from_date));
            $where['Bills.transaction_date >=']=$from_date;
        }

        $to_date=$this->request->query('to_date');
        if(empty($to_date)){
            $to_date=date('Y-m-d');
        }
        if(!empty($to_date)){
            $to_date=date("Y-m-d",strtotime($to_date));
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
            $this->Bills->find()->where($where)->order(['voucher_no'=>'ASC'])
        );

        $this->set(compact('bills', 'bill_no', 'from_date', 'to_date', 'amount_from', 'amount_to', 'customer_name', 'mobile_no', 'customer_code'));
    }

    public function bulk()
    {
        $this->viewBuilder()->layout('admin');

        $where=[];
         $where['Bills.is_deleted']='no';

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

        $payment_type=$this->request->query('payment_type');
        if(!empty($payment_type)){
            $where['Bills.payment_type']=$payment_type;
        }

        
        $bills = $this->Bills->find()->contain(['Tables', 'Customers'])->where($where);

        $items=$this->Bills->BillRows->Items->find('list')->where(['is_deleted'=>0]);

        $this->set(compact('bills', 'bill_no', 'from_date', 'to_date', 'amount_from', 'amount_to', 'customer_name', 'mobile_no', 'customer_code', 'payment_type', 'items'));
    }

    public function modify(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data=$this->request->data();
            $bill_ids=$data['bill_ids'];
            $item_id=$data['item_id'];
            foreach ($bill_ids as $bill_id) {
                $bill=$this->Bills->get($bill_id,[
                    'contain' => ['BillRows']
                ]);

                $item=$this->Bills->BillRows->Items->get($item_id, [
                    'contain' => ['Taxes']
                ]);
                
                $this->Bills->BillRows->deleteAll(['bill_id' => $bill->id]);

                $bill_row = $this->Bills->BillRows->newEntity();
                $bill_row->bill_id=$bill->id;
                $bill_row->item_id=$item_id;
                $bill_row->quantity=1;
                $bill_row->rate=$item->rate;
                $bill_row->amount=1*$item->rate;
                $bill_row->discount_per=0;
                $bill_row->discount_amount=0;

                $net_amount=(1*$item->rate)*(100+$item->tax->tax_per)/100;

                $net_amount_after_round_off=round($net_amount);
                $round_off=$net_amount_after_round_off-$net_amount;

                $bill_row->net_amount=$net_amount;
                $bill_row->tax_per=$item->tax->tax_per;
                $bill->bill_rows=[];
                $bill->bill_rows[0]=$bill_row;

                $bill->total=$net_amount;
                $bill->round_off=$round_off;
                $bill->grand_total=$net_amount_after_round_off;
                $this->Bills->save($bill);
            }
            $this->Flash->success(__('Bills have been modified.'));
            return $this->redirect(['action' => 'bulk']);
        }
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
		
       /*  $bill = $this->Bills->get($bill_id, [
            'contain' => ['BillRows'=>['Items'], 'Customers', 'Tables'=>['Employees']]
        ]); */
		
		$bill = $this->Bills->get($bill_id, [
            'contain' => ['BillRows'=>['Items'], 'Customers', 'Employees']
        ]); 	
		

        $Kot = $this->Bills->Kots->find()->where(['Kots.bill_id' => $bill_id])->first();
        $kot_no = $Kot->voucher_no;

        $BillSetting = $this->Bills->BillSettings->get(1);

        $this->set('bill', $bill);
        $this->set('kot_no', $kot_no);
        $this->set('BillSetting', $BillSetting);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addKotBill(){
        $myJSON=$this->request->query('myJSON');
        $q = json_decode($myJSON, true);

        
        $total=$this->request->query('total'); 
        $roundOff=$this->request->query('roundOff');
        $net=$this->request->query('net');
        $c_name=$this->request->query('c_name');
        $c_mobile_no=$this->request->query('c_mobile_no');
        $c_address=$this->request->query('c_address');
        $order_type=$this->request->query('order_type');
        $employee_id=$this->request->query('employee_id');
        $offer_id=$this->request->query('offer_id');
        $oneComment=$this->request->query('oneComment');
        
        if($order_type=="takeaway"){
            $payment_type=$this->request->query('payment_type');
            $c_address="";
        }else{
            $payment_type="";
            $c_address=$this->request->query('c_address');
        }
        

        //*****************************************//
        //      CREATE KOT START
        //*****************************************//
        $kot = $this->Bills->Kots->newEntity();
        $last_voucher_no=$this->Bills->Kots->find()->select(['voucher_no'])
                        ->order(['id' => 'DESC'])->first();
        if($last_voucher_no){
            $kot->voucher_no=$last_voucher_no->voucher_no+1;
        }else{
            $kot->voucher_no=1;
        }
        $kot->table_id=0;
        $kot->bill_id=null;
        $kot->bill_pending='no';
        $kot->one_comment=$oneComment;
        $kot->order_type=$order_type;

        $kot_rows=[];
        foreach($q as $row){
            $kot_row = $this->Bills->Kots->KotRows->newEntity();
            $kot_row->item_id=$row['item_id'];
            $kot_row->quantity=$row['quantity'];
            $kot_row->rate=$row['rate'];
            $kot_row->amount=$row['amount'];
            $kot_row->item_comment=$row['comment'];
            $kot_rows[]=$kot_row;
        }
        $kot->kot_rows=$kot_rows;
        $this->Bills->Kots->save($kot);
        //*****************************************//
        //      CREATE KOT END
        //*****************************************//

        //*****************************************//
        //      CREATE BILL START 
        //*****************************************//
        $bill = $this->Bills->newEntity();

        //SAVE CUSTOMER INFO 
        $IsCustomerExist=$this->Bills->Customers->find()->where(['mobile_no' => $c_mobile_no])->first();
        if($IsCustomerExist){
            //update
            $Customer=$this->Bills->Customers->get($IsCustomerExist->id);
            $Customer->name=$c_name;
            if($c_address){
                $Customer->address=$c_address;
            }
            $this->Bills->Customers->save($Customer);
            
            //link
            $bill->customer_id=$Customer->id;
        }else{
            $Customer = $this->Bills->Customers->newEntity();
            $Customer->name=$c_name;
            $Customer->mobile_no=$c_mobile_no;
            $Customer->address=$c_address;
            
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

            $bill->customer_id=$Customer->id;
        }

        $bill->transaction_date = date('Y-m-d');
        $last_voucher_no=$this->Bills->find()
                        ->select(['voucher_no'])->order(['id' => 'DESC'])->first();
        if($last_voucher_no){
            $bill->voucher_no=$last_voucher_no->voucher_no+1;
        }else{
            $bill->voucher_no=1;
        }
        $bill->table_id=0;
        $bill->total=$total;
        $bill->round_off=$roundOff;
        $bill->grand_total=$net;
        $bill->order_type=$order_type;

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

        $bill->occupied_time=date('Y-m-d H:i:s');
        $bill->payment_status='';
        $bill->payment_type=$payment_type;
        $bill->employee_id=$employee_id;
        $bill->offer_id=$offer_id;

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
        $bill->payment_status=0;

        $this->Bills->save($bill);
        //*****************************************//
        //      CREATE BILL END 
        //*****************************************//

        //UPDATE BILL-ID IN KOT
        $query = $this->Bills->Kots->query();
        $query->update()
            ->set(['bill_id' => $bill->id])
            ->where(['id' => $kot->id])
            ->execute();


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

        $Response = ['kot_id' => $kot->id, 'bill_id' => $bill->id];
        echo json_encode($Response); exit;
    }
    public function add()
    {
        $c_name=$this->request->query('c_name');
        $c_mobile_no=$this->request->query('c_mobile_no');
        $c_address=$this->request->query('c_address');
        $order_type=$this->request->query('order_type');
        $table_id=$this->request->query('table_id');

        $bill = $this->Bills->newEntity();
        if($table_id>0){
            $Table = $this->Bills->Tables->get($table_id);
            $bill->customer_id=$Table->customer_id;
            
        }else{
            $IsCustomerExist=$this->Bills->Customers->find()->where(['mobile_no' => $c_mobile_no])->first();
            if($IsCustomerExist){
                //update
                $Customer=$this->Bills->Customers->get($IsCustomerExist->id);
                $Customer->name=$c_name;
                $Customer->address=$c_address;
                $this->Bills->Customers->save($Customer);
                
                //link
                $bill->customer_id=$Customer->id;
            }else{
                //insert
                $Customer = $this->Bills->Customers->newEntity();
                $Customer->name=$c_name;
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

                //link
                $bill->customer_id=$Customer->id;
            }
        }

       

		$myJSON=$this->request->query('myJSON');

		
		$total=$this->request->query('total'); 
		$roundOff=$this->request->query('roundOff');
        $net=$this->request->query('net');
        
		$kot_ids=explode(',', $this->request->query('kot_ids'));
		$q = json_decode($myJSON, true);
        
		
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

        //*********************************//
        //           SAVE BILL             
        //*********************************//
        
		if ($this->Bills->save($bill)) {

            $B=$this->Bills->get($bill->id, [
            'contain' => ['BillRows']
        ]);

        $CopyBill = $this->Bills->CopyBills->newEntity();
        $CopyBill->transaction_date=$bill->transaction_date;
        $CopyBill->voucher_no=$B->voucher_no;
        $CopyBill->table_id=$B->table_id;
        $CopyBill->total=$B->total;
        $CopyBill->tax_id=$B->tax_id;
        $CopyBill->round_off=$B->round_off;
        $CopyBill->grand_total=$B->grand_total;
        $CopyBill->customer_id=$B->customer_id;
        $CopyBill->created_on=$B->created_on;
        $CopyBill->order_type=$B->order_type;
        $CopyBill->delivery_no=$B->delivery_no;
        $CopyBill->take_away_no=$B->take_away_no;
        $CopyBill->occupied_time=$B->occupied_time;
        $CopyBill->status=$B->status;
        $CopyBill->no_of_pax=$B->no_of_pax;
        $CopyBill->payment_status=$B->payment_status;
        $CopyBill->payment_type=$B->payment_type;
        $CopyBill->employee_id=$B->employee_id;
        $CopyBill->offer_id=$B->offer_id;
        $CopyBill->is_deleted=$B->is_deleted;
        $this->Bills->CopyBills->save($CopyBill);

        foreach ($B->bill_rows as $bill_row) {
            $CopyBillRow = $this->Bills->CopyBillRows->newEntity();
            $CopyBillRow->bill_id=$bill_row->bill_id;
            $CopyBillRow->item_id=$bill_row->item_id;
            $CopyBillRow->quantity=$bill_row->quantity;
            $CopyBillRow->rate=$bill_row->rate;
            $CopyBillRow->amount=$bill_row->amount;
            $CopyBillRow->discount_per=$bill_row->discount_per;
            $CopyBillRow->discount_amount=$bill_row->discount_amount;
            $CopyBillRow->net_amount=$bill_row->net_amount;
            $CopyBillRow->tax_per=$bill_row->tax_per;
            $this->Bills->CopyBillRows->save($CopyBillRow);
        }
        
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
        $payment_type = $this->request->query('payment_type');
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
        $bill->payment_type=$payment_type;
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
        $bill->is_deleted="yes";
        if ($this->Bills->save($bill)) {
            $this->Flash->success(__('The bill has been canceled.'));
        }else{
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
        $where['Bills.is_deleted']='no';

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
        $where['Bills.is_deleted']='no';

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
        $where['Bills.is_deleted']='no';

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
        $where['Bills.is_deleted']='no';

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

    public function billWiseSalesDelete(){
        $this->viewBuilder()->layout('admin');

        $urls=$this->request->here();
        $seturl=explode('?',$urls);
        $this->set(compact('seturl'));

        $where=[];
        $where['Bills.is_deleted']='no';

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));
        if(!empty($date_from_to)){
            $where['Bills.transaction_date >=']=$from_date;
            $where['Bills.transaction_date <=']=$to_date;
        }
        $where['Bills.is_deleted']='yes';

       
        $Bills = $this->Bills->find()
                    ->where($where)
                    ->autoFields(true)
                    ->contain(['Tables', 'Employees', 'Customers', 'BillRows'=>['Items'] ]);
        

        $q=$this->Bills->find()->where($where);
        $q->select([$q->func()->sum('Bills.grand_total')]);

        $Total_grand_total = $this->Bills->find()->select(['Total_grand_total' => $q ])->first();

        

        $this->set(compact('exploded_date_from_to', 'Bills', 'Total_grand_total'));
    }

    public function billWiseSalesDeleteExcel(){
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
        $where['Bills.is_deleted']='yes'; 

       
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
        ->where(['Bills.transaction_date' => $date1, 'Bills.is_deleted' => 'no'])
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




        $BillRows   = $this->Bills->BillRows->find();
        $BillRows->matching('Bills', function($q){
            return $q->where(['Bills.is_deleted' => 'no']);
        })
        ->group(['Bills.transaction_date']);
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
        $BillRows->matching('Bills', function($q){
            return $q->where(['Bills.is_deleted' => 'no']);
        })
        ->group(['Bills.transaction_date']);
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

    public function avgBillReport(){
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



        $Bills   = $this->Bills->find();
        $Bills->where(['Bills.transaction_date >=' => $from_date, 'Bills.transaction_date <=' => $to_date]);

        $data = [];
        foreach ($Bills as $Bill) {
            $data[ strtotime($Bill->transaction_date) ] = [
                'grand_total' => @$data[ strtotime($Bill->transaction_date) ]['grand_total'] + $Bill->grand_total,
                'no_of_pax' => @$data[ strtotime($Bill->transaction_date) ]['no_of_pax'] + $Bill->no_of_pax
            ];
        }

        //pr($data); exit;
        

        $this->set(compact('exploded_date_from_to', 'data'));
    }

    public function billrows(){
        $this->viewBuilder()->layout('');
        $bill_id=$this->request->query('bill_id');
        $bill=$this->Bills->get($bill_id, [
            'contain' => ['BillRows'=>['Items'] ]
        ]);
        $this->set(compact('bill'));
    }

    public function salesSummaryPaymentWise(){
        $this->viewBuilder()->layout('admin');

        $urls=$this->request->here();
        $seturl=explode('?',$urls);
        $this->set(compact('seturl'));

        $payment_type=$this->request->query('payment_type');

        $where=[];
        $where['Bills.is_deleted']='no';

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));
        if(!empty($date_from_to)){
            $where['Bills.transaction_date >=']=$from_date;
            $where['Bills.transaction_date <=']=$to_date;
        }

        $payment_type=$this->request->query('payment_type');
        if(!empty($payment_type)){
            $where['Bills.payment_type']=$payment_type;
        }
        

        if($payment_type=='cash' or $payment_type==''){
            $CashBills = $this->Bills->find()
                        ->where($where)
                        ->where(['Bills.payment_type'=>'cash'])
                        ->contain(['Tables', 'Employees', 'Customers'])
                        ->order(['Bills.transaction_date'=>'ASC']);
        }

        if($payment_type=='card' or $payment_type==''){
            $CardBills = $this->Bills->find()
                        ->where($where)
                        ->where(['Bills.payment_type'=>'card'])
                        ->contain(['Tables', 'Employees', 'Customers'])
                        ->order(['Bills.transaction_date'=>'ASC']);
        }

        if($payment_type=='paytm' or $payment_type==''){
            $PaytmBills = $this->Bills->find()
                        ->where($where)
                        ->where(['Bills.payment_type'=>'paytm'])
                        ->contain(['Tables', 'Employees', 'Customers'])
                        ->order(['Bills.transaction_date'=>'ASC']);
        }
        
        $this->set(compact('exploded_date_from_to', 'CashBills', 'CardBills', 'PaytmBills', 'payment_type'));
    }

    public function salesSummaryOrderWise(){
        $this->viewBuilder()->layout('admin');

        $urls=$this->request->here();
        $seturl=explode('?',$urls);
        $this->set(compact('seturl'));

        $order_type=$this->request->query('order_type');

        $where=[];
        $where['Bills.is_deleted']='no';

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));
        if(!empty($date_from_to)){
            $where['Bills.transaction_date >=']=$from_date;
            $where['Bills.transaction_date <=']=$to_date;
        }

                

        if($order_type=='dinner' or $order_type==''){
            $dinnerBills = $this->Bills->find()
                        ->where($where)
                        ->where(['Bills.order_type'=>'dinner'])
                        ->contain(['Tables', 'Employees', 'Customers'])
                        ->order(['Bills.transaction_date'=>'ASC']);
        }

        if($order_type=='delivery' or $order_type==''){
            $deliveryBills = $this->Bills->find()
                        ->where($where)
                        ->where(['Bills.order_type'=>'delivery'])
                        ->contain(['Tables', 'Employees', 'Customers'])
                        ->order(['Bills.transaction_date'=>'ASC']);
        }

        if($order_type=='takeaway' or $order_type==''){
            $takeawayBills = $this->Bills->find()
                        ->where($where)
                        ->where(['Bills.order_type'=>'takeaway'])
                        ->contain(['Tables', 'Employees', 'Customers'])
                        ->order(['Bills.transaction_date'=>'ASC']);
        }
        
        $this->set(compact('exploded_date_from_to', 'dinnerBills', 'deliveryBills', 'takeawayBills', 'order_type'));
    }

    
}
