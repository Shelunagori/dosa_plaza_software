<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseVoucherRow[]|\Cake\Collection\CollectionInterface $purchaseVoucherRows
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Purchase Voucher Row'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Vouchers'), ['controller' => 'PurchaseVouchers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Voucher'), ['controller' => 'PurchaseVouchers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseVoucherRows index large-9 medium-8 columns content">
    <h3><?= __('Purchase Voucher Rows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('raw_materials_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('discount_per') ?></th>
                <th scope="col"><?= $this->Paginator->sort('discount_amt') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pnf_per') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pnf_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tax_per') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tax_amt') ?></th>
                <th scope="col"><?= $this->Paginator->sort('round_off') ?></th>
                <th scope="col"><?= $this->Paginator->sort('net_amt_total') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_voucher_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseVoucherRows as $purchaseVoucherRow): ?>
            <tr>
                <td><?= $this->Number->format($purchaseVoucherRow->id) ?></td>
                <td><?= $purchaseVoucherRow->has('raw_material') ? $this->Html->link($purchaseVoucherRow->raw_material->name, ['controller' => 'RawMaterials', 'action' => 'view', $purchaseVoucherRow->raw_material->id]) : '' ?></td>
                <td><?= $this->Number->format($purchaseVoucherRow->quantity) ?></td>
                <td><?= $this->Number->format($purchaseVoucherRow->rate) ?></td>
                <td><?= $this->Number->format($purchaseVoucherRow->discount_per) ?></td>
                <td><?= $this->Number->format($purchaseVoucherRow->discount_amt) ?></td>
                <td><?= $this->Number->format($purchaseVoucherRow->pnf_per) ?></td>
                <td><?= $this->Number->format($purchaseVoucherRow->pnf_amount) ?></td>
                <td><?= $this->Number->format($purchaseVoucherRow->tax_per) ?></td>
                <td><?= $this->Number->format($purchaseVoucherRow->tax_amt) ?></td>
                <td><?= $this->Number->format($purchaseVoucherRow->round_off) ?></td>
                <td><?= $this->Number->format($purchaseVoucherRow->net_amt_total) ?></td>
                <td><?= $purchaseVoucherRow->has('purchase_voucher') ? $this->Html->link($purchaseVoucherRow->purchase_voucher->id, ['controller' => 'PurchaseVouchers', 'action' => 'view', $purchaseVoucherRow->purchase_voucher->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseVoucherRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseVoucherRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseVoucherRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseVoucherRow->id)]) ?>
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
