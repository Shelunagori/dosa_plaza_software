<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VendorItem $vendorItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vendorItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vendorItem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vendor Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vendorItems form large-9 medium-8 columns content">
    <?= $this->Form->create($vendorItem) ?>
    <fieldset>
        <legend><?= __('Edit Vendor Item') ?></legend>
        <?php
            echo $this->Form->control('vendor_id', ['options' => $vendors]);
            echo $this->Form->control('item_id', ['options' => $items]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
