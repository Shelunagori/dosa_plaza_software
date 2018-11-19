<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    public function new()
    {
        $this->viewBuilder()->layout('admin');

        $customer = $this->Customers->newEntity();

        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());

            $lastCustomer=$this->Customers->find()->order(['Customers.id' => 'DESC'])->first();
            if($lastCustomer){
                $customer->customer_code = $lastCustomer->customer_code+1;
            }else{
                $customer->customer_code = 2001;
            }

            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['action' => 'new']);
            }

            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            
        }
        $this->set(compact('customer'));

    }

    public function edit($id)
    {
        $this->viewBuilder()->layout('admin');

        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());

            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            
        }
        $this->set(compact('customer'));

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin');

        $where=[];

        $code=$this->request->query('code');
        if(!empty($code)){
            $where['Customers.customer_code']=$code;
        }

        $c_unique_code=$this->request->query('c_unique_code');
        if(!empty($c_unique_code)){
            $where['Customers.c_unique_code']=$c_unique_code;
        }

        $mobile=$this->request->query('mobile');
        if(!empty($mobile)){
            $where['Customers.mobile_no LIKE']='%'.$mobile.'%';
        }
        
        $name=$this->request->query('name');
        if(!empty($name)){
            $where['Customers.name LIKE']='%'.$name.'%';
        }
        
        $customers = $this->paginate(
            $this->Customers->find()->where($where)
        );
        
        $this->set(compact('customers', 'code', 'mobile', 'name'));
    }


    public function autoFetchCustomer(){
        $table_id = $this->request->query('table_id');
        $Table = $this->Customers->Tables->get($table_id);

        if($Table->customer_id){
            $Customer = $this->Customers->get($Table->customer_id);
        }else{
            $Response=['customer_info'=>''];
            echo json_encode($Response);
            exit;
        }
        
       
        if($Customer){
            $query = $this->Customers->Tables->query();
            $query->update()
                ->set(['customer_id' => $Customer->id])
                ->where(['Tables.id' => $table_id])
                ->execute();



            $BillRows= $this->Customers->Tables->Bills->BillRows->find();
            $BillRows->select(['TotalQuantity' => $BillRows->func()->SUM('BillRows.quantity')])
                        ->group(['BillRows.item_id'])
                        ->order(['TotalQuantity' => 'DESC'])
                        ->matching('Bills', function($q) use($Customer){
                            return $q->where(['Bills.customer_id' => $Customer->id]);
                        })
                        ->limit(3)
                        ->contain(['Items'])
                        ->autoFields(true);

            $Bills= $this->Customers->Tables->Bills->find();
            $Bills->select(['TotalAmount' => $Bills->func()->SUM('Bills.grand_total')])
            ->group(['Bills.customer_id'])
            ->where(['Bills.customer_id' => $Customer->id])
            ->first();

            $TotalAmount = @$Bills->toArray()[0]['TotalAmount'];



            $currentDate=date('Y-m');
            $lastDate=date("Y-m-t", strtotime($currentDate));
            $Bills= $this->Customers->Tables->Bills->find();
            $Bills->select(['TotalAmount' => $Bills->func()->SUM('Bills.grand_total')])
            ->group(['Bills.customer_id'])
            ->where(['Bills.customer_id' => $Customer->id])
            ->where([
                'Bills.transaction_date >=' => $currentDate.'-1', 
                'Bills.transaction_date <=' => $lastDate, 
            ])
            ->first();

            $TotalAmountMonth = @$Bills->toArray()[0]['TotalAmount'];



            $Bills= $this->Customers->Tables->Bills->find();
            $Bills->where(['Bills.customer_id' => $Customer->id])
            ->order(['Bills.voucher_no' => 'DESC'])
            ->first();

            $LastBillAmount = @$Bills->toArray()[0]['grand_total'];

            $customer_info = '
                <div class="panel" style="border-color: #2d4161;">
                    <div style="color: #ffffff;background-color: #2d4161;border-color: #2d4161;padding: 5px;">
                        <span style="font-size:14px;">'.$Customer->name .' - '.$Customer->customer_code.'</span>

                        <a href="javascript:void(0)" class="btn btn-default btn-xs" style=" float: right; height: 20px; background-color: #2d4161; margin-right: 2px;" id="UnlinkCustomer"><i class="fa fa-times"></i></a>

                        <a href="javascript:void(0)" class="btn btn-default btn-xs" style=" float: right; height: 20px; background-color: #2d4161; margin-right: 2px;" id="EditCustomer" customer_id="'.$Customer->id.'"><i class="fa fa-edit"></i></a>
                    </div>
                    <div class="panel-body" style="padding: 5px;">
                        <table width="100%">
                            <tr>
                                <td>Mobile:</td>
                                <td>'.$Customer->mobile_no .'</td>
                                <td>Email:</td>
                                <td>'.$Customer->email .'</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td colspan="3">'.$Customer->address .'</td>
                            </tr>
                        </table>
                        <hr style="margin: 5px;" />
                        <table width="100%">
                            <tr>
                                <td><div>Favorites</div>';
                                    if(sizeof(@$BillRows)>0){
                                        $i=0;
                                        foreach ($BillRows as $BillRow) { $i++;
                                            $customer_info .='<li style="font-size: 12px;color: #464444;margin-left: 4px;">'.@$BillRow->item->name.'</li>';
                                            if($i==3){ break; }
                                        }
                                    }
                                $customer_info .='</td>
                                <td width="40%" style="padding: 2px;">
                                    <div style="text-align: right;">
                                        <span style="font-size: 12px;color: #8e8e8e;">Life Time:</span>
                                        <span style="font-size: 12px;color: #464444;margin-left: 4px;">₹ '. @$TotalAmount .'</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <span style="font-size: 12px;color: #8e8e8e;">This Month:</span>
                                        <span style="font-size: 12px;color: #464444;margin-left: 4px;">₹ '. @$TotalAmountMonth .'</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <span style="font-size: 12px;color: #8e8e8e;">Last Bill:</span>
                                        <span style="font-size: 12px;color: #464444;margin-left: 4px;">₹ '. @$LastBillAmount .'</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            ';



            $Response=['customer_info'=>$customer_info];
        }else{
            $Response=['customer_info'=>''];
        }

        echo json_encode($Response);
        exit;
    }


    public function unlinkCustomer(){
        $table_id = $this->request->query('table_id');
        $query = $this->Customers->Tables->query();
        $query->update()
            ->set(['customer_id' => null])
            ->where(['Tables.id' => $table_id])
            ->execute();
        echo '1'; exit;
    }

    public function fetchCustomerInfo(){
        $this->viewBuilder()->layout('');
        $customer_id = $this->request->query('customer_id');
        $table_id = $this->request->query('table_id');
        $Customer = $this->Customers->get($customer_id);
        $this->set(compact('Customer', 'table_id'));
    }


    public function fetchCustomer(){
        $mobile = $this->request->query('mobile');
        $code = $this->request->query('code');
        $table_id = $this->request->query('table_id');

        $Customer=$this->Customers->find()
                 ->where(['OR' => array(
                            array("Customers.mobile_no" => $mobile),
                            array("Customers.customer_code" => $code)
                        )])
                 ->first();
        if($Customer){
            $query = $this->Customers->Tables->query();
            $query->update()
                ->set(['customer_id' => $Customer->id])
                ->where(['Tables.id' => $table_id])
                ->execute();



            $BillRows= $this->Customers->Tables->Bills->BillRows->find();
            $BillRows->select(['TotalQuantity' => $BillRows->func()->SUM('BillRows.quantity')])
                        ->group(['BillRows.item_id'])
                        ->order(['TotalQuantity' => 'DESC'])
                        ->matching('Bills', function($q) use($Customer){
                            return $q->where(['Bills.customer_id' => $Customer->id]);
                        })
                        ->limit(3)
                        ->contain(['Items'])
                        ->autoFields(true);

            $Bills= $this->Customers->Tables->Bills->find();
            $Bills->select(['TotalAmount' => $Bills->func()->SUM('Bills.grand_total')])
            ->group(['Bills.customer_id'])
            ->where(['Bills.customer_id' => $Customer->id])
            ->first();

            $TotalAmount = @$Bills->toArray()[0]['TotalAmount'];



            $currentDate=date('Y-m');
            $lastDate=date("Y-m-t", strtotime($currentDate));
            $Bills= $this->Customers->Tables->Bills->find();
            $Bills->select(['TotalAmount' => $Bills->func()->SUM('Bills.grand_total')])
            ->group(['Bills.customer_id'])
            ->where(['Bills.customer_id' => $Customer->id])
            ->where([
                'Bills.transaction_date >=' => $currentDate.'-1', 
                'Bills.transaction_date <=' => $lastDate, 
            ])
            ->first();

            $TotalAmountMonth = @$Bills->toArray()[0]['TotalAmount'];



            $Bills= $this->Customers->Tables->Bills->find();
            $Bills->where(['Bills.customer_id' => $Customer->id])
            ->order(['Bills.voucher_no' => 'DESC'])
            ->first();

            $LastBillAmount = @$Bills->toArray()[0]['grand_total'];

            $customer_info = '
                <div class="panel" style="border-color: #2d4161;">
                    <div style="color: #ffffff;background-color: #2d4161;border-color: #2d4161;padding: 5px;">
                        <span style="font-size:14px;">'.$Customer->name .' - '.$Customer->customer_code.'</span>
                        
                        <a href="javascript:void(0)" class="btn btn-default btn-xs" style=" float: right; height: 20px; background-color: #2d4161; margin-right: 2px;" id="UnlinkCustomer"><i class="fa fa-times"></i></a>

                        <a href="javascript:void(0)" class="btn btn-default btn-xs" style=" float: right; height: 20px; background-color: #2d4161; margin-right: 2px;" id="EditCustomer" customer_id="'.$Customer->id.'"><i class="fa fa-edit"></i></a>

                    </div>
                    <div class="panel-body" style="padding: 5px;">
                        <table width="100%">
                            <tr>
                                <td>Mobile:</td>
                                <td>'.$Customer->mobile_no .'</td>
                                <td>Email:</td>
                                <td>'.$Customer->email .'</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td colspan="3">'.$Customer->address .'</td>
                            </tr>
                        </table>
                        <hr style="margin: 5px;" />
                        <table width="100%">
                            <tr>
                                <td><div>Favorites</div>';
                                    if(sizeof(@$BillRows)>0){
                                        $i=0;
                                        foreach ($BillRows as $BillRow) { $i++;
                                            $customer_info .='<li style="font-size: 12px;color: #464444;margin-left: 4px;">'.@$BillRow->item->name.'</li>';
                                            if($i==3){ break; }
                                        }
                                    }
                                $customer_info .='</td>
                                <td width="40%" style="padding: 2px;">
                                    <div style="text-align: right;">
                                        <span style="font-size: 12px;color: #8e8e8e;">Life Time:</span>
                                        <span style="font-size: 12px;color: #464444;margin-left: 4px;">₹ '. @$TotalAmount .'</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <span style="font-size: 12px;color: #8e8e8e;">This Month:</span>
                                        <span style="font-size: 12px;color: #464444;margin-left: 4px;">₹ '. @$TotalAmountMonth .'</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <span style="font-size: 12px;color: #8e8e8e;">Last Bill:</span>
                                        <span style="font-size: 12px;color: #464444;margin-left: 4px;">₹ '. @$LastBillAmount .'</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            ';



            $Response=['linked'=>'yes', 'customer_info'=>$customer_info];
        }else{
            $Response=['linked'=>'no'];
        }

        echo json_encode($Response);
        exit;
    }

    public function excel()
    {
        $this->viewBuilder()->layout('');

        $customers = $this->Customers->find();

        $this->set(compact('customers'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function checkCustomer()
    {
        $mobile_no=$this->request->query('mobile_no');
        $customer=$this->Customers->find()->where(['Customers.mobile_no'=>$mobile_no])->first();
        if($customer){
            echo $customer->id;
        }else{
            echo 0;
        }
        exit;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mobile_no=$this->request->query('mobile_no');
        $this->set(compact('mobile_no'));
    }

    public function saveCustomer()
    {
        $c_name=$this->request->query('c_name');
        $c_mobile_no=$this->request->query('c_mobile_no');
        $c_address=$this->request->query('c_address');

        $Customer = $this->Customers->newEntity();
        $Customer->name=$c_name;
        $Customer->mobile_no=$c_mobile_no;
        $Customer->address=$c_address;
        if ($this->Customers->save($Customer)) {
            echo $Customer->id;
        }else{
            echo 0;
        }
        exit;
    }

    public function saveNewCustomer()
    {
        $customer_name=$this->request->query('customer_name');
        $customer_mobile=$this->request->query('customer_mobile');
        $table_id=$this->request->query('table_id');

        $Customer = $this->Customers->find()->where(['Customers.mobile_no' => $customer_mobile])->first();
        if($Customer){
            $query = $this->Customers->Tables->query();
            $query->update()
                ->set(['customer_id' => $Customer->id])
                ->where(['Tables.id' => $table_id])
                ->execute();

            $query = $this->Customers->query();
            $query->update()
                ->set(['name' => $customer_name])
                ->where(['Customers.id' => $Customer->id])
                ->execute();
        }else{
            $Customer = $this->Customers->newEntity();
            $Customer->name=$customer_name;
            $Customer->mobile_no=$customer_mobile;

            $lastCustomer=$this->Customers->find()->order(['Customers.id' => 'DESC'])->first();
            if($lastCustomer){
                $Customer->customer_code = $lastCustomer->customer_code+1;
            }else{
                $Customer->customer_code = 2001;
            }

            $this->Customers->save($Customer);

            $query = $this->Customers->Tables->query();
            $query->update()
                ->set(['customer_id' => $Customer->id])
                ->where(['Tables.id' => $table_id])
                ->execute();
        }

        echo 1;
        
        exit;
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view()
    {
        $c_id=$this->request->query('c_id');
        $customer = $this->Customers->get($c_id);
        
        $this->set(compact('customer', 'c_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function infoBill(){
        $this->viewBuilder()->layout('');
        $mobileCode=$this->request->query('mobileCode');
        $no_of_pax=$this->request->query('no_of_pax');

        $Customer=$this->Customers->find()
                 ->where(['OR' => array(
                            array("Customers.mobile_no" => $mobileCode),
                            array("Customers.customer_code" => $mobileCode)
                        )])
                 ->first();

        $this->set(compact('Customer', 'no_of_pax'));
    }

    public function birthdayList(){
        $this->viewBuilder()->layout('admin');

        $conn = ConnectionManager::get('default');
        $currentDate=date('Y-m-d');
        $DateAfterSevenDays=date('Y-m-d', strtotime($currentDate. ' + 7 days'));
       
        $stmt = $conn->execute("SELECT * FROM customers Customers WHERE (DATE_FORMAT(dob, '%m-%d') >= DATE_FORMAT('".$currentDate."', '%m-%d') and DATE_FORMAT(dob, '%m-%d') <= DATE_FORMAT('".$DateAfterSevenDays."', '%m-%d')) or (DATE_FORMAT(anniversary, '%m-%d') >= DATE_FORMAT('".$currentDate."', '%m-%d') and DATE_FORMAT(anniversary, '%m-%d') <= DATE_FORMAT('".$DateAfterSevenDays."', '%m-%d')) ");
        $customers = $stmt->fetchAll('assoc');

        $this->set(compact('customers'));
    }

    public function saveCommentInfo(){
        $customer_name = $this->request->query('customer_name');
        $customer_mobile = $this->request->query('customer_mobile');
        $customer_email = $this->request->query('customer_email');
        $customer_dob = date('Y-m-d', strtotime($this->request->query('customer_dob')));
        $customer_anniversary = date('Y-m-d', strtotime($this->request->query('customer_anniversary')));
        $customer_address = $this->request->query('customer_address');
        $table_id = $this->request->query('table_id');

        $Customer=$this->Customers->find()
                 ->where(["Customers.mobile_no" => $customer_mobile])
                 ->first();
        if($Customer){
            $Customer = $this->Customers->get($Customer->id);
            $Customer->name = $customer_name;
            $Customer->address = $customer_address;
            $Customer->dob = $customer_dob;
            $Customer->anniversary = $customer_anniversary;
            $Customer->email = $customer_email;
            $this->Customers->save($Customer);

            $query = $this->Customers->Tables->query();
            $query->update()
                ->set(['customer_id' => $Customer->id])
                ->where(['Tables.id' => $table_id])
                ->execute();
        }else{
            $Customer = $this->Customers->newEntity();
            $Customer->name = $customer_name;
            $Customer->address = $customer_address;
            $Customer->dob = $customer_dob;
            $Customer->anniversary = $customer_anniversary;
            $Customer->email = $customer_email;
            $Customer->mobile_no = $customer_mobile;

            $lastCustomer=$this->Customers->find()->order(['Customers.id' => 'DESC'])->first();
            if($lastCustomer){
                $Customer->customer_code = $lastCustomer->customer_code+1;
            }else{
                $Customer->customer_code = 2001;
            }

            $this->Customers->save($Customer);

            $query = $this->Customers->Tables->query();
            $query->update()
                ->set(['customer_id' => $Customer->id])
                ->where(['Tables.id' => $table_id])
                ->execute();
        }

        echo 1; exit;
    }

    public function portfolio($id=null){
        $this->viewBuilder()->layout('admin');
        $Customer = $this->Customers->get($id);

         $Bills = $this->Customers->Bills->find()
                    ->where(['Bills.customer_id' => $Customer->id, 'Bills.is_deleted' => 'no'])
                    ->autoFields(true)
                    ->contain(['Tables', 'Employees', 'BillRows'=>['Items'] ]);

        $this->set(compact('Customer', 'Bills'));
    }

    public function autocompleteCustomers(){
        $this->viewBuilder()->layout('');
        $q = $this->request->query('q');

        $Customers = $this->Customers->find()->where(['mobile_no LIKE' => '%'.$q.'%']);
        $customers=[];
        foreach ($Customers as $Customer) {
            $customers[]=$Customer->name.'-'.$Customer->mobile_no;
        }
        

        //$customers = ['manoj-9638527410', 'vikas-96385271015'];
        $object = (object) $customers;
        echo json_encode($object);
        exit;
    }

    public function customerSection(){

        $customer_id = $this->request->query('customer_id');
        $Customer = $this->Customers->get($customer_id);

        $BillRows= $this->Customers->Tables->Bills->BillRows->find();
            $BillRows->select(['TotalQuantity' => $BillRows->func()->SUM('BillRows.quantity')])
                        ->group(['BillRows.item_id'])
                        ->order(['TotalQuantity' => 'DESC'])
                        ->matching('Bills', function($q) use($Customer){
                            return $q->where(['Bills.customer_id' => $Customer->id]);
                        })
                        ->limit(3)
                        ->contain(['Items'])
                        ->autoFields(true);

            $Bills= $this->Customers->Tables->Bills->find();
            $Bills->select(['TotalAmount' => $Bills->func()->SUM('Bills.grand_total')])
            ->group(['Bills.customer_id'])
            ->where(['Bills.customer_id' => $Customer->id])
            ->first();

            $TotalAmount = @$Bills->toArray()[0]['TotalAmount'];



            $currentDate=date('Y-m');
            $lastDate=date("Y-m-t", strtotime($currentDate));
            $Bills= $this->Customers->Tables->Bills->find();
            $Bills->select(['TotalAmount' => $Bills->func()->SUM('Bills.grand_total')])
            ->group(['Bills.customer_id'])
            ->where(['Bills.customer_id' => $Customer->id])
            ->where([
                'Bills.transaction_date >=' => $currentDate.'-1', 
                'Bills.transaction_date <=' => $lastDate, 
            ])
            ->first();

            $TotalAmountMonth = @$Bills->toArray()[0]['TotalAmount'];



            $Bills= $this->Customers->Tables->Bills->find();
            $Bills->where(['Bills.customer_id' => $Customer->id])
            ->order(['Bills.voucher_no' => 'DESC'])
            ->first();

            $LastBillAmount = @$Bills->toArray()[0]['grand_total'];

            $customer_info = '
                <div class="panel" style="border-color: #2d4161;">
                    <div style="color: #ffffff;background-color: #2d4161;border-color: #2d4161;padding: 5px;">
                        <span style="font-size:14px;">'.$Customer->name .' - '.$Customer->customer_code.'</span>

                        <a href="javascript:void(0)" class="btn btn-default btn-xs" style=" float: right; height: 20px; background-color: #2d4161; margin-right: 2px;" id="UnlinkCustomer"><i class="fa fa-times"></i></a>

                        <a href="javascript:void(0)" class="btn btn-default btn-xs" style=" float: right; height: 20px; background-color: #2d4161; margin-right: 2px;" id="EditCustomer" customer_id="'.$Customer->id.'"><i class="fa fa-edit"></i></a>
                    </div>
                    <div class="panel-body" style="padding: 5px;">
                        <table width="100%">
                            <tr>
                                <td>Mobile:</td>
                                <td>'.$Customer->mobile_no .'</td>
                                <td>Email:</td>
                                <td>'.$Customer->email .'</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td colspan="3">'.$Customer->address .'</td>
                            </tr>
                        </table>
                        <hr style="margin: 5px;" />
                        <table width="100%">
                            <tr>
                                <td><div>Favorites</div>';
                                    if(sizeof(@$BillRows)>0){
                                        $i=0;
                                        foreach ($BillRows as $BillRow) { $i++;
                                            $customer_info .='<li style="font-size: 12px;color: #464444;margin-left: 4px;">'.@$BillRow->item->name.'</li>';
                                            if($i==3){ break; }
                                        }
                                    }
                                $customer_info .='</td>
                                <td width="40%" style="padding: 2px;">
                                    <div style="text-align: right;">
                                        <span style="font-size: 12px;color: #8e8e8e;">Life Time:</span>
                                        <span style="font-size: 12px;color: #464444;margin-left: 4px;">₹ '. @$TotalAmount .'</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <span style="font-size: 12px;color: #8e8e8e;">This Month:</span>
                                        <span style="font-size: 12px;color: #464444;margin-left: 4px;">₹ '. @$TotalAmountMonth .'</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <span style="font-size: 12px;color: #8e8e8e;">Last Bill:</span>
                                        <span style="font-size: 12px;color: #464444;margin-left: 4px;">₹ '. @$LastBillAmount .'</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            ';

            echo $customer_info; exit;
    }

    public function checkUnique(){
        $c_unique_code = $this->request->query('c_unique_code');

        $Customers = $this->Customers->find()->where(['c_unique_code' => $c_unique_code])->first();
        if($Customers){
            echo 'false';
        }else{
            echo 'true';
        }
        exit;
    }

    public function checkUniqueEdit(){

        $c_unique_code = $this->request->data['c_unique_code'];
        $customer_id = $this->request->data['customer_id'];

        $Customer = $this->Customers->find()->where(['c_unique_code' => $c_unique_code, 'Customers.id !=' => $customer_id])->first();
        if($Customer){
            echo 'false';
        }else{
            echo 'true';
        }
        exit;
    }

    
}
