<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VendorItem[]|\Cake\Collection\CollectionInterface $vendorItems
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vendor Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vendorItems index large-9 medium-8 columns content">
    <h3><?= __('Vendor Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendorItems as $vendorItem): ?>
            <tr>
                <td><?= $this->Number->format($vendorItem->id) ?></td>
                <td><?= $vendorItem->has('vendor') ? $this->Html->link($vendorItem->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $vendorItem->vendor->id]) : '' ?></td>
                <td><?= $vendorItem->has('item') ? $this->Html->link($vendorItem->item->name, ['controller' => 'Items', 'action' => 'view', $vendorItem->item->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vendorItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vendorItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vendorItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendorItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
