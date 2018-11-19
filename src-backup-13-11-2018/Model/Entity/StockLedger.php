<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockLedger Entity
 *
 * @property int $id
 * @property int $raw_material_id
 * @property float $quantity
 * @property float $rate
 * @property string $status
 * @property \Cake\I18n\FrozenTime $effected_on
 *
 * @property \App\Model\Entity\RawMaterial $raw_material
 */
class StockLedger extends Entity
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
        '*' => true,
        'quantity' => true,
        'rate' => true,
        'status' => true,
        'effected_on' => true,
        'raw_material' => true,
        'voucher_no' =>  true,
		'transaction_date' =>  true,
    ];
}
