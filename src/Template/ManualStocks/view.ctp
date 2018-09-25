<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ManualStock $manualStock
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Manual Stock'), ['action' => 'edit', $manualStock->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Manual Stock'), ['action' => 'delete', $manualStock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $manualStock->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Manual Stocks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Manual Stock'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="manualStocks view large-9 medium-8 columns content">
    <h3><?= h($manualStock->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Raw Material') ?></th>
            <td><?= $manualStock->has('raw_material') ? $this->Html->link($manualStock->raw_material->name, ['controller' => 'RawMaterials', 'action' => 'view', $manualStock->raw_material->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($manualStock->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Computer') ?></th>
            <td><?= $this->Number->format($manualStock->computer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Physical') ?></th>
            <td><?= $this->Number->format($manualStock->physical) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($manualStock->transaction_date) ?></td>
        </tr>
    </table>
</div>
