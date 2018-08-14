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
				$user=$this->Users->get($user['id']);
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
        
         // $stmt = $conn->execute("SELECT * FROM customers Customers WHERE DATE_FORMAT(dob, '%m-%d') = DATE_FORMAT('".$currentDate."', '%m-%d') or DATE_FORMAT(anniversary, '%m-%d') = DATE_FORMAT('".$currentDate."', '%m-%d') ");
        // // Read all rows.
        // $rows = $stmt->fetchAll('assoc');

        // // Read rows through iteration.
        // foreach ($rows as $row) {
        //     pr($row);
        // }

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


        $CashPer=round($CashSale*100/($CashSale+$CardSale+$PaytmSale),2);
        $CardPer=round($CardSale*100/($CashSale+$CardSale+$PaytmSale),2);
        $PaytmPer=round($PaytmSale*100/($CashSale+$CardSale+$PaytmSale),2);

        $this->set(compact('TotalOrdeDinner','TotalOrdeODelevery','TotalSaleDelevery','TotalOrdeTakeAway','TotalSaleTakeAway','TotalSaleDinner', 'upcommingBirthdayAnniversary', 'CashSale', 'CardSale', 'PaytmSale', 'CashPer', 'CardPer', 'PaytmPer'));
    }
	
	public function dashboard2()
    {
        $this->viewBuilder()->layout('counter');
		
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
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
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
}
