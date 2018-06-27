<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Exams Controller
 *
 * @property \App\Model\Table\ExamsTable $Exams
 *
 * @method \App\Model\Entity\Exam[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExamsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
       $this->viewBuilder()->layout('main');
	   $section_id=$this->request->query('section-id');
		if($id)
		{
			$exam = $this->Exams->get($id, [
            'contain' => []
        ]);
		}
		else
		{
			$exam = $this->Exams->newEntity();
		}
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exam = $this->Exams->patchEntity($exam, $this->request->data);
			$exam->name = trim($exam->name);
			if ($this->Exams->save($exam)) {
                $this->Flash->success(__('The exam has been saved.'));

                return $this->redirect(['action' => 'index?section_id='.$section_id]);
            } else {
                $this->Flash->error(__('The exam could not be saved. Please, try again.'));
            }
        } 
		$exams = $this->Exams->find()->contain(['Sections'])->order(['Exams.id' => 'DESC']);  
		$sectionList = $this->Exams->Sections->find('threaded');
		
		$examList = $this->Exams->find('TreeList')->where(['section_id'=>$section_id]);
		$examList2 = $this->Exams->find('threaded')->where(['section_id'=>$section_id]);
		
		$session = $this->request->session();
		$session->write('main_exams', null);
		$this->Exams->fetchCategoryData($session,$examList2);
		$main_exams = $session->read('main_exams');
		$session->write('main_exams', null);
		

		$this->set(compact('exam','exams','sectionList','id' ,'section_id', 'examList', 'examList2', 'main_exams'));
        $this->set('_serialize', ['exam']);
    }

	public function examSubjectDetail()
    {
       $this->viewBuilder()->layout('main');
	   $classList = $this->Exams->Sections->find('list')->order(['Sections.id' => 'DESC']);
	   $this->set(compact('classList'));
	}
	
	public function getClassSubjects($class_id=null)
    {
       $sections = $this->Exams->Sections->find()->contain(['Exams','Subjects'])->where(['Sections.id' => @$class_id])->first();
	   $ExamSubjectDetails = $this->Exams->ExamSubjectDetails->find()->where(['ExamSubjectDetails.section_id' => @$class_id]);
	   $datail=[]; $ids=[];
	   if(sizeof($ExamSubjectDetails->toArray())>0)
	   {
		   foreach($ExamSubjectDetails as $ExamSubjectDetail)
		   {
			 $datail[$ExamSubjectDetail->section_id][$ExamSubjectDetail->exam_id][$ExamSubjectDetail->subject_id] =   $ExamSubjectDetail->max_marks;
			 $ids[$ExamSubjectDetail->section_id][$ExamSubjectDetail->exam_id][$ExamSubjectDetail->subject_id] =   $ExamSubjectDetail->id;
		   }
	   } 
	   $this->set(compact('sections','datail','ids'));
	}
	
	public function insertMaxMark($subject_id=null,$exam_id=null,$class_id=null,$max_mark=null,$id=null)
    {
		if($id)
		{
			$ExamSubjectDetail = $subject = $this->Exams->ExamSubjectDetails->get($id, [
									'contain' => []
								]);
		}
		else
		{
			$ExamSubjectDetail = $this->Exams->ExamSubjectDetails->newEntity();
		}
		$ExamSubjectDetail->exam_id    = $exam_id;
		$ExamSubjectDetail->section_id = $class_id;
		$ExamSubjectDetail->subject_id = $subject_id;
		$ExamSubjectDetail->max_marks  = $max_mark;
		$this->Exams->ExamSubjectDetails->save($ExamSubjectDetail);
		exit;
	}
    /**
     * View method
     *
     * @param string|null $id Exam id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exam = $this->Exams->get($id, [
            'contain' => ['Sections']
        ]);

        $this->set('exam', $exam);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exam = $this->Exams->newEntity();
        if ($this->request->is('post')) {
            $exam = $this->Exams->patchEntity($exam, $this->request->getData());
            if ($this->Exams->save($exam)) {
                $this->Flash->success(__('The exam has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exam could not be saved. Please, try again.'));
        }
        $sections = $this->Exams->Sections->find('list', ['limit' => 200]);
        $this->set(compact('exam', 'sections'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Exam id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exam = $this->Exams->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exam = $this->Exams->patchEntity($exam, $this->request->getData());
            if ($this->Exams->save($exam)) {
                $this->Flash->success(__('The exam has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exam could not be saved. Please, try again.'));
        }
        $sections = $this->Exams->Sections->find('list', ['limit' => 200]);
        $this->set(compact('exam', 'sections'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Exam id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exam = $this->Exams->get($id);
        if ($this->Exams->delete($exam)) {
            $this->Flash->success(__('The exam has been deleted.'));
        } else {
            $this->Flash->error(__('The exam could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
}
