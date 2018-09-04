<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RawMaterialCategories Model
 *
 * @method \App\Model\Entity\RawMaterialCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\RawMaterialCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RawMaterialCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RawMaterialCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RawMaterialCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RawMaterialCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RawMaterialCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RawMaterialCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class RawMaterialCategoriesTable extends Table
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

        $this->setTable('raw_material_categories');
        $this->setDisplayField('name');
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
