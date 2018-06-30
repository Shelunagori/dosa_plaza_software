<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MasterOffer $masterOffer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Master Offer'), ['action' => 'edit', $masterOffer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Master Offer'), ['action' => 'delete', $masterOffer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $masterOffer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Master Offers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Master Offer'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="masterOffers view large-9 medium-8 columns content">
    <h3><?= h($masterOffer->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($masterOffer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= $this->Number->format($masterOffer->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Percentage') ?></th>
            <td><?= $this->Number->format($masterOffer->percentage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($masterOffer->is_deleted) ?></td>
        </tr>
    </table>
</div>
