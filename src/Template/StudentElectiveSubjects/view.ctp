<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentElectiveSubject $studentElectiveSubject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Student Elective Subject'), ['action' => 'edit', $studentElectiveSubject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student Elective Subject'), ['action' => 'delete', $studentElectiveSubject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentElectiveSubject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Student Elective Subjects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Elective Subject'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="studentElectiveSubjects view large-9 medium-8 columns content">
    <h3><?= h($studentElectiveSubject->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $studentElectiveSubject->has('student') ? $this->Html->link($studentElectiveSubject->student->name, ['controller' => 'Students', 'action' => 'view', $studentElectiveSubject->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $studentElectiveSubject->has('subject') ? $this->Html->link($studentElectiveSubject->subject->name, ['controller' => 'Subjects', 'action' => 'view', $studentElectiveSubject->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($studentElectiveSubject->id) ?></td>
        </tr>
    </table>
</div>
