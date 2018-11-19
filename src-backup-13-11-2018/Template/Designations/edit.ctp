<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Designation $designation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $designation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $designation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Designations'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="designations form large-9 medium-8 columns content">
    <?= $this->Form->create($designation) ?>
    <fieldset>
        <legend><?= __('Edit Designation') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
