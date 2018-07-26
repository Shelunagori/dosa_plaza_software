<style>
#billTable tr td{
	padding: 8px 2px;
}
</style>
<?php 
$items=[]; $kotIDs=[];
foreach($Kots as $Kot){
	$kotIDs[$Kot->id]=$Kot->id;
	foreach($Kot->kot_rows as $kot_row){
		$items[$kot_row->item_id]=['quantity'=>@$items[$kot_row->item_id]['quantity']+$kot_row->quantity, 'rate'=>$kot_row->rate, 'name'=>$kot_row->item->name];
	}
}
?>
<?php if(sizeof($items)>0){ ?>
<table width="100%">
	<tr>
		<td colspan="2" align="center"><span style=" color: #2D4161; font-weight: bold; font-size: 16px; ">GENERATE BILL</span></td>
	</tr>
	<tr>
		<td width="30%" valign="top">
			<div align="center"><span style=" color: #2D4161; font-weight: bold; font-size: 14px; ">CUSTOMER INFORMATION</span></div>
			<div>
				<div style=" padding: 5px 25px; ">
					<div class="input-icon">
						<i class="fa fa-user"></i>
						<input type="text" class="form-control" placeholder="Name" style="background-color: #f5f5f5 !important" name="c_name" id="c_name" value="<?php echo @$Table->c_name; ?>">
					</div>
					<br/>
					<table width="100%">
						<tr>
							<td style="padding-right: 5px;">
								<div class="input-icon">
									<i class="fa fa-mobile" style="font-size: 20px;"></i>
									<input type="text"  class="form-control" placeholder="Mobile"  style="background-color: #f5f5f5 !important" name="c_mobile_no" id="c_mobile_no" value="<?php echo @$Table->c_mobile; ?>" maxlength="10" minlength="10">
								</div>
							</td>
							<td style="padding-left: 5px;">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
									<?php
									$options=[];
									$options[]=['text' =>1, 'value' => 1];
									$options[]=['text' =>2, 'value' => 2];
									$options[]=['text' =>3, 'value' => 3];
									$options[]=['text' =>4, 'value' => 4];
									$options[]=['text' =>5, 'value' => 5];
									$options[]=['text' =>6, 'value' => 6];
									$options[]=['text' =>7, 'value' => 7];
									$options[]=['text' =>8, 'value' => 8];
									$options[]=['text' =>9, 'value' => 9];
									$options[]=['text' =>10, 'value' => 10];
									echo $this->Form->input('c_pax', ['empty' => "Select No. of Pax",'label' => false,'options' => $options,'class' => 'form-control','value' => @$Table->no_of_pax, 'id' => 'c_pax', 'style' => 'background-color: #F5F5F5;']); ?>
								</div>
							</td>
						</tr>
					</table>
					<br/>
					<table width="100%">
						<tr>
							<td style="padding-right: 5px;">
								<div class="input-icon">
									<?php
									if($Table->dob==""){
										$dob="";
									}else{
										$dob=date('Y-m-d',strtotime($Table->dob));
									}
									?>
									Date of Birth<i class="fa fa-child"></i>
									<input type="date"  class="form-control" placeholder="Date of Birth" style="background-color: #f5f5f5 !important" name="dob" id="dob" value="<?php echo $dob; ?>">
								</div>
							</td>
							<td style="padding-left: 5px;">
								<div class="input-icon">
									<?php
									if($Table->doa==""){
										$doa="";
									}else{
										$doa=date('Y-m-d',strtotime($Table->doa));
									}
									?>
									Date of Anniversary<i class="fa fa-empire"></i>
									<input type="date" class="form-control" placeholder="Date of Anniversary" style="background-color: #f5f5f5 !important" name="doa" id="doa" value="<?php echo $doa; ?>">
								</div>
							</td>
						</tr>
					</table>
					<br/>
					<div class="input-icon">
						<i class="fa fa-envelope-square" style="font-size: 20px;"></i>
						<input type="text"  class="form-control" placeholder="Email"  style="background-color: #f5f5f5 !important" name="c_email" id="c_email" value="<?php echo @$Table->email; ?>">
					</div>
					<br/>
					<textarea rows="4" cols="50" placeholder="Address..." name="c_address" id="c_address" style="line-height: 20px; background: whitesmoke;resize: none;" class="form-control"><?php echo @$Table->c_address; ?></textarea>
					
				</div>
			</div>
		</td>
		<td width="70%" style="padding-left:20px;">
			<input type="hidden" name="kot_ids" value="<?php echo implode(',', $kotIDs); ?>">
			<div>
				<table width="100%" id="billTable">
					<thead>
						<tr style="border-bottom: solid 1px #F1F1F2; " > 
							<th width="5%">#</th>
							<th>Item</th>
							<th style="text-align:center;" width="5%">Qty</th>
							<th style="text-align:center;" width="10%">Rate</th>
							<th style="text-align:center;" width="10%">Amount</th>
							<th width="10%" style="text-align:center;">Dis%</th>
							<th style="text-align:right;" width="10%">Net</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$i=0; $total=0;
					foreach($items as $item_id=>$item){ ?>
						<tr style="border-bottom: solid 1px #F1F1F2; ">
							<td><?php echo ++$i.'.'; ?></td>
							<td item_id="<?php echo $item_id; ?>" ><?php echo $item['name']; ?></td>
							<td style="text-align:center;"><?php echo $item['quantity']; ?></td>
							<td style="text-align:center;"><?php echo $item['rate']; ?></td>
							<td style="text-align:center;"><?php echo $item['quantity']*$item['rate']; ?></td>
							<td><input type="text" class="disBox" style="width:20%;text-align:center;width:100%;" placeholder="" /></td>
							<td style="text-align:right;"><?php echo $item['quantity']*$item['rate']; $total+=$item['quantity']*$item['rate']; ?></td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; " > 
							<td colspan="6" style="text-align:right;">Total</td>
							<td style="text-align:right;" ><?php echo $total; ?></td>
						</tr>
						<tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; " > 
							<td colspan="6" style="text-align:right;">GST</td>
							<td style="text-align:right;">
								<select>
								<?php foreach($taxes as $tax){ ?>
									<option value="<?php echo $tax->tax_per; ?>" tax_id="<?php echo $tax->id; ?>" ><?php echo $tax->name; ?></option>
								<?php } ?>
								</select>
							</td>
						</tr>
						<tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; " > 
							<td colspan="6" style="text-align:right;">Round off</td>
							<td style="text-align:right;" >
							<?php
								$totalAfterTax=$total-round($total*($tax->tax_per/100),2);
								$totalAfterTaxAfterRound=round($totalAfterTax);
								echo round($totalAfterTaxAfterRound-$totalAfterTax,2);
							?>
							</td>
						</tr>
						<tr style=" border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; background-color: #E6E7E8;font-weight: bold;" > 
							<td colspan="6" style="text-align:right;">NET AMOUNT</td>
							<td style="text-align:right;" ><?php echo $totalAfterTaxAfterRound; ?></td>
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

