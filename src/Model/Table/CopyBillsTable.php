<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CopyBills Model
 *
 * @property \App\Model\Table\TablesTable|\Cake\ORM\Association\BelongsTo $Tables
 * @property \App\Model\Table\TaxesTable|\Cake\ORM\Association\BelongsTo $Taxes
 * @property \App\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\EmployeesTable|\Cake\ORM\Association\BelongsTo $Employees
 * @property \App\Model\Table\OffersTable|\Cake\ORM\Association\BelongsTo $Offers
 *
 * @method \App\Model\Entity\CopyBill get($primaryKey, $options = [])
 * @method \App\Model\Entity\CopyBill newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CopyBill[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CopyBill|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CopyBill|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CopyBill patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CopyBill[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CopyBill findOrCreate($search, callable $callback = null, $options = [])
 */
class CopyBillsTable extends Table
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

        $this->setTable('copy_bills');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Tables', [
            'foreignKey' => 'table_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Taxes', [
            'foreignKey' => 'tax_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id'
        ]);
        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id'
        ]);
        $this->belongsTo('Offers', [
            'foreignKey' => 'offer_id'
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
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

        $validator
            ->scalar('voucher_no')
            ->maxLength('voucher_no', 50)
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no');

        $validator
            ->decimal('total')
            ->requirePresence('total', 'create')
            ->notEmpty('total');

        $validator
            ->decimal('round_off')
            ->requirePresence('round_off', 'create')
            ->notEmpty('round_off');

        $validator
            ->decimal('grand_total')
            ->requirePresence('grand_total', 'create')
            ->notEmpty('grand_total');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->scalar('order_type')
            ->maxLength('order_type', 10)
            ->requirePresence('order_type', 'create')
            ->notEmpty('order_type');

        $validator
            ->integer('delivery_no')
            ->allowEmpty('delivery_no');

        $validator
            ->integer('take_away_no')
            ->allowEmpty('take_away_no');

        $validator
            ->dateTime('occupied_time')
            ->allowEmpty('occupied_time');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->integer('no_of_pax')
            ->allowEmpty('no_of_pax');

        $validator
            ->integer('payment_status')
            ->requirePresence('payment_status', 'create')
            ->notEmpty('payment_status');

        $validator
            ->scalar('payment_type')
            ->maxLength('payment_type', 50)
            ->requirePresence('payment_type', 'create')
            ->notEmpty('payment_type');

        $validator
            ->scalar('is_deleted')
            ->maxLength('is_deleted', 10)
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

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
        return $rules;
    }
}
