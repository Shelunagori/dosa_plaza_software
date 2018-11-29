<style type="text/css">
	.panel-primary > .panel-heading{
		color: #FFF;
	    background-color: #337ab7;
	    border-color: #337ab7;
	}
	.panel-body{
		padding: 0;
	}
	.table{
		margin: 0;
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
</style>
<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Daily Sales and Inventory | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title hide_at_print">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Daily Sales and Inventory
							</div>
						</td>
						<td valign="button">
							<div align="center">
								<form method="GET">
									<table>
										<tr>
											<td>
												<?php 
												if(@$date=="01-01-1970" or $date==""){
													$PrintDate = "";
												}else{
													$PrintDate = date('d-m-Y', strtotime($date));
												} ?>
												<input name="date" class="form-control date-picker" type="text" value="<?php echo $PrintDate; ?>" data-date-format="dd-mm-yyyy" required="required" placeholder="Date">
											</td>
											<td>
												<button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;">GO</button>
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
				<div align="center">
					<h4><?php echo $coreVariable['company_name']; ?></h4>
					<span><?php echo $coreVariable['company_address']; ?></span><br/>
				</div>
				<div>
					<b>Daily Sales and Inventory</b><br/>
					<b>Date <?php echo @$date; ?></b>
					<b style="float: right;"><?php echo date('d-m-Y H:i A'); ?></b>
				</div>
				<div >
					<?php if($date){ ?>
						<?php foreach ($ItemSubCategories as $ItemSubCategory) { ?>
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title"><?php echo $ItemSubCategory->name; ?></h3>
								</div>
								<div class="panel-body">
									<div class="table-scrollable">
										<table class="table table-condensed table-bordered table-hover">
											<thead>
												<tr>
													<th rowspan="2"><b>Item</b></th>
													<th rowspan="2" style="text-align: center;"><b>Sale Qty</b></th>
													<?php foreach ($receipeMatrials[$ItemSubCategory->id] as $raw_material_id=>$raw_material) { ?>
													<th style="text-align: center;"><b><?php echo $raw_material->name; ?></b></th>
													<?php } ?>
												</tr>
												<tr>
													<?php foreach ($receipeMatrials[$ItemSubCategory->id] as $raw_material_id=>$raw_material) { ?>
													<th style="text-align: center;"><b><?php echo $raw_material->primary_unit->name; ?></b></th>
													<?php } ?>
												</tr>
											</thead>
											<tbody class="tbody">
												<?php foreach ($ItemSubCategory->items as $item) {
													$itemReceipe=[];
													foreach ($item->item_rows as $item_row) {
														$itemReceipe[$item_row->raw_material_id]=$item_row->quantity;
													}
													if($billItems[$item->id]){ ?>
														<tr>
															<td><?= h($item->name) ?></td>
															<td style="text-align: center;"><?= h($billItems[$item->id]) ?></td>
															<?php 
															//$total=0;
															foreach ($receipeMatrials[$ItemSubCategory->id] as $raw_material_id=>$raw_material) { ?>
																<td style="text-align: center;">
																	<?php if($itemReceipe[$raw_material_id]){
																		echo $itemReceipe[$raw_material_id]*$billItems[$item->id];
																		$total[$raw_material_id]+=$itemReceipe[$raw_material_id]*$billItems[$item->id];
																	}else{
																		echo '-';
																	} ?>
																</td>
															<?php } ?>
														</tr>
													<?php } ?>
												<?php } ?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2" style="text-align: right;"><b>Total</b></td>
													<?php
													foreach ($receipeMatrials[$ItemSubCategory->id] as $raw_material_id => $raw_material) { ?>
														<td style="text-align: center;"><b><?php echo @$total[$raw_material_id]; ?></b></td>
													<?php } ?>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						<?php } ?>

						<div class="portlet box red">
							<div class="portlet-title">
								<div class="caption">
									Actual consumption from daily inventory report
								</div>
							</div>
							<div class="portlet-body">
								<table border="1" class="table table-bordered table-str">
									<thead>
										<tr>
											<th>Raw Material</th>
											<th>Consumption</th>
										</tr>
									</thead>
									<tbody id="main_tbody">
									<?php foreach ($InventoryRecords as $InventoryRecord): ?>
										<tr class="main_tr">
											<td><?= h($InventoryRecord->item_list->name) ?></td>
											<td><?= h($InventoryRecord->total_consumption) ?> <?= h($InventoryRecord->item_list->unit) ?></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					<?php } ?>
				</div>
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
	$('.tbody').each(function(){
		var l=$(this).find('tr').length;
		if(l==0){
			$(this).closest('div.panel-primary').remove();
		}
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