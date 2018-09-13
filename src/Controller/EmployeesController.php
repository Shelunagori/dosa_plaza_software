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
        $this->paginate = [
            'contain' => ['Designations']
        ];
        $employees = $this->paginate($this->Employees->find()->where(['Employees.is_deleted'=>0]));
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
        $Designations = $this->Employees->Designations->find('list', ['limit' => 200])->where(['is_deleted'=>0]);
        $this->set(compact('employee','id','Designations'));
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
        $Employees = $this->Employees->find()->contain(['Designations','Attendances'=>function($q)use($first_date,$last_date){
            return $q->where(['Attendances.attendance_date >=' => $first_date,'Attendances.attendance_date <=' => $last_date]);
        }]);
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

        $EmpSales=$this->Employees->Bills->find()->where([
            'Bills.employee_id = Employees.id', 
            'Bills.transaction_date >=' => $from_date, 
            'Bills.transaction_date <=' => $to_date
        ]);
        $EmpSales->select([$EmpSales->func()->sum('Bills.grand_total')]);


        $Employees = $this->Employees->find();
        $Employees->select([
            'id', 'name',
            'Emp_Sales' => $EmpSales,
        ])
        ->order(['Employees.name' => 'ASC']);


        $this->set(compact('from_date','to_date', 'Employees', 'exploded_date_from_to'));
    }

}
