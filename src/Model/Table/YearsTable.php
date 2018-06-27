<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Years Model
 *
 * @method \App\Model\Entity\Year get($primaryKey, $options = [])
 * @method \App\Model\Entity\Year newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Year[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Year|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Year|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Year patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Year[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Year findOrCreate($search, callable $callback = null, $options = [])
 */
class YearsTable extends Table
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

        $this->setTable('years');
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
            ->integer('year_from')
            ->requirePresence('year_from', 'create')
            ->notEmpty('year_from');

        $validator
            ->integer('year_to')
            ->requirePresence('year_to', 'create')
            ->notEmpty('year_to');

        return $validator;
    }
}
