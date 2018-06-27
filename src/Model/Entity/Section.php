<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Section Entity
 *
 * @property int $id
 * @property string $name
 * @property int $year_id
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 *
 * @property \App\Model\Entity\Year $year
 * @property \App\Model\Entity\ParentSection $parent_section
 * @property \App\Model\Entity\Exam[] $exams
 * @property \App\Model\Entity\ChildSection[] $child_sections
 * @property \App\Model\Entity\Subject[] $subjects
 */
class Section extends Entity
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
        'name' => true,
        'year_id' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'year' => true,
        'parent_section' => true,
        'exams' => true,
        'child_sections' => true,
        'subjects' => true
    ];
}
