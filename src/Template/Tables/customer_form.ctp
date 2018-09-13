
<div style="padding-right: 12px;" id="C_Form">
    <div class="modal-dialog" >
        <div class="modal-content" style="padding: 10px;">
            <div style=" text-align: center; padding: 0px 0 15px 0px; font-size: 15px; font-weight: bold; color: #2D4161; ">CUSTOMER INFORMATION : TABLE <?php echo $table->name; ?></div>
            <div id="popupContent">
                <div align="center">
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
                                    $dob=@$Customers->dob;
                                }
                                ?>
                                 
                                <label style=" float: left; ">Date of Birth</label>
                                <input type="text" placeholder="dd-mm-yyyy" class="form-control" placeholder="Date of Birth"   name="dob" id="customer_dob" value="<?php echo $dob; ?>">
                            </div>
                            <div class="col-md-6">
                                <?php
                                if(@$Customers->anniversary==""){
                                    $doa="";
                                }else{
                                    $doa=@$Customers->anniversary;
                                }
                                ?>
                                <label style=" float: left; ">Date of Anniversary</label>
                                <input type="text" class="form-control" placeholder="Date of Anniversary"   name="customer_anniversary" id="customer_anniversary" value="<?php echo $doa; ?>">
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
                        <a href="javascript:void(0)" class="saveCommentInfo btn btn-danger">SAVE</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div id="S_msg" style="display: none;">
    <div class="modal-dialog" >
        <div class="modal-content" style="padding: 10px;">
            <div style=" text-align: center; padding: 0px 0 15px 0px; font-size: 15px; font-weight: bold; color: #0a6904 ">CUSTOMER INFORMATION SAVED</div>
        </div>
    </div>
</div>

<?php
$js="
$(document).ready(function(){ 
    $('.saveCommentInfo').die().live('click',function(event){
        var customer_name = $('#customer_name').val();
        var customer_mobile = $('#customer_mobile').val();
        var customer_email = $('#customer_email').val();
        var customer_dob = $('#customer_dob').val();
        var customer_anniversary = $('#customer_anniversary').val();
        var customer_address = $('#customer_address').val();
        var table_id = '".$table_id."';

        var url='".$this->Url->build(['controller'=>'Customers','action'=>'saveCommentInfo'])."';
        url=url+'?customer_name='+customer_name+'&customer_mobile='+customer_mobile+'&customer_email='+customer_email+'&customer_dob='+customer_dob+'&customer_anniversary='+customer_anniversary+'&customer_address='+customer_address+'&table_id='+table_id;
        $.ajax({
            url: url,
        }).done(function(response) {
            console.log(response); return;
            $('#C_Form').hide();
            $('#S_msg').show();
        });
    });
});

";


echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
?>