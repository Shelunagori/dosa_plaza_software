<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserRights Controller
 *
 * @property \App\Model\Table\UserRightsTable $UserRights
 *
 * @method \App\Model\Entity\UserRight[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserRightsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->layout('admin');

        //$employees=$this->UserRights->Employees->find();
        $users=$this->UserRights->Users->find()->contain(['Employees']);

        $pages=$this->UserRights->Pages->find();

        $userRights=$this->UserRights->find();
        $assign_rights=array();
        foreach($userRights as $right) {
            $assign_rights[$right->user_id][]=$right->page_id;
        }

        $this->set(compact('users', 'pages', 'assign_rights'));
    }

    public function autosave(){
        $user_id=$this->request->query('user_id');
        $page_id=$this->request->query('page_id');
        $entry=$this->request->query('entry');
        if($entry=="insert"){
            //Insert
            $UserRight = $this->UserRights->newEntity();
            $UserRight->user_id=$user_id;
            $UserRight->page_id=$page_id;
            $this->UserRights->save($UserRight);
        }else{
            //Delete 
            $this->UserRights->deleteAll(['user_id' => $user_id, 'page_id' => $page_id]);
        }
        exit();
    }

    /**
     * View method
     *
     * @param string|null $id User Right id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function ajaxUserRights($id = null)
    {
        $pages=$this->UserRights->Pages->find();  
        $userRights=$this->UserRights->find()->select(['page_id'])->where(['user_id'=>$id]);
        $assign_rights=array();
        foreach($userRights as $right) {
            $assign_rights[]=$right->page_id;
        }
        $this->set(compact('pages','assign_rights'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->layout('admin');
        $userRight = $this->UserRights->newEntity();
        if ($this->request->is('post')) {
            //pr($this->request->getData());exit;
            $user_id=$this->request->getData('user_id');
            $rights=$this->request->getData('rights');
            $this->UserRights->deleteAll(['userRight.user_id' => $user_id]);
            foreach($rights as $right){
                $userRight = $this->UserRights->newEntity();
                $userRight = $this->UserRights->patchEntity($userRight, $this->request->getData());
                $userRight->page_id=$right;
                $userRight->user_id=$user_id;
                $this->UserRights->save($userRight);
            }
            return $this->redirect(['action' => 'add']);
            $this->Flash->error(__('The user right could not be saved. Please, try again.'));
        }
        $pages = $this->UserRights->Pages->find('list', ['limit' => 200]);
        $userDatas = $this->UserRights->Users->find()->contain(['Employees']);
		$users = [];
	
		if(!empty($userDatas->toArray()))
		{
			foreach($userDatas as $userData)
			{
				$users[$userData->id] = $userData->employee->name;
			}
		}

        $this->set(compact('userRight', 'pages','users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Right id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userRight = $this->UserRights->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userRight = $this->UserRights->patchEntity($userRight, $this->request->getData());
            if ($this->UserRights->save($userRight)) {
                $this->Flash->success(__('The user right has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user right could not be saved. Please, try again.'));
        }
        $pages = $this->UserRights->Pages->find('list', ['limit' => 200]);
        $this->set(compact('userRight', 'pages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Right id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userRight = $this->UserRights->get($id);
        if ($this->UserRights->delete($userRight)) {
            $this->Flash->success(__('The user right has been deleted.'));
        } else {
            $this->Flash->error(__('The user right could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
