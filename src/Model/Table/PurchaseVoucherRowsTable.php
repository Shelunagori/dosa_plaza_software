<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseVoucherRows Model
 *
 * @property \App\Model\Table\RawMaterialsTable|\Cake\ORM\Association\BelongsTo $RawMaterials
 * @property \App\Model\Table\PurchaseVouchersTable|\Cake\ORM\Association\BelongsTo $PurchaseVouchers
 *
 * @method \App\Model\Entity\PurchaseVoucherRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseVoucherRowsTable extends Table
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

        $this->setTable('purchase_voucher_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('RawMaterials', [
            'foreignKey' => 'raw_material_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PurchaseVouchers', [
            'foreignKey' => 'purchase_voucher_id',
            'joinType' => 'INNER'
        ]);
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

        $validator
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->decimal('rate')
            ->requirePresence('rate', 'create')
            ->notEmpty('rate');

        $validator
            ->decimal('discount_per')
            ->requirePresence('discount_per', 'create')
            ->notEmpty('discount_per');

        $validator
            ->decimal('discount_amt')
            ->requirePresence('discount_amt', 'create')
            ->notEmpty('discount_amt');
		 
		$validator
            ->decimal('taxable_value')
            ->requirePresence('taxable_value', 'create')
            ->notEmpty('taxable_value');
		
		$validator
            ->decimal('tax_per')
            ->requirePresence('tax_per', 'create')
            ->notEmpty('tax_per');

        $validator
            ->decimal('tax_amt')
            ->requirePresence('tax_amt', 'create')
            ->notEmpty('tax_amt');

        $validator
            ->decimal('round_off')
            ->requirePresence('round_off', 'create')
            ->notEmpty('round_off');

        $validator
            ->decimal('net_amt_total')
            ->requirePresence('net_amt_total', 'create')
            ->notEmpty('net_amt_total');

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
        $rules->add($rules->existsIn(['raw_material_id'], 'RawMaterials'));
        $rules->add($rules->existsIn(['purchase_voucher_id'], 'PurchaseVouchers'));

        return $rules;
    }
}
