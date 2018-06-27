<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\View\Helper\NumberHelper;
use Cake\View\Helper\RecursiveHelper;
/**
 * Sections Controller
 *
 * @property \App\Model\Table\SectionsTable $Sections
 *
 * @method \App\Model\Entity\Section[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SectionsController extends AppController
{

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
			$section = $this->Sections->get($id);
		}
		else
		{
			$section = $this->Sections->newEntity();
		}
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $section = $this->Sections->patchEntity($section, $this->request->data);
			$section->name = trim($section->name);
			$ActiveYear=$this->Auth->User('ActiveYear');
			$section->year_id = $ActiveYear->id;
			
            if ($this->Sections->save($section)) {
                $this->Flash->success(__('The section has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The section could not be saved. Please, try again.'));
            }
        } 
		$sections = $this->Sections->find()->contain(['ChildSections','Subjects', 'Exams','ParentSections'])->order(['Sections.id' => 'DESC']);  
		$sectionList = $this->Sections->find('treeList');
		$sectionLists = $this->Sections->find('threaded');
        $this->set(compact('section','sections','sectionList','id', 'sectionLists'));
        $this->set('_serialize', ['section']);
    }

    /**
     * View method
     *
     * @param string|null $id Section id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $section = $this->Sections->get($id, [
            'contain' => ['Years', 'ParentSections', 'Exams', 'ChildSections', 'Subjects']
        ]);

        $this->set('section', $section);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $section = $this->Sections->newEntity();
        if ($this->request->is('post')) {
            $section = $this->Sections->patchEntity($section, $this->request->getData());
            if ($this->Sections->save($section)) {
                $this->Flash->success(__('The section has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The section could not be saved. Please, try again.'));
        }
        $years = $this->Sections->Years->find('list', ['limit' => 200]);
        $parentSections = $this->Sections->ParentSections->find('list', ['limit' => 200]);
        $this->set(compact('section', 'years', 'parentSections'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Section id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $section = $this->Sections->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $section = $this->Sections->patchEntity($section, $this->request->getData());
            if ($this->Sections->save($section)) {
                $this->Flash->success(__('The section has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The section could not be saved. Please, try again.'));
        }
        $years = $this->Sections->Years->find('list', ['limit' => 200]);
        $parentSections = $this->Sections->ParentSections->find('list', ['limit' => 200]);
        $this->set(compact('section', 'years', 'parentSections'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Section id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $section = $this->Sections->get($id);
        if ($this->Sections->delete($section)) {
            $this->Flash->success(__('The section has been deleted.'));
        } else {
            $this->Flash->error(__('The section could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function subjectDetails(){
		$this->viewBuilder()->layout('main');
		$sectionList = $this->Sections->find('threaded');
		$this->set(compact('sectionList'));
	}
	
	public function subjectDetailsAjax($section_id=null){
		$this->viewBuilder()->layout('');
		$session = $this->request->session();
		
		$Exams=$this->Sections->Exams->find()->where(['section_id' => $section_id]);
		$Subjects=$this->Sections->Subjects->find()->where(['section_id' => $section_id]);
		$Subjects2=$this->Sections->Subjects->find('threaded')->where(['section_id' => $section_id]);
		
		$session->write('main_subjects', null);
		$this->Sections->Subjects->fetchCategoryData($session,$Subjects2);
		$main_subjects = $session->read('main_subjects');
		$session->write('main_subjects', null);
		
		
		$Employees = $this->Sections->Employees->find('list');
		$maxMarks=[];
		$SubjectId=[];			
		foreach($Exams as $Exam){
			foreach($Subjects as $Subject){
				$ExamSubjectDetail=$this->Sections->ExamSubjectDetails->find()->where(['section_id'=>$section_id, 'subject_id'=>$Subject->id, 'exam_id'=>$Exam->id])->first();
				$maxMarks[$Exam->id][$Subject->id]=@$ExamSubjectDetail->max_marks;
				$SubjectId[$Exam->id][$Subject->id]=@$ExamSubjectDetail->employee_id;
			}
		}
			 
		$crumbs = $this->Sections->find('path', ['for' => $section_id]);
		$this->set(compact('Exams', 'Subjects', 'crumbs', 'section_id', 'maxMarks', 'Employees', 'SubjectId', 'main_subjects'));
	}
	
	public function saveSubjectDetails($exam_id=null,$subject_id=null,$section_id=null,$max_marks=null, $employee_id=null ){
		$this->viewBuilder()->layout('');
		$ExamSubjectDetail=$this->Sections->ExamSubjectDetails->find()->where(['section_id'=>$section_id, 'subject_id'=>$subject_id, 'exam_id'=>$exam_id])->first();	 
		if($ExamSubjectDetail){
			$ExamSubjectDetail = $this->Sections->ExamSubjectDetails->get($ExamSubjectDetail->id);
			$ExamSubjectDetail->section_id=$section_id;
			$ExamSubjectDetail->subject_id=$subject_id;
			$ExamSubjectDetail->exam_id=$exam_id;
			$ExamSubjectDetail->max_marks=$max_marks;
			$ExamSubjectDetail->employee_id=$employee_id;
			
			
			if ($this->Sections->ExamSubjectDetails->save($ExamSubjectDetail)) {
				echo 1;
			}else{
				echo 0;
			}
		}else{
			$ExamSubjectDetail = $this->Sections->ExamSubjectDetails->newEntity();
			$ExamSubjectDetail->section_id=$section_id;
			$ExamSubjectDetail->subject_id=$subject_id;
			$ExamSubjectDetail->exam_id=$exam_id;
			$ExamSubjectDetail->max_marks=$max_marks;
			$ExamSubjectDetail->employee_id=$employee_id;
			if ($this->Sections->ExamSubjectDetails->save($ExamSubjectDetail)) {
				echo 1;
			}else{
				echo 0;
			}
		}
		exit;
	}
	
	 
}
