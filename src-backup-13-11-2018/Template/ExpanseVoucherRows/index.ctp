<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpanseVoucherRow[]|\Cake\Collection\CollectionInterface $expanseVoucherRows
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Expanse Voucher Row'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expanse Vouchers'), ['controller' => 'ExpanseVouchers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expanse Voucher'), ['controller' => 'ExpanseVouchers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expanse Heads'), ['controller' => 'ExpanseHeads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expanse Head'), ['controller' => 'ExpanseHeads', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="expanseVoucherRows index large-9 medium-8 columns content">
    <h3><?= __('Expanse Voucher Rows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expanse_voucher_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expanse_head_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($expanseVoucherRows as $expanseVoucherRow): ?>
            <tr>
                <td><?= $this->Number->format($expanseVoucherRow->id) ?></td>
                <td><?= $expanseVoucherRow->has('expanse_voucher') ? $this->Html->link($expanseVoucherRow->expanse_voucher->id, ['controller' => 'ExpanseVouchers', 'action' => 'view', $expanseVoucherRow->expanse_voucher->id]) : '' ?></td>
                <td><?= $expanseVoucherRow->has('expanse_head') ? $this->Html->link($expanseVoucherRow->expanse_head->name, ['controller' => 'ExpanseHeads', 'action' => 'view', $expanseVoucherRow->expanse_head->id]) : '' ?></td>
                <td><?= $this->Number->format($expanseVoucherRow->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $expanseVoucherRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $expanseVoucherRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $expanseVoucherRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expanseVoucherRow->id)]) ?>
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
