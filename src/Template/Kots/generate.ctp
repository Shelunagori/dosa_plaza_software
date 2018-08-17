<?php $this->set("title", 'KOT | DOSA PLAZA'); 
$pass = $this->request->params['pass'];
$order=$pass[1]; 
?>
<style>
.minus{
	color: #FFF; background-color: #FA6775;padding: 0px 7px;font-size:15px;cursor: pointer; font-weight: bold;
} 
.plus{
	color: #FFF; background-color: #2d4161de;padding: 0px 7px;font-size:15px;cursor: pointer;font-weight: bold;
}
.saveCustomersearch{
	color: #FFF; background-color: #FA6775; padding: 9px 11px;font-size:12px;cursor: pointer;
}
.saveCustomer{
	color: #FFF; background-color: #FA6775; padding: 7px 14px;font-size:12px;cursor: pointer;margin-left: 2px;
}
.closeCustomerBox2{
	color: #000; background-color: #E6E7E8; padding: 7px 14px;font-size:12px;cursor: pointer;margin-right: 2px; 
}
.commentString{
    background-color: #2d4161;
    padding:  5px;
    border-radius:  5px;
    color:  #FFF;
    margin-right:  5px;
    cursor:  pointer;
}
.closeCommentBox{
	color: #000; background-color: #E6E7E8; padding: 7px 14px;font-size:12px;cursor: pointer;margin-right: 2px; 
}
.saveComment{
	color: #FFF; background-color: #FA6775; padding: 7px 14px;font-size:12px;cursor: pointer;margin-left: 2px;
}
.closePopup{
	color: #000; background-color: #E6E7E8; padding: 7px 14px;font-size:12px;cursor: pointer;margin-right: 2px; 
}
.closeViewKot{
	color: #000; background-color: #E6E7E8; padding: 7px 14px;font-size:12px;cursor: pointer;margin-right: 2px;position: absolute; right: -12px; bottom: 2px;
}
.CancelBill{
	color: #000; background-color: #E6E7E8; padding: 7px 14px;font-size:12px;cursor: pointer;margin-right: 2px;
}
.SubmitBill{
	color: #FFF; background-color: #FA6775; padding: 7px 14px;font-size:12px;cursor: pointer;margin-left: 2px;
}

.AddItemBtn{
	color: #FFF; background-color: #FA6775; padding: 9px 18px;font-size:12px;cursor: pointer;
}
.CreateKOT{
	color: #FFF; background-color: #FA6775; padding: 7px 14px;cursor: pointer;font-size:12px;
}
.ViewAllKOT{
	color: #FFF; background-color: #FA6775; padding: 7px 14px;cursor: pointer;font-size:12px;
}
.KOTComment{
	color: #000; background-color: #F5F5F5; padding: 7px 14px;cursor: pointer;margin-right: 8px;font-size:12px;
}
.CreateBill{
	color: #FFF; background-color: #2D4161; padding: 14px 36px;cursor: pointer;font-size:15px;   margin-left: 30px; border-radius: 8px;
}
.Taxbutn{
	color: #FFF; background-color: #2D4161; padding: 7px 14px;cursor: pointer;margin-right: 8px;font-size:12px;
}

