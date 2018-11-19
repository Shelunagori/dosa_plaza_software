<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $name
 * @property string $mobile_no
 * @property string $email
 * @property string $address
 * @property \Cake\I18n\FrozenTime $created_on
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\Attendance[] $attendances
 */
class Employee extends Entity
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
        'mobile_no' => true,
        'email' => true,
        'address' => true,
        'created_on' => true,
        'is_deleted' => true,
        'attendances' => true
    ];
}
