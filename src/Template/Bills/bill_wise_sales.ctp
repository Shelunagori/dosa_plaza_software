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
.qwerty2>thead>tr>th, .qwerty2>tbody>tr>th, .qwerty2>tfoot>tr>th, .qwerty2>thead>tr>td, .qwerty2>tbody>tr>td, .qwerty2>tfoot>tr>td 
	{
		border: none !important;
	}
</style>

<?php $this->set("title", 'Bill Wise Sales Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title hide_at_print">

				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Bill Wise Sales Report
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
							<?php 
								$excelUrl = $this->Url->build(['controller'=>'Bills','action'=>'billWiseSalesExcel']);
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
				<?php if($exploded_date_from_to){ ?>
					
				<div align="center">
					<h4><?php echo $coreVariable['company_name']; ?></h4>
					<span><?php echo $coreVariable['company_address']; ?></span><br/>
				</div>
				<div>
					<span>Bill Wise Sales Report</span><br/>
					<span>From <?php echo @$exploded_date_from_to[0].' To '.@$exploded_date_from_to[1]; ?></span><br/>
					<span >Report generated on: <?php echo date('d-m-Y H:i A'); ?></span>
					<hr>
				</div>
				<div class="table-scrollable" >
					<table class="table table-bordered qwerty" cellpadding="0" cellspacing="0">
						<?php 
						$TOTAL_SALE=0;
						$TOTAL_CGST=0;
						$TOTAL_SGST=0;
						$TOTAL_TAXABLE=0;
						$TOTAL_DISCOUNT=0;
						foreach ($Bills as $Bill): ?>
							<tr>
								<td>
									<table width="100%" class=" qwerty2" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
										<tr>
											<td>
												<span>Bill No.</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?= h($Bill->voucher_no) ?>
												</span>
											</td>
											<td>
												<span>Bill Date</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?php echo date('d-m-Y', strtotime($Bill->transaction_date)); ?>
													<?php echo date(' H:i A', strtotime($Bill->created_on)); ?>
												</span>
											</td>
											<td>
												<span>No. of Pax</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?= h($Bill->no_of_pax) ?>
												</span>
											</td>
											<td>
												<span>Time Taken</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?php 
													$Bill->occupied_time->format('Y-m-d H:i:s').'<br/>';
													$Bill->created_on->format('Y-m-d H:i:s').'<br/>';
													$datetime1 = new DateTime($Bill->occupied_time->format('Y-m-d H:i:s'));//start time
													$datetime2 = new DateTime($Bill->created_on->format('Y-m-d H:i:s'));//end time
													$interval = $datetime1->diff($datetime2);
													echo $time    = $interval->format('%h')*60+$interval->format('%i') .' min ';
													echo $interval->format('%s sec');
													?>
												</span>
											</td>
											<td>
												<span>Order Type</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?php 
													if($Bill->order_type=='dinner'){ echo "Dine In";} 
													if($Bill->order_type=='takeaway'){ echo "Take Away";} 
													if($Bill->order_type=='delivery'){ echo "Delivery";} 
													?>
												</span>
											</td>
										</tr>
										<tr>
											<td>
												<span>Table No.</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?= h(@$Bill->table->name) ?>
												</span>
											</td>
											<td>
												<span>Prepared by</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?= h(@$Bill->employee->name) ?>
												</span>
											</td>
											<td>
												<span>Customer Code</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?= h(@$Bill->customer->customer_code) ?>
												</span>
											</td>
											<td>
												<span>Customer Mobile</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?= h(@$Bill->customer->mobile_no) ?>
												</span>
											</td>
											<td>
												<span>Customer Name</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?= h(@$Bill->customer->name) ?>
												</span>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr class="main_tr">
								<td style="padding: 0;">
								 	<table width="100%" class="table table-bordered qwerty3" style="margin: 0;" cellpadding="0" cellspacing="0">
								 		<tr>
								 			<th>Item</th>
								 			<th>Quantity</th>
								 			<th>Rate</th>
								 			<th>Amount</th>
								 			<th>Discount %</th>
								 			<th>Discount Rs</th>
								 			<th>Taxable Value</th>
								 			<th>CGST</th>
								 			<th>SGST</th>
								 			<th>Net</th>
								 		</tr>
								 		<?php 
								 		$totalAmount=0;
								 		$totalDisAmount=0;
								 		$totalTV=0;
								 		$totalCGSTAmount=0;
								 		$totalSGSTAmount=0;
								 		$totalNet=0;
								 		foreach ($Bill->bill_rows as $bill_row) { 
								 			$totalAmount+=$bill_row->amount;
								 			$totalDisAmount+=$bill_row->discount_amount;
								 			$totalTV+=round($bill_row->amount-$bill_row->discount_amount,2);
								 			
								 			$totalNet+=$bill_row->net_amount;
								 		?>
								 		<tr>
								 			<td><?php echo $bill_row->item->name; ?></td>
								 			<td><?php echo $bill_row->quantity; ?></td>
								 			<td><?php echo $bill_row->rate; ?></td>
								 			<td><?php echo $bill_row->amount; ?></td>
								 			<td><?php echo $bill_row->discount_per; ?></td>
								 			<td><?php echo $bill_row->discount_amount; ?></td>
								 			<td><?php echo round($bill_row->amount-$bill_row->discount_amount,2); ?></td>
								 			<td>
								 				<?php $GST = ($bill_row->amount-$bill_row->discount_amount)*($bill_row->tax_per)/100;
								 					echo round($GST/2, 2);
								 					$totalCGSTAmount+=round($GST/2, 2);
								 				?>
								 			</td>
								 			<td>
								 				<?php
								 					echo round($GST/2, 2);
								 					$totalSGSTAmount+=round($GST/2, 2);

								 				?>
								 			</td>
								 			<td><?php echo $bill_row->net_amount; ?></td>
								 		</tr>
								 		<?php }?>
								 		<tr>
								 			<th colspan="3">Total</th>
								 			<th><?php echo $totalAmount; ?></th>
								 			<th>-</th>
								 			<th><?php echo $totalDisAmount; ?></th>
								 			<th><?php echo $totalTV; ?></th>
								 			<th><?php echo $totalCGSTAmount; ?></th>
								 			<th><?php echo $totalSGSTAmount; ?></th>
								 			<th><?php echo $totalNet; ?></th>
								 		</tr>
								 	</table>
								 </td>
							</tr>
							<?php endforeach; ?>
							<tfoot>
								<tr>
									<td style="text-align: right;">
										<span>TOTAL DISCOUNT</span>
										<span style="margin-left: 5px; margin-right: 20px;"><b><?php echo @$TOTAL_DISCOUNT; ?></b></span>

										<span>TOTAL TAXABLE</span>
										<span style="margin-left: 5px; margin-right: 20px;"><b><?php echo @$TOTAL_TAXABLE; ?></b></span>

										<span>TOTAL CGST</span>
										<span style="margin-left: 5px; margin-right: 20px;"><b><?php echo @$TOTAL_CGST; ?></b></span>

										<span>TOTAL SGST</span>
										<span style="margin-left: 5px; margin-right: 20px;"><b><?php echo @$TOTAL_SGST; ?></b></span>

										<span>TOTAL SALE</span>
										<span style="margin-left: 5px; "><b><?php echo @$TOTAL_SALE; ?></b></span>
									</td>
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

	
	$('#exportPDF').die().live('click',function(event){
		$('#ExcelForm').submit();
	});

    ComponentsPickers.init();
});
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>

