<form method="post" id="customerForm">
	<input type="hidden" name="table_id" value="<?php echo $table_id; ?> ">
	<div align="center"><span style=" color: #2D4161; font-weight: bold; font-size: 14px; ">CUSTOMER INFORMATION</span></div>
	<div>
		<div style="padding: 5px 25px; ">
			<br>
			<table width="100%">
				<tr>
					<td style="padding-right: 5px;">
						<div class="input-icon">
							<i class="fa fa-user"></i>
							<input type="text" class="form-control" placeholder="Name" style="background-color: #f5f5f5 !important" name="c_name" id="c_name" required="required" value="<?php echo @$Customer->name; ?>">
						</div><br>
					</td>
					<td style="padding-right: 5px;">
						<div class="input-icon">
							<i class="fa fa-mobile" style="font-size: 20px;"></i>
							<input type="text" class="form-control" placeholder="Mobile" style="background-color: #f5f5f5 !important" name="c_mobile_no" id="c_mobile_no" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required" minlength="10" value="<?php echo @$Customer->mobile_no; ?>" readonly>
						</div><br>
					</td>
				</tr>
				<tr>
					<td style="padding-right: 5px;">
						<?php if($Customer->dob=='01-1-1970'){
							$Customer->dob='';
						} ?>
						<div class="input-icon">
							Date of Birth<i class="fa fa-child"></i>
							<input type="text" class="form-control date-picker" placeholder="dd-mm-yyyy" style="background-color: #f5f5f5 !important" name="dob" id="dob" value="<?php echo @$Customer->dob; ?>" data-date-format="dd-mm-yyyy" autocomplete="off">
						</div>
					</td>
					<td style="padding-left: 5px;">
						<?php if($Customer->anniversary=='01-1-1970'){
							$Customer->anniversary='';
						} ?>
						<div class="input-icon">
							Date of Anniversary<i class="fa fa-empire"></i>
							<input type="text" class="form-control date-picker" placeholder="dd-mm-yyyy" style="background-color: #f5f5f5 !important" name="doa" id="doa" value="<?php echo @$Customer->anniversary; ?>" data-date-format="dd-mm-yyyy" autocomplete="off">
						</div>
					</td>
				</tr>
			</table>
			<br>
			<div class="input-icon">
				<i class="fa fa-envelope-square" style="font-size: 20px;"></i>
				<input type="text" class="form-control" placeholder="Email" style="background-color: #f5f5f5 !important" name="c_email" id="c_email" value="<?php echo @$Customer->email; ?>">
			</div>
			<br>
			<textarea rows="4" cols="50" placeholder="Address..." name="c_address" id="c_address" style="line-height: 20px; background: whitesmoke;resize: none;" class="form-control"><?php echo @$Customer->address; ?></textarea>
		</div>
		<br/>
		<div align="center">
			<button type="button" class="btn " id="closeWaitBox7">CLOSE</button>
			<button type="button" class="btn btn-danger" id="UpdateCustomer">SAVE</button>
		</div>
	</div>
</form>