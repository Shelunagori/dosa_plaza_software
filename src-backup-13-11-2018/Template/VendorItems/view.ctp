<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VendorItem $vendorItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vendor Item'), ['action' => 'edit', $vendorItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vendor Item'), ['action' => 'delete', $vendorItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendorItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vendor Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vendorItems view large-9 medium-8 columns content">
    <h3><?= h($vendorItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vendor') ?></th>
            <td><?= $vendorItem->has('vendor') ? $this->Html->link($vendorItem->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $vendorItem->vendor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $vendorItem->has('item') ? $this->Html->link($vendorItem->item->name, ['controller' => 'Items', 'action' => 'view', $vendorItem->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vendorItem->id) ?></td>
        </tr>
    </table>
</div>
