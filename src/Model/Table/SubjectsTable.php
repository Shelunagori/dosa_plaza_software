<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subjects Model
 *
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\BelongsTo $Sections
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsTo $ParentSubjects
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\HasMany $ChildSubjects
 *
 * @method \App\Model\Entity\Subject get($primaryKey, $options = [])
 * @method \App\Model\Entity\Subject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Subject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subject|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Subject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subject findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class SubjectsTable extends Table
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

        $this->setTable('subjects');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ParentSubjects', [
            'className' => 'Subjects',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildSubjects', [
            'className' => 'Subjects',
            'foreignKey' => 'parent_id'
        ]);
		$this->hasMany('ExamSubjectDetails', [
            'foreignKey' => 'subject_id'
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

	public function fetchCategoryData($session,$array){
		
		if (count($array)) {
			foreach ($array as $vals) {
				if(count($vals['children'])==0)
				{
					//$this->Subjects = TableRegistry::get('Subjects');
					$crumbs=$this->find('path', ['for' => $vals->id]);
					$full_path='';
					$i=1;
					foreach ($crumbs as $crumb) 
					{
						$i++;
						$full_path.=$crumb->name . ' > ';
					}
					$full_path=substr_replace($full_path," ",-3);
					$q[]=$full_path;
					$main_subjects = $session->read('main_subjects');
					$main_subjects[$vals->id]=$full_path;
					$session->write('main_subjects', $main_subjects);
				}
				
				if (count($vals->children)) 
				{
					$this->fetchCategoryData($session,$vals->children);
				}
			}
			   
		}
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
        $rules->add($rules->existsIn(['section_id'], 'Sections'));
        //$rules->add($rules->existsIn(['parent_id'], 'ParentSubjects'));

        return $rules;
    }
}
