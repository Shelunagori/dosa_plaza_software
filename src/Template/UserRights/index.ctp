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
<?php $this->set("title", 'Employee Permissions | DOSA PLAZA'); ?>


<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <div class="portlet box blue-hoki">
            <div class="portlet-title hide_at_print">
                <table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
                    <tr>
                        <td width="20%">
                            <div class="caption"style="padding:13px; color: red;">
                                Employee Permissions
                            </div>
                        </td>
                        <td valign="button">
                            <div align="center">
                                
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
                <div class="ContenedorTabla">
                    <table class="table table-bordered table-stripped fht-table" id="pruebatabla4">
                        <thead>
                            <tr>
                                <th style="background-color: #c8e8ff;font-size13px;font-weight:bold;padding: 5px;">&nbsp;EMPLOYEE</th>
                                <?php
                                foreach ($users as $user) { ?>
                                    <th style="background-color: #c8e8ff;font-size13px;font-weight:bold;padding: 5px;text-align: center;"><?php echo $user->employee->name; ?></th>
                                <?php } ?>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                            foreach ($pages as $page) { ?>
                               <tr>
                                   <td style="white-space: nowrap;padding: 5px;">
                                        <div style="font-size: 13px;padding: 2px 4px;"><?= h($page->name) ?></div>
                                        <input type="hidden" class="form-control input-sm" name="vegetable[<?= h($Vegetable->id) ?>]" placeholder="0" value="<?= h($Vegetable->id) ?>" >
                                    </td>
                                    <?php
                                    foreach ($users as $user) { ?>
                                        <td style="padding: 5px;text-align: center;">
                                            <input type="checkbox" page_id="<?php echo $page->id; ?>" user_id="<?php echo $user->id; ?>" <?php if(in_array($page->id, $assign_rights[$user->id])){ echo "checked"; }?> value="<?php echo $page->id;?>" class="autoSave" >
                                        </td>
                                    <?php } ?>
                               </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div align="center">
                    <a href="javascript:void()" class="btn btn-danger" onClick="window.location.reload()">Submit</a>
                </div>
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
    $('.fht-tbody').css('height','348px');

   $('.autoSave').die().live('click',function(event){
        var user_id=$(this).attr('user_id');
        var page_id=$(this).attr('page_id');

        if($(this).prop('checked') == true){
            var entry='insert';
        }else{
            var entry='delete';
        }


        var url='".$this->Url->build(['controller'=>'UserRights','action'=>'autosave'])."';
        url=url+'?user_id='+user_id+'&page_id='+page_id+'&entry='+entry;
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