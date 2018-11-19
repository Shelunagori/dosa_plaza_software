<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RawMaterialCategory $rawMaterialCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Raw Material Category'), ['action' => 'edit', $rawMaterialCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Raw Material Category'), ['action' => 'delete', $rawMaterialCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rawMaterialCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Raw Material Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Raw Material Category'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rawMaterialCategories view large-9 medium-8 columns content">
    <h3><?= h($rawMaterialCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($rawMaterialCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rawMaterialCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $rawMaterialCategory->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
