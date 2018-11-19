<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemLists Model
 *
 * @property |\Cake\ORM\Association\HasMany $InventoryRecords
 *
 * @method \App\Model\Entity\ItemList get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemList newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemList|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemList|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemList[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemList findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemListsTable extends Table
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

        $this->setTable('item_lists');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('InventoryRecords', [
            'foreignKey' => 'item_list_id'
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
