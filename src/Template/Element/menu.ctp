<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Dashboard</span>', '/Users/Dashboard',['escape' => false, 'class' => 'showLoader']).'</li>';
?>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Stock In Voucher</span>
	<span class="arrow"></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link('Create', '/PurchaseVouchers/add',['escape' => false, 'class' => 'showLoader']).'</li>';?>
		<?php echo '<li>'.$this->Html->link('List', '/PurchaseVouchers/index',['escape' => false, 'class' => 'showLoader']).'</li>';?>
 	</ul>
</li>
<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Stock Adjustment</span>', '/RawMaterials/stock_adjustment',['escape' => false, 'class' => 'showLoader']).'</li>';

echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Daily Attendance</span>', '/Attendances/add',['escape' => false, 'class' => 'showLoader']).'</li>';

echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Item Category</span>', '/ItemCategories/add',['escape' => false, 'class' => 'showLoader']).'</li>';

echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Item Sub-Category</span>', '/ItemSubCategories/add',['escape' => false, 'class' => 'showLoader']).'</li>';
?>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Items</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link('Create', '/Items/add',['escape' => false, 'class' => 'showLoader']).'</li>';?>
		<?php echo '<li>'.$this->Html->link('List', '/Items/index',['escape' => false, 'class' => 'showLoader']).'</li>';?>
 	</ul>
</li>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Raw Materials</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link('Create', '/RawMaterials/add',['escape' => false, 'class' => 'showLoader']).'</li>';?>
		<?php echo '<li>'.$this->Html->link('List', '/RawMaterials/index',['escape' => false, 'class' => 'showLoader']).'</li>';?>
 	</ul>
</li>
<?php
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Offer Codes</span>', '/OfferCodes/index',['escape' => false, 'class' => 'showLoader']).'</li>';
?>

<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Employees</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link('Create', '/Employees/add',['escape' => false, 'class' => 'showLoader']).'</li>';?>
		<?php echo '<li>'.$this->Html->link('List', '/Employees/index',['escape' => false, 'class' => 'showLoader']).'</li>';?>
 	</ul>
</li>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Vendors</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link('Create', '/Vendors/add',['escape' => false, 'class' => 'showLoader']).'</li>';?>
		<?php echo '<li>'.$this->Html->link('List', '/Vendors/index',['escape' => false, 'class' => 'showLoader']).'</li>';?>
 	</ul>
</li>

<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Customers</span>', '/Customers/index',['escape' => false, 'class' => 'showLoader']).'</li>';

echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Bills</span>', '/Bills/index',['escape' => false, 'class' => 'showLoader']).'</li>';
?>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Master & Setup</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Comments</span>', '/Comments/add',['escape' => false, 'class' => 'showLoader']).'</li>';
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Tables</span>', '/Tables/add',['escape' => false, 'class' => 'showLoader']).'</li>';
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Designations</span>', '/Designations/add',['escape' => false, 'class' => 'showLoader']).'</li>';

		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Tax</span>', '/Taxes/add',['escape' => false, 'class' => 'showLoader']).'</li>';
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Units</span>', '/Units/add',['escape' => false, 'class' => 'showLoader']).'</li>';
		?>
 	</ul>
</li>
<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Reports</span>', '/Users/Reports',['escape' => false, 'class' => 'showLoader']).'</li>';
?>
<!-- <li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Reports</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Sales Report</span>', '/Bills/salesReportSearch',['escape' => false, 'class' => 'showLoader']).'</li>';
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Daily Report</span>', '/RawMaterials/daily-report',['escape' => false, 'class' => 'showLoader']).'</li>';
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Consumption Report</span>', '/RawMaterials/consumption-report',['escape' => false, 'class' => 'showLoader']).'</li>';
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Current-Stock Report</span>', '/RawMaterials/current-stock',['escape' => false, 'class' => 'showLoader']).'</li>';
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Stock-Report</span>', '/RawMaterials/stock-report',['escape' => false, 'class' => 'showLoader']).'</li>';
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Monthly-Report</span>', '/RawMaterials/monthly-Report',['escape' => false, 'class' => 'showLoader']).'</li>';
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Attendance-Report</span>', '/Employees/EmployeesAttendance',['escape' => false, 'class' => 'showLoader']).'</li>';
		?>
 	</ul>
</li> -->

