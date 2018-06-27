<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmployeeMarksAccess $employeeMarksAccess
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee Marks Access'), ['action' => 'edit', $employeeMarksAccess->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee Marks Access'), ['action' => 'delete', $employeeMarksAccess->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeMarksAccess->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employee Marks Accesses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee Marks Access'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exams'), ['controller' => 'Exams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam'), ['controller' => 'Exams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employeeMarksAccesses view large-9 medium-8 columns content">
    <h3><?= h($employeeMarksAccess->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Exam') ?></th>
            <td><?= $employeeMarksAccess->has('exam') ? $this->Html->link($employeeMarksAccess->exam->name, ['controller' => 'Exams', 'action' => 'view', $employeeMarksAccess->exam->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $employeeMarksAccess->has('subject') ? $this->Html->link($employeeMarksAccess->subject->name, ['controller' => 'Subjects', 'action' => 'view', $employeeMarksAccess->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $employeeMarksAccess->has('employee') ? $this->Html->link($employeeMarksAccess->employee->name, ['controller' => 'Employees', 'action' => 'view', $employeeMarksAccess->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($employeeMarksAccess->id) ?></td>
        </tr>
    </table>
</div>
