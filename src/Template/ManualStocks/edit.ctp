<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ManualStock $manualStock
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $manualStock->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $manualStock->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Manual Stocks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="manualStocks form large-9 medium-8 columns content">
    <?= $this->Form->create($manualStock) ?>
    <fieldset>
        <legend><?= __('Edit Manual Stock') ?></legend>
        <?php
            echo $this->Form->control('raw_material_id', ['options' => $rawMaterials]);
            echo $this->Form->control('computer');
            echo $this->Form->control('physical');
            echo $this->Form->control('transaction_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
