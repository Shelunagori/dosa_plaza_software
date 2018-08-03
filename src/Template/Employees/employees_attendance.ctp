<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Employee/Attendance/dosa_plaza_software'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption"style="padding:13px; color: red;">
					Employees Attendance
				</div>
			</div>	
			<div align="center">
				<form method="GET">
					<table>
						<tr>
							<td>
								<input type="month"  name="" min="2018-03" value="2018-05" class="input-sm" />
								<span class="validity"></span>
							</td>
							<td>
								<button type="submit" class="btn" style="font-size: 10px;" >GO</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<br>
			<div class="portlet-body">
				<form method="post">
					<table class="table table-bordered Attendance_list " cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th scope="col"style="width:4%;"><?= ('S.No.') ?></th>
								<th scope="col"style="width:16%"><?= ('Employees Name') ?></th>
								<th scope="col"style="width:10%;"><?= ('Designation') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $d=0; foreach ($Employees as $Employee){ ?>
							<tr>
								<td><?= (++$d) ?></td>
								<td><?= h($Employee->name) ?></td>
								<td><?= h($Employee->designation->name) ?></td>
								<td>
								    
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
				
			</div>
		</div>
	</div>
</div>
		