<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tax $tax
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tax'), ['action' => 'edit', $tax->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tax'), ['action' => 'delete', $tax->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tax->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Taxes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tax'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['controller' => 'RawMaterials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Raw Material'), ['controller' => 'RawMaterials', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="taxes view large-9 medium-8 columns content">
    <h3><?= h($tax->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($tax->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($tax->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tax->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tax Per') ?></th>
            <td><?= $this->Number->format($tax->tax_per) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Raw Materials') ?></h4>
        <?php if (!empty($tax->raw_materials)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Tax Id') ?></th>
                <th scope="col"><?= __('Primary Unit Id') ?></th>
                <th scope="col"><?= __('Has Secondary Unit') ?></th>
                <th scope="col"><?= __('Secondary Unit Id') ?></th>
                <th scope="col"><?= __('Formula') ?></th>
                <th scope="col"><?= __('Purchase Voucher Unit Type') ?></th>
                <th scope="col"><?= __('Recipe Unit Type') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tax->raw_materials as $rawMaterials): ?>
            <tr>
                <td><?= h($rawMaterials->id) ?></td>
                <td><?= h($rawMaterials->name) ?></td>
                <td><?= h($rawMaterials->tax_id) ?></td>
                <td><?= h($rawMaterials->primary_unit_id) ?></td>
                <td><?= h($rawMaterials->has_secondary_unit) ?></td>
                <td><?= h($rawMaterials->secondary_unit_id) ?></td>
                <td><?= h($rawMaterials->formula) ?></td>
                <td><?= h($rawMaterials->purchase_voucher_unit_type) ?></td>
                <td><?= h($rawMaterials->recipe_unit_type) ?></td>
                <td><?= h($rawMaterials->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RawMaterials', 'action' => 'view', $rawMaterials->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RawMaterials', 'action' => 'edit', $rawMaterials->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RawMaterials', 'action' => 'delete', $rawMaterials->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rawMaterials->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
