<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bills Controller
 *
 * @property \App\Model\Table\BillsTable $Bills
 *
 * @method \App\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BillsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tables']
        ];
        $bills = $this->paginate($this->Bills);

        $this->set(compact('bills'));
    }

    /**
     * View method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
		$this->viewBuilder()->layout('');
		$bill_id=$this->request->query('bill_id');
		
        $bill = $this->Bills->get($bill_id, [
            'contain' => ['BillRows'=>['Items'], 'Customers', 'Tables']
        ]);

        $this->set('bill', $bill);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $c_name=$this->request->query('c_name');
        $c_mobile_no=$this->request->query('c_mobile_no');
        $c_pax=$this->request->query('c_pax');
        $dob=$this->request->query('dob');
        $doa=$this->request->query('doa');
        $c_email=$this->request->query('c_email');
        $c_address=$this->request->query('c_address');
        $order_type=$this->request->query('order_type');
        $IsCustomerExist=$this->Bills->Customers->find()->where(['mobile_no' => $c_mobile_no])->first();
        if($IsCustomerExist){
            $Customer=$this->Bills->Customers->get($IsCustomerExist->id);
            $Customer->name=$c_name;
            $Customer->address=$c_address;
            $Customer->dob=$dob;
            $Customer->anniversary=$doa;
            $Customer->email=$c_email;
            $Customer->address=$c_address;
            $this->Bills->Customers->save($Customer);
        }else{
            $Customer = $this->Bills->Customers->newEntity();
            $Customer->name=$c_name;
            $Customer->address=$c_address;
            $Customer->dob=$dob;
            $Customer->anniversary=$doa;
            $Customer->email=$c_email;
            $Customer->address=$c_address;
            $Customer->mobile_no=$c_mobile_no;
            
            $last_Customer=$this->Bills->Customers->find()
                            ->order(['customer_code' => 'DESC'])->first();
            if($last_Customer){
                $Customer->customer_code=$last_Customer->customer_code+1;
            }else{
                $Customer->customer_code=2001;
            }
            $this->Bills->Customers->save($Customer);
        }

		$myJSON=$this->request->query('myJSON');

		$table_id=$this->request->query('table_id');
		$total=$this->request->query('total'); 
		$roundOff=$this->request->query('roundOff');
        $net=$this->request->query('net');
        $customer_id=$Customer->id;
		$kot_ids=explode(',', $this->request->query('kot_ids'));
		$q = json_decode($myJSON, true);
		
        $bill = $this->Bills->newEntity();
		
		$last_voucher_no=$this->Bills->find()
                        ->select(['voucher_no'])->order(['id' => 'DESC'])->first();
		if($last_voucher_no){
			$bill->voucher_no=$last_voucher_no->voucher_no+1;
		}else{
			$bill->voucher_no=1;
		}
		
		$bill->table_id=$table_id;
		$bill->total=$total; 
		$bill->round_off=$roundOff;
        $bill->grand_total=$net;
		$bill->customer_id=$customer_id;
		$bill->order_type=$order_type;
        $bill_rows=[];
		foreach($q as $row){
			$bill_row = $this->Bills->BillRows->newEntity();
			$bill_row->item_id=$row['item_id'];
			$bill_row->quantity=$row['quantity'];
			$bill_row->rate=$row['rate'];
			$bill_row->amount=$row['amount'];
			$bill_row->discount_per=$row['discount_per'];
			$bill_row->net_amount=$row['net_amount'];
            $bill_row->tax_per=$row['percen'];            
			$bill_rows[]=$bill_row;
		}
		$bill->bill_rows=$bill_rows;
        if($table_id>0){
            $Table = $this->Bills->Tables->get($table_id);
            $bill->occupied_time=$Table->occupied_time;
        }
        else{
            $bill->occupied_time=date("Y-m-d h:i:s");
        }

		if ($this->Bills->save($bill)) {
			$query = $this->Bills->Kots->query();
			$query->update()
				->set(['bill_pending' => 'no'])
				->where(['table_id' => $table_id])
				->execute();
			echo $bill->id;

            foreach ($kot_ids as $key => $kot_id) {
                $query = $this->Bills->Kots->query();
                $query->update()
                    ->set(['bill_id' => $bill->id])
                    ->where(['id' => $kot_id])
                    ->execute();
            }

            if($table_id>0){
                $Table->status = 'vacant';
                $Table->c_name = '';
                $Table->c_mobile = '';
                $Table->no_of_pax = '';
                $Table->occupied_time = '';
                $Table->dob = '';
                $Table->doa = '';
                $Table->email = '';
                $Table->c_address = '';
                $this->Bills->Tables->save($Table);  
            }

            //Stock Impact Start//
            foreach ($bill->bill_rows as $bill_row) {
                $Items = $this->Bills->BillRows->Items->get($bill_row->item_id, [
                            'contain' => ['ItemRows' => ['RawMaterials']]
                        ]);
                foreach ($Items->item_rows as $item_row) {
                    if($item_row->raw_material->recipe_unit_type=='primary'){
                        $outQty=$item_row->quantity*$bill_row->quantity;
                    }else if($item_row->raw_material->recipe_unit_type=='secondary'){
                        $outQty=($item_row->quantity*$bill_row->quantity)/$item_row->raw_material->formula;
                    }
                    $stockLedger = $this->Bills->BillRows->StockLedgers->newEntity();
                    $stockLedger->raw_material_id = $item_row->raw_material_id;
                    $stockLedger->quantity = $outQty;
                    $stockLedger->rate = 0;//To Be Calculate
                    $stockLedger->status = 'out';
                    $stockLedger->effected_on = date( "Y-m-d H:i:s" );
                    $stockLedger->voucher_name = 'Bill';
                    $stockLedger->adjustment_commant = '';
                    $stockLedger->wastage_commant = '';
                    $stockLedger->purchase_voucher_row_id = 0;
                    $stockLedger->purchase_voucher_id = 0;
                    $stockLedger->bill_id = $bill->id;
                    $stockLedger->bill_row_id = $bill_row->id;
                    $this->Bills->BillRows->StockLedgers->save($stockLedger);
                }
                echo '0'; exit;

            }
            //Stock Impact End//
            
		}else{
			echo '0';
		}
		exit;
    }

    /**
     * Edit method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bill = $this->Bills->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bill = $this->Bills->patchEntity($bill, $this->request->getData());
            if ($this->Bills->save($bill)) {
                $this->Flash->success(__('The bill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bill could not be saved. Please, try again.'));
        }
        $tables = $this->Bills->Tables->find('list', ['limit' => 200]);
        $this->set(compact('bill', 'tables'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bill = $this->Bills->get($id);
        if ($this->Bills->delete($bill)) {
            $this->Flash->success(__('The bill has been deleted.'));
        } else {
            $this->Flash->error(__('The bill could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
