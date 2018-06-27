<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sections Model
 *
 * @property \App\Model\Table\YearsTable|\Cake\ORM\Association\BelongsTo $Years
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\BelongsTo $ParentSections
 * @property \App\Model\Table\ExamsTable|\Cake\ORM\Association\HasMany $Exams
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\HasMany $ChildSections
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\HasMany $Subjects
 *
 * @method \App\Model\Entity\Section get($primaryKey, $options = [])
 * @method \App\Model\Entity\Section newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Section[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Section|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Section|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Section patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Section[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Section findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class SectionsTable extends Table
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

        $this->setTable('sections');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('Years', [
            'foreignKey' => 'year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ParentSections', [
            'className' => 'Sections',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Exams', [
            'foreignKey' => 'section_id',
        ]);
        $this->hasMany('ChildSections', [
            'className' => 'Sections',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Subjects', [
            'foreignKey' => 'section_id'
        ]);
		$this->hasMany('ExamSubjectDetails', [
            'foreignKey' => 'section_id'
        ]); 
		$this->belongsTo('Employees', [
            'foreignKey' => 'employee_id'
        ]); 

		$this->hasMany('StudentInfos', [
            'foreignKey' => 'section_id',
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
        //$rules->add($rules->existsIn(['year_id'], 'Years'));
        //$rules->add($rules->existsIn(['parent_id'], 'ParentSections'));

        return $rules;
    }
}
