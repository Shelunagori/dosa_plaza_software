<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InventoryRecords Model
 *
 * @property \App\Model\Table\ItemListsTable|\Cake\ORM\Association\BelongsTo $ItemLists
 *
 * @method \App\Model\Entity\InventoryRecord get($primaryKey, $options = [])
 * @method \App\Model\Entity\InventoryRecord newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InventoryRecord[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InventoryRecord|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InventoryRecord|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InventoryRecord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InventoryRecord[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InventoryRecord findOrCreate($search, callable $callback = null, $options = [])
 */
class InventoryRecordsTable extends Table
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

        $this->setTable('inventory_records');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ItemLists', [
            'foreignKey' => 'item_list_id',
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
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

        $validator
            ->decimal('projection')
            ->requirePresence('projection', 'create')
            ->notEmpty('projection');

        $validator
            ->decimal('mall')
            ->requirePresence('mall', 'create')
            ->notEmpty('mall');

        $validator
            ->decimal('road')
            ->requirePresence('road', 'create')
            ->notEmpty('road');

        $validator
            ->decimal('closing_balance')
            ->requirePresence('closing_balance', 'create')
            ->notEmpty('closing_balance');

        $validator
            ->decimal('requirement')
            ->requirePresence('requirement', 'create')
            ->notEmpty('requirement');

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
        $rules->add($rules->existsIn(['item_list_id'], 'ItemLists'));

        return $rules;
    }
}
