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
									<span>Steward</span> 
									<span style="margin-left: 10px;color: #313131;">
										<?= h(@$Bill->employee->name) ?>
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
</div>

