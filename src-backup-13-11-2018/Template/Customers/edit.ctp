<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Edit-Customer | DOSA PLAZA'); ?>
 
<div class="col-md-2">&nbsp;
</div>	
<div class="col-md-8" style="margin-top:15px">
	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">
				Edit-Customer
			</div>
			<div class="tools">
				
			</div>
			<div class="row">	
				<div class="col-md-12 horizontal "></div>
			</div>
		</div>
		<div class="portlet-body">
			<?= $this->Form->create($customer, ['id'=>'form_sample_1']) ?>
				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label col-md-12"> Name  <span class="required"> * </span></label>
						<div class ="row">
							<div class="col-md-12 input-icon right">
								<i class="fa"></i>
								<?php echo $this->Form->control('name',['class'=>'form-control  ','label'=>false,'placeholder'=>'Name','required'=>'required']); ?>
							</div>
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="control-label col-md-12"> Mobile  <span class="required"> * </span></label>
						<div class ="row">
							<div class="col-md-12 input-icon right">
								<i class="fa"></i>
								<?php echo $this->Form->control('mobile_no',['class'=>'form-control  ','label'=>false,'placeholder'=>'Mobile','required'=>'required']); ?>
							</div>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label col-md-12"> Address </label>
						<div class ="row">
							<div class="col-md-12 input-icon right">
								<i class="fa"></i>
								<?php echo $this->Form->control('address',['class'=>'form-control  ','label'=>false,'placeholder'=>'Address', 'type' => 'textarea']); ?>
							</div>
						</div>
					</div>

					<div class="form-group col-md-6">
						<label class="control-label col-md-12"> Customer Unique Code</label>
						<div class ="row">
							<div class="col-md-12 input-icon right">
								<i class="fa"></i>
								<?php echo $this->Form->control('c_unique_code',['class'=>'form-control  ','label'=>false,'placeholder'=>'Customer Unique Code']); ?>
							</div>
						</div>
					</div>
				</div>
				<?php
				($customer->dob=="01-1-1970" ? $customer->dob="" : false);
				?>
				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label col-md-12"> DOB </label>
						<div class ="row">
							<div class="col-md-12 input-icon right">
								<i class="fa"></i>
								<?php echo $this->Form->control('dob',['class'=>'form-control date-picker','label'=>false,'placeholder'=>'dd-mm-yyyy', 'data-date-format'=> 'dd-mm-yyyy', 'type' => 'text']); ?>
							</div>
						</div>
					</div>
					<?php
					($customer->anniversary=="01-1-1970" ? $customer->anniversary="" : false);
					?>
					<div class="form-group col-md-6">
						<label class="control-label col-md-12"> Anniversary</label>
						<div class ="row">
							<div class="col-md-12 input-icon right">
								<i class="fa"></i>
								<?php echo $this->Form->control('anniversary',['class'=>'form-control date-picker','label'=>false,'placeholder'=>'dd-mm-yyyy', 'data-date-format'=> 'dd-mm-yyyy', 'type' => 'text']); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label col-md-12"> Email </label>
						<div class ="row">
							<div class="col-md-12 input-icon right">
								<i class="fa"></i>
								<?php echo $this->Form->control('email',['class'=>'form-control','label'=>false,'placeholder'=>'Email']); ?>
							</div>
						</div>
					</div>
				</div>

				
				
				

				<div class="form-actions">
					<div class="row">
						<div class="col-md-12" align="center">
							<hr></hr>
							<?php echo $this->Form->button('SUBMIT',['class'=>'btn btn-danger']); ?> 
						
						</div>
					</div>
				</div>
 			<?= $this->Form->end() ?>
		</div> 
	</div>
</div>
<!-- BEGIN PAGE LEVEL STYLES -->
    <!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->

 <!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/clockface/js/clockface.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/global/scripts/metronic.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/quick-sidebar.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
	<!-- BEGIN VALIDATEION -->
	<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END VALIDATEION --> 
<!-- END PAGE LEVEL SCRIPTS -->


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
            $('#C_Form').hide();
            $('#S_msg').show();
        });
    });

    ComponentsPickers.init();
});

";

$remote_url_edit = $this->Url->build(['controller'=>'Customers','action'=>'checkUniqueEdit']);

$js.="
		var remote_url_edit = '".$remote_url_edit."';
		var customer_id = '".$customer->id."';
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
		            item_sub_category_id: {
		                required: true,
		            }, 
		            tax_id: {
		                required: true,
		            },
		            c_unique_code: {
				      	remote: {
					        url: remote_url_edit,
					        type: 'post',
					        data: {
					          customer_id: customer_id
					        }
					    }
				    },
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
				//$('#loading').show();
				form.submit(); // submit the form
			}

		});";


echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
?>