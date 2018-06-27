<div style="overflow: auto;width:100%">
<div id="table-container">
<table class="table table-bordered table-hover table-condensed" id="main_tble">
	<thead style="color:white;background-color:#005B9E;">
		<tr>
			<th width="8%" class="actions">Student</th>
			<?php foreach($main_subjects as $key => $subject){?>
			<th width="10%" style="text-align:center;"><?php echo $subject;?></th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($students as $student)
	{
	?>
		<tr>
			<td width="8%"><b><?php echo $student->name;?></b>
			<?php echo $this->Form->control('student_id',['type'=>'hidden','value'=>@$student->id,'class'=>'student_id']); ?>
			<?php echo $this->Form->control('exam_id',['type'=>'hidden','value'=>@$exam_id,'class'=>'exam_id']); ?>
			</td>
			<?php foreach($main_subjects as $key => $subject){?>
			<td width="10%" style="text-align:center;">
				<div class="form-group">
				<?php echo $this->Form->control('points',['class'=>'form-control input-sm marks','placeholder'=>'marks','label'=>false,'autofocus','required'=>'required','subject_id'=>$key,'value'=>@$marksArr[@$key][@$exam_id][$student->id]]); ?>	
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
