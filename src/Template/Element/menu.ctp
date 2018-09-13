
<?php 
	if (in_array("1", $userPages)){
		echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Dashboard</span>', '/Users/Dashboard',['escape' => false, 'class' => 'showLoader']).'</li>';
	}

	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Store</span>', '/RawMaterials/store',['escape' => false, 'class' => 'showLoader']).'</li>';
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
if(!empty(count(array_intersect($userPages, $target)))){?>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Items</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php
		if (in_array("8", $userPages)){
			 echo '<li>'.$this->Html->link('Create', '/Items/add',['escape' => false, 'class' => 'showLoader']).'</li>';
		}
		if (in_array("9", $userPages)){
			echo '<li>'.$this->Html->link('List', '/Items/index',['escape' => false, 'class' => 'showLoader']).'</li>';
		}
		?>
 	</ul>
</li>
<?php
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
if(!empty(count(array_intersect($userPages, $target)))){?>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Raw Materials</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php 
		if (in_array("12", $userPages)){
			echo '<li>'.$this->Html->link('Create', '/RawMaterials/add',['escape' => false, 'class' => 'showLoader']).'</li>';
		} ?>
		<?php 
		if (in_array("13", $userPages)){
			echo '<li>'.$this->Html->link('List', '/RawMaterials/index',['escape' => false, 'class' => 'showLoader']).'</li>';
		}?>
 	</ul>
</li>
<?php
}
if (in_array("14", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Offer Codes</span>', '/OfferCodes/index',['escape' => false, 'class' => 'showLoader']).'</li>';
}
?>
<?php 
$target=array("15","16");
if(!empty(count(array_intersect($userPages, $target)))){?>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Bookings</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link('New', '/Bookings/add',['escape' => false, 'class' => 'showLoader']).'</li>';?>
		<?php echo '<li>'.$this->Html->link('List', '/Bookings/index',['escape' => false, 'class' => 'showLoader']).'</li>';?>
 	</ul>
</li>

<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Employees</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php
		if (in_array("15", $userPages)){
			echo '<li>'.$this->Html->link('Create', '/Employees/add',['escape' => false, 'class' => 'showLoader']).'</li>';
		}?>
		<?php 
		if (in_array("16", $userPages)){
			echo '<li>'.$this->Html->link('List', '/Employees/index',['escape' => false, 'class' => 'showLoader']).'</li>';
		}?>
 	</ul>
</li>
<?php
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
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Expense Voucher</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php 
			echo '<li>'.$this->Html->link('Create', '/ExpanseVouchers/add',['escape' => false, 'class' => 'showLoader']).'</li>';
		 
			echo '<li>'.$this->Html->link('List', '/ExpanseVouchers/index',['escape' => false, 'class' => 'showLoader']).'</li>';

			echo '<li>'.$this->Html->link('Report', '/ExpanseVouchers/view',['escape' => false, 'class' => 'showLoader']).'</li>';
		 ?>
 	</ul>
</li>

<?php
if (in_array("28", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">User Rights</span>', '/UserRights/add',['escape' => false, 'class' => 'showLoader']).'</li>';
}
if (in_array("26", $userPages)){
	echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Reports</span>', '/Users/Reports',['escape' => false, 'class' => 'showLoader']).'</li>';
}

?> 
