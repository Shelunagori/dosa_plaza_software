<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VegetableRate Entity
 *
 * @property int $id
 * @property int $vegetable_id
 * @property float $rate
 * @property int $month
 * @property int $year
 *
 * @property \App\Model\Entity\Vegetable $vegetable
 */
class VegetableRate extends Entity
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
        'vegetable_id' => true,
        'rate' => true,
        'month' => true,
        'year' => true,
        'vegetable' => true
    ];
}
