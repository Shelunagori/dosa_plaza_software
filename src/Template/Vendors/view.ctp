<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vendor $vendor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vendor'), ['action' => 'edit', $vendor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vendor'), ['action' => 'delete', $vendor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendor->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vendors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendor Items'), ['controller' => 'VendorItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor Item'), ['controller' => 'VendorItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vendors view large-9 medium-8 columns content">
    <h3><?= h($vendor->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($vendor->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contact Person') ?></th>
            <td><?= h($vendor->contact_person) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contact Number') ?></th>
            <td><?= h($vendor->contact_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vendor->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $vendor->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Address') ?></h4>
        <?= $this->Text->autoParagraph(h($vendor->address)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Vendor Items') ?></h4>
        <?php if (!empty($vendor->vendor_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Vendor Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vendor->vendor_items as $vendorItems): ?>
            <tr>
                <td><?= h($vendorItems->id) ?></td>
                <td><?= h($vendorItems->vendor_id) ?></td>
                <td><?= h($vendorItems->item_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VendorItems', 'action' => 'view', $vendorItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VendorItems', 'action' => 'edit', $vendorItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VendorItems', 'action' => 'delete', $vendorItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendorItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
