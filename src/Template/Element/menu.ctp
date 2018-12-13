<?php 
if (in_array("1", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Dashboard</span>', '/Users/Dashboard',['escape' => false, 'class' => 'showLoader']).'</li>';
}
?>

<?php 
$target=array("6","7","8","43");
if(!empty(count(array_intersect($userPages, $target)))){
?>
	<li class="start">
		<a href="javascript:;">
		<span class="title" style="margin-left: 15px;">Configuration</span>
		<span class="arrow "></span>
		</a>
		<ul class="sub-menu">
			<?php
			if (in_array("6", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Item Category</span>', '/ItemCategories/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("7", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Item Sub-Category</span>', '/ItemSubCategories/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("8", $userPages)){
				echo '<li>'.$this->Html->link('<span class="title" style="margin-left: 15px;">Item Master</span>', '/Items/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("43", $userPages)){
				echo '<li>'.$this->Html->link('<span class="title" style="margin-left: 15px;">Bill Setting</span>', '/Bill-settings',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			?>
	 	</ul>
	</li>
<?php } ?>

<?php 
$target=array("21","22","24","25");
if(!empty(count(array_intersect($userPages, $target)))){
?>
	<li class="start">
		<a href="javascript:;">
		<span class="title" style="margin-left: 15px;">Setup</span>
		<span class="arrow "></span>
		</a>
		<ul class="sub-menu">
			<?php
			if (in_array("21", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Comments</span>', '/Comments/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("22", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Tables</span>', '/Tables/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("24", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Tax</span>', '/Taxes/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("25", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Units</span>', '/Units/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			?>
	 	</ul>
	</li>
<?php } ?>

<?php 
$target=array("29","18","10","11","12");
if(!empty(count(array_intersect($userPages, $target)))){
?>
	<li class="start">
		<a href="javascript:;">
		<span class="title" style="margin-left: 15px;">Stock</span>
		<span class="arrow "></span>
		</a>
		<ul class="sub-menu">
			<?php
			if (in_array("29", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Store</span>', '/RawMaterials/store',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("18", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Vendors</span>', '/Vendors',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("10", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">RM Category</span>', '/RawMaterialCategories/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("11", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">RM Sub-Category</span>', '/RawMaterialSubCategories/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("12", $userPages)){
				echo '<li>'.$this->Html->link('<span class="title" style="margin-left: 15px;">RM Master</span>', '/RawMaterials/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			?>
	 	</ul>
	</li>
<?php } ?>

<?php 
$target=array("5","16","28","23","49");
if(!empty(count(array_intersect($userPages, $target)))){
?>
	<li class="start">
		<a href="javascript:;">
		<span class="title" style="margin-left: 15px;">Employees</span>
		<span class="arrow "></span>
		</a>
		<ul class="sub-menu">
			<?php
			if (in_array("5", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Daily Attendance</span>', '/Attendances/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Attendance Sheet</span>', '/Attendances/view',['escape' => false, 'class' => 'showLoader']).'</li>';
			if (in_array("16", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Employee Master</span>', '/Employees/index',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("28", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Permissions</span>', '/UserRights',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("23", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Designations</span>', '/Designations/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("49", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Attendance-Report</span>', '/Employees/EmployeesAttendance',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			?>
	 	</ul>
	</li>
<?php } ?>

<?php
if (in_array("14", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Offer Codes</span>', '/OfferCodes/index',['escape' => false, 'class' => 'showLoader']).'</li>';
}
?>

<?php 
$target=array("20","19");
if(!empty(count(array_intersect($userPages, $target)))){
?>
	<li class="start">
		<a href="javascript:;">
		<span class="title" style="margin-left: 15px;">Billing</span>
		<span class="arrow "></span>
		</a>
		<ul class="sub-menu">
			<?php
			if (in_array("20", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Bill List</span>', '/Bills/index',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("19", $userPages)){ 
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Customer List</span>', '/Customers/index',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			?>
	 	</ul>
	</li>
<?php } ?>

<?php
if (in_array("26", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Reports</span>', '/Users/Reports',['escape' => false, 'class' => 'showLoader']).'</li>';
}
?>

<?php 
$target=array("34");
if(!empty(count(array_intersect($userPages, $target)))){
?>
	<li class="start">
		<a href="javascript:;">
		<span class="title" style="margin-left: 15px;">Daily Inventory</span>
		<span class="arrow "></span>
		</a>
		<ul class="sub-menu">
			<?php
			if (in_array("34", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Daily Inventory Entry</span>', '/InventoryRecords?date_from='.$PreviousDate,['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("35", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Daily Inventory Report</span>', '/InventoryRecords/report',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			?>
	 	</ul>
	</li>
<?php } ?>

<?php 
$target=array("36","37");
if(!empty(count(array_intersect($userPages, $target)))){
?>
	<li class="start">
		<a href="javascript:;">
		<span class="title" style="margin-left: 15px;">Vegetable</span>
		<span class="arrow "></span>
		</a>
		<ul class="sub-menu">
			<?php
			if (in_array("36", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Vegetable Records</span>', '/VegetableRecords',['escape' => false, 'class' => 'showLoader']).'</li>';
			}

			if (in_array("37", $userPages)){
				echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Vegetable Rates</span>', '/VegetableRates',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			?>
	 	</ul>
	</li>
<?php } ?>


<?php
if (in_array("38", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Daily Sales - Sub Group Wise</span>', '/ItemSubCategories/subGroupItemReportSearch',['escape' => false, 'class' => 'showLoader']).'</li>';
}

if (in_array("39", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Manual Stock of RM</span>', '/ManualStocks',['escape' => false, 'class' => 'showLoader']).'</li>';
}
?>

<?php 
$target=array("30","31","32","44");
if(!empty(count(array_intersect($userPages, $target)))){
?>
	<li class="start">
		<a href="javascript:;">
		<span class="title" style="margin-left: 15px;">Expanse</span>
		<span class="arrow "></span>
		</a>
		<ul class="sub-menu">
			<?php
			if (in_array("30", $userPages)){
				echo '<li>'.$this->Html->link('Create', '/ExpanseVouchers/add',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
		 
		 	if (in_array("31", $userPages)){
				echo '<li>'.$this->Html->link('List', '/ExpanseVouchers/index',['escape' => false, 'class' => 'showLoader']).'</li>';
			}

			if (in_array("32", $userPages)){
				echo '<li>'.$this->Html->link('Report', '/ExpanseVouchers/view',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			if (in_array("44", $userPages)){
				echo '<li>'.$this->Html->link('Expense Heads', '/ExpanseHeads',['escape' => false, 'class' => 'showLoader']).'</li>';
			}
			?>
	 	</ul>
	</li>
<?php } ?>
