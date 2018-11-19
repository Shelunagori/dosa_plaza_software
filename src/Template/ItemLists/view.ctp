<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemList $itemList
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item List'), ['action' => 'edit', $itemList->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item List'), ['action' => 'delete', $itemList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemList->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Lists'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item List'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemLists view large-9 medium-8 columns content">
    <h3><?= h($itemList->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($itemList->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= h($itemList->unit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemList->id) ?></td>
        </tr>
    </table>
</div>
