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
    select.input-sm {
        height: 22px;
        line-height: 20px;
        width: 80px;
        margin: 0;
        padding: 0;
    }
</style>
<?php $this->set("title", 'Vegetable Records | DOSA PLAZA'); ?>

<?php
$color[1]='#9797ff';
$color[2]='yellow';
$color[3]='#909090';
$color[4]='#fd6060';
$color[5]='#4646f3';
?>
<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <div class="portlet box blue-hoki">
            <div class="portlet-title hide_at_print">
                <table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
                    <tr>
                        <td width="20%">
                            <div class="caption"style="padding:13px; color: red;">
                                Attendance Sheet
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
                                   <th style="background-color: #c8e8ff;font-size13px;font-weight:bold;">&nbsp;EMPLOYEE</th>
                                   <?php
                                    $firstDate = $month1[1].'-'.$month1[0].'-1';
                                    $lastDate = date("Y-m-t", strtotime($firstDate));
                                    while (strtotime($firstDate) <= strtotime($lastDate)) {
                                        echo '<th style="white-space: nowrap;text-align:center;background-color: #c8e8ff;font-size13px;font-weight:bold;" >'.date('d-m-Y', strtotime($firstDate)).'</th>';
                                        $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                    } ?>
                               </tr>
                            </thead>
                            <tbody>
                               <?php 
                                foreach ($Employees as $Employee) { ?>
                                   <tr>
                                       <td style="white-space: nowrap;">
                                            <div style="font-size: 13px;padding: 2px 4px;"><?= h($Employee->name) ?></div>
                                            <input type="hidden" class="form-control input-sm" name="vegetable[<?= h($Vegetable->id) ?>]" placeholder="0" value="<?= h($Vegetable->id) ?>" >
                                        </td>
                                        <?php
                                        $isToday=strtotime(date('Y-m-d'));
                                        $TotalHorizontal = 0;
                                        $firstDate = $month1[1].'-'.$month1[0].'-1';
                                        $lastDate = date("Y-m-t", strtotime($firstDate));
                                        while (strtotime($firstDate) <= strtotime($lastDate)) { 
                                            if($session_employee->designation_id==4){
                                                $disabledAttr='';
                                            }else{
                                                if($isToday==strtotime($firstDate)){
                                                   $disabledAttr='';
                                                }else{
                                                    $disabledAttr='disabled';
                                                }
                                            }
                                            ?>
                                            <td>
                                                <?php echo $this->Form->select(
                                                    'attendance',
                                                    [
                                                        ['value' => '1', 'text' => 'Present'],
                                                        ['value' => '2', 'text' => 'Half Day'],
                                                        ['value' => '3', 'text' => 'Absent'],
                                                        ['value' => '4', 'text' => 'Off'],
                                                        ['value' => '5', 'text' => 'Full']
                                                    ],
                                                    ['value' => @$data[$Employee->id][strtotime($firstDate)], 'empty'=>' ', 'class' => 'form-control input-sm autoSave', 'date_string'=>strtotime($firstDate), 'employee_id'=>$Employee->id,
                                                        'style' => 'background-color:'.$color[@$data[$Employee->id][strtotime($firstDate)]],
                                                        $disabledAttr
                                                    ]
                                                ); ?>
                                            </td>
                                            <?php 
                                            $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate)));
                                        } ?>
                                   </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
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
    $('#pruebatabla4').CongelarFilaColumna({Columnas:1});

    $('.fht-tbody table tbody tr td').css('height','22px');
    //$('.qaz').css('width','41px');
    $('.fht-tbody').css('height','348px');

   
    var color=[];
    color[1]='#9797ff';
    color[2]='yellow';
    color[3]='#909090';
    color[4]='#fd6060';
    color[5]='#4646f3';

    $('.autoSave').die().live('change',function(event){
        var date_string=$(this).attr('date_string');
        var employee_id=$(this).attr('employee_id');
        var attdnc=$(this).find('option:selected').val();

        $(this).css('background-color', color[attdnc]);
        if(!attdnc){
            $(this).css('background-color', '');
        }
        

        var url='".$this->Url->build(['controller'=>'Attendances','action'=>'autosave'])."';
        url=url+'?date_string='+date_string+'&employee_id='+employee_id+'&attdnc='+attdnc;
        $.ajax({
            url: url,
        }).done(function(response) {
        });
    });
    

    

    ComponentsPickers.init();
});
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>