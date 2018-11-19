<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemRow $itemRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Item Rows'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemRows form large-9 medium-8 columns content">
    <?= $this->Form->create($itemRow) ?>
    <fieldset>
        <legend><?= __('Add Item Row') ?></legend>
        <?php
            echo $this->Form->control('item_id');
            echo $this->Form->control('raw_material_id', ['options' => $rawMaterials]);
            echo $this->Form->control('quantity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
