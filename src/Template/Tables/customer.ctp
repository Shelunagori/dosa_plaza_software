<div style=" padding: 5px 25px; ">
	<div align="center"><span style="color: #2D4161;font-size: 14px;font-weight: bold;">CUSTOMER INFORMATION <br/> TABLE: <?= h($table->name) ?></span></div>
	<br/>
	<?php 
		if($searchbox==0){ ?>
			<table width="100%" >
			<tr>
				<td style="padding-right: 5px;" width="40%">
					<div class="input-icon">
						<i class="fa fa-mobile" style="font-size: 20px;"></i>
						<input type="text"  class="form-control input-small" placeholder="Mobile"  style="background-color: #f5f5f5 !important" name="search_mobile" id="search_mobile" maxlength="10" minlength="10">
					</div>
				</td>
				<td style="padding-right: 5px;" width="10%">
					OR
				</td>
				<td style="padding-right: 5px;" width="40%">
					<div class="input-icon">
						<i class="fa fa-mobile" style="font-size: 20px;"></i>
						<input type="text"  class="form-control input-small" placeholder="Customer Code"  style="background-color: #f5f5f5 !important" name="search_code" id="search_code">
					</div>
				</td>
				<td style="padding-right: 0px; text-align: center;" width="10%">
					<span class="saveCustomersearch searchcustomber" table_id="<?php echo $table->id; ?>"><i class="fa fa-search" style="padding-right: 5px;"> &nbsp;</i> </span>
				</td>
			</tr>
		</table>
		<hr style=" margin-bottom: -10px !important ;margin: 7px -27px;"></hr>

		<br/>
		<input type="hidden" name="c_table_id" value="<?php echo $table->id; ?>" id="c_table_id">
		<div class="input-icon">
			<i class="fa fa-user"></i>
			<input type="text" class="form-control" placeholder="Name" style="background-color: #f5f5f5 !important" name="c_name" id="c_name" value="<?php echo @$table->c_name; ?>">
		</div>
		<br/>
		<table width="100%">
			<tr>
				<td style="padding-right: 5px;">
					<div class="input-icon">
						<i class="fa fa-mobile" style="font-size: 20px;"></i>
						<input type="text"  class="form-control" placeholder="Mobile"  style="background-color: #f5f5f5 !important" name="c_mobile_no" id="c_mobile_no" value="<?php echo @$table->c_mobile; ?>" maxlength="10" minlength="10">
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
						echo $this->Form->input('c_pax', ['empty' => "Select No. of Pax",'label' => false,'options' => $options,'class' => 'form-control','value' => @$table->no_of_pax, 'id' => 'c_pax', 'style' => 'background-color: #F5F5F5;']); ?>
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
						if($table->dob==""){
							$dob="";
						}else{
							$dob=date('Y-m-d',strtotime($table->dob));
						}
						?>
						Date of Birth<i class="fa fa-child"></i>
						<input type="date"  class="form-control" placeholder="Date of Birth" style="background-color: #f5f5f5 !important" name="dob" id="dob" value="<?php echo $dob; ?>">
					</div>
				</td>
				<td style="padding-left: 5px;">
					<div class="input-icon">
						<?php
						if($table->doa==""){
							$doa="";
						}else{
							$doa=date('Y-m-d',strtotime($table->doa));
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
			<input type="text"  class="form-control" placeholder="Email"  style="background-color: #f5f5f5 !important" name="c_email" id="c_email" value="<?php echo @$table->email; ?>">
		</div>
		<br/>
		<textarea rows="4" cols="50" placeholder="Address..." name="c_address" id="c_address" style="line-height: 20px; background: whitesmoke;resize: none;" class="form-control"><?php echo @$table->c_address; ?></textarea>
		<br/>
	<?php 
		}
		else { ?>
			<table width="100%" >
			<tr>
				<td style="padding-right: 5px;" width="40%">
					<div class="input-icon">
						<i class="fa fa-mobile" style="font-size: 20px;"></i>
						<input type="text"  class="form-control input-small" placeholder="Mobile"  style="background-color: #f5f5f5 !important" name="search_mobile" id="search_mobile" value="<?php echo @$searchBy->mobile_no;?>" maxlength="10" minlength="10">
					</div>
				</td>
				<td style="padding-right: 5px;" width="10%">
					OR
				</td>
				<td style="padding-right: 5px;" width="40%">
					<div class="input-icon">
						<i class="fa fa-mobile" style="font-size: 20px;"></i>
						<input type="text"  class="form-control input-small" placeholder="Customer Code"  style="background-color: #f5f5f5 !important" name="search_code" id="search_code" value="<?php echo @$searchBy->customer_code;?>">
					</div>
				</td>
				<td style="padding-right: 0px; text-align: center;" width="10%">
					<span class="saveCustomersearch searchcustomber" table_id="<?php echo $table->id; ?>"><i class="fa fa-search" style="padding-right: 5px;"> &nbsp;</i> </span>
				</td>
			</tr>
		</table>
		<hr style=" margin-bottom: -10px !important ;margin: 7px -27px;"></hr>

		<br/>
		<input type="hidden" name="c_table_id" value="<?php echo $table->id; ?>" id="c_table_id">
		<div class="input-icon">
			<i class="fa fa-user"></i>
			<input type="text" class="form-control" placeholder="Name" style="background-color: #f5f5f5 !important" name="c_name" id="c_name" value="<?php echo @$searchBy->name;?>">
		</div>
		<br/>
		<table width="100%">
			<tr>
				<td style="padding-right: 5px;">
					<div class="input-icon">
						<i class="fa fa-mobile" style="font-size: 20px;"></i>
						<input type="text"  class="form-control" placeholder="Mobile"  style="background-color: #f5f5f5 !important" name="dasdsd" id="asdasd" readonly value="<?php echo @$searchBy->mobile_no;?>" maxlength="10" minlength="10">
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
						echo $this->Form->input('c_pax', ['empty' => "Select No. of Pax",'label' => false,'options' => $options,'class' => 'form-control','value' => @$table->no_of_pax, 'id' => 'c_pax', 'style' => 'background-color: #F5F5F5;']); ?>
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
						if($searchBy->dob==""){
							$dob="";
						}else{
							$dob=date('Y-m-d',strtotime($searchBy->dob));
						}
						?>
						Date of Birth<i class="fa fa-child"></i>
						<input type="date"  class="form-control" placeholder="Date of Birth" style="background-color: #f5f5f5 !important" name="dob" id="dob" value="<?php echo $dob; ?>">
					</div>
				</td>
				<td style="padding-left: 5px;">
					<div class="input-icon">
						<?php
						if($searchBy->anniversary==""){
							$doa="";
						}else{
							$doa=date('Y-m-d',strtotime($searchBy->anniversary));
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
			<input type="text"  class="form-control" placeholder="Email"  style="background-color: #f5f5f5 !important" name="c_email" id="c_email" value="<?php echo @$searchBy->email;?>">
		</div>
		<br/>
		<textarea rows="4" cols="50" placeholder="Address..." name="c_address" id="c_address" style="line-height: 20px; background: whitesmoke;resize: none;" class="form-control"><?php echo @$searchBy->address;?></textarea>
		<br/>
	<?php 
		}
	?>
	
	
	<div align="center">
		<span class="closeCustomerBox2">Close</span>
		<span class="saveCustomer">UPDATE</span>
	</div>
</div>