<?php 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Dashboard', '/Users/Dashboard',['escape' => false]).'</li>';
?>
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
	<span class="title">Purchase Vouchers</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' Add', '/PurchaseVouchers/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' View', '/PurchaseVouchers/index',['escape' => false]).'</li>';?>
 	</ul>
</li>
<li class="start">
	<a href="javascript:;">
	<i class="fa fa-gear"></i>
	<span class="title">Raw Material</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' Add', '/RawMaterials/add',['escape' => false]).'</li>';?>
		<?php echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-book']).' View', '/RawMaterials/index',['escape' => false]).'</li>';?>
 	</ul>
</li> 