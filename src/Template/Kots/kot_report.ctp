<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'KOT Report | DOSA PLAZA'); ?>
<style type="text/css">
.kotdetail td{
	border: 1px dotted #999;padding: 2px;
}
</style>
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
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title hide_at_print">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								KOT Report
							</div>
						</td>
						<td valign="button">
							<div align="center">
								<form method="GET">
									<table>
										<tr>
											<td>
												<?= $this->Form->control('employee_id',['options' => $employees, 'class' => 'form-control', 'label' => false, 'empty' => '--All--', 'value' => @$employee_id]) ?>
											</td>
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
			<div class="portlet-body">
				<div align="center" class="show_at_print" style="display: none;">
					<h3>KOT HISTORY</h3>
				</div>
				<div class="table-scrollable" id="ExcelPage">
					<?php if($exploded_date_from_to){ ?>
					<div align="center">
						<h4><?php echo $coreVariable['company_name']; ?></h4>
						<span><?php echo $coreVariable['company_address']; ?></span><br/>

					</div>
					<div>
						<b>Bill Wise Sales Report</b><br/>
						<b>Month <?php echo @$month; ?></b>
						<b style="float: right;"><?php echo date('d-m-Y H:i A'); ?></b>
					</div>
					<table width="100%">
						<tbody id="main_tbody">
						<?php 
						$totalAmount = 0;
						foreach ($Kots as $Kot): ?>
							<tr>
								<td style="border-top: solid 1px #8c8c8c;padding: 10px 2px;">
									<table width="100%">
										<tr>
											<td>
												<span style="color: #606062;">KOT No: </span>
												<span style="margin-left: 10px;"> <?= h($Kot->voucher_no) ?> </span>
											</td>
											<td>
												<span style="color: #606062;">Table: </span>
												<span style="margin-left: 10px;"> <?= h(@$Kot->table->name) ?> </span>
											</td>
											<td>
												<span style="color: #606062;">Create on: </span>
												<span style="margin-left: 10px;"> <?= h($Kot->created_on->format('d-m-Y h:i A')) ?> </span>
											</td>
											<td>
												<span style="color: #606062;">Order Type: </span>
												<span style="margin-left: 10px;"> 
												<?php 
												if($Kot->order_type=='dinner'){ echo "Dinner In";} 
												if($Kot->order_type=='takeaway'){ echo "Take Away";} 
												if($Kot->order_type=='delivery'){ echo "Delivery";} 
												?>
												</span>
											</td>
											<td>
												<span style="color: #606062;">Steward: </span>
												<span style="margin-left: 10px;"> <?= h(@$Kot->employee->name) ?> </span>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style="padding: 0 2px 5px 2px;">
									<table width="100%" style="margin: 0;" class="kotdetail">
										<tr>
											<td style="text-align: center;" width="5%">Sr N.</td>
											<td width="40%">Item</td>
											<td style="text-align: center;" width="10%">Quantity</td>
											<td style="text-align: center;" width="10%">Rate</td>
											<td style="text-align: center;" width="10%">Amount</td>
											<td width="25%">Item comment</td>
										</tr>
										<?php $q=0; foreach ($Kot->kot_rows as $kot_row) { ?>
										<tr>
											<td style="text-align: center;"><?php echo ++$q; ?></td>
											<td><?= h($kot_row->item->name) ?></td>
											<td style="text-align: center;"><?= h($kot_row->quantity) ?></td>
											<td style="text-align: center;"><?= h($kot_row->rate) ?></td>
											<td style="text-align: center;">
												<?= h($kot_row->amount) ?>
												<?php
													$totalAmount+=$kot_row->amount;
												?>
											</td>
											<td><?= h($kot_row->item_comment) ?></td>
										</tr>
										<?php } ?>
									</table>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr style="border-top: solid 1px #CCC; ">
								<td>
									<div style="height: 10px;"></div>

									
									<span>TOTAL KOT AMOUNT</span>
									<b><?php echo $Total_Kot_Amount; ?></b>
									<?php if($employee_id){ ?>
										<span style=" margin-left: 15px; ">TOTAL AMOUNT of <?php echo @$Employee->name; ?></span>
										<b><?php echo $totalAmount; ?></b>

										<span style=" margin-left: 15px; ">KOT AMOUNT % of <?php echo @$Employee->name; ?></span>
										<b><?php echo round($totalAmount*100/$Total_Kot_Amount, 2); ?>%</b>
									<?php } ?>
								</td>
							</tr>
						</tfoot>
					</table>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $formAction=$this->Url->build(['controller'=>'kots','action'=>'kotReportExcel']); ?>
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

$js.="
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

?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>

