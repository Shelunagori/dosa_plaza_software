<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Date-wise-sales-report-".$date.'_'.$time;

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
<table border="1">
	<thead>
		<tr>
			<th>Date</th>
			<th>Gross value</th>
			<th>Discount</th>
			<th>CGST</th>
			<th>SGST</th>
			<th>Net Value</th>
		</tr>
	</thead>
	<tbody id="main_tbody">
	<?php 
	$ColumnTotalAmount = 0;
	$ColumnTotalDiscountAmount = 0;
	$ColumnTotalCGST = 0;
	$ColumnTotalSGST = 0;
	$ColumnTotalNetAmount = 0;
	$start_date=date('Y-m-d', strtotime($exploded_date_from_to[0]));
	$end_date=date('Y-m-d', strtotime($exploded_date_from_to[1]));
	while (strtotime($start_date) <= strtotime($end_date)) { 
		if($data[strtotime($start_date)]['TotalNetAmount']){ ?>
            <tr class="main_tr">
				<td><?php echo date('d-m-Y', strtotime($start_date)); ?></td>
				<td><?php echo $TotalAmount = $data[strtotime($start_date)]['TotalAmount']; ?></td>
				<td><?php echo $TotalDiscountAmount = $data[strtotime($start_date)]['TotalDiscountAmount']; ?></td>
				<?php 
					$Taxable = $TotalAmount - $TotalDiscountAmount;
					$TotalNetAmount = $data[strtotime($start_date)]['TotalNetAmount'];
					$GST = $TotalNetAmount - $Taxable;
				?>
				<td><?php echo $TotalCGST = round($GST/2, 2); ?></td>
				<td><?php echo $TotalSGST = round($GST/2, 2); ?></td>
				<td><?php echo $TotalNetAmount; ?></td>
			</tr>
		<?php
		$ColumnTotalAmount+=$TotalAmount;
		$ColumnTotalDiscountAmount+=$TotalDiscountAmount;
		$ColumnTotalCGST+=$TotalCGST;
		$ColumnTotalSGST+=$TotalSGST;
		$ColumnTotalNetAmount+=$TotalNetAmount;
		} 
		$start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
	}?>
	</tbody>
	<tfoot>
		<tr>
			<th style="text-align: right;">Total</th>
			<th><?php echo $ColumnTotalAmount; ?></th>
			<th><?php echo $ColumnTotalDiscountAmount; ?></th>
			<th><?php echo $ColumnTotalCGST; ?></th>
			<th><?php echo $ColumnTotalSGST; ?></th>
			<th><?php echo $ColumnTotalNetAmount; ?></th>
		</tr>
	</tfoot>
</table>