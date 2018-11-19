<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ManualStocks Model
 *
 * @property \App\Model\Table\RawMaterialsTable|\Cake\ORM\Association\BelongsTo $RawMaterials
 *
 * @method \App\Model\Entity\ManualStock get($primaryKey, $options = [])
 * @method \App\Model\Entity\ManualStock newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ManualStock[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ManualStock|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ManualStock|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ManualStock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ManualStock[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ManualStock findOrCreate($search, callable $callback = null, $options = [])
 */
class ManualStocksTable extends Table
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

        $this->setTable('manual_stocks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('RawMaterials', [
            'foreignKey' => 'raw_material_id',
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
            ->decimal('computer')
            ->requirePresence('computer', 'create')
            ->notEmpty('computer');

        $validator
            ->decimal('physical')
            ->requirePresence('physical', 'create')
            ->notEmpty('physical');

        $validator
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

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
        $rules->add($rules->existsIn(['raw_material_id'], 'RawMaterials'));

        return $rules;
    }
}
