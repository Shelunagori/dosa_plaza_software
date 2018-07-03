<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Attendance[]|\Cake\Collection\CollectionInterface $attendances
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Attendance'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="attendances index large-9 medium-8 columns content">
    <h3><?= __('Attendances') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('employee_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attendance_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attendance_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attendances as $attendance): ?>
            <tr>
                <td><?= $this->Number->format($attendance->id) ?></td>
                <td><?= $attendance->has('employee') ? $this->Html->link($attendance->employee->name, ['controller' => 'Employees', 'action' => 'view', $attendance->employee->id]) : '' ?></td>
                <td><?= $this->Number->format($attendance->attendance_status) ?></td>
                <td><?= h($attendance->attendance_date) ?></td>
                <td><?= h($attendance->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $attendance->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attendance->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attendance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendance->id)]) ?>
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
