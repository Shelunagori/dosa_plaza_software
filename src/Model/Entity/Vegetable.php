<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vegetable Entity
 *
 * @property int $id
 * @property string $name
 * @property string $unit
 * @property float $rate
 *
 * @property \App\Model\Entity\VegetableRecord[] $vegetable_records
 * @property \App\Model\Entity\VegetableRate[] $vegetable_rates
 */
class Vegetable extends Entity
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
        'unit' => true,
        'rate' => true,
        'vegetable_records' => true,
        'vegetable_rates' => true
    ];
}
