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
			<form method="post">
				<table class="table table-bordered" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No.') ?></th>
							<th scope="col"><?= ('Name') ?></th>
							<th scope="col">Attendance</th>
							<th scope="col">Remarks</th> 
						</tr>
					</thead>
					<tbody>
						<?php $d=0; foreach ($employees as $vendor): ?>
						<tr>
							<td><?= (++$d) ?></td>
							<td><?= h($vendor->name) ?></td>
							<td>
								<input type="hidden" name="employee_id[]" value="<?php echo $vendor->id; ?>"/>
								<div class="form-group">
									<div class="radio-list">
										<label class="radio-inline">
										<input type="radio" name="attendance[<?php echo $vendor->id; ?>]" value="1" checked> Present </label>
										<label class="radio-inline">
										<input type="radio" name="attendance[<?php echo $vendor->id; ?>]" value="3"> Half Day </label>
										<label class="radio-inline">
										<input type="radio" name="attendance[<?php echo $vendor->id; ?>]" value="2" > Leave </label>
										<label class="radio-inline">
										<input type="radio" name="attendance[<?php echo $vendor->id; ?>]" value="4" > Off </label>
									</div>
								</div>
							</td>
							<td><input type="text" name="remarks[]" class="form-control input-small" Placeholder="Remarks" /></td> 
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div class="col-md-12"><hr></hr></div>
					<div class="form-actions">
						<div class="row">
						
							<div class="col-md-offset-6 col-md-9">
								<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary']); ?> 
							</div>
						</div>
					</div>
			</form>
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