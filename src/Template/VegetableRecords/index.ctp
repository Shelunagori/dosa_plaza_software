<?php echo $this->Html->css('mystyle'); ?>
<style type="text/css" media="print">
@page {
    width:100%;
    size: auto;   /* auto is the initial value */
    margin: 0px 0px 0px 0px;  /* this affects the margin in the printer settings */
}
.hide_at_print {
    display:none !important;
}
.show_at_print {
    display:block !important;
}
</style>
<style type="text/css">
    .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td{
        padding: 0; font-size: 12px;
    }
</style>
<?php $this->set("title", 'Vegetable Records | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <div class="portlet box blue-hoki">
            <div class="portlet-title hide_at_print">
                <table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
                    <tr>
                        <td width="20%">
                            <div class="caption"style="padding:13px; color: red;">
                                Vegetable Records
                            </div>
                        </td>
                        <td valign="button">
                            <div align="center">
                                <form method="GET">
                                    <table>
                                        <tr>
                                            <td>
                                                <input name="month" class="form-control date-picker" type="text" value="<?php echo @$month; ?>" data-date-format="mm-yyyy" required="required" placeholder="Month">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;">GO</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </td>
                        <td width="20%">
                        </td>
                    </tr>
                </table>
                <div class="row">   
                    <div class="col-md-12 horizontal"></div>
                </div>
            </div>

            <div class="portlet-body"  id="ExcelPage">
                <?php if($month){ ?>
                <form method="POST">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-stripped" >
                            <tr>
                               <th rowspan="2">Item</th>
                               <th rowspan="2">Unit</th>
                               <th rowspan="2">Rate</th>
                               <?php
                                $firstDate = $month1[1].'-'.$month1[0].'-1';
                                $lastDate = date("Y-m-t", strtotime($firstDate));
                                while (strtotime($firstDate) <= strtotime($lastDate)) {
                                    echo '<th style="white-space: nowrap;text-align:center;" colspan="2" >'.date('d-m-Y', strtotime($firstDate)).'</th>';
                                    $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                } ?>
                                <th rowspan="2">Total</th>
                           </tr>
                           <tr>
                                <?php
                                $firstDate = $month1[1].'-'.$month1[0].'-1';
                                $lastDate = date("Y-m-t", strtotime($firstDate));
                                while (strtotime($firstDate) <= strtotime($lastDate)) {
                                    echo '<th>Qty</th>
                                            <th>Amt</th>';
                                    $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                } ?>
                               
                           </tr>
                            <?php 
                            $total=[]; $totalQty=[]; $totalItem=[];
                            foreach ($Vegetables as $Vegetable) { ?>
                               <tr >
                                   <td style="white-space: nowrap;">
                                        <?= h($Vegetable->name) ?>
                                        <input type="hidden" class="form-control input-sm" name="vegetable[<?= h($Vegetable->id) ?>]" placeholder="0" value="<?= h($Vegetable->id) ?>" >
                                    </td>
                                   <td><?= h($Vegetable->unit) ?></td>
                                   <td class="rate"><?= h($Vegetable->vegetable_rates[0]['rate']) ?></td>
                                    <?php
                                    $TotalHorizontal = 0;
                                    $firstDate = $month1[1].'-'.$month1[0].'-1';
                                    $lastDate = date("Y-m-t", strtotime($firstDate));
                                    while (strtotime($firstDate) <= strtotime($lastDate)) { ?>
                                        <td>
                                            <input type="text" placeholder="" class="form-control qty" name="quantity[<?php echo $Vegetable->id; ?>][<?php echo strtotime($firstDate); ?>]" value="<?php echo @$data2[$Vegetable->id][strtotime($firstDate)]; ?>" style="margin: 0; height: 20px; width: 40px; padding: 0;"  date_string="<?php echo strtotime($firstDate); ?>" />
                                        </td>
                                        <td style="white-space: nowrap;">
                                            <input type="text" placeholder="" class="form-control amt" name="amount[<?php echo $Vegetable->id; ?>][<?php echo strtotime($firstDate); ?>]" value="<?php echo @$data[$Vegetable->id][strtotime($firstDate)]; ?>" style="margin: 0; height: 20px; width: 40px; padding: 0;" date_string="<?php echo strtotime($firstDate); ?>" readonly="readonly" tabindex="-1" />
                                            <?php $TotalHorizontal+=@$data[$Vegetable->id][strtotime($firstDate)]; ?>
                                        </td>
                                        <?php 
                                        $total[strtotime($firstDate)]=@$total[strtotime($firstDate)] + @$data[$Vegetable->id][strtotime($firstDate)];
                                        $totalQty[strtotime($firstDate)]=@$totalQty[strtotime($firstDate)] + @$data2[$Vegetable->id][strtotime($firstDate)];
                                        $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                    } ?>
                                    <th><?php echo $TotalHorizontal; ?></th>
                               </tr>
                            <?php } ?>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <?php
                                    $TotalHorizontal = 0;
                                    $firstDate = $month1[1].'-'.$month1[0].'-1';
                                    $lastDate = date("Y-m-t", strtotime($firstDate));
                                    while (strtotime($firstDate) <= strtotime($lastDate)) { ?>
                                        <th>
                                            <?php echo ($totalQty[strtotime($firstDate)] >0 ? $totalQty[strtotime($firstDate)] : "")?>
                                        </th>
                                        <th style="white-space: nowrap;">
                                           <?php echo ($total[strtotime($firstDate)] >0 ? $total[strtotime($firstDate)] : "")?>
                                           <?php $TotalHorizontal+=$total[strtotime($firstDate)]; ?>
                                        </th>
                                        <?php $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                    } ?>
                                    <th><?php echo $TotalHorizontal; ?></th>
                                </tr>
                                <tr>
                                    <th colspan="3">TARA & SONS</th>
                                    <?php
                                    $totalvendorAmount=0;
                                    $firstDate = $month1[1].'-'.$month1[0].'-1';
                                    $lastDate = date("Y-m-t", strtotime($firstDate));
                                    while (strtotime($firstDate) <= strtotime($lastDate)) { ?>
                                        <th></th>
                                        <th style="white-space: nowrap;">
                                           <input type="text" placeholder="" class="form-control" name="vendor_amount[<?php echo strtotime($firstDate); ?>]" style="margin: 0; height: 20px; width: 40px; padding: 0;"  autocomplete="off" value="<?php echo @$VendorData[strtotime($firstDate)]; ?>" >
                                            <?php $totalvendorAmount+=@$VendorData[strtotime($firstDate)]; ?>
                                        </th>
                                        <?php $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                    } ?>
                                    <th><?php echo $totalvendorAmount; ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div align="right" style="color: red;">Difference: <?php echo $totalvendorAmount-$TotalHorizontal; ?></div>
                    <div align="center">
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php $formAction=$this->Url->build(['controller'=>'Bills','action'=>'hourlyReportExcel']); ?>
<form method="POST" action="<?php echo $formAction; ?>" id="ExcelForm" style="display: none;">
    <textarea id="ExcelBox" name="excel_box"></textarea>
    <button type="submit">EXCEL</button>
</form>
<!-- BEGIN PAGE LEVEL STYLES -->
    <!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->

 <!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/clockface/js/clockface.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/global/scripts/metronic.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/quick-sidebar.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END PAGE LEVEL SCRIPTS -->
<?php 
$js="
$(document).ready(function() {

    $('.qty').die().live('keyup',function(event){
        var qty = $(this).val();
        var date_string = $(this).attr('date_string');

        var rate = parseFloat( $(this).closest('tr').find('.rate').text() );

        var amt = round(qty*rate,2);
        $(this).closest('tr').find('.amt[date_string='+date_string+']').val(amt);
    });

    ComponentsPickers.init();
});
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>