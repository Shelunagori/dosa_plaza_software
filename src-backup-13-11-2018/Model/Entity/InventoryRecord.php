<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InventoryRecord Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property int $item_list_id
 * @property float $projection
 * @property float $mall
 * @property float $road
 * @property float $closing_balance
 * @property float $requirement
 *
 * @property \App\Model\Entity\ItemList $item_list
 */
class InventoryRecord extends Entity
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
        'item_list_id' => true,
        'projection' => true,
        'mall' => true,
        'road' => true,
        'closing_balance' => true,
        'requirement' => true,
        'item_list' => true
    ];
}
