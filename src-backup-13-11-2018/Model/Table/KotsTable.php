<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Kots Model
 *
 * @property \App\Model\Table\TablesTable|\Cake\ORM\Association\BelongsTo $Tables
 * @property \App\Model\Table\KotRowsTable|\Cake\ORM\Association\HasMany $KotRows
 *
 * @method \App\Model\Entity\Kot get($primaryKey, $options = [])
 * @method \App\Model\Entity\Kot newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Kot[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Kot|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Kot|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Kot patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Kot[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Kot findOrCreate($search, callable $callback = null, $options = [])
 */
class KotsTable extends Table
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

        $this->setTable('kots');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Tables', [
            'foreignKey' => 'table_id',
            'joinType' => 'LEFT'
        ]);

        

        $this->belongsTo('Taxes');
		$this->belongsTo('Comments');

        $this->belongsTo('ItemCategories');
        $this->belongsTo('Customers');
        $this->belongsTo('Employees');
        
        $this->hasMany('KotRows', [
            'foreignKey' => 'kot_id'
        ]);
        $this->belongsTo('Bills', [
            'foreignKey' => 'bill_id',
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
            ->integer('voucher_no')
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
   
}
