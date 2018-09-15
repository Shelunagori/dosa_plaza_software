<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VegetableRecord $vegetableRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vegetable Record'), ['action' => 'edit', $vegetableRecord->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vegetable Record'), ['action' => 'delete', $vegetableRecord->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vegetableRecord->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vegetable Records'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vegetable Record'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vegetableRecords view large-9 medium-8 columns content">
    <h3><?= h($vegetableRecord->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vegetableRecord->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($vegetableRecord->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($vegetableRecord->transaction_date) ?></td>
        </tr>
    </table>
</div>
