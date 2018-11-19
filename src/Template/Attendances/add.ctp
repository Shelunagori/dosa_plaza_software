<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Attendance | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Daily Attendance
				</div>
			</div>
			<br>
			<div align="center">
				<form method="GET">
					<table>
						<tr>
							<td>
								<?php
								if(@$attendance_date=="1970-01-01"){
									$PrintDate = "";
								}else{
									$PrintDate = date('d-m-Y', strtotime($attendance_date));
								}
								?>
								<input class="form-control date-picker" name="attendance_date" data-date-format="dd-mm-yyyy" value="<?php echo $PrintDate; ?>" placeholder="Date"	required="required" autocomplete="off" />
							</td>
							<td>
								<button type="submit" class="btn" >GO</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="portlet-body">
				<?php if($PrintDate){ ?>
				<input id="search3"  class="form-control input-small pull-right" type="text" placeholder="Search" >
				<form method="post">
					<table class="table table-bordered Attendance_list " cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th scope="col"><?= ('S.No.') ?></th>
								<th scope="col"><?= ('Name') ?></th>
								<th scope="col">
									Attendance 
									<span style="font-size: 12px; color: #7b7a7a; float: right; "> 
										Mark All as
										<select class="MarkAll">
											<option value="0">None</option>
											<option value="1">Present</option>
											<option value="2">Half Day</option>
											<option value="3">Absent</option>
											<option value="5">Full</option>
											<option value="4">Off</option>
										</select> 
									</span>
								</th>
								<th scope="col">Remarks</th> 
							</tr>
						</thead>
						<tbody id="main_tbody">
							<?php $d=0; foreach ($employees as $employee){ ?>
							
							<tr>
								<td><?= (++$d) ?></td>
								<td><?= h($employee->name) ?></td>
								<td>
									<input type="hidden" name="employee_ids[]" value="<?php echo $employee->id; ?>"/>
									<?php echo $this->Form->radio(
										'attendance['.$employee->id.']',
										[
											['value' => '1', 'text' => 'Present'],
											['value' => '2', 'text' => 'Half Day'],
											['value' => '3', 'text' => 'Absent'],
											['value' => '4', 'text' => 'Off'],
											['value' => '5', 'text' => 'Full']
										],
										['value' => @$employee->attendances[0]->attendance_status, 'class' => 'allCheckbox']
									); ?>
								</td>
								<td>
									<?php echo $this->Form->input('remarks['.$employee->id.']',['label' => false,'class'=>'form-control input-sm', 'Placeholder' => 'Remarks', 'value' => @$employee->attendances[0]->remarks]);?>
								</td> 
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<div class="col-md-12"><hr></hr></div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-6 col-md-9">
								<?php echo $this->Form->button('Submit',['class'=>'btn btn-danger showLoader']); ?> 
							</div>
						</div>
					</div>
				</form>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<!-- BEGIN PAGE LEVEL STYLES -->
    <!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->

 <!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/clockface/js/clockface.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/global/scripts/metronic.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/quick-sidebar.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END PAGE LEVEL SCRIPTS -->
<?php
$js="
    $(document).ready(function() {
    	$('.MarkAll').die().live('change',function(event){
    		var q=$(this).find('option:selected').val();
    		if(q==0){
    			$('input.allCheckbox').prop('checked',false);
				$.uniform.update();
			}else{
				$('input.allCheckbox[value='+q+']').prop('checked',true);
				$.uniform.update();
			}
    	});

    	var rows = $('#main_tbody tr');
	    $('#search3').on('keyup',function() {
	        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
	        var v = $(this).val();
	        
	        if(v){
	            rows.show().filter(function() {
	                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	    
	                return !~text.indexOf(val);
	            }).hide();
	        }else{
	            rows.show();
	        }
	    }); 
    });
";
$js.="
$(document).ready(function() {
    ComponentsPickers.init();
});
";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>
	