<?php
/**
 * @Author: PHP Poets IT Solutions Pvt. Ltd.
 */
$this->set('title', 'Student List');
?>
<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bar-chart font-green-sharp hide"></i>
					<span class="caption-subject font-green-sharp bold ">Students</span>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-bordered table-hover table-condensed">
					<thead>
						<tr>
							<th scope="col" class="actions"><?= __('Sr') ?></th>
							<th scope="col"><?= $this->Paginator->sort('name') ?></th>
							<th scope="col"><?= $this->Paginator->sort('Father Name') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; foreach ($students as $student): ?>
						<tr>
							<td><?= h(++$i) ?></td>
							<td><?= h($student->name) ?></td>
							<td><?= h($student->father_name) ?></td>
							<td class="actions">
								<?php echo  $this->Html->link('<i class="fa fa-pencil-square-o"></i>', ['action' => 'index', $student->id],array('escape'=>false,'class'=>'btn btn-xs blue','title'=>'Edit')); ?> 
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>