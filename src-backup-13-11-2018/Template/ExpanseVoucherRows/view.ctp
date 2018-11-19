<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpanseVoucherRow $expanseVoucherRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Expanse Voucher Row'), ['action' => 'edit', $expanseVoucherRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Expanse Voucher Row'), ['action' => 'delete', $expanseVoucherRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expanseVoucherRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Expanse Voucher Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expanse Voucher Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expanse Vouchers'), ['controller' => 'ExpanseVouchers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expanse Voucher'), ['controller' => 'ExpanseVouchers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expanse Heads'), ['controller' => 'ExpanseHeads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expanse Head'), ['controller' => 'ExpanseHeads', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="expanseVoucherRows view large-9 medium-8 columns content">
    <h3><?= h($expanseVoucherRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Expanse Voucher') ?></th>
            <td><?= $expanseVoucherRow->has('expanse_voucher') ? $this->Html->link($expanseVoucherRow->expanse_voucher->id, ['controller' => 'ExpanseVouchers', 'action' => 'view', $expanseVoucherRow->expanse_voucher->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expanse Head') ?></th>
            <td><?= $expanseVoucherRow->has('expanse_head') ? $this->Html->link($expanseVoucherRow->expanse_head->name, ['controller' => 'ExpanseHeads', 'action' => 'view', $expanseVoucherRow->expanse_head->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($expanseVoucherRow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($expanseVoucherRow->amount) ?></td>
        </tr>
    </table>
</div>
