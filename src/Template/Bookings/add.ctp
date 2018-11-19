<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'New Booking | DOSA PLAZA'); ?>
<!-- BEGIN PAGE CONTENT-->
<div class="row" style="margin-top:15px;">
    <div class="col-md-2"></div>
    <div class="col-md-8 main-div">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <?php if(!empty($id)){ ?>
                        Edit Booking
                    <?php }else{ ?>
                        New Booking
                    <?php } ?>
                </div>


				<?php if (in_array("16", $userPages)){ ?>
					<div class="tools" style="margin-right: 10px;">
						<?php
							echo $this->Html->link('<i class="fa fa-plus" style="font-size: 16px;padding-right:2px;" ></i> Booking List', '/Bookings/index',['escape' => false, 'class' => 'showLoader','style'=>'text-decoration: none;']);
						?>
					</div>
				<?php } ?>


                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="">
                    <?= $this->Form->create($booking,['id'=>'form_sample_1']); ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-12"> Booking Date <span class="required" aria-required="true">*
                             </span>
                            </label>
                            <div class="col-md-12">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input <?php if(!empty($id)){ echo "value='".date('d-m-Y', strtotime($booking->booking_date))."'"; } ?> name="booking_date" class="form-control date-picker" data-date-format="dd-mm-yyyy" required="required" placeholder="dd-mm-yyyy">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <label class="control-label col-md-12"> No. of Guests   </label>
                            <div class="col-md-12">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" <?php if(!empty($id)){ echo "value='".$booking->no_of_guests."'"; } ?> name="no_of_guests" class="form-control allowMobileOnly" Placeholder="0" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-12"> Customer Name </label>
                            <div class="col-md-12">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" <?php if(!empty($id)){ echo "value='".$booking->customer_name."'"; } ?> name="customer_name" class="form-control" Placeholder="Customer Name" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-12"> Customer Mobile </label>
                            <div class="col-md-12">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" <?php if(!empty($id)){ echo "value='".$booking->customer_mobile."'"; } ?> name="customer_mobile" class="form-control" Placeholder="Customer Mobile" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label class="control-label col-md-12"> Booking Description 
                            </label>
                            <div class="col-md-12">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <?php echo $this->Form->control('description',['class'=>'form-control','label'=>false,'style'=>'resize:none;','rows'=>5, 'value' => @$booking->description]); ?>
                                </div>
                            </div>
                        </div>
                    </div>  
                        
                    <div class="form-actions ">
                        <div class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <hr>
                                <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </div>
                    </div>   
                    <?= $this->Form->end() ?>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<!-- BEGIN PAGE LEVEL STYLES -->
<!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- BEGIN VALIDATEION -->
    <?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <!-- END VALIDATEION --> 
<!-- END PAGE LEVEL SCRIPTS -->

<?php 
$js="
$(document).ready(function() {
    var form3 = $('#form_sample_1');
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
            designation_id:{
                required: true,
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

            form[0].submit(); // submit the form
        }
    });
});
$(document).ready(function() {
    ComponentsPickers.init();
});
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>
