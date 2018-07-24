<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RawMaterial $rawMaterial
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rawMaterial->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rawMaterial->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Raw Materials'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="rawMaterials form large-9 medium-8 columns content">
    <?= $this->Form->create($rawMaterial) ?>
    <fieldset>
        <legend><?= __('Edit Raw Material') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
