<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vendor Entity
 *
 * @property int $id
 * @property string $name
 * @property string $contact_person
 * @property string $contact_number
 * @property string $address
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\VendorItem[] $vendor_items
 */
class Vendor extends Entity
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
        'name' => true,
        'contact_person' => true,
        'contact_number' => true,
        'address' => true,
        'is_deleted' => true,
        'gst_no' => true,
        'email' => true,
        'vendor_items' => true
    ];
}
