<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockLedger $stockLedger
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Stock Ledgers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockLedgers form large-9 medium-8 columns content">
    <?= $this->Form->create($stockLedger) ?>
    <fieldset>
        <legend><?= __('Add Stock Ledger') ?></legend>
        <?php
            echo $this->Form->control('raw_material_id', ['options' => $rawMaterials]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('rate');
            echo $this->Form->control('status');
            echo $this->Form->control('effected_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
