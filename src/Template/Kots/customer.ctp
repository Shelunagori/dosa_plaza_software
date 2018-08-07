<style type="text/css">
.font{
	font-size: 7px;
}
</style>
<table width="100%" >
	<tr>
		<td style="padding-right: 5px;" width="40%">
			<div class="input-icon">
				<i class="fa fa-mobile" style="font-size: 20px;"></i>
				<input type="text"  class="form-control " placeholder="Mobile"  style="background-color: #f5f5f5 !important" name="search_mobile" id="search_mobile" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
			</div>
		</td> 
		<td style="padding-right: 0px; text-align: center;" width="10%">
			<span class="saveCustomersearch searchcustomber" table_id="<?php echo $table->id; ?>"><i class="fa fa-search"> &nbsp;</i> </span>
		</td>
	</tr>
</table>
<hr style="margin: 7px;"></hr>
<div class="panel-heading" style="background-color: #2d4161de;">
	<span class="panel-title" style="font-size: 12px; color: #FFF;">
		<i class="fa fa-user font"></i> <?php echo @ucwords($table->c_name);?>
	</span>
</div>
<div class="panel-body" style="border: none; font-size: 8px; padding:10px !important">
	<table>
		<tr>
			<td width="10%"><i class="fa fa-phone font"></i> </td>
			<td width="90%"><?php echo @$table->c_mobile;?> </td>
		</tr>
		<tr>
			<td><i class="fa fa-envelope font"></i> </td>
			<td><?php echo @$table->email;?> </td>
		</tr>
		<tr>
			<td><i class="fa fa-building font"></i> </td>
			<td><?php echo @$table->c_address;?> </td>
		</tr>
	</table>
</div>
<hr style="margin-top: -9px; margin-bottom: 4px;"></hr>
<table width="100%">
	<tr>
		<td width="65%">Favorite Item</td>
		<td width="35%">Total Amount</td>
	</tr>
</table>



