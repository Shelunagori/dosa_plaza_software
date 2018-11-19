<?php 
	if (in_array("1", $userPages)){
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Dashboard</span>', '/Users/Dashboard',['escape' => false, 'class' => 'showLoader']).'</li>';
	}

	if (in_array("29", $userPages)){
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Store</span>', '/RawMaterials/store',['escape' => false, 'class' => 'showLoader']).'</li>';
	}
?>

<?php if (in_array("18", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Vendors</span>', '/Vendors',['escape' => false, 'class' => 'showLoader']).'</li>';
} ?>


<?php 

if (in_array("5", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Daily Attendance</span>', '/Attendances/add',['escape' => false, 'class' => 'showLoader']).'</li>';
}
if (in_array("6", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Item Category</span>', '/ItemCategories/add',['escape' => false, 'class' => 'showLoader']).'</li>';
}
if (in_array("7", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Item Sub-Category</span>', '/ItemSubCategories/add',['escape' => false, 'class' => 'showLoader']).'</li>';
}
?>
<?php 
$target=array("9","8");
if(!empty(count(array_intersect($userPages, $target)))){
	
		if (in_array("9", $userPages)){
			echo '<li>'.$this->Html->link('<span class="title" style="margin-left: 15px;">Items</span>', '/Items/index',['escape' => false, 'class' => 'showLoader']).'</li>';
		}
	}
if (in_array("10", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Raw Material Category</span>', '/RawMaterialCategories/add',['escape' => false, 'class' => 'showLoader']).'</li>';
}
if (in_array("11", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Raw Material Sub-Category</span>', '/RawMaterialSubCategories/add',['escape' => false, 'class' => 'showLoader']).'</li>';
}
?>
<?php 
$target=array("12","13");
if(!empty(count(array_intersect($userPages, $target)))){
	if (in_array("13", $userPages)){
		echo '<li>'.$this->Html->link('<span class="title" style="margin-left: 15px;">Raw Materials</span>', '/RawMaterials/index',['escape' => false, 'class' => 'showLoader']).'</li>';
	}	
?>

<?php
}
if (in_array("14", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Offer Codes</span>', '/OfferCodes/index',['escape' => false, 'class' => 'showLoader']).'</li>';
}
?>



<?php 
if (in_array("42", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Bookings</span>', '/Bookings/index',['escape' => false, 'class' => 'showLoader']).'</li>';
}
?>

<?php 
if (in_array("16", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Employees</span>', '/Employees/index',['escape' => false, 'class' => 'showLoader']).'</li>';
}
?>



<?php 
if (in_array("19", $userPages)){ 
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Customers</span>', '/Customers/index',['escape' => false, 'class' => 'showLoader']).'</li>';
}
if (in_array("20", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Bills</span>', '/Bills/index',['escape' => false, 'class' => 'showLoader']).'</li>';
}
?>
<?php 
$target=array("21","22","23","24","25");
if(!empty(count(array_intersect($userPages, $target)))){?>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Master & Setup</span>
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
		if (in_array("23", $userPages)){
			echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Designations</span>', '/Designations/add',['escape' => false, 'class' => 'showLoader']).'</li>';
		}
		if (in_array("24", $userPages)){
			echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Tax</span>', '/Taxes/add',['escape' => false, 'class' => 'showLoader']).'</li>';
		}
		if (in_array("25", $userPages)){
			echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Units</span>', '/Units/add',['escape' => false, 'class' => 'showLoader']).'</li>';
		}
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Expense Heads</span>', '/ExpanseHeads',['escape' => false, 'class' => 'showLoader']).'</li>';
		?>
 	</ul>
</li>
<?php
}
?>

<?php if( (in_array("30", $userPages)) or (in_array("31", $userPages)) or (in_array("32", $userPages))){ ?>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Expense Voucher</span>
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
		 ?>
 	</ul>
</li>
<?php } ?>

<?php
if (in_array("33", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Users</span>', '/Users',['escape' => false, 'class' => 'showLoader']).'</li>';
}


if (in_array("28", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">User Rights</span>', '/UserRights/add',['escape' => false, 'class' => 'showLoader']).'</li>';
}
if (in_array("26", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Reports</span>', '/Users/Reports',['escape' => false, 'class' => 'showLoader']).'</li>';
}

$PreviousDate = date('d-m-Y', strtotime('-7 days'));
if (in_array("34", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Manual Daily Inventory</span>', '/InventoryRecords?date_from='.$PreviousDate,['escape' => false, 'class' => 'showLoader']).'</li>';
}

if (in_array("35", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Manual Daily Inventory-Report</span>', '/InventoryRecords/report',['escape' => false, 'class' => 'showLoader']).'</li>';
}

if (in_array("36", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Vegetable Records</span>', '/VegetableRecords',['escape' => false, 'class' => 'showLoader']).'</li>';
}

if (in_array("37", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Vegetable Rates</span>', '/VegetableRates',['escape' => false, 'class' => 'showLoader']).'</li>';
}

if (in_array("38", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Daily Sales - Sub Group Wise</span>', '/ItemSubCategories/subGroupItemReportSearch',['escape' => false, 'class' => 'showLoader']).'</li>';
}

if (in_array("39", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Manual Stock</span>', '/ManualStocks',['escape' => false, 'class' => 'showLoader']).'</li>';
}

?> 
