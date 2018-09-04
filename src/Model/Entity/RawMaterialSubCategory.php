<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RawMaterialSubCategory Entity
 *
 * @property int $id
 * @property int $raw_material_category_id
 * @property string $name
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\RawMaterialCategory $raw_material_category
 */
class RawMaterialSubCategory extends Entity
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
        'raw_material_category_id' => true,
        'name' => true,
        'is_deleted' => true,
        'raw_material_category' => true
    ];
}
