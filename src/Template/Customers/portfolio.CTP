<style type="text/css">
	.titleSpan{
		color: #4e4e4e;
	}
	.valueSpan{
		margin-left: 7px;font-weight: 600;
	}
</style>
<div style="background-color: white;border: solid 1px #CCC;overflow:  auto;margin: 10px;padding: 10px">
	<div class="raw">
		<div class="col-md-3">
			<span class="titleSpan">Name</span>
			<span class="valueSpan"><?= $Customer->name ?></span>
		</div>
		<div class="col-md-3">
			<span class="titleSpan">Mobile</span>
			<span class="valueSpan"><?= $Customer->mobile_no ?></span>
		</div>
		<div class="col-md-3">
			<span class="titleSpan">Code</span>
			<span class="valueSpan"><?= $Customer->customer_code ?></span>
		</div>
		<div class="col-md-3">
			<span class="titleSpan">Date of Birth</span>
			<span class="valueSpan"><?= $Customer->dob ?></span>
		</div>
	</div>
	<div class="raw" style=" margin-top: 30px; ">
		<div class="col-md-3">
			<span class="titleSpan">Email</span>
			<span class="valueSpan"><?= $Customer->email ?></span>
		</div>
		<div class="col-md-3">
			<span class="titleSpan">Date of Anniversary</span>
			<span class="valueSpan"><?= $Customer->anniversary ?></span>
		</div>
		<div class="col-md-3">
			<span class="titleSpan">Address</span>
			<span class="valueSpan"><?= $Customer->address ?></span>
		</div>
	</div>
</div>

<div style="background-color: white;border: solid 1px #CCC;overflow:  auto;margin: 10px;padding: 10px">
	<div class="pull-right">
		<input id="search3"  class="form-control" type="text" placeholder="Search" >
	</div>
	<div class="table-scrollable" >
		<table class="table table-bordered qwerty" cellpadding="0" cellspacing="0">
			<tr>
				<th>Bill No</th>
				<th>Bill Date</th>
				<th>No. of Pax</th>
				<th>Time Taken</th>
				<th>Order Type</th>
				<th>Table No</th>
				<th>Steward</th>
				<th></th>
			</tr>
			<?php 
			$TOTAL_SALE=0;
			$TOTAL_CGST=0;
			$TOTAL_SGST=0;
			$TOTAL_TAXABLE=0;
			$TOTAL_DISCOUNT=0;
			foreach ($Bills as $Bill): ?>
				<tr row_no="<?php echo $Bill->id; ?>" class="firstRow" >
					<td>
						RBL-<?php echo str_pad($Bill->voucher_no, 6, "0", STR_PAD_LEFT); ?>		
					</td>
					<td>
						<?php echo date('d-m-Y', strtotime($Bill->transaction_date)); ?>
						<?php echo date(' H:i A', strtotime($Bill->created_on)); ?>
					</td>
					<td>
						<?= h($Bill->no_of_pax) ?>
					</td>
					<td>
						<?php 
						$Bill->occupied_time->format('Y-m-d H:i:s').'<br/>';
						$Bill->created_on->format('Y-m-d H:i:s').'<br/>';
						$datetime1 = new DateTime($Bill->occupied_time->format('Y-m-d H:i:s'));//start time
						$datetime2 = new DateTime($Bill->created_on->format('Y-m-d H:i:s'));//end time
						$interval = $datetime1->diff($datetime2);
						echo $time    = $interval->format('%h')*60+$interval->format('%i') .' min ';
						echo $interval->format('%s sec');
						?>
					</td>
					<td>
						<?php 
						if($Bill->order_type=='dinner'){ echo "Dine In";} 
						if($Bill->order_type=='takeaway'){ echo "Take Away";} 
						if($Bill->order_type=='delivery'){ echo "Delivery";} 
						?>
					</td>
					<td>
						<?= h(@$Bill->table->name) ?>
					</td>
					<td>
						<?= h(@$Bill->employee->name) ?>
					</td>
					<td>
						<button type="button" class="btn btn-xs viewBill">View Bill</button>
					</td>
				</tr>
				<tr row_no="<?php echo $Bill->id; ?>" class="SecondRow" style="display: none;">
					<td style="padding: 0;" colspan="8">
					 	<table width="100%" class="table table-condensed qwerty3" style="margin: 0;" cellpadding="0" cellspacing="0">
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
					 		<tr>
					 			<th colspan="9" style="text-align: right;">Round off</th>
					 			<th><?= h(@$Bill->round_off) ?></th>
					 		</tr>
					 		<tr>
					 			<th colspan="9" style="text-align: right;">Total Bill Amount</th>
					 			<th>
					 				<?= h(@$Bill->grand_total) ?>
					 				<?php
					 				$TOTAL_DISCOUNT+=@$totalDisAmount;
					 				$TOTAL_CGST+=@$totalCGSTAmount;
					 				$TOTAL_SGST+=@$totalSGSTAmount;
					 				$TOTAL_SALE+=@$Bill->grand_total;
					 				$TOTAL_TAXABLE+=@$totalTV;
					 				?>
					 			</th>
					 		</tr>
					 	</table>
					 </td>
				</tr>
				<?php endforeach; ?>
				<tfoot>
					<tr>
						<td style="text-align: right;" colspan="8">
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
</div>
<!-- BEGIN PAGE LEVEL STYLES -->
<!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- BEGIN VALIDATEION -->
    <?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>

    <!-- END VALIDATEION --> 
<!-- END PAGE LEVEL SCRIPTS -->

<?php 
$js="
$(document).ready(function() {
    $('.viewBill').die().live('click',function(event){
    	var row_no = $(this).closest('tr.firstRow').attr('row_no');
    	if($('.SecondRow[row_no='+row_no+']:visible').length){
    		$(this).closest('tr.firstRow').css('background-color','#FFF');
    		$('.SecondRow[row_no='+row_no+']').hide();
		}else{
			$(this).closest('tr.firstRow').css('background-color','#abb2ff');
			$('.SecondRow[row_no='+row_no+']').show();
		}
    });

    var rows = $('.qwerty tr.firstRow');
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

});
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>

