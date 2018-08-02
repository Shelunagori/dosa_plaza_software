<?php 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Dashboard', '/Users/Dashboard',['escape' => false]).'</li>';
?>
<li class="start">
	<a href="javascript:;">
	<i class="icon-home"></i>
	<span class="title">Stock In Voucher</span>
	<span class="arrow"></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link( $this->Html->tag('i', '', ['class' => 'fa fa-plus']).' &nbsp;Create', '/PurchaseVouchers/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link( $this->Html->tag('i', '', ['class' => 'fa fa-book']).' &nbsp;List', '/PurchaseVouchers/index',['escape' => false]).'</li>';?>
 	</ul>
</li>
<?php 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Stock Adjustment', '/RawMaterials/stock_adjustment',['escape' => false]).'</li>';
?>
<?php 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'<span>Category</span><br><span style=" margin-left: 27px; font-size: 12px; ">Raw Material</span>', '/ItemCategories/add',['escape' => false]).'</li>';
?>
<?php 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'<span>Sub-Category</span><br><span style=" margin-left: 27px; font-size: 12px; ">Raw Material</span>', '/ItemSubCategories/add',['escape' => false]).'</li>';
?>
<li class="start">
	<a href="javascript:;">
	<i class="icon-home"></i>
	<span class="title">Raw Material</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-plus']).' &nbsp;Create', '/RawMaterials/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' &nbsp;List', '/RawMaterials/index',['escape' => false]).'</li>';?>
 	</ul>
</li> 
<?php 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Units', '/Units/add',['escape' => false]).'</li>';
?>
<li class="start">
	<a href="javascript:;">
	<i class="icon-home"></i>
	<span class="title">Item</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-plus']).' &nbsp;Create', '/Items/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' &nbsp;List', '/Items/index',['escape' => false]).'</li>';?>
 	</ul>
</li>
<li class="start">
	<a href="javascript:;">
	<i class="icon-home"></i>
	<span class="title">Employee</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-plus']).' &nbsp;Create', '/Employees/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' &nbsp;List', '/Employees/index',['escape' => false]).'</li>';?>
 	</ul>
</li>
<li class="start">
	<a href="javascript:;">
	<i class="icon-home"></i>
	<span class="title">Vendor</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-plus']).' &nbsp;Create', '/Vendors/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' &nbsp;List', '/Vendors/index',['escape' => false]).'</li>';?>
 	</ul>
</li>
<?php 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).' Daily Attendance', '/Attendances/add',['escape' => false]).'</li>';
?>
<?php 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Comments', '/Comments/add',['escape' => false]).'</li>';

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