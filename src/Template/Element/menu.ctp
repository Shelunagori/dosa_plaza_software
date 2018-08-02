<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Dashboard</span>', '/Users/Dashboard',['escape' => false]).'</li>';
?>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Stock In Voucher</span>
	<span class="arrow"></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link('Create', '/PurchaseVouchers/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link('List', '/PurchaseVouchers/index',['escape' => false]).'</li>';?>
 	</ul>
</li>
<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Stock Adjustment</span>', '/RawMaterials/stock_adjustment',['escape' => false]).'</li>';
?>
<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Item Category</span>', '/ItemCategories/add',['escape' => false]).'</li>';
?>
<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Item Sub-Category</span>', '/ItemSubCategories/add',['escape' => false]).'</li>';
?>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Items</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link('Create', '/Items/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link('List', '/Items/index',['escape' => false]).'</li>';?>
 	</ul>
</li>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Raw Materials</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link('Create', '/RawMaterials/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link('List', '/RawMaterials/index',['escape' => false]).'</li>';?>
 	</ul>
</li> 
<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Units</span>', '/Units/add',['escape' => false]).'</li>';
?>

<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Employees</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link('Create', '/Employees/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link('List', '/Employees/index',['escape' => false]).'</li>';?>
 	</ul>
</li>
<li class="start">
	<a href="javascript:;">
	<span class="title" style="margin-left: 15px;">Vendors</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link('Create', '/Vendors/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link('List', '/Vendors/index',['escape' => false]).'</li>';?>
 	</ul>
</li>
<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Daily Attendance</span>', '/Attendances/add',['escape' => false]).'</li>';
?>
<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Comments</span>', '/Comments/add',['escape' => false]).'</li>';
?>
<?php 
echo '<li>'.$this->Html->link('<span style="margin-left: 15px;">Customers</span>', '/Customers/index',['escape' => false]).'</li>';
?>


<!-- 
<li class="start">
	<a href="javascript:;">
	<i class="fa fa-gear"></i>
	<span class="title">Master & Setup</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' Item Category', '/ItemCategories/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' Item Sub Category', '/ItemSubCategories/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' Offers', '/MasterOffers/add',['escape' => false]).'</li>';?>
		
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' Units', '/Units/add',['escape' => false]).'</li>';?>	 
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' Stock Adjustment', '/RawMaterials/stock_adjustment',['escape' => false]).'</li>';?>	 
	</ul>
</li>
<li class="start">
	<a href="javascript:;">
	<i class="fa fa-gear"></i>
	<span class="title">Item</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' Add', '/Items/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' View', '/Items/index',['escape' => false]).'</li>';?>
 	</ul>
</li>

<li class="start">
	<a href="javascript:;">
	<i class="fa fa-gear"></i>
	<span class="title">Employee</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' Add', '/Employees/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' View', '/Employees/index',['escape' => false]).'</li>';?>
 	</ul>
</li>

<li class="start">
	<a href="javascript:;">
	<i class="fa fa-gear"></i>
	<span class="title">Vendor</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' Add', '/Vendors/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' View', '/Vendors/index',['escape' => false]).'</li>';?>
 	</ul>
</li>


 
<li class="start">
	<a href="javascript:;">
	<i class="fa fa-gear"></i>
	<span class="title">Attendances</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' Add', '/Attendances/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' View', '/Attendances/index',['escape' => false]).'</li>';?>
 	</ul>
</li>  
 -->