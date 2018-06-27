<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemCategory $itemCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Category'), ['action' => 'edit', $itemCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Category'), ['action' => 'delete', $itemCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Sub Categories'), ['controller' => 'ItemSubCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Sub Category'), ['controller' => 'ItemSubCategories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemCategories view large-9 medium-8 columns content">
    <h3><?= h($itemCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($itemCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($itemCategory->is_deleted) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Item Sub Categories') ?></h4>
        <?php if (!empty($itemCategory->item_sub_categories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Category Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($itemCategory->item_sub_categories as $itemSubCategories): ?>
            <tr>
                <td><?= h($itemSubCategories->id) ?></td>
                <td><?= h($itemSubCategories->item_category_id) ?></td>
                <td><?= h($itemSubCategories->name) ?></td>
                <td><?= h($itemSubCategories->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemSubCategories', 'action' => 'view', $itemSubCategories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemSubCategories', 'action' => 'edit', $itemSubCategories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemSubCategories', 'action' => 'delete', $itemSubCategories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemSubCategories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
