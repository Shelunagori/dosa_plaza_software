<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpanseHead $expanseHead
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Expanse Head'), ['action' => 'edit', $expanseHead->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Expanse Head'), ['action' => 'delete', $expanseHead->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expanseHead->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Expanse Heads'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expanse Head'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Expanse Voucher Rows'), ['controller' => 'ExpanseVoucherRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Expanse Voucher Row'), ['controller' => 'ExpanseVoucherRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="expanseHeads view large-9 medium-8 columns content">
    <h3><?= h($expanseHead->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($expanseHead->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($expanseHead->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Expanse Voucher Rows') ?></h4>
        <?php if (!empty($expanseHead->expanse_voucher_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Expanse Voucher Id') ?></th>
                <th scope="col"><?= __('Expanse Head Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($expanseHead->expanse_voucher_rows as $expanseVoucherRows): ?>
            <tr>
                <td><?= h($expanseVoucherRows->id) ?></td>
                <td><?= h($expanseVoucherRows->expanse_voucher_id) ?></td>
                <td><?= h($expanseVoucherRows->expanse_head_id) ?></td>
                <td><?= h($expanseVoucherRows->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ExpanseVoucherRows', 'action' => 'view', $expanseVoucherRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ExpanseVoucherRows', 'action' => 'edit', $expanseVoucherRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ExpanseVoucherRows', 'action' => 'delete', $expanseVoucherRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expanseVoucherRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
