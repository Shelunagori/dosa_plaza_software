<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vegetable $vegetable
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vegetables'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vegetable Records'), ['controller' => 'VegetableRecords', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vegetable Record'), ['controller' => 'VegetableRecords', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vegetable Rates'), ['controller' => 'VegetableRates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vegetable Rate'), ['controller' => 'VegetableRates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vegetables form large-9 medium-8 columns content">
    <?= $this->Form->create($vegetable) ?>
    <fieldset>
        <legend><?= __('Add Vegetable') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('unit');
            echo $this->Form->control('rate');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
