<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VegetableRates Model
 *
 * @property \App\Model\Table\VegetablesTable|\Cake\ORM\Association\BelongsTo $Vegetables
 *
 * @method \App\Model\Entity\VegetableRate get($primaryKey, $options = [])
 * @method \App\Model\Entity\VegetableRate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VegetableRate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VegetableRate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VegetableRate|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VegetableRate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VegetableRate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VegetableRate findOrCreate($search, callable $callback = null, $options = [])
 */
class VegetableRatesTable extends Table
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

        $this->setTable('vegetable_rates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Vegetables', [
            'foreignKey' => 'vegetable_id',
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
            ->decimal('rate')
            ->requirePresence('rate', 'create')
            ->notEmpty('rate');

        $validator
            ->integer('month')
            ->requirePresence('month', 'create')
            ->notEmpty('month');

        $validator
            ->integer('year')
            ->requirePresence('year', 'create')
            ->notEmpty('year');

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
        $rules->add($rules->existsIn(['vegetable_id'], 'Vegetables'));

        return $rules;
    }
}
