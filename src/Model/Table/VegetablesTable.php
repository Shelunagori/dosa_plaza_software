<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vegetables Model
 *
 * @property \App\Model\Table\VegetableRatesTable|\Cake\ORM\Association\HasMany $VegetableRates
 * @property \App\Model\Table\VegetableRecordsTable|\Cake\ORM\Association\HasMany $VegetableRecords
 *
 * @method \App\Model\Entity\Vegetable get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vegetable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vegetable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vegetable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vegetable|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vegetable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vegetable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vegetable findOrCreate($search, callable $callback = null, $options = [])
 */
class VegetablesTable extends Table
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

        $this->setTable('vegetables');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('VegetableRates', [
            'foreignKey' => 'vegetable_id'
        ]);
        $this->hasMany('VegetableRecords', [
            'foreignKey' => 'vegetable_id'
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('unit')
            ->maxLength('unit', 50)
            ->requirePresence('unit', 'create')
            ->notEmpty('unit');

        return $validator;
    }
}
