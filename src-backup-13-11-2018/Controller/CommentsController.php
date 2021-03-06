<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 *
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
{
	public function add($id = null)
    {
		
		$this->viewBuilder()->layout('admin');
		if(!$id)
		{				
			$comment = $this->Comments->newEntity();
		}
		else
		{
			$comment = $this->Comments->get($id);
		} 
		
        if ($this->request->is(['patch','post','put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
			
			if ($this->Comments->save($comment)) {
				
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
		
		$Comments = $this->Comments->find();
		
        $this->set(compact('comment','Comments','id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $this->set(compact('comment'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
		$comment = $this->Comments->patchEntity($comment, $this->request->getData());
		$comment->is_deleted=1;
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
 
		
