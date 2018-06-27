<?php
/**
 * @Author: PHP Poets IT Solutions Pvt. Ltd.
 */
?>
<div class="ForCenterMargin" style="margin-left:0%">
	<div class="row">
		<div class="col-md-7">
			<div class="portlet light ">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-bar-chart font-green-sharp hide"></i>
						<span class="caption-subject font-green-sharp bold "><?= __('Employee Marks Accesses') ?></span>										
					</div>				
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-4">
						 
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<?php echo $this->Form->control('parent_id',['class'=>'form-control input-sm select2me','label'=>false, 'options' =>'','empty'=>'--Select--']); ?>
							</div>
						</div>
						<div class="col-md-4">					
						
							<?= $this->Form->button(__('Go'),['class'=>'btn blue submit', 'style' => 'padding: 4px 10px;']) ?>
						</div>
					</div>						
					<div class="row">						 
						<div class="col-md-12">
							<div class="ForTitleOfClass" style="background: #ffab41; color: #fff; border:3px solid #c0853a; font-weight: bold; font-size: 16px; width: 40%; margin-left: 30%;"><center>1st Science</center></div>
							</br>
							<table class="table table-bordered table-hover table-condensed">
								<thead>
									<tr>
										<th scope="col" class="actions"><?= __('Sr') ?></th>
										<th scope="col"><?= $this->Paginator->sort('Subjects') ?></th>
										<th scope="col"><?= $this->Paginator->sort('Maximum Marks') ?></th>
										 
									</tr>
								</thead>
								<tbody> 
									<tr>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody> 								
							</table>							
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div>
</div>
<!-- BEGIN PAGE LEVEL STYLES --> 
	<!-- END COMPONENTS PICKERS -->

	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->	
<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<!-- BEGIN COMPONENTS PICKERS -->
	<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<!-- END COMPONENTS PICKERS -->

	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->script('/assets/global/scripts/metronic.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/layout/scripts/quick-sidebar.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/pages/scripts/components-dropdowns.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL SCRIPTS -->

<?php
	$js="
	$(document).ready(function() {	
		ComponentsPickers.init();
	});	
	function checkValidation()
	{
	        $('.submit').attr('disabled','disabled');
	        $('.submit').text('Submiting...');
    }
	$(document).on('blur', '.gst', function(e)
    { 
		var mdl=$(this).val();
		var numbers = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
		if(mdl.match(numbers))
		{
			
		}
		else
		{
			$(this).val('');
			return false;
		}
    });
	";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>
 <!----------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmployeeMarksAccess[]|\Cake\Collection\CollectionInterface $employeeMarksAccesses
 */
?>

<!---
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Employee Marks Access'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exams'), ['controller' => 'Exams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam'), ['controller' => 'Exams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employeeMarksAccesses index large-9 medium-8 columns content">
    <h3><?= __('Employee Marks Accesses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('exam_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('employee_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employeeMarksAccesses as $employeeMarksAccess): ?>
            <tr>
                <td><?= $this->Number->format($employeeMarksAccess->id) ?></td>
                <td><?= $employeeMarksAccess->has('exam') ? $this->Html->link($employeeMarksAccess->exam->name, ['controller' => 'Exams', 'action' => 'view', $employeeMarksAccess->exam->id]) : '' ?></td>
                <td><?= $employeeMarksAccess->has('subject') ? $this->Html->link($employeeMarksAccess->subject->name, ['controller' => 'Subjects', 'action' => 'view', $employeeMarksAccess->subject->id]) : '' ?></td>
                <td><?= $employeeMarksAccess->has('employee') ? $this->Html->link($employeeMarksAccess->employee->name, ['controller' => 'Employees', 'action' => 'view', $employeeMarksAccess->employee->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $employeeMarksAccess->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employeeMarksAccess->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employeeMarksAccess->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeMarksAccess->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
--->