<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemList $itemList
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Item Lists'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="itemLists form large-9 medium-8 columns content">
    <?= $this->Form->create($itemList) ?>
    <fieldset>
        <legend><?= __('Add Item List') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('unit');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
