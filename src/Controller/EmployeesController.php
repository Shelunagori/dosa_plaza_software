<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 *
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
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
            $employee = $this->Auth->identify();
            if ($employee) 
			{
				$employee=$this->Employees->get($employee['id']);
				
				$this->loadModel('Years');
				$ActiveYear=$this->Years->find()->where(['status'=>'active'])->first();
				$employee->ActiveYear=$ActiveYear;
                $this->Auth->setUser($employee);
				return $this->redirect(['controller'=>'Employees','action' => 'Dashboard']);
            }
            $this->Flash->error(__('Invalid Username or Password'));
        }
		$employee = $this->Employees->newEntity();
        $this->set(compact('employee'));
    }
	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
		$this->viewBuilder()->layout('main');
		if($id)
		{
			$employee = $this->Employees->get($id, [
            'contain' => []
        ]);
		}
		else
		{
			$employee = $this->Employees->newEntity();
		}
		 if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->data);
			$employee->name = trim($employee->name); 
			$employee->username = trim($employee->username); 
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } 
			else {
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
            }
        } 

		$employees = $this->Employees->find()->order(['Employees.id' => 'DESC']);  
        $this->set(compact('employee', 'employees','id'));
      //  $this->set('_serialize', ['section']);
        $employees = $this->paginate($this->Employees);
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function dashboard()
    {
        $this->viewBuilder()->layout('main');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
		$this->viewBuilder()->layout('index_layout');
        if($id){ 
			$employee = $this->Employees->get($id, [
            'contain' => []
			]);
		}else{
			 $employee = $this->Employees->newEntity();
		} 
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->data);		 
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('Account has been created.')); 
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        } 
        $employees = $this->paginate($this->Employees);
		$this->set(compact('employee', 'employees'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
