<?php echo $this->Html->css('mystyle'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="caption top-caption">
				<span>Purchase Vouchers</span>
			</div>
		</div>
	</div>
</div>	
<div class="row">
    <div class="col-md-12 main-div">
		<div class= "portlet box blue-hoki">
		<?= $this->Form->create($purchaseVoucher, ['id'=>'form_sample_1']) ?>
			<div class="portlet-title">
							
				<div class="caption" style="padding:13px 0 11px 18px;">
					Purchase Vouchers
				</div>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>	
			<div class="portlet-body">
				<div class="">
					<div class="form-group col-md-4">
						<label class="control-label" style="padding:0;">Transaction Date <span class="required">* </span>
</label>
						 <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" placeholder="dd-mm-yyyy" name="transaction_date" required data-date-format="dd-mm-yyyy"/> 
					</div>	
					<div class="form-group col-md-4">
						<label class="control-label" style="padding:0;">Vendors <span class="required" required name="vandors">*</span></label>
						<?php echo $this->Form->input('vendor_id',['options' =>$Vendors,'label' => false,'class'=>'form-control  select2me input-medium ','empty'=> 'select . . .','required'=>'required']);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12" style="margin-top:80px;" id="main">
					<table class="table table-bordered" id="main_table">	
						<thead class="bg_color">
							<tr align="center">
								<th rowspan="2" style="text-align:left;">Sr</th>
								<th rowspan="2" style="text-align:left;width:15%">Item <span class="required" required name="vandors">*</span></th>
								<th rowspan="2" style="text-align:left;">Quantity <span class="required" required name="vandors">*</span></th>
								<th rowspan="2" style="text-align:left;width:8%;">Rate <span class="required" required name="vandors">*</span></th>
								<th colspan="2" style="text-align:center;">Discount</th>
								<th rowspan="2" style="text-align:left;"> Taxable Value</th>
								<th colspan="2" style="text-align:center;"> GST</th>
								<th rowspan="2" style="text-align:left;"> Round off </th>
								<th rowspan="2" style="text-align:left;">Total </th>
								<th rowspan="2" style="text-align:left;">Action</th>
							</tr>
							<tr>
								<th><div align="center">%</div></th>
								<th><div align="center">Rs</div></th>
								<th><div align="center">%</div></th>
								<th><div align="center">RS</div></th>
							</tr>
							
						</thead>
						<tbody id="main_tbody">
											
						</tbody>
						<tfoot>
							<tr>
								<td  colspan="10" style ="text-align:right; font-weight:bold;"> 
								Grand Total</td>
								<td colspan="1">
								<?php echo $this->Form->input('grand_total', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm grand_total','type'=>'text','readonly'=>'readonly']);
								?>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="box-footer"  style="text-align:center;padding-bottom: 18px;">
					<button type="submit" class="btn btn-primary" id="order_btn" value="submit">Submit</button>
				</div>
			</div>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>
<!-- BEGIN PAGE LEVEL STYLES -->
	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
	<!-- BEGIN COMPONENTS PICKERS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END COMPONENTS PICKERS -->
	
	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>			
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<!-- BEGIN COMPONENTS PICKERS -->
	<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?> 
	<!-- END COMPONENTS PICKERS -->

	<!-- BEGIN COMPONENTS DROPDOWNS -->
	 
	<?php echo $this->Html->script('/assets/admin/pages/scripts/components-dropdowns.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<!-- BEGIN VALIDATEION -->
	<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<!-- END VALIDATEION -->  
    <!-- END PAGE LEVEL SCRIPTS -->
	
	<?php
	$js="
	$(document).ready(function() {	
		ComponentsPickers.init();
		FormValidation.init();

    
	$(document).on('click', '.add_row', function(e)
    { 
		add_row();
	});
	add_row();
	function add_row(){ 
		var tr=$('#sample tbody tr.main_tr').clone();
		$('#main_table tbody#main_tbody').append(tr);
	
		rename_rows();
	}
	
	$(document).on('keyup','.calc',function(e){
		var obj= $(this);
		calculation(obj);
		
	});
	$(document).on('change','.calc',function(e){
		var obj =$(this);
		calculation (obj);			
	});
	function calculation(obj=null){
		var total_amount_fixed=0;
		var grand_total = 0;
		var Total_amount=0;
	$('#main_table tbody#main_tbody tr.main_tr').each(function()
	{
		var qty           = parseFloat($(this).closest('tr').find('td:nth-child(3) input').val());
		var rate          = parseFloat($(this).closest('tr').find('td:nth-child(4) input').val());
		var discount_Rs   = parseFloat($(this).closest('tr').find('td:nth-child(6) input').val());
		var round_off     = parseFloat($(this).closest('tr').find('td:nth-child(10) input').val());

		if(!isNaN(qty) && !isNaN(rate))
		{ 
			var finalAmt = 0; 
			var amount   = qty*rate;						
				if(discount_Rs)
				{   
					var finalAmt  = amount - discount_Rs;
					finalAmt =  round(finalAmt,2);
				}
				else{
					finalAmt = amount;
					finalAmt = round(finalAmt,2);					
				}
				$(this).closest('tr').find('td:nth-child(7) input').val(finalAmt);
				
		}
		else
		{
			// $(this).closest('tr').find('td:nth-child(7) input').val(0);
			$(this).closest('tr').find('td:nth-child(11) input').val(0);
			
		}
		
		var tax     = $(this).closest('tr').find('td:nth-child(2) select option:selected').attr('tax');
		var tax_per = $(this).closest('tr').find('td:nth-child(8) input').val(tax);
		var gstamt =(finalAmt*tax)/100;
		gstamt 	   = round(gstamt,2);
		if(isNaN(gstamt))
		{
			gstamt=0;
		}
		var tax_per1       = $(this).closest('tr').find('td:nth-child(9) input').val(gstamt);
		var Total_amount   = gstamt+finalAmt;
		Total_amount= round(Total_amount,2);
		if(isNaN(Total_amount))
		{
			Total_amount=0;
		}
		
		var Totel          = $(this).closest('tr').find('td:nth-child(11) input').val(Total_amount); 
		Total_amount_round       = Total_amount+round_off;
		Total_amount_round =round(Total_amount_round,2);
		if(isNaN(Total_amount_round))
		{
			Total_amount_round=0;
		}
		if(round_off !='' && !isNaN(round_off)){
			$(this).closest('tr').find('td:nth-child(11) input').val(Total_amount_round);
			
		}
		var final_total          = parseFloat($(this).closest('tr').find('td:nth-child(11) input').val()); 
		grand_total += final_total;
		
		
	});
		$('.grand_total').val(grand_total);
	
	}
	  
	  $(document).on('keyup','.discount_per',function(e){
		var obj = $(this);
	    var qty           = parseFloat($(this).closest('tr').find('td:nth-child(3) input').val());
		var rate          = parseFloat($(this).closest('tr').find('td:nth-child(4) input').val());
		var discount_per  = parseFloat($(this).closest('tr').find('td:nth-child(5) input').val());
		
		if(!isNaN(qty) && !isNaN(rate))
		{ 
			var amount   = qty*rate;						
				if(discount_per)
				{   
					var disAmt    = (amount*discount_per)/100;
					disAmt  = round(disAmt,2);
				
				}
				$(this).closest('tr').find('td:nth-child(6) input').val(disAmt);
				calculation(obj);
		}
	 });
	 
	  $(document).on('keyup','.discount_amt',function(e){
		  var obj = $(this);
		var qty           = parseFloat($(this).closest('tr').find('td:nth-child(3) input').val());
		var rate          = parseFloat($(this).closest('tr').find('td:nth-child(4) input').val());
		var discount_amt  = parseFloat($(this).closest('tr').find('td:nth-child(6) input').val());
		
		if(!isNaN(qty) && !isNaN(rate))
		{ 
			var amount   = qty*rate;						
				if(discount_amt)
				{   
					var dis_per   = (discount_amt*100)/amount;
					dis_per = round(dis_per,2);
					
				}
				$(this).closest('tr').find('td:nth-child(5) input').val(dis_per);
				calculation(obj);
		}
	 });
	
	$(document).on('keyup','.backward_net_value',function(e){
		var qty  = parseFloat($(this).closest('tr').find('td:nth-child(3) input').val());
		var  t   = parseFloat($(this).closest('tr').find('td:nth-child(7) input').val());
		if(!isNaN(t))
		{ 
	        var p =  t/(100-discount_per)*100; 
			
			if(!isNaN(qty)){
				    var rate =  p/qty;
				}	 
		    $(this).closest('tr').find('td:nth-child(4) input').val(rate);
        }
		calculation(obj);
	});
	 
	  
});	
    
	$(document).on('click', '.remove_row', function(e)
    { 
		var rowCount = $('#main_table tbody#main_tbody tr.main_tr').length; 
		if(rowCount>1)
		{
			$(this).closest('tr').remove();
			rename_rows();
		}
	});
	
	function rename_rows(){
		var i=0;
				$('#main_table tbody#main_tbody tr.main_tr').each(function(){
                    var row_no = $(this).attr('row_no');					
					$(this).find('td:nth-child(1)').html(i+1);
					$(this).find('td:nth-child(2) select').select2().attr({name:'purchase_voucher_rows['+i+'][raw_material_id]', id:'purchase_voucher_rows-'+i+'-raw_material_id'
							});
					$(this).find('td:nth-child(3) input').attr({name:'purchase_voucher_rows['+i+'][quantity]', id:'Purchase_Voucher_Rows-'+i+'-quantity'
							});
					 $(this).find('td:nth-child(4) input').attr({name:'purchase_voucher_rows['+i+'][rate]', id:'Purchase_Voucher_Rows-'+i+'-rate'
							});
					
					$(this).find('td:nth-child(5) input').attr({name:'purchase_voucher_rows['+i+'][discount_per]', id:'Purchase_Voucher_Rows-'+i+'-discount_per'
					
							});
					$(this).find('td:nth-child(6) input').attr({name:'purchase_voucher_rows['+i+'][discount_amt]', id:'Purchase_Voucher_Rows-'+i+'-discount_amt'
					});
					
					$(this).find('td:nth-child(7) input').attr({name:'purchase_voucher_rows['+i+'][taxable_value]', id:'Purchase_Voucher_Rows-'+i+'-taxable_value'
					});
					
					$(this).find('td:nth-child(8) input').attr({name:'purchase_voucher_rows['+i+'][tax_per]', id:'Purchase_Voucher_Rows-'+i+'-tax_per'
					});
					$(this).find('td:nth-child(9) input').attr({name:'purchase_voucher_rows['+i+'][tax_amt]', id:'Purchase_Voucher_Rows-'+i+'-tax_amt'
					});
					$(this).find('td:nth-child(10) input').attr({name:'purchase_voucher_rows['+i+'][round_off]', id:'Purchase_Voucher_Rows-'+i+'-round_off'
					});
					$(this).find('td:nth-child(11) input').attr({name:'purchase_voucher_rows['+i+'][net_amt_total]', id:'Purchase_Voucher_Rows-'+i+'-net_amt_total'
					});
					
						i++;
						
				});

		var FormValidation = function () {
				// basic validation
			var handleValidation1 = function() {
				// for more info visit the official plugin documentation: 
	            // http://docs.jquery.com/Plugins/Validation

	            var form1 = $('#form_sample_1');
	            var error1 = $('.alert-danger', form1);
	            var success1 = $('.alert-success', form1);
	            form1.validate({
	                errorElement: 'span', //default input error message container
	                errorClass: 'help-block help-block-error', // default input error message class
	                focusInvalid: false, // do not focus the last invalid input
	                 // validate all fields including form hidden input
	               
	                rules: {
	                    transaction_date: {
	                        required: true
	                    },
	                },

	                invalidHandler: function (event, validator) { //display error alert on form submit              
	                    success1.hide();
	                    error1.show();
	                    Metronic.scrollTo(error1, -200);
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
	                    success1.show();
	                    error1.hide();
	                    form[0].submit(); // submit the form
	                }

	            });

	    	}

		}();
	}
	";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>
<table id="sample" style="display:none;"  width="1500px">
	<tbody class="table_br">
		<tr class="main_tr">
			<td style="vertical-align: top !important;"></td>
			<td width="15%" align="left">
				<?php echo $this->Form->input('raw_material_id',['options'=>$option,'class'=>'form-control input-sm select2 calc ','empty' => '--Select Item--','label'=>false,'required'=>'required']); ?>
			</td>
			<td width="5%" align="center">
				<?php echo $this->Form->input('quantity', ['label' => false,'placeholder'=>'Qty','class'=>'form-control input-sm calc Qty rightAligntextClass','required'=>'required']); ?>
			</td>
			<td width="8%" align="center">
				<?php echo $this->Form->input('rate',['class'=>'form-control input-sm calc  Rate numberOnly rightAligntextClass','placeholder'=>'Rate','label'=>false,'autofocus','required'=>'required']); ?>
			</td>		
			<td width="8%" align="center">
				<?php echo $this->Form->input('discount_per',['class'=>' discount_per form-control input-sm calc  dis numberOnly rightAligntextClass','label'=>false,'autofocus']); ?>
			</td>
			<td  width="10%" align="center">
				<?php echo $this->Form->input('discount_amt', ['style'=>'text-align:right','label' => false,'class' => 'discount_amt form-control input-sm calc discountAmount numberOnly','type'=>'text']);
				?>	
			</td>
			<td  width="10%" align="center">
				<?php echo $this->Form->input('taxable_value', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm  calc backward_net_value ','type'=>'text']);
				?>	
			</td>
			<td  width="6%" align="center">
				<?php echo $this->Form->input('tax_per', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm  calc  numberOnly ','type'=>'text','value'=>0]);
				?>	
			</td>
			<td  width="10%" align="center">
				<?php echo $this->Form->input('tax_amt', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm  calc gst_amt numberOnly','type'=>'text','value'=>0]);
				?>	
			</td>
			<td  width="7%" align="center">
				<?php echo $this->Form->input('round_off', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm calc','placeholder'=>'','type'=>'text']);
				?>	
			</td>
			<td  width="15%" align="center">
				<?php echo $this->Form->input('net_amt_total', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm netAmount  backward_net_value','type'=>'text']);
				?>	
			</td>
			<td>
				<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-primary btn-xs add_row','type'=>'button']); ?>
				<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-times']),['class'=>'btn  btn-danger btn-xs remove_row','type'=>'button']); ?>
			</td>
		</tr>
	   
	</tbody>
	
		
</table>	