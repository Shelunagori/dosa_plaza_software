<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseVoucherRow $purchaseVoucherRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Purchase Voucher Rows'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Vouchers'), ['controller' => 'PurchaseVouchers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Voucher'), ['controller' => 'PurchaseVouchers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseVoucherRows form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseVoucherRow) ?>
    <fieldset>
        <legend><?= __('Add Purchase Voucher Row') ?></legend>
        <?php
            echo $this->Form->control('raw_materials_id', ['options' => $rawMaterials]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('rate');
            echo $this->Form->control('discount_per');
            echo $this->Form->control('discount_amt');
            echo $this->Form->control('pnf_per');
            echo $this->Form->control('pnf_amount');
            echo $this->Form->control('tax_per');
            echo $this->Form->control('tax_amt');
            echo $this->Form->control('round_off');
            echo $this->Form->control('net_amt_total');
            echo $this->Form->control('purchase_voucher_id', ['options' => $purchaseVouchers]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
