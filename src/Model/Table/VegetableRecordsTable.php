<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VegetableRecords Model
 *
 * @method \App\Model\Entity\VegetableRecord get($primaryKey, $options = [])
 * @method \App\Model\Entity\VegetableRecord newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VegetableRecord[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VegetableRecord|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VegetableRecord|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VegetableRecord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VegetableRecord[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VegetableRecord findOrCreate($search, callable $callback = null, $options = [])
 */
class VegetableRecordsTable extends Table
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

        $this->setTable('vegetable_records');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Vegetables', [
            'foreignKey' => 'vegetable_id',
            'joinType' => 'INNER'
        ]);

         $this->belongsTo('VendorAmounts');

        
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
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        return $validator;
    }
}
