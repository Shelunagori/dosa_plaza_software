<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bill $bill
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Bills'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tables'), ['controller' => 'Tables', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Table'), ['controller' => 'Tables', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bill Rows'), ['controller' => 'BillRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bill Row'), ['controller' => 'BillRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bills form large-9 medium-8 columns content">
    <?= $this->Form->create($bill) ?>
    <fieldset>
        <legend><?= __('Add Bill') ?></legend>
        <?php
            echo $this->Form->control('voucher_no');
            echo $this->Form->control('table_id', ['options' => $tables]);
            echo $this->Form->control('kot_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
