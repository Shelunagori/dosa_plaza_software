<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Kot[]|\Cake\Collection\CollectionInterface $kots
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Kot'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tables'), ['controller' => 'Tables', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Table'), ['controller' => 'Tables', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Kot Rows'), ['controller' => 'KotRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Kot Row'), ['controller' => 'KotRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="kots index large-9 medium-8 columns content">
    <h3><?= __('Kots') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('table_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kots as $kot): ?>
            <tr>
                <td><?= $this->Number->format($kot->id) ?></td>
                <td><?= $this->Number->format($kot->voucher_no) ?></td>
                <td><?= $kot->has('table') ? $this->Html->link($kot->table->name, ['controller' => 'Tables', 'action' => 'view', $kot->table->id]) : '' ?></td>
                <td><?= h($kot->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $kot->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $kot->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $kot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kot->id)]) ?>
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
