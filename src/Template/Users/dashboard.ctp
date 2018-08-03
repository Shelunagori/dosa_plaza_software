
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
					<h3 style="color:red;float:left;margin:0;padding-left:17px;font-weight: 400;font-size:19px;line-height:25px;padding-top:7px;">&#8377; <?php if($TotalSale>0){echo $TotalSale;} else {echo 0; }?></h3>
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
							<div style="float:left; width:7%; background-image:url(/dosa_plaza_software/img/Dine.png);background-size:100%;padding: 26px;"></div>
						</td>
						<td width="40%" style="padding-left: 8px;">
							<div style="float:left;color: #858789; padding:18px 0px;">
								<h6 style="font-size: 15px;font-weight: 200;color: #7E8082;"><?php echo $TotalOrdeDinner; ?></h6>
								<h6 style="font-size: 15px;font-weight: 200;color: #7E8082;">Diner In</h6>
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
							<div style="float:left; width:7%; background-image:url(/dosa_plaza_software/img/Take.png);background-size:100%;padding: 26px;"></div>
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
							<div style="float:left; width:7%; background-image:url(/dosa_plaza_software/img/Delivery.png);background-size:100%;padding: 26px;"></div>
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
			<div class="dashboard-stat" style="height: 120px;; background-image: linear-gradient(to right, #ed693f, #f05c3f, #f24e41, #f43d45, #f52549);">
				<div class="visual">
					<i class="fa fa-birthday-cake" style=" color: #ffffff57; font-size: 80px; padding-top: 29px;color: #f2744e;"></i>
				</div>
				<div class="details">
					<div style="text-align:center;color:#FFF;font-size:16px;margin: 30px 70px;">
						<span>4</span><br/>
						<span >Upcoming </span><br/>
						<span >Brithday</span>
					</div>
				</div>
			</div>
		</div>
		
	</div>