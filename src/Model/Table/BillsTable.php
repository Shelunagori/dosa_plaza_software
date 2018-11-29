<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bills Model
 *
 * @property \App\Model\Table\TablesTable|\Cake\ORM\Association\BelongsTo $Tables
 * @property |\Cake\ORM\Association\BelongsTo $Kots
 * @property \App\Model\Table\BillRowsTable|\Cake\ORM\Association\HasMany $BillRows
 *
 * @method \App\Model\Entity\Bill get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bill newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bill[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bill|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bill|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bill patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bill[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bill findOrCreate($search, callable $callback = null, $options = [])
 */
class BillsTable extends Table
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

        $this->setTable('bills');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customers');
        $this->belongsTo('BillSettings');
        
        $this->belongsTo('Tables', [
            'foreignKey' => 'table_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Kots', [
            'foreignKey' => 'kot_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Taxes', [
            'foreignKey' => 'tax_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('BillRows', [
            'foreignKey' => 'bill_id'
        ]);
        $this->belongsTo('CopyBills');
        $this->belongsTo('CopyBillRows');
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
            ->scalar('voucher_no')
            ->maxLength('voucher_no', 50)
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no');

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
        
        $rules->add($rules->existsIn(['kot_id'], 'Kots'));

        return $rules;
    }
}
