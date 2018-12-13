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
        
        $employees = $this->Employees->find()->contain(['Designations']);
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
		if(!$id){
			$employee = $this->Employees->newEntity($this->request->getData(), [
                            'associated' => ['Users']
                        ]);
		}
		else{
			$employee = $this->Employees->get(
                            $id, 
                            [
                                'associated' => ['Users'],
                                'contain' => ['Users']
                            ]
                        );
            $EmployeeSalary=$this->Employees->EmployeeSalaries->find()->where(['employee_id'=>$employee->id])->order(['effective_from'=>'DESC'])->first();
		}
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data=$this->request->getData();
            if($id){
                $username=$this->request->getData()['user']['username'];
                $password=$this->request->getData()['user']['password'];
                if(empty($username) or empty($password)){
                    $employee = $this->Employees->get($id);
                    $data=$this->request->getData();
                    unset($data['user']);
                }
            }else{
                $username=$this->request->getData()['user']['username'];
                $password=$this->request->getData()['user']['password'];
                if(empty($username) or empty($password)){
                    $employee = $this->Employees->newEntity();
                    $data=$this->request->getData();
                    unset($data['user']);
                }
            }
            
            $employee = $this->Employees->patchEntity($employee, $data);

            $employee->user->name=$employee->name;

            if ($this->Employees->save($employee)) {
                if(!$id){
                    $EmployeeSalary = $this->Employees->EmployeeSalaries->newEntity();
                    $EmployeeSalary->amount=$employee->salary;
                    $EmployeeSalary->employee_id=$employee->id;
                    $this->Employees->EmployeeSalaries->save($EmployeeSalary);
                }else{
                    if($employee->effective_from){
                        //Delete
                        $this->Employees->EmployeeSalaries->deleteAll([
                            'employee_id' => $employee->id,
                            'effective_from >=' => date('Y-m-d',strtotime('1-'.$employee->effective_from))
                        ]);

                        $EmployeeSalary = $this->Employees->EmployeeSalaries->newEntity();
                        $EmployeeSalary->amount=$employee->salary;
                        $EmployeeSalary->employee_id=$employee->id;
                        $EmployeeSalary->effective_from=date('Y-m-d',strtotime('1-'.$employee->effective_from));
                        $this->Employees->EmployeeSalaries->save($EmployeeSalary);
                    }
                }
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $Designations = $this->Employees->Designations->find('list')->where(['is_deleted'=>0]);
        $this->set(compact('employee','id','Designations', 'EmployeeSalary'));
    }
      
    public function delete($id = null)
    {
       $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
		$employee = $this->Employees->patchEntity($employee, $this->request->getData());
        $employee->is_deleted=1;
        $employee->delete_month=date('m');
		$employee->delete_year=date('Y');
		if ($this->Employees->save($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function undelete($id = null)
    {
       $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
        $employee = $this->Employees->patchEntity($employee, $this->request->getData());
        $employee->is_deleted=0;
        if ($this->Employees->save($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

	public function EmployeesAttendance($month=null)
	{ 
		$this->viewBuilder()->layout('admin');
        $month=$this->request->query('month');
        $month1=explode('-', $month);
        $F_date=$month1[1].'-'.$month1[0].'-01';
        $first_date=date('Y-m-d',strtotime($F_date));
        $last_date=date('Y-m-t',strtotime($F_date));
        $Employees = $this->Employees->find()->contain([
                        'Designations',
                        'Attendances'=>function($q)use($first_date,$last_date){
                            return $q->where(['Attendances.attendance_date >=' => $first_date,'Attendances.attendance_date <=' => $last_date]);
                        },
                        'EmployeeSalaries'=>function($q) use($first_date){
                            return $q->order(['effective_from' => 'DESC'])->where(['effective_from <=' => $first_date]);
                        }
                    ]);
        $AttendancesArray=array();
        foreach ($Employees as $employee) {
            $employee_id=$employee->id;
            foreach ($employee->attendances as $attendance) {
                $Date=strtotime($attendance->attendance_date);
                $attendance_status=$attendance->attendance_status;
                $AttendancesArray[$employee_id][$Date]=$attendance_status;
                
            }
        }         
 		$this->set(compact('Employees','month','AttendancesArray')); 
	}

    public function EmployeesAttendanceExcel()
    {
        $this->viewBuilder()->layout('');

        if ($this->request->is(['patch','post','put'])){
            $excel_box = $this->request->data['excel_box'];

            $date= date("d-m-Y"); 
            $time=date('h:i:a',time());

            $filename="Attendance-Report-".$date.'_'.$time;

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

    public function comparison(){
        $this->viewBuilder()->layout('admin');

        $date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));
        $from_date=$from_date.' 00:00:00';
        $to_date=$to_date.' 23:59:59';

        $Employees = $this->Employees->find()
                        ->innerJoinWith('Kots', function($q) use($from_date, $to_date){
                            return $q->where([
                                'Kots.created_on >=' => $from_date, 
                                'Kots.created_on <=' => $to_date
                            ])->innerJoinWith('KotRows');
                        } );
        $Employees->select(['Employees.id','Employees.name','kot_ro_amount'=>$Employees->func()->sum('KotRows.amount')])->order(['Employees.name' => 'ASC'])->group('Employees.id');


        $this->set(compact('from_date','to_date', 'Employees', 'exploded_date_from_to'));
    }

}