</style>
<?php $colors=['#1AB696', '#999DAB', '#F3CC6F', '#FA6E58', '#334D8F', '#C8A66A', '#A4BF5B', '#31A8B8', '#91AAC7', '#F24A4A']; ?>
<!-- <?= $this->element('header'); ?> -->
<div style="background: #EBEEF3;">
	<input type="hidden"  id="tableInput" value="<?php echo $table_id; ?>" />
	
	<div class="row KOTView" style="padding:15px 0px;">
		<div class="col-md-12">
			<table width="100%">
				<tr>
					<td valign="top" width="50%" style=" padding: 0px 15px; ">
						<div style=" background-color: #FFF; border-radius: 8px !important; padding: 10px;">
							<table width="100%">
								<tr>
									<td style="padding:10px;padding-bottom: 5px; border-bottom: solid 1px #CCC;height: 300px;" valign="top">
									<div style="height:  300px !important;" id="ItemArea" >

									</div>	
									</td>
								</tr>
								<tr>
									<td id="SubCategoryArea" style="padding:10px;padding-top: 5px;padding-bottom: 5px; border-bottom: solid 1px #CCC;" valign="top">
										<span style="color:#373435;font-weight: bold;margin: 3px;">CHOOSE SUB CATEGORY</span><br/>
									</td>
								</tr>
								<tr>
									<td id="CategoryArea" style="padding:10px;padding-top: 5px; " valign="top">
										<span style="color:#373435;font-weight: bold;margin: 3px;">CHOOSE CATEGORY</span><br/>
									</td>
								</tr>
							</table>
							<div>
								<?php foreach($ItemCategories as $ItemCategory){ ?>
									<div class="ItemCategoryBox" category_id="<?= h($ItemCategory->id) ?>" >
										<?= h($ItemCategory->name) ?>
									</div>
									
									<div  category_id="<?= h($ItemCategory->id) ?>">
									<?php foreach($ItemCategory->item_sub_categories as $item_sub_category){ ?>
										<div class="ItemSubCategoryBox" category_id="<?= h($ItemCategory->id) ?>" sub_category_id="<?= h($item_sub_category->id) ?>" >
											<?= h($item_sub_category->name) ?>
										</div>
										
										<div  sub_category_id="<?= h($item_sub_category->id) ?>">
										<?php foreach($item_sub_category->items as $item){ ?>
											<span class="ItemBox" sub_category_id="<?= h($item_sub_category->id) ?>" item_id="<?= h($item->id) ?>" item_name="<?= h($item->name) ?>" rate="<?= h($item->rate) ?>" >
												<?= h($item->name) ?>
											</span>
										<?php } ?>
										</div>
									<?php } ?>
									</div>
									
								<?php } ?>
							</div>
						</div>
					</td>
					<?php echo $this->Form->input('dasds',['value' =>$order_type,'label' => false,'class'=>'form-control','type'=> 'hidden','id'=>'order_type']);?>
					<td valign="top" width="50%" style=" padding: 0px 15px 0px 0px;">
						<div style=" background-color: #FFF; border-radius: 8px !important; padding: 0px 15px;">
							<div style="padding-top:12px">
								<table width="100%">
									<tr>
										<td width="70%" style="padding:0 10px 0 0;">
											<?php
											$options=array(); 
											foreach($Items as $Item){
												$options[]=['text' =>$Item->name, 'value' => $Item->id, 'rate' => $Item->rate];
											}
											
											echo $this->Form->input('item_sub_category_id',['options' =>$options,'label' => false,'class'=>'form-control select2me ItemDropDown','empty'=> 'Search Item','autofocus']);?>
										</td>
										<td width="20%" style="padding:0 10px 0 0;">
											<input type="text" class="form-control QtyCatcher" placeholder="Quantity" value="1">
										</td>
										<td width="10%" >
											<span class="AddItemBtn">ADD</span>
										</td>
									</tr>
								</table>
							</div>
							<div style="max-height:200px;overflow-y:scroll;">
								<div style="padding-top:12px" >
									<table class="table" id="kotBox">
										<thead>
											<tr>
												<td style="text-align:center;">S.No.</td>
												<td>Name</td>
												<td style="text-align:center;">Quantity</td>
												<td style="text-align:center;">Rate</td>
												<td style="text-align:center;">Amount</td>
												<td style="text-align:center;">Comment</td>
												<td></td>
											</tr>
										</thead>
										<tbody>
										
										</tbody>
									</table>
								</div>
								<div id="all_kot_data"></div>
							</div>
							<div align="center" style="margin-top: 10px;">
								<textarea id="oneComment" style="display: none;"></textarea>
								<span class="KOTComment" >KOT COMMENT</span>
								<span class="CreateKOT" >CREATE KOT </span>
							</div>
							<hr style="margin-bottom: 2px; "></hr> 
						</div>
						<div style="background-color: #FFF; border-radius: 8px !important; padding: 0px 15px; margin-top:10px">
							<div style="padding-top:12px">
								
								<div id="deletemodal" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<div class="modal-content">
										  	<div class="modal-header">
												<h4 class="modal-title">
												Taxes in Bill
												</h4>
											</div>
											<div class="modal-body">
												<table class="table table-str">
													<thead>
														<tr>
															<th>Item Name</th>
															<th>Item Rate</th>
															<th>Quantity</th>
															<th>Tax</th>
															<th>Tax Amount</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
														<?php //pr($itemsList);
														$total_amount_without_tax=0;
														$total_amount_with_tax=0;
														$total_tax_amount=0;
														foreach ($itemsList as $value) {
															$name=$value['name'];
															$rate=$value['rate'];
															$quantity=$value['quantity'];
															$tax_name=$value['tax_name'];
															$tax_per=$value['tax_per'];
															$totamt=$rate*$quantity;
															$total_amount_without_tax+=$totamt;
															$taxamt=round(($totamt*$tax_per)/100,2);
															$total_tax_amount+=$taxamt;
															$showAmt=round($totamt+$taxamt,2);
															$total_amount_with_tax+=$showAmt;

															echo '
															<tr>
																<td>'.$name.'</td>
																<td>'.$rate.'</td>
																<td>'.$quantity.'</td>
																<td>'.$tax_name.'</td>
																<td>'.$taxamt.'</td>
																<td>'.$showAmt.'</td>
															</tr>';
														
														}
														$shwcgst=$total_tax_amount/2;
														?>
													</tbody>
													<tfoot>
														<tr>
															<th align="right" colspan="4">Total CGST</th>
															<th colspan="2"><?php echo $shwcgst;?></th>

														</tr>
														<tr>
															<th align="right" colspan="4">Total SGST</th>
															<th colspan="2"><?php echo $shwcgst;?></th>
														</tr>
														<tr style="color:#000000;background-color:#DDDDDD;">
															<th align="right" colspan="4">Total</th>
															<th><?php echo $total_tax_amount;?></th>
															<th><?php echo $total_amount_with_tax;?></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="modal-footer" style="border:none;"> 
												<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color:#000000;background-color:#DDDDDD;">Close</button>
											</div>
										</div>
									</div>
								</div>

								<table width="100%" border="0">
								<tr>
									<td width="50%" style="border-right:5px solid #f5f5f5;" id="customer_info">

									</td>
									<td width="50%">
										<table width="95%" style="margin-left:2%"  border="0">
											<tr>
												<td height="35px" width="65%"><b>Total :</b></td>
												<td width="35%"><b> &#8377; <?php echo $total_amount_without_tax;?> </b></td>
											</tr>
											<tr>
												<td height="35px" width="65%"><b>Tax :</b></td>
												<td width="35%"><span data-target="#deletemodal" data-toggle='modal' class="Taxbutn"><b> &#8377; <?php echo $total_tax_amount;?> </b></span></td>
											</tr>
											<tr style="background:#eee">
												<td height="35px" width="65%"><b>Net Amount :</b></td>
												<td width="35%"><b> &#8377; <?php echo $total_amount_with_tax;?> </b></td>
											</tr>
											<tr>
												<td colspan="2" height="35px">
													<?php if($order_type=='dinner'){
														echo $this->Form->input('employee_id',['options'=>$Employees,'class'=>'form-control input-sm select2 employee_id','empty' => '--Select Steward--','label'=>false,'required'=>'required','value'=>@$Table_data->employee_id,'id'=>'employee_id']);
														}
														else{
															echo $this->Form->input('employee_id',['options'=>$Employees,'class'=>'form-control input-sm select2','empty' => '--Select Steward--','label'=>false,'required'=>'required','value'=>@$Table_data->employee_id,'id'=>'employee_id']);
														} ?>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div style="padding-top:20px;width:100%"  align="center">
														<span class="CreateBill" align="center"><i class="fa fa-rupee "></i> GENERATE BILL </span>
														</br></br> 
													</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>			
		   
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<style> 
#kotBox td{
	padding:12px 0px;
}
.tblBox{
	width: 240px; margin: 10px;
	background-color: #FFF;
    padding: 7px;
    border-radius: 7px !important;
	position: relative;
	margin-bottom:25px;
	display: inline-block;
}
.tblLabel{
	position: absolute;
    top: -15px;
    left: 15px;
    padding: 7px 6px;
    background-color: #FA6E58;
    color: #FEFEFE;
    border-radius: 5px !important;
    font-weight: bold;
}
.tblBox:hover{
	cursor: pointer;
}
.ItemCategoryBox{
    border: solid 1px;
    float: left;
    font-size: 14px;
    padding: 5px 20px;
	margin: 3px;
	cursor: pointer;
	background-color:#2D4161;
	color:#FFF;
	border-radius: 5px !important;
}

