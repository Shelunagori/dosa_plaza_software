<?php $this->set("title", 'Item'); ?>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet green box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>
					<?php if(!empty($id)){ ?>
						Edit Vendor
					<?php }else{ ?>
						Add Vendor
					<?php } ?>
				</div>
				<div class="tools">
					<?php if(!empty($id)){ ?>
						<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add ','/Vendors/add/',array('escape'=>false,'style'=>'color:#fff'));?>
					<?php }?>
				</div>
			</div>
			<div class="portlet-body">
				<div class="">
					<?= $this->Form->create($vendor,['id'=>'CountryForm']) ; ?>
						<div class="form-group">
							<label class="control-label col-md-4"> Name <span class="required" aria-required="true">
							* </span>
							</label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" <?php if(!empty($id)){ echo "value='".$vendor->name."'"; } ?> name="name" class="form-control" Placeholder="Enter Vendor Name">
								</div>
							</div>
						</div>
						<span class="help-block">&nbsp;</span>
						<div class="form-group">
							<label class="control-label col-md-4"> Contact Person <span class="required" aria-required="true">
							* </span>
							</label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" <?php if(!empty($id)){ echo "value='".$vendor->contact_person."'"; } ?> name="contact_person" class="form-control input-large" Placeholder="Enter Contact Person Name" >
								</div>
							</div>
						</div>
						<span class="help-block">&nbsp;</span>
						<div class="form-group">
							<label class="control-label col-md-4"> Contact Number <span class="required" aria-required="true">
							* </span>
							</label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" <?php if(!empty($id)){ echo "value='".$vendor->contact_number."'"; } ?> name="contact_number" class="form-control input-large" Placeholder="Enter Contact Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"maxlength="10" minlength="10" >
								</div>
							</div>
						</div>
						<span class="help-block">&nbsp;</span>
						<div class="form-group">
							<label class="control-label col-md-4"> Address <span class="required" aria-required="true">
							* </span>
							</label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<?php echo $this->Form->control('address',['class'=>'form-control','label'=>false,'style'=>'resize:none;','rows'=>2]); ?>
								</div>
							</div>
						</div>
						<span class="help-block">&nbsp;</span>
						<div class="form-group">
							<label class="control-label col-md-4"> Select Item <span class="required" aria-required="true">
							* </span>
							</label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<?php 
									$catList=array();
									$catLists=array();
									if($id){
										foreach($vendor->vendor_items as $iteml)
										{ 
											$catList[]=$iteml->item_id;
										}
										$catLists=array_unique($catList);
									}
									?>
									<?php 
									$options=array();
									foreach($Items as $sts)
									{
										if(in_array($sts->id, $catLists)){
											$options[] = ['value'=>$sts->id,'text'=>$sts->name,'selected'=>'selected'];
										}
										else{
											$options[] = ['value'=>$sts->id,'text'=>$sts->name];
										}
									};									
									echo $this->Form->input('item_lists',['options' =>$options,'label' => false,'class'=>'form-control select2 selectState select2me','empty'=> 'Select...','multiple'=>true]);?>
								</div>
							</div>
						</div>
						<span class="help-block">&nbsp;</span>
 						<div class="col-md-12"><hr></hr></div>
						<div class="form-actions">
							<div class="row">
							
								<div class="col-md-offset-6 col-md-9">
									<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary']); ?> 
								</div>
							</div>
						</div>
 						 
					<?= $this->Form->end() ?>
				</div> 
			</div>
		</div>
	</div>
	
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
	<!-- END COMPONENTS DROPDOWNS -->
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
				required: true,specialChars: true
			},
			contact_person: { 
				required: true,specialChars: true 
			},
			contact_number: { 
				required: true,maxlength:10
			},
			"item_lists[]": { 
				required: true,maxlength:10
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