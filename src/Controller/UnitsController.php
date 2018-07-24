<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Units Controller
 *
 * @property \App\Model\Table\UnitsTable $Units
 *
 * @method \App\Model\Entity\Unit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UnitsController extends AppController
{
    public function add($id = null)
    {
        $this->viewBuilder()->layout('admin');
        
        if(!$id)
        {               
            $unit = $this->Units->newEntity();
        }
        else
        {
           $unit = $this->Units->get($id, [
                'contain' => []
            ]);
        } 
        if ($this->request->is(['patch','post','put'])){
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            //pr($unit); exit;
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
        $UnitsList = $this->paginate($this->Units->find()->where(['is_deleted'=>0]));

        $this->set(compact('unit','UnitsList','id'));
    }

    public function delete($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => []
        ]);
        
        $unit = $this->Units->patchEntity($unit, $this->request->getData());
        $unit->is_deleted=1;
        if ($this->Units->save($unit)) {
            $this->Flash->success(__('The unit has been deleted.'));
        } else {
            $this->Flash->error(__('The unit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
