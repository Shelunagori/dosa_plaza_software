<style type="text/css">
.topBtnActive{
	color: #FFF; border-radius: 5px !important; background-color: #FA6775; padding: 7px 18px;margin-left: 8px;
}
.topBtn{
	color: #818182; border-radius: 5px !important; background-color: #FFF; padding: 7px 18px;border:solid 1px #f0f0f0;margin-left: 8px;
}
.topBtn2{
	color: #818182; border-radius: 5px !important; background-color: #F5F5F5; padding: 7px 18px;border:solid 1px #f0f0f0;margin-left: 8px;
}
</style>
<?php
$controller = strtolower($this->request->params['controller']);
?>
<div class="row" style="background: #FEFEFE;padding: 15px;">
    <div class="col-md-6" >
    	<?php if($controller!='tables'){ ?>
        	<a class=" tooltips" id="BackToTables" data-container="body" data-placement="bottom" data-original-title="Back to table screen"></a>
        	<?= $this->Html->link(__('<i class="fa fa-arrow-left"></i>'), ['controller' => 'Tables', 'action' => 'index'], ['class' => 'tooltips', 'id' => 'BackToTables', 'escape' => false, 'data-original-title' =>'Back to table screen', 'data-placement' => 'bottom']) ?>
    	<?php } ?>
        <span class="topBtnActive">Dinner In</span>
        <span class="topBtn">Delivery</span>
        <span class="topBtn">Take Away</span>
    </div>
    <div class="col-md-6" align="right">
        <span class="topBtn2">Booking</span>
        <span class="topBtn2">Bills</span>
        <span style="color: #96989A;font-size: 15px;margin-left: 8px;">Day Sale</span>
        <span style="color: #2FBD9F;font-size: 15px;margin-left: 8px;">₹5000</span>
    </div>
</div>