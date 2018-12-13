<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Daily Report | DOSA PLAZA'); ?>
<style type="text/css" media="print">
a[href]::after {
    content: none !important;
}
</style>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Daily Report
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
				<div align="center">
					<h4><?php echo $coreVariable['company_name']; ?></h4>
					<span><?php echo $coreVariable['company_address']; ?></span><br/>

				</div>
				<div>
					<b>Daily Report</b><br/>
					<b>Month <?php echo @$month; ?></b>
					<b style="float: right;"><?php echo date('d-m-Y H:i A'); ?></b>
				</div>
				<div class="table-scrollable">
					<?php if($date){ ?>
					<table border="1" class="table table-condensed table-hover table-bordered" id="main_table" >
						<thead>
							<tr>
								<th><?= ('S.No.') ?></th>
								<th><?= ('Raw materials') ?></th>
								<th style="text-align: center;"><?= ('Unit') ?></th>
								<th style="text-align: center;"><?= ('Opening stock <br/>(A)') ?></th>
								<th style="text-align: center;"><?= ('Inward/Purchase <br/>(B)') ?></th>
								<th style="text-align: center;"><?= ('Adjustment-Stock in <br/>(C)') ?></th>
								<th style="text-align: center;"><?= ('Total Stock <br/>(A+B+C)') ?></th>
								<th style="text-align: center;"><?= ('Used/Outword Stock <br/>(D)') ?></th>
								<th style="text-align: center;"><?= ('Wastage <br/>(E)') ?></th>
								<th style="text-align: center;"><?= ('Adjustment-Stock out <br/>(F)') ?></th>
								<th style="text-align: center;"><?= ('Total consumed Stock <br/>(D+E+F)') ?></th>
								<th style="text-align: center;"><?= ('Net Stock') ?></th>
							</tr>
						</thead>
						<tbody id="main_tbody">
						<?php $d=0;$x=0; foreach ($RawMaterials as $RawMaterial): ?>
							<tr style="background-color: #d6d6d6;" class="subCatRow" raw_material_sub_category_id="<?= h($RawMaterial->raw_material_sub_category->id) ?>">
								<td colspan="12"   >
									<?= h($RawMaterial->raw_material_sub_category->name) ?>
								</td>
							</tr>
							<tr class="main_tr">
								<td><?= (++$d) ?></td>
								<td style="white-space: nowrap;"><?= h($RawMaterial->name) ?></td>
								<td style="text-align: center;"><?= h($RawMaterial->primary_unit->name) ?></td>
								<td style="text-align: center;"><?php echo ($RawMaterial->total_in_opening - $RawMaterial->total_out_opening) ? ($RawMaterial->total_in_opening - $RawMaterial->total_out_opening) : '' ?></td>
								<td style="text-align: center;"><?= h($RawMaterial->inward) ?></td>
								<td style="text-align: center;">
									<?= $this->Html->Link($RawMaterial->adjustmentIn,'/StockLedgers/userlog?from_date='.$exploded_date_from_to[0].'&to_date='.$exploded_date_from_to[1].'&rm_id='.$RawMaterial->id,['target'=>'blank']) ?>
								</td>
								<td style="text-align: center;">
									<?php 
									$totalInStock=$RawMaterial->total_in_opening - $RawMaterial->total_out_opening + $RawMaterial->inward + $RawMaterial->adjustmentIn;
									?>
									<?php echo ($totalInStock) ? ($totalInStock) : '' ?>
								</td>
								<td style="text-align: center;"><?= h($RawMaterial->used) ?></td>
								<td style="text-align: center;">
									<?= $this->Html->Link($RawMaterial->wastage,'/StockLedgers/userlog?from_date='.$exploded_date_from_to[0].'&to_date='.$exploded_date_from_to[1].'&rm_id='.$RawMaterial->id,['target'=>'blank']) ?>
								</td>
								<td style="text-align: center;">
									<?= $this->Html->Link($RawMaterial->adjustmentOut,'/StockLedgers/userlog?from_date='.$exploded_date_from_to[0].'&to_date='.$exploded_date_from_to[1].'&rm_id='.$RawMaterial->id,['target'=>'blank']) ?>
								</td>
								<td style="text-align: center;">
									<?php 
									$totalConsumedStock=$RawMaterial->used + $RawMaterial->wastage + $RawMaterial->adjustmentOut;
									?>
									<?php echo ($totalConsumedStock) ? ($totalConsumedStock) : '' ?>
								</td>
								<td style="text-align: center;">
									<?php 
									$netStock=$totalInStock - $totalConsumedStock;
									?>
									<?= h($netStock) ?>
								</td>
							</tr>
							<?php $x++; endforeach; ?>
						</tbody>
					</table>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $formAction=$this->Url->build(['controller'=>'RawMaterials','action'=>'dailyReportExcel']); ?>
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

    	var sub_category_id=0;
    	$('.subCatRow').each(function(){
    		var raw_material_sub_category_id= $(this).attr('raw_material_sub_category_id');
			if(sub_category_id!=raw_material_sub_category_id){
				sub_category_id = raw_material_sub_category_id;
			}else{
				$(this).remove();
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