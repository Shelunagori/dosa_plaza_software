<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpanseVoucherRow $expanseVoucherRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Expanse Voucher Rows'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Expanse Vouchers'), ['controller' => 'ExpanseVouchers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expanse Voucher'), ['controller' => 'ExpanseVouchers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Expanse Heads'), ['controller' => 'ExpanseHeads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expanse Head'), ['controller' => 'ExpanseHeads', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="expanseVoucherRows form large-9 medium-8 columns content">
    <?= $this->Form->create($expanseVoucherRow) ?>
    <fieldset>
        <legend><?= __('Add Expanse Voucher Row') ?></legend>
        <?php
            echo $this->Form->control('expanse_voucher_id', ['options' => $expanseVouchers]);
            echo $this->Form->control('expanse_head_id', ['options' => $expanseHeads]);
            echo $this->Form->control('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
