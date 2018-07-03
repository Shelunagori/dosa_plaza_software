<!DOCTYPE html>
<html>
	<body onload="window.print();">
		<div>
			<button type="button" class="btn btn-sm bg-grey-gallery hide_at_print" onclick="window.print();" ><i class="fa fa-money"></i> PRINT </button>
			<div style=" border: solid 1px #CCC; padding: 5px; " id='DivIdToPrint'>
				<table width="100%">
					<tr>
						<td width="30%" align="left">COMPANY LOGO</td>
						<td align="center">TAX INVOICE</td>
						<td width="30%" align="right">COMPANY NAME <BR/> OTHER DETAILS</td>
					</tr>
				</table>
				<hr>
				<table width="100%" id="billBox">
					<thead>
						<tr>
							<th>#</th>
							<th>Item</th>
							<th style="text-align:center;">Qty</th>
							<th style="text-align:center;">Rate</th>
							<th style="text-align:center;">Amount</th>
							<th>Dis%</th>
							<th style="text-align:right;">Net</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$i=0;
					foreach($bill->bill_rows as $bill_row){ ?>
						<tr >
							<td><?php echo ++$i; ?></td>
							<td><?php echo $bill_row->item_id; ?></td>
							<td style="text-align:center;" ><?php echo $bill_row->quantity; ?></td>
							<td style="text-align:center;" ><?php echo $bill_row->rate; ?></td>
							<td style="text-align:center;" ><?php echo $bill_row->amount; ?></td>
							<td>-</td>
							<td style="text-align:right;" >-</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="6" style="text-align:right;">Total</th>
							<th style="text-align:right;">-</th>
						</tr>
						<tr>
							<td colspan="4">Terms & conditions</td>
							<td colspan="3" style="text-align:right;" >Sign</td>
						</tr>
					<tfoot>
				</table>
			</div>
		</div>
		<style>
		table#billBox > tbody > tr > td {
		border-collapse: collapse;
			border-bottom: 1px dashed black;
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
	</body>
</html>

