<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VendorItem Entity
 *
 * @property int $id
 * @property int $vendor_id
 * @property int $item_id
 *
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\Item $item
 */
class VendorItem extends Entity
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
        'item_id' => true,
        'vendor' => true,
        'item' => true
    ];
}
