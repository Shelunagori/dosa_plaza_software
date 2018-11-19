<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OfferCode $offerCode
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Offer Code'), ['action' => 'edit', $offerCode->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Offer Code'), ['action' => 'delete', $offerCode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offerCode->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Offer Codes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Offer Code'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="offerCodes view large-9 medium-8 columns content">
    <h3><?= h($offerCode->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Offer Name') ?></th>
            <td><?= h($offerCode->offer_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Offer Code') ?></th>
            <td><?= h($offerCode->offer_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($offerCode->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount Per') ?></th>
            <td><?= $this->Number->format($offerCode->discount_per) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Enabled') ?></th>
            <td><?= $offerCode->is_enabled ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
