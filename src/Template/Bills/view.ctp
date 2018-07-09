<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	</head>
	<body style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 12px;" onload="window.print();">
		<div style="width: 300px;">
			<div style=" padding: 5px; " id='DivIdToPrint'>
				<div align="center" style="line-height: 24px;">
					<span style="font-size: 16px;font-weight: bold;color: #373435;">DOSA PLAZA</span><br/>
					<span style="font-size: 16px;font-weight: bold;color: #373435;">S S ENTERPRISES</span><br/>
					<span style="font-size: 14px;font-weight: bold;color: #606062;">100 Feet Road, Near Shobhagpura Circle, Udaipur 0294 6999988</span><br/>
				</div>
				<div style="border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; padding: 13px 5px; line-height: 22px;">
					<span style="color: #606062;">Name: </span><span style="margin-left: 10px;"> <?= h($bill->customer->name) ?> </span><br/>
					<span style="color: #606062;">Mobile No: </span><span style="margin-left: 10px;"> <?= h($bill->customer->mobile_no) ?> </span><br/>
					<span style="color: #606062;">Address: </span><span style="margin-left: 10px;"> <?= h($bill->customer->address) ?> </span>
				</div>	
				<div style=" border-bottom: solid 1px #CCC; padding: 13px 5px; line-height: 22px;">
					<span style="color: #606062;">Bill No.: </span><span style="margin-left: 10px;"> RBL-<?php echo str_pad($bill->voucher_no, 6, "0", STR_PAD_LEFT); ?> </span><br/>
					<span style="color: #606062;">Bill Date: </span><span style="margin-left: 10px;"> <?php echo date('d-m-Y',strtotime($bill->created_on)); ?> </span><br/>
					<span style="color: #606062;">Bill Time: <span style="margin-left: 10px;"> <?php echo date('H:i',strtotime($bill->created_on)); ?> </span><br/>
					<span style="color: #606062;">Table No.: <span style="margin-left: 10px;"> <?php echo $bill->table->name; ?> </span><br/>
				</div>				

				<table width="100%" id="billBox" style="line-height: 20px;padding: 0;margin: 0;">
					<thead>
						<tr>
							<th style="border-bottom: solid 1px #CCC;">No.</th>
							<th style="text-align:left;border-bottom: solid 1px #CCC;">Item Name</th>
							<th style="text-align:center;border-bottom: solid 1px #CCC;">Qty</th>
							<th style="text-align:center;border-bottom: solid 1px #CCC;">Rate</th>
							<th style="text-align:center;border-bottom: solid 1px #CCC;">Total</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$i=0; $sub_total=0; $discountAmount=0;
					foreach($bill->bill_rows as $bill_row){
						$sub_total+=$bill_row->net_amount;
						$discountAmount+=$bill_row->amount*$bill_row->discount_per/100;
						?>
						<tr>
							<td style="padding-top: 5px;"><?php echo ++$i; ?></td>
							<td style="padding-top: 5px;"><?php echo $bill_row->item->name; ?></td>
							<td style="text-align:center;padding-top: 5px;" ><?php echo $bill_row->quantity; ?></td>
							<td style="text-align:center;padding-top: 5px;" ><?php echo $bill_row->rate; ?></td>
							<td style="padding-top: 5px;"></td>
						</tr>
						<tr style="">
							<td colspan="2" style="text-align:left;border-bottom: 1px dashed #D2D2D3;padding-bottom: 5px;">
								<?php if($bill_row->discount_per>0){ ?>
									<span style="margin-left: 40px;">Discount@<?php echo $bill_row->discount_per; ?>%</span>
								<?php } ?>
							</td>
							<td colspan="3" style="text-align:right;border-bottom: 1px dashed #D2D2D3;padding-bottom: 5px;"><?php echo $bill_row->net_amount; ?></td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th></th>
							<th colspan="3" style="text-align:left;">Sub Total</th>
							<th style="text-align:right;"><?php echo $sub_total; ?></th>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="text-align:left;">Discount</td>
							<td style="text-align:right;"><?php echo $discountAmount; ?></td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="text-align:left;">CGST : <?php echo $bill->tax->tax_per/2; ?>%</td>
							<td style="text-align:right;"><?php echo round($sub_total*($bill->tax->tax_per/2)/100,2); ?></td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3" style="text-align:left;">SGST : <?php echo $bill->tax->tax_per/2; ?>%</td>
							<td style="text-align:right;"><?php echo round($sub_total*($bill->tax->tax_per/2)/100,2); ?></td>
						</tr>
						<tr>
							<th style="border-bottom: solid 1px #CCC;border-top: solid 1px #CCC;"></th>
							<th colspan="3" style="text-align:left;border-bottom: solid 1px #CCC;border-top: solid 1px #CCC;">Total</th>
							<th style="text-align:right;border-bottom: solid 1px #CCC;border-top: solid 1px #CCC;"><?php echo $bill->grand_total; ?></th>
						</tr>
					<tfoot>
				</table><br/>
				<div><span>GSTIN: 08AMXPM4697C1ZC</span></div><br/>
				<div align="center">
					<span>www.dosaplaza.com</span><br/>
					<span>Thank you for your order. Have a nice day !</span>
				</div>
			</div>
		</div>
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

