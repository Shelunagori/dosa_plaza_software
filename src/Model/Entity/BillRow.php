<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BillRow Entity
 *
 * @property int $id
 * @property int $bill_id
 * @property int $item_id
 * @property float $quantity
 * @property float $rate
 * @property float $discount_per
 * @property float $amount
 *
 * @property \App\Model\Entity\Bill $bill
 * @property \App\Model\Entity\Item $item
 */
class BillRow extends Entity
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
        'bill_id' => true,
        'item_id' => true,
        'quantity' => true,
        'rate' => true,
        'discount_per' => true,
        'amount' => true,
        'bill' => true,
        'item' => true
    ];
}
