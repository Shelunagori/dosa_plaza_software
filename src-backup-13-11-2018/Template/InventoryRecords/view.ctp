<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryRecord $inventoryRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Inventory Record'), ['action' => 'edit', $inventoryRecord->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Inventory Record'), ['action' => 'delete', $inventoryRecord->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryRecord->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Inventory Records'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inventory Record'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Lists'), ['controller' => 'ItemLists', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item List'), ['controller' => 'ItemLists', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="inventoryRecords view large-9 medium-8 columns content">
    <h3><?= h($inventoryRecord->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item List') ?></th>
            <td><?= $inventoryRecord->has('item_list') ? $this->Html->link($inventoryRecord->item_list->name, ['controller' => 'ItemLists', 'action' => 'view', $inventoryRecord->item_list->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($inventoryRecord->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Projection') ?></th>
            <td><?= $this->Number->format($inventoryRecord->projection) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mall') ?></th>
            <td><?= $this->Number->format($inventoryRecord->mall) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Road') ?></th>
            <td><?= $this->Number->format($inventoryRecord->road) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Closing Balance') ?></th>
            <td><?= $this->Number->format($inventoryRecord->closing_balance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Requirement') ?></th>
            <td><?= $this->Number->format($inventoryRecord->requirement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($inventoryRecord->transaction_date) ?></td>
        </tr>
    </table>
</div>
