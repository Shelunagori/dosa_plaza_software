<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Daily Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Daily Report
							</div>
						</td>
						<td valign="button">
							<div align="center">
								<form method="GET">
									<table>
										<tr>
											<td>
												<input type="date" class="form-control" name="date" value="<?php echo $date; ?>"	required />
											</td>
											<td>
												<button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;">GO</button>
											</td>
										</tr>
									</table>
								</form>
							</div>
						</td>
						<td width="20%">
							<div class="actions" style="margin-right: 10px;">
								<input id="search3"  class="form-control" type="text" placeholder="Search" >
							</div>
						</td>
					</tr>
				</table>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable">
					<?php if($date){ ?>
					<table class="table table-bordered" id="main_table">
						<thead>
							<tr>
								<th><?= ('S.No.') ?></th>
								<th><?= ('Raw materials') ?></th>
								<th style="text-align: center;"><?= ('Unit') ?></th>
								<th style="text-align: center;"><?= ('Opening stock <br/>(A)') ?></th>
								<th style="text-align: center;"><?= ('Inward/Purchase <br/>(B)') ?></th>
								<th style="text-align: center;"><?= ('Adjustment-Stock in <br/>(C)') ?></th>
								<th style="text-align: center;"><?= ('Total Stock <br/>(A+B+C)') ?></th>
								<th style="text-align: center;"><?= ('Used/Outword Stock <br/>(D)') ?></th>
								<th style="text-align: center;"><?= ('Wastage <br/>(E)') ?></th>
								<th style="text-align: center;"><?= ('Adjustment-Stock out <br/>(F)') ?></th>
								<th style="text-align: center;"><?= ('Total consumed Stock <br/>(D+E+F)') ?></th>
								<th style="text-align: center;"><?= ('Net Stock') ?></th>
							</tr>
						</thead>
						<tbody id="main_tbody">
						<?php $d=0;$x=0; foreach ($RawMaterials as $RawMaterial): ?>
							<tr class="main_tr">
								<td><?= (++$d) ?></td>
								<td style="white-space: nowrap;"><?= h($RawMaterial->name) ?></td>
								<td style="text-align: center;"><?= h($RawMaterial->primary_unit->name) ?></td>
								<td style="text-align: center;"><?php echo ($RawMaterial->total_in_opening - $RawMaterial->total_out_opening) ? ($RawMaterial->total_in_opening - $RawMaterial->total_out_opening) : '' ?></td>
								<td style="text-align: center;"><?= h($RawMaterial->inward) ?></td>
								<td style="text-align: center;"><?= h($RawMaterial->adjustmentIn) ?></td>
								<td style="text-align: center;">
									<?php 
									$totalInStock=$RawMaterial->total_in_opening - $RawMaterial->total_out_opening + $RawMaterial->inward + $RawMaterial->adjustmentIn;
									?>
									<?php echo ($totalInStock) ? ($totalInStock) : '' ?>
								</td>
								<td style="text-align: center;"><?= h($RawMaterial->used) ?></td>
								<td style="text-align: center;"><?= h($RawMaterial->wastage) ?></td>
								<td style="text-align: center;"><?= h($RawMaterial->adjustmentOut) ?></td>
								<td style="text-align: center;">
									<?php 
									$totalConsumedStock=$RawMaterial->used + $RawMaterial->wastage + $RawMaterial->adjustmentOut;
									?>
									<?php echo ($totalConsumedStock) ? ($totalConsumedStock) : '' ?>
								</td>
								<td style="text-align: center;">
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