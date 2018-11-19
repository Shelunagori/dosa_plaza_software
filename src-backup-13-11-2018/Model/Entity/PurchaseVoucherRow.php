<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseVoucherRow Entity
 *
 * @property int $id
 * @property int $raw_materials_id
 * @property float $quantity
 * @property float $rate
 * @property float $discount_per
 * @property float $discount_amt
 * @property float $pnf_per
 * @property float $pnf_amount
 * @property float $tax_per
 * @property float $tax_amt
 * @property float $round_off
 * @property float $net_amt_total
 * @property int $purchase_voucher_id
 *
 * @property \App\Model\Entity\RawMaterial $raw_material
 * @property \App\Model\Entity\PurchaseVoucher $purchase_voucher
 */
class PurchaseVoucherRow extends Entity
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
        'quantity' => true,
        'rate' => true,
        'discount_per' => true,
        'discount_amt' => true,
		'taxable_value'=>true,
        'tax_per' => true,
        'tax_amt' => true,
        'round_off' => true,
        'net_amt_total' => true,
        'purchase_voucher_id' => true,
        'raw_material' => true,
        'purchase_voucher' => true
    ];
}
