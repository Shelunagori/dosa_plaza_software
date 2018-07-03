<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bill[]|\Cake\Collection\CollectionInterface $bills
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bill'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tables'), ['controller' => 'Tables', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Table'), ['controller' => 'Tables', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bill Rows'), ['controller' => 'BillRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bill Row'), ['controller' => 'BillRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bills index large-9 medium-8 columns content">
    <h3><?= __('Bills') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('table_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('kot_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bills as $bill): ?>
            <tr>
                <td><?= $this->Number->format($bill->id) ?></td>
                <td><?= h($bill->voucher_no) ?></td>
                <td><?= $bill->has('table') ? $this->Html->link($bill->table->name, ['controller' => 'Tables', 'action' => 'view', $bill->table->id]) : '' ?></td>
                <td><?= $this->Number->format($bill->kot_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bill->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bill->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bill->id)]) ?>
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
