<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterOffers Model
 *
 * @method \App\Model\Entity\MasterOffer get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterOffer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterOffer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterOffer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterOffer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterOffer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterOffer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterOffer findOrCreate($search, callable $callback = null, $options = [])
 */
class MasterOffersTable extends Table
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

        $this->setTable('master_offers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->decimal('percentage')
            ->requirePresence('percentage', 'create')
            ->notEmpty('percentage');

         

        return $validator;
    }
}
