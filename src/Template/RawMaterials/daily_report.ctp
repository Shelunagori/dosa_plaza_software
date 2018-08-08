<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Daily Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption"style="padding:13px; color: red;">
					Daily Report
				</div>
				
				<div class="actions" style="margin-right: 10px;">
					<input id="search3"  class="form-control" type="text" placeholder="Search" >
				</div>
				<br/>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">
				<div align="center">
					<form method="GET">
						<table>
							<tr>
								<td>
									<input type="date" class="form-control" name="date" value="<?php echo $date; ?>"	required />
								</td>
								<td>
									<button type="submit" class="btn" >GO</button>
								</td>
							</tr>
						</table>
					</form>
				</div>


				<?php if($date){ ?>
				<table class="table " cellpadding="0" cellspacing="0" id="main_table">
					<thead>
						<tr>
							<th style="width:10%"><?= ('S.No.') ?></th>
							<th style="width:15%"><?= ('Raw materials') ?></th>
							<th style="width:15%"><?= ('Unit') ?></th>
							<th style="width:15%" ><?= ('Opening stock <br/>(A)') ?></th>
							<th style="width:15%" ><?= ('Inward/Purchase <br/>(B)') ?></th>
							<th style="width:15%" ><?= ('Adjustment-Stock in <br/>(C)') ?></th>
							<th style="width:15%" ><?= ('Total Stock <br/>(A+B+C)') ?></th>
							<th style="width:15%" ><?= ('Used/Outword Stock <br/>(D)') ?></th>
							<th style="width:15%" ><?= ('Wastage <br/>(E)') ?></th>
							<th style="width:15%" ><?= ('Adjustment-Stock out <br/>(F)') ?></th>
							<th style="width:15%" ><?= ('Total consumed Stock <br/>(D+E+F)') ?></th>
							<th style="width:15%" ><?= ('Net Stock') ?></th>
						</tr>
					</thead>
					<tbody id="main_tbody">
					<?php $d=0;$x=0; foreach ($RawMaterials as $RawMaterial): ?>
						<tr class="main_tr">
							<td><?= (++$d) ?></td>
							<td><?= h($RawMaterial->name) ?></td>
							<td><?= h($RawMaterial->primary_unit->name) ?></td>
							<td><?php echo ($RawMaterial->total_in_opening - $RawMaterial->total_out_opening) ? ($RawMaterial->total_in_opening - $RawMaterial->total_out_opening) : '' ?></td>
							<td><?= h($RawMaterial->inward) ?></td>
							<td><?= h($RawMaterial->adjustmentIn) ?></td>
							<td>
								<?php 
								$totalInStock=$RawMaterial->total_in_opening - $RawMaterial->total_out_opening + $RawMaterial->inward + $RawMaterial->adjustmentIn;
								?>
								<?php echo ($totalInStock) ? ($totalInStock) : '' ?>
							</td>
							<td><?= h($RawMaterial->used) ?></td>
							<td><?= h($RawMaterial->wastage) ?></td>
							<td><?= h($RawMaterial->adjustmentOut) ?></td>
							<td>
								<?php 
								$totalConsumedStock=$RawMaterial->used + $RawMaterial->wastage + $RawMaterial->adjustmentOut;
								?>
								<?php echo ($totalConsumedStock) ? ($totalConsumedStock) : '' ?>
							</td>
							<td>
								<?php 
								$netStock=$totalInStock - $totalConsumedStock;
								?>
								<?= h($netStock) ?>
							</td>
						</tr>
						<?php $x++; endforeach; ?>
					</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php
	$js="
	$(document).ready(function() {	
		var rows = $('#main_tbody tr.main_tr');
		$('#search3').on('keyup',function() {
	      
			var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
			var v = $(this).val();
			
    		if(v){ 
    			rows.show().filter(function() {
    				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
		
    				return !~text.indexOf(val);
    			}).hide();
    		}else{
    			rows.show();
    		}
    	}); 
		
	});
	";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>