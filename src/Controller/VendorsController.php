<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Vendors Controller
 *
 * @property \App\Model\Table\VendorsTable $Vendors
 *
 * @method \App\Model\Entity\Vendor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VendorsController extends AppController
{
    public function index()
    {
		$this->viewBuilder()->layout('admin');
		$this->paginate = [
            'contain' => ['VendorItems'=>['RawMaterials']]
        ];
        $vendors = $this->paginate($this->Vendors->RawMaterials->find()->where(['is_deleted'=>0]));
		
		$this->set(compact('vendors','Items'));
    }
 
    public function add($id = null)
    {
		$this->viewBuilder()->layout('admin');
		if(!$id)
		{
			$vendor = $this->Vendors->newEntity();
		}
		else{
			$vendor = $this->Vendors->get($id, [
				'contain' => ['VendorItems']
			]);
		}
       if ($this->request->is(['patch', 'post', 'put'])) {
            $vendor = $this->Vendors->patchEntity($vendor, $this->request->getData());
			$vendor = $this->Vendors->patchEntity($vendor, $this->request->getData(),[ 'associated' => ['VendorItems']]);
			$item_lists=$this->request->getData('item_lists');
			$x=0;
			$vendor->vendor_items = [];  
			foreach($item_lists as $data)
			{
				$Items = $this->Vendors->VendorItems->newEntity();
				$Items->item_id = $data;
				$vendor->vendor_items[$x]=$Items;
 				$x++;	
			}
			 
            if ($this->Vendors->save($vendor)) {
                $this->Flash->success(__('The vendor has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor could not be saved. Please, try again.'));
        }
 		$Items = $this->Vendors->RawMaterials->find()->where(['is_deleted'=>0]);
		
		
        $this->set(compact('vendor','Items','id'));
    }
 
    public function delete($id = null)
    {
        $vendor = $this->Vendors->get($id, [
            'contain' => []
        ]);
		$vendor = $this->Vendors->patchEntity($vendor, $this->request->getData());
		$vendor->is_deleted=1;
		if ($this->Vendors->save($vendor)) {
            $this->Flash->success(__('The vendor has been deleted.'));
        } else {
            $this->Flash->error(__('The vendor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
