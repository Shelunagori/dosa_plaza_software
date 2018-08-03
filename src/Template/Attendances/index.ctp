<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Attendance/index/dosa_plaza_software'); ?>
<div class="row" style="margin-top:15px;sss">
	<div class="col-md-12 main-div">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Attendance
				</div>
				<div class="tools"> 
 				</div>
			</div>
			<div class="portlet-body">
 				<table class="table table-bordered" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No.') ?></th>
							<th scope="col"><?= ('Name') ?></th>
							<th scope="col">Attendance</th>
							<th scope="col">Attendance Date</th>
							<th scope="col">Remarks</th> 
						</tr>
					</thead>
					<tbody>
						<?php $i=0; foreach ($attendances as $attendance): ?>
						<?php $attendance_status=$attendance->attendance_status; 
							$viewAttendance='';
							if($attendance_status==1){
								$viewAttendance='Present';
							}
							if($attendance_status==2){
								$viewAttendance='Leave';
							}
							if($attendance_status==3){
								$viewAttendance='Half Day Leave';
							}
							if($attendance_status==4){
								$viewAttendance='Official Off';
							}
						?>
						<tr>
							<td><?= ++$i ?></td>
							<td><?= $attendance->employee->name ?></td>
							<td><?= $viewAttendance ?></td>
							<td><?= h(date('d-m-Y',strtotime($attendance->attendance_date))) ?></td>
							<td><?= $attendance->remarks ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
