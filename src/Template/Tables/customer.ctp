<div style=" padding: 5px 25px; ">
	<div align="center"><span style="color: #2D4161;font-size: 14px;font-weight: bold;">CUSTOMER INFORMATION <br/> TABLE: <?= h($table->name) ?></span></div>
	<br/>
	<div class="input-icon">
	    <i class="fa fa-user"></i>
	    <input type="text" class="form-control" placeholder="Name" style="background-color: #f5f5f5 !important" name="c_name">
	</div>
	<br/>
	<div class="input-icon">
	    <i class="fa fa-mobile"></i>
	    <input type="text"  class="form-control" placeholder="Mobile"  style="background-color: #f5f5f5 !important" name="c_mobile_no">
	</div>
	<br/>
	<table width="100%">
		<tr>
			<td style="padding-right: 5px;">
				<div class="input-icon">
				    Date of Birth<i class="far fa-birthday-cake"></i>
				    <input type="date"  class="form-control" placeholder="Date of Birth" style="background-color: #f5f5f5 !important" name="dob">
				</div>
			</td>
			<td style="padding-left: 5px;">
				<div class="input-icon">
				    Date of Anniversary<i class="fa fa-mobile"></i>
				    <input type="date" class="form-control" placeholder="Date of Anniversary" style="background-color: #f5f5f5 !important" name="doa">
				</div>
			</td>
		</tr>
	</table>
	<br/>
	<div class="input-icon">
	    <i class="fa fa-mobile"></i>
	    <input type="text"  class="form-control" placeholder="Email"  style="background-color: #f5f5f5 !important" name="c_email">
	</div>
	<br/>
	<textarea rows="4" cols="50" placeholder="Address..." name="c_address" style="line-height: 20px; background: whitesmoke;resize: none;" class="form-control"></textarea>
	<br/>
	
	<div align="center">
	    <span class="closeCustomerBox">Close</span>
	    <span class="createCustomer">CREATE</span>
	</div>
</div>