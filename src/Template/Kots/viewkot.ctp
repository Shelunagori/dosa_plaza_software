<!DOCTYPE html> 
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	</head>
	<body style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 12px;" onload="window.prinst();">
		<div style="width: 300px;">
			<div style=" padding: 5px; " id='DivIdToPrint'>
				<div align="center" style="line-height: 24px;">
					<span style="font-size: 16px;font-weight: bold;color: #373435;">DOSA PLAZA</span><br/>
					<span style="font-size: 16px;font-weight: bold;color: #373435;">S S ENTERPRISES</span><br/>
					<span style="font-size: 14px;font-weight: bold;color: #606062;">100 Feet Road, Near Shobhagpura Circle, Udaipur 0294 6999988</span><br/>
				</div>
				 
				<div style=" border-bottom: solid 1px #CCC; padding: 13px 5px; line-height: 22px;">
					<span style="color: #606062;">KOT No.: </span><span style="margin-left: 10px;"> <?php echo $Kots->id; ?> </span><br/>
					<span style="color: #606062;">KOT Date: </span><span style="margin-left: 10px;"> <?php echo date('d-m-Y',strtotime($Kots->created_on)); ?> </span><br/>
					<span style="color: #606062;">KOT Time: <span style="margin-left: 10px;"> <?php echo date('H:i',strtotime($Kots->created_on)); ?> </span><br/>
					<?php if($Kots->table_id>0 ){?>
					<span style="color: #606062;">Table No.: <span style="margin-left: 10px;"> <?php echo @$Kots->table->name; ?> </span><br/>
					<?php } ?>
					<span style="color: #606062;">Order Type: <span style="margin-left: 10px;"> <?php 

					if($Kots->order_type=='dinner'){ echo "Dinner In";} 
					if($Kots->order_type=='takeaway'){ echo "Take Away";} 
					if($Kots->order_type=='delivery'){ echo "Delivery";} 

					?> </span><br/>
				</div>				

				<table width="100%" id="billBox" style="line-height: 20px;padding: 0;margin: 0;">
					<thead>
						<tr>
							<th style="border-bottom: solid 1px #CCC;">No.</th>
							<th style="text-align:left;border-bottom: solid 1px #CCC;">Item Name</th>
							<th style="text-align:center;border-bottom: solid 1px #CCC;">Qty</th> 
							<th style="text-align:center;border-bottom: solid 1px #CCC;">Comment</th>
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
							<td style="padding-top: 5px;"><?php echo ++$i; ?></td>
							<td style="padding-top: 5px;"><?php echo $bill_row->item->name; ?></td>
							<td style="text-align:center;padding-top: 5px;" ><?php echo $bill_row->quantity; ?></td> 
							<td style="text-align:center;padding-top: 5px;" ><?php echo $bill_row->item_comment; ?></td> 
						</tr>
					<?php } ?>
					<tr>
						<td style="text-align:center;border-top: solid 1px #CCC;" colspan="2">Over All Comments</td>
						<td style="text-align:center;border-top: solid 1px #CCC;" colspan="2"><?php echo @$Kots->one_comment; ?></td>
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

