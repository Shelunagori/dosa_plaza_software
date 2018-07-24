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
			<div class="portlet-title">
				<div class="caption">
					Purchase Vouchers
				</div>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>	
			<div class="portlet-body">
				<div class="form-group">
					<div class="col-md-4">
						<label class="control-label" style="padding:0;"> Transaction Date<span class="required" aria-required="true"></span></label>
						<input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value=""/>
					</div>	
					<div class="col-md-4">
						<label class="control-label" style="padding:0;"> Vendors<span class="required" aria-required="true"></span></label>
						<?php echo $this->Form->input('vendor_id',['options' =>$Vendors,'label' => false,'class'=>'form-control select2 ','empty'=> ' --select Vendors--']);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12" style="margin-top:80px;" id="main">
					<table class="table table-bordered" id="main_table">	
						<thead class="bg_color">
							<tr align="center">
								<th rowspan="2" style="text-align:left;">Sr</th>
								<th rowspan="2" style="text-align:left;width:15%">Item</th>
								<th rowspan="2" style="text-align:left;">Quantity</th>
								<th rowspan="2" style="text-align:left;width:8%;">Rate</th>
								<th colspan="2" style="text-align:center;">Discount</th>
								<th rowspan="2" style="text-align:left;"> Taxable Value</th>
								<th colspan="2" style="text-align:center;"> GST</th>
								<th rowspan="2" style="text-align:left;"> Round off</th>
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
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- BEGIN PAGE LEVEL STYLES -->
	<!-- BEGIN COMPONENTS PICKERS -->
	<?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<!-- END COMPONENTS PICKERS -->

	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
	<!-- BEGIN COMPONENTS PICKERS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/clockface/js/clockface.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END COMPONENTS PICKERS -->
	
	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<!-- BEGIN COMPONENTS PICKERS -->
	<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<!-- END COMPONENTS PICKERS -->

	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->script('/assets/global/scripts/metronic.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/layout/scripts/quick-sidebar.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/pages/scripts/components-dropdowns.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
    <!-- END PAGE LEVEL SCRIPTS -->
	
	<?php
	$js="
	$(document).ready(function() {	
		ComponentsPickers.init();
    
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
		
	    $(document).on('blur','.calc',function(e){
			var obj= $(this);
			calculation(obj);
		});
		$(document).on('change','.calc',function(e){
			var obj =$(this);
            calculation (obj);			
		});
			function calculation(obj=null){
				
					var qty           = parseFloat(obj.closest('tr').find('td:nth-child(3) input').val());
					var rate          = parseFloat(obj.closest('tr').find('td:nth-child(4) input').val());
					var discount_per  = parseFloat(obj.closest('tr').find('td:nth-child(5) input').val());
					var discount_Rs   = parseFloat(obj.closest('tr').find('td:nth-child(6) input').val());
					var round_off     = parseFloat(obj.closest('tr').find('td:nth-child(10) input').val());

		    if(!isNaN(qty) && !isNaN(rate))
			{ 
				var finalAmt = 0; 
				var amount   = qty*	rate;						
				if((discount_per!=0 && !isNaN(discount_per)) || (discount_Rs!=0 && !isNaN(discount_Rs)))
				{
					if(discount_per)
					{
						var discount_amt   = (amount*discount_per)/100;
						var finalAmt       =  amount - discount_amt;
						obj.closest('tr').find('td:nth-child(6) input').val(discount_amt);
					}
					else if(discount_Rs)
					{   
						var dis_per   = (discount_Rs*100)/amount;
						var finalAmt  = amount - discount_Rs;
						obj.closest('tr').find('td:nth-child(5) input').val(dis_per);
					}
					
				}
				else 
				{
					var finalAmt  = amount;
				}
				obj.closest('tr').find('td:nth-child(7) input').val(finalAmt);
				obj.closest('tr').find('td:nth-child(11) input').val(finalAmt);
				
			}
			else
			{
				obj.closest('tr').find('td:nth-child(7) input').val(0);
				obj.closest('tr').find('td:nth-child(11) input').val(0);
			}
			
			
		   
			var tax     = obj.closest('tr').find('td:nth-child(2) select option:selected').attr('tax');
			var tax_per = obj.closest('tr').find('td:nth-child(8) input').val(tax);
			var gstamt =(finalAmt*tax)/100;
			var tax_per1       = obj.closest('tr').find('td:nth-child(9) input').val(gstamt);
			var Total_amount   = gstamt+finalAmt;
			Total_amount       = Total_amount+round_off;
			var Totel          = obj.closest('tr').find('td:nth-child(11) input').val(Total_amount.toFixed(2));
			
			
		
		} 
		
		
		
		  
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
					$(this).find('td:nth-child(2) select').select2().attr({name:'Purchase_Voucher_Rows['+i+'][raw_material_id]', id:' Purchase_Voucher_Rows-'+i+'-raw_material_id'
							});
					$(this).find('td:nth-child(3) input').attr({name:'Purchase_Voucher_Rows['+i+'][quantity]', id:'Purchase_Voucher_Rows-'+i+'-quantity'
							});
					 $(this).find('td:nth-child(4) input').attr({name:'Purchase_Voucher_Rows['+i+'][rate]', id:'Purchase_Voucher_Rows-'+i+'-rate'
							});
					
					$(this).find('td:nth-child(5) input').attr({name:'Purchase_Voucher_Rows['+i+'][discount_per]', id:'Purchase_Voucher_Rows-'+i+'-discount_per'
					
							});
					$(this).find('td:nth-child(6) input').attr({name:'Purchase_Voucher_Rows['+i+'][discount_amt]', id:'Purchase_Voucher_Rows-'+i+'-discount_amt'
					});
					$(this).find('td:nth-child(7) input').attr({name:'Purchase_Voucher_Rows['+i+'][pnf_per]', id:'Purchase_Voucher_Rows-'+i+'-pnf_per'
					});
					$(this).find('td:nth-child(8) input').attr({name:'Purchase_Voucher_Rows['+i+'][pnf_amount]', id:'Purchase_Voucher_Rows-'+i+'-pnf_amount'
					});
					$(this).find('td:nth-child(9) input').attr({name:'Purchase_Voucher_Rows['+i+'][pnf_amount]', id:'Purchase_Voucher_Rows-'+i+'-pnf_amount'
					});
					$(this).find('td:nth-child(10) input').attr({name:'Purchase_Voucher_Rows['+i+'][tax_per]', id:'Purchase_Voucher_Rows-'+i+'-tax_per'
					});
					$(this).find('td:nth-child(11) input').attr({name:'Purchase_Voucher_Rows['+i+'][tax_amt]', id:'Purchase_Voucher_Rows-'+i+'-tax_amt'
					});
					$(this).find('td:nth-child(12) input').attr({name:'Purchase_Voucher_Rows['+i+'][round_off]', id:'Purchase_Voucher_Rows-'+i+'-round_off'
					});
					$(this).find('td:nth-child(13) input').attr({name:'Purchase_Voucher_Rows['+i+'][net_amt_total]', id:'Purchase_Voucher_Rows-'+i+'-net_amt_total'
					});
					
						i++;
						
				});
	}
	";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>
