<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Item'); ?>
<!-- BEGIN PAGE CONTENT-->
	
<div class="row" style="margin-top:15px">
	<div class="col-md-12 main-div">
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
						<div class="row">
							<div class="form-group col-md-4">
								<label class=""> Item Name <span class="required" aria-required="true">*</span></label>
								<div class="col-md-12">
									<input type="text" <?php if(!empty($id)){ echo "value='".$item->name."'"; } ?> name="name" class="form-control" Placeholder="Enter item Name">
								</div>
							</div>
							<div class="form-group col-md-4">
								<label class=""> Sales Rate <span class="required" aria-required="true">*</span></label>
								<div class="col-md-12"> 
									<input type="text" <?php if(!empty($id)){ echo "value='".$item->rate."'"; } ?> name="rate" class="form-control input-large rightAligntextClass" Placeholder="Enter item sales rate" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
								</div>
							</div>
							<div class="form-group col-md-4">
								<label class=""> Tax <span class="required" aria-required="true">*</span></label>
								<div class="col-md-12"> 
									<?php echo $this->Form->input('tax_id',['options' =>$Taxes,'label' => false,'class'=>'form-control','empty'=> 'Select...','required'=>'required']);?>
								</div>
							</div>
						</div>

						<div class="row">  
							<div class="form-group col-md-4">
								<label class=""> Select Sub Category <span class="required" aria-required="true">*</span></label>
								<div class="col-md-12">
									<?php echo $this->Form->input('item_sub_category_id',['options' =>$itemSubCategories,'label' => false,'class'=>'form-control select2me selectState input-large','empty'=> 'Select...']);?>
								</div>
							</div>
							<div class="form-group col-md-4">
								<label  class="">Discount Applicable</label>
								<div class="radio-list col-md-12">
									<label class="radio-inline">
									<input type="radio" name="discount_applicable" value="1" checked> Applicable</label>
									<label class="radio-inline">
									<input type="radio" name="discount_applicable" value="0"> Not Applicable </label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="portlet light">
									<div class="caption top-caption">
										<span style="color:#f35b72">Create Recipe</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12" style="margin-top:10px;" id="main">
								<table class="table table-bordered" id="main_table">	
									<thead class="bg_color">
										<tr align="center">
											<th style="text-align:left;">Sr</th>
											<th style="text-align:left;width:15%">Item <span class="required" required name="vandors">*</span></th>
											<th style="text-align:left;">Quantity <span class="required" required name="vandors">*</span></th> 
											<th style="text-align:left;">Unit</th>
											<th style="text-align:left;">Action</th>
										</tr> 
										
									</thead>
									<tbody id="main_tbody">
								
									</tbody>
									<tfoot>
										<tr>
											<td colspan="4"></td>
											<td colspan=""><?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-primary btn-xs add_row','type'=>'button']); ?></td>
										</tr>
									</tfoot>
								</table>
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
</div>
<!-- BEGIN PAGE LEVEL STYLES -->
	<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END COMPONENTS DROPDOWNS -->	

<!-- BEGIN PAGE LEVEL PLUGINS -->
	<!-- BEGIN VALIDATEION -->
	<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END VALIDATEION --> 
<!-- END PAGE LEVEL SCRIPTS -->

<?php 
$js='
$(document).ready(function() {
	$(document).on("click", ".add_row", function(e)
    { 
		add_row();
	});
	add_row();
	function add_row(){ 
		var tr=$("#sample tbody tr.main_tr").clone();
		$("#main_table tbody#main_tbody").append(tr);
	
		rename_rows();
	}
	$(document).on("click", ".remove_row", function(e)
    { 
		var rowCount = $("#main_table tbody#main_tbody tr.main_tr").length; 
		if(rowCount>1)
		{
			$(this).closest("tr").remove();
			rename_rows();
		}
	});
	function rename_rows(){
		var i=0;
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){
            var row_no = $(this).attr("row_no");					
			$(this).find("td:nth-child(1)").html(i+1);
			$(this).find("td:nth-child(2) select").select2().attr({name:"item_rows["+i+"][raw_material_id]", id:"item_rows-"+i+"-raw_material_id"});
			$(this).find("td:nth-child(3) input").attr({name:"item_rows["+i+"][quantity]", id:"Purchase_Voucher_Rows-"+i+"-quantity"});
			i++;
		});
	}

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
<table id="sample" style="display:none;"  width="1500px">
	<tbody class="table_br">
		<tr class="main_tr">
			<td style="vertical-align: top !important;"></td>
			<td width="30%" align="left">
				<?php echo $this->Form->input('raw_material_id',['options'=>$option,'class'=>'form-control select2','empty' => '--Select Item--','label'=>false,'required'=>'required']); ?>
			</td>
			<td width="30%" align="center">
				<?php echo $this->Form->control('quantity', ['label' => false,'placeholder'=>'Please Enter Quantity','class'=>'form-control rightAligntextClass','required'=>'required']); ?>
			</td>
			<td width="15%" class="unitType">
				
			</td>
			<td  width="20%">
				<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-times']),['class'=>'btn  btn-danger btn-xs remove_row','type'=>'button']); ?>
			</td>

		</tr>
	</tbody>		
</table>