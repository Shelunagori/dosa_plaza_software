<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vendor $vendor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vendor->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vendor->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendor Items'), ['controller' => 'VendorItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor Item'), ['controller' => 'VendorItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vendors form large-9 medium-8 columns content">
    <?= $this->Form->create($vendor) ?>
    <fieldset>
        <legend><?= __('Edit Vendor') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('contact_person');
            echo $this->Form->control('contact_number');
            echo $this->Form->control('address');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
