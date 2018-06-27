<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmployeeMarksAccess $employeeMarksAccess
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $employeeMarksAccess->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $employeeMarksAccess->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Employee Marks Accesses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exams'), ['controller' => 'Exams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam'), ['controller' => 'Exams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employeeMarksAccesses form large-9 medium-8 columns content">
    <?= $this->Form->create($employeeMarksAccess) ?>
    <fieldset>
        <legend><?= __('Edit Employee Marks Access') ?></legend>
        <?php
            echo $this->Form->control('exam_id', ['options' => $exams]);
            echo $this->Form->control('subject_id', ['options' => $subjects]);
            echo $this->Form->control('employee_id', ['options' => $employees]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
