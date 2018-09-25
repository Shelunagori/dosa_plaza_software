<style>
#billTable tr td{
	padding: 1px 1px;
}
</style>
<?php 
$items=[]; $kotIDs=[];
foreach($Kots as $Kot){
	$kotIDs[$Kot->id]=$Kot->id;
	foreach($Kot->kot_rows as $kot_row){
		$items[$kot_row->item_id]=['quantity'=>@$items[$kot_row->item_id]['quantity']+$kot_row->quantity, 'rate'=>$kot_row->rate, 'name'=>$kot_row->item->name , 'tax_name'=>$kot_row->item->tax->name, 'tax_per'=>$kot_row->item->tax->tax_per , 'dis_applicable'=>$kot_row->item->discount_applicable];
	}
}
?>
<?php if(sizeof($items)>0){ ?>
<table width="100%">
	<tr>
		<td colspan="2" align="center">
			<span style=" color: #2D4161; font-weight: bold; font-size: 16px; ">GENERATE BILL: </span>
			<?php if($table_id>0){ ?>
				<span  style=" color: #2D4161; font-weight: bold; font-size: 16px; "> Table No. <?php echo $Table->name; ?></span>
			<?php } ?>
			<?php if($order_type=='delivery'){ ?>
				<span  style=" color: #2D4161; font-weight: bold; font-size: 16px; "> Delivery No. <?php echo $delivery_no; ?></span>
			<?php } ?>
			<?php if($order_type=='takeaway'){ ?>
				<span  style=" color: #2D4161; font-weight: bold; font-size: 16px; "> Take Away No. <?php echo $take_away_no; ?></span>
			<?php } ?>
		</td>
	</tr>
	<tr>
		<td width="30%" valign="top">
			<?php if(@$Table){ ?>
				<?php if(@$Customer){ ?>
				<div class="panel" style="border-color: #2d4161;">
	                <div style="color: #ffffff;background-color: #2d4161;border-color: #2d4161;padding: 5px;">
	                    <span style="font-size:14px;"><?php echo $Customer->name; ?> - <?php echo $Customer->customer_code; ?></span>
	                </div>
	                <div class="panel-body" style="padding: 5px;">
	                    <table width="100%">
	                        <tr>
	                            <td>Mobile</td>
	                            <td><?php echo $Customer->mobile_no; ?></td>
							</tr>
							<tr>
	                            <td>Email</td>
	                            <td><?php echo $Customer->email; ?></td>
	                        </tr>
	                        <tr>
	                            <td>Address</td>
	                            <td><?php echo $Customer->address; ?></td>
	                        </tr>
	                    </table>
	                </div>
	            </div>
	            <input type="hidden" id="c_mobile_no" value="<?php echo $Customer->mobile_no; ?>">
	        	<?php }else{ ?>
	        		<br/><br/>
	        		<div style=" text-align: center; color: #828282; font-size: 15px; ">
	            		<i class="fa fa-thumbs-o-down" style="font-size: 22px;"></i><br/>
	            		Customer is not linked.
	            	</div>
	        	<?php } ?>
	            <input type="hidden" id="qwerty" value="1">
			<?php }else{ ?>
				<div align="center">
					<span style=" color: #2D4161; font-weight: bold; font-size: 14px;">CUSTOMER INFO</span>
				</div>
				
				<table width="100%" id="newCustomerTable" style="display:block;">
						<tr>
							<td style="padding-right: 5px;width: 40%;" width="40%">
								<?php echo $this->Form->input('cus_name',['label' => false,'class'=>'form-control  input-sm ', 'placeholder' => 'Name']);?>
							</td>
							<td style="padding-right: 5px;width: 40%;" width="40%">
								<?php echo $this->Form->input('cus_mobile',['label' => false,'class'=>'form-control input-sm ', 'placeholder' => 'Mobile']);?>
							</td>
						</tr>
						<tr>
							<td colspan="2"><br/>
								<textarea class="form-control" resize="none" placeholder="Address" id="cus-address"></textarea>
							</td>
						</tr>
					</table>
			<?php } ?>
			
				
		</td>
		
		<td width="70%" style="padding-left:20px;" valign="top"><br/>
			<input type="hidden" name="kot_ids" value="<?php echo implode(',', $kotIDs); ?>">
			<div>
				<table width="100%" id="billTable" class="table table-striped">
					<thead>
						<tr style="border-bottom: solid 1px #F1F1F2; " > 
							<th width="5%">#</th>
							<th>Item</th>
							<th style="text-align:center;" width="5%">Qty</th>
							<th style="text-align:center;" width="10%">Rate</th>
							<th style="text-align:center;" width="10%">Amount</th>
							<th width="10%" style="text-align:center;">Dis%</th>
							<th width="10%" style="text-align:center;">Dis&#8377;</th>
							<th width="10%" style="text-align:center;">GST</th>
							<th style="text-align:right;" width="10%">Net</th>
						</tr>
					</thead>
					<tbody class="main">
					<?php 
					$i=0; $total=0; $row_no=0; 
					foreach($items as $item_id=>$item){ 
						$row_no++; $column_no=0; ?>
						<tr style="border-bottom: solid 1px #F1F1F2; ">
							<td><?php echo ++$i.'.'; ?></td>
							<td item_id="<?php echo $item_id; ?>" ><?php echo $item['name']; ?></td>
							<td style="text-align:center;"><?php echo $item['quantity']; ?></td>
							<td style="text-align:center;"><?php echo $item['rate']; ?></td>
							<td style="text-align:center;"><?php echo $item['quantity']*$item['rate']; ?></td>
							<?php $column_no++; ?>
							<td><?php if($item['dis_applicable']==1){?>
									<input type="text" class="disBox" style="width:20%;text-align:center;width:100%;"  row_no="<?php echo $row_no; ?>" column_no="<?php echo $column_no; ?>"  />
								<?php } ?>
							</td>
							<?php $column_no++; ?>
							<td><?php if($item['dis_applicable']==1){?>
									<input type="text" class="disBoxamt" style="width:20%;text-align:center;width:100%;" row_no="<?php echo $row_no ; ?>" column_no="<?php echo $column_no; ?>" />
								<?php } ?>
							</td>

							<td style="text-align:center;"><?php echo $item['tax_name']; ?><span class="percen" style="display:none"><?php echo $item['tax_per']; ?></span></td>
							<td style="text-align:right;">
								<?php 
									$totalamount=$item['quantity']*$item['rate']; 
									$TaxAmount=($totalamount*$item['tax_per'])/100;
									echo $ToatlAmounts=round($TaxAmount+$totalamount,2);
									$total+=$ToatlAmounts; 
								?>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; " >
							<td colspan="3" style="text-align:right;">
								<table>
									<tr>
										<td>
											<input type="text" name="offer_code" placeholder="OFFER CODE" style="text-transform:uppercase">
										</td>
										<td>
											<button type="button" class="apply">APPLY</button>
										</td>
									</tr>
								</table>
								<div id="offerShow"></div>
							</td>
							<td colspan="2" style="text-align:right;" class="overAllTd"> Over All Discount</td>
							<td colspan="" class="overAllTd"> 
								<input type="text" class="overalldis" style="width:20%;text-align:center;width:100%;" placeholder="" />
							</td>
							 
							<td colspan="2" style="text-align:right;">Total</td>
							<td style="text-align:right;" ><?php echo $total; ?></td>
						</tr>
					
						<tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; " > 
							<td colspan="8" style="text-align:right;">Round off</td>
							<td style="text-align:right;" >
							<?php
								$totalAfterTax=$total-round($total);
								$totalAfterTaxAfterRound=round($totalAfterTax);
								echo round($totalAfterTaxAfterRound-$totalAfterTax,2);
							?>
							</td>
						</tr>
						<tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; background-color: #E6E7E8;font-weight: bold;" > 
							<td colspan="8" style="text-align:right;">NET AMOUNT</td>
							<td style="text-align:right;" ><?php echo round($total); ?></td>
						</tr>
					</tfoot>
				</table>
				<div align="center">
					<br/>
					<span class="CancelBill" > CLOSE </span>
					<span class="SubmitBill">SAVE & PRINT BILL</span>
				</div>
			</div>
		</td>
	</tr>
</table>
<?php }else{ ?>
	<div align="center">
		<span style=" color: #2D4161; font-weight: bold; font-size: 16px; ">GENERATE BILL</span><br/><br/><br/>
		<div style=" color: #fa6775; font-weight: bold; font-size: 16px; ">Create at-least one KOT.</div><br/>
		<span class="CancelBill" > Close </span>
	</div>
<?php } ?>

<style>
.disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}
</style>