<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Sales Summary Order Type Wise | DOSA PLAZA'); ?>
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
					Sales Summary Order Type Wise
				</div>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">
				<?php $formAction=$this->Url->build(['controller'=>'Bills','action'=>'salesSummaryOrderWise']); ?>
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
											<select class="form-control" name="order_type">
												<option value=""></option>
												<option value="dinner">Dinner In</option>
												<option value="takeaway">Take Away</option>
												<option value="delivery">Delivery</option>
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
						<b>Sales Summary Order Type Wise</b><br/>
						<b>From <?php echo @$exploded_date_from_to[0].' To '.@$exploded_date_from_to[1]; ?></b>
						<br/>Generated on:<b><?php echo date('d-m-Y H:i A'); ?></b>
					</div>
					<hr>
					<?php if($order_type=='dinner' or $order_type==''){ ?>
						<div>
							<b>DINNER IN</b>	
							<table class="table table-bordered table-condensed" border="1" cellpadding="0" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Bill No</th>
										<th>Bill Date</th>
										<th>Bill Time</th>
										<th>Payment Mode</th>
										<th>Steward</th>
										<th>Bill Amount</th>
									</tr>
								</thead>
								<tbody id="main_tbody">
								<?php foreach ($dinnerBills as $dinnerBill): ?>
									<tr class="main_tr">
										<td><?= h($dinnerBill->voucher_no) ?></td>
										<td><?php echo date('d-m-Y', strtotime($dinnerBill->transaction_date)); ?></td>
										<td><?php echo date('h:i A', strtotime($dinnerBill->created_on)); ?></td>
										<td><?= h(@$dinnerBill->payment_type) ?></td>
										<td><?= h(@$dinnerBill->employee->name) ?></td>
										<td><?= h(@$dinnerBill->grand_total) ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php } ?>

					<?php if($order_type=='delivery' or $order_type==''){ ?>
						<div>
							<b>DELIVERY</b>	
							<table class="table table-bordered table-condensed" border="1" cellpadding="0" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Bill No</th>
										<th>Bill Date</th>
										<th>Bill Time</th>
										<th>Payment Mode</th>
										<th>Steward</th>
										<th>Bill Amount</th>
									</tr>
								</thead>
								<tbody id="main_tbody">
								<?php foreach ($deliveryBills as $deliveryBill): ?>
									<tr class="main_tr">
										<td><?= h($deliveryBill->voucher_no) ?></td>
										<td><?php echo date('d-m-Y', strtotime($deliveryBill->transaction_date)); ?></td>
										<td><?php echo date('h:i A', strtotime($deliveryBill->created_on)); ?></td>
										<td><?= h(@$dinnerBill->payment_type) ?></td>
										<td><?= h(@$deliveryBill->employee->name) ?></td>
										<td><?= h(@$deliveryBill->grand_total) ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php } ?>

					<?php if($order_type=='takeaway' or $order_type==''){ ?>
						<div>
							<b>TAKE AWAY</b>	
							<table class="table table-bordered table-condensed" border="1" cellpadding="0" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Bill No</th>
										<th>Bill Date</th>
										<th>Bill Time</th>
										<th>Payment Mode</th>
										<th>Steward</th>
										<th>Bill Amount</th>
									</tr>
								</thead>
								<tbody id="main_tbody">
								<?php foreach ($takeawayBills as $takeawayBill): ?>
									<tr class="main_tr">
										<td><?= h($takeawayBill->voucher_no) ?></td>
										<td><?php echo date('d-m-Y', strtotime($takeawayBill->transaction_date)); ?></td>
										<td><?php echo date('h:i A', strtotime($takeawayBill->created_on)); ?></td>
										<td><?= h(@$dinnerBill->payment_type) ?></td>
										<td><?= h(@$takeawayBill->employee->name) ?></td>
										<td><?= h(@$takeawayBill->grand_total) ?></td>
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