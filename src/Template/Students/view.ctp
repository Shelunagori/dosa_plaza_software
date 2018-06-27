<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Infos'), ['controller' => 'StudentInfos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Info'), ['controller' => 'StudentInfos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="students view large-9 medium-8 columns content">
    <h3><?= h($student->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($student->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Father Name') ?></th>
            <td><?= h($student->father_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($student->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Student Infos') ?></h4>
        <?php if (!empty($student->student_infos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Class Id') ?></th>
                <th scope="col"><?= __('Year Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->student_infos as $studentInfos): ?>
            <tr>
                <td><?= h($studentInfos->id) ?></td>
                <td><?= h($studentInfos->student_id) ?></td>
                <td><?= h($studentInfos->class_id) ?></td>
                <td><?= h($studentInfos->year_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudentInfos', 'action' => 'view', $studentInfos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudentInfos', 'action' => 'edit', $studentInfos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudentInfos', 'action' => 'delete', $studentInfos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentInfos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
