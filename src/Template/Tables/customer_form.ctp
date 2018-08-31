<div>
    <br/>
    <div class="row">
        <div class="col-md-6">
            <input type="hidden"  id="table_id" value="<?php echo @$table_id;?>">
            <input type="text" class="form-control" placeholder="Name"   name="name" id="customer_name" value="<?php echo @$Customers->name;?>">
        </div>
        <div class="col-md-6">
            <input type="text"  class="form-control" placeholder="Mobile" name="mobile_no" id="customer_mobile" value="<?php echo @$Customers->mobile_no;?>" maxlength="10" minlength="10">
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-6">
            <input type="text"  class="form-control" placeholder="Email" name="email" id="customer_email" value="<?php echo @$Customers->email;?>">
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-6">
            <?php
            if(@$Customers->dob==""){
                $dob="";
            }else{
                $dob=date('Y-m-d',strtotime(@$Customers->dob));
            }
            ?>
            Date of Birth 
            <input type="date"  class="form-control" placeholder="Date of Birth"   name="dob" id="customer_dob" value="<?php echo $dob; ?>">
        </div>
        <div class="col-md-6">
            <?php
            if(@$Customers->anniversary==""){
                $doa="";
            }else{
                $doa=date('Y-m-d',strtotime(@$Customers->anniversary));
            }
            ?>
            Date of Anniversary 
            <input type="date" class="form-control" placeholder="Date of Anniversary"   name="customer_anniversary" id="doa" value="<?php echo $doa; ?>">
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12" style="padding-left: 15px; padding-right: 15px;">
            <textarea rows="4" cols="50" placeholder="Address..." name="address" id="customer_address" style="line-height: 20px;resize: none;" class="form-control"><?php echo @$Customers->address;?></textarea>
        </div>
    </div>
    <br/>
</div>

<br/><br/>
<div align="center">
	<a href="javascript:void(0)" class="closeCustomerPopup btn default">CLOSE</a>
	<a href="javascript:void(0)" class="saveCommentInfo btn btn-danger">SAVE</a>
</div>