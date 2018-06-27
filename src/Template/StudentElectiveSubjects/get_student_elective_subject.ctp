<div style="overflow: auto;width:100%">
<div id="table-container">
<table class="table table-bordered table-hover table-condensed" id="main_tble">
	<thead style="color:white;background-color:#005B9E;">
		<tr>
			<th width="8%" class="actions">Student</th>
			<?php foreach($subjects as $subject){?>
			<th width="10%" style="text-align:center;"><?php echo $subject->name;?></th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($students as $student)
	{
	?>
		<tr>
			<td width="8%"><b><?php echo $student->student->name;?></b>
			<?php echo $this->Form->control('student_id',['type'=>'hidden','value'=>$student->student->id]); ?>
			</td>
			<?php foreach($subjectIds as $key => $subjectId){?>
			<td width="10%" style="text-align:center;">
				<div class="form-group">
					<?php echo $this->Form->checkbox('subject_id', ['onchange'=>'valueChanged()','hiddenField' => false,'value'=>$key,'class'=>'chk coupon_question',@$studentElectiveSubArr[@$student->student->id][@$subjectId]]); ?>
				</div>
			</td>
			<?php 
			} ?>
		</tr>
	<?php  } ?>
	</tbody>
</table>
<div id="bottom_anchor"></div>
</div>
</div>
<script>
	var rows = $('#main_tble tbody tr');
</script>
