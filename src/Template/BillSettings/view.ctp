<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BillSetting $billSetting
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bill Setting'), ['action' => 'edit', $billSetting->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bill Setting'), ['action' => 'delete', $billSetting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $billSetting->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bill Settings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bill Setting'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="billSettings view large-9 medium-8 columns content">
    <h3><?= h($billSetting->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($billSetting->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Header') ?></h4>
        <?= $this->Text->autoParagraph(h($billSetting->header)); ?>
    </div>
    <div class="row">
        <h4><?= __('Footer') ?></h4>
        <?= $this->Text->autoParagraph(h($billSetting->footer)); ?>
    </div>
</div>
