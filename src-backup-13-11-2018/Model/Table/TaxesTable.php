<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Taxes Model
 *
 * @property |\Cake\ORM\Association\HasMany $Bills
 * @property |\Cake\ORM\Association\HasMany $Items
 * @property \App\Model\Table\RawMaterialsTable|\Cake\ORM\Association\HasMany $RawMaterials
 *
 * @method \App\Model\Entity\Tax get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tax newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tax[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tax|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tax|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tax patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tax[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tax findOrCreate($search, callable $callback = null, $options = [])
 */
class TaxesTable extends Table
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

        $this->setTable('taxes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Bills', [
            'foreignKey' => 'tax_id'
        ]);
        $this->hasMany('Items', [
            'foreignKey' => 'tax_id'
        ]);
        $this->hasMany('RawMaterials', [
            'foreignKey' => 'tax_id'
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
            ->maxLength('name', 20)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->decimal('tax_per')
            ->requirePresence('tax_per', 'create')
            ->notEmpty('tax_per');

       

        return $validator;
    }
}
