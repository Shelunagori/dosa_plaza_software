<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EmployeeMarksAccesses Controller
 *
 * @property \App\Model\Table\EmployeeMarksAccessesTable $EmployeeMarksAccesses
 *
 * @method \App\Model\Entity\EmployeeMarksAccess[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeeMarksAccessesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('main');
        $this->paginate = [
            'contain' => ['Exams', 'Subjects', 'Employees']
        ];
        $employeeMarksAccesses = $this->paginate($this->EmployeeMarksAccesses);
		$subjects = $this->Subjects->id->find()->combine('id', 'title');


        $this->set(compact('employeeMarksAccesses'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee Marks Access id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employeeMarksAccess = $this->EmployeeMarksAccesses->get($id, [
            'contain' => ['Exams', 'Subjects', 'Employees']
        ]);

        $this->set('employeeMarksAccess', $employeeMarksAccess);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employeeMarksAccess = $this->EmployeeMarksAccesses->newEntity();
        if ($this->request->is('post')) {
            $employeeMarksAccess = $this->EmployeeMarksAccesses->patchEntity($employeeMarksAccess, $this->request->getData());
            if ($this->EmployeeMarksAccesses->save($employeeMarksAccess)) {
                $this->Flash->success(__('The employee marks access has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee marks access could not be saved. Please, try again.'));
        }
        $exams = $this->EmployeeMarksAccesses->Exams->find('list', ['limit' => 200]);
        $subjects = $this->EmployeeMarksAccesses->Subjects->find('list', ['limit' => 200]);
        $employees = $this->EmployeeMarksAccesses->Employees->find('list', ['limit' => 200]);
        $this->set(compact('employeeMarksAccess', 'exams', 'subjects', 'employees'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee Marks Access id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employeeMarksAccess = $this->EmployeeMarksAccesses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employeeMarksAccess = $this->EmployeeMarksAccesses->patchEntity($employeeMarksAccess, $this->request->getData());
            if ($this->EmployeeMarksAccesses->save($employeeMarksAccess)) {
                $this->Flash->success(__('The employee marks access has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee marks access could not be saved. Please, try again.'));
        }
        $exams = $this->EmployeeMarksAccesses->Exams->find('list', ['limit' => 200]);
        $subjects = $this->EmployeeMarksAccesses->Subjects->find('list', ['limit' => 200]);
        $employees = $this->EmployeeMarksAccesses->Employees->find('list', ['limit' => 200]);
        $this->set(compact('employeeMarksAccess', 'exams', 'subjects', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee Marks Access id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employeeMarksAccess = $this->EmployeeMarksAccesses->get($id);
        if ($this->EmployeeMarksAccesses->delete($employeeMarksAccess)) {
            $this->Flash->success(__('The employee marks access has been deleted.'));
        } else {
            $this->Flash->error(__('The employee marks access could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
