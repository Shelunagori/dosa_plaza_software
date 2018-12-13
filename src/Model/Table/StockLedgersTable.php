<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockLedgers Model
 *
 * @property \App\Model\Table\RawMaterialsTable|\Cake\ORM\Association\BelongsTo $RawMaterials
 *
 * @method \App\Model\Entity\StockLedger get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockLedger newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StockLedger[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockLedger|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockLedger|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockLedger patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockLedger[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockLedger findOrCreate($search, callable $callback = null, $options = [])
 */
class StockLedgersTable extends Table
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

        $this->setTable('stock_ledgers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('RawMaterials', [
            'foreignKey' => 'raw_material_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PurchaseVoucherRows', [
            'foreignKey' => 'purchase_voucher_row_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
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
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->decimal('rate')
            ->requirePresence('rate', 'create')
            ->notEmpty('rate');

        $validator
            ->scalar('status')
            ->maxLength('status', 10)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        

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
