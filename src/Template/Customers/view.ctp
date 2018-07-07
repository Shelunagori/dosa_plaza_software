<div style="padding:10px;background-color:#2D4161;color:#FFF;"><?php echo strtoupper($customer->name); ?></div>
<div style="padding:10px;background-color:#F5F5F5;color:#FFF;">
    <table width="100%" style="font-size:12px;">
        <tr>
            <td style="color:#97989A;" valign="top" width="40%">Mobile No.</td>
            <td style="color:#373435;" valign="top"><?php echo ($customer->mobile_no); ?></td>
        </tr>
        <tr>
            <td style="color:#97989A;" valign="top">Address</td>
            <td style="color:#373435;" valign="top"><?= h($customer->address); ?></td>
        </tr>
        <tr>
            <td style="color:#97989A;" valign="top" colspan="2">
                <br/>
                <span style="color:#3D3B3C;font-size:12px;    font-weight: bold;">FAVOURITE ITEMS</span><br/>
                <span>Chilli Paneer</span><br/>
                <span>Uthapam</span><br/>
            
            </td>
        </tr>
    </table>
</div>
<input type="hidden" name="customer_id" value="<?php echo $c_id; ?>">