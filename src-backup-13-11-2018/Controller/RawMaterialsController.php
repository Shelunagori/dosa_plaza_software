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
		
        $rawMaterials = $this->RawMaterials->find()->contain(['Taxes', 'PrimaryUnits','SecondaryUnits','RawMaterialSubCategories']);

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

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The raw material could not be saved. Please, try again.'));
        }
		$Taxes = $this->RawMaterials->Taxes->find('list');
        $units = $this->RawMaterials->SecondaryUnits->find()->where(['is_deleted'=>0]);
        $rawMaterialCategories = $this->RawMaterials->RawMaterialSubCategories->find('list', ['limit' => 200])
        	->where(['RawMaterialSubCategories.is_deleted'=>0]);
        $this->set(compact('rawMaterial','Taxes','units','rawMaterialCategories'));
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
        $this->set(compact('rawMaterial','Taxes','units','id'));
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

		$RawMaterialList=[];
		foreach ($RawMaterials as $RawMaterial) {
			$RawMaterialList[$RawMaterial->id]=$RawMaterial->name;
		}


		$this->set(compact('RawMaterials', 'RawMaterialList'));
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
		->contain(['PrimaryUnits', 'RawMaterialSubCategories'])
		->where(['RawMaterials.is_deleted'=>0])
		->order(['RawMaterialSubCategories.Name' => 'ASC'])
		->autoFields(true);

		$this->set(compact('RawMaterials'));
	}

	public function currentStockExcel(){
		$this->viewBuilder()->layout('');

        if ($this->request->is(['patch','post','put'])){
            $excel_box = $this->request->data['excel_box'];

            $date= date("d-m-Y"); 
            $time=date('h:i:a',time());

            $filename="Current-Stock Report-".$date.'_'.$time;

            header ("Expires: 0");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/vnd.ms-excel");
            header ("Content-Disposition: attachment; filename=".$filename.".xls");
            header ("Content-Description: Generated Report" );

            echo $excel_box;
        }
        exit;
	}


	public function dailyReport()
	{
		$this->viewBuilder()->layout('admin');
		
		$date=date('Y-m-d', strtotime($this->request->query('date')));
		
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
		->contain(['PrimaryUnits', 'RawMaterialSubCategories'])
		->order(['RawMaterialSubCategories.Name' => 'ASC'])
		->where(['RawMaterials.is_deleted'=>0])
		->autoFields(true);
		//pr($RawMaterials->toArray()); exit;
		$this->set(compact('RawMaterials', 'date'));
	}

	public function dailyReportExcel(){
		$this->viewBuilder()->layout('');

        if ($this->request->is(['patch','post','put'])){
            $excel_box = $this->request->data['excel_box'];

            $date= date("d-m-Y"); 
            $time=date('h:i:a',time());

            $filename="Daily-Report-".$date.'_'.$time;

            header ("Expires: 0");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/vnd.ms-excel");
            header ("Content-Disposition: attachment; filename=".$filename.".xls");
            header ("Content-Description: Generated Report" );

            echo $excel_box;
        }
        exit;
	}



	public function consumptionReport()
	{
		$this->viewBuilder()->layout('admin');
		
		$date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));


		$StockLedgers =	$this->RawMaterials->StockLedgers->find();
		$RawMaterials =	$this->RawMaterials->find()
							->contain(['PrimaryUnits', 'RawMaterialSubCategories', 'StockLedgers' => function($q) use($from_date, $to_date, $StockLedgers){
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
							->order(['RawMaterialSubCategories.Name' => 'ASC'])
							->where(['RawMaterials.is_deleted'=>0]);
		
		
		$this->set(compact('RawMaterials', 'from_date', 'to_date', 'exploded_date_from_to'));
	}

	public function consumptionReportExcel(){
		$this->viewBuilder()->layout('');

        if ($this->request->is(['patch','post','put'])){
            $excel_box = $this->request->data['excel_box'];

            $date= date("d-m-Y"); 
            $time=date('h:i:a',time());

            $filename="Consumption-Report-".$date.'_'.$time;

            header ("Expires: 0");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/vnd.ms-excel");
            header ("Content-Disposition: attachment; filename=".$filename.".xls");
            header ("Content-Description: Generated Report" );

            echo $excel_box;
        }
        exit;
	}



	public function stockReport()
	{
		$this->viewBuilder()->layout('admin');
		
		$date_from_to = $this->request->query('date_from_to');
        $exploded_date_from_to = explode('/', $date_from_to);
        $from_date = date('Y-m-d', strtotime($exploded_date_from_to[0]));
        $to_date = date('Y-m-d', strtotime($exploded_date_from_to[1]));



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
							->contain(['PrimaryUnits', 'RawMaterialSubCategories', 'StockLedgers' => function($q) use($from_date, $to_date, $StockLedgers){
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
							->order(['RawMaterialSubCategories.Name' => 'ASC'])
							->autoFields(true);

		//pr($RawMaterials->toArray()); exit;
		
		$this->set(compact('RawMaterials', 'from_date', 'to_date', 'exploded_date_from_to'));
	}

	public function stockReportExcel()
	{
		$this->viewBuilder()->layout('');

        if ($this->request->is(['patch','post','put'])){
            $excel_box = $this->request->data['excel_box'];

            $date= date("d-m-Y"); 
            $time=date('h:i:a',time());

            $filename="Stock-Report-".$date.'_'.$time;

            header ("Expires: 0");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/vnd.ms-excel");
            header ("Content-Disposition: attachment; filename=".$filename.".xls");
            header ("Content-Description: Generated Report" );

            echo $excel_box;
        }
        exit;
	}

	public function monthlyReport()
	{
		$this->viewBuilder()->layout('admin');

		$from_date=$this->request->query('from_date');
		$to_date=$this->request->query('to_date');

		$from_date1 = explode('-', $from_date);
		$to_date1 = explode('-', $to_date);

		$qw= $to_date1[1].'-'.$to_date1[0].'-1';
		$tillDate = date("Y-m-t", strtotime($qw));

		$PurchaseVouchers = $this->RawMaterials->PurchaseVoucherRows->PurchaseVouchers->find();
		$PurchaseVouchers->select([
			'purchase' => $PurchaseVouchers->func()->sum('grand_total'),
			'month' => 'MONTH(transaction_date)',
			'year' => 'YEAR(transaction_date)',
		])
		->where([
			'PurchaseVouchers.transaction_date >=' => $from_date1[1].'-'.$from_date1[0].'-1', 
			'PurchaseVouchers.transaction_date <=' => $to_date1[1].'-'.$to_date1[0].'-1'
		])
		->group(['MONTH(transaction_date)', 'YEAR(transaction_date)'])
		->order(['PurchaseVouchers.transaction_date' => 'ASC']);

		$purchases=[];
		foreach ($PurchaseVouchers as $PurchaseVoucher) {
			$purchases[$PurchaseVoucher->year][$PurchaseVoucher->month]=$PurchaseVoucher->purchase;
		}


		

		$Bills = $this->RawMaterials->ItemRows->Items->BillRows->Bills->find();
		$Bills->select([
			'sale' => $Bills->func()->sum('grand_total'),
			'month' => 'MONTH(transaction_date)',
			'year' => 'YEAR(transaction_date)',
		])
		->where([
			'Bills.transaction_date >=' => $from_date1[1].'-'.$from_date1[0].'-1', 
			'Bills.transaction_date <=' => $tillDate
		])
		->group(['MONTH(Bills.transaction_date)', 'YEAR(Bills.transaction_date)'])
		->order(['Bills.transaction_date' => 'ASC']);
		
		$sales=[];
		foreach ($Bills as $Bill) {
			$sales[$Bill->year][$Bill->month]=$Bill->sale;
		}

		$this->set(compact('from_date', 'to_date', 'purchases', 'sales', 'from_date1', 'to_date1'));

	}

	public function monthlyReportExcel(){
		$this->viewBuilder()->layout('');

        if ($this->request->is(['patch','post','put'])){
            $excel_box = $this->request->data['excel_box'];

            $date= date("d-m-Y"); 
            $time=date('h:i:a',time());

            $filename="Monthly-Report-".$date.'_'.$time;

            header ("Expires: 0");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/vnd.ms-excel");
            header ("Content-Disposition: attachment; filename=".$filename.".xls");
            header ("Content-Description: Generated Report" );

            echo $excel_box;
        }
        exit;
	}

	public function store()
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
		->contain(['PrimaryUnits', 'RawMaterialSubCategories'])
		->where(['RawMaterials.is_deleted'=>0])
		->order(['RawMaterialSubCategories.Name' => 'ASC'])
		->autoFields(true);

		$this->set(compact('RawMaterials'));
	}


}
