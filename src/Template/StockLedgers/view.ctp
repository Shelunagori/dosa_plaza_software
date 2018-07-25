<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockLedger $stockLedger
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Stock Ledger'), ['action' => 'edit', $stockLedger->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Stock Ledger'), ['action' => 'delete', $stockLedger->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockLedger->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stock Ledgers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Ledger'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stockLedgers view large-9 medium-8 columns content">
    <h3><?= h($stockLedger->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Raw Material') ?></th>
            <td><?= $stockLedger->has('raw_material') ? $this->Html->link($stockLedger->raw_material->name, ['controller' => 'RawMaterials', 'action' => 'view', $stockLedger->raw_material->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($stockLedger->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($stockLedger->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($stockLedger->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($stockLedger->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Effected On') ?></th>
            <td><?= h($stockLedger->effected_on) ?></td>
        </tr>
    </table>
</div>
