<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExpanseVoucher Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property float $total_amount
 * @property int $voucher_no
 * @property string $narration
 *
 * @property \App\Model\Entity\ExpanseVoucherRow[] $expanse_voucher_rows
 */
class ExpanseVoucher extends Entity
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
        'transaction_date' => true,
        'total_amount' => true,
        'voucher_no' => true,
        'narration' => true,
        'expanse_voucher_rows' => true
    ];
}
