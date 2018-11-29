<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CopyBillRow Entity
 *
 * @property int $id
 * @property int $bill_id
 * @property int $item_id
 * @property float $quantity
 * @property float $rate
 * @property float $amount
 * @property float $discount_per
 * @property float $discount_amount
 * @property float $net_amount
 * @property float $tax_per
 *
 * @property \App\Model\Entity\Bill $bill
 * @property \App\Model\Entity\Item $item
 */
class CopyBillRow extends Entity
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
        'amount' => true,
        'discount_per' => true,
        'discount_amount' => true,
        'net_amount' => true,
        'tax_per' => true,
        'bill' => true,
        'item' => true
    ];
}
