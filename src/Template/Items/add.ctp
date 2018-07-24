<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Item'); ?>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="caption top-caption">
				<span>Add Item</span>
			</div>
		</div>
	</div>
</div>	
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8 main-div">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					
					<?php if(!empty($id)){ ?>
						Edit Item
					<?php }else{ ?>
						Add Item
					<?php } ?>
				</div>
				<div class="tools">
					<?php if(!empty($id)){ ?>
						<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add ','/Items/add/',array('escape'=>false,'style'=>'color:#fff'));?>
					<?php }?>
				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="">
					<?= $this->Form->create($item,['id'=>'CountryForm']) ; ?>
						<div class="form-group">
							<label class="control-label col-md-4"> Item <span class="required" aria-required="true">
							</span>
							</label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" <?php if(!empty($id)){ echo "value='".$item->name."'"; } ?> name="name" class="form-control" Placeholder="Enter item Name">
								</div>
							</div>
						</div>
						<span class="help-block">&nbsp;</span>
						<div class="form-group">
							<label class="control-label col-md-4"> Rate <span class="required" aria-required="true">
							 </span>
							</label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" <?php if(!empty($id)){ echo "value='".$item->rate."'"; } ?> name="rate" class="form-control input-large" Placeholder="Enter item rate" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
								</div>
							</div>
						</div>
						<span class="help-block">&nbsp;</span>
						<div class="form-group">
							<label class="control-label col-md-4"> Select Sub Category <span class="required" aria-required="true">
							 </span>
							</label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<?php  
									echo $this->Form->input('item_sub_category_id',['options' =>$itemSubCategories,'label' => false,'class'=>'form-control select2 selectState input-large','empty'=> 'Select...']);?>
								</div>
							</div>
						</div>
						<span class="help-block">&nbsp;</span>
						<div class="form-group">
							<label  class="control-label col-md-4">Discount Applicable</label>
							<div class="radio-list col-md-8">
								<label class="radio-inline">
								<input type="radio" name="discount_applicable" value="1" checked> Applicable</label>
								<label class="radio-inline">
								<input type="radio" name="discount_applicable" value="0"> Not Applicable </label>
							</div>
						</div>

						
						<div class="form-actions">
							<div class="row">
							
								<div class="col-md-offset-6 col-md-9">
									<?php echo $this->Form->button('SUBMIT',['class'=>'btn btn-danger']); ?> 
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
	

<!-- BEGIN PAGE LEVEL PLUGINS -->
	<!-- BEGIN VALIDATEION -->
	<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END VALIDATEION --> 
<!-- END PAGE LEVEL SCRIPTS -->

<?php 
$js='
$(document).ready(function() {
	jQuery(".loadingshow").submit(function(){
		jQuery("#loader-1").show();
	});
	$.validator.addMethod("specialChars", function( value, element ) {
		var regex = new RegExp("^[a-zA-Z ]+$");
		var key = value;

		if (!regex.test(key)) {
		   return false;
		}
		return true;
	}, "please use only alphabetic characters");
	
	//-- Validation
	var form2 = $("#CountryForm");
	var error2 = $(".alert-danger", form2);
	var success2 = $(".alert-success", form2);

	form2.validate({
		errorElement: "span", //default input error message container
		errorClass: "help-block help-block-error", // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		ignore: "",  // validate all fields including form hidden input
		rules: {
			name: { 
				required: true,
				specialChars: true
			},
			item_sub_category_id: { 
				required: true 
			},
			rate: { 
				required: true 
			},
		},

		 

		errorPlacement: function (error, element) { // render error placement for each input type
			var icon = $(element).parent(".input-icon").children("i");
			icon.removeClass("fa-check").addClass("fa-warning");  
			icon.attr("data-original-title", error.text()).tooltip({"container": "body"});
		},

		highlight: function (element) { // hightlight error inputs
			$(element)
				.closest(".form-group").removeClass("has-success").addClass("has-error"); // set error class to the control group   
		},
		success: function (label, element) {
			var icon = $(element).parent(".input-icon").children("i");
			$(element).closest(".form-group").removeClass("has-error").addClass("has-success"); // set success class to the control group
			icon.removeClass("fa-warning").addClass("fa-check");
		},

		submitHandler: function (form) {
			success2.show();
			error2.hide();
			form[0].submit(); // submit the form
		}
	}); 	
 });';
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>
