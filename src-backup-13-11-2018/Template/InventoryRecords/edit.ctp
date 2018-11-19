<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryRecord $inventoryRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $inventoryRecord->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryRecord->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Inventory Records'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Item Lists'), ['controller' => 'ItemLists', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item List'), ['controller' => 'ItemLists', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="inventoryRecords form large-9 medium-8 columns content">
    <?= $this->Form->create($inventoryRecord) ?>
    <fieldset>
        <legend><?= __('Edit Inventory Record') ?></legend>
        <?php
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('item_list_id', ['options' => $itemLists]);
            echo $this->Form->control('projection');
            echo $this->Form->control('mall');
            echo $this->Form->control('road');
            echo $this->Form->control('closing_balance');
            echo $this->Form->control('requirement');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
