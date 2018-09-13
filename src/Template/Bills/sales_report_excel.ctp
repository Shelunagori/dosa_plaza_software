<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Sales-Report-".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );

?>
<div align="center">
	<h4><?php echo $coreVariable['company_name']; ?></h4>
	<span><?php echo $coreVariable['company_address']; ?></span><br/>

</div>
<div>
	<b>Bill Wise Sales Report</b><br/>
	<b>From <?php echo @$exploded_date_from_to[0].' To '.@$exploded_date_from_to[1]; ?></b>
	<b style="float: right;"><?php echo date('d-m-Y H:i A'); ?></b>
</div>
<table  border="1">
	<thead>
		<tr>
			<th>Sr.N.</th>
			<th>Bill No.</th>
			<th>Bill Date</th>
			<th>Bill Time</th>
			<th>No of Pax</th>
			<th>Time Taken</th>
			<th>Order Type</th>
			<th>Table No.</th>
			<th>Steward</th>
			<th>Payment Mode</th>
			<th>Customer Code</th>
			<th>Customer Mobile</th>
			<th>Customer Name</th>
			<th>Bill Details</th>
			<th>Round off</th>
			<th>Total Bill Amount</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($Bills as $Bill): ?>
		<tr>
			<td><?= h(++$page_no) ?></td>
			<td><?= h($Bill->voucher_no) ?></td>
			<td><?php echo date('d-m-Y', strtotime($Bill->transaction_date)); ?></td>
			<td><?php echo date('h:i A', strtotime($Bill->created_on)); ?></td>
			<td><?= h($Bill->no_of_pax) ?></td>
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
			<td><?= h(@$Bill->table->name) ?></td>
			<td><?= h(@$Bill->employee->name) ?></td>
			<td><?= h(@$Bill->payment_type) ?></td>
			<td><?= h(@$Bill->customer->customer_code) ?></td>
			<td><?= h(@$Bill->customer->mobile_no) ?></td>
			<td><?= h(@$Bill->customer->name) ?></td>
			<td style="padding: 0;">
			 	<table  border="1">
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
			 	</table>
			 </td>
			 <td><?= h(@$Bill->round_off) ?></td>
			 <td><?= h(@$Bill->grand_total) ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>