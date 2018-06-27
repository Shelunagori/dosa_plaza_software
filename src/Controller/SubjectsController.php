<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Subjects Controller
 *
 * @property \App\Model\Table\SubjectsTable $Subjects
 *
 * @method \App\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubjectsController extends AppController
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
			$subject = $this->Subjects->get($id, [
            'contain' => []
        ]);
		}
		else
		{
			$subject = $this->Subjects->newEntity();
		}
		
		$section_id=$this->request->query('section-id');
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subject = $this->Subjects->patchEntity($subject, $this->request->data);
			$subject->name = trim($subject->name);
			if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));

                return $this->redirect(['action' => 'index?section_id='.$section_id]);
            } else {
                $this->Flash->error(__('The subject could not be saved. Please, try again.'));
            }
        } 
		$subjects = $this->Subjects->find('threaded')->where(['section_id' => $section_id]);
		$subjectList = $this->Subjects->find('treeList')->where(['section_id' => $section_id]);
		
		$sectionList = $this->Subjects->Sections->find('threaded');
		
        $this->set(compact('subject','subjects','subjectList','sectionList','id', 'section_id'));
        $this->set('_serialize', ['section']);
    }

    /**
     * View method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subject = $this->Subjects->get($id, [
            'contain' => ['Sections', 'ParentSubjects', 'ChildSubjects']
        ]);

        $this->set('subject', $subject);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		 $this->viewBuilder()->layout('main');
        $subject = $this->Subjects->newEntity();
        if ($this->request->is('post')) {
            $subject = $this->Subjects->patchEntity($subject, $this->request->getData());
            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subject could not be saved. Please, try again.'));
        }
        $sections = $this->Subjects->Sections->find('list', ['limit' => 200]);
        $parentSubjects = $this->Subjects->ParentSubjects->find('list', ['limit' => 200]);
        $this->set(compact('subject', 'sections', 'parentSubjects'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subject = $this->Subjects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subject = $this->Subjects->patchEntity($subject, $this->request->getData());
            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subject could not be saved. Please, try again.'));
        }
        $sections = $this->Subjects->Sections->find('list', ['limit' => 200]);
        $parentSubjects = $this->Subjects->ParentSubjects->find('list', ['limit' => 200]);
        $this->set(compact('subject', 'sections', 'parentSubjects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subject = $this->Subjects->get($id);
        if ($this->Subjects->delete($subject)) {
            $this->Flash->success(__('The subject has been deleted.'));
        } else {
            $this->Flash->error(__('The subject could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
