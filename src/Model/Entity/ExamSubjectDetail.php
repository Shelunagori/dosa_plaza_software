<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExamSubjectDetail Entity
 *
 * @property int $id
 * @property int $exam_id
 * @property int $subject_id
 * @property float $max_marks
 *
 * @property \App\Model\Entity\Exam $exam
 * @property \App\Model\Entity\Subject $subject
 */
class ExamSubjectDetail extends Entity
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
        'exam_id' => true,
        'subject_id' => true,
        'max_marks' => true,
        'exam' => true,
        'subject' => true
    ];
}
