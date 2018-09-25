<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VegetableRate $vegetableRate
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vegetableRate->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vegetableRate->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vegetable Rates'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vegetables'), ['controller' => 'Vegetables', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vegetable'), ['controller' => 'Vegetables', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vegetableRates form large-9 medium-8 columns content">
    <?= $this->Form->create($vegetableRate) ?>
    <fieldset>
        <legend><?= __('Edit Vegetable Rate') ?></legend>
        <?php
            echo $this->Form->control('vegetable_id', ['options' => $vegetables]);
            echo $this->Form->control('rate');
            echo $this->Form->control('month');
            echo $this->Form->control('year');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
