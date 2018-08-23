<!DOCTYPE html> 
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	</head>
	<body style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 12px;" onload="window.prinst();">
		<div style="width: 300px;">
			<div style=" padding: 5px; " id='DivIdToPrint'>
				<div align="center" style="line-height: 24px;">
					<span style="font-size: 14px;font-weight: bold;color: #606062;">KOT</span>
				</div>
				<div style=" border-bottom: solid 1px #CCC; padding: 13px 5px; line-height: 22px;">
					<table width="100%">
						<tr>
							<td>
								<span style="color: #606062;">KOT No.: </span>
								<span style="margin-left: 10px;"> <?php echo $Kots->id; ?> </span>
							</td>
							<td align="right">
								<span style="color: #606062;">KOT Date: </span>
								<span style="margin-left: 10px;"> <?php echo date('d-m-Y',strtotime($Kots->created_on)); ?> </span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="color: #606062;">Order Type: </span>
								<span style="margin-left: 10px;"> 
								<?php 
								if($Kots->order_type=='dinner'){ echo "Dinner In";} 
								if($Kots->order_type=='takeaway'){ echo "Take Away";} 
								if($Kots->order_type=='delivery'){ echo "Delivery";} 
								?>
								</span>
							</td>
							<td align="right">
								<span style="color: #606062;">KOT Time: </span>
								<span style="margin-left: 10px;"> <?php echo date('h:i A',strtotime($Kots->created_on)); ?> </span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="color: #606062;">Steward: </span>
								<span style="margin-left: 10px;"> <?= h($Kots->table->employee->name) ?></span>
							</td>
							<td align="right">
								<?php if($Kots->table_id>0 ){?>
								<span style="color: #606062;">Table No.: </span>
								<span style="margin-left: 10px;"> <?php echo @$Kots->table->name; ?> </span>
								<?php } ?>
							</td>
						</tr>
					</table>
				</div>				

				<table width="100%" id="billBox" style="line-height: 20px;padding: 0;margin: 0;">
					<thead>
						<tr>
							<th style="border-bottom: solid 1px #CCC;">SR N.</th>
							<th style="text-align:left;border-bottom: solid 1px #CCC;">Item Name</th>
							<th style="text-align:center;border-bottom: solid 1px #CCC;">Qty</th> 
							<th style="text-align:center;border-bottom: solid 1px #CCC;">Rate</th> 
						</tr>
					</thead>
					<tbody>
					<?php 
					$i=0; $sub_total=0; $discountAmount=0;
					foreach($Kots->kot_rows as $bill_row){
						$sub_total+=$bill_row->net_amount;
						$discountAmount+=$bill_row->amount*$bill_row->discount_per/100;
						?>
						<tr>
							<td style="padding-top: 5px;text-align: center;"><?php echo ++$i; ?></td>
							<td style="padding-top: 5px;"><?php echo $bill_row->item->name; ?></td>
							<td style="text-align:center;padding-top: 5px;" ><?php echo $bill_row->quantity; ?></td> 
							<td style="text-align:center;padding-top: 5px;" ><?php echo $bill_row->rate; ?></td> 
						</tr>
						<?php if($bill_row->item_comment){ ?>
						<tr>
							<td></td>
							<td colspan="3">
								<?= h($bill_row->item_comment); ?>
							</td>
						</tr>
						<?php } ?>
					<?php } ?>
					<tr>
						<td style="border-top: solid 1px #CCC;" colspan="4">
							<span style="color: #606062;">Over All Comments: </span>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<span style="margin-left: 10px;"> <?= h(@$Kots->one_comment) ?> </span>
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

