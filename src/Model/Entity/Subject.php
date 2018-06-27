<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subject Entity
 *
 * @property int $id
 * @property string $name
 * @property int $section_id
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 *
 * @property \App\Model\Entity\Section $section
 * @property \App\Model\Entity\ParentSubject $parent_subject
 * @property \App\Model\Entity\ChildSubject[] $child_subjects
 */
class Subject extends Entity
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
        'section_id' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'section' => true,
        'parent_subject' => true,
        'child_subjects' => true,
		'elective' =>true
    ];
}
