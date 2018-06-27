<div style="margin-bottom:10px;">
	<span class="label label-success">
	<?php
	$full_path='';
	foreach ($crumbs as $crumb) {
		$full_path.=$crumb->name . ' > ';
	}
	echo $full_path=substr_replace($full_path," ",-3);	
	?>
	</span>
	<span id="response" style="float:  right;"></span>
	
</div>

<?php
foreach($Exams as $Exam){
	echo '<div><span class="label label-sm label-warning">'.$Exam->name.'</span></div>';
	echo '<table class="table table-bordered">
			<tr>
				<th>Subjects</th>
				<th>Max. Marks</th>
				<th>Subject Teacher</th>
			</tr>';
	if(count($main_subjects)){
		foreach($main_subjects as $subject_id=>$subject_name)
		{	?>
			<tr>
				<td exam_id="<?php echo $Exam->id; ?>" subject_id="<?php echo $subject_id; ?>" section_id="<?php echo $section_id; ?>"><?php echo $subject_name;?></td>
				<td><input type="text" class="numberBox form-control input-sm PointBox"  value="<?php echo @$maxMarks[$Exam->id][$subject_id]; ?>" /></td>
				<td>
					<?php echo $this->Form->control('Employees_id',['class'=>'EmpBox form-control input-sm employee_id','label'=>false, 'options' => $Employees,'empty'=>'--Select--', 'value' => $SubjectId[$Exam->id][$subject_id] ]); ?>
				</td>
				
			</tr>
			<?php             
		}
	}	
	echo '</table>';
}
?>



