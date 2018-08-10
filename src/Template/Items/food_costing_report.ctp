<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Stock-Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Stock-Report
							</div>
						</td>
						<td valign="button">
							<div align="center">
								<form method="GET">
									<table>
										<tr>
											<td>
												<input type="date" class="form-control" name="from_date" value="<?php echo $from_date; ?>" required />
											</td>
											<td>
												<input type="date" class="form-control" name="to_date" value="<?php echo $to_date; ?>" required />
											</td>
											<td>
												<button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;" >GO</button>
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

				<?php if($from_date && $to_date){ ?>

				<div class="table-scrollable">
				<table class="table table-bordered table-str">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Item Name</th>
							<th>Selling Quantity</th>
							<th>Selling Price</th>
							<th>Selling Amount</th>
						</tr>
					</thead>
					<tbody id="main_tbody">
					<?php $d=0;$x=0; foreach ($Items as $Item): ?>
						<tr class="main_tr">
							<td><?= (++$d) ?></td>
							<td><?= h($Item->name) ?></td>
							<td><?php echo ($Item->selling_quantity) ? ($Item->selling_quantity) : '' ?></td>
							<td>
								<?php 
								$selling_price=0;
								if($Item->selling_quantity){
									$selling_price=round($Item->selling_amount/$Item->selling_quantity,2);
								}
								echo ($selling_price) ? ($selling_price) : '' ?>
							</td>
							<td><?php echo ($Item->selling_amount) ? ($Item->selling_amount) : '' ?></td>
						</tr>
						<?php $x++; endforeach; ?>
					</tbody>
				</table>
				</div>
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