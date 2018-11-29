<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Sales Summary Payment Wise | DOSA PLAZA'); ?>
<style type="text/css" media="print">
@page {
	width:100%;
	size: auto;   /* auto is the initial value */
	margin: 0px 0px 0px 0px;  /* this affects the margin in the printer settings */
}
.hide_at_print {
	display:none !important;
}
</style>

<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title hide_at_print">
				<div class="caption"style="padding:13px; color: red;">
					Sales Summary Payment Wise
				</div>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">
				<?php $formAction=$this->Url->build(['controller'=>'Bills','action'=>'salesSummaryPaymentWise']); ?>
				<form method="GET" action="<?php echo $formAction; ?>" id="FilterBox" class="hide_at_print" >
					<table width="100%">
						<tr>
							<td width="50%">
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
											<select class="form-control" name="payment_type">
												<option value="">All</option>
												<option value="cash">cash</option>
												<option value="card">card</option>
												<option value="paytm">paytm</option>
											</select>
										</td>
										<td style="padding-left: 10px;">
											<div align="center"><button type="submit" class="btn btn-danger">GO</button></div>
										</td>
									</tr>
								</table>
							</td>
							<td>
								<div align="right" class="pull-right">
									<a href="javascript:void()" id="exportPDF" class="btn btn-danger" style="float: right; margin-left: 10px;">PDF</a>
									<a href="javascript:void()" id="exportExcel" class="btn btn-danger" style="float: right;">Excel</a>
								</div>
							</td>
						</tr>
					</table>
				</form>
				<div id="ExcelPage">
					<div align="center">
						<h4><?php echo $coreVariable['company_name']; ?></h4>
						<span><?php echo $coreVariable['company_address']; ?></span><br/>
					</div>
					<div>
						<b>Sales Summary Payment Wise</b><br/>
						<b>From <?php echo @$exploded_date_from_to[0].' To '.@$exploded_date_from_to[1]; ?></b>
						<br/>Generated on: <b><?php echo date('d-m-Y H:i A'); ?></b>
					</div>
					<hr>
					<?php if($payment_type=='cash' or $payment_type==''){ ?>
						<div>
							<b>CASH</b>	
							<table border="1" class="table table-bordered table-condensed" cellpadding="0" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Bill No</th>
										<th>Bill Date</th>
										<th>Bill Time</th>
										<th>Order Type</th>
										<th>Steward</th>
										<th>Bill Amount</th>
									</tr>
								</thead>
								<tbody id="main_tbody">
								<?php foreach ($CashBills as $CashBill): ?>
									<tr class="main_tr">
										<td><?= h($CashBill->voucher_no) ?></td>
										<td><?php echo date('d-m-Y', strtotime($CashBill->transaction_date)); ?></td>
										<td><?php echo date('h:i A', strtotime($CashBill->created_on)); ?></td>
										<td>
											<?php 
											if($CashBill->order_type=='dinner'){ echo "Dine In";} 
											if($CashBill->order_type=='takeaway'){ echo "Take Away";} 
											if($CashBill->order_type=='delivery'){ echo "Delivery";} 
											?>
										</td>
										<td><?= h(@$CashBill->employee->name) ?></td>
										<td><?= h(@$CashBill->grand_total) ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php } ?>

					<?php if($payment_type=='card' or $payment_type==''){ ?>
						<div>
							<b>CARD</b>	
							<table border="1" class="table table-bordered table-condensed" cellpadding="0" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Bill No</th>
										<th>Bill Date</th>
										<th>Bill Time</th>
										<th>Order Type</th>
										<th>Steward</th>
										<th>Bill Amount</th>
									</tr>
								</thead>
								<tbody id="main_tbody">
								<?php foreach ($CardBills as $CardBill): ?>
									<tr class="main_tr">
										<td><?= h($CardBill->voucher_no) ?></td>
										<td><?php echo date('d-m-Y', strtotime($CardBill->transaction_date)); ?></td>
										<td><?php echo date('h:i A', strtotime($CardBill->created_on)); ?></td>
										<td>
											<?php 
											if($CardBill->order_type=='dinner'){ echo "Dine In";} 
											if($CardBill->order_type=='takeaway'){ echo "Take Away";} 
											if($CardBill->order_type=='delivery'){ echo "Delivery";} 
											?>
										</td>
										<td><?= h(@$CardBill->employee->name) ?></td>
										<td><?= h(@$CardBill->grand_total) ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php } ?>

					<?php if($payment_type=='paytm' or $payment_type==''){ ?>
						<div>
							<b>PAYTM</b>	
							<table border="1" class="table table-bordered table-condensed" cellpadding="0" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Bill No</th>
										<th>Bill Date</th>
										<th>Bill Time</th>
										<th>Order Type</th>
										<th>Steward</th>
										<th>Bill Amount</th>
									</tr>
								</thead>
								<tbody id="main_tbody">
								<?php foreach ($PaytmBills as $PaytmBill): ?>
									<tr class="main_tr">
										<td><?= h($PaytmBill->voucher_no) ?></td>
										<td><?php echo date('d-m-Y', strtotime($PaytmBill->transaction_date)); ?></td>
										<td><?php echo date('h:i A', strtotime($PaytmBill->created_on)); ?></td>
										<td>
											<?php 
											if($PaytmBill->order_type=='dinner'){ echo "Dine In";} 
											if($PaytmBill->order_type=='takeaway'){ echo "Take Away";} 
											if($PaytmBill->order_type=='delivery'){ echo "Delivery";} 
											?>
										</td>
										<td><?= h(@$PaytmBill->employee->name) ?></td>
										<td><?= h(@$PaytmBill->grand_total) ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>


<?php $formAction=$this->Url->build(['controller'=>'ItemCategories','action'=>'groupReportExcel']); ?>
<form method="POST" action="<?php echo $formAction; ?>" id="ExcelForm" style="display: none;">
	<textarea id="ExcelBox" name="excel_box"></textarea>
	<button type="submit">EXCEL</button>
</form>

<?php $formAction=$this->Url->build(['controller'=>'ItemCategories','action'=>'groupReportPdf']); ?>
<form method="POST" action="<?php echo $formAction; ?>" id="PDFForm" style="display: none;">
	<textarea id="PDFBox" name="pdf_box"></textarea>
	<button type="submit">EXCEL</button>
</form>


<style type="text/css">
.qwerty td{
	white-space: nowrap;
}
.qwerty th{
	white-space: nowrap;
}
</style>

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

	var ht = $('#ExcelPage').html();
	$('#PDFBox').html(ht);

	
	$('#exportPDF').die().live('click',function(event){
		$('#PDFForm').submit();
	});


    ComponentsPickers.init();
});
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>