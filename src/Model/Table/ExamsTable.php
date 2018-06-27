<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Exams Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $ParentExams
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\BelongsTo $Sections
 * @property |\Cake\ORM\Association\HasMany $EmployeeMarksAccesses
 * @property \App\Model\Table\ExamSubjectDetailsTable|\Cake\ORM\Association\HasMany $ExamSubjectDetails
 * @property |\Cake\ORM\Association\HasMany $ChildExams
 *
 * @method \App\Model\Entity\Exam get($primaryKey, $options = [])
 * @method \App\Model\Entity\Exam newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Exam[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Exam|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Exam|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Exam patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Exam[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Exam findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class ExamsTable extends Table
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

        $this->setTable('exams');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('ParentExams', [
            'className' => 'Exams',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('EmployeeMarksAccesses', [
            'foreignKey' => 'exam_id'
        ]);
        $this->hasMany('ExamSubjectDetails', [
            'foreignKey' => 'exam_id'
        ]);
        $this->hasMany('ChildExams', [
            'className' => 'Exams',
            'foreignKey' => 'parent_id'
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
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

	public function fetchCategoryData($session,$array){
		
		if (count($array)) {
			foreach ($array as $vals) {
				if(count($vals['children'])==0)
				{
					//$this->Subjects = TableRegistry::get('Subjects');
					$crumbs=$this->find('path', ['for' => $vals->id]);
					$key_path=''; $full_path='';
					$i=1;
					foreach ($crumbs as $crumb) 
					{
						$i++;
						$key_path.=$crumb->id . ' - ';
						$full_path.=$crumb->name . ' - ';
					}
					$key_path=substr_replace($key_path," ",-3);
					$full_path=substr_replace($full_path," ",-3);
					
					$main_exams = $session->read('main_exams');
					$main_exams[$vals->id]=['key_path'=>$key_path, 'full_path'=>$full_path];
					$session->write('main_exams', $main_exams);
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
        $rules->add($rules->existsIn(['parent_id'], 'ParentExams'));
        $rules->add($rules->existsIn(['section_id'], 'Sections'));

        return $rules;
    }
}
