<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Kot $kot
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Kot'), ['action' => 'edit', $kot->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Kot'), ['action' => 'delete', $kot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kot->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Kots'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Kot'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tables'), ['controller' => 'Tables', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Table'), ['controller' => 'Tables', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Kot Rows'), ['controller' => 'KotRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Kot Row'), ['controller' => 'KotRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="kots view large-9 medium-8 columns content">
    <h3><?= h($kot->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Table') ?></th>
            <td><?= $kot->has('table') ? $this->Html->link($kot->table->name, ['controller' => 'Tables', 'action' => 'view', $kot->table->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($kot->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($kot->voucher_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($kot->created_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Kot Rows') ?></h4>
        <?php if (!empty($kot->kot_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Kot Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($kot->kot_rows as $kotRows): ?>
            <tr>
                <td><?= h($kotRows->id) ?></td>
                <td><?= h($kotRows->kot_id) ?></td>
                <td><?= h($kotRows->item_id) ?></td>
                <td><?= h($kotRows->quantity) ?></td>
                <td><?= h($kotRows->rate) ?></td>
                <td><?= h($kotRows->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'KotRows', 'action' => 'view', $kotRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'KotRows', 'action' => 'edit', $kotRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'KotRows', 'action' => 'delete', $kotRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kotRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
