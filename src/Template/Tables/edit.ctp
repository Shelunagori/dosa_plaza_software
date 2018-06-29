<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Table $table
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $table->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $table->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tables'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tables form large-9 medium-8 columns content">
    <?= $this->Form->create($table) ?>
    <fieldset>
        <legend><?= __('Edit Table') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
