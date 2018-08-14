
<style type="text/css">
.topBtn{
	color: #FFF !important; border-radius: 5px !important; background-color: #41526d !important; padding: 6px 18px;border:none !important;margin-left: 8px;
}
.pointer{
    cursor: pointer;
}
</style>

<div style="background: #2d4161;padding: 14px 0px 0px 0px;">
    <div >
        <span class="counter topBtn pointer">Table Screen</span>
    </div>
</div>
<?php 

$js="
$(document).ready(function() {
    $('.counter').die().live('click',function(event){
        var url='".$this->Url->build(['controller'=>'Tables','action'=>'index'])."'
        window.open(url); 
    });
});
";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
?>