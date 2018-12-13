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
<?php $this->set("title", 'Manual Daily Inventory | '.$coreVariable['company_name']); ?>
<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <div class="portlet box blue-hoki">
            <div class="portlet-title hide_at_print">
                <table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
                    <tr>
                        <td width="20%">
                            <div class="caption"style="padding:13px; color: red;">
                                Manual Daily Inventory
                            </div>
                        </td>
                        <td valign="button">
                            <div align="center">
                                
                            </div>
                        </td>
                        <td width="20%">
                          <?php
                            if (in_array("46", $userPages)){
                                echo $this->Html->link('Daily Inventory Item Master ', '/ItemLists',['escape' => false, 'class' => 'btn btn-danger showLoader']);
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

                <div align="center">
                  <form method="GET">
                    <table>
                      <tr>
                          <td>Previous Records</td>
                          <td>
                            <input type="text" class="form-control input-sm date-picker" name="date_from" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?php echo @$date_from; ?>" />
                          </td>
                          <td><button type="submit" class="btn btn-sm">GO</button></td>
                      </tr>
                    </table>
                  </form>
                </div>

                <?php if($date_from){ 
                  foreach ($OldData as $Tdate=>$OldDataRow) { ?>
                  <div>
                    <span style="background-color: #CCC;padding: 5px;"><?php echo date('d-m-Y', $Tdate); ?></span>
                    <?= $this->Html->link('Edit','/InventoryRecords/edit/'.$Tdate,['class'=>'btn blue btn-xs pull-right']) ?>
                  </div>
                  <table class="table table-bordered table-stripped">
                      <tr>
                         <th>Item</th>
                         <th>Unit</th>
                         <th width="15%">Op. Balance</th>
                         <th>Purchase</th>
                         <th>Manual adjustment</th>
                         <th>Mall</th>
                         <th>SS</th>
                         <th>Wastage</th>
                         <th>Cls. Balance</th>
                         <th>Consumption</th>
                     </tr>
                      <?php foreach ($ItemLists as $ItemList) { ?>
                         <tr>
                             <td>
                                  <?= h($ItemList->name) ?>
                              </td>
                             <td><?= h($ItemList->unit) ?></td>
                             <td><?php echo @$OldData[ strtotime('-1 days', $Tdate) ][$ItemList->id]['closing_balance']; ?></td>
                             <td>
                                <?php echo @$OldData[$Tdate][$ItemList->id]['projection']; ?>
                             </td>
                             <td>
                                <?php echo @$OldData[$Tdate][$ItemList->id]['adjustment']; ?>
                             </td>
                             <td>
                                <?php echo @$OldData[$Tdate][$ItemList->id]['mall']; ?>
                             </td>
                             <td>
                                <?php echo @$OldData[$Tdate][$ItemList->id]['road']; ?>
                             </td>
                             <td>
                                <?php echo @$OldData[$Tdate][$ItemList->id]['wastage']; ?>
                             </td>
                             <td>
                                <?php echo @$OldData[$Tdate][$ItemList->id]['closing_balance']; ?>
                             </td>
                             <td>
                                <?php echo @$OldData[$Tdate][$ItemList->id]['consumption']; ?>
                             </td>
                         </tr>
                      <?php } ?>
                  </table>
                  <?php } ?>
                <?php } ?>
                <form method="POST">
                    <label id="CurrentDate">Date</label>
                    <input name="date" class="form-control" type="text" value="<?php echo date('d-m-Y'); ?>" readonly="readonly" style="width: 150px;">

                    <div class="table-scrollable">
                        <table class="table table-bordered table-stripped">
                            <tr>
                               <th>Item</th>
                               <th>Unit</th>
                               <th width="15%">Op. Balance</th>
                               <th>Purchase</th>
                               <th>Manual adjustment</th>
                               <th>Mall</th>
                               <th>SS</th>
                               <th>Wastage</th>
                               <th>Cls. Balance</th>
                               <th>Consumption</th>
                           </tr>
                            <?php foreach ($ItemLists as $ItemList) { ?>
                               <tr>
                                   <td>
                                        <?= h($ItemList->name) ?>
                                        <input type="hidden" class="form-control input-sm" name="item_list[<?= h($ItemList->id) ?>]" placeholder="0" value="<?= h($ItemList->id) ?>" >
                                    </td>
                                   <td><?= h($ItemList->unit) ?></td>
                                   <td><?php echo @$OBData[$ItemList->id]; ?></td>
                                   <td>
                                        <input type="text" class="form-control input-sm Fst" name="projection[<?= h($ItemList->id) ?>]" placeholder="0" value="<?php echo @$TodayOBData[$ItemList->id]['projection']; ?>" >
                                   </td>
                                   <td>
                                      <input type="text" class="form-control input-sm Fst" name="adjustment[<?= h($ItemList->id) ?>]" placeholder="0" value="<?php echo @$TodayOBData[$ItemList->id]['adjustment']; ?>" >
                                   </td>
                                   <td>
                                       <input type="text" class="form-control input-sm Fst" name="mall[<?= h($ItemList->id) ?>]" placeholder="0" value="<?php echo @$TodayOBData[$ItemList->id]['mall']; ?>" >
                                   </td>
                                   <td>
                                       <input type="text" class="form-control input-sm Fst" name="road[<?= h($ItemList->id) ?>]" placeholder="0" value="<?php echo @$TodayOBData[$ItemList->id]['road']; ?>" >
                                   </td>
                                   <td>
                                      <input type="text" class="form-control input-sm Fst" name="wastage[<?= h($ItemList->id) ?>]" placeholder="0" value="<?php echo @$TodayOBData[$ItemList->id]['wastage']; ?>" >
                                   </td>
                                   <td>
                                       <input type="text" class="form-control input-sm Scnd" name="closing_balance[<?= h($ItemList->id) ?>]" placeholder="0"   value="<?php echo @$TodayOBData[$ItemList->id]['closing_balance']; ?>">
                                   </td>
                                   <td>
                                       <input type="text" class="form-control input-sm" name="consumption[<?= h($ItemList->id) ?>]" placeholder="0" readonly='readonly' tabindex="-1" value="<?php echo @$TodayOBData[$ItemList->id]['consumption']; ?>">
                                   </td>
                               </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div align="center">
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </form>
                
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
    var ht = $('#ExcelPage').html();
    $('#ExcelBox').html(ht);

    
    $('#exportExcel').die().live('click',function(event){
        $('#ExcelForm').submit();
    });

    $('.Fst').die().live('keyup',function(event){
        var OB = parseFloat($(this).closest('tr').find('td:nth-child(3)').text());
        if(isNaN(OB)){ OB=0; }

        var Projection = parseFloat($(this).closest('tr').find('td:nth-child(4) input').val());
        if(isNaN(Projection)){ Projection=0; }

        var adjustment = parseFloat($(this).closest('tr').find('td:nth-child(5) input').val());
        if(isNaN(adjustment)){ adjustment=0; }

        var Mall = parseFloat($(this).closest('tr').find('td:nth-child(6) input').val());
        if(isNaN(Mall)){ Mall=0; }

        var Road = parseFloat($(this).closest('tr').find('td:nth-child(7) input').val());
        if(isNaN(Road)){ Road=0; }

        var Wastage = parseFloat($(this).closest('tr').find('td:nth-child(8) input').val());
        if(isNaN(Wastage)){ Wastage=0; }


        var Cls =  OB + Projection + adjustment - Mall - Road - Wastage;
        Cls = round(Cls,2);
        $(this).closest('tr').find('td:nth-child(9) input').val(Cls);
    });

    $('.Scnd').die().live('keyup',function(event){
        var OB = parseFloat($(this).closest('tr').find('td:nth-child(3)').text());
        if(isNaN(OB)){ OB=0; }

        var Projection = parseFloat($(this).closest('tr').find('td:nth-child(4) input').val());
        if(isNaN(Projection)){ Projection=0; }

        var adjustment = parseFloat($(this).closest('tr').find('td:nth-child(5) input').val());
        if(isNaN(adjustment)){ adjustment=0; }

        var Mall = parseFloat($(this).closest('tr').find('td:nth-child(6) input').val());
        if(isNaN(Mall)){ Mall=0; }

        var Road = parseFloat($(this).closest('tr').find('td:nth-child(7) input').val());
        if(isNaN(Road)){ Road=0; }

        var Wastage = parseFloat($(this).closest('tr').find('td:nth-child(8) input').val());
        if(isNaN(Wastage)){ Wastage=0; }

        var Cls = parseFloat($(this).closest('tr').find('td:nth-child(9) input').val());
        if(isNaN(Cls)){ Cls=0; }

        var Consumption =  OB + Projection + adjustment - Mall - Road - Wastage - Cls;
        Consumption = round(Consumption,2);
        $(this).closest('tr').find('td:nth-child(10) input').val(Consumption);
    });

    


    ComponentsPickers.init();
});
jQuery(window).scrollTop(jQuery('#CurrentDate').offset().top);
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>