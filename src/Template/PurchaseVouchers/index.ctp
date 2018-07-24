<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseVoucher[]|\Cake\Collection\CollectionInterface $purchaseVouchers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Purchase Voucher'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Voucher Rows'), ['controller' => 'PurchaseVoucherRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Voucher Row'), ['controller' => 'PurchaseVoucherRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseVouchers index large-9 medium-8 columns content">
    <h3><?= __('Purchase Vouchers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vandor_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_transaction') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grand_total') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseVouchers as $purchaseVoucher): ?>
            <tr>
                <td><?= $this->Number->format($purchaseVoucher->id) ?></td>
                <td><?= $this->Number->format($purchaseVoucher->voucher_no) ?></td>
                <td><?= h($purchaseVoucher->transaction_date) ?></td>
                <td><?= $this->Number->format($purchaseVoucher->vandor_id) ?></td>
                <td><?= $this->Number->format($purchaseVoucher->total_transaction) ?></td>
                <td><?= $this->Number->format($purchaseVoucher->grand_total) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseVoucher->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseVoucher->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseVoucher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseVoucher->id)]) ?>
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
