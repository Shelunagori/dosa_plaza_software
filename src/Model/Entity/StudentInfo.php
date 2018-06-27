<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentInfo Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $class_id
 * @property int $year_id
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Class $class
 * @property \App\Model\Entity\Year $year
 */
class StudentInfo extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'student_id' => true,
        'class_id' => true,
        'year_id' => true,
        'student' => true,
        'class' => true
       // 'year' => true
    ];
}
