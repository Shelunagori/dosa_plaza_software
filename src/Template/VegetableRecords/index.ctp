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
                        <table class="table table-bordered table-stripped">
                            <tr>
                               <th>Item</th>
                               <th>Unit</th>
                               <th>Rate</th>
                               <?php
                                $firstDate = $month1[1].'-'.$month1[0].'-1';
                                $lastDate = date("Y-m-t", strtotime($firstDate));
                                while (strtotime($firstDate) <= strtotime($lastDate)) {
                                    echo '<th style="white-space: nowrap;">'.date('d-m-Y', strtotime($firstDate)).'</th>';
                                    $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                } ?>
                           </tr>
                            <?php 
                            $total=[];
                            foreach ($Vegetables as $Vegetable) { ?>
                               <tr>
                                   <td>
                                        <?= h($Vegetable->name) ?>
                                        <input type="hidden" class="form-control input-sm" name="vegetable[<?= h($Vegetable->id) ?>]" placeholder="0" value="<?= h($Vegetable->id) ?>" >
                                    </td>
                                   <td><?= h($Vegetable->unit) ?></td>
                                   <td><?= h($Vegetable->rate) ?></td>
                                    <?php
                                    $firstDate = $month1[1].'-'.$month1[0].'-1';
                                    $lastDate = date("Y-m-t", strtotime($firstDate));
                                    while (strtotime($firstDate) <= strtotime($lastDate)) { ?>
                                        <td style="white-space: nowrap;">
                                            <input type="text" placeholder="0" class="form-control" name="amount[<?php echo $Vegetable->id; ?>][<?php echo strtotime($firstDate); ?>]" value="<?php echo @$data[$Vegetable->id][strtotime($firstDate)]; ?>" />
                                        </td>
                                        <?php 
                                        $total[strtotime($firstDate)]=@$total[strtotime($firstDate)] + @$data[$Vegetable->id][strtotime($firstDate)];
                                        $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                    } ?>
                               </tr>
                            <?php } ?>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <?php
                                    $firstDate = $month1[1].'-'.$month1[0].'-1';
                                    $lastDate = date("Y-m-t", strtotime($firstDate));
                                    while (strtotime($firstDate) <= strtotime($lastDate)) { ?>
                                        <th style="white-space: nowrap;">
                                           <?php echo $total[strtotime($firstDate)]; ?>
                                        </th>
                                        <?php $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                    } ?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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
    

    ComponentsPickers.init();
});
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>