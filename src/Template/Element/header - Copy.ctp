
<style type="text/css">
.topBtnActive{
	color: #FFF; border-radius: 5px !important; background-color: #FA6775; padding: 7px 18px;margin-left: 8px;
}
.topBtn{
	color: #818182; border-radius: 5px !important; background-color: #FFF; padding: 6px 18px;border:solid 1px #f0f0f0;margin-left: 8px;
}
.topBtn2{
	color: #818182; border-radius: 5px !important; background-color: #F5F5F5; padding: 7px 18px;border:solid 1px #f0f0f0;margin-left: 8px;
}
.pointer{
    cursor: pointer;
}
</style>
<?php //pr($this->request->params);exit;
$controller = strtolower($this->request->params['controller']); 
$pass = $this->request->params['pass'];
$action = $this->request->params['action'];
$dinneractive='topBtn';
$deleveryactive='topBtn';
$takeawayactive='topBtn';
$swiftactive='topBtn';
if($controller=='tables'){ 
    if($action=='swifttable'){
        $swiftactive='topBtnActive';
    }
    else{
         $dinneractive="topBtnActive";
    }
}
if($controller=='kots'){ 
    if(!empty($pass)){
        if($pass[1]=='dinner'){
           $dinneractive="topBtnActive"; 
        }
            
    }
}
if($controller=='kots'){ 
    if(!empty($pass)){
        if($pass[1]=='delivery'){
           $deleveryactive="topBtnActive"; 
        }
            
    }
}
if($controller=='kots'){ 
    if(!empty($pass)){
        if($pass[1]=='takeaway'){
           $takeawayactive="topBtnActive"; 
        }
            
    }
}
?>
<div class="row" style="background: #FEFEFE;padding: 15px;">
    <div class="col-md-6" >
    	<?php if($controller!='tables'){ ?>
        	<a class=" tooltips" id="BackToTables" data-container="body" data-placement="bottom" data-original-title="Back to table screen"></a>
        	<?= $this->Html->link(__('<i class="fa fa-arrow-left"></i>'), ['controller' => 'Tables', 'action' => 'index'], ['class' => 'tooltips', 'id' => 'BackToTables', 'escape' => false, 'data-original-title' =>'Back to table screen', 'data-placement' => 'bottom']) ?>
    	<?php } ?>
        <span class="<?php echo $dinneractive; ?> dinnerNewTab pointer">Dinner In</span>
        <span class="<?php echo $deleveryactive ; ?> deleveryNewTab pointer">Delivery</span>
        <span class="<?php echo $takeawayactive ; ?> takeAwayNewTab pointer">Take Away</span>
    </div>
    <div class="col-md-6" align="right">
        <span class="topBtn2">Booking</span>
        <span class="<?php echo $swiftactive ; ?> Swift pointer">Shift Table</span>
        <span style="color: #96989A;font-size: 15px;margin-left: 8px;">Day Sale</span>
        <span style="color: #2FBD9F;font-size: 15px;margin-left: 5px;">&#8377; <?php if($TotalSale>0){echo $TotalSale;} else {echo 0; }?></span>
    </div>
</div>
<?php 

$js="
$(document).ready(function() {
    $('.dinnerNewTab').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'Tables','action'=>'index'])."'
        window.open(url, '_blank'); 
    });
    $('.deleveryNewTab').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'kots','action'=>'generate','0','delivery'])."'
        window.open(url, '_blank'); 
    });
    $('.takeAwayNewTab').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'kots','action'=>'generate','0','takeaway'])."'
        window.open(url, '_blank'); 
    });

    $('.Swift').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'Tables','action'=>'swifttable'])."'
        window.open(url); 
    });
});
";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
?>