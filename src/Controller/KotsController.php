<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Kots Controller
 *
 * @property \App\Model\Table\KotsTable $Kots
 *
 * @method \App\Model\Entity\Kot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class KotsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $table_id=$this->request->query('table_id');
        $kots = $this->Kots->find()->where(['table_id'=>$table_id, 'bill_pending'=>'yes'])->contain(['KotRows'=>['Items']]);

        
        $this->set(compact('kots'));
    }

    public function generate($table_id=null,$order_type=null)
    {
        $this->viewBuilder()->layout('counter');
        $ItemCategories =   $this->Kots->ItemCategories->find()
                            ->contain(['ItemSubCategories'=>['Items']])
                            ->where(['ItemCategories.is_deleted'=>0]);
        $Items =    $this->Kots->ItemCategories->ItemSubCategories->Items->find()
                    ->where(['Items.is_deleted'=>0])
                    ->order(['Items.name'=>'ASC']);
        $Comments = $this->Kots->Comments->find('list');
        $this->set(compact('Tables', 'ItemCategories', 'Items', 'table_id', 'Comments','order_type'));
    }

    /**
     * View method
     *
     * @param string|null $id Kot id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $table_id=$this->request->query('table_id');
        $search_mobile=$this->request->query('search_mobile');
        $search_code=$this->request->query('search_code');
		
        $searchBy=array();
        $searchbox=0;
        if(!empty($search_mobile) || !empty($search_code))
        {
            $searchBy=$this->Kots->Tables->Customers->find()
                 ->where(['OR' => array(
                            array("Customers.mobile_no" => $search_mobile),
                            array("Customers.customer_code" => $search_code)
                        )])
                 ->first();
            if(!empty($searchBy)){
                $searchbox=1;  
            }
        }
        //pr($searchBy);exit;

		$Kots=$this->Kots->find()->where(['table_id'=>$table_id, 'bill_pending'=>'yes'])->contain(['KotRows'=>['Items'=>['Taxes']]]);
		if($table_id>0){
    		$Table=$this->Kots->Tables->get($table_id);
        }
		$taxes=$this->Kots->Taxes->find();
		$this->set(compact('Kots', 'Table', 'taxes','searchbox','searchBy'));
    }

    public function viewkot($kot_id=null)
    {
        $this->viewBuilder()->layout('');
        $Kots=$this->Kots->find()->where(['Kots.id'=>$kot_id, 'Kots.bill_pending'=>'yes'])->contain(["Tables",'KotRows'=>['Items'=>['Taxes']]])->first();
        //pr($Kots->toArray());exit;
        $this->set(compact('Kots'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$myJSON=$this->request->query('myJSON');
        $table_id=$this->request->query('table_id');
        $one_comment=$this->request->query('one_comment');
        $order_type=$this->request->query('order_type'); 
		$q = json_decode($myJSON, true);
		
        $kot = $this->Kots->newEntity();
			
		$last_voucher_no=$this->Kots->find()->select(['voucher_no'])->order(['id' => 'DESC'])->first();
		if($last_voucher_no){
			$kot->voucher_no=$last_voucher_no->voucher_no+1;
		}else{
			$kot->voucher_no=1;
		}
			
        $kot->table_id=$table_id;
		$kot->one_comment=$one_comment;
        $kot->order_type=$order_type;
		
		$kot_rows=[];
		foreach($q as $row){
			$kot_row = $this->Kots->KotRows->newEntity();
			$kot_row->item_id=$row['item_id'];
			$kot_row->quantity=$row['quantity'];
			$kot_row->rate=$row['rate'];
            $kot_row->amount=$row['amount'];
			$kot_row->item_comment=$row['comment'];
			$kot_rows[]=$kot_row;
		}
		$kot->kot_rows=$kot_rows;
		if ($data=$this->Kots->save($kot)) {
			echo $data->id;
		}else{
			echo '0';
		}
		exit;
    }

    /**
     * Edit method
     *
     * @param string|null $id Kot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $kot = $this->Kots->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $kot = $this->Kots->patchEntity($kot, $this->request->getData());
            if ($this->Kots->save($kot)) {
                $this->Flash->success(__('The kot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kot could not be saved. Please, try again.'));
        }
        $tables = $this->Kots->Tables->find('list', ['limit' => 200]);
        $this->set(compact('kot', 'tables'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Kot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $kot = $this->Kots->get($id);
        if ($this->Kots->delete($kot)) {
            $this->Flash->success(__('The kot has been deleted.'));
        } else {
            $this->Flash->error(__('The kot could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
