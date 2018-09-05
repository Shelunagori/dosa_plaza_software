<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Employee-Attendance | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			 	
			<div align="center">
				<form method="GET">
					<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
						<tr>
							<td width="20%">
								<div class="caption"style="padding:13px; color: red;">
									Attendance-Report
								</div>
							</td>
							<td valign="button">
								<div align="center">
									<form method="GET">
										<table>
											<tr>
												<td>
													<input type="month" class="form-control" name="month" value="<?php echo $month; ?>" required />
												</td>
												<td>
													<button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;" >GO</button>
												</td>
											</tr>
										</table>
									</form>
								</div>
							</td>
							<td width="20%">
								<div class="actions" style="margin-right: 10px;">
									<input id="search3"  class="form-control" type="text" placeholder="Search" >
								</div>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<br>
			<?php if($month){ 
				$F_date=$month.'-01';
				$first_date=date('Y-m-d',strtotime($F_date));
				$last_date=date('Y-m-t',strtotime($F_date));

			?>
			<div class="portlet-body">
				<div class="table-scrollable">
					<table class="table table-bordered Attendance_list " cellpadding="0" cellspacing="0">
						<thead>
							<tr style="white-space: nowrap;">
								<th scope="col"style="width:4%;"><?= ('S.No.') ?></th>
								<th scope="col"style="width:16%"><?= ('Employees Name') ?></th>
								<th scope="col"style="width:10%;"><?= ('Designation') ?></th>
								<?php
									while (strtotime($first_date) <= strtotime($last_date)) {
									$show_date=date('d-M',strtotime($first_date));
									echo '<th scope="col"style="width:10%;">'.$show_date.'</th>';
									$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
									}
								?>
								<th>Total Present</th>
								<th>Total Half Day</th>
								<th>Total Absent</th>
								<th>Total off</th>
								<th>Total Full</th>
								<th>Total Leave</th>
								<th>Salary</th>
							</tr>
						</thead>
						<tbody id="main_tbody">
							<?php $d=0; foreach ($Employees as $employee){ 

								$first_date=date('Y-m-d',strtotime($F_date));
								$last_date=date('Y-m-t',strtotime($F_date));
							?>
							<tr class="main_tr" style="white-space: nowrap;">
								<td><?= (++$d) ?></td>
								<td><?= h($employee->name) ?></td>
								<td><?= h($employee->designation->name) ?></td>
								<?php
								$total_P=0;
								$total_HD=0;
								$total_AB=0;
								$total_O=0;
								$total_F=0;
								$total_Leave=0;
								while (strtotime($first_date) <= strtotime($last_date)) {
									$show_date=strtotime($first_date);
									$status = @$AttendancesArray[$employee->id][$show_date];
									$show_Lable='';
									if($status==1){
										$total_P++;
										$show_Lable='Present';
									}
									if($status==2){
										$total_AB++;
										$show_Lable='Absent';
									}
									if($status==3){
										$total_HD++;
										$show_Lable='Half Day';
									}
									if($status==4){
										$total_O++;
										$show_Lable='Off';
									}
									if($status==5){
										$total_F++;
										$show_Lable='Full';
									}
									echo '<td scope="col"style="width:10%;">'.$show_Lable.'</td>';
									$first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
								}
								?>
								<th><?= ($total_P) ?></th>
								<th><?= ($total_HD) ?></th>
								<th><?= ($total_AB) ?></th>
								<th><?= ($total_O) ?></th>
								<th><?= ($total_F) ?></th>
								<th><?= ($total_AB+($total_HD/2)) ?></th>
								<th>
									<?php 
									$salary = $employee->salary;
									$oneDaySalary = $salary/30;
									$amountToBeDeduct = ($total_AB+($total_HD/2)) * $oneDaySalary;

									$OneHourSalary = $oneDaySalary/10;
									if($employee->designation_id==2){
										$ExtraSalary = ($total_F*3) * $OneHourSalary;
									}
									else{
										$ExtraSalary = ($total_F*2) * $OneHourSalary;	
									}
									
									echo $ActualSalary = $salary - $amountToBeDeduct + $ExtraSalary;
									?>
								</th>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php
	$js="
	$(document).ready(function() {	
		var rows = $('#main_tbody tr.main_tr');
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
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>
		