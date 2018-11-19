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
<?php $this->set("title", 'Average Bill Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title hide_at_print">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Average Bill Report
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
					<b>Average Bill Report</b><br/>
					<b>From <?php echo @$exploded_date_from_to[0].' To '.@$exploded_date_from_to[1]; ?></b><br/>
					<b><?php echo date('d-m-Y H:i A'); ?></b>
				</div>
				<div class="table-scrollable">
				<table class="table table-bordered table-str qwerty3" width="100%" border="1" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>Date</th>
							<th>Total Sale</th>
							<th>Total No. of Pax</th>
							<th>Per Pax Cost</th>
						</tr>
					</thead>
					<tbody id="main_tbody">
					<?php 
					$ColumnGrand_total = 0;
					$ColumnPax = 0;
					$start_date=date('Y-m-d', strtotime($exploded_date_from_to[0]));
					$end_date=date('Y-m-d', strtotime($exploded_date_from_to[1]));
					while (strtotime($start_date) <= strtotime($end_date)) { 
						if($data[strtotime($start_date)]['grand_total']){ ?>
			                <tr class="main_tr">
								<td><?php echo date('d-m-Y', strtotime($start_date)); ?></td>
								<td><?php echo $data[ strtotime($start_date) ]['grand_total']; ?></td>
								<td><?php echo $data[ strtotime($start_date) ]['no_of_pax']; ?></td>
								<td>
									<?php
									if($data[ strtotime($start_date) ]['no_of_pax']>0){
										echo round($data[ strtotime($start_date) ]['grand_total']/$data[ strtotime($start_date) ]['no_of_pax'], 2);
									}else{
										echo '-';
									}
									?>
								</td>
							</tr>
						<?php
						$ColumnGrand_total+=$data[ strtotime($start_date) ]['grand_total'];
						$ColumnPax+=$data[ strtotime($start_date) ]['no_of_pax'];
						} 
						$start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
					}?>
					</tbody>
					<tfoot>
						<tr>
							<th style="text-align: right;">Total</th>
							<th><?php echo $ColumnGrand_total; ?></th>
							<th><?php echo $ColumnPax; ?></th>
							<th>
								<?php
								if($ColumnPax>0){
									echo round($ColumnGrand_total/$ColumnPax, 2);
								}else{
									echo '-';
								}
								?>
							</th>
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