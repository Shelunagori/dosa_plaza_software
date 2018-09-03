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
.qwerty td{
		border: none;
	}
</style>

<?php $this->set("title", 'Bill Wise Sales Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title hide_at_print">

				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Bill Wise Sales Report
							</div>
						</td>
						<td valign="button">
							<div align="center">
								<form method="GET">
									<table>
										<tr>
											<td>
												<input type="date" class="form-control" name="from_date" value="<?php echo $from_date; ?>" required />
											</td>
											<td>
												<input type="date" class="form-control" name="to_date" value="<?php echo $to_date; ?>" required />
											</td>
											<td>
												<button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;" >GO</button>
											</td>
										</tr>
									</table>
								</form>
							</div>
						</td>
						<td width="20%"></td>
					</tr>
				</table>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">
				<?php if($from_date && $to_date){ ?>
				<div class="table-scrollable">
					<table class="table table-bordered qwerty">
						<?php foreach ($Bills as $Bill): ?>
							<tr>
								<td>
									<table width="100%">
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
														$datetime1 = new DateTime($Bill->occupied_time);//start time
														$datetime2 = new DateTime($Bill->created_on);//end time
														$interval = $datetime1->diff($datetime2);
														echo $interval->format(' %i min %s sec');
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
											<td>
												<span>Customer Code</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?= h(@$Bill->customer->customer_code) ?>
												</span>
											</td>
											<td>
												<span>Customer Mobile</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?= h(@$Bill->customer->mobile_no) ?>
												</span>
											</td>
											<td>
												<span>Customer Name</span> 
												<span style="margin-left: 10px;color: #313131;">
													<?= h(@$Bill->customer->name) ?>
												</span>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr class="main_tr">
								<td style="padding: 0;">
								 	<table width="100%" class="table table-bordered" style="margin: 0;">
								 		<tr>
								 			<th>Item</th>
								 			<th>Quantity</th>
								 			<th>Rate</th>
								 			<th>Amount</th>
								 			<th>Discount %</th>
								 			<th>Discount Rs</th>
								 			<th>Taxable Value</th>
								 			<th>GST %</th>
								 			<th>GST Rs</th>
								 			<th>Net</th>
								 		</tr>
								 		<?php 
								 		$totalAmount=0;
								 		$totalDisAmount=0;
								 		$totalTV=0;
								 		$totalGSTAmount=0;
								 		$totalNet=0;
								 		foreach ($Bill->bill_rows as $bill_row) { 
								 			$totalAmount+=$bill_row->amount;
								 			$totalDisAmount+=$bill_row->discount_amount;
								 			$totalTV+=round($bill_row->amount-$bill_row->discount_amount,2);
								 			$totalGSTAmount+=round(($bill_row->amount-$bill_row->discount_amount)*($bill_row->tax_per)/100,2);
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
								 			<td><?php echo $bill_row->tax_per; ?></td>
								 			<td><?php echo round(($bill_row->amount-$bill_row->discount_amount)*($bill_row->tax_per)/100,2); ?></td>
								 			<td><?php echo $bill_row->net_amount; ?></td>
								 		</tr>
								 		<?php }?>
								 		<tr>
								 			<th colspan="3">Total</th>
								 			<th><?php echo $totalAmount; ?></th>
								 			<th>-</th>
								 			<th><?php echo $totalDisAmount; ?></th>
								 			<th><?php echo $totalTV; ?></th>
								 			<th>-</th>
								 			<th><?php echo $totalGSTAmount; ?></th>
								 			<th><?php echo $totalNet; ?></th>
								 		</tr>
								 		<tr>
								 			<th colspan="9" style="text-align: right;">Round off</th>
								 			<th><?= h(@$Bill->round_off) ?></th>
								 		</tr>
								 		<tr>
								 			<th colspan="9" style="text-align: right;">Total Bill Amount</th>
								 			<th><?= h(@$Bill->grand_total) ?></th>
								 		</tr>
								 	</table>
								 </td>
							</tr>
							<?php endforeach; ?>
					</table>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

