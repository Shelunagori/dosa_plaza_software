<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BillRow $billRow
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bill Row'), ['action' => 'edit', $billRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bill Row'), ['action' => 'delete', $billRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $billRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bill Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bill Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bills'), ['controller' => 'Bills', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bill'), ['controller' => 'Bills', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="billRows view large-9 medium-8 columns content">
    <h3><?= h($billRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Bill') ?></th>
            <td><?= $billRow->has('bill') ? $this->Html->link($billRow->bill->id, ['controller' => 'Bills', 'action' => 'view', $billRow->bill->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $billRow->has('item') ? $this->Html->link($billRow->item->name, ['controller' => 'Items', 'action' => 'view', $billRow->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($billRow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($billRow->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($billRow->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount Per') ?></th>
            <td><?= $this->Number->format($billRow->discount_per) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($billRow->amount) ?></td>
        </tr>
    </table>
</div>
