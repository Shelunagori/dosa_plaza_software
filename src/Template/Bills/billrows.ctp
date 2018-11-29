<tr class="details" bill_id="<?= $bill->id ?>" >
	<td colspan="11">
		<table class="table table-bordered table-condensed">
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
			<?php foreach ($bill->bill_rows as $bill_row) { ?>
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
			<?php } ?>

		</table>
	</td>
</tr>