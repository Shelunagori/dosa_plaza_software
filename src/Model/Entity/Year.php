<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Year Entity
 *
 * @property int $id
 * @property int $year_from
 * @property int $year_to
 */
class Year extends Entity
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
        'year_from' => true,
        'year_to' => true
    ];
}
