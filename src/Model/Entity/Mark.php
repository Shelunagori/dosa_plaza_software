<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mark Entity
 *
 * @property int $id
 * @property int $subject_id
 * @property int $exam_id
 * @property int $student_id
 * @property float $points
 *
 * @property \App\Model\Entity\Subject $subject
 * @property \App\Model\Entity\Exam $exam
 * @property \App\Model\Entity\Student $student
 */
class Mark extends Entity
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
        'subject_id' => true,
        'exam_id' => true,
        'student_id' => true,
        'points' => true,
        'subject' => true,
        'exam' => true,
        'student' => true
    ];
}
