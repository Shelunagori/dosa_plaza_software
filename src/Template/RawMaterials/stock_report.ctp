<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Stock-Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Stock-Report
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
							<table>
								<tr>
									<td>
										<a href="javascript:void()" id="exportExcel" class="btn btn-danger" style="margin-right: 10px;"> Excel</a>
									</td>
									<td>
										<div class="actions" style="margin-right: 10px;">
											<input id="search3"  class="form-control" type="text" placeholder="Search" >
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body" id="ExcelPage">

				<?php if($from_date && $to_date){ ?>

				<?php
				$stock=[];
				foreach ($RawMaterials as $RawMaterial){
					foreach ($RawMaterial->stock_ledgers as $stock_ledger) {
						$stock[$RawMaterial->id][$stock_ledger->status][strtotime($stock_ledger->transaction_date)]=$stock_ledger->Total_quantity;
					}
				}
				?>
				<div align="center">
					<h4><?php echo $coreVariable['company_name']; ?></h4>
					<span><?php echo $coreVariable['company_address']; ?></span><br/>

				</div>
				<div>
					<b>Bill Wise Sales Report</b><br/>
					<b>From <?php echo $exploded_date_from_to[0].' To '.$exploded_date_from_to[1]; ?></b>
					<b style="float: right;"><?php echo date('d-m-Y H:i A'); ?></b>
				</div>
				<div class="table-scrollable">
				<table border="1" class="table table-bordered table-str">
					<thead>
						<tr>
							<th rowspan="2">S.No.</th>
							<th rowspan="2">Raw materials</th>
							<th rowspan="2">Unit</th>
							<?php 
							$start_date=$from_date;
							$end_date=$to_date;
							while (strtotime($start_date) <= strtotime($end_date)) {
				                echo '<th style="white-space: nowrap;text-align:center;" colspan="2" >'.date('d-m-Y', strtotime($start_date)).'</th>';
				                $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
							} ?>
						</tr>
						<tr>
							<?php 
							$start_date=$from_date;
							$end_date=$to_date;
							while (strtotime($start_date) <= strtotime($end_date)) {
				                echo '<th style="white-space: nowrap;">Opening</th>';
				                echo '<th style="white-space: nowrap;">Closing</th>';
				                $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
							} ?>
						</tr>
					</thead>
					<tbody id="main_tbody">
					<?php $d=0;$x=0; foreach ($RawMaterials as $RawMaterial): ?>
						<tr class="main_tr">
							<td><?= (++$d) ?></td>
							<td><?= h($RawMaterial->name) ?></td>
							<td><?= h($RawMaterial->primary_unit->name) ?></td>
							<?php 
							$start_date=$from_date;
							$end_date=$to_date;

							$opening=$RawMaterial->total_in_opening-$RawMaterial->total_out_opening;
							$closing=0;
							while (strtotime($start_date) <= strtotime($end_date)) {
								$closing = $opening + (@$stock[$RawMaterial->id]['in'][strtotime($start_date)]) - (@$stock[$RawMaterial->id]['out'][strtotime($start_date)]); ?>
				                <td style="text-align: center;"><?php echo ($opening) ? ($opening) : '' ?></td>
				                <td style="text-align: center;"><?php echo ($closing) ? ($closing) : '' ?></td>
				                <?php
				                $opening=$closing;
				                $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
							} ?>
							
						</tr>
						<?php $x++; endforeach; ?>
					</tbody>
				</table>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php $formAction=$this->Url->build(['controller'=>'RawMaterials','action'=>'stockReportExcel']); ?>
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


    	var ht = $('#ExcelPage').html();
		$('#ExcelBox').html(ht);

		
		$('#exportExcel').die().live('click',function(event){
			$('#ExcelForm').submit();
		});
		
	});
	";
	
$js.="
$(document).ready(function() {
    ComponentsPickers.init();
});
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>