<div style="background-color: #2D4161; padding: 10px; color: #FFF;"><?php echo strtoupper($customer->name); ?></div>
<div style="padding: 10px;background-color: #F5F5F5;line-height: 22px; ">
    <span style="color: #727376;">Mobile No.:</span><span style="margin-left: 10px;"><?php echo ($customer->mobile_no); ?></span><br/>
    <span style="color: #727376;">Address:</span><span style="margin-left: 10px;"><?= h($customer->address); ?></span><br/><br/>
    <span >FAVOURITE ITEMS</span><br/>
    <span style="color: #727376;">chilli Paneer</span><br/>
    <span style="color: #727376;">Uthapam</span><br/>
</div>
<input type="hidden" value="<?php echo $c_id; ?>" name="customer_id">