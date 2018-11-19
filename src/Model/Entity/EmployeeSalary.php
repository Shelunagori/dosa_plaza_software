<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmployeeSalary Entity
 *
 * @property int $id
 * @property float $amount
 * @property int $employee_id
 * @property \Cake\I18n\FrozenDate $effective_from
 *
 * @property \App\Model\Entity\Employee $employee
 */
class EmployeeSalary extends Entity
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
        'amount' => true,
        'employee_id' => true,
        'effective_from' => true,
        'employee' => true
    ];
}
