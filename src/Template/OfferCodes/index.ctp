<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OfferCode[]|\Cake\Collection\CollectionInterface $offerCodes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Offer Code'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="offerCodes index large-9 medium-8 columns content">
    <h3><?= __('Offer Codes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('offer_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('offer_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_enabled') ?></th>
                <th scope="col"><?= $this->Paginator->sort('discount_per') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offerCodes as $offerCode): ?>
            <tr>
                <td><?= $this->Number->format($offerCode->id) ?></td>
                <td><?= h($offerCode->offer_name) ?></td>
                <td><?= h($offerCode->offer_code) ?></td>
                <td><?= h($offerCode->is_enabled) ?></td>
                <td><?= $this->Number->format($offerCode->discount_per) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $offerCode->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $offerCode->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $offerCode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offerCode->id)]) ?>
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
