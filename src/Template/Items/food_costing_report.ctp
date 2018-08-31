<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Food-Costing Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Food-Costing Report
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
												<?php
												$options=[];
												$options[]=['text' =>'30 Days', 'value' => 30];
												$options[]=['text' =>'60 Days', 'value' => 60];
												$options[]=['text' =>'120 Days', 'value' => 120];
												$options[]=['text' =>'240 Days', 'value' => 240];
												$options[]=['text' =>'360 Days', 'value' => 360];
												echo $this->Form->input('period', ['label' => false,'options' => $options,'class' => 'form-control', 'value' => @$period]);
												?>
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
							<th style="text-align: center;">Selling Quantity</th>
							<th style="text-align: center;">Selling Price</th>
							<th style="text-align: center;">Selling Amount</th>
							<th style="text-align: center;">Purchase Price</th>
							<th style="text-align: center;">Purchase Amount</th>
							<th style="text-align: center;">Profit Ratio(%)</th>
						</tr>
					</thead>
					<tbody id="main_tbody">
					<?php $d=0;$x=0; foreach ($Items as $Item): ?>
						<tr class="main_tr">
							<td><?= (++$d) ?></td>
							<td><?= h($Item->name) ?></td>
							<td style="text-align: center;"><?php echo ($Item->selling_quantity) ? ($Item->selling_quantity) : '' ?></td>
							<td style="text-align: center;">
								<?php 
								$selling_price=0;
								if($Item->selling_quantity){
									$selling_price=round($Item->selling_amount/$Item->selling_quantity,2);
								}
								echo ($selling_price) ? ($selling_price) : '' ?>
							</td>
							<td style="text-align: center;"><?php echo ($Item->selling_amount) ? ($Item->selling_amount) : '' ?></td>
							<td style="text-align: center;">
								<?php 
								$PurchasePrice=0;
								foreach ($Item->item_rows as $item_row) {
									if($item_row->raw_material->recipe_unit_type=='primary'){
				                        $Qty=$item_row->quantity;
				                    }else if($item_row->raw_material->recipe_unit_type=='secondary'){
				                        $Qty=($item_row->quantity)/$item_row->raw_material->formula;
				                    }

				                    if($item_row->total_quantity){
				                    	$avgPrice=($item_row->total_amount/$item_row->total_quantity);
				                    }else{
				                    	$avgPrice=0;
				                    }
									$PurchasePrice+=$Qty*$avgPrice;
								}
								$PurchasePrice = round($PurchasePrice,2); 

								echo (@$PurchasePrice) ? (@$PurchasePrice) : '' ?>
							</td>
							<td style="text-align: center;">
								<?php 
								$PurchaseAmount = $Item->selling_quantity*$PurchasePrice;
								echo ($PurchaseAmount) ? ($PurchaseAmount) : ''
								?>
							</td>
							<td style="text-align: center;">
								<?php
									$Profit = $Item->selling_amount - $PurchaseAmount;
									if($PurchaseAmount){
										$ProfitRatio = round( ($Profit/$PurchaseAmount)*100, 2 );
									}
									echo (@$ProfitRatio) ? (@$ProfitRatio) : ''
								?>
							</td>
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