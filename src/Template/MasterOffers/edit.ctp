<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MasterOffer $masterOffer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $masterOffer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $masterOffer->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Master Offers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="masterOffers form large-9 medium-8 columns content">
    <?= $this->Form->create($masterOffer) ?>
    <fieldset>
        <legend><?= __('Edit Master Offer') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('percentage');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
