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
				<span class="caption-subject font-green-sharp bold ">Student Attendance</span>
			</div>
		</div>
		<div class="portlet-body">
			<?= $this->Form->create($student,['onsubmit'=>'return checkValidation()']) ?>
			<div class="row">		
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<div class="form-group">
						<select class="form-control select2me input-sm" name="section_id">
						<option>----Select Class----</option>
						<?= h($this->Recursive->sectionOptions($sections,@$sectionId)) ?>
						</select>
					</div>
				</div>
				<div class="col-md-4"></div> 
				<?php if(@$sectionId){?>
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<td>Student Name</td>
											<td>Total Meeting</td>
											<td>Attendance Meeting</td>
										</tr>	
									</thead>
								 
									<?php foreach($studentNames as $studentName)
											{
									?>
									<tr>
										<td  student_id="<?php echo $studentName->id ;?>" section_id="<?php echo $sectionId; ?>"><?php echo $studentName->name; ?></td>
									<td><?php echo $this->Form->control('total_meetings',['id'=>'TotalMeeting','class'=>'form-control input-sm Attendence','placeholder'=>'Total Meeting','label'=>false,'autofocus','required'=>'required','value'=>@$totalMeetingArr[@$sectionId][@$studentName->id]]); ?>	
										</td>
										<td><?php echo $this->Form->control('meetings_attended',['id'=>'MeetingsAttended','class'=>'form-control input-sm Attendence ','placeholder'=>'Meetings Attended','label'=>false,'autofocus','required'=>'required', 'value'=>@$meetingsAttendedArr[@$sectionId][@$studentName->id]]); ?></td>
									</tr>		 
									 <?php } ?>
								</table>		
							</div>	 
						</div>
			<?php } ?>	
			</div>
			 
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
		
		$('select[name=section_id]').die().live('change',function(event){
			var section_id=$('select[name=section_id] option:selected').val();  
			window.location.href = window.location.pathname+'?'+$.param({'section-id':section_id});
		});
		 
	});	
	
	$(document).on('blur', '.Attendence', function(e)
    { 
		var student_id   = $(this).closest('tr').find('td:nth-child(1)').attr('student_id'); 
		var section_id   = $(this).closest('tr').find('td:nth-child(1)').attr('section_id'); 
		var TotalMeeting      = $(this).closest('tr').find('td:nth-child(2) input').val();
		var MeetingsAttended      = $(this).closest('tr').find('td:nth-child(3) input').val();
		if (student_id!='' && TotalMeeting!='' && MeetingsAttended!='') 
		{ 
			var url='".$this->Url->build(["controller" => "Students", "action" => "StudentAttendance"])."';
			url=url+'/'+student_id+'/'+section_id+'/'+TotalMeeting+'/'+MeetingsAttended;
			
			$.ajax({
				url: url,
				type: 'GET'
			}).done(function(response) { 
			//$('#response').html(response);
				
			}); 
		}
	});
	
	
	function checkValidation()
	{
	        $('.submit').attr('disabled','disabled');
	        $('.submit').text('Submiting...');
    }
	";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>	