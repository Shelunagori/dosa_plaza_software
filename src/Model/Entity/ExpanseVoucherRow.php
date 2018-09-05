<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExpanseVoucherRow Entity
 *
 * @property int $id
 * @property int $expanse_voucher_id
 * @property int $expanse_head_id
 * @property float $amount
 *
 * @property \App\Model\Entity\ExpanseVoucher $expanse_voucher
 * @property \App\Model\Entity\ExpanseHead $expanse_head
 */
class ExpanseVoucherRow extends Entity
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
        'expanse_voucher_id' => true,
        'expanse_head_id' => true,
        'amount' => true,
        'expanse_voucher' => true,
        'expanse_head' => true
    ];
}
