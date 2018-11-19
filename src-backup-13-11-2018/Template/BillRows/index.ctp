<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BillRow[]|\Cake\Collection\CollectionInterface $billRows
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bill Row'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bills'), ['controller' => 'Bills', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bill'), ['controller' => 'Bills', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="billRows index large-9 medium-8 columns content">
    <h3><?= __('Bill Rows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bill_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('discount_per') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($billRows as $billRow): ?>
            <tr>
                <td><?= $this->Number->format($billRow->id) ?></td>
                <td><?= $billRow->has('bill') ? $this->Html->link($billRow->bill->id, ['controller' => 'Bills', 'action' => 'view', $billRow->bill->id]) : '' ?></td>
                <td><?= $billRow->has('item') ? $this->Html->link($billRow->item->name, ['controller' => 'Items', 'action' => 'view', $billRow->item->id]) : '' ?></td>
                <td><?= $this->Number->format($billRow->quantity) ?></td>
                <td><?= $this->Number->format($billRow->rate) ?></td>
                <td><?= $this->Number->format($billRow->discount_per) ?></td>
                <td><?= $this->Number->format($billRow->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $billRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $billRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $billRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $billRow->id)]) ?>
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
