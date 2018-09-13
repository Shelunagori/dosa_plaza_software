<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'KOT Delete History Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								KOT Delete History Report
							</div>
						</td>
						<td valign="button">
							<div align="center">
								<form method="GET">
									<table>
										<tr>
											<td>
												<input name="from_date" class="form-control date-picker" type="text" value="<?php echo @$from_date; ?>" data-date-format="dd-mm-yyyy" required="required" placeholder="From Date">
											</td>
											<td>
												<input name="to_date" class="form-control date-picker" type="text" value="<?php echo @$to_date; ?>" data-date-format="dd-mm-yyyy" required="required" placeholder="To Date">
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
				<div class="table-scrollable" id="ExcelPage">
					<?php if($from_date && $to_date){ ?>
					<div align="center">
						<h4><?php echo $coreVariable['company_name']; ?></h4>
						<span><?php echo $coreVariable['company_address']; ?></span><br/>

					</div>
					<div>
						<b>Bill Wise Sales Report</b><br/>
						<b>Month <?php echo @$month; ?></b>
						<b style="float: right;"><?php echo date('d-m-Y H:i A'); ?></b>
					</div>
					<table border="1" class="table table-bordered table-str">
						<thead>
							<tr>
								<th style="text-align: center;">S.No.</th>
								<th style="text-align: center;">KOT No.</th>
								<th style="text-align: center;">Table</th>
								<th style="text-align: center;">Created on</th>
								<th style="text-align: center;">Details</th>
							</tr>
						</thead>
						<tbody id="main_tbody">
						<?php $x=0; foreach ($Kots as $Kot): ?>
							<?php if($Kot->deleted_rows>0){ ?>
							<tr class="main_tr">
								<td style="text-align: center;"><?= (++$x) ?></td>
								<td style="text-align: center;"><?= h($Kot->voucher_no) ?></td>
								<td style="text-align: center;"><?= h(@$Kot->table->name) ?></td>
								<td style="text-align: center;"><?= h($Kot->created_on->format('d-m-Y h:i A')) ?></td>
								<td style="padding: 0;">
									<table class="table table-bordered table-condensed" width="100%" style="margin: 0;">
										<tr>
											<td>Item</td>
											<td style="text-align: center;">Quantity</td>
											<td style="text-align: center;">Rate</td>
											<td style="text-align: center;">Amount</td>
											<td>Item comment</td>
											<td style="text-align: center;">Delete Time</td>
											<td>Delete comment</td>
										</tr>
										<?php foreach ($Kot->kot_rows as $kot_row) { ?>
										<tr>
											<td><?= h($kot_row->item->name) ?></td>
											<td style="text-align: center;"><?= h($kot_row->quantity) ?></td>
											<td style="text-align: center;"><?= h($kot_row->rate) ?></td>
											<td style="text-align: center;"><?= h($kot_row->amount) ?></td>
											<td><?= h($kot_row->item_comment) ?></td>
											<td style="text-align: center;"><?= h($kot_row->delete_time->format('d-m-Y h:i A')) ?></td>
											<td><?= h($kot_row->delete_comment) ?></td>
										</tr>
										<?php } ?>
									</table>
								</td>
							</tr>
							<?php } ?>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $formAction=$this->Url->build(['controller'=>'kots','action'=>'deleteReportExcel']); ?>
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

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>