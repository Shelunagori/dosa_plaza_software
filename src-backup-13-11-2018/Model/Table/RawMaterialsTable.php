<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RawMaterials Model
 *
 * @method \App\Model\Entity\RawMaterial get($primaryKey, $options = [])
 * @method \App\Model\Entity\RawMaterial newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RawMaterial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RawMaterial|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RawMaterial|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RawMaterial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RawMaterial[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RawMaterial findOrCreate($search, callable $callback = null, $options = [])
 */
class RawMaterialsTable extends Table
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

        $this->setTable('raw_materials');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
		
        $this->belongsTo('RawMaterialSubCategories', [
            'foreignKey' => 'raw_material_sub_category_id',
            'joinType' => 'INNER'
        ]);
        
		$this->belongsTo('Taxes', [
            'foreignKey' => 'tax_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('PrimaryUnits', [
            'className'=>'Units',
            'foreignKey' => 'primary_unit_id',
            'propertyName' => 'primary_unit'
        ]);

        $this->belongsTo('SecondaryUnits', [
            'className'=>'Units',
            'foreignKey' => 'secondary_unit_id',
            'propertyName' => 'secondary_unit'
        ]); 

		$this->hasMany('StockLedgers', [
            'foreignKey' => 'raw_material_id'
        ]);
        $this->hasMany('PurchaseVoucherRows', [
            'foreignKey' => 'raw_material_id'
        ]);
        $this->hasMany('VendorItems', [
            'foreignKey' => 'raw_material_id'
        ]);

        $this->hasMany('ItemRows', [
            'foreignKey' => 'raw_material_id'
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
