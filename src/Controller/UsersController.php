<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;

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
                if($user['role']=='admin'){
                    return $this->redirect(['controller'=>'Users','action' => 'Dashboard']);
                }
                else{
                    return $this->redirect(['controller'=>'tables','action' => 'index']);
                }				
            }
            $this->Flash->error(__('Invalid Username or Password'));
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
        $TotalOrdeODelevery=0;
        $TotalSaleDelevery=0;
        foreach ($Delevery as $value) {
            $TotalOrdeODelevery=$value->TotalOrdeODelevery;
            $TotalSaleDelevery=$value->TotalSaleDelevery;
        }
        //-- Take Away
        $TakeAway=$this->Bills->find();  
        $TakeAway  ->select([
                    'TotalOrdeTakeAway' => $TakeAway->func()->count('*'),
                    'TotalSaleTakeAway' => $TakeAway->func()->sum('Bills.grand_total')
                    ])
                ->where(['Bills.created_on >=' => date('Y-m-d').' 00:00:00', 'Bills.created_on <=' => date('Y-m-d').' 23:59:59','order_type'=>'takeaway'])
                ->toArray();
        $TotalOrdeTakeAway=0;
        $TotalSaleTakeAway=0;
        foreach ($TakeAway as $value) {
            $TotalOrdeTakeAway=$value->TotalOrdeTakeAway;
            $TotalSaleTakeAway=$value->TotalSaleTakeAway;
        }
        //-- Dinner In
        $Dinner=$this->Bills->find();  
        $Dinner  ->select([
                    'TotalOrdeDinner' => $Dinner->func()->count('*'),
                    'TotalSaleDinner' => $Dinner->func()->sum('Bills.grand_total')
                    ])
                ->where(['Bills.created_on >=' => date('Y-m-d').' 00:00:00', 'Bills.created_on <=' => date('Y-m-d').' 23:59:59','order_type'=>'dinner'])
                ->toArray();
        $TotalOrdeDinner=0;
        $TotalSaleDinner=0;
        foreach ($Dinner as $value) {
            $TotalOrdeDinner=$value->TotalOrdeDinner;
            $TotalSaleDinner=$value->TotalSaleDinner;
        }

        //-- Birth Day
       // $TotalBirthDay=0;
       // $Customers=$this->Users->Customers->find()->where(['Customers.dob !='=>'0000-00-00','Customers.dob LIKE' => "%".date('m',strtotime('+7 days'))."%"]);  
       //  $Customers  ->select([
       //              'TotalBirthDay' => $Customers->func()->count('*'),
       //              ])
       //          ->where(['Customers.dobs !='=>'0000-00-00','Customers.dob LIKE' => "%".date('m-d',strtotime('+7 days'))."%"])
       //          ->autoFields(true)
       //          ->toArray();
         
       //  pr($Customers->toArray()); exit;

       //  $TotalOrdeDinner=0;
       //  $TotalSaleDinner=0;
       //  foreach ($Dinner as $value) {
       //      $TotalOrdeDinner=$value->TotalOrdeDinner;
       //      $TotalSaleDinner=$value->TotalSaleDinner;
       //  }

       
            


        $this->set(compact('TotalOrdeDinner','TotalOrdeODelevery','TotalSaleDelevery','TotalOrdeTakeAway','TotalSaleTakeAway','TotalSaleDinner'));
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
