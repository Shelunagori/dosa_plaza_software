<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VendorItems Model
 *
 * @property \App\Model\Table\VendorsTable|\Cake\ORM\Association\BelongsTo $Vendors
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\VendorItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\VendorItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VendorItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VendorItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendorItem|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VendorItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VendorItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VendorItem findOrCreate($search, callable $callback = null, $options = [])
 */
class VendorItemsTable extends Table
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

        $this->setTable('vendor_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RawMaterials', [
            'foreignKey' => 'raw_material_id',
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
        $rules->add($rules->existsIn(['vendor_id'], 'Vendors'));
        $rules->add($rules->existsIn(['raw_material_id'], 'RawMaterials'));

        return $rules;
    }
}
