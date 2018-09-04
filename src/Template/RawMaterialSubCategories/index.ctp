<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RawMaterialSubCategory[]|\Cake\Collection\CollectionInterface $rawMaterialSubCategories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Raw Material Sub Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Raw Material Categories'), ['controller' => 'RawMaterialCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Raw Material Category'), ['controller' => 'RawMaterialCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rawMaterialSubCategories index large-9 medium-8 columns content">
    <h3><?= __('Raw Material Sub Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('raw_material_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rawMaterialSubCategories as $rawMaterialSubCategory): ?>
            <tr>
                <td><?= $this->Number->format($rawMaterialSubCategory->id) ?></td>
                <td><?= $rawMaterialSubCategory->has('raw_material_category') ? $this->Html->link($rawMaterialSubCategory->raw_material_category->name, ['controller' => 'RawMaterialCategories', 'action' => 'view', $rawMaterialSubCategory->raw_material_category->id]) : '' ?></td>
                <td><?= h($rawMaterialSubCategory->name) ?></td>
                <td><?= h($rawMaterialSubCategory->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rawMaterialSubCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rawMaterialSubCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rawMaterialSubCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rawMaterialSubCategory->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
