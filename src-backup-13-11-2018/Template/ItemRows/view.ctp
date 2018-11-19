<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemRow $itemRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Row'), ['action' => 'edit', $itemRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Row'), ['action' => 'delete', $itemRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemRows view large-9 medium-8 columns content">
    <h3><?= h($itemRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Raw Material') ?></th>
            <td><?= $itemRow->has('raw_material') ? $this->Html->link($itemRow->raw_material->name, ['controller' => 'RawMaterials', 'action' => 'view', $itemRow->raw_material->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemRow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Id') ?></th>
            <td><?= $this->Number->format($itemRow->item_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($itemRow->quantity) ?></td>
        </tr>
    </table>
</div>
