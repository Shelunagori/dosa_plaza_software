<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Expense-Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
                    <tr>
                        <td width="20%">
                            <div class="caption"style="padding:13px; color: red;">
                                Expense Report
                            </div>
                        </td>
                        <td valign="button">
                            <div align="center">
                                <form method="GET">
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div id="reportrange" class="btn default" style="padding: 5px;">
                                                            <i class="fa fa-calendar"></i>
                                                            &nbsp; 
                                                            <span><?php echo $exploded_date_from_to[0].' - '.$exploded_date_from_to[1]; ?></span>
                                                            <input type="hidden" name="date_from_to" id="date_from_to" value="<?php echo @$exploded_date_from_to[0].'/'.@$exploded_date_from_to[1]; ?>">
                                                            <b class="fa fa-angle-down"></b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;" >GO</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </td>
                        <td width="20%">
                            <div class="actions" style="margin-right: 10px;">
                                <input id="search3"  class="form-control" type="text" placeholder="Search" >
                            </div>
                        </td>
                    </tr>
                </table>
                
                <div class="row">   
                    <div class="col-md-12 horizontal"></div>
                </div>
            </div>
            <div class="portlet-body">

                <?php if($from_date && $to_date){
                    ?>
                 <style type="text/css">
                    .highcharts-button-symbol{
                        display: none;
                    }
                    .highcharts-credits{
                        display: none;
                    }
                </style>
                <div class="col-md-7">
                <table class="table table-bordered table-str">
                    <thead>
                        <tr>
                            <th rowspan="2">S.No.</th>
                            <th rowspan="2">Expense Head Name</th>
                            <th rowspan="2">Amount</th>                             
                        </tr> 
                    </thead>
                    <tbody id="main_tbody">
                    <?php $d=0;$x=0;$tot_amount =0; $data = [];
                    foreach ($ExpanseVoucherRows as $key => $value) {
                        $headName=$value->expanse_head->name;
                        $amount=$value->total_amount;
                        $tot_amount+= $amount;

                        $data[] = ['name' => $headName, 'y' => round(@$amount)];
                    
                        ?>
                        <tr class="main_tr">
                            <td><?= (++$d) ?></td>
                            <td><?= h($headName) ?></td>
                            <td><?= h($amount) ?></td>
                        </tr>
                        <?php
                    }
                    $json_data = json_encode($data);
                    ?>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align:right">Total Amount </th>
                            <th><?php echo $tot_amount;?></th>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
                </div>
                <div class="col-md-5">
                    <div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <script src="https://code.highcharts.com/modules/data.js"></script>
                    <script src="https://code.highcharts.com/modules/exporting.js"></script>
                    <script src="https://code.highcharts.com/modules/export-data.js"></script>     
                    <script type="text/javascript">
                    // Radialize the colors
                    Highcharts.setOptions({
                        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                            return {
                                radialGradient: {
                                    cx: 0.5,
                                    cy: 0.3,
                                    r: 0.7
                                },
                                stops: [
                                    [0, color],
                                    [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                                ]
                            };
                        })
                    });

                    // Build the chart
                    Highcharts.chart('container2', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Expense - Pie Chart'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} ',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    },
                                    connectorColor: 'silver'
                                }
                            }
                        },
                        series: [{
                            name: 'Share',
                            data: <?php echo $json_data; ?>
                        }]
                    });
                    </script>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>




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
        var rows = $('#main_tbody tr.main_tr');
        $('#search3').on('keyup',function() {
          
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
            var v = $(this).val();
            
            if(v){ 
                rows.show().filter(function() {
                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        
                    return !~text.indexOf(val);
                }).hide();
            }else{
                rows.show();
            }
        }); 
    });
    $(document).ready(function() {
        ComponentsPickers.init();
    });
    ";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>