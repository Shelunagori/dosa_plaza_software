<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Attendances Controller
 *
 * @property \App\Model\Table\AttendancesTable $Attendances
 *
 * @method \App\Model\Entity\Attendance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AttendancesController extends AppController
{
    public function index()
    {
		$this->viewBuilder()->layout('admin');
        $this->paginate = [
            'contain' => ['Employees']
        ];
        $attendances = $this->paginate($this->Attendances);

        $this->set(compact('attendances'));
    }

     
    public function view($id = null)
    {
		$this->viewBuilder()->layout('admin');
        $attendance = $this->Attendances->get($id, [
            'contain' => ['Employees']
        ]);

        $this->set('attendance', $attendance);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('admin');
		
		$attendance_date=$this->request->query('attendance_date');
        $attendance_date=date('Y-m-d', strtotime($attendance_date));
        
        if ($this->request->is('post')) {
			 
			$Attendance=$this->request->getData('attendance');
			$employee_ids=$this->request->getData('employee_ids');
			$remarks=$this->request->getData('remarks');
			 
			$insert=0;
			foreach($employee_ids as $employee_id){
                //Delete Attendance
                $this->Attendances->deleteAll(['employee_id' => $employee_id, 'attendance_date' => $attendance_date]);

                if($Attendance[$employee_id]){
                     //Insert Attendance
                    $attendanceinsert = $this->Attendances->newEntity();
                    $attendanceinsert->employee_id=$employee_id;
                    $attendanceinsert->attendance_status=$Attendance[$employee_id];
                    $attendanceinsert->remarks=$remarks[$employee_id];
                    $attendanceinsert->attendance_date=$attendance_date;
                    if ($this->Attendances->save($attendanceinsert)) { 
                        $insert=1;
                    }
                }
               
			}
			if($insert==1){
				$this->Flash->success(__('The attendance has been saved.'));
				return $this->redirect(['action' => 'add']);
			}
			$this->Flash->error(__('The attendance could not be saved. Please, try again.'));	
        }

        $employees = $this->Attendances->Employees->find()  
                        ->contain(['Attendances' => function($q) use($attendance_date){
                            return $q->where(['Attendances.attendance_date' => $attendance_date]);
                        }])
						->where(['Employees.is_deleted'=>0]);
        //pr($employees->toArray()); exit;
        $this->set(compact('attendance', 'employees', 'attendance_date'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Attendance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('admin');
        $attendance = $this->Attendances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendance = $this->Attendances->patchEntity($attendance, $this->request->getData());
            if ($this->Attendances->save($attendance)) {
                $this->Flash->success(__('The attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attendance could not be saved. Please, try again.'));
        }
        $employees = $this->Attendances->Employees->find()->where(['is_deleted'=>0]);
        $this->set(compact('attendance', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Attendance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attendance = $this->Attendances->get($id);
        if ($this->Attendances->delete($attendance)) {
            $this->Flash->success(__('The attendance has been deleted.'));
        } else {
            $this->Flash->error(__('The attendance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
