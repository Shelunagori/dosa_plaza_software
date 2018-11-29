<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['logout','login','add']);
	}

	public function login()
    {
		$this->viewBuilder()->layout('login');
        if ($this->request->is('post')) 
		{
            $user = $this->Auth->identify();
            if ($user) 
			{
				$user = $this->Users->find()->contain(['Employees'])->where(['Users.id' =>$user['id']])->first();
				//$user=$this->Users->get($user['id'])->contain(['Employees']);
				$this->Auth->setUser($user);
               
                return $this->redirect(['controller'=>'Users','action' => 'Dashboard']);
                			
            }
            $this->Flash->error2(__('Invalid Username or Password'));
        }
		$user = $this->Users->newEntity();
        $this->set(compact('user'));
    }

	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}
	
	public function dashboard()
    {
        $this->viewBuilder()->layout('admin');
        //--  Delevery
        $Delevery=$this->Bills->find();  
        $Delevery  ->select([
                    'TotalOrdeODelevery' => $Delevery->func()->count('*'),
                    'TotalSaleDelevery' => $Delevery->func()->sum('Bills.grand_total')
                    ])
                ->where(['Bills.created_on >=' => date('Y-m-d').' 00:00:00', 'Bills.created_on <=' => date('Y-m-d').' 23:59:59','order_type'=>'delivery'])
                ->toArray(); 
        foreach ($Delevery as $value) {
            $TotalOrdeODelevery=$value->TotalOrdeODelevery;
            $TotalSaleDelevery=$value->TotalSaleDelevery;
        }
        if(empty($TotalOrdeODelevery)){$TotalOrdeODelevery=0;}
        if(empty($TotalSaleDelevery)){$TotalSaleDelevery=0;}
        //-- Take Away
        $TakeAway=$this->Bills->find();  
        $TakeAway  ->select([
                    'TotalOrdeTakeAway' => $TakeAway->func()->count('*'),
                    'TotalSaleTakeAway' => $TakeAway->func()->sum('Bills.grand_total')
                    ])
                ->where(['Bills.created_on >=' => date('Y-m-d').' 00:00:00', 'Bills.created_on <=' => date('Y-m-d').' 23:59:59','order_type'=>'takeaway'])
                ->toArray(); 
        foreach ($TakeAway as $value) {
            $TotalOrdeTakeAway=$value->TotalOrdeTakeAway;
            $TotalSaleTakeAway=$value->TotalSaleTakeAway;
        }
        if(empty($TotalOrdeTakeAway)){$TotalOrdeTakeAway=0;}
        if(empty($TotalSaleTakeAway)){$TotalSaleTakeAway=0;}
        //-- Dinner In
        $Dinner=$this->Bills->find();  
        $Dinner  ->select([
                    'TotalOrdeDinner' => $Dinner->func()->count('*'),
                    'TotalSaleDinner' => $Dinner->func()->sum('Bills.grand_total')
                    ])
                ->where(['Bills.created_on >=' => date('Y-m-d').' 00:00:00', 'Bills.created_on <=' => date('Y-m-d').' 23:59:59','order_type'=>'dinner'])
                ->toArray();
        foreach ($Dinner as $value) {
            $TotalOrdeDinner=$value->TotalOrdeDinner;
            $TotalSaleDinner=$value->TotalSaleDinner;
        }
        if(empty($TotalOrdeDinner)){$TotalOrdeDinner=0;}
        if(empty($TotalSaleDinner)){$TotalSaleDinner=0;}
        
        $conn = ConnectionManager::get('default');
        $currentDate=date('Y-m-d');
        $DateAfterSevenDays=date('Y-m-d', strtotime($currentDate. ' + 7 days'));
       
        $stmt = $conn->execute("SELECT COUNT(id) FROM customers Customers WHERE (DATE_FORMAT(dob, '%m-%d') >= DATE_FORMAT('".$currentDate."', '%m-%d') and DATE_FORMAT(dob, '%m-%d') <= DATE_FORMAT('".$DateAfterSevenDays."', '%m-%d')) or (DATE_FORMAT(anniversary, '%m-%d') >= DATE_FORMAT('".$currentDate."', '%m-%d') and DATE_FORMAT(anniversary, '%m-%d') <= DATE_FORMAT('".$DateAfterSevenDays."', '%m-%d')) ");
        $rows = $stmt->fetchAll('assoc');
        $upcommingBirthdayAnniversary=$rows[0]['COUNT(id)'];
        
        

        $Bills=$this->Users->Bills->find();
        $Bills->select([
            'CashSale' => $Bills->func()->sum('grand_total'),
        ])
        ->where(['Bills.transaction_date' => date('Y-m-d'), 'Bills.payment_type' => 'cash']);
        $CashSale = $Bills->toArray()[0]['CashSale']; 

        $Bills=$this->Users->Bills->find();
        $Bills->select([
            'CardSale' => $Bills->func()->sum('grand_total'),
        ])
        ->where(['Bills.transaction_date' => date('Y-m-d'), 'Bills.payment_type' => 'card']);
        $CardSale = $Bills->toArray()[0]['CardSale']; 

        $Bills=$this->Users->Bills->find();
        $Bills->select([
            'PaytmSale' => $Bills->func()->sum('grand_total'),
        ])
        ->where(['Bills.transaction_date' => date('Y-m-d'), 'Bills.payment_type' => 'paytm']);
        $PaytmSale = $Bills->toArray()[0]['PaytmSale']; 


        if(($CashSale+$CardSale+$PaytmSale)>0){
            $CashPer=round($CashSale*100/($CashSale+$CardSale+$PaytmSale),2);
            $CardPer=round($CardSale*100/($CashSale+$CardSale+$PaytmSale),2);
            $PaytmPer=round($PaytmSale*100/($CashSale+$CardSale+$PaytmSale),2);
        }else{
            $CashPer=0;
            $CardPer=0;
            $PaytmPer=0;
        }
        

        $Attendances = $this->Users->Attendances->find()
                        ->where(['Attendances.attendance_status IN' => [3,4], 'Attendances.attendance_date' => date('Y-m-d')])
                        ->contain(['Employees']);


        //Sales Comparison Start//
        $CurrentMonth = date('m');
        $PreviousMonth = $CurrentMonth-1;
        $NextMonth = $CurrentMonth+1;

        $CurrentYear = date('Y');
        $PreviousYear = $CurrentYear-1;
        $NextYear = $CurrentYear+1;

        //last year previous month//
        $LastYearPreviousMonthSale = $this->Users->Bills->find();
        $LastYearPreviousMonthSale->where([
            'Bills.transaction_date >=' => $PreviousYear.'-'.$PreviousMonth.'-1', 
            'Bills.transaction_date <=' => date("Y-m-t", strtotime($PreviousYear.'-'.$PreviousMonth.'-1'))
        ])
        ->select([
            'Total_sale' => $LastYearPreviousMonthSale->func()->sum('Bills.grand_total')
        ])
        ->group(['MONTH(transaction_date)']);
        $LastYearPreviousMonthSale = @$LastYearPreviousMonthSale->first()->Total_sale;

        //last year current month//
        $LastYearCurrentMonthSale = $this->Users->Bills->find();
        $LastYearCurrentMonthSale->where([
            'Bills.transaction_date >=' => $PreviousYear.'-'.$CurrentMonth.'-1', 
            'Bills.transaction_date <=' => date("Y-m-t", strtotime($PreviousYear.'-'.$CurrentMonth.'-1'))
        ])
        ->select([
            'Total_sale' => $LastYearCurrentMonthSale->func()->sum('Bills.grand_total')
        ])
        ->group(['MONTH(transaction_date)']);
        $LastYearCurrentMonthSale = @$LastYearCurrentMonthSale->first()->Total_sale;

        $LastYearFutureMonthSale=0;
        if($CurrentMonth<12){
            //last year future month//
            $LastYearFutureMonthSale = $this->Users->Bills->find();
            $LastYearFutureMonthSale->where([
                'Bills.transaction_date >=' => $PreviousYear.'-'.$NextMonth.'-1', 
                'Bills.transaction_date <=' => date("Y-m-t", strtotime($PreviousYear.'-'.$NextMonth.'-1'))
            ])
            ->select([
                'Total_sale' => $LastYearFutureMonthSale->func()->sum('Bills.grand_total')
            ])
            ->group(['MONTH(transaction_date)']);
            $LastYearFutureMonthSale = @$LastYearFutureMonthSale->first()->Total_sale;
        }

        $CurrentYearLastMonthSale=0;
        if($CurrentMonth>1){
            //current year previous month//
            $CurrentYearLastMonthSale = $this->Users->Bills->find();
            $CurrentYearLastMonthSale->where([
                'Bills.transaction_date >=' => $CurrentYear.'-'.$PreviousMonth.'-1', 
                'Bills.transaction_date <=' => date("Y-m-t", strtotime($CurrentYear.'-'.$PreviousMonth.'-1'))
            ])
            ->select([
                'Total_sale' => $CurrentYearLastMonthSale->func()->sum('Bills.grand_total')
            ])
            ->group(['MONTH(transaction_date)']);
            $CurrentYearLastMonthSale = @$CurrentYearLastMonthSale->first()->Total_sale;
        }

        //current year current month//
        $CurrentYearCurrentMonthSale = $this->Users->Bills->find();
        $CurrentYearCurrentMonthSale->where([
            'Bills.transaction_date >=' => $CurrentYear.'-'.$CurrentMonth.'-1', 
            'Bills.transaction_date <=' => date("Y-m-t", strtotime($CurrentYear.'-'.$CurrentMonth.'-1'))
        ])
        ->select([
            'Total_sale' => $CurrentYearCurrentMonthSale->func()->sum('Bills.grand_total')
        ])
        ->group(['MONTH(transaction_date)']);
        $CurrentYearCurrentMonthSale = @$CurrentYearCurrentMonthSale->first()->Total_sale;

        //Sales Comparison End//

        //---------------------------------------------------//
        //          UPCOMING BOOKINGS START
        //---------------------------------------------------//
        $Bookings = $this->Users->Bookings->find()->where(['Bookings.booking_date >=' => date('Y-m-d') ])->order(['Bookings.booking_date' => 'ASC'])->limit(3);
        //---------------------------------------------------//
        //          UPCOMING BOOKINGS END
        //---------------------------------------------------//


        $this->set(compact('TotalOrdeDinner','TotalOrdeODelevery','TotalSaleDelevery','TotalOrdeTakeAway','TotalSaleTakeAway','TotalSaleDinner', 'upcommingBirthdayAnniversary', 'CashSale', 'CardSale', 'PaytmSale', 'CashPer', 'CardPer', 'PaytmPer', 'Attendances', 'LastYearPreviousMonthSale', 'LastYearCurrentMonthSale', 'LastYearFutureMonthSale', 'CurrentYearLastMonthSale', 'CurrentYearCurrentMonthSale', 'Bookings'));
    }
	
	public function dashboard2()
    {
        $this->viewBuilder()->layout('counter');

        // $tmpdir = sys_get_temp_dir();
        // $file =  tempnam($tmpdir, 'ctk');
        // $handle = fopen($file, 'w');

        // $data = 'hello';

        // fwrite($handle, $data);
        // fclose($handle);
        // system('print '.$file.'');
        // echo exec('lpr '.$file.'');
        // echo system("lp ".$file);
        // //unlink($file);
        // exit;
		
		$Tables=$this->Users->Tables->find();
		$ItemCategories=$this->Users->ItemCategories->find()->contain(['ItemSubCategories'=>['Items']]);
		$Items=$this->Users->ItemCategories->ItemSubCategories->Items->find()->order(['Items.name'=>'ASC']);
		$this->set(compact('Tables', 'ItemCategories', 'Items'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id)
    {
        $this->viewBuilder()->layout('admin');
        if($id){
            $user = $this->Users->get($id, [
                'contain' => ['Employees']
            ]);
        }else{
            $user = $this->Users->newEntity();
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

       $users = $this->Users->find()->contain(['Employees']);
		//$Designations = $this->Users->Designations->find('list', ['keyField' => 'name','valueField' => 'name'])->where(['is_deleted'=>0]);
        $employees = $this->Users->Employees->find('list')->where(['is_deleted'=>0]);
		$this->set(compact('users', 'user', 'id','employees'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function reports(){
        $this->viewBuilder()->layout('admin');
    }

    public function createCopy()
    {
        $this->viewBuilder()->layout('admin');
        
        $conn = ConnectionManager::get('default');
        
        $stmt = $conn->execute(" SELECT * FROM `bill_settings` ");
        $rows = $stmt->fetchAll('assoc');
        $last_copied_bill_id=$rows[0]['last_copied_bill_id'];
        $stmt = $conn->execute(" INSERT INTO copy_bill SELECT * FROM bills WHERE `id`>$last_copied_bill_id  ");
        $stmt = $conn->execute(" INSERT INTO copy_bill_row SELECT * FROM bill_rows WHERE `bill_id`>$last_copied_bill_id  ");

        $stmt = $conn->execute(" SELECT * FROM `bills` ORDER BY `id` DESC LIMIT 1  ");
        $rows = $stmt->fetchAll('assoc');
        $last_copied_bill_id=$rows[0]['id'];
        if(!$last_copied_bill_id){ $last_copied_bill_id=0; }

        $stmt = $conn->execute(" UPDATE `bill_settings` SET `last_copied_bill_id`=$last_copied_bill_id WHERE `id`=1  ");

        return $this->redirect(['action' => 'switchToDummy']);
    }

    public function switchToDummy()
    {
        $this->viewBuilder()->layout('admin');
        
        $conn = ConnectionManager::get('default');
        
        $stmt = $conn->execute("RENAME TABLE `bills` TO `copy_bill` ");
        $stmt = $conn->execute("RENAME TABLE `bill_rows` TO `copy_bill_row` ");
        $stmt = $conn->execute("RENAME TABLE `copy_bills` TO `bills` ");
        $stmt = $conn->execute("RENAME TABLE `copy_bill_rows` TO `bill_rows` ");

        $stmt = $conn->execute(" UPDATE `bill_settings` SET `current_software`='Dummy' WHERE `id`=1  ");
        
        $this->Flash->success(__('System prepared with dummy data.'));
        return $this->redirect(['action' => 'Dashboard']);
    }

    public function switchToActual()
    {
        $this->viewBuilder()->layout('admin');
        
        $conn = ConnectionManager::get('default');
        
        $stmt = $conn->execute("RENAME TABLE `bills` TO `copy_bills` ");
        $stmt = $conn->execute("RENAME TABLE `bill_rows` TO `copy_bill_rows` ");
        $stmt = $conn->execute("RENAME TABLE `copy_bill` TO `bills` ");
        $stmt = $conn->execute("RENAME TABLE `copy_bill_row` TO `bill_rows` ");

        $stmt = $conn->execute(" UPDATE `bill_settings` SET `current_software`='Actual' WHERE `id`=1  ");
        
        $this->Flash->success(__('System prepared with actual data.'));
        return $this->redirect(['action' => 'Dashboard']);
    }
}
