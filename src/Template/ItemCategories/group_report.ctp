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
<style>
	.groupHeading{
		font-size: 14px;background-color: #2d4161;color:  #FFF;padding: 6px;
	}
</style>
<div align="center" class="hide_at_print">
	<br/>
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
<br/>
<a href="javascript:void()" id="exportPDF" class="btn btn-danger" style="float: right; margin-left: 10px;">PDF</a>
<a href="javascript:void()" id="exportExcel" class="btn btn-danger" style="float: right;">Excel</a>
<div style="background-color: #FFF;padding: 10px 10px;" id="ExcelPage">
	
	<div align="center">
		<h4><?php echo $coreVariable['company_name']; ?></h4>
		<span><?php echo $coreVariable['company_address']; ?></span><br/>

	</div>
	<div>
		<span>Item Group + Sub-Group Wise Sales Report</span><br/>
		<span>From <?php echo @$exploded_date_from_to[0].' To '.@$exploded_date_from_to[1]; ?></span><br/>
		<span ><?php echo date('d-m-Y H:i A'); ?></span>

	</div>
	<hr>
	<?php if($date_from_to){ ?>
	<?php foreach ($ItemCategories as $ItemCategory) { ?>
		
		<div >
			<table border="1" width="100%" class="table table-condensed table-striped" cellpadding="0" cellspacing="0">
					<tr>
						<th colspan="8" style="padding: 0 !important;">

							<div class="groupHeading">
								<?= h($ItemCategory->name) ?>
							</div>
						</td>
					</tr>
					<tr>
						<th>Sub-Group</td>
						<td style="width: 10%; text-align: center;">Quantity</td>
						<td style="width: 10%; text-align: center;">Amount</td>
						<td style="width: 10%; text-align: center;">Discount</td>
						<td style="width: 10%; text-align: center;">Taxable</td>
						<td style="width: 10%; text-align: center;">CGST</td>
						<td style="width: 10%; text-align: center;">SGST</td>
						<td style="width: 10%; text-align: center;">Net Value</td>
					</tr>
				<?php foreach ($ItemCategory->item_sub_categories as $item_sub_category) { ?>
					<tr >
						<td><?= h($item_sub_category->name) ?></td>
						<td style="width: 10%; text-align: center;">
							<?php 
							$Total_qty=0;
							foreach ($item_sub_category->items as $item) {
								$Total_qty+=$item->Total_qty;
							} 
							echo $Total_qty;
							?>
						</td>
						<td style="width: 10%; text-align: center;">
							<?php 
							$Total_Amount=0;
							foreach ($item_sub_category->items as $item) {
								$Total_Amount+=$item->Total_Amount;
							} 
							echo $Total_Amount;
							?>
						</td>
						<td style="width: 10%; text-align: center;">
							<?php 
							$Total_Discount=0;
							foreach ($item_sub_category->items as $item) {
								$Total_Discount+=$item->Total_Discount;
							} 
							echo $Total_Discount;

							$Total_Net=0;
							foreach ($item_sub_category->items as $item) {
								$Total_Net+=$item->Total_Net;
							} 
							?>
						</td>
						<td style="width: 10%; text-align: center;"><?php echo $Taxable = $Total_Amount - $Total_Discount; ?></td>
						<td style="width: 10%; text-align: center;"><?php $GST = $Total_Net - $Taxable; ?><?php echo round($GST/2, 2); ?></td>
						<td style="width: 10%; text-align: center;"><?php echo round($GST/2, 2); ?></td>
						<td style="width: 10%; text-align: center;" class="NetValue">
							<?php echo $Total_Net; ?>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	<?php } ?>
	<?php } ?>
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

    	$('.table-condensed').each(function(){
			$('tr').each(function(){
				var l = $(this).find('td.NetValue').length;
				if(l==1){
					var net = parseFloat($(this).find('td.NetValue').text());
					if(net==0){
						$(this).remove();
					}
				}
			});
		});

		$('.table-condensed').each(function(){
			var l = $(this).find('tr').length;
			if(l==2){
				$(this).remove();
			}
		});


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
		
	});
	";

$js.="
$(document).ready(function() {
    ComponentsPickers.init();
});
";

?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>