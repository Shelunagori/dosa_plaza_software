<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpanseVoucher $expanseVoucher
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $expanseVoucher->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $expanseVoucher->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Expanse Vouchers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Expanse Voucher Rows'), ['controller' => 'ExpanseVoucherRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expanse Voucher Row'), ['controller' => 'ExpanseVoucherRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="expanseVouchers form large-9 medium-8 columns content">
    <?= $this->Form->create($expanseVoucher) ?>
    <fieldset>
        <legend><?= __('Edit Expanse Voucher') ?></legend>
        <?php
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('total_amount');
            echo $this->Form->control('voucher_no');
            echo $this->Form->control('narration');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
