<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RawMaterialSubCategory $rawMaterialSubCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rawMaterialSubCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rawMaterialSubCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Raw Material Sub Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Raw Material Categories'), ['controller' => 'RawMaterialCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Raw Material Category'), ['controller' => 'RawMaterialCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rawMaterialSubCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($rawMaterialSubCategory) ?>
    <fieldset>
        <legend><?= __('Edit Raw Material Sub Category') ?></legend>
        <?php
            echo $this->Form->control('raw_material_category_id', ['options' => $rawMaterialCategories]);
            echo $this->Form->control('name');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
