<style type="text/css">
.font{
	font-size: 10px;
}
.top{
	margin-top: 5px;
}
..panel-heading
{
	background-color: #2d4161 !important;
}

</style>



	<?php 
if($searchbox==1 or $searchbox==0){  ?>
	<table width="100%" >
		<tr>
			<td style="padding-right: 5px;" width="40%">
				<div class="input-icon">
					<i class="fa fa-mobile" style="font-size: 20px;"></i>
					<input type="text"  class="form-control " placeholder="Mobile"  style="background-color: #f5f5f5 !important" name="search" id="search" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
				</div>
			</td> 
			<td style="padding-right: 0px; text-align: center;" width="10%">
				<span class="saveCustomersearch" table_id="<?php echo $table->id; ?>"><i class="fa fa-search"> &nbsp;</i> </span>
			</td>
		</tr>
	</table>
	<hr style="margin: 7px;"></hr>
	<div class="panel-heading" style="background-color: #2d4161 !important;">
		<span class="panel-title" style="font-size: 12px; color: #FFF;">
			<i class="fa fa-user font"></i> <?php echo @ucwords($table->c_name);?>
		</span>
	</div>
	<div class="panel-body" style="border: none; font-size: 8px; padding:10px !important">
		<table width="100%">
			<tr>
				<td align="center" width="10%"><i class="fa fa-phone font"></i> </td>
				<td width="90%"><?php echo @$table->c_mobile;?> </td>
			</tr>
			<tr>
				<td align="center"><i class="fa fa-envelope font"></i> </td>
				<td><?php echo @$table->email;?> </td>
			</tr>
			<tr>
				<td align="center"><i class="fa fa-building font"></i> </td>
				<td><?php echo @$table->c_address;?> </td>
			</tr>
		</table>
	</div>
	<hr style="margin-top: -9px; margin-bottom: 4px;"></hr>
	<table width="100%">
		<tr>
			<td width="65%">
				<span>favorite Items</span><br/>
				<?php
				if(sizeof(@$BillRows)>0){
					foreach ($BillRows as $BillRow) {
	                    echo '<span>'.@$BillRow->item->name.'</span><br/>';
	                }
				}
				
				?>
			</td>
			<td width="35%">
				Total Amount: <?php echo @$TotalAmount; ?><br/>
				Total Amount Month: <?php echo @$TotalAmountMonth; ?><br/>
				Last Bill Amount: <?php echo @$LastBillAmount; ?>
			</td>
		</tr>
	</table>
<?php
}
elseif($searchbox==2){ 
?>
		<table width="100%" >
			<tr>
				<td style="padding-right: 5px;" width="40%">
					<div class="input-icon">
						<i class="fa fa-mobile" style="font-size: 20px;"></i>
						<input type="text"  class="form-control " placeholder="Mobile"  style="background-color: #f5f5f5 !important" name="search" id="search" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
					</div>
				</td> 
				<td style="padding-right: 0px; text-align: center;" width="10%">
					<span class="saveCustomersearch" table_id="<?php echo $table->id; ?>"><i class="fa fa-search"> &nbsp;</i> </span>
				</td>
			</tr>
		</table>
		<hr style="margin: 7px;"></hr>

		<input type="hidden" name="c_table_id" value="<?php echo $table->id; ?>" id="c_table_id">

		<table width="100%" >
			<tr>
				<td width="45%" style="padding-right: 5px;">
					<input type="text" class="form-control" placeholder="Name" style="background-color: #f5f5f5 !important" name="c_name" id="c_name" value="">
				</td>
				<td width="45%" style="padding-right: 5px;">
					<input type="text"  class="form-control" placeholder="Mobile" value="<?php echo $search; ?>"  style="background-color: #f5f5f5 !important" name="c_mobile_no" id="c_mobile_no"  maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
				</td>
			</tr>
			<tr><td colspan="2" style="padding-top:5px"> </td></tr>
			<tr>
				<td width="45%" style="padding-right: 5px;">
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
					echo $this->Form->input('c_pax', ['empty' => "Select Pax",'label' => false,'options' => $options,'class' => 'form-control','id' => 'c_pax', 'style' => 'background-color: #F5F5F5;']); ?>
				</td>
				<td width="45%" style="padding-right: 5px;">
					<input type="text"  class="form-control" placeholder="Email"  style="background-color: #f5f5f5 !important" name="c_email" id="c_email" value="">
				</td>
			</tr>
		</table>
 		<div class="col-md-12 top" style="padding-right: 5px;"> 
		<textarea rows="4" cols="50" placeholder="Address..." name="c_address" id="c_address" style="line-height: 20px; background: whitesmoke;resize: none;" class="form-control"></textarea>
		</div>
		 
		<div align="center"class="col-md-12 top" style="margin-top: 15px;margin-bottom : 15px;">
 			<span class="saveCustomer">SAVE</span>
		</div>
		</br> 

<?php 
} 
?>




