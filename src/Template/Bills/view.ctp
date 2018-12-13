<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	</head>
	<body style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 12px;"  >
		<div style="width: 300px;">
			<div style=" padding: 5px 15px 5px 15px; " id='DivIdToPrint'>
				<div>
					<?php echo $BillSetting->header; ?>
				</div>
				<div style="border-top: solid 1px #807e7e; border-bottom: solid 1px #807e7e; padding: 0px 0px; line-height: 16px; font-size: 10px;">
					<table width="100%">
						<tr>
							<td>
								<span style="color: #606062;">Name: </span>
								<span style="margin-left: 10px;"> <?= h(@$bill->customer->name) ?> </span>
							</td>
							<td align="right">
								<span style="color: #606062;">Mobile No: </span>
								<span style="margin-left: 10px;"> <?= h(@$bill->customer->mobile_no) ?> </span>
							</td>
						</tr>
					</table>
				</div>	
				<div style=" border-bottom: solid 1px #807e7e; padding: 0; line-height: 14px;font-size: 10px;">
					<table width="100%">
						<tr>
							<td>
								<span style="color: #606062;">Bill No.: </span>
								<span style="margin-left: 10px;"> RBL-<?php echo str_pad($bill->voucher_no, 6, "0", STR_PAD_LEFT); ?> </span>
							</td>
							<td align="right">
								<span style="color: #606062;">Order Type: </span>
								<span style="margin-left: 10px;"> 
									<?php 
									if($bill->order_type=='dinner'){ echo "Dine In";} 
									if($bill->order_type=='takeaway'){ echo "Take Away";} 
									if($bill->order_type=='delivery'){ echo "Delivery";} 
									?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="color: #606062;">Bill Date: </span>
								<span style="margin-left: 10px;"> <?php echo $bill->created_on->format('d-m-Y'); ?> </span>
							</td>
							<td align="right">
								<span style="color: #606062;">Bill Time: </span>
								<span style="margin-left: 10px;"> <?php echo $bill->created_on->format('h:i A'); ?> </span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="color: #606062;">KOT No.: </span>
								<span style="margin-left: 10px;"> <?php echo $kot_no; ?> </span>
							</td>
							<td align="right">
								<?php if(@$bill->employee->name){ ?>
								<span style="color: #606062;">Prepared by: </span>
								<span style="margin-left: 10px;"> <?= h(@$bill->employee->name) ?> </span>
								<?php } ?>
							</td>
						</tr>
						<!-- <tr>
							<td>
								<?php if($bill->table_id>0 ){?>
								<span style="color: #606062;">Table No.: </span>
								<span style="margin-left: 10px;"> <?php echo @$bill->table->name; ?> </span>
								<?php } ?>
							</td>
							<td align="right">
								<?php if(@$bill->table->employee->name){ ?>
								<span style="color: #606062;">Steward: </span>
								<span style="margin-left: 10px;"> <?= h(@$bill->table->employee->name) ?> </span>
								<?php } ?>
							</td>
						</tr> -->
					</table>
				</div>				

				<table width="100%" id="billBox" style="line-height: 16px;padding: 0;margin: 0;font-size: 10px;">
					<thead>
						<tr>
							<th style="border-bottom: solid 1px #807e7e;">No.</th>
							<th style="text-align:left;border-bottom: solid 1px #807e7e;">Item Name</th>
							<th style="text-align:center;border-bottom: solid 1px #807e7e;">Qty</th>
							<th style="text-align:center;border-bottom: solid 1px #807e7e;">Rate</th>
							<th style="text-align:center;border-bottom: solid 1px #807e7e;">Total</th>
						</tr>
					</thead>
					<tbody style="line-height: 10px;">
					<?php 
					$i=0; $taxAmount=0; $sub_total=0; $discountAmount=0;
					foreach($bill->bill_rows as $bill_row){
						//$sub_total+=$bill_row->amount-$bill_row->discount_amount;
						$sub_total+=$bill_row->amount;
						$discountAmount+=$bill_row->amount*$bill_row->discount_per/100;

						$taxAmount+=($bill_row->amount-$bill_row->discount_amount)*$bill_row->tax_per/100;
						?>
						<tr style="">
							<td style="padding-top: 0px;"><?php echo ++$i; ?></td>
							<td style="padding-top: 0px;"><?php echo $bill_row->item->name; ?></td>
							<td style="text-align:center;padding-top: 0px;" ><?php echo $bill_row->quantity; ?></td>
							<td style="text-align:center;padding-top: 0px;" ><?php echo $bill_row->rate; ?></td>
							<td style="padding-top: 0px;text-align: right;"><?php echo $bill_row->net_amount; ?></td>
						</tr>
						<?php if($bill_row->discount_amount>0){ ?>
						<tr style="">
							<td colspan="2" style="text-align:left;padding-bottom: 8px;">
								<span style="margin-left: 40px;">Discount@<?php echo $bill_row->discount_per; ?>%</span>
							</td>
							<td colspan="3" style="text-align:right;padding-bottom: 8px;"><?php echo $bill_row->discount_amount; ?></td>
						</tr>
						<?php } ?>
					<?php } ?>
					</tbody>
					<tfoot style=" line-height: 15px; ">
						<tr>
							<th style="border-top: solid 1px #807e7e;"></th>
							<th colspan="3" style="text-align:left;border-top: solid 1px #807e7e;">Sub Total</th>
							<th style="text-align:right;border-top: solid 1px #807e7e;"><?php echo $sub_total; ?></th>
						</tr>
						<?php if($discountAmount>0){ ?>
							<tr>
								<th style=""></th>
								<th colspan="3" style="text-align:left;">Total Discount</th>
								<th style="text-align:right;">-<?php echo $discountAmount; ?></th>
							</tr>
						<?php } ?>
						<tr>
							<th></th>
							<td colspan="3" style="text-align:left;font-size: 11px;">Round off</td>
							<td style="text-align:right;font-size: 11px;"><?php echo $bill->round_off; ?></td>
						</tr>  
						<tr>
							<th style="border-bottom: solid 1px #807e7e;border-top: solid 1px #807e7e;"></th>
							<th colspan="3" style="text-align:left;border-bottom: solid 1px #807e7e;border-top: solid 1px #807e7e;">Total</th>
							<th style="text-align:right;border-bottom: solid 1px #807e7e;border-top: solid 1px #807e7e;"><?php echo $bill->grand_total; ?></th>
						</tr>
					<tfoot>
				</table>
				<?php if($discountAmount>0){
					echo '<div style="font-size:12px;text-align:center;"><b>You saved '.$discountAmount.' Rupees.</b></div>';
				} ?>
				<div>
					<?php echo $BillSetting->footer; ?>
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
<script type="text/javascript">
	//window.print();
	//window.close();
</script>
