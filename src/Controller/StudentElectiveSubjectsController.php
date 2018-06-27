<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StudentElectiveSubjects Controller
 *
 * @property \App\Model\Table\StudentElectiveSubjectsTable $StudentElectiveSubjects
 *
 * @method \App\Model\Entity\StudentElectiveSubject[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentElectiveSubjectsController extends AppController
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
            'contain' => ['Students', 'Subjects']
        ];
        $studentElectiveSubjects = $this->paginate($this->StudentElectiveSubjects);

        $this->set(compact('studentElectiveSubjects'));
    }

    /**
     * View method
     *
     * @param string|null $id Student Elective Subject id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentElectiveSubject = $this->StudentElectiveSubjects->get($id, [
            'contain' => ['Students', 'Subjects']
        ]);

        $this->set('studentElectiveSubject', $studentElectiveSubject);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('main');
        
        $sections = $this->StudentElectiveSubjects->Subjects->Sections->find('threaded');
        $this->set(compact('studentElectiveSubject', 'sections'));
    }

	public function getStudentElectiveSubject($section_id=null)
    {
		$students = $this->StudentElectiveSubjects->Subjects->Sections->StudentInfos->find()->contain(['Students'])->where(['StudentInfos.section_id'=>$section_id]);
		$subjectIds = [];
		$subjects = $this->StudentElectiveSubjects->Subjects->find()->where(['Subjects.section_id'=>$section_id,'Subjects.elective'=>1]);
		if(sizeof($subjects)>0)
		{
			foreach($subjects as $subject)
			{
				$subjectIds[$subject->id] = $subject->id;
			}
		}
		$studentElectiveSubArr =[];
		$StudentElectiveSubjects= $this->StudentElectiveSubjects->find()->order(['id'=>'DESC']);
		if(sizeof($StudentElectiveSubjects->toArray())>0)
		{
			foreach($StudentElectiveSubjects as $StudentElectiveSubject)
			{
				$studentElectiveSubArr[$StudentElectiveSubject->student_id][$StudentElectiveSubject->subject_id]='checked';
			}
		}
		
		$this->set(compact('students','subjects','subjectIds','studentElectiveSubArr'));
	}
	
	public function assignStudentSubject($student_id=null,$evective_sub=null)
    {
		$studentElectiveSubject= $this->StudentElectiveSubjects->newEntity();
		$studentElectiveSubject->student_id = $student_id;
		$studentElectiveSubject->subject_id = $evective_sub;
		if($this->StudentElectiveSubjects->save($studentElectiveSubject))
		{
			echo "<div style=''>Save Student Elective Subject </div>";
		}
		else{
		 
			echo "<div style=''>Try  Again</div>";
		}
		exit;
		
	}
	public function assignStudentSubjectDeleted($student_id=null,$evective_sub=null)
    {
		if($this->StudentElectiveSubjects->deleteAll(['student_id' => $student_id,'subject_id'=>$evective_sub]))
		{
			echo "<div style=''>Save Student Elective Subject </div>";
		}
		else{
		 
			echo "<div style=''>Try Again</div>";
		}
		exit;
	}
	
    /**
     * Edit method
     *
     * @param string|null $id Student Elective Subject id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentElectiveSubject = $this->StudentElectiveSubjects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentElectiveSubject = $this->StudentElectiveSubjects->patchEntity($studentElectiveSubject, $this->request->getData());
            if ($this->StudentElectiveSubjects->save($studentElectiveSubject)) {
                $this->Flash->success(__('The student elective subject has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student elective subject could not be saved. Please, try again.'));
        }
        $students = $this->StudentElectiveSubjects->Students->find('list', ['limit' => 200]);
        $subjects = $this->StudentElectiveSubjects->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('studentElectiveSubject', 'students', 'subjects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Elective Subject id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentElectiveSubject = $this->StudentElectiveSubjects->get($id);
        if ($this->StudentElectiveSubjects->delete($studentElectiveSubject)) {
            $this->Flash->success(__('The student elective subject has been deleted.'));
        } else {
            $this->Flash->error(__('The student elective subject could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
