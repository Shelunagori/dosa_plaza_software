<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Section $section
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sections'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Years'), ['controller' => 'Years', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Year'), ['controller' => 'Years', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parent Sections'), ['controller' => 'Sections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Section'), ['controller' => 'Sections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exams'), ['controller' => 'Exams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam'), ['controller' => 'Exams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sections form large-9 medium-8 columns content">
    <?= $this->Form->create($section) ?>
    <fieldset>
        <legend><?= __('Add Section') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('year_id', ['options' => $years]);
            echo $this->Form->control('parent_id', ['options' => $parentSections]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
