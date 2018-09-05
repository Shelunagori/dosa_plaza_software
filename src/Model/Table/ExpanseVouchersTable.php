<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExpanseVouchers Model
 *
 * @property \App\Model\Table\ExpanseVoucherRowsTable|\Cake\ORM\Association\HasMany $ExpanseVoucherRows
 *
 * @method \App\Model\Entity\ExpanseVoucher get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExpanseVoucher newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExpanseVoucher[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExpanseVoucher|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExpanseVoucher|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExpanseVoucher patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExpanseVoucher[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExpanseVoucher findOrCreate($search, callable $callback = null, $options = [])
 */
class ExpanseVouchersTable extends Table
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

        $this->setTable('expanse_vouchers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('ExpanseVoucherRows', [
            'foreignKey' => 'expanse_voucher_id'
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
            ->decimal('total_amount')
            ->requirePresence('total_amount', 'create')
            ->notEmpty('total_amount');

        $validator
            ->integer('voucher_no')
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no');

        $validator
            ->scalar('narration')
            ->requirePresence('narration', 'create')
            ->notEmpty('narration');

        return $validator;
    }
}
