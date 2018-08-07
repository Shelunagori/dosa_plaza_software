<style type="text/css">
	#kotTable tr td{
		padding: 10px 0px;
	}
</style> 
  
<div id="accordion1" class="panel-group">
	<?php foreach ($kots as $kot): ?>
	<div class="panel panel-default" style=" border: none; ">
		<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion_<?php echo $kot->id; ?>" aria-expanded="false">
			<div class="panel-heading" style="padding:10px;background-color: #E6E7E8;">
				<span class="panel-title" style="font-size: 14px; color: #373435;">
					KOT#<?php echo $kot->voucher_no; ?> [<?php echo $kot->created_on->format('d-m-Y h:i'); ?>]
				</span>
				 
			</div>
		</a>
		<div id="accordion_<?php echo $kot->id; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
			<div class="panel-body" style="border: none;">
				 <table width="100%" id="kotTable">
					<thead>
						<tr style="border-bottom: solid 1px #F1F1F2; " > 
							<th width="5%">#</th>
							<th>Item</th>
							<th style="text-align:center;" width="5%">Qty</th>
							<th style="text-align:center;" width="10%">Rate</th>
							<th style="text-align:center;" width="10%">Amount</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$i=0; $total=0;
					foreach($kot->kot_rows as $kot_row){ ?>
						<tr style="border-bottom: solid 1px #F1F1F2; ">
							<td><?php echo ++$i.'.'; ?></td>
							<td ><?php echo $kot_row->item->name; ?></td>
							<td style="text-align:center;"><?php echo $kot_row->quantity; ?></td>
							<td style="text-align:center;"><?php echo $kot_row->rate; ?></td>
							<td style="text-align:center;"><?php echo $kot_row->amount; ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>


        

