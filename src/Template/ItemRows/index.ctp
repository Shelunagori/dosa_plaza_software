<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemRow[]|\Cake\Collection\CollectionInterface $itemRows
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Row'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemRows index large-9 medium-8 columns content">
    <h3><?= __('Item Rows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('raw_material_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemRows as $itemRow): ?>
            <tr>
                <td><?= $this->Number->format($itemRow->id) ?></td>
                <td><?= $this->Number->format($itemRow->item_id) ?></td>
                <td><?= $itemRow->has('raw_material') ? $this->Html->link($itemRow->raw_material->name, ['controller' => 'RawMaterials', 'action' => 'view', $itemRow->raw_material->id]) : '' ?></td>
                <td><?= $this->Number->format($itemRow->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemRow->id)]) ?>
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
