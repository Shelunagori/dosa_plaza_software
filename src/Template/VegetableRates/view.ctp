<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VegetableRate $vegetableRate
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vegetable Rate'), ['action' => 'edit', $vegetableRate->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vegetable Rate'), ['action' => 'delete', $vegetableRate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vegetableRate->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vegetable Rates'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vegetable Rate'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vegetables'), ['controller' => 'Vegetables', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vegetable'), ['controller' => 'Vegetables', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vegetableRates view large-9 medium-8 columns content">
    <h3><?= h($vegetableRate->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vegetable') ?></th>
            <td><?= $vegetableRate->has('vegetable') ? $this->Html->link($vegetableRate->vegetable->name, ['controller' => 'Vegetables', 'action' => 'view', $vegetableRate->vegetable->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vegetableRate->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($vegetableRate->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Month') ?></th>
            <td><?= $this->Number->format($vegetableRate->month) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Year') ?></th>
            <td><?= $this->Number->format($vegetableRate->year) ?></td>
        </tr>
    </table>
</div>
