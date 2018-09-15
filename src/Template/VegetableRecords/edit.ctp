<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VegetableRecord $vegetableRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vegetableRecord->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vegetableRecord->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vegetable Records'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="vegetableRecords form large-9 medium-8 columns content">
    <?= $this->Form->create($vegetableRecord) ?>
    <fieldset>
        <legend><?= __('Edit Vegetable Record') ?></legend>
        <?php
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
