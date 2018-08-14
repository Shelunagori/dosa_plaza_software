<?php $this->set("title", 'Dashboard | DOSA PLAZA'); ?>
<style type="text/css">
.top{
	margin-top: 5px;
}
</style>
<?php echo $this->Html->css('mystyle'); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light" style="border-radius: 0;">
				<div class="caption top-caption">
					<span style="color:#67686B;float:left;font-size:19px;padding-left:30px;padding-top: 7px;">Total Sales: </span>
					<h3 style="color:#ef5f3f;float:left;margin:0;padding-left:17px;font-weight: 400;font-size:19px;line-height:25px;padding-top:7px;">&#8377; <?php if($TotalSale>0){echo $TotalSale;} else {echo 0; }?></h3>
				</div>
			</div> 
		</div>
	</div>	
	<div class="row">
		<div class="col-md-3 top">
			<div class="light  smalldiv" style="border-radius: 5px">
				<table border="0" width="100%">
					<tr>
						<td width="20%">
							<div style="float:left; width:7%; background-image:url('<?php echo $this->Url->build(['controller' =>'/img/Dine.png']); ?>');background-size:100%;padding: 30px;"></div>
							<!-- <div style="float:left; width:7%; background-image:url(/dosa_plaza_software/img/Dine.png);background-size:100%;padding: 26px;"></div> -->
						</td>
						<td width="40%" style="padding-left: 8px;">
							<div style="float:left;color: #858789; padding:18px 0px;">
								<h6 style="font-size: 15px;font-weight: 200;color: #7E8082;"><?php echo $TotalOrdeDinner; ?></h6>
								<h6 style="font-size: 15px;font-weight: 200;color: #7E8082;">Dinner In</h6>
								<div class="w3-light-grey">
									<div class="w3-orange" style="height:2px;width:50%"></div>
								</div>
							</div>
						</td>
						<td width="40%">
							<div style="float:left; padding:0px;">
								<h5 style="font-size:18px;font-weight: 500;line-height: 56px;"> &#8377; <?php echo $TotalSaleDinner; ?></h5>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-md-3 top">
			<div class="light  smalldiv" style="border-radius: 5px">
				<table border="0" width="100%">
					<tr>
						<td width="20%">
							<div style="float:left; width:7%; background-image:url('<?php echo $this->Url->build(['controller' =>'/img/Take.png']); ?>');background-size:100%;padding: 30px;"></div>
						</td>
						<td width="40%" style="padding-left: 8px;">
							<div style="float:left;color: #858789; padding:18px 0px;">
								<h6 style="font-size: 15px;font-weight: 200;color: #7E8082;"><?php echo $TotalOrdeTakeAway;?></h6>
								<h6 style="font-size: 15px;font-weight: 200;color: #7E8082;">Take Away</h6>
								<div class="w3-light-grey">
									<div class="w3-orange" style="height:2px;width:50%"></div>
								</div>
							</div>
						</td>
						<td width="40%">
							<div style="float:left; padding:0px;">
								<h5 style="font-size:18px;font-weight: 500;line-height: 56px;"> &#8377; <?php echo $TotalSaleTakeAway;?></h5>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-md-3 top">
			<div class="light  smalldiv" style="border-radius: 5px">
				<table border="0" width="100%">
					<tr>
						<td width="20%">
							<div style="float:left; width:7%; background-image:url('<?php echo $this->Url->build(['controller' =>'/img/Delivery.png']); ?>');background-size:100%;padding: 30px;"></div>
						</td>
						<td width="40%" style="padding-left: 8px;">
							<div style="float:left;color: #858789; padding:18px 0px;">
								<h6 style="font-size: 15px;font-weight: 200;color: #7E8082;"><?php echo $TotalOrdeODelevery; ?></h6>
								<h6 style="font-size: 15px;font-weight: 200;color: #7E8082;">Delivery </h6>
								<div class="w3-light-grey">
									<div class="w3-orange" style="height:2px;width:50%"></div>
								</div>
							</div>
						</td>
						<td width="40%">
							<div style="float:left; padding:0px;">
								<h5 style="font-size:18px;font-weight: 500;line-height: 56px;"> &#8377; <?php echo $TotalSaleDelevery; ?></h5>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>


		<div class="col-md-3 top">
			<div class="dashboard-stat goToBrithday" style="height: 120px;; background-image: linear-gradient(to right, #ed693f, #f05c3f, #f24e41, #f43d45, #f52549);cursor: pointer;">
				<div class="visual">
					<i class="fa fa-birthday-cake" style=" color: #ffffff57; font-size: 80px; padding-top: 29px;color: #f2744e;"></i>
				</div>
				<div class="details" style="right: 50px;padding-right: 0px;">
					<div style="text-align:center;color:#FFF;font-size:14px;margin: 20px 0px;">
						<span style="font-size: 16px;"><?= h($upcommingBirthdayAnniversary) ?></span><br/>
						<span >Upcoming </span><br/>
						<span >Brithday & Anniversary</span>
					</div>
				</div>
			</div>
		</div>
		
	</div>


	<div class="row">
		<div class="col-md-6">
			<div class="portlet light" style="border-radius: 0;padding: 20px !important;">
				<table width="100%">
					<tr>
						<td width="20%"><h6 style="font-size: 15px;font-weight: 200;color: #7E8082;">Cash</h6></td>
						<td width="20%"><h6 style="font-size: 15px;font-weight: 200;color: #656363;font-weight: bold;">₹ <?php echo $CashSale; ?></h6></td>
						<td width="15%"></td>
						<td width="40%">
							<div style="width: 100%;background-color: #dedede;">
								<div style="width: <?php echo $CashPer; ?>%;background-color: #f0b11b;height: 10px;"></div>
							</div>
						</td>
						<td width="5%"><span style="font-size: 14px;font-weight: 200;color: #7E8082;margin-left: 10px;"> <?php echo $CashPer; ?>%</span></td>
					</tr>
					<tr>
						<td width="20%"><h6 style="font-size: 15px;font-weight: 200;color: #7E8082;">Card</h6></td>
						<td width="20%"><h6 style="font-size: 15px;font-weight: 200;color: #656363;font-weight: bold;">₹ <?php echo $CardSale; ?></h6></td>
						<td width="15%"></td>
						<td width="40%">
							<div style="width: 100%;background-color: #dedede;">
								<div style="width: <?php echo $CardPer; ?>%;background-color: #f98866;height: 10px;"></div>
							</div>
						</td>
						<td width="5%"><span style="font-size: 14px;font-weight: 200;color: #7E8082;margin-left: 10px;"> <?php echo $CardPer; ?>%</span></td>
					</tr>
					<tr>
						<td width="20%"><h6 style="font-size: 15px;font-weight: 200;color: #7E8082;">Paytm</h6></td>
						<td width="20%"><h6 style="font-size: 15px;font-weight: 200;color: #656363;font-weight: bold;">₹ <?php echo $PaytmSale; ?></h6></td>
						<td width="15%"></td>
						<td width="40%">
							<div style="width: 100%;background-color: #dedede;">
								<div style="width: <?php echo $PaytmPer; ?>%;background-color: #4f77b7;height: 10px;"></div>
							</div>
						</td>
						<td width="5%"><span style="font-size: 14px;font-weight: 200;color: #7E8082;margin-left: 10px;"> <?php echo $PaytmPer; ?>%</span></td>
					</tr>
				</table>
			</div> 
		</div>

		<div class="col-md-6">
			<div class="portlet light" style="border-radius: 0;padding: 20px !important;">
				<span>Today's off & absent employees</span><br/>
				<table class="table table-str ">
					<tr>
						<th>Sr</th>
						<th>Employee</th>
						<th>Attendance</th>
					</tr>
					<?php $sr=0; foreach ($Attendances as $Attendance) { ?>
						<tr>
							<td><?php echo ++$sr; ?></td>
							<td><?php echo $Attendance->employee->name; ?></td>
							<td>
								<?php echo ($Attendance->attendance_status==3) ? 'Absent' : 'off' ?>
							</td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>

	</div>	

	<?php
	$js="
	$(document).ready(function() {
		$('.goToBrithday').die().live('click',function(event){
			var url='".$this->Url->build(['controller'=>'Customers','action'=>'index'])."';
			var win = window.open(url, '_blank');
		});
	});	
	";

	echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
	?>