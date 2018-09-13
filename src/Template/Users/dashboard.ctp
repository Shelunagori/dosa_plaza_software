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
					<span style="color:#67686B;float:left;font-size:19px;padding-left:30px;padding-top: 7px;">Today's Total Sales: </span>
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
								<h6 style="font-size: 15px;font-weight: 200;color: #7E8082;">Dine In</h6>
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

			<div class="portlet light" style="border-radius: 0;padding: 20px !important;">
				<div style=" font-size: 14px; font-weight: 600; margin-bottom: 5px;">Upcoming Bookings</div>

				<table width="100%">
					<tr>
						<?php 
						$url=$this->Url->build(['controller'=>'Bookings','action'=>'index']);
						foreach ($Bookings as $Booking) { ?>
							<td width="33%">
								<a href="<?php echo $url; ?>" style="text-decoration: none;">
									<div style="height: 100px; padding: 19px; width: 100px; margin: auto; border: solid 1px #cecece; border-radius: 55px; background-color: #d8d8d8; ">
										<div style=" border: solid 1px; height: 55px; background-color: #FFF; box-shadow: 3px 3px 3px 3px #a0a0a0; ">
											<div style="text-align:  center;background-color: #f24e41;color: #FFF;">
												<?php echo strtoupper( date('M', strtotime($Booking->booking_date)) ) ; ?>
											</div>
											<div style="font-size:  20px;font-weight: bold;text-align: center;margin-top: 2px;color: #2d4161;
											">
												<?php echo date('d', strtotime($Booking->booking_date)); ?>
											</div>
										</div>
									</div>
								</a>
							</td>
						<?php } ?>
					</tr>
				</table>
			</div>

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

		<div class="col-md-6">
			<div class="portlet light" style="border-radius: 0;padding: 5px !important;">
				
				<script src="https://code.highcharts.com/highcharts.js"></script>
				<script src="https://code.highcharts.com/modules/data.js"></script>
				<script src="https://code.highcharts.com/modules/exporting.js"></script>
				<script src="https://code.highcharts.com/modules/export-data.js"></script>

				<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

				<?php
				$CurrentMonth = date('m');
		        $PreviousMonth = $CurrentMonth-1;
		        $NextMonth = $CurrentMonth+1;

		        $CurrentYear = date('Y');
		        $PreviousYear = $CurrentYear-1;
				?>
				<table id="datatable" style="display: none;">
				  <thead>
				    <tr>
				      <th></th>
				      <th><?php echo $PreviousYear; ?></th>
				      <th><?php echo $CurrentYear; ?></th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th><?php echo date("F", strtotime('2018-'.$PreviousMonth.'-1')); ?></th>
				      <td><?php echo $LastYearPreviousMonthSale; ?></td>
				      <td><?php echo $CurrentYearLastMonthSale; ?></td>
				    </tr>
				    <tr>
				      <th><?php echo date("F", strtotime('2018-'.$CurrentMonth.'-1')); ?></th>
				      <td><?php echo $LastYearCurrentMonthSale; ?></td>
				      <td><?php echo $CurrentYearCurrentMonthSale; ?></td>
				    </tr>
				    <tr>
				      <th><?php echo date("F", strtotime('2018-'.$NextMonth.'-1')); ?></th>
				      <td><?php echo $LastYearFutureMonthSale; ?></td>
				      <td>0</td>
				    </tr>
				  </tbody>
				</table>

				<style type="text/css">
					.highcharts-button-symbol{
						display: none;
					}
					.highcharts-credits{
						display: none;
					}
				</style>
				<script type="text/javascript">
					Highcharts.chart('container', {
					  data: {
					    table: 'datatable'
					  },
					  chart: {
					    type: 'column'
					  },
					  title: {
					    text: 'Sales Comparison'
					  },
					  yAxis: {
					    allowDecimals: false,
					    title: {
					      text: 'Sales'
					    }
					  },
					  tooltip: {
					    formatter: function () {
					      return '<b>' + this.series.name + '</b><br/>' +
					        this.point.y + ' ' + this.point.name.toLowerCase();
					    }
					  }
					});
				</script>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			
		</div>
	</div>	

	<?php
	$js="
	$(document).ready(function() {
		$('.goToBrithday').die().live('click',function(event){
			var url='".$this->Url->build(['controller'=>'Customers','action'=>'birthdayList'])."';
			var win = window.open(url, '_blank');
		});
	});	
	";

	echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
	?>