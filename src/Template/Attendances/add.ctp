<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Attendance'); ?>
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
								<input type="date" class="form-control" name="attendance_date" value="<?php echo $attendance_date; ?>"	required />
							</td>
							<td>
								<button type="submit" class="btn" >GO</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="portlet-body">
				<?php if($attendance_date){ ?>
				<form method="post">
					<table class="table table-bordered Attendance_list " cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th scope="col"><?= ('S.No.') ?></th>
								<th scope="col"><?= ('Name') ?></th>
								<th scope="col">
									Attendance 
									<span style=" font-size: 12px; color: #7b7a7a; float: right; "> 
										Mark All as
										<select class="MarkAll">
											<option value="0">None</option>
											<option value="1">Present</option>
											<option value="2">Half Day</option>
											<option value="3">Absent</option>
											<option value="4">Off</option>
										</select> 
									</span>
								</th>
								<th scope="col">Remarks</th> 
							</tr>
						</thead>
						<tbody>
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
											['value' => '4', 'text' => 'Off']
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
								<?php echo $this->Form->button('Submit',['class'=>'btn btn-danger']); ?> 
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
	<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END COMPONENTS DROPDOWNS -->	

<!-- BEGIN VALIDATEION -->
	<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END VALIDATEION --> 
<!-- END COMPONENTS DROPDOWNS -->
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
    });
";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>
	