<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BillSettings Model
 *
 * @method \App\Model\Entity\BillSetting get($primaryKey, $options = [])
 * @method \App\Model\Entity\BillSetting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BillSetting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BillSetting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BillSetting|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BillSetting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BillSetting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BillSetting findOrCreate($search, callable $callback = null, $options = [])
 */
class BillSettingsTable extends Table
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

        $this->setTable('bill_settings');
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
            ->scalar('header')
            ->requirePresence('header', 'create')
            ->notEmpty('header');

        $validator
            ->scalar('footer')
            ->requirePresence('footer', 'create')
            ->notEmpty('footer');

        return $validator;
    }
}