<table id="sample" style="display:none;"  width="1500px">
	<tbody class="table_br">
		<tr class="main_tr">
			<td style="vertical-align: top !important;"></td>
			<td width="15%" align="left">
				<?php echo $this->Form->input('raw_material_id',['options'=>$option,'class'=>'form-control input-sm select2 calc','empty' => '--Select Item--','label'=>false]); ?>
			</td>
			<td width="5%" align="center">
				<?php echo $this->Form->input('quantity', ['label' => false,'placeholder'=>'Qty','class'=>'form-control input-sm calc Qty rightAligntextClass']); ?>
			</td>
			<td width="8%" align="center">
				<?php echo $this->Form->input('rate',['class'=>'form-control input-sm calc  Rate numberOnly rightAligntextClass','placeholder'=>'Rate','label'=>false,'autofocus','required'=>'required']); ?>
			</td>		
			<td width="8%" align="center">
				<?php echo $this->Form->input('discount_per',['class'=>'form-control input-sm calc  dis numberOnly rightAligntextClass','label'=>false,'autofocus','required'=>'required']); ?>
			</td>
			<td  width="10%" align="center">
				<?php echo $this->Form->input('discount_amt', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm calc discountAmount numberOnly','type'=>'text']);
				?>	
			</td>
			<td  width="6%" align="center">
				<?php echo $this->Form->input('tax_net_amt', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm  calc taxableValue','type'=>'text']);
				?>	
			</td>
			<td  width="6%" align="center">
				<?php echo $this->Form->input('Gstper', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm  calc  numberOnly ','type'=>'text','value'=>0]);
				?>	
			</td>
			<td  width="10%" align="center">
				<?php echo $this->Form->input('Gstamt', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm  calc numberOnly','type'=>'text','value'=>0]);
				?>	
			</td>
			<td  width="7%" align="center">
				<?php echo $this->Form->input('round_off', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm calc','placeholder'=>'','type'=>'text']);
				?>	
			</td>
			<td  width="20%" align="center">
				<?php echo $this->Form->input('net_amt_total', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm netAmount','type'=>'text']);
				?>	
			</td>
			<td>
				<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-primary btn-xs add_row','type'=>'button']); ?>
				<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-times']),['class'=>'btn  btn-danger btn-xs remove_row','type'=>'button']); ?>
			</td>
		</tr>
	</tbody>
</table>	