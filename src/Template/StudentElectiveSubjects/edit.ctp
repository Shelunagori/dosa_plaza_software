<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentElectiveSubject $studentElectiveSubject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $studentElectiveSubject->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $studentElectiveSubject->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Student Elective Subjects'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="studentElectiveSubjects form large-9 medium-8 columns content">
    <?= $this->Form->create($studentElectiveSubject) ?>
    <fieldset>
        <legend><?= __('Edit Student Elective Subject') ?></legend>
        <?php
            echo $this->Form->control('student_id', ['options' => $students]);
            echo $this->Form->control('subject_id', ['options' => $subjects]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
