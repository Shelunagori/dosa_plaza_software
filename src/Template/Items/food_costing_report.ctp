<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Food-Costing Report | DOSA PLAZA'); ?>
<style type="text/css">
.catName{
	font-size: 18px;
	font-weight: 600;
	margin: 10px
}
.subcatName{
	font-size: 15px;
	font-weight: 500;
	margin: 10px
}
fieldset {
    min-width: 1px !important;
    padding: 1px !important;
    margin: 2px !important;
    border: 1px solid #a29797 !important !important;
}
legend{
	width: auto !important;
	border-bottom: 0px solid #e5e5e5 !important;
}
</style>
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

				<?php if($from_date && $to_date){
					$categoryWisetotalsellQuanity=0;
					$categoryWisetotalsellAmount=0;
					$categoryWisetotalpurchageAmount=0; 
					foreach ($itemCategories as $itemCategorie) {
						$category_name = $itemCategorie->name;
						echo "<fieldset><legend class='catName'> &nbsp;".$category_name." &nbsp; </legend>";
						$item_sub_categories = $itemCategorie->item_sub_categories;
						$SubCategoryWisetotalsellQuanity=0;
						$SubCategoryWisetotalsellAmount=0;
						$SubCategoryWisetotalpurchageAmount=0; 
						foreach ($item_sub_categories as $item_sub_category) {
							$sub_category_name = $item_sub_category->name;
							$Items=$item_sub_category->items;
							echo "<fieldset><legend class='subcatName'> &nbsp;".$sub_category_name."&nbsp; </legend>";
							?>
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
										<?php 
										$itemWisetotalsellQuanity=0;
										$itemWisetotalsellAmount=0;
										$itemWisetotalpurchageAmount=0;
										$d=0;$x=0; foreach ($Items as $Item): ?>
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
											<?php
											 //Total
											$itemWisetotalsellQuanity+=$Item->selling_quantity;
											$itemWisetotalsellAmount+=$Item->selling_amount;
											$itemWisetotalpurchageAmount+=$PurchaseAmount;

											$x++; endforeach; 

								$SubCategoryWisetotalsellQuanity+=$itemWisetotalsellQuanity;
								$SubCategoryWisetotalsellAmount+=$itemWisetotalsellAmount;
								$SubCategoryWisetotalpurchageAmount+=$itemWisetotalpurchageAmount; 
											?>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="2" style="text-align:right">Sub Total</th>
												<th><?php echo $itemWisetotalsellQuanity;?></th>
												<th></th>
												<th><?php echo $itemWisetotalsellAmount;?></th>
												<th></th>
												<th><?php echo $itemWisetotalpurchageAmount;?></th>
												<th style="text-align: center;">
													<?php 
														$ProfitRatio=0;
														$Profit=0;
														$Profit = $itemWisetotalsellAmount - $itemWisetotalpurchageAmount;
														if($itemWisetotalpurchageAmount){
															$ProfitRatio = round( ($Profit/$itemWisetotalpurchageAmount)*100, 2 );
														}
														echo (@$ProfitRatio) ? (@$ProfitRatio) : ''
													?>
												</th>
											</tr>
										</tfoot>
									</table>
								</div>
								</fieldset>
							<?php
						}
						?>
							<table class="table table-bordered table-str">
								<thead>
									<tr>
										<th style="visibility:hidden">S.No.</th>
										<th style="visibility:hidden">Item Name</th>
										<th style="text-align: center;">Total Selling Quantity</th>
 										<th style="text-align: center;">Total Selling Amount</th>
 										<th style="text-align: center;">Total Purchase Amount</th>
										<th style="text-align: center;">Total Profit Ratio(%)</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th colspan="2" style="text-align:right">Sub Total</th>
										<th><?php echo $SubCategoryWisetotalsellQuanity;?></th>
 										<th><?php echo $SubCategoryWisetotalsellAmount;?></th>
 										<th><?php echo $SubCategoryWisetotalpurchageAmount;?></th>
										<th style="text-align: center;">
											<?php 
												$ProfitRatio=0;
												$Profit=0;
												$Profit = $SubCategoryWisetotalsellAmount - $SubCategoryWisetotalpurchageAmount;
												if($SubCategoryWisetotalpurchageAmount){
													$ProfitRatio = round( ($Profit/$SubCategoryWisetotalpurchageAmount)*100, 2 );
												}
												echo (@$ProfitRatio) ? (@$ProfitRatio) : ''
											?>
										</th>
									</tr>
								</tfoot>
							</table>
						</fieldset>

						<?php
					}

				} ?>
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