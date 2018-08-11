<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query;

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
        $rawMaterials = $this->paginate($this->RawMaterials->find());

        $this->set(compact('rawMaterials'));
    }

    public function add()
    {
		$this->viewBuilder()->layout('admin');
        $rawMaterial = $this->RawMaterials->newEntity();
        if ($this->request->is('post')) {
            $rawMaterial = $this->RawMaterials->patchEntity($rawMaterial, $this->request->getData());
            if(!empty($this->request->getData('has_secondary_unit'))){
            	$rawMaterial->formula=$this->request->getData('formulas');
            }
            else{
            	$rawMaterial->formula=0;	
            }
            
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
            $this->Flash->success(__('The raw material has been freezed.'));
        } else {
            $this->Flash->error(__('The raw material could not be freezed. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function undelete($id = null)
    {
       $rawMaterial = $this->RawMaterials->get($id, [
            'contain' => []
        ]);
        $rawMaterial = $this->RawMaterials->patchEntity($rawMaterial, $this->request->getData());
        $rawMaterial->is_deleted=0;
        if ($this->RawMaterials->save($rawMaterial)) {
            $this->Flash->success(__('The raw material has been unfreezed.'));
        } else {
            $this->Flash->error(__('The raw material could not be unfreezed. Please, try again.'));
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
					$AdjustData['transaction_date']=date('Y-m-d');
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
						$AdjustData['transaction_date']=date('Y-m-d');
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
						$AdjustData['transaction_date']=date('Y-m-d');
						$AdjustData['quantity']=$wastage;
						$AdjustData['raw_material_id']=$raw_material_id;
						$AdjustData['rate']=0;
						$AdjustData['status']='out';
						$AdjustData['voucher_name']='stock adjustment';
						$AdjustData['is_wastage']=1;
						$AdjustData['adjustment_commant']=$adjustment_commant;
						$AdjustData['wastage_commant']=$wastage_commant;
						$StockLedger = $this->RawMaterials->StockLedgers->patchEntity($StockLedger, $AdjustData);
						$this->RawMaterials->StockLedgers->save($StockLedger);
					}
					 
				}
			} 
				return $this->redirect(['action' => '']);
             
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
		->where(['RawMaterials.is_deleted'=>0])
		->autoFields(true);
		
		$this->set(compact('RawMaterials'));
	}


	public function currentStock()
	{
		$this->viewBuilder()->layout('admin');
		
	
		
		$q=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'in']);
		$q->select([$q->func()->sum('StockLedgers.quantity')]);
		
		$q2=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'out']);
		$q2->select([$q2->func()->sum('StockLedgers.quantity')]);

		$q3=$this->RawMaterials->StockLedgers->find()
			->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'in', 'StockLedgers.purchase_voucher_id >' => '0'])
			->order(['StockLedgers.transaction_date' => 'DESC'])
			->limit(1);
		$q3->select(['StockLedgers.transaction_date']);
		
		$RawMaterials =	$this->RawMaterials->find();
		$RawMaterials->select([
			'total_in' => $q,
			'total_out' => $q2,
			'last_purchase' => $q3
		])
		->contain(['PrimaryUnits'])
		->where(['RawMaterials.is_deleted'=>0])
		->autoFields(true);

		$this->set(compact('RawMaterials'));
	}


	public function dailyReport()
	{
		$this->viewBuilder()->layout('admin');
		
		$date=$this->request->query('date');
		
		$openingIn=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'in', 'StockLedgers.transaction_date <' => $date]);
		$openingIn->select([$openingIn->func()->sum('StockLedgers.quantity')]);
		
		$openingOut=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'out', 'StockLedgers.transaction_date <' => $date]);
		$openingOut->select([$openingOut->func()->sum('StockLedgers.quantity')]);

		$inward=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'in', 'StockLedgers.transaction_date' => $date, 'StockLedgers.purchase_voucher_id >' => '0']);
		$inward->select([$inward->func()->sum('StockLedgers.quantity')]);

		$adjustmentIn=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'in', 'StockLedgers.transaction_date' => $date, 'StockLedgers.voucher_name' => 'stock adjustment']);
		$adjustmentIn->select([$adjustmentIn->func()->sum('StockLedgers.quantity')]);

		$used=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'out', 'StockLedgers.transaction_date' => $date, 'StockLedgers.voucher_name' => 'Bill']);
		$used->select([$used->func()->sum('StockLedgers.quantity')]);

		$wastage=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'out', 'StockLedgers.transaction_date' => $date, 'StockLedgers.voucher_name' => 'stock adjustment', 'StockLedgers.is_wastage' => true]);
		$wastage->select([$wastage->func()->sum('StockLedgers.quantity')]);

		$adjustmentOut=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'out', 'StockLedgers.transaction_date' => $date, 'StockLedgers.voucher_name' => 'stock adjustment', 'StockLedgers.is_wastage' => false]);
		$adjustmentOut->select([$adjustmentOut->func()->sum('StockLedgers.quantity')]);
		
		
		$RawMaterials =	$this->RawMaterials->find();
		$RawMaterials->select([
			'total_in_opening' => $openingIn,
			'total_out_opening' => $openingOut,
			'inward' => $inward,
			'adjustmentIn' => $adjustmentIn,
			'used' => $used,
			'wastage' => $wastage,
			'adjustmentOut' => $adjustmentOut,
		])
		->contain(['PrimaryUnits'])
		->where(['RawMaterials.is_deleted'=>0])
		->autoFields(true);
		//pr($RawMaterials->toArray()); exit;
		$this->set(compact('RawMaterials', 'date'));
	}



	public function consumptionReport()
	{
		$this->viewBuilder()->layout('admin');
		
		$from_date=$this->request->query('from_date');
		$to_date=$this->request->query('to_date');


		$StockLedgers =	$this->RawMaterials->StockLedgers->find();
		$RawMaterials =	$this->RawMaterials->find()
							->contain(['PrimaryUnits', 'StockLedgers' => function($q) use($from_date, $to_date, $StockLedgers){
								return $q
								->where([
									'StockLedgers.transaction_date >=' => $from_date, 
									'StockLedgers.transaction_date <=' => $to_date, 
									'StockLedgers.status' => 'out',
									'StockLedgers.voucher_name' => 'Bill'
								])
								->select([
									'StockLedgers.raw_material_id', 
									'StockLedgers.transaction_date', 
									'Total_quantity' => $StockLedgers->func()->sum('StockLedgers.quantity')
								])
								->group(['StockLedgers.transaction_date', 'StockLedgers.raw_material_id'])
								->order(['StockLedgers.transaction_date' => 'ASC']);
							}])
							->where(['RawMaterials.is_deleted'=>0]);
		
		
		$this->set(compact('RawMaterials', 'from_date', 'to_date'));
	}



	public function stockReport()
	{
		$this->viewBuilder()->layout('admin');
		
		$from_date=$this->request->query('from_date');
		$to_date=$this->request->query('to_date');



		$openingIn=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'in', 'StockLedgers.transaction_date <=' => date('Y-m-d', strtotime('-1 day', strtotime($from_date)))]);
		$openingIn->select([$openingIn->func()->sum('StockLedgers.quantity')]);
		
		$openingOut=$this->RawMaterials->StockLedgers->find()->where(['StockLedgers.raw_material_id = RawMaterials.id', 'StockLedgers.status' => 'out', 'StockLedgers.transaction_date <=' => date('Y-m-d', strtotime('-1 day', strtotime($from_date)))]);
		$openingOut->select([$openingOut->func()->sum('StockLedgers.quantity')]);


		$StockLedgers =	$this->RawMaterials->StockLedgers->find();
		$RawMaterials =	$this->RawMaterials->find()
							->select([
								'total_in_opening' => $openingIn,
								'total_out_opening' => $openingOut,
							])
							->contain(['PrimaryUnits', 'StockLedgers' => function($q) use($from_date, $to_date, $StockLedgers){
								return $q
								->where([
									'StockLedgers.transaction_date >=' => date('Y-m-d', strtotime('0 day', strtotime($from_date))), 
									'StockLedgers.transaction_date <=' => $to_date
								])
								->select([
									'StockLedgers.raw_material_id', 
									'StockLedgers.status', 
									'StockLedgers.transaction_date', 
									'Total_quantity' => $StockLedgers->func()->sum('StockLedgers.quantity')
								])
								->group(['StockLedgers.transaction_date', 'StockLedgers.raw_material_id', 'StockLedgers.status'])
								->order(['StockLedgers.transaction_date' => 'ASC']);
							}])
							->where(['RawMaterials.is_deleted'=>0])
							->autoFields(true);

		//pr($RawMaterials->toArray()); exit;
		
		$this->set(compact('RawMaterials', 'from_date', 'to_date'));
	}

	public function monthlyReport()
	{
		$this->viewBuilder()->layout('admin');

		$from_date=$this->request->query('from_date');
		$to_date=$this->request->query('to_date');

		$RawMaterials = $this->RawMaterials->StockLedgers->find();
		$RawMaterials->select([
			'purchase' => $RawMaterials->func()->sum('quantity*rate'),
			'month' => 'MONTH(transaction_date)',
			'year' => 'YEAR(transaction_date)',
		])
		->where([
			'StockLedgers.transaction_date >=' => $from_date.'-1', 
			'StockLedgers.transaction_date <=' => $to_date.'-31', 
			'StockLedgers.status' => 'in',
			'StockLedgers.voucher_name' => 'Purchase Voucher'
		])
		->group(['MONTH(transaction_date)', 'YEAR(transaction_date)'])
		->order(['StockLedgers.transaction_date' => 'ASC']);

		$purchases=[];
		foreach ($RawMaterials as $RawMaterial) {
			$purchases[$RawMaterial->year][$RawMaterial->month]=$RawMaterial->purchase;
		}


		$BillRows = $this->RawMaterials->ItemRows->Items->BillRows->find();
		$BillRows->select([
			'sale' => $BillRows->func()->sum('net_amount'),
			'month' => 'MONTH(transaction_date)',
			'year' => 'YEAR(transaction_date)',
		])
		->matching('Bills', function($q) use($from_date, $to_date){
			return $q
			->where([
				'Bills.transaction_date >=' => $from_date.'-1', 
				'Bills.transaction_date <=' => $to_date.'-31', 
			]);
		})
		->group(['MONTH(Bills.transaction_date)', 'YEAR(Bills.transaction_date)'])
		->order(['Bills.transaction_date' => 'ASC']);
		$sales=[];
		foreach ($BillRows as $BillRow) {
			$sales[$BillRow->year][$BillRow->month]=$BillRow->sale;
		}

		$this->set(compact('from_date', 'to_date', 'purchases', 'sales'));

	}




}
