<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 *
 * @method \App\Model\Entity\Item[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController
{   
	public function index(){
		$this->viewBuilder()->layout('admin');
		$this->paginate = [
            'contain' => ['ItemSubCategories']
        ];
        $itemslist = $this->paginate($this->Items->find()->where(['Items.is_deleted'=>0]));
		$this->set(compact('itemslist'));
	}

    public function add($id = null)
    {
		$this->viewBuilder()->layout('admin');
		if(!$id)
		{				
			$item = $this->Items->newEntity();
		}
		else
		{
			$item = $this->Items->get($id, [
				'contain' => []
			]);
		}
		$loginId=$this->Auth->User('id'); 
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
			$item->created_by=$loginId;
			$item->rate=$this->request->getData('rate'); 
			$item->discount_applicable=$this->request->getData('discount_applicable'); 
            //pr($item); exit;
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
		
        $itemSubCategories = $this->Items->ItemSubCategories->find('list', ['limit' => 200])->where(['is_deleted'=>0])->order(['ItemSubCategories.id'=>'ASC']);
        $Taxes = $this->Items->Taxes->find('list', ['limit' => 200])->where(['status'=>'active'])->order(['Taxes.id'=>'ASC']);
        $raw_materials = $this->Items->ItemRows->RawMaterials->find()->contain(['Taxes','PrimaryUnits', 'SecondaryUnits' ])
                            ->order(['RawMaterials.name'=>'ASC']);;
        
        $option=[];
        foreach($raw_materials as $raw_material)
        {
            if($raw_material->recipe_unit_type=="primary"){
                $unit_name = $raw_material->primary_unit->name;
            }else if($raw_material->recipe_unit_type=="secondary"){
                $unit_name = $raw_material->secondary_unit->name;
            }

            $option[] = [
                            'value'=>$raw_material->id,
                            'text'=>$raw_material->name,
                            'tax'=>$raw_material->tax->tax_per,
                            'unit_name'=>$unit_name,
                        ];
        }
        
        $this->set(compact('item', 'itemSubCategories','id','Taxes','option'));

    }
 
    public function delete($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => []
        ]);
		$item = $this->Items->patchEntity($item, $this->request->getData());
		$item->is_deleted=1;
		if ($this->Items->save($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
