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

<?php $this->set("title", 'Vegetable Rates | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <div class="portlet box blue-hoki">
            <div class="portlet-title hide_at_print">
                <table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
                    <tr>
                        <td width="20%">
                            <div class="caption"style="padding:13px; color: red;">
                                Vegetable Rates
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
                            <?php
                            if (in_array("45", $userPages)){
                                echo $this->Html->link('Vegetable master ', '/Vegetables',['escape' => false, 'class' => 'btn btn-danger showLoader']);
                            }
                            ?>  
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
                    <div class="table-scrollable" style="width: 50%;">
                        <table class="table table-bordered table-stripped" >
                            <tr>
                               <th>Item</th>
                               <th>Rate</th>
                           </tr>
                            <?php 
                            foreach ($Vegetables as $Vegetable) { ?>
                                <tr>
                                    <td>
                                        <?= h($Vegetable->name) ?>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control input-sm" name="rate[<?= h($Vegetable->id) ?>]" placeholder="0" value="<?php echo $data[$Vegetable->id]; ?>" />
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div align="">
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