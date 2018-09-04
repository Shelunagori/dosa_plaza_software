<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RawMaterialCategory $rawMaterialCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rawMaterialCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rawMaterialCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Raw Material Categories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="rawMaterialCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($rawMaterialCategory) ?>
    <fieldset>
        <legend><?= __('Edit Raw Material Category') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