.activeMain{
	background-color: #FA6775;
    color: #FFF;
}

.ItemSubCategoryBox{
    border: solid 1px;
    float: left;
    font-size: 14px;
    padding: 5px 20px;
	margin: 3px;
	cursor: pointer;
	background-color:#848688;
	color:#FFF;
	border-radius: 5px !important;
}

.activeSub{
	background-color: #6FB98F;
    color: #FFF;
}


.ItemBox{
    float: left;
    font-size: 14px;
    padding: 5px 20px;
	margin: 3px;
	cursor: pointer;
	background-color:#F5F5F5;
	color:#474445;
	border-radius: 5px !important;
}

#BackToTables{
	color: #504358;
	font-size: 14px;
	cursor: pointer
}
#TablesHeading, #KOTHeading{
	color: #f16969;
	font-size: 16px;
}
#billTable{
	tr td{
		padding:2px;
	}
}
.qty{
	width: 50px;
    height: 20px;
    text-align: center; 
}
</style>

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
<?php echo $this->Html->css('/assets/animate.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
<?php
	$waitingMessage='<div align=center><br/><i class="fa fa-gear fa-spin" style="font-size:50px"></i><br/><span style="font-size: 18px; font-weight: bold;">Submitting...</span></div>';
	$waitingMessage2='<div align=center><br/><i class="fa fa-gear fa-spin" style="font-size:50px"></i><br/><span style="font-size: 18px; font-weight: bold;">Loading...</span></div>';
	$successMessage='<div align=center><br/><span aria-hidden=true class=icon-check style="font-size:50px;color: #1AB696; font-weight: bold;"></span><br/><br/><span style="font-size: 18px; color: #727376; font-weight: bold;">KOT Created Successfully.</span><br/></div><div style="text-align:  center;margin-top: 20px;"><span class="closePopup">Close</span></div>';
	$BillSuccessMessage='<div align=center><br/><span aria-hidden=true class=icon-check style="font-size:50px;color: #096609; font-weight: bold;"></span><br/><span style="font-size: 18px; color: #096609; font-weight: bold;">Bill Created</span><div><button type="button" class="btn btn-primary closePopup">Close</button></div></div>';
	$errorMessage='<div align=center><br/><span aria-hidden=true class=icon-close style="font-size:50px;color: #ae0808; font-weight: bold;"></span><br/><span style="font-size: 18px; color: #ae0808; font-weight: bold;">Something went wrong.</span><div><button type="button" class="btn btn-primary closePopup">Close</button></div></div>';
	$js='';
	if($order_type=='dinner'){	 
		$js.="
			$(document).ready(function() {
				//-- VIew Customer Info
				var table_id=$('#tableInput').val();
				var url='".$this->Url->build(['controller'=>'Kots','action'=>'customer'])."';
				url=url+'?table_id='+table_id;
				$.ajax({
					url: url,
				}).done(function(response) { 
					$('#customer_info').html(response);
				});
			});
		";
	}
	
	$js.="
	$(document).ready(function() {
		var order_type=$('#order_type').val();
		var q=$('.ItemCategoryBox').clone();
		$('.ItemCategoryBox').remove();
		$('#CategoryArea').append(q);
		var q=$('.ItemSubCategoryBox').clone();
		$('.ItemSubCategoryBox').remove();
		$('#SubCategoryArea').append(q);
		var q=$('.ItemBox').clone();
		$('.ItemBox').remove();
		$('#ItemArea').html(q);
		
		$('.ItemSubCategoryBox').hide();
		$('.ItemBox').hide();
		
		$('#CategoryArea .ItemCategoryBox').first().show().addClass('activeMain');
		var category_id=$('#CategoryArea .ItemCategoryBox').first().attr('category_id');
		$('.ItemSubCategoryBox[category_id='+category_id+']').show();
		var sub_category_id=$('#SubCategoryArea .ItemSubCategoryBox[category_id='+category_id+']').first().attr('sub_category_id');
		$('#SubCategoryArea .ItemSubCategoryBox[category_id='+category_id+']').first().addClass('activeSub');
		$('.ItemBox[sub_category_id='+sub_category_id+']').show();
		
		$('.ItemCategoryBox').die().live('click',function(event){
			$('.ItemCategoryBox').removeClass('activeMain');
			$(this).addClass('activeMain');
			var category_id=$(this).attr('category_id');
			$('.ItemSubCategoryBox').hide();
			$('.ItemSubCategoryBox[category_id='+category_id+']').show();
		});
		$('.ItemSubCategoryBox').die().live('click',function(event){
			$('.ItemSubCategoryBox').removeClass('activeSub');
			$(this).addClass('activeSub');
			var sub_category_id=$(this).attr('sub_category_id');
			$('.ItemBox').hide();
			$('.ItemBox[sub_category_id='+sub_category_id+']').show();
		});

		//-- View All KOTS
		var order = '".$order."';
		var table_id=$('#tableInput').val();
		var url='".$this->Url->build(['controller'=>'Kots','action'=>'index'])."';
		url=url+'?table_id='+table_id+'&order='+order;
		$.ajax({
			url: url,
		}).done(function(response) {
			$('#all_kot_data').html(response);
		});

		
		//--
		$('.plus').die().live('click',function(event){
			var qty = parseInt($(this).closest('td').find('span.qty').html());
			var news = qty+parseInt(1);
			$(this).closest('td').find('span.qty').html(' '+news+' ');
			amountcals();
		});
		$('.minus').die().live('click',function(event){
			var qty = parseInt($(this).closest('td').find('span.qty').html());
			if(qty !=1 ){
				var news = qty-parseInt(1);
				$(this).closest('td').find('span.qty').html(' '+news+' ');
				amountcals();
			}
		});

		$('.ItemBox').die().live('click',function(event){
			var item_id=$(this).attr('item_id');
			var item_name=$(this).attr('item_name');
			var rate=$(this).attr('rate');
			var c=$('#kotBox tbody tr').length;
			c=c+1;
			$('#kotBox').append('<tr row_no='+c+'><td style=text-align:center;>'+c+'</td><td item_id='+item_id+'>'+item_name+'</td><td style=text-align:center;><span class=\"minus\">-</span><span class=\"qty\"> 1 </span><span class=\"plus\">+</span></td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;><i class=\"fa fa-ellipsis-h commentRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i><textarea style=\"display:none;\" class=\"comment\"></textarea></td><td style=text-align:center;><i class=\"fa fa-trash-o removeRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i></td></tr>');
			amountcals();
		});

		$('.saveCustomersearch').die().live('click',function(event){
			//-- VIew Customer Info
			var table_id=$('#tableInput').val();
			var search=$('#search').val();
			if(!search){
				var search=$('#search_mobile').val();
				if(!search){
					var search=$('#search_code').val();
				}
			}
			var url='".$this->Url->build(['controller'=>'Kots','action'=>'customer'])."';
			url=url+'?table_id='+table_id+'&search='+search;
			$.ajax({
				url: url,
			}).done(function(response) { 
				$('#customer_info').html(response);
			});
		}); 

		$('.saveCustomer').die().live('click',function(event){
			$(this).text('Saving...');
			var c_table_id=$('#c_table_id').val();
			var c_name=$('#c_name').val();
			var c_mobile_no=$('#c_mobile_no').val();
			var c_pax=$('#c_pax').val();
			var dob='';
			var doa='';
			var c_email=$('#c_email').val();
			var c_address=$('#c_address').val();
			var url='".$this->Url->build(['controller'=>'Tables','action'=>'saveCustomeronbill'])."';
			url=url+'?c_name='+c_name+'&c_mobile_no='+c_mobile_no+'&dob='+dob+'&doa='+doa+'&c_email='+c_email+'&c_address='+c_address+'&c_pax='+c_pax+'&table_id='+c_table_id;
			url=encodeURI(url);
			$.ajax({
				url: url,
			}).done(function(response) {
				if(response=='1'){
					 UpdateCustmber();
				}else{
					alert('Not saved. Something went wrong.');
				}
			});
		});
		
		$('.AddItemBtn').die().live('click',function(event){
			var item_id=$('.ItemDropDown option:selected').val();
			var Qty=parseFloat($('.QtyCatcher').val());
			if(item_id && Qty){
				var item_name=$('.ItemDropDown option:selected').text();
				var rate=$('.ItemDropDown option:selected').attr('rate');
				
				var c=$('#kotBox tbody tr').length;
				c=c+1; 
				$('#kotBox').append('<tr row_no='+c+'><td style=text-align:center;>'+c+'</td><td item_id='+item_id+'>'+item_name+'</td><td style=text-align:center;><span class=\"minus\">-</span><span class=\"qty\"> '+Qty+' </span><span class=\"plus\">+</span></td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;><i class=\"fa fa-ellipsis-h commentRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i><textarea style=\"display:none;\" class=\"comment\"></textarea></td><td style=text-align:center;><i class=\"fa fa-trash-o removeRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i></td></tr>');
				amountcals();
			}
			
		});
		
		$('.removeRow').die().live('click',function(event){
			$(this).closest('tr').remove();
			var c=0;
			$('#kotBox tbody tr').each(function(){
				var item_id=$(this).attr('row_no',++c);
				var item_id=$(this).find('td:nth-child(1)').text(c);
			});
		});
		
		$('.closePopup').die().live('click',function(event){
			$('#WaitBox').hide();
		});
		
		$('.CreateKOT').die().live('click',function(event){
			event.preventDefault();
			if($('#kotBox tbody tr').length==0){
				alert('Add at-least one item.')
				return;
			}
			$('#WaitBox').show();
			$('#WaitBox div.modal-body').html('".$waitingMessage."');
			var postData=[];
			$('#kotBox tbody tr').each(function(){
				var item_id=$(this).find('td:nth-child(2)').attr('item_id');
				var quantity=$(this).find('td span.qty').html();
 				var rate=$(this).find('td:nth-child(4)').text();
				var amount=$(this).find('td:nth-child(5)').text();
				var comment=$(this).find('.comment').val();
				
				postData.push({item_id : item_id, quantity : quantity, rate : rate, amount : amount, comment : comment}); 
			});
			var table_id=$('#tableInput').val();
			var order_type= $('#order_type').val();
			var one_comment=$('#oneComment').val();
			var myJSON = JSON.stringify(postData);
			var url='".$this->Url->build(['controller'=>'Kots','action'=>'add'])."';
			url=url+'?myJSON='+myJSON+'&table_id='+table_id+'&one_comment='+one_comment+'&order_type='+order_type;
			$.ajax({
				url: url,
			}).done(function(response) {
				if(response>0){
					$('#kotBox tbody tr').remove();
					$('#oneComment').val('');
					if(order_type=='dinner'){
						//$('#WaitBox div.modal-body').html('".$successMessage."');
						var url='".$this->Url->build(['controller'=>'Kots','action'=>'viewkot'])."';
						url=url+'/'+response;
						location. reload();
		        		window.open(url, '_blank'); 

					}
					else {
						$('.CreateBill').trigger('click');
						var url='".$this->Url->build(['controller'=>'Kots','action'=>'viewkot'])."';
						url=url+'/'+response;
		        		window.open(url, '_blank');
					}					
				}else{
					$('#WaitBox div.modal-body').html('".$errorMessage."');
				}
			});
		});
		
		$('.closeViewKot').die().live('click',function(event){
			$('#WaitBox4').hide();
		});

		 
		$('.CreateBill').die().live('click',function(event){
			event.preventDefault();
			var table_id=$('#tableInput').val();
			$('#WaitBox3').show();
			$('#WaitBox3 div.modal-body').html('".$waitingMessage2."');
			var url='".$this->Url->build(['controller'=>'Kots','action'=>'view'])."';
			url=url+'?table_id='+table_id;
			$.ajax({
				url: url,
			}).done(function(response) {
				$('#WaitBox3 div.modal-body').html(response);
			});
		});
		
		$('.searchcustomber').die().live('click',function(event){
			event.preventDefault();
			var table_id=$('#tableInput').val();
			var search_code = $('#search_code').val();
			var search_mobile = $('#search_mobile').val();
			if(search_mobile.length==0){search_mobile=0;}
			if(search_code.length==0){search_code=0;}

			$('#WaitBox3').show();
			$('#WaitBox3 div.modal-body').html('".$waitingMessage2."');
			var url='".$this->Url->build(['controller'=>'Kots','action'=>'view'])."';
			url=url+'?table_id='+table_id+'&search_code='+search_code+'&search_mobile='+search_mobile;
			$.ajax({
				url: url,
			}).done(function(response) {
				$('#WaitBox3 div.modal-body').html(response);
			});
		});
		
		$('.CancelBill').die().live('click',function(event){
			event.preventDefault();
			$('#WaitBox3').hide();
		});
		
		$('.SubmitBill').die().live('click',function(event){
			$('#loading').show();
			event.preventDefault();
			$(this).text('Saving...');
			$('#WaitBox2').show();
			$('#WaitBox2 div.modal-body').html('".$waitingMessage."');
			var postData=[];
			$('#billTable tbody.main tr').each(function(){
				var item_id=$(this).find('td:nth-child(2)').attr('item_id');
				var quantity=$(this).find('td:nth-child(3)').text();
				var rate=$(this).find('td:nth-child(4)').text();
				var amount=$(this).find('td:nth-child(5)').text();
				var discount_per=$(this).find('td:nth-child(6) input').val();
				if(!discount_per){ discount_per=0;}
				var discount_amt=$(this).find('td:nth-child(7) input').val();
				if(!discount_amt){ discount_amt=0;}
				var percen=parseFloat($(this).find('td:nth-child(8) span.percen').html());
				var net_amount=$(this).find('td:nth-child(9)').text();
				postData.push({item_id : item_id, quantity : quantity, rate : rate, amount : amount, discount_per : discount_per, net_amount : net_amount, percen : percen, discount_amt : discount_amt}); 
			});
			var order_type=$('#order_type').val();
			var table_id=$('#tableInput').val();
			var c_name=$('#c_name').val();
			var c_mobile_no=$('#c_mobile_no').val();
			var c_pax=$('#c_pax').val();
			var dob=$('#dob').val();
			var doa=$('#doa').val();
			var employee_id=$('#employee_id option:selected').val();
			
			var c_email=$('#c_email').val();
			var c_address=$('#c_address').val();

			var offer_id=$('span.offer_id').text();
			
			var total=$('#billTable tfoot tr:nth-child(1) td:nth-child(4)').text();
			var roundOff=$('#billTable tfoot tr:nth-child(2) td:nth-child(2)').text();
			var net=$('#billTable tfoot tr:nth-child(3) td:nth-child(2)').text();
			var kot_ids=$('input[name=kot_ids]').val();
			
			var myJSON = JSON.stringify(postData);
			var url='".$this->Url->build(['controller'=>'Bills','action'=>'add'])."';
			url=url+'?myJSON='+myJSON+'&table_id='+table_id+'&total='+total+'&roundOff='+roundOff+'&net='+net+'&kot_ids='+kot_ids+'&c_name='+c_name+'&c_mobile_no='+c_mobile_no+'&dob='+dob+'&doa='+doa+'&c_email='+c_email+'&c_address='+c_address+'&c_pax='+c_pax+'&order_type='+order_type+'&employee_id='+employee_id+'&offer_id='+offer_id;
			url=encodeURI(url);
			$.ajax({
				url: url,
			}).done(function(bill_id) {
				 
				if(bill_id!=0){
					$('#WaitBox3').hide();
					$('#WaitBox2').hide();
					
					var url='".$this->Url->build(['controller'=>'Bills','action'=>'view'])."';
					url=url+'?bill-id='+bill_id;
					var win = window.open(url, '_blank');
					win.focus();

					var url2='".$this->Url->build(['controller'=>'Tables','action'=>'index'])."';
  					window.location.href = url2;
  					
				}else{
					$('#loading').hide();
					$('#WaitBox3 div.modal-body').html('".$errorMessage."');
				}
				
			});
		});
		
		$('.disBox').die().live('keyup',function(event){
			var qty           = parseFloat($(this).closest('tr').find('td:nth-child(3)').text());
		    if(isNaN(qty)){ qty=0; }
			var rate          = parseFloat($(this).closest('tr').find('td:nth-child(4)').text());
			if(isNaN(rate)){ rate=0; }
			var discount_per  = parseFloat($(this).closest('tr').find('td:nth-child(6) input').val());
			if(isNaN(discount_per)){ discount_per=0; }
			var amount   = qty*rate;						
			if(discount_per)
			{   
				var disAmt    = (amount*discount_per)/100;
				disAmt  = round(disAmt,2);
			}
			$(this).closest('tr').find('td:nth-child(7) input').val(disAmt);
			calculateBill();
		});
		
		$(document).on('keyup','.disBoxamt',function(e){
			var qty           = parseFloat($(this).closest('tr').find('td:nth-child(3)').text());
		    if(isNaN(qty)){ qty=0; }

			var rate          = parseFloat($(this).closest('tr').find('td:nth-child(4)').text());
			if(isNaN(rate)){ rate=0; }

			var discount_amt  = parseFloat($(this).closest('tr').find('td:nth-child(7) input').val());
			if(isNaN(discount_amt)){ discount_amt=0; }
			
			var amount   = qty*rate;

			if(discount_amt && amount>0)
			{   
				var dis_per   = (discount_amt*100)/amount;
				dis_per = round(dis_per,2);
				
			}
			$(this).closest('tr').find('td:nth-child(6) input').val(dis_per);
			calculateBill();
		});
		
		$('.overalldis').die().live('keyup',function(event){
			var dic = $(this).val();
			$('.disBox').val(dic);
			$('#billTable tbody.main tr').each(function(){
				var qty           = parseFloat($(this).closest('tr').find('td:nth-child(3)').text());
			    if(isNaN(qty)){ qty=0; }
				var rate          = parseFloat($(this).closest('tr').find('td:nth-child(4)').text());
				if(isNaN(rate)){ rate=0; }
				var discount_per  = parseFloat($(this).closest('tr').find('td:nth-child(6) input').val());
				
				if(isNaN(discount_per)){ discount_per=0; }
				var amount   = qty*rate;						
				if(discount_per)
				{   
					var disAmt    = (amount*discount_per)/100;
					disAmt  = round(disAmt,2);
				}
				$(this).closest('tr').find('td:nth-child(7) input').val(disAmt);
			});
			calculateBill();
		});
		
		function calculateBill(){
			var total=0;
			$('#billTable tbody.main tr').each(function(){
				var quantity=parseFloat($(this).find('td:nth-child(3)').text());
				var rate=parseFloat($(this).find('td:nth-child(4)').text());
				var amount=parseFloat($(this).find('td:nth-child(5)').text());
				var discount_amount=parseFloat($(this).find('td:nth-child(7) input').val());

				if(discount_amount){ 
				 	taxable_value=round(amount-discount_amount,2);
 				}else{
 					taxable_value=amount;
 					discount_amount=0;
 				}

				var percen=parseFloat($(this).find('td:nth-child(8) span.percen').html());
				var taxamount=round((taxable_value*percen)/100,2);
				var net=taxable_value+taxamount;
				net=round(net,2);
				
				$(this).find('td:nth-child(9)').text(net);
				total=total+net;
			});
			total=round(total,2);

			$('#billTable tfoot tr:nth-child(1) td:nth-child(5)').text(total); 
			var totalAfterTax=total-round(total);
			var totalAfterTaxRound=round(totalAfterTax,0);
			var roundOff=round(totalAfterTaxRound-totalAfterTax,2);
			$('#billTable tfoot tr:nth-child(2) td:nth-child(2)').text(roundOff);
			total=round(total);
			$('#billTable tfoot tr:nth-child(3) td:nth-child(2)').text(total);
		}

		$('.accordion-toggle').die().live('click',function(event){
			$('div.panel-heading').css('background-color','#E6E7E8');
			$('div.panel-heading').find('a.accordion-toggle').css('color','#474445');
			$('div.panel-heading').find('span.iconBox').html('<i class=\"fa fa-plus\"></i>').css('color','#474445');
			$(this).closest('div.panel-heading').css('background-color','#2D4161');
			$(this).closest('div.panel-heading').find('a.accordion-toggle').css('color','#FFF');
			$(this).closest('div.panel-heading').find('span.iconBox').html('<i class=\"fa fa-minus\"></i>').css('color','#FFF');
		});


		$('.commentRow').die().live('click',function(event){
			var c=$(this).closest('tr').find('.comment').val();
			$('.commentContainor').val(c);
			var sr_no=$(this).closest('tr').attr('row_no');
			$('#rowSR').val(sr_no);
			$('#WaitBox5').show();
		});

		$('.closeCommentBox').die().live('click',function(event){
			$('#WaitBox5').hide();
		});

		$('.commentString').die().live('click',function(event){
			var s=$(this).text();
			old_s=$('.commentContainor').val();
			if(old_s!=''){
				s=old_s+', '+s;
			}
			
			$('.commentContainor').val(s);
		});

		$('.saveComment').die().live('click',function(event){
			var c=$('.commentContainor').val();
			var sr_no=$('#rowSR').val();
			if(sr_no=='0'){
				$('#oneComment').val(c);
				$('#WaitBox5').hide();
			}else{
				$('tr[row_no='+sr_no+']').find('.comment').val(c);
				$('#WaitBox5').hide();
			}
			
		});

		$('.KOTComment').die().live('click',function(event){
			var c=$('#oneComment').val();
			$('.commentContainor').val(c);
			var sr_no=0;
			$('#rowSR').val(sr_no);
			$('#WaitBox5').show();
		});
		
		$('.employee_id').die().live('change',function(event){
			var steward_name=$(this).find('option:selected').text();
			var steward_id=$(this).find('option:selected').val();
			var table_id=$('#tableInput').val();
			var url='".$this->Url->build(['controller'=>'Tables','action'=>'saveSteward'])."';
			url=url+'?table_id='+table_id+'&steward_id='+steward_id;
			url=encodeURI(url);
			$.ajax({
				url: url,
			}).done(function(response) {
				
			});
		});



		
		$('#removeoffer').die().live('click',function(event){
			event.preventDefault();
			$('#offerShow').html('');
			$('td.overAllTd').removeClass('disabledbutton');
			$('.disBox').removeAttr('readonly');
			$('.disBoxamt').removeAttr('readonly');

			var dic = 0;
			$('.disBox').val(dic);
			$('#billTable tbody.main tr').each(function(){
				var qty           = parseFloat($(this).find('td:nth-child(3)').text());
			    if(isNaN(qty)){ qty=0; }
				var rate          = parseFloat($(this).find('td:nth-child(4)').text());
				if(isNaN(rate)){ rate=0; }
				var discount_per  = parseFloat($(this).find('td:nth-child(6) input').val());
				if(isNaN(discount_per)){ discount_per=0; }
				var amount   = qty*rate;						
				if(discount_per)
				{   
					var disAmt    = (amount*discount_per)/100;
					disAmt  = round(disAmt,2);
				}
				$(this).find('td:nth-child(7) input').val(disAmt);
			});
			calculateBill();
		});

		$('.apply').die().live('click',function(event){
			var offer_code=$('input[name=offer_code]').val();
			if(!offer_code){
				alert('Enter a offer code');
				return;
			}
			$(this).text('Appling');
			var th=$(this);

			var url='".$this->Url->build(['controller'=>'OfferCodes','action'=>'checkOffer'])."';
			url=url+'?offer_code='+offer_code;
			 
			$.ajax({
				url: url,
				dataType: 'json',
			}).done(function(response) {
				if(response.valid=='yes'){
					$('td.overAllTd').addClass('disabledbutton');
					$('.disBox').attr('readonly', 'readonly');
					$('.disBoxamt').attr('readonly', 'readonly');
					$('.overalldis').val('');

					var dic = response.per;
					$('.disBox').val(dic);
					$('#billTable tbody.main tr').each(function(){
						var qty           = parseFloat($(this).find('td:nth-child(3)').text());
					    if(isNaN(qty)){ qty=0; }
						var rate          = parseFloat($(this).find('td:nth-child(4)').text());
						if(isNaN(rate)){ rate=0; }
						var discount_per  = parseFloat($(this).find('td:nth-child(6) input').val());
						if(isNaN(discount_per)){ discount_per=0; }
						var amount   = qty*rate;						
						if(discount_per)
						{   
							var disAmt    = (amount*discount_per)/100;
							disAmt  = round(disAmt,2);
						}
						$(this).find('td:nth-child(7) input').val(disAmt);
					});
					calculateBill();

					$('#offerShow').html('Offer code applied: '+offer_code+'@'+response.per+'% <span class=offer_id style=\"display:none;\">'+response.offer_id+'</span> <a href=# id=removeoffer >Remove</a> ');

				}else{
					alert('The offer code is not valid.');
				}
				th.text('APPLY');
				$('input[name=offer_code]').val('');
			});


		});



	});


	
	
	function UpdateCustmber(){
		var table_id=$('#tableInput').val();
		var url='".$this->Url->build(['controller'=>'Kots','action'=>'customer'])."';
		url=url+'?table_id='+table_id;
		 
		$.ajax({
			url: url,
		}).done(function(response) { 
			$('#customer_info').html(response);
		});
	}
	function amountcals(){
		$('#kotBox tbody tr').each(function(){
			var quantity=parseInt($(this).find('td span.qty').html());
			var rate=parseInt($(this).find('td:nth-child(4)').text());
			var tot_amount=quantity*rate;
			$(this).find('td:nth-child(5)').text(tot_amount);
		});
	}	
	";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
?>

<div id="WaitBox" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>

<div id="WaitBox2" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>

<div id="WaitBox3" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop " ></div>
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>

<div id="WaitBox4" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>

<div id="WaitBox5" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<input type="hidden" id="rowSR">
				<div style=" text-align: center; padding: 0px 0 15px 0px; font-size: 15px; font-weight: bold; color: #2D4161; ">COMMENT BOX</div>
				<br/>
				<div class="form-group">
					<textarea class="form-control commentContainor" rows="3" style="background-color: #F5F5F5;"></textarea>
				</div>
				<br/>
				<div>
					<label style=" color: #2D4161; font-weight: bold; font-size: 14px; ">Predefined Comments</label>
					<div>
						<?php foreach ($Comments as $Comment) { ?>
							<span class="commentString"><?php echo $Comment; ?></span>
						<?php } ?>
					</div>
				</div>
				<br/><br/>
				<div align="center">
					<span class="closeCommentBox">CLOSE</span>
					<span class="saveComment">SAVE COMMENT</span>
				</div>
			</div>
		</div>
	</div>
</div>