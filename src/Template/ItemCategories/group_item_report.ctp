<?php $this->set("title", 'Item Group + Item Wise Sales Report | DOSA PLAZA'); ?>
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
<div align="center" class="hide_at_print">
	<br/>
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
<br/>
<div style="background-color: #FFF;padding: 10px 10px;">
	<div align="center">
		<span style="font-size: 16px;">Item Group + Item Wise Sales Report</span>
	</div>

	<?php foreach ($ItemCategories as $ItemCategory) { ?>
		<div style="font-size: 14px;background-color: #2d4161;color:  #FFF;padding: 6px;margin-top: 10px;"><?= h($ItemCategory->name) ?></div>
		<div class="table-scrollable" style="margin: 0 !important;">
			<table class="table table-condensed table-striped">
					<tr>
						<th>Item</td>
						<td style="width: 10%; text-align: center;">Quantity</td>
						<td style="width: 10%; text-align: center;">Amount</td>
						<td style="width: 10%; text-align: center;">Discount</td>
						<td style="width: 10%; text-align: center;">Taxable</td>
						<td style="width: 10%; text-align: center;">GST</td>
						<td style="width: 10%; text-align: center;">Net Value</td>
					</tr>
				<?php 
				foreach ($ItemCategory->item_sub_categories as $item_sub_category) {
					foreach ($item_sub_category->items as $item) { ?>
						<tr>
							<td><?= h($item->name) ?></td>
							<td style="text-align: center;"><?= h($item->Total_qty) ?></td>
							<td style="text-align: center;"><?= h($item->Total_Amount) ?></td>
							<td style="text-align: center;"><?= h($item->Total_Discount) ?></td>
							<td style="text-align: center;">
								<?php 
								($Taxable = $item->Total_Amount - $item->Total_Discount);
								echo ($Taxable)?$Taxable:''
								?>
							</td>
							<td style="text-align: center;">
								<?php 
								($GST = $item->Total_Net - $Taxable);
								echo ($GST)?$GST:''
								?>
							</td>
							<td style="text-align: center;"><?= h($item->Total_Net) ?></td>
						</tr>
					<?php }
				} ?>
			</table>
		</div>
	<?php } ?>
</div>