<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RawMaterials Controller
 *
 * @property \App\Model\Table\RawMaterialsTable $RawMaterials
 *
 * @method \App\Model\Entity\RawMaterial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RawMaterialsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('admin');
		$this->paginate = [
            'contain' => ['Taxes', 'PrimaryUnits','SecondaryUnits']
        ];
        $rawMaterials = $this->paginate(
        				$this->RawMaterials->find()
        				->where(['RawMaterials.is_deleted'=>0])
        			);

        $this->set(compact('rawMaterials'));
    }

    public function add()
    {
		$this->viewBuilder()->layout('admin');
        $rawMaterial = $this->RawMaterials->newEntity();
        if ($this->request->is('post')) {
            $rawMaterial = $this->RawMaterials->patchEntity($rawMaterial, $this->request->getData());
            $rawMaterial->formula=$this->request->getData('formulas');
            
            if ($this->RawMaterials->save($rawMaterial)) {
                $this->Flash->success(__('The raw material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The raw material could not be saved. Please, try again.'));
        }
		$Taxes = $this->RawMaterials->Taxes->find('list');
        $units = $this->RawMaterials->SecondaryUnits->find()->where(['is_deleted'=>0]);
        $this->set(compact('rawMaterial','Taxes','units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Raw Material id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
    	$this->viewBuilder()->layout('admin');
        $rawMaterial = $this->RawMaterials->get($id, [
            'contain' => ['Taxes', 'PrimaryUnits','SecondaryUnits']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rawMaterial = $this->RawMaterials->patchEntity($rawMaterial, $this->request->getData());
            if ($this->RawMaterials->save($rawMaterial)) {
                $this->Flash->success(__('The raw material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The raw material could not be saved. Please, try again.'));
        }
        $Taxes = $this->RawMaterials->Taxes->find('list');
        $units = $this->RawMaterials->SecondaryUnits->find()->where(['is_deleted'=>0]);
        $this->set(compact('rawMaterial','Taxes','units'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Raw Material id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
       $rawMaterial = $this->RawMaterials->get($id, [
            'contain' => []
        ]);
        $rawMaterial = $this->RawMaterials->patchEntity($rawMaterial, $this->request->getData());
        $rawMaterial->is_deleted=1;
        if ($this->RawMaterials->save($rawMaterial)) {
            $this->Flash->success(__('The raw material has been deleted.'));
        } else {
            $this->Flash->error(__('The raw material could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	public function stockAdjustment(){
		$this->viewBuilder()->layout('admin');
		
		//pr( $this->request);Exit();
		 if ($this->request->is(['patch', 'post', 'put'])) {
			$PostedStockLedgers=$this->request->getData('StockLedgers');
			
			foreach($PostedStockLedgers as $PosteData){
				
				$adjust=$PosteData['adjust'];
				$raw_material_id=$PosteData['raw_material_id'];
				$adjust=$PosteData['adjust'];
				$adjustment_commant=$PosteData['hiddencommant'];
				  
				if($adjust>0){
					
					$StockLedger = $this->RawMaterials->StockLedgers->newEntity();
					$AdjustData=array();
					$AdjustData['quantity']=$adjust;
					$AdjustData['raw_material_id']=$raw_material_id;
					$AdjustData['rate']=0;
					$AdjustData['status']='in';
					$AdjustData['voucher_name']='stock adjustment';
					$AdjustData['adjustment_commant']=$adjustment_commant;
					$StockLedger = $this->RawMaterials->StockLedgers->patchEntity($StockLedger, $AdjustData);
					$this->RawMaterials->StockLedgers->save($StockLedger);
				}
				else{
					//--  No Reason Submit
					$noresaon=$PosteData['noresaon'];
					$adjustment_commant=$PosteData['hiddencommant'];
					$wastage_commant=$PosteData['hiddencom'];
					
					if($noresaon>0){
						$adjustment_commant=$PosteData['hiddencommant'];
						$wastage_commant=$PosteData['hiddencom'];
						$StockLedger = $this->RawMaterials->StockLedgers->newEntity();
						$AdjustData=array();
						$AdjustData['quantity']=$noresaon;
						$AdjustData['raw_material_id']=$raw_material_id;
						$AdjustData['rate']=0;
						$AdjustData['status']='out';
						$AdjustData['voucher_name']='stock adjustment';
						$AdjustData['adjustment_commant']=$adjustment_commant;
						$AdjustData['wastage_commant']= $wastage_commant;
						$StockLedger = $this->RawMaterials->StockLedgers->patchEntity($StockLedger, $AdjustData);
						$this->RawMaterials->StockLedgers->save($StockLedger);
					}
					//--  Westge Submit
					$wastage=$PosteData['wastage'];
					$wastage_commant=$PosteData['hiddencom'];
					$adjustment_commant=$PosteData['hiddencommant'];
					if($wastage>0){
						
						$StockLedger = $this->RawMaterials->StockLedgers->newEntity();
						$AdjustData=array();
						$AdjustData['quantity']=$wastage;
						$AdjustData['raw_material_id']=$raw_material_id;
						$AdjustData['rate']=0;
						$AdjustData['status']='out';
						$AdjustData['voucher_name']='stock adjustment';
						$AdjustData['adjustment_commant']=$adjustment_commant;
						$AdjustData['wastage_commant']=$wastage_commant;
						$StockLedger = $this->RawMaterials->StockLedgers->patchEntity($StockLedger, $AdjustData);
						$this->RawMaterials->StockLedgers->save($StockLedger);
					}
					 
				}
			} 
				return $this->redirect(['action' => 'index']);
             
        }
		
		$q=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'in']);
		$q->select([$q->func()->sum('StockLedgers.quantity')]);
		
		$q2=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'out']);
		$q2->select([$q2->func()->sum('StockLedgers.quantity')]);
		
		$RawMaterials =	$this->RawMaterials->find();
		$RawMaterials->select([
			'total_in' => $q,
			'total_out' => $q2
		])
		->contain(['PrimaryUnits'])
		->autoFields(true);
		
		$this->set(compact('RawMaterials'));
	}
}
