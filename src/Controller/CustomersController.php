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
}
