<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BillSetting $billSetting
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $billSetting->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $billSetting->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Bill Settings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="billSettings form large-9 medium-8 columns content">
    <?= $this->Form->create($billSetting) ?>
    <fieldset>
        <legend><?= __('Edit Bill Setting') ?></legend>
        <?php
            echo $this->Form->control('header');
            echo $this->Form->control('footer');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
