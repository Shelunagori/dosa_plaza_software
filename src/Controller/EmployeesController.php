<?php
namespace App\Controller;

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
    public function index()
    {
		$this->viewBuilder()->layout('admin');
        $employees = $this->paginate($this->Employees->find()->where(['is_deleted'=>0]));
        $this->set(compact('employees'));
    }
 
    public function view($id = null)
    {
		$this->viewBuilder()->layout('admin');
        $employee = $this->Employees->get($id, [
            'contain' => ['Attendances']
        ]);

        $this->set('employee', $employee);
    }
    public function add($id = null)
    {
		$this->viewBuilder()->layout('admin');
		if(!$id)
		{
			$employee = $this->Employees->newEntity();
		}
		else{
			$employee = $this->Employees->get($id, [
				'contain' => []
			]);
		}
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee','id'));
    }
      
    public function delete($id = null)
    {
       $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
		$employee = $this->Employees->patchEntity($employee, $this->request->getData());
		$employee->is_deleted=1;
		if ($this->Employees->save($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	 public function EmployeesAttendance()
	{
		$this->viewBuilder()->layout('admin');
		$Employees =	$this->Employees->find();
		
		$this->set(compact('Employees')); 
	}
}
