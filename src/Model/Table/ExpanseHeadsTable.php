<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExpanseHeads Model
 *
 * @property \App\Model\Table\ExpanseVoucherRowsTable|\Cake\ORM\Association\HasMany $ExpanseVoucherRows
 *
 * @method \App\Model\Entity\ExpanseHead get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExpanseHead newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExpanseHead[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExpanseHead|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExpanseHead|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExpanseHead patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExpanseHead[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExpanseHead findOrCreate($search, callable $callback = null, $options = [])
 */
class ExpanseHeadsTable extends Table
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

        $this->setTable('expanse_heads');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ExpanseVoucherRows', [
            'foreignKey' => 'expanse_head_id'
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

        return $validator;
    }
}
