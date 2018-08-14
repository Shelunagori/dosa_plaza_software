<?php $this->set("title", 'Shift Table | DOSA PLAZA'); ?>
 <style> 

.help-block-error{
	color: #fa6775; 
}
.Title{
	color: #000; 
}

</style>
<?= $this->element('header'); ?>
<?= $this->Form->create($Table,['id'=>'form_sample_1']); ?>
<div style="background: #EBEEF3;"> 
	<div class="row KOTView" style="padding:26px 16px 5px 15px">
		<div class="col-md-3"></div>
		<div class="col-md-6" style="background-color: #FFF; border-radius: 8px !important; padding: 10px;">
			<span class="Title">Shift Table</span>
			<hr style=" margin-bottom: 0px; margin-top: 3px;"></hr>			 
			<div style="padding-top:12px">
				<table width="100%">
					<tr>
						<td width="45%" style="padding:0 10px 0 0;">
							<label>Occupied Table</label>
							<?php
							$options=array(); 
							foreach($occupiedTables as $Table){
								$options[]=['text' =>$Table->name, 'value' => $Table->id];
							}
							
							echo $this->Form->input('occupiedtable',['options' =>$options,'label' => false,'class'=>'form-control select2me','empty'=> 'Search Table','autofocus']);?>
						</td>
						<td  width="10%" align="center"><label style="visibility:hidden">adasdsas </label>TO</td>
						<td width="45%" style="padding:0 10px 0 0;">
							<label>Vacant Table</label>
							<?php
							$options=array(); 
							foreach($vacantTables as $Tables){
								$options[]=['text' =>$Tables->name, 'value' => $Tables->id];
							}
							
							echo $this->Form->input('vacanttable',['options' =>$options,'label' => false,'class'=>'form-control select2me','empty'=> 'Search Table','autofocus']);?>
						</td>
					</tr>
					<tr>	
						<td colspan="5" width="10%" align="center" style="padding-top:20px">
							<!--<span class="AddItemBtn" data-target='#undeletemodal' data-toggle="modal" >Swift</span>-->
							<?php echo $this->Form->button('Shift Table',['class'=>'btn btn-danger']); ?> 
							<br><br> 
						</td>
					</tr>
				</table>
			</div>	
		</div>
	</div>
</div> 

<div id="undeletemodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md" >
		<form method="post" action=" ">
			<div class="modal-content">
			  <div class="modal-header">
					
					<h4 class="modal-title">
					Are you sure you want to swift table?
					</h4>
				</div>
				<div class="modal-footer" style="border:none;">
					<button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
					<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color:#000000;background-color:#DDDDDD;">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?= $this->Form->end() ?>
<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
	<!-- BEGIN VALIDATEION -->
	<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>

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
			occupiedtable: { 
				required: true 
			},
			vacanttable: { 
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
});
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>
