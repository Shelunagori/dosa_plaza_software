<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpanseVoucher[]|\Cake\Collection\CollectionInterface $expanseVouchers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Expanse Voucher'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expanse Voucher Rows'), ['controller' => 'ExpanseVoucherRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expanse Voucher Row'), ['controller' => 'ExpanseVoucherRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="expanseVouchers index large-9 medium-8 columns content">
    <h3><?= __('Expanse Vouchers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($expanseVouchers as $expanseVoucher): ?>
            <tr>
                <td><?= $this->Number->format($expanseVoucher->id) ?></td>
                <td><?= h($expanseVoucher->transaction_date) ?></td>
                <td><?= $this->Number->format($expanseVoucher->total_amount) ?></td>
                <td><?= $this->Number->format($expanseVoucher->voucher_no) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $expanseVoucher->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $expanseVoucher->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $expanseVoucher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expanseVoucher->id)]) ?>
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
