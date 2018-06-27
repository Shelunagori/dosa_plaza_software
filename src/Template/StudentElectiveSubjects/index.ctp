<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentElectiveSubject[]|\Cake\Collection\CollectionInterface $studentElectiveSubjects
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Student Elective Subject'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="studentElectiveSubjects index large-9 medium-8 columns content">
    <h3><?= __('Student Elective Subjects') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($studentElectiveSubjects as $studentElectiveSubject): ?>
            <tr>
                <td><?= $this->Number->format($studentElectiveSubject->id) ?></td>
                <td><?= $studentElectiveSubject->has('student') ? $this->Html->link($studentElectiveSubject->student->name, ['controller' => 'Students', 'action' => 'view', $studentElectiveSubject->student->id]) : '' ?></td>
                <td><?= $studentElectiveSubject->has('subject') ? $this->Html->link($studentElectiveSubject->subject->name, ['controller' => 'Subjects', 'action' => 'view', $studentElectiveSubject->subject->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $studentElectiveSubject->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $studentElectiveSubject->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $studentElectiveSubject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentElectiveSubject->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
