<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Table $table
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Table'), ['action' => 'edit', $table->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Table'), ['action' => 'delete', $table->id], ['confirm' => __('Are you sure you want to delete # {0}?', $table->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tables'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Table'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tables view large-9 medium-8 columns content">
    <h3><?= h($table->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($table->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($table->id) ?></td>
        </tr>
    </table>
</div>
