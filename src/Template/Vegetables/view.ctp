<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vegetable $vegetable
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vegetable'), ['action' => 'edit', $vegetable->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vegetable'), ['action' => 'delete', $vegetable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vegetable->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vegetables'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vegetable'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vegetable Records'), ['controller' => 'VegetableRecords', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vegetable Record'), ['controller' => 'VegetableRecords', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vegetable Rates'), ['controller' => 'VegetableRates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vegetable Rate'), ['controller' => 'VegetableRates', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vegetables view large-9 medium-8 columns content">
    <h3><?= h($vegetable->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($vegetable->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= h($vegetable->unit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vegetable->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($vegetable->rate) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Vegetable Records') ?></h4>
        <?php if (!empty($vegetable->vegetable_records)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Vegetable Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vegetable->vegetable_records as $vegetableRecords): ?>
            <tr>
                <td><?= h($vegetableRecords->id) ?></td>
                <td><?= h($vegetableRecords->vegetable_id) ?></td>
                <td><?= h($vegetableRecords->transaction_date) ?></td>
                <td><?= h($vegetableRecords->quantity) ?></td>
                <td><?= h($vegetableRecords->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VegetableRecords', 'action' => 'view', $vegetableRecords->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VegetableRecords', 'action' => 'edit', $vegetableRecords->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VegetableRecords', 'action' => 'delete', $vegetableRecords->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vegetableRecords->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Vegetable Rates') ?></h4>
        <?php if (!empty($vegetable->vegetable_rates)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Vegetable Id') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Month') ?></th>
                <th scope="col"><?= __('Year') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vegetable->vegetable_rates as $vegetableRates): ?>
            <tr>
                <td><?= h($vegetableRates->id) ?></td>
                <td><?= h($vegetableRates->vegetable_id) ?></td>
                <td><?= h($vegetableRates->rate) ?></td>
                <td><?= h($vegetableRates->month) ?></td>
                <td><?= h($vegetableRates->year) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VegetableRates', 'action' => 'view', $vegetableRates->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VegetableRates', 'action' => 'edit', $vegetableRates->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VegetableRates', 'action' => 'delete', $vegetableRates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vegetableRates->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
