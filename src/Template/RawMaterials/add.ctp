<?php echo $this->Html->css('mystyle'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="caption top-caption">
				<span>Add Raw Material</span>
			</div>
		</div>
	</div>
</div>
<div class="col-md-1">&nbsp;
</div>	
<div class="col-md-10">
	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">
				Add
			</div>
			<div class="tools">
				<?php if(!empty($id)){ ?>
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add ','/RawMaterials/add/',array('escape'=>false,'style'=>'color:#fff'));?>
					<?php } ?>
			</div>
			<div class="row">	
				<div class="col-md-12 horizontal "></div>
			</div>
		</div>
		<div class="portlet-body">
			<?= $this->Form->create($rawMaterial, ['id'=>'configform']) ?>
				<div class="form-group col-md-6">
					<label class="control-label col-md-12"> Name </label>
					<div class ="row">
						<div class="col-md-12">
							<?php echo $this->Form->control('name',['class'=>'form-control  ','label'=>false,'placeholder'=>'Enter RawMaterials']); ?>
						</div>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="control-label col-md-12"> Tax </label>
					<div class="row">
						<div class="col-md-12">
							<?php echo $this->Form->input('tax_id',['options' =>$Taxes,'label' => false,'class'=>'form-control select2 ','empty'=> 'Select...']);?>
						</div>
					</div>	
				</div>

				<div class="form-group col-md-5">
					<label class="control-label col-md-12"> Primary Unit </label>
					<div class ="row">
						<div class="col-md-12">
							<?php 
							$options=array();
							foreach($units as $unit)
							{
								$options[] = ['value'=>$unit->id,'text'=>$unit->name,'UnitName'=>$unit->name];
							};
							echo $this->Form->input('primary_unit_id',['options' =>$options,'label' => false,'class'=>'form-control select2 primary_unit','empty'=> 'Select...']); ?>
						</div>
					</div>
				</div>

				<div class="form-group col-md-2">
					<label>&nbsp;</label>
					<div class="checkbox-list">
						<label class="checkbox-inline">
						<input type="checkbox" name="has_secondary_unit" id="alterneteunit" value="1">Alternate Unit </label> 
					</div>
				</div>
				 
				<div class="form-group col-md-5 secondery">
					<label class="control-label col-md-12"> Secondary Unit </label>
					<div class="row">
						<div class="col-md-12">
							<?php  
							$options=array();
							foreach($units as $unit)
							{
								$options[] = ['value'=>$unit->id,'text'=>$unit->name,'UnitName'=>$unit->name];
							};
							echo $this->Form->input('secondary_unit_id',['options' =>$options,'label' => false,'class'=>'form-control select2 secondary_unit','empty'=> 'Select...']);?>
						</div>
					</div>	
				</div>

				 
				<div class="form-group col-md-5 secondery">
					<label for="exampleInputPassword1">Where</label>
					<div class="input-group">
						<?php echo $this->Form->control('formula',['class'=>'form-control  ','label'=>false,'placeholder'=>'Secondary Unit Equal to Primary Unit']); ?>
						<span class="input-group-addon second_unit">
						GM
						</span>
					</div>
				</div>


				<div class="form-group col-md-2 secondery">
					<label>&nbsp;</label>
					<div align="center">
						=
					</div>
				</div>

				<div class="form-group col-md-5 secondery">
					<label for="exampleInputPassword1">Equal To</label>
					<div class="input-group">
						<?php echo $this->Form->control('dds',['class'=>'form-control  ','label'=>false,'placeholder'=>'Equal to Primary Unit','value'=>'1','readonly'=>'readonly']); ?>
						<span class="input-group-addon first_unit">
						KG
						</span>
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
<!-- BEGIN COMPONENTS DROPDOWNS -->
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
<!-- BEGIN VALIDATEION -->
	<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END VALIDATEION --> 
<!-- END COMPONENTS DROPDOWNS -->
<?php
$js="
 	$('.secondery').hide();
	$(document).on('click', '#alterneteunit', function(e)
	{ 
		var selectedValue=$(this).prop('checked');
		if(selectedValue===true){
			$('.secondery').show();
		}
		else{
			$('.secondery').hide();
		}	
	});

	$(document).on('change', '.primary_unit', function(e)
	{ 
		var selectedValue = $('.primary_unit option:selected').attr('UnitName')
		$('.first_unit').html(selectedValue);
	});

	$(document).on('change', '.secondary_unit', function(e)
	{ 
		var selectedValue = $('.secondary_unit option:selected').attr('UnitName')
		$('.second_unit').html(selectedValue);
	});
";

$js.='
$(document).ready(function() {
	 
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
			tax_id: { 
				required: true 
			},
			primary_unit_id: { 
				required: true 
			},
			secondary_unit_id: { 
				required: true 
			},
			formula: { 
				required: true,
				disits:true,
				max:2
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
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>	

	
