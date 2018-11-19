<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Kot $kot
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $kot->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $kot->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Kots'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tables'), ['controller' => 'Tables', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Table'), ['controller' => 'Tables', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Kot Rows'), ['controller' => 'KotRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Kot Row'), ['controller' => 'KotRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="kots form large-9 medium-8 columns content">
    <?= $this->Form->create($kot) ?>
    <fieldset>
        <legend><?= __('Edit Kot') ?></legend>
        <?php
            echo $this->Form->control('voucher_no');
            echo $this->Form->control('table_id', ['options' => $tables]);
            echo $this->Form->control('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
