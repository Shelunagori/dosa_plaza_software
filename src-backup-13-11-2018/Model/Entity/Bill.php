<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bill Entity
 *
 * @property int $id
 * @property string $voucher_no
 * @property int $table_id
 * @property int $kot_id
 *
 * @property \App\Model\Entity\Table $table
 * @property \App\Model\Entity\BillRow[] $bill_rows
 */
class Bill extends Entity
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
        'table_id' => true,
        'kot_id' => true,
        'table' => true,
        'bill_rows' => true
    ];
}
