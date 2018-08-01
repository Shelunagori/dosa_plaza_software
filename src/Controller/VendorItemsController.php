<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VendorItems Controller
 *
 * @property \App\Model\Table\VendorItemsTable $VendorItems
 *
 * @method \App\Model\Entity\VendorItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VendorItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Vendors', 'RawMaterials']
        ];
        $vendorItems = $this->paginate($this->VendorItems);
			
        $this->set(compact('vendorItems','RawMaterials'));
    }

    /**
     * View method
     *
     * @param string|null $id Vendor Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vendorItem = $this->VendorItems->get($id, [
            'contain' => ['Vendors', 'Items']
        ]);

        $this->set('vendorItem', $vendorItem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vendorItem = $this->VendorItems->newEntity();
        if ($this->request->is('post')) {
            $vendorItem = $this->VendorItems->patchEntity($vendorItem, $this->request->getData());
            if ($this->VendorItems->save($vendorItem)) {
                $this->Flash->success(__('The vendor item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor item could not be saved. Please, try again.'));
        }
        $vendors = $this->VendorItems->Vendors->find('list');
		$items = $this->VendorItems->RawMaterials->find();
		$this->set(compact('vendorItem', 'vendors', 'items'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vendor Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vendorItem = $this->VendorItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vendorItem = $this->VendorItems->patchEntity($vendorItem, $this->request->getData());
            if ($this->VendorItems->save($vendorItem)) {
                $this->Flash->success(__('The vendor item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor item could not be saved. Please, try again.'));
        }
        $vendors = $this->VendorItems->Vendors->find();
        $items = $this->VendorItems->Items->find();
        $this->set(compact('vendorItem', 'vendors', 'items'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vendor Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vendorItem = $this->VendorItems->get($id);
        if ($this->VendorItems->delete($vendorItem)) {
            $this->Flash->success(__('The vendor item has been deleted.'));
        } else {
            $this->Flash->error(__('The vendor item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
