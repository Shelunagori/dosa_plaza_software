<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CopyBill Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property string $voucher_no
 * @property int $table_id
 * @property float $total
 * @property int $tax_id
 * @property float $round_off
 * @property float $grand_total
 * @property int $customer_id
 * @property \Cake\I18n\FrozenTime $created_on
 * @property string $order_type
 * @property int $delivery_no
 * @property int $take_away_no
 * @property \Cake\I18n\FrozenTime $occupied_time
 * @property string $status
 * @property int $no_of_pax
 * @property int $payment_status
 * @property string $payment_type
 * @property int $employee_id
 * @property int $offer_id
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\Table $table
 * @property \App\Model\Entity\Tax $tax
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Offer $offer
 */
class CopyBill extends Entity
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
        'voucher_no' => true,
        'table_id' => true,
        'total' => true,
        'tax_id' => true,
        'round_off' => true,
        'grand_total' => true,
        'customer_id' => true,
        'created_on' => true,
        'order_type' => true,
        'delivery_no' => true,
        'take_away_no' => true,
        'occupied_time' => true,
        'status' => true,
        'no_of_pax' => true,
        'payment_status' => true,
        'payment_type' => true,
        'employee_id' => true,
        'offer_id' => true,
        'is_deleted' => true,
        'table' => true,
        'tax' => true,
        'customer' => true,
        'employee' => true,
        'offer' => true
    ];
}
