<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExpanseHead $expanseHead
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $expanseHead->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $expanseHead->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Expanse Heads'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Expanse Voucher Rows'), ['controller' => 'ExpanseVoucherRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Expanse Voucher Row'), ['controller' => 'ExpanseVoucherRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="expanseHeads form large-9 medium-8 columns content">
    <?= $this->Form->create($expanseHead) ?>
    <fieldset>
        <legend><?= __('Edit Expanse Head') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
