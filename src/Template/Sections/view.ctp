<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Section $section
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Section'), ['action' => 'edit', $section->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Section'), ['action' => 'delete', $section->id], ['confirm' => __('Are you sure you want to delete # {0}?', $section->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sections'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Section'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Years'), ['controller' => 'Years', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Year'), ['controller' => 'Years', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Sections'), ['controller' => 'Sections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Section'), ['controller' => 'Sections', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exams'), ['controller' => 'Exams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam'), ['controller' => 'Exams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Child Sections'), ['controller' => 'Sections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child Section'), ['controller' => 'Sections', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sections view large-9 medium-8 columns content">
    <h3><?= h($section->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($section->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Year') ?></th>
            <td><?= $section->has('year') ? $this->Html->link($section->year->id, ['controller' => 'Years', 'action' => 'view', $section->year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Section') ?></th>
            <td><?= $section->has('parent_section') ? $this->Html->link($section->parent_section->name, ['controller' => 'Sections', 'action' => 'view', $section->parent_section->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($section->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lft') ?></th>
            <td><?= $this->Number->format($section->lft) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rght') ?></th>
            <td><?= $this->Number->format($section->rght) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Exams') ?></h4>
        <?php if (!empty($section->exams)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Section Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($section->exams as $exams): ?>
            <tr>
                <td><?= h($exams->id) ?></td>
                <td><?= h($exams->name) ?></td>
                <td><?= h($exams->section_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Exams', 'action' => 'view', $exams->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Exams', 'action' => 'edit', $exams->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Exams', 'action' => 'delete', $exams->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exams->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Sections') ?></h4>
        <?php if (!empty($section->child_sections)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Year Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($section->child_sections as $childSections): ?>
            <tr>
                <td><?= h($childSections->id) ?></td>
                <td><?= h($childSections->name) ?></td>
                <td><?= h($childSections->year_id) ?></td>
                <td><?= h($childSections->parent_id) ?></td>
                <td><?= h($childSections->lft) ?></td>
                <td><?= h($childSections->rght) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Sections', 'action' => 'view', $childSections->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Sections', 'action' => 'edit', $childSections->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sections', 'action' => 'delete', $childSections->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childSections->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Subjects') ?></h4>
        <?php if (!empty($section->subjects)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Section Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($section->subjects as $subjects): ?>
            <tr>
                <td><?= h($subjects->id) ?></td>
                <td><?= h($subjects->name) ?></td>
                <td><?= h($subjects->section_id) ?></td>
                <td><?= h($subjects->parent_id) ?></td>
                <td><?= h($subjects->lft) ?></td>
                <td><?= h($subjects->rght) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Subjects', 'action' => 'view', $subjects->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Subjects', 'action' => 'edit', $subjects->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subjects', 'action' => 'delete', $subjects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjects->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
