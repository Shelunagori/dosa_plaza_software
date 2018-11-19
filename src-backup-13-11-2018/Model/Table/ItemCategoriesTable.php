<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemCategories Model
 *
 * @property \App\Model\Table\ItemSubCategoriesTable|\Cake\ORM\Association\HasMany $ItemSubCategories
 *
 * @method \App\Model\Entity\ItemCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemCategoriesTable extends Table
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

        $this->setTable('item_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ItemSubCategories', [
            'foreignKey' => 'item_category_id'
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

        /*$validator
            ->integer('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');
*/
        return $validator;
    }
}
