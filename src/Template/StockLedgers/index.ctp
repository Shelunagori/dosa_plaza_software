<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockLedger[]|\Cake\Collection\CollectionInterface $stockLedgers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Stock Ledger'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockLedgers index large-9 medium-8 columns content">
    <h3><?= __('Stock Ledgers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('raw_material_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('effected_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stockLedgers as $stockLedger): ?>
            <tr>
                <td><?= $this->Number->format($stockLedger->id) ?></td>
                <td><?= $stockLedger->has('raw_material') ? $this->Html->link($stockLedger->raw_material->name, ['controller' => 'RawMaterials', 'action' => 'view', $stockLedger->raw_material->id]) : '' ?></td>
                <td><?= $this->Number->format($stockLedger->quantity) ?></td>
                <td><?= $this->Number->format($stockLedger->rate) ?></td>
                <td><?= h($stockLedger->status) ?></td>
                <td><?= h($stockLedger->effected_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $stockLedger->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stockLedger->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stockLedger->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockLedger->id)]) ?>
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
