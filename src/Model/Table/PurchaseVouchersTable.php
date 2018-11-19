<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * PurchaseVouchers Model
 *
 * @property \App\Model\Table\VandorsTable|\Cake\ORM\Association\BelongsTo $Vandors
 * @property \App\Model\Table\PurchaseVoucherRowsTable|\Cake\ORM\Association\HasMany $PurchaseVoucherRows
 *
 * @method \App\Model\Entity\PurchaseVoucher get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseVoucher newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucher[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucher|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseVoucher|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseVoucher patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucher[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucher findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseVouchersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('purchase_vouchers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('PurchaseVoucherRows', [
            'foreignKey' => 'purchase_voucher_id',
            'saveStrategy' => 'replace'
        ]);
		  $this->belongsTo('Items', [
            'foreignKey' => 'purchase_voucher_id',
            'joinType' => 'INNER'
        ]);
	}

    public function beforeMarshal(Event $event, ArrayObject $data)
    {
        @$data['transaction_date']       = trim(date('Y-m-d',strtotime(@$data['transaction_date'])));
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        /* $validator
            ->integer('voucher_no')
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no'); */

        /* $validator
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date'); */

       $validator
            ->decimal('grand_total')
            ->requirePresence('grand_total', 'create')
            ->notEmpty('grand_total');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['vendor_id'], 'Vendors'));

        return $rules;
    }
	public function lastvoucherno(){
		
		$PurchaseVouchers = $this->find()->select(['voucher_no'])->order(['voucher_no'=>'DESC'])->limit(1)->first();
		if($PurchaseVouchers){
			$purchese_order_no = $PurchaseVouchers->voucher_no+1;
		}else{
			$purchese_order_no = 1;
		}
		return $purchese_order_no;		
	}
}
