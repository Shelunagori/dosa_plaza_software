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
<?php $this->set("title", 'Date Wise Sales Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title hide_at_print">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Date Wise Sales Report
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
							<a href="javascript:void()" id="exportPDF" class="btn btn-danger" style="float: right; margin-right: 10px;">PDF</a>
							<?php if($exploded_date_from_to){ ?>
							<?php 
								$excelUrl = $this->Url->build(['controller'=>'Bills','action'=>'dateWiseSalesExcel']);
								$excelUrl.='?'.$seturl[1];
							 ?>
							<a href="<?php echo $excelUrl; ?>" class="btn btn-danger" style="margin-right: 10px; float: right;">Excel</a>
						</td>
					</tr>
				</table>
				
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body" id="ExcelPage">
				<div align="center">
					<h4><?php echo $coreVariable['company_name']; ?></h4>
					<span><?php echo $coreVariable['company_address']; ?></span><br/>

				</div>
				<div>
					<b>Bill Wise Sales Report</b><br/>
					<b>From <?php echo @$exploded_date_from_to[0].' To '.@$exploded_date_from_to[1]; ?></b><br/>
					<b><?php echo date('d-m-Y H:i A'); ?></b>
				</div>
				<div class="table-scrollable">
				<table class="table table-bordered table-str qwerty3" width="100%" border="1" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>Date</th>
							<th>Gross value</th>
							<th>Discount</th>
							<th>CGST</th>
							<th>SGST</th>
							<th>Net Value</th>
						</tr>
					</thead>
					<tbody id="main_tbody">
					<?php 
					$ColumnTotalAmount = 0;
					$ColumnTotalDiscountAmount = 0;
					$ColumnTotalCGST = 0;
					$ColumnTotalSGST = 0;
					$ColumnTotalNetAmount = 0;
					$start_date=date('Y-m-d', strtotime($exploded_date_from_to[0]));
					$end_date=date('Y-m-d', strtotime($exploded_date_from_to[1]));
					while (strtotime($start_date) <= strtotime($end_date)) { 
						if($data[strtotime($start_date)]['TotalNetAmount']){ ?>
			                <tr class="main_tr">
								<td><?php echo date('d-m-Y', strtotime($start_date)); ?></td>
								<td><?php echo $TotalAmount = $data[strtotime($start_date)]['TotalAmount']; ?></td>
								<td><?php echo $TotalDiscountAmount = $data[strtotime($start_date)]['TotalDiscountAmount']; ?></td>
								<?php 
									$Taxable = $TotalAmount - $TotalDiscountAmount;
									$TotalNetAmount = $data[strtotime($start_date)]['TotalNetAmount'];
									$GST = $TotalNetAmount - $Taxable;
								?>
								<td><?php echo $TotalCGST = round($GST/2, 2); ?></td>
								<td><?php echo $TotalSGST = round($GST/2, 2); ?></td>
								<td><?php echo $TotalNetAmount; ?></td>
							</tr>
						<?php
						$ColumnTotalAmount+=$TotalAmount;
						$ColumnTotalDiscountAmount+=$TotalDiscountAmount;
						$ColumnTotalCGST+=$TotalCGST;
						$ColumnTotalSGST+=$TotalSGST;
						$ColumnTotalNetAmount+=$TotalNetAmount;
						} 
						$start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
					}?>
					</tbody>
					<tfoot>
						<tr>
							<th style="text-align: right;">Total</th>
							<th><?php echo $ColumnTotalAmount; ?></th>
							<th><?php echo $ColumnTotalDiscountAmount; ?></th>
							<th><?php echo $ColumnTotalCGST; ?></th>
							<th><?php echo $ColumnTotalSGST; ?></th>
							<th><?php echo $ColumnTotalNetAmount; ?></th>
						</tr>
					</tfoot>
				</table>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php $formAction=$this->Url->build(['controller'=>'Bills','action'=>'billWiseSalesPdf']); ?>
<form method="POST"  action="<?php echo $formAction; ?>" id="ExcelForm" style="display: none;">
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

		
		$('#exportPDF').die().live('click',function(event){
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