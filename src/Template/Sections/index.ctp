<?php
/**
 * @Author: PHP Poets IT Solutions Pvt. Ltd.
 */
$this->set('title', 'Class Master');
if(!empty($id)){
    @$updateId = @$id;
}
?>
<style>
.caption > i{
	margin: 2px 5px !important;
}
.caption{
	font-size: 14px !important;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="row">
					<div class="col-md-4">
						<div class="caption" style=" font-size: 16px; ">
							<i class="fa fa-cogs"></i>
							<span class="caption-subject font-green-sharp bold " >Class set-up</span>
						</div>
					</div>
					<div class="col-md-4"></div>
					<div class="col-md-4"></div>
				</div>
			</div>
			<div class="portlet-body">
				<?php
				if($id)
				{
					$panelClass='portlet box green-haze';
					$panelHeading='<i class="fa fa fa-edit"></i> Edit Class';
					$submitClass='btn btn-success submit';
					$submitLabel='Edit';
					$CreateButton=$this->Html->link('<i class="fa fa-plus-square"></i>', ['action' => 'index'],['escape'=>false,'class'=>'btn btn-sm btn-default easy-pie-chart-reload tooltips',  'data-original-title'=>'Create new class']);
				}
				else
				{
					$panelClass='portlet box blue-steel';
					$panelHeading='<i class="fa fa-plus-square"></i> Create Class';
					$submitClass='btn btn-primary submit';
					$submitLabel='Create';
					$CreateButton='';
				}
				?>
				<?= $this->Form->create($section,['onsubmit'=>'return checkValidation()']) ?>
				<div class="row">
					<div class="col-md-6">
						<div class="<?php echo $panelClass; ?>">
							<div class="portlet-title">
								<div class="caption">
									<?php echo $panelHeading; ?>
								</div>
								<div class="actions">
									<?php echo $CreateButton; ?>
								</div>
							</div>
							<div class="portlet-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Name <span class="required">*</span></label>
											<?php echo $this->Form->control('name',['class'=>'form-control input-sm','placeholder'=>'Name','label'=>false,'autofocus']); ?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Parent  <span class="required">*</span></label>
											<?php echo $this->Form->control('parent_id',['class'=>'form-control input-sm select2me','label'=>false, 'options' => $sectionList,'empty'=>'--Select--']); ?>
										</div>
									</div>
								</div>
								<?= $this->Form->button(__($submitLabel),['class'=>$submitClass]) ?>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<?= h($this->Recursive->Section($sectionLists)) ?>
					</div>
				</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</div>
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
		
	});	
	";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>