<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExpanseVoucherRows Model
 *
 * @property \App\Model\Table\ExpanseVouchersTable|\Cake\ORM\Association\BelongsTo $ExpanseVouchers
 * @property \App\Model\Table\ExpanseHeadsTable|\Cake\ORM\Association\BelongsTo $ExpanseHeads
 *
 * @method \App\Model\Entity\ExpanseVoucherRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExpanseVoucherRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExpanseVoucherRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExpanseVoucherRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExpanseVoucherRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExpanseVoucherRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExpanseVoucherRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExpanseVoucherRow findOrCreate($search, callable $callback = null, $options = [])
 */
class ExpanseVoucherRowsTable extends Table
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

        $this->setTable('expanse_voucher_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ExpanseVouchers', [
            'foreignKey' => 'expanse_voucher_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ExpanseHeads', [
            'foreignKey' => 'expanse_head_id',
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
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

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
        $rules->add($rules->existsIn(['expanse_voucher_id'], 'ExpanseVouchers'));
        $rules->add($rules->existsIn(['expanse_head_id'], 'ExpanseHeads'));

        return $rules;
    }
}
