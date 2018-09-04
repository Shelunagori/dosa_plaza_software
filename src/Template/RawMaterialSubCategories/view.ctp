<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RawMaterialSubCategory $rawMaterialSubCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Raw Material Sub Category'), ['action' => 'edit', $rawMaterialSubCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Raw Material Sub Category'), ['action' => 'delete', $rawMaterialSubCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rawMaterialSubCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Raw Material Sub Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Raw Material Sub Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Raw Material Categories'), ['controller' => 'RawMaterialCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Raw Material Category'), ['controller' => 'RawMaterialCategories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rawMaterialSubCategories view large-9 medium-8 columns content">
    <h3><?= h($rawMaterialSubCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Raw Material Category') ?></th>
            <td><?= $rawMaterialSubCategory->has('raw_material_category') ? $this->Html->link($rawMaterialSubCategory->raw_material_category->name, ['controller' => 'RawMaterialCategories', 'action' => 'view', $rawMaterialSubCategory->raw_material_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($rawMaterialSubCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rawMaterialSubCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $rawMaterialSubCategory->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
