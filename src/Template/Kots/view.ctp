<?php 
$items=[];
foreach($Kots as $Kot){
	foreach($Kot->kot_rows as $kot_row){
		$items[$kot_row->item_id]=['quantity'=>@$items[$kot_row->item_id]['quantity']+$kot_row->quantity, 'rate'=>$kot_row->rate, 'name'=>$kot_row->item->name];
	}
}
?>
<?php if(sizeof($items)>0){ ?>
<div>
	<div>BILL</div>
	<div>Table: <?php echo $Table->name; ?></div>
	<table width="100%" id="billTable">
		<thead>
			<tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; " > 
				<th>#</th>
				<th>Item</th>
				<th style="text-align:center;">Qty</th>
				<th style="text-align:center;" >Rate</th>
				<th style="text-align:center;">Amount</th>
				<th>Dis%</th>
				<th style="text-align:right;" >Net</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$i=0; $total=0;
		foreach($items as $item_id=>$item){ ?>
			<tr style=" border-bottom: dashed 1px #CCC; ">
				<td><?php echo ++$i.'.'; ?></td>
				<td item_id="<?php echo $item_id; ?>" ><?php echo $item['name']; ?></td>
				<td style="text-align:center;"><?php echo $item['quantity']; ?></td>
				<td style="text-align:center;"><?php echo $item['rate']; ?></td>
				<td style="text-align:center;"><?php echo $item['quantity']*$item['rate']; ?></td>
				<td><input type="text" style="width:20%;text-align:right;" placeholder="" /></td>
				<td style="text-align:right;"><?php echo $item['quantity']*$item['rate']; $total+=$item['quantity']*$item['rate']; ?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
			<tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; " > 
				<th colspan="6" style="text-align:right;">Total</th>
				<th style="text-align:right;" ><?php echo $total; ?></th>
			</tr>
		</tfoot>
	</table>
	<div align="right">
		<a href="#" class="btn btn-sm bg-grey-gallery CancelBill" ><i class="fa fa-money"></i> Cancel </a>
		<a href="#" class="btn btn-sm bg-grey-gallery SubmitBill" ><i class="fa fa-money"></i> SUBMIT BILL </a>
	</div>
</div>
<?php }else{ ?>
	<div align="center">
		<div>Create atleast one KOT.</div>
		<a href="#" class="btn btn-sm bg-grey-gallery CancelBill" ><i class="fa fa-money"></i> Close </a>
	</div>
<?php } ?>