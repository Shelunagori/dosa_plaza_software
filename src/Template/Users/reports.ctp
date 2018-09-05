<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Reports | DOSA PLAZA'); ?>
<!-- BEGIN PAGE CONTENT-->

<div class="row" style="margin-top:15px;">
	<div class="col-md-4">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					 Inventory Reports
				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body" style="min-height: 150px;">
				<ul style=" line-height: 23px; ">
					<?php
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Daily Report</span>', '/RawMaterials/daily-report',['escape' => false, 'class' => 'showLoader']).'</li>';
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Consumption Report</span>', '/RawMaterials/consumption-report',['escape' => false, 'class' => 'showLoader']).'</li>';
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Current-Stock Report</span>', '/RawMaterials/current-stock',['escape' => false, 'class' => 'showLoader']).'</li>';
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Stock-Report</span>', '/RawMaterials/stock-report',['escape' => false, 'class' => 'showLoader']).'</li>';
					
					?>
			 	</ul>
				
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					 Sales Reports
				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body"  style="min-height: 150px;">
				<ul style=" line-height: 23px; ">
					<?php
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Sales Report</span>', '/Bills/salesReportSearch',['escape' => false, 'class' => 'showLoader']).'</li>';
					
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Bill Wise Sales Report</span>', '/Bills/bill-Wise-Sales',['escape' => false, 'class' => 'showLoader']).'</li>';

					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Date Wise Sales Report</span>', '/Bills/Date-Wise-Sales',['escape' => false, 'class' => 'showLoader']).'</li>';

					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Group + Sub-Group Wise Sales Report</span>', '/ItemCategories/Group-Report',['escape' => false, 'class' => 'showLoader']).'</li>';
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Group + Item Wise Sales Report</span>', '/ItemCategories/Group-Item-Report',['escape' => false, 'class' => 'showLoader']).'</li>';
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Hourly Sales Report</span>', '/Bills/hourly-Report',['escape' => false, 'class' => 'showLoader']).'</li>';
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Steward Comparison Report</span>', '/Employees/comparison',['escape' => false, 'class' => 'showLoader']).'</li>';
					?>
			 	</ul>
				
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					 Attendance Reports
				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body"  style="min-height: 150px;">
				<ul style=" line-height: 23px; ">
					<?php
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Attendance-Report</span>', '/Employees/EmployeesAttendance',['escape' => false, 'class' => 'showLoader']).'</li>';
					?>
			 	</ul>
				
			</div>
		</div>
	</div>
</div>

<div class="row" >
	<div class="col-md-4">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Item Reports
				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body"  style="min-height: 150px;">
				<ul style=" line-height: 23px; ">
					<?php
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Food Costing Report</span>', '/Items/foodCostingReport',['escape' => false, 'class' => 'showLoader']).'</li>';
					?>
			 	</ul>
				
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
				KOT Reports
				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body"  style="min-height: 150px;">
				<ul style=" line-height: 23px; ">
					<?php
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">KOT Detail Report</span>', '/Kots/kotReport',['escape' => false, 'class' => 'showLoader']).'</li>';
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">KOT Delete Report</span>', '/Kots/deleteReport',['escape' => false, 'class' => 'showLoader']).'</li>';
					?>
			 	</ul>
				
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
				Summary Reports
				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body"  style="min-height: 150px;">
				<ul style=" line-height: 23px; ">
					<?php
					echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Monthly-Report</span>', '/RawMaterials/monthly-Report',['escape' => false, 'class' => 'showLoader']).'</li>';
					?>
			 	</ul>
				
			</div>
		</div>
	</div>
</div>