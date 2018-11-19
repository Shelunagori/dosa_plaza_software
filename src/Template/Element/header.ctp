
<style type="text/css">
.topBtnActive{
    color: #FFF; border-radius: 5px !important; background-color: #FA6775; padding: 7px 18px;margin-left: 8px;
}
.topBtn{
    color: #FFF !important; border-radius: 5px !important; background-color: #41526d !important; padding: 6px 18px;border:none !important;margin-left: 8px;
}
.topBtn2{
    color: #818182; border-radius: 5px !important; background-color: #F5F5F5; padding: 7px 18px;border:solid 1px #f0f0f0;margin-left: 8px;
}
.pointer{
    cursor: pointer;
}
@media only screen and (min-width: 468px) and (max-width: 1100px) {
    .topBtn{
        padding: 2px 4px !important;
    }
    .topBtn2{
        padding: 2px 4px !important; 
    }
    .topBtnActive{
        padding: 2px 4px !important;
    }
    .tablet-logo{
        display: block;
    }
    .desktop-logo{
        display: none;
    }
    .logoutBtn{
        display: none !important;
    }
    .hideInTablet{
         display: none;
    }
}
@media only screen and (min-width: 1024px) {
    .topBtn{
        padding: 6px 6px;
    }
    .tablet-logo{
        display: none;
    }
    .desktop-logo{
        display: block;
    }
    .hideInTablet{
         display: ;
    }
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
if($controller=='bills'){
    if($action=='delivery'){ 
        $deleveryactive="topBtnActive"; 
    }
}
if($controller=='kots'){ 
    if(!empty($pass)){
        if($pass[1]=='takeaway'){
           $takeawayactive="topBtnActive"; 
        }
    }
}
if($controller=='bills'){ 
    if($action=='takeAway'){ 
        $takeawayactive="topBtnActive"; 
    }
}
?>
<div style="background: #2d4161;padding: 14px 0px 0px 0px;">
    <div>
        <?php if(@$Table_data->name){ ?>
            <span style="color: #FFF;margin-right: 10px;border:  solid 1px #949494;padding: 3px 8px;">Table No: <?= h(@$Table_data->name) ?></span>
        <?php } ?>
    
        <span style="color: #FFF;border:  solid 1px #949494;padding: 3px 8px;">Day Sale: <?= h($TotalSale) ?></span>
        <?php if($action!='index'){ ?>
            <span class="counter topBtn pointer">Table Screen</span>
        <?php } ?>
        
        <span class="<?php echo $dinneractive; ?> dinnerNewTab pointer showLoader">Dine In (<?php echo $occupiedTableCount; ?>)</span>
        <span class="<?php echo $deleveryactive ; ?> deleveryNewTab pointer showLoader">Delivery</span>
        <span class="<?php echo $takeawayactive ; ?> takeAwayNewTab pointer">Take Away 1</span>
        <span class="topBtn takeAwayNewTab2 pointer hideInTablet">Take Away 2</span>
        <span class="topBtn pointer showLoader Bookings hideInTablet">Bookings</span>
        <span class="dashboard topBtn pointer showLoader hideInTablet">Dashboard</span>
    </div>
</div>
<?php 

$js="
$(document).ready(function() {
    $('.dinnerNewTab').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'Tables','action'=>'index'])."'
        window.location.href = url; 
    });
    $('.deleveryNewTab').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'Bills','action'=>'delivery'])."'
        window.location.href = url; 
    });
    $('.takeAwayNewTab').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'Bills','action'=>'takeAway'])."'
        window.location.href = url; 
    });
    $('.takeAwayNewTab2').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'Bills','action'=>'takeAway'])."'
        window.open(url);
    });

    

    $('.dashboard').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'Users','action'=>'Dashboard'])."'
        $('#loading').show();
        window.location.href = url; 
    });
    $('.counter').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'Tables','action'=>'index'])."'
        //window.open(url);
        $('#loading').show();
        window.location.href = url; 
    });
    $('.Bookings').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'Bookings','action'=>'add'])."'
        window.location.href = url; 
    });
});
";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
?>