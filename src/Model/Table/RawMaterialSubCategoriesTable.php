<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RawMaterialSubCategories Model
 *
 * @property \App\Model\Table\RawMaterialCategoriesTable|\Cake\ORM\Association\BelongsTo $RawMaterialCategories
 *
 * @method \App\Model\Entity\RawMaterialSubCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\RawMaterialSubCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RawMaterialSubCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RawMaterialSubCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RawMaterialSubCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RawMaterialSubCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RawMaterialSubCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RawMaterialSubCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class RawMaterialSubCategoriesTable extends Table
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

        $this->setTable('raw_material_sub_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('RawMaterialCategories', [
            'foreignKey' => 'raw_material_category_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('RawMaterials', [
            'foreignKey' => 'raw_material_sub_category_id'
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
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

         

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
        $rules->add($rules->existsIn(['raw_material_category_id'], 'RawMaterialCategories'));

        return $rules;
    }
}
