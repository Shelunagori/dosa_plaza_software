<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseVoucherRow $purchaseVoucherRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Voucher Row'), ['action' => 'edit', $purchaseVoucherRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Voucher Row'), ['action' => 'delete', $purchaseVoucherRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseVoucherRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Voucher Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Voucher Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Vouchers'), ['controller' => 'PurchaseVouchers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Voucher'), ['controller' => 'PurchaseVouchers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseVoucherRows view large-9 medium-8 columns content">
    <h3><?= h($purchaseVoucherRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Raw Material') ?></th>
            <td><?= $purchaseVoucherRow->has('raw_material') ? $this->Html->link($purchaseVoucherRow->raw_material->name, ['controller' => 'RawMaterials', 'action' => 'view', $purchaseVoucherRow->raw_material->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Purchase Voucher') ?></th>
            <td><?= $purchaseVoucherRow->has('purchase_voucher') ? $this->Html->link($purchaseVoucherRow->purchase_voucher->id, ['controller' => 'PurchaseVouchers', 'action' => 'view', $purchaseVoucherRow->purchase_voucher->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseVoucherRow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($purchaseVoucherRow->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($purchaseVoucherRow->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount Per') ?></th>
            <td><?= $this->Number->format($purchaseVoucherRow->discount_per) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount Amt') ?></th>
            <td><?= $this->Number->format($purchaseVoucherRow->discount_amt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pnf Per') ?></th>
            <td><?= $this->Number->format($purchaseVoucherRow->pnf_per) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pnf Amount') ?></th>
            <td><?= $this->Number->format($purchaseVoucherRow->pnf_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tax Per') ?></th>
            <td><?= $this->Number->format($purchaseVoucherRow->tax_per) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tax Amt') ?></th>
            <td><?= $this->Number->format($purchaseVoucherRow->tax_amt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Round Off') ?></th>
            <td><?= $this->Number->format($purchaseVoucherRow->round_off) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Net Amt Total') ?></th>
            <td><?= $this->Number->format($purchaseVoucherRow->net_amt_total) ?></td>
        </tr>
    </table>
</div>
