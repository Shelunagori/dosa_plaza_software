<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserRight Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $page_id
 *
 * @property \App\Model\Entity\Page $page
 */
class UserRight extends Entity
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
        'user_id' => true,
        'page_id' => true,
        'page' => true
    ];
}
