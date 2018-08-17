<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OfferCode $offerCode
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $offerCode->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $offerCode->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Offer Codes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="offerCodes form large-9 medium-8 columns content">
    <?= $this->Form->create($offerCode) ?>
    <fieldset>
        <legend><?= __('Edit Offer Code') ?></legend>
        <?php
            echo $this->Form->control('offer_name');
            echo $this->Form->control('offer_code');
            echo $this->Form->control('is_enabled');
            echo $this->Form->control('discount_per');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
