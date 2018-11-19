<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RawMaterialCategory[]|\Cake\Collection\CollectionInterface $rawMaterialCategories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Raw Material Category'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rawMaterialCategories index large-9 medium-8 columns content">
    <h3><?= __('Raw Material Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rawMaterialCategories as $rawMaterialCategory): ?>
            <tr>
                <td><?= $this->Number->format($rawMaterialCategory->id) ?></td>
                <td><?= h($rawMaterialCategory->name) ?></td>
                <td><?= h($rawMaterialCategory->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rawMaterialCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rawMaterialCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rawMaterialCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rawMaterialCategory->id)]) ?>
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
