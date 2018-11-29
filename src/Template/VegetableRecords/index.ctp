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
                    <div class="ContenedorTabla">
                       <!--  <table class="table table-bordered table-stripped fht-table" id="pruebatabla4"> -->
                        <table class="table table-bordered table-stripped fht-table" id="pruebatabla4">
                            <thead>
                                <tr>
                                   <th rowspan="2" style="background-color: #c8e8ff;">Item</th>
                                   <th rowspan="2" style="background-color: #c8e8ff;">Unit</th>
                                   <th rowspan="2" style="background-color: #c8e8ff;">Rate</th>
                                   <?php
                                    $firstDate = $month1[1].'-'.$month1[0].'-1';
                                    $lastDate = date("Y-m-t", strtotime($firstDate));
                                    while (strtotime($firstDate) <= strtotime($lastDate)) {
                                        echo '<th style="white-space: nowrap;text-align:center;background-color: #c8e8ff;" colspan="2" >'.date('d-m-Y', strtotime($firstDate)).'</th>';
                                        $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                    } ?>
                                    <th rowspan="2" style="background-color: #c8e8ff;">Total</th>
                               </tr>
                               <tr>
                                    <?php
                                    $firstDate = $month1[1].'-'.$month1[0].'-1';
                                    $lastDate = date("Y-m-t", strtotime($firstDate));
                                    while (strtotime($firstDate) <= strtotime($lastDate)) {
                                        echo '<th style="background-color: #c8e8ff;text-align:center;" class="qaz">Qty</th>
                                            <th style="background-color: #c8e8ff;text-align:center;" class="qaz">Amt</th>';
                                        $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                    } ?>
                               </tr>
                            </thead>
                            <tbody>
                               <?php 
                                $total=[]; $totalQty=[]; $totalItem=[];
                                foreach ($Vegetables as $Vegetable) { ?>
                                   <tr>
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
                                                <input type="text" placeholder="" class="form-control qty autoSave" name="quantity[<?php echo $Vegetable->id; ?>][<?php echo strtotime($firstDate); ?>]" value="<?php echo @$data2[$Vegetable->id][strtotime($firstDate)]; ?>" style="margin: 0; height: 20px; width: 40px; padding: 0;"  date_string="<?php echo strtotime($firstDate); ?>" vegitable_id="<?php echo $Vegetable->id; ?>" />
                                            </td>
                                            <td style="white-space: nowrap;">
                                                <input type="text" placeholder="" class="form-control amt" name="amount[<?php echo $Vegetable->id; ?>][<?php echo strtotime($firstDate); ?>]" value="<?php echo @$data[$Vegetable->id][strtotime($firstDate)]; ?>" style="margin: 0; height: 20px; width: 40px; padding: 0;" date_string="<?php echo strtotime($firstDate); ?>" readonly="readonly" tabindex="-1" vegitable_id="<?php echo $Vegetable->id; ?>" />
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
                                <tr>
                                    <td colspan="3">Total</td>
                                    <?php
                                    $TotalHorizontal = 0;
                                    $firstDate = $month1[1].'-'.$month1[0].'-1';
                                    $lastDate = date("Y-m-t", strtotime($firstDate));
                                    while (strtotime($firstDate) <= strtotime($lastDate)) { ?>
                                        <td>
                                            <?php echo ($totalQty[strtotime($firstDate)] >0 ? $totalQty[strtotime($firstDate)] : "")?>
                                        </td>
                                        <td style="white-space: nowrap;">
                                           <?php echo ($total[strtotime($firstDate)] >0 ? $total[strtotime($firstDate)] : "")?>
                                           <?php $TotalHorizontal+=$total[strtotime($firstDate)]; ?>
                                        </td>
                                        <?php $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                    } ?>
                                    <td><?php echo $TotalHorizontal; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3">TARA & SONS</td>
                                    <?php
                                    $totalvendorAmount=0;
                                    $firstDate = $month1[1].'-'.$month1[0].'-1';
                                    $lastDate = date("Y-m-t", strtotime($firstDate));
                                    while (strtotime($firstDate) <= strtotime($lastDate)) { ?>
                                        <td></td>
                                        <td style="white-space: nowrap;">
                                           <input type="text" placeholder="" class="form-control vautosave" name="vendor_amount[<?php echo strtotime($firstDate); ?>]" style="margin: 0; height: 20px; width: 40px; padding: 0;"  autocomplete="off" value="<?php echo @$VendorData[strtotime($firstDate)]; ?>" date_string="<?php echo strtotime($firstDate); ?>" >
                                            <?php $totalvendorAmount+=@$VendorData[strtotime($firstDate)]; ?>
                                        </td>
                                        <?php $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                    } ?>
                                    <td><?php echo $totalvendorAmount; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div align="right" style="color: red;">Difference: <?php echo $totalvendorAmount-$TotalHorizontal; ?></div>
                    <div align="center">
                        <a href="javascript:void()" class="btn btn-danger" onClick="window.location.reload()">Submit</a>
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


<?php echo $this->Html->css('/fixedHeader/ScrollTabla.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
<?php echo $this->Html->script('/fixedHeader/jquery.CongelarFilaColumna.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>

<?php 
$js="
$(document).ready(function() {
    $('#pruebatabla4').CongelarFilaColumna({Columnas:3});

    $('.fht-tbody table tbody tr td').css('height','21px');
    $('.qaz').css('width','41px');
    $('.fht-tbody').css('height','348px');

    $('.autoSave').die().live('blur',function(event){
        var date_string=$(this).attr('date_string');
        var vegitable_id=$(this).attr('vegitable_id');
        var quantity=$(this).val();
        var amount=$('.amt[date_string='+date_string+'][vegitable_id='+vegitable_id+']').val();

        var url='".$this->Url->build(['controller'=>'VegetableRecords','action'=>'autosave'])."';
        url=url+'?date_string='+date_string+'&vegitable_id='+vegitable_id+'&quantity='+quantity+'&amount='+amount;
        $.ajax({
            url: url,
        }).done(function(response) {
        });
    });

    $('.vautosave').die().live('blur',function(event){
        var date_string=$(this).attr('date_string');
        var amount=$(this).val();

        var url='".$this->Url->build(['controller'=>'VegetableRecords','action'=>'vautosave'])."';
        url=url+'?date_string='+date_string+'&amount='+amount;
        $.ajax({
            url: url,
        }).done(function(response) {
        });
    });

    

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