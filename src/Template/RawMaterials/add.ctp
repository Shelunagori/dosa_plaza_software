<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Add-RawMaterials | DOSAPLAZA'); ?>
 
<div class="col-md-2">&nbsp;
</div>	
<div class="col-md-8" style="margin-top:15px">
	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">
				Add Raw Material
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
			<?= $this->Form->create($rawMaterial, ['id'=>'form_sample_1']) ?>
				<div class="row">
					<div class="form-group col-md-8">
						<label class="control-label col-md-12"> Name  <span class="required"> * </span></label>
						<div class ="row">
							<div class="col-md-12 input-icon right">
								<i class="fa"></i>
								<?php echo $this->Form->control('name',['class'=>'form-control  ','label'=>false,'placeholder'=>'Raw Material Name','required'=>'required','id'=>'name']); ?>
							</div>
						</div>
					</div>
					<div class="form-group col-md-4 ">
						<label class="control-label col-md-12"> Tax  <span class="required"> * </span></label>
						<div class="row">
							<div class="col-md-12 input-icon right">
								<i class="fa"></i>
								<?php echo $this->Form->input('tax_id',['options' =>$Taxes,'label' => false,'class'=>'form-control select2 ','required'=>'required','id'=>'tax_id','empty'=>'Select...']);?>
							</div>
						</div>	
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-4 ">
						<label class="control-label col-md-12"> Primary Unit  <span class="required"> * </span></label>
						<div class ="row">
							<div class="col-md-12 input-icon right">
								<i class="fa"></i>
								<?php 
								$options=array();
								foreach($units as $unit)
								{
									$options[] = ['value'=>$unit->id,'text'=>$unit->name,'UnitName'=>$unit->name];
								};
								echo $this->Form->input('primary_unit_id',['options' =>$options,'label' => false,'class'=>'form-control select2 primary_unit','empty'=> 'Select...','required'=>'required','id'=>'primary_unit_id']); ?>
							</div>
						</div>
					</div>
					<div class="form-group col-md-3">
						<label>&nbsp;</label>
						<div class="checkbox-list">
							<label class="checkbox-inline">
							<input type="checkbox" name="has_secondary_unit" id="alterneteunit" value="1">Alternate Unit </label> 
						</div>
					</div>
					<div class="form-group col-md-4 secondery">
						<label class="control-label col-md-12"> Secondary Unit </label>
						<div class="row">
							<div class="col-md-12 input-icon right">
								<i class="fa"></i>
								<?php  
								$options=array();
								foreach($units as $unit)
								{
									$options[] = ['value'=>$unit->id,'text'=>$unit->name,'UnitName'=>$unit->name];
								};
								echo $this->Form->input('secondary_unit_id',['options' =>$options,'label' => false,'class'=>'form-control select2 secondary_unit','empty'=> 'Select...','required'=>'required','id'=>'secondary_unit_id']);?>
							</div>
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-5 secondery">
						<label class="">Where <span class="required"> * </span></label>
						<div class="">
							<div class="input-group ">
								
								<input type="number" name="formulas" class="form-control" placeholder="Secondary Unit Equal to Primary Unit" required="required" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
								<span class="input-group-addon second_unit">GM</span>
							</div>
						</div>
					</div>

					<div class="form-group col-md-1 secondery">
						<label>&nbsp;</label>
						<div align="center" style="margin-top: 6px; font-size: 20px;">
							=
						</div>
					</div>

					<div class="form-group col-md-5 secondery">
						<label for="exampleInputPassword1">Equal To</label>
						<div class="input-group input-icon right">
							<i class="fa"></i>
							<?php echo $this->Form->control('dds',['class'=>'form-control  ','label'=>false,'placeholder'=>'Equal to Primary Unit','value'=>'1','readonly'=>'readonly']); ?>
							<span class="input-group-addon first_unit">
							KG
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6 secondery">
						<label>Stock-In Voucher Unit Type</label>
						<div class="radio-list">
							<label class="radio-inline ">
							<input type="radio" name="purchase_voucher_unit_type" value="primary" checked> <span class="purchase_voucher_unit_type_primary">primary </span></label>
							<label class="radio-inline">
							<input type="radio" name="purchase_voucher_unit_type"  value="secondary"> <span class="purchase_voucher_unit_type_secondary">secondary </span></label> 
						</div>
					</div>

					<div class="form-group col-md-6 secondery">
						<label>Recipe Unit Type</label>
						<div class="radio-list">
							<label class="radio-inline ">
							<input type="radio" name="recipe_unit_type" value="primary" checked> <span class="recipe_unit_type_primary">primary </span></label>
							<label class="radio-inline">
							<input type="radio" name="recipe_unit_type"  value="secondary"> <span class="recipe_unit_type_secondary">secondary </span></label> 
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
	<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END COMPONENTS DROPDOWNS -->	

<!-- BEGIN VALIDATEION -->
	<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END VALIDATEION --> 
<!-- END COMPONENTS DROPDOWNS -->
<?php
$js="
	var form3 = $('#form_sample_1');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		rules: {
			name: { 
				required: true, 
			},
			tax_id: { 
				required: true, 
			},
			primary_unit_id: { 
				required: true, 
			},
			secondary_unit_id: { 
				required: true, 
			},
			formulas: { 
				required: true, 
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
			success3.show();
			error3.hide();
			$('#loading').show();
			form[0].submit(); // submit the form
		}

	});

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
		 
		$('.purchase_voucher_unit_type_primary').html(selectedValue);
		$('.recipe_unit_type_primary').html(selectedValue);
	});

	$(document).on('change', '.secondary_unit', function(e)
	{ 
		var selectedValue = $('.secondary_unit option:selected').attr('UnitName')
		$('.second_unit').html(selectedValue);
		 
		$('.purchase_voucher_unit_type_secondary').html(selectedValue);
		$('.recipe_unit_type_secondary').html(selectedValue);
	});
FormValidation.init();
";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>
	
