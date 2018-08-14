<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", '  Edit-Customer | DOSA PLAZA'); ?>


<style>
    .searchMobileCode{
        color: #FFF; background-color: #FA6775; padding: 10px 0px 6px 4px;font-size:12px;cursor: pointer;margin-right: 17px;
    }
</style>
<div style="height: 15px;" ></div>
<div class="row">
    <div class="col-md-6 main-div">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    Edit Customer Info
                </div>
                <div class="tools">
                </div>
                <div class="actions"></div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-8">
                        <table >
                            <tr>
                                <td  width="40%">
                                    <div class="input-icon" style="padding: 0px !important;">
                                        <i class="fa fa-mobile" style="font-size: 20px;margin: 8px 2px 7px 4px;"></i>
                                        <input type="text"  class="form-control " placeholder="Mobile / Customer Code"  style="background-color: #f5f5f5 !important" name="search" id="search" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                </td> 
                                <td style="text-align: center;" width="10%">
                                    <span class="searchMobileCode" no_of_pax='<?php echo $Bills->no_of_pax; ?>' ><i class="fa fa-search"> &nbsp;</i> </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?= $this->Form->create($Customer,['id'=>'form_sample_1']) ; ?>
                <div id="CustomerInfo" >
                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Name"   name="name" id="c_name" value="<?php echo @$Customers->name;?>">
                        </div>
                        <div class="col-md-6">
                            <input type="text"  class="form-control" placeholder="Mobile"    name="mobile_no" id="asdasd" value="<?php echo @$Customers->mobile_no;?>" maxlength="10" minlength="10">
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text"  class="form-control" placeholder="Email"    name="email" id="c_email" value="<?php echo @$Customers->email;?>">
                        </div>
                        <div class="col-md-6">
                            <?php
                                $no_of_pax=$Bills->no_of_pax;
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
                                echo $this->Form->input('no_of_pax', ['empty' => "Select No. of Pax",'label' => false,'options' => $options,'class' => 'form-control','value' => @$Table->no_of_pax, 'id' => 'c_pax', 'value'=>$no_of_pax]); ?>
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
                            <input type="date"  class="form-control" placeholder="Date of Birth"   name="dob" id="dob" value="<?php echo $dob; ?>">
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
                            <input type="date" class="form-control" placeholder="Date of Anniversary"   name="anniversary" id="doa" value="<?php echo $doa; ?>">
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12" style="padding-left: 15px; padding-right: 15px;">
                            <textarea rows="4" cols="50" placeholder="Address..." name="address" id="c_address" style="line-height: 20px;resize: none;" class="form-control"><?php echo @$Customers->address;?></textarea>
                        </div>
                    </div>
                    <br/>
                </div>
                <div align="center"><?php echo $this->Form->button('UPDATE',['class'=>'btn btn-danger']); ?></div>

               <?= $this->Form->end(); ?>  
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php
$js="var form3 = $('#form_sample_1');
        var error3 = $('.alert-danger', form3);
        var success3 = $('.alert-success', form3);
        form3.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            rules: {
                    name: {
                        required: true
                    },
                    mobile_no: {
                        required: true,
                        digits:true,
                    }  
                },

            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.parent('.input-group').size() > 0) {
                    error.insertAfter(element.parent('.input-group'));
                } else if (element.attr('data-error-container')) { 
                    error.appendTo(element.attr('data-error-container'));
                } else if (element.parents('.radio-list').size() > 0) { 
                    error.appendTo(element.parents('.radio-list').attr('data-error-container'));
                } else if (element.parents('.radio-inline').size() > 0) { 
                    error.appendTo(element.parents('.radio-inline').attr('data-error-container'));
                } else if (element.parents('.checkbox-list').size() > 0) {
                    error.appendTo(element.parents('.checkbox-list').attr('data-error-container'));
                } else if (element.parents('.checkbox-inline').size() > 0) { 
                    error.appendTo(element.parents('.checkbox-inline').attr('data-error-container'));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit   
                success3.hide();
                error3.show();
            },

            highlight: function (element) { // hightlight error inputs
               $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                success3.show();
                error3.hide();
                $('#loading').show();
                form[0].submit(); // submit the form
            }

        }); 

        $('.searchMobileCode').die().live('click',function(event){
            var mobileCode = $('#search').val();
            var no_of_pax = $(this).attr('no_of_pax');
            
            var url='".$this->Url->build(['controller'=>'Customers','action'=>'infoBill'])."';
            url=url+'?mobileCode='+mobileCode+'&no_of_pax='+no_of_pax;
            $.ajax({
                url: url,
            }).done(function(response) {
                $('#CustomerInfo').html(response);
            });
        });

 
    FormValidation.init();
"; 
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>