<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OfferCode Entity
 *
 * @property int $id
 * @property string $offer_name
 * @property string $offer_code
 * @property bool $is_enabled
 * @property float $discount_per
 */
class OfferCode extends Entity
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
        'offer_name' => true,
        'offer_code' => true,
        'is_enabled' => true,
        'discount_per' => true
    ];
}
