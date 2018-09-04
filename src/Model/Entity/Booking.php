<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Booking Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $date
 * @property int $no_of_guests
 * @property string $customer_name
 * @property string $customer_mobile
 * @property string $description
 */
class Booking extends Entity
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
        'booking_date' => true,
        'no_of_guests' => true,
        'customer_name' => true,
        'customer_mobile' => true,
        'description' => true
    ];
}
