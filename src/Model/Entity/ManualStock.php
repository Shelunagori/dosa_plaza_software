<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ManualStock Entity
 *
 * @property int $id
 * @property int $raw_material_id
 * @property float $computer
 * @property float $physical
 * @property \Cake\I18n\FrozenDate $transaction_date
 *
 * @property \App\Model\Entity\RawMaterial $raw_material
 */
class ManualStock extends Entity
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
        'raw_material_id' => true,
        'computer' => true,
        'physical' => true,
        'transaction_date' => true,
        'raw_material' => true
    ];
}
