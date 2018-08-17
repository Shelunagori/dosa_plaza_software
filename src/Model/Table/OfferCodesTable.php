<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OfferCodes Model
 *
 * @method \App\Model\Entity\OfferCode get($primaryKey, $options = [])
 * @method \App\Model\Entity\OfferCode newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OfferCode[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OfferCode|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OfferCode|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OfferCode patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OfferCode[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OfferCode findOrCreate($search, callable $callback = null, $options = [])
 */
class OfferCodesTable extends Table
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

        $this->setTable('offer_codes');
        $this->setDisplayField('id');
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
            ->scalar('offer_name')
            ->maxLength('offer_name', 100)
            ->requirePresence('offer_name', 'create')
            ->notEmpty('offer_name');

        $validator
            ->scalar('offer_code')
            ->maxLength('offer_code', 100)
            ->requirePresence('offer_code', 'create')
            ->notEmpty('offer_code');


        $validator
            ->decimal('discount_per')
            ->requirePresence('discount_per', 'create')
            ->notEmpty('discount_per');

        return $validator;
    }
}
