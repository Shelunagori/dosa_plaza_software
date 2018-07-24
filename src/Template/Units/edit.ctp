<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unit $unit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $unit->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $unit->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Units'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="units form large-9 medium-8 columns content">
    <?= $this->Form->create($unit) ?>
    <fieldset>
        <legend><?= __('Edit Unit') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
