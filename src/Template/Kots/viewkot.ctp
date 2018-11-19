<!DOCTYPE html> 
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	</head>
	<body style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 10px;" onload="window.prinst();">
		<div style="width: 300px;">
			<div style="  padding: 5px 15px 5px 15px;  " id='DivIdToPrint'>

				<div align="center" style="line-height: 24px;">
					<?php if($Kots->table_id>0 ){?>
						<span style="font-size: 16px;font-weight: bold;color: #606062;">Table No.: <?php echo @$Kots->table->name; ?></span>
					<?php } ?>
					<?php if($Kots->order_type=="delivery"){
						$delivery_no=$last_voucher_no->delivery_no;
				        ?>
						<span style="font-size: 16px;font-weight: bold;color: #606062;">Delivery No.: <?php echo @$delivery_no; ?></span>
					<?php } ?>

					<?php if($Kots->order_type=="takeaway"){
						$take_away_no=$last_voucher_no->take_away_no;
				        ?>
						<span style="font-size: 16px;font-weight: bold;color: #606062;">Take Away No.: <?php echo @$take_away_no; ?></span>
					<?php } ?>
				</div>

				<div style=" border-bottom: solid 1px; padding: 13px 5px; line-height: 14px;">
					<table width="100%">
						<tr>
							<td>
								<span style="color: #606062;">KOT No.: </span>
								<span style="margin-left: 10px;"> <?php echo $Kots->voucher_no; ?> </span>
							</td>
							<td align="right">
								<span style="color: #606062;">KOT Time: </span>
								<span style="margin-left: 10px;"> <?php echo $Kots->created_on->format('h:i A'); ?> </span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="color: #606062;">KOT Date: </span>
								<span style="margin-left: 10px;"> <?php echo $Kots->created_on->format('d-m-Y'); ?> </span>
							</td>
							<td align="right">
								<span style="color: #606062;">Order Type: </span>
								<span> 
								<?php 
								if($Kots->order_type=='dinner'){ echo "Dine In";} 
								if($Kots->order_type=='takeaway'){ echo "Take Away";} 
								if($Kots->order_type=='delivery'){ echo "Delivery";} 
								?>
								</span>
							</td>
						</tr>
						<tr>
							<td >
								<span style="color: #606062;">Caption: </span>
								<span style="margin-left: 10px;"> <?= h(@$Kots->employee->name) ?></span>
							</td>
							<td></td>
						</tr>
					</table>
				</div>	

				<div style="border-bottom: solid 1px; padding: 0px 0px; line-height: 12px; font-size: 11px;">
					<table width="100%">
						<tr>
							<td style="font-size: 13px;">
								<span style="color: #606062;">Name: </span>
								<span style="margin-left: 10px;"> <?= h(@$Kots->bill->customer->name) ?></span>
							</td>
							<td align="right">
								<span style="color: #606062;">Mobile No: </span>
								<span style="margin-left: 10px;"> <?= h(@$Kots->bill->customer->mobile_no) ?></span>
							</td>
						</tr>
					</table>
				</div>				

				<table width="100%" id="billBox" style="line-height: 20px;padding: 0;margin: 0;">
					<thead>
						<tr>
							<th style="border-bottom: solid 1px;width: 25px;">SR N.</th>
							<th style="text-align:left;border-bottom: solid 1px;">Item Name</th>
							<th style="text-align:center;border-bottom: solid 1px;">Qty</th> 
							<th style="text-align:center;border-bottom: solid 1px;">Rate</th> 
						</tr>
					</thead>
					<tbody style="line-height: 10px;">
					<?php 
					$i=0; $sub_total=0; $discountAmount=0;
					foreach($Kots->kot_rows as $bill_row){
						$sub_total+=$bill_row->net_amount;
						$discountAmount+=$bill_row->amount*$bill_row->discount_per/100;
						?>
						<tr style="font-size: 12px;">
							<td style="padding: 0;text-align: center;"><?php echo ++$i; ?></td>
							<td style="padding: 0;"><?php echo $bill_row->item->name; ?></td>
							<td style="padding: 0;text-align:center;" ><?php echo $bill_row->quantity; ?></td> 
							<td style="padding: 0;text-align:center;" ><?php echo $bill_row->rate; ?></td> 
						</tr>
						<?php if($bill_row->item_comment){ ?>
						<tr>
							<td></td>
							<td colspan="3">
								<?php if($bill_row->item_comment){ ?>
									[<?= h($bill_row->item_comment); ?>]
								<?php } ?>
								
							</td>
						</tr>
						<?php } ?>
					<?php } ?>
					<tr>
						<td style="border-top: solid 1px;" colspan="4">
							<span style="color: #606062;">Over All Comments: </span>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<?php if(@$Kots->one_comment){ ?>
								<span style="margin-left: 10px;"> [<?= h(@$Kots->one_comment) ?>] </span>
							<?php } ?>
						</td>
					</tr>
					</tbody>
				</table><br/>
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

