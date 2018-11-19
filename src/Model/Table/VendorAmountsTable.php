<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VendorAmounts Model
 *
 * @method \App\Model\Entity\VendorAmount get($primaryKey, $options = [])
 * @method \App\Model\Entity\VendorAmount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VendorAmount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VendorAmount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendorAmount|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendorAmount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VendorAmount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VendorAmount findOrCreate($search, callable $callback = null, $options = [])
 */
class VendorAmountsTable extends Table
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

        $this->setTable('vendor_amounts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->decimal('amount')
            ->allowEmpty('amount');

        return $validator;
    }
}
