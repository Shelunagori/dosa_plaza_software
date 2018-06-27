<?php
/**
 * @Author: PHP Poets IT Solutions Pvt. Ltd.
 */
$this->set('title', 'Student Master');
?>
<div class="col-md-2"></div>
<div class="col-md-8">
	<div class="portlet light ">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-bar-chart font-green-sharp hide"></i>
				<span class="caption-subject font-green-sharp bold ">Create Student</span>
			</div>
		</div>
		<div class="portlet-body">
			<?= $this->Form->create($student,['onsubmit'=>'return checkValidation()']) ?>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>Name <span class="required">*</span></label>
						<?php echo $this->Form->control('name',['class'=>'form-control input-sm','placeholder'=>'Name','label'=>false,'autofocus','required'=>'required']); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Father Name  <span class="required">*</span></label>
						<?php echo $this->Form->control('father_name',['class'=>'form-control input-sm','placeholder'=>'Father Name','label'=>false,'autofocus','required'=>'required']); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Mother Name  <span class="required">*</span></label>
						<?php echo $this->Form->control('mother_name',['class'=>'form-control input-sm','placeholder'=>'Mother Name','label'=>false,'autofocus','required'=>'required']); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Scholor Number <span class="required">*</span></label>
						<?php echo $this->Form->control('scholor_number',['class'=>'form-control input-sm','placeholder'=>'Scholor Number','label'=>false,'autofocus','required'=>'required']); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Roll Number <span class="required">*</span></label>
						<?php echo $this->Form->control('roll_number',['class'=>'form-control input-sm','placeholder'=>'Roll Number','label'=>false,'autofocus','required'=>'required']); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Class  <span class="required">*</span></label>
						<select class="form-control select2me input-sm" name="section_id">
						<?= h($this->Recursive->sectionOptions($sections,0)) ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>D-O-B<span class="required">*</span></label> 
						<?php echo $this->Form->control('dob',['type'=>'text','class'=>'form-control input-sm inline  date-picker','placeholder'=>'Date Of Birth','label'=>false,'autofocus','required'=>'required', 'autocomplete'=>'off']); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Address<span class="required">*</span></label>
						<?php echo $this->Form->textarea('address',['rows' => '2', 'cols' => '2','class'=>'form-control input-sm','placeholder'=>'Address','label'=>false,'autofocus','required'=>'required']); ?>
					</div>
				</div>	 
			</div>
			<?= $this->Form->button(__('Submit'),['class'=>'btn btn-success submit']) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div> 
<div class="col-md-2"></div>

<!-- BEGIN PAGE LEVEL STYLES -->
	<!-- BEGIN COMPONENTS PICKERS -->
	<?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<!-- END COMPONENTS PICKERS -->

	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
	<!-- BEGIN COMPONENTS PICKERS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/clockface/js/clockface.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END COMPONENTS PICKERS -->
	
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
	";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>