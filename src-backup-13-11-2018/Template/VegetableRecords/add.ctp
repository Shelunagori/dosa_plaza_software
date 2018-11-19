<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VegetableRecord $vegetableRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vegetable Records'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="vegetableRecords form large-9 medium-8 columns content">
    <?= $this->Form->create($vegetableRecord) ?>
    <fieldset>
        <legend><?= __('Add Vegetable Record') ?></legend>
        <?php
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
