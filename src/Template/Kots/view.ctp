<?php 
$items=[];
foreach($Kots as $Kot){
	foreach($Kot->kot_rows as $kot_row){
		$items[$kot_row->item_id]=['quantity'=>@$items[$kot_row->item_id]['quantity']+$kot_row->quantity, 'rate'=>$kot_row->rate, 'name'=>$kot_row->item->name];
	}
}
?>
<div>
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
		$i=0;
		foreach($items as $item){ ?>
			<tr style=" border-bottom: dashed 1px #CCC; ">
				<td><?php echo ++$i.'.'; ?></td>
				<td><?php echo $item['name']; ?></td>
				<td style="text-align:center;"><?php echo $item['quantity']; ?></td>
				<td style="text-align:center;"><?php echo $item['rate']; ?></td>
				<td style="text-align:center;"><?php echo $item['quantity']*$item['rate']; ?></td>
				<td><input type="text" style="width:20%;text-align:right;" placeholder="" /></td>
				<td style="text-align:right;"><?php echo $item['quantity']*$item['rate']; ?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
			<tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; " > 
				<th colspan="6" style="text-align:right;">Total</th>
				<th style="text-align:right;" >Net</th>
			</tr>
		</tfoot>
	</table>
</div>