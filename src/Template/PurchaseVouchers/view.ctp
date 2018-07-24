<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseVoucher $purchaseVoucher
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Voucher'), ['action' => 'edit', $purchaseVoucher->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Voucher'), ['action' => 'delete', $purchaseVoucher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseVoucher->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Vouchers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Voucher'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Voucher Rows'), ['controller' => 'PurchaseVoucherRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Voucher Row'), ['controller' => 'PurchaseVoucherRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseVouchers view large-9 medium-8 columns content">
    <h3><?= h($purchaseVoucher->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseVoucher->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($purchaseVoucher->voucher_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vandor Id') ?></th>
            <td><?= $this->Number->format($purchaseVoucher->vandor_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Transaction') ?></th>
            <td><?= $this->Number->format($purchaseVoucher->total_transaction) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grand Total') ?></th>
            <td><?= $this->Number->format($purchaseVoucher->grand_total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($purchaseVoucher->transaction_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Purchase Voucher Rows') ?></h4>
        <?php if (!empty($purchaseVoucher->purchase_voucher_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Raw Materials Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Discount Per') ?></th>
                <th scope="col"><?= __('Discount Amt') ?></th>
                <th scope="col"><?= __('Pnf Per') ?></th>
                <th scope="col"><?= __('Pnf Amount') ?></th>
                <th scope="col"><?= __('Tax Per') ?></th>
                <th scope="col"><?= __('Tax Amt') ?></th>
                <th scope="col"><?= __('Round Off') ?></th>
                <th scope="col"><?= __('Net Amt Total') ?></th>
                <th scope="col"><?= __('Purchase Voucher Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($purchaseVoucher->purchase_voucher_rows as $purchaseVoucherRows): ?>
            <tr>
                <td><?= h($purchaseVoucherRows->id) ?></td>
                <td><?= h($purchaseVoucherRows->raw_materials_id) ?></td>
                <td><?= h($purchaseVoucherRows->quantity) ?></td>
                <td><?= h($purchaseVoucherRows->rate) ?></td>
                <td><?= h($purchaseVoucherRows->discount_per) ?></td>
                <td><?= h($purchaseVoucherRows->discount_amt) ?></td>
                <td><?= h($purchaseVoucherRows->pnf_per) ?></td>
                <td><?= h($purchaseVoucherRows->pnf_amount) ?></td>
                <td><?= h($purchaseVoucherRows->tax_per) ?></td>
                <td><?= h($purchaseVoucherRows->tax_amt) ?></td>
                <td><?= h($purchaseVoucherRows->round_off) ?></td>
                <td><?= h($purchaseVoucherRows->net_amt_total) ?></td>
                <td><?= h($purchaseVoucherRows->purchase_voucher_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PurchaseVoucherRows', 'action' => 'view', $purchaseVoucherRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PurchaseVoucherRows', 'action' => 'edit', $purchaseVoucherRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurchaseVoucherRows', 'action' => 'delete', $purchaseVoucherRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseVoucherRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
