<?php $this->set("title", 'Employee'); ?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet blue box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-book"></i>Attendance
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
		</div>
	</div>
</div>
