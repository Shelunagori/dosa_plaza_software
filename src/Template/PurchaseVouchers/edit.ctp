<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseVoucher $purchaseVoucher
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $purchaseVoucher->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseVoucher->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Purchase Vouchers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Voucher Rows'), ['controller' => 'PurchaseVoucherRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Voucher Row'), ['controller' => 'PurchaseVoucherRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseVouchers form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseVoucher) ?>
    <fieldset>
        <legend><?= __('Edit Purchase Voucher') ?></legend>
        <?php
            echo $this->Form->control('voucher_no');
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('vandor_id');
            echo $this->Form->control('total_transaction');
            echo $this->Form->control('grand_total');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
