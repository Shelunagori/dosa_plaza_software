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
.minusOld{
	color: #FFF; background-color: #FA6775;padding: 0px 7px;font-size:15px;cursor: pointer; font-weight: bold;
} 
.plusOld{
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
.commentStringOld{
    background-color: #2d4161;
    padding:  5px;
    border-radius:  5px;
    color:  #FFF;
    margin-right:  5px;
    cursor:  pointer;
}
.commentStringKOT{
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
	color: #FFF; background-color: #FA6775; cursor: pointer;font-size:12px;
}
.ViewAllKOT{
	color: #FFF; background-color: #FA6775; padding: 7px 14px;cursor: pointer;font-size:12px;
}
.KOTComment{
	color: #000; background-color: #F5F5F5; cursor: pointer;margin-right: 8px;font-size:10px;
}
.CreateBill{
	color: #FFF; background-color: #2D4161; font-size:15px;background-color: #2d4161 !important;
}
.Taxbutn{
	color: #FFF; background-color: #2D4161; padding: 7px 14px;cursor: pointer;margin-right: 8px;font-size:12px;
}

</style>
<!-- <?= $this->element('header'); ?> -->
<div style="background: #EBEEF3;">
	<input type="hidden"  id="tableInput" value="<?php echo $table_id; ?>" />
	
	<div class="row KOTView" style="padding:1px 0px;">
		<div class="col-md-12">
			<table width="100%">
				<tr>
					<td valign="top" width="60%" style=" padding: 0px 2px; ">
						<div style=" background-color: #FFF; border-radius: 8px !important;">

							<table width="100%">
								<tr>
									<td style="padding-bottom: 5px; border-bottom: solid 1px #CCC;height: 300px;" valign="top">
										<table width="100%">
											<tr>
												<td width="5%">
													<button type="button" class="btn default" style="" id="slideLeft" currentpage="0">  <i class="fa fa-chevron-left" style="color: #2d4161;"></i> </button>
												</td>
												<td width="90%">
													<div style="max-height:300px; height:300px;" id="ItemArea" >
														
													</div>	
												</td>
												<td width="5%">
													<button type="button" class="btn default" style="" id="slideRight" currentpage="1">  <i class="fa fa-chevron-right" style="color: #2d4161;"></i> </button>
												</td>
											</tr>
										</table>
									
									</td>
								</tr>
								<tr>
									<td style="padding-top: 5px;padding-bottom: 5px; border-bottom: solid 1px #CCC;" valign="top">
										<span style="color:#373435;font-weight: bold;margin: 3px;">CHOOSE SUB CATEGORY</span><br/>
										<div id="SubCategoryArea" >
										</div>
									</td>
								</tr>
								<tr>
									<td style="padding-top: 5px;border-bottom: solid 1px #CCC; " valign="top">
										<span style="color:#373435;font-weight: bold;margin: 3px;">CHOOSE CATEGORY</span><br/>
										<div>
											<div id="CategoryArea" >
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td style="padding:10px;padding-top: 5px; text-align: center;" valign="top">
										<br/>
										<a href="javascript:void(0)" class="fvtr" style="margin: 3px; padding: 5px 10px; background-color: #f0b11b; border-radius: 5px; color: #FFF; font-weight: 400;text-decoration: none;">FAVORITES</a>
									</td>
								</tr>
							</table>
							<div style="display: none;">
								<?php 
								$fz=1; $fzx=0;

								
								foreach($ItemCategories as $ItemCategory){ ?>
									<div class="ItemCategoryBox" category_id="<?= h($ItemCategory->id) ?>" >
										<?= h($ItemCategory->name) ?>
									</div>
									
									<div  category_id="<?= h($ItemCategory->id) ?>">
									<?php foreach($ItemCategory->item_sub_categories as $item_sub_category){ ?>
										<div class="ItemSubCategoryBox" category_id="<?= h($ItemCategory->id) ?>" sub_category_id="<?= h($item_sub_category->id) ?>" >
											<?= h($item_sub_category->name) ?>
										</div>
										
										<div  sub_category_id="<?= h($item_sub_category->id) ?>">
										<?php 
										$z=1; $zx=0; 
										foreach($item_sub_category->items as $item){ 
											$zx++;
											if($zx==21){ $zx=1; $z++; }

											if($item->is_favorite==1){
												$fzx++;
												if($fzx==21){ $fzx=1; $fz++; }
												$fav_attr='fav_display_no='.$fz;
											}else{
												$fav_attr='';
											}
											
										?>
											<span class="ItemBox" sub_category_id="<?= h($item_sub_category->id) ?>" item_id="<?= h($item->id) ?>" item_name="<?= h($item->name) ?>" rate="<?= h($item->rate) ?>" is_favorite="<?php echo (int)$item->is_favorite; ?>" display_no="<?php echo $z; ?>" <?php echo $fav_attr; ?>  style="background-color: <?php echo $item->color ?>">
												<?= h($item->name) ?><br/>
												[<?= h($item->rate) ?>]
											</span>
										<?php } ?>
										</div>
									<?php } ?>
									</div>
									
								<?php } ?>
							</div>
						</div>
					</td>
					<?php echo $this->Form->input('dasds',['value' =>$order_type,'label' => false,'type'=> 'hidden','id'=>'order_type']);?>
					<td valign="top" width="40%" style=" padding: 0px 15px 0px 0px;">
						<div style=" background-color: #FFF; border-radius: 8px !important; padding: 0px 5px;">
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
							<div style="max-height:280px; height:280px; overflow-y:scroll;">
								<div style="padding-top:12px" >
									<table class="table table-striped" id="kotBox" style=" margin: 0; ">
										<thead>
											<tr>
												<td style="text-align:center;width: 5%;">S.No.</td>
												<td style="width: 50%;">Name</td>
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
									<div id="overallComnt" style="text-align: center;"></div>
									<div align="center" style="margin-top: 10px;">
										<textarea id="oneComment" style="display: none;"></textarea>
										<a href="javascript:void(0)" class="KOTComment btn default btn-sm" >KOT COMMENT</a>
										<a href="javascript:void(0)"  class="CreateKOT btn btn-danger btn-sm" >CREATE KOT </a>
									</div>
								</div>
								
								<div id="all_kot_data"></div>
							</div>
							
							
							<hr style="margin-bottom: 2px; "></hr> 
						</div>
						<div style="background-color: #FFF; border-radius: 8px !important; padding: 0px 5px; margin-top:3px">
							<div style="padding-top:4px">
								
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
									<td width="60%" style="border-right:5px solid #f5f5f5;" valign="top">
										<?php if($table_id){ ?>
											<table width="100%" >
												<tr>
													<td style="padding-right: 5px;" width="40%">
														<?php echo $this->Form->input('customer_id',['options' =>$Customers,'label' => false,'class'=>'form-control input-medium input-sm select2me ','empty'=> 'Search']);?>
													</td>
													<td style="padding-right: 2px; text-align: center;" width="5%">
														<button type="button" class="btn btn-danger btn-sm" id="LinkCustomer"><i class="fa fa-check"></i></button>
													</td>
													<td style="padding-right: 0px; text-align: center;" width="5%">
														<button type="button" class="btn btn-danger btn-sm" id="NewCustomer"><i class="fa fa-plus" ></i></button>
													</td>
												</tr>
											</table>
											<table width="100%" id="newCustomerTable" style="display: none;">
												<tr>
													<td style="padding-right: 5px;width: 40%;" width="40%">
														<?php echo $this->Form->input('customer_name',['label' => false,'class'=>'form-control  input-sm ', 'placeholder' => 'Name']);?>
													</td>
													<td style="padding-right: 5px;width: 40%;" width="40%">
														<?php echo $this->Form->input('customer_mobile',['label' => false,'class'=>'form-control input-sm ', 'placeholder' => 'Mobile']);?>
													</td>
													<td style="padding-right: 0px; text-align: center;" width="10%">
														<button type="button" class="btn btn-danger btn-sm" id="SaveNewCustomer">Save</button>
													</td>
												</tr>
											</table>
											<div id="CustomerInfo" style=" padding-top: 4px; ">
												
											</div>
										<?php } ?>
										
									</td>
									<td width="40%" valign="top">
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
														<a href="javascript:void()" class="CreateBill btn blue-hoki btn-block" align="center"><i class="fa fa-rupee "></i> GENERATE BILL </a>
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
	padding:5px 0px;
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
    text-align: center;
    border: solid 1px;
    float: left;
    font-size: 12px;
    padding: 8px 16px;
	margin: 3px;
	cursor: pointer;
	background-color:#2D4161;
	color:#FFF;
	border-radius: 5px !important;
	text-align: center;
}

.activeMain{
	background-color: #FA6775;
    color: #FFF;
}

.ItemSubCategoryBox{
    border: solid 1px;
    float: left;
    font-size: 12px;
    padding: 8px 16px;
	margin: 3px;
	cursor: pointer;
	background-color:#848688;
	color:#FFF;
	border-radius: 5px !important;
	text-align: center;
}

.activeSub{
	background-color: #6FB98F;
    color: #FFF;
}


.ItemBox{
    width: 100px;
    height: 60px;
    float: left;
    font-size: 11px;
    padding: 2px 2px;
    margin: 3px;
    cursor: pointer;
    border: solid 1px #d6d6d6;
    background-color: #F5F5F5;
    color: #474445;
    border-radius: 5px !important;
    text-align: center;
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
	
	
	$js="
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
		
		$('.fvtr').die().live('click',function(event){
			$('#favStatus').val(1);
			$('#slideLeft').attr('currentPage',1);
			$('#slideRight').attr('currentPage',1);
			$('.ItemBox[is_favorite=0]').hide();
			$('.ItemBox[is_favorite=1]').show();

			$('.ItemBox').hide();
			$('.ItemBox[is_favorite=1][fav_display_no=1]').show();
		});



		var currentPage=1;
		var sub_category_id=$('#SubCategoryArea .activeSub').attr('sub_category_id');
		$('.ItemBox').hide();
		$('.ItemBox[sub_category_id='+sub_category_id+'][display_no='+currentPage+']').show();
		$('#slideLeft').attr('currentPage',currentPage);
		$('#slideRight').attr('currentPage',currentPage);
		
		$('#slideLeft').die().live('click',function(event){
			var currentPage=$(this).attr('currentPage');
			currentPage--;
			$('.ItemBox').hide();
			if( $('#favStatus').val() ==1 ){
				if($('.ItemBox[fav_display_no='+currentPage+']').length==0){
					var currentPage=1;
				}
				$('.ItemBox[is_favorite=1][fav_display_no='+currentPage+']').show();
			}else{
				var sub_category_id=$('#SubCategoryArea .activeSub').attr('sub_category_id');
				if($('.ItemBox[sub_category_id='+sub_category_id+'][display_no='+currentPage+']').length==0){
					var currentPage=1;
				}
				$('.ItemBox[sub_category_id='+sub_category_id+'][display_no='+currentPage+']').show();
			}

			$('#slideLeft').attr('currentPage',currentPage);
			$('#slideRight').attr('currentPage',currentPage);			
		});

		$('#slideRight').die().live('click',function(event){
			var currentPage=$(this).attr('currentPage');
			currentPage++;
			$('.ItemBox').hide();
			if( $('#favStatus').val() ==1 ){
				if($('.ItemBox[fav_display_no='+currentPage+']').length==0){
					var currentPage=currentPage-1;
				}
				$('.ItemBox[is_favorite=1][fav_display_no='+currentPage+']').show();
			}else{
				var sub_category_id=$('#SubCategoryArea .activeSub').attr('sub_category_id');
				if($('.ItemBox[sub_category_id='+sub_category_id+'][display_no='+currentPage+']').length==0){
					var currentPage=currentPage-1;
				}
				$('.ItemBox[sub_category_id='+sub_category_id+'][display_no='+currentPage+']').show();
			}

			$('#slideLeft').attr('currentPage',currentPage);
			$('#slideRight').attr('currentPage',currentPage);			
		});


		$('.ItemCategoryBox').die().live('click',function(event){
			$('.ItemCategoryBox').removeClass('activeMain');
			$(this).addClass('activeMain');
			var category_id=$(this).attr('category_id');
			$('.ItemSubCategoryBox').hide();
			$('.ItemSubCategoryBox[category_id='+category_id+']').show();
		});

		$('.ItemSubCategoryBox').die().live('click',function(event){
			$('#favStatus').val(0);
			$('.ItemSubCategoryBox').removeClass('activeSub');
			$(this).addClass('activeSub');
			var sub_category_id=$(this).attr('sub_category_id');
			$('.ItemBox').hide();
			$('.ItemBox[sub_category_id='+sub_category_id+'][display_no=1]').show();
			$('#slideLeft').attr('currentPage',1);
			$('#slideRight').attr('currentPage',1);
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

		$('.plusOld').die().live('click',function(event){
			var qty = parseInt($(this).closest('td').find('span.qtyOld').html());
			var news = qty+parseInt(1);
			$(this).closest('td').find('span.qtyOld').html(' '+news+' ');
			amountcalsOld();
		});

		$('.minusOld').die().live('click',function(event){
			var qty = parseInt($(this).closest('td').find('span.qtyOld').html());
			if(qty !=1 ){
				var news = qty-parseInt(1);
				$(this).closest('td').find('span.qtyOld').html(' '+news+' ');
				amountcalsOld();
			}
		});

		$('.ItemBox').die().live('click',function(event){
			var item_id=$(this).attr('item_id');

			var c = $('table#kotBox tbody tr td[item_id='+item_id+']').length;
			if(c>0){
				var qt= $('table#kotBox tbody tr td[item_id='+item_id+']').closest('tr').find('td:nth-child(3) span.qty').text();

				$('table#kotBox tbody tr td[item_id='+item_id+']').closest('tr').find('td:nth-child(3) span.qty').text(' '+(++qt)+' ');
				return;
			}

			var item_name=$(this).attr('item_name');
			var rate=$(this).attr('rate');
			var c=$('#kotBox tbody tr').length;
			c=c+1;
			$('#kotBox').append('<tr row_no='+c+'><td style=text-align:center;>'+c+'</td><td item_id='+item_id+'>'+item_name+'</td><td style=text-align:center;><span class=\"minus\">-</span><span class=\"qty\"> 1 </span><span class=\"plus\">+</span></td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;><i class=\"fa fa-ellipsis-h commentRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i><textarea style=\"display:none;\" class=\"comment\"></textarea></td><td style=text-align:center;><i class=\"fa fa-trash-o removeRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i></td></tr>');
			amountcals();
		});

		$('.saveCustomersearch').die().live('click',function(event){
			//-- View Customer Info
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
		$('.ItemDropDown').select2('open');
		//$('.ItemDropDown').die().live('change',function(event){
		$(document).on('change','.ItemDropDown',function(event){
			$('.QtyCatcher').focus();
		});

		$('.QtyCatcher').keypress(function(event){
		    var keycode = (event.keyCode ? event.keyCode : event.which);
		    if(keycode == '13'){
		        var item_id=$('.ItemDropDown option:selected').val();

		        var c = $('table#kotBox tbody tr td[item_id='+item_id+']').length;
				if(c>0){
					var qt= $('table#kotBox tbody tr td[item_id='+item_id+']').closest('tr').find('td:nth-child(3) span.qty').text();

					$('table#kotBox tbody tr td[item_id='+item_id+']').closest('tr').find('td:nth-child(3) span.qty').text(' '+(++qt)+' ');
					
					$('.ItemDropDown').select2('val',''); 
					$('.ItemDropDown').select2('open');
					return;
				}


				var Qty=parseFloat($('.QtyCatcher').val());
				if(item_id && Qty){
					var item_name=$('.ItemDropDown option:selected').text();
					var rate=$('.ItemDropDown option:selected').attr('rate');
					
					var c=$('#kotBox tbody tr').length;
					c=c+1; 
					$('#kotBox').append('<tr row_no='+c+'><td style=text-align:center;>'+c+'</td><td item_id='+item_id+'>'+item_name+'</td><td style=text-align:center;><span class=\"minus\">-</span><span class=\"qty\"> '+Qty+' </span><span class=\"plus\">+</span></td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;><i class=\"fa fa-ellipsis-h commentRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i><textarea style=\"display:none;\" class=\"comment\"></textarea></td><td style=text-align:center;><i class=\"fa fa-trash-o removeRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i></td></tr>');
					amountcals();
				}

				$('.ItemDropDown').select2('val',''); 
				$('.ItemDropDown').select2('open');
		    }
		});


		$('.AddItemBtn').die().live('click',function(event){
			
			var item_id=$('.ItemDropDown option:selected').val();

			var c = $('table#kotBox tbody tr td[item_id='+item_id+']').length;
			if(c>0){
				var qt= $('table#kotBox tbody tr td[item_id='+item_id+']').closest('tr').find('td:nth-child(3) span.qty').text();

				$('table#kotBox tbody tr td[item_id='+item_id+']').closest('tr').find('td:nth-child(3) span.qty').text(' '+(++qt)+' ');
				$('.ItemDropDown').focus();
				$('.ItemDropDown').select2('val',''); 
				return;
			}


			var Qty=parseFloat($('.QtyCatcher').val());
			if(item_id && Qty){
				var item_name=$('.ItemDropDown option:selected').text();
				var rate=$('.ItemDropDown option:selected').attr('rate');
				
				var c=$('#kotBox tbody tr').length;
				c=c+1; 
				$('#kotBox').append('<tr row_no='+c+'><td style=text-align:center;>'+c+'</td><td item_id='+item_id+'>'+item_name+'</td><td style=text-align:center;><span class=\"minus\">-</span><span class=\"qty\"> '+Qty+' </span><span class=\"plus\">+</span></td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;><i class=\"fa fa-ellipsis-h commentRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i><textarea style=\"display:none;\" class=\"comment\"></textarea></td><td style=text-align:center;><i class=\"fa fa-trash-o removeRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i></td></tr>');
				amountcals();
			}

			$('.ItemDropDown').select2('val',''); 
			
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
				$('input[row_no=1][column_no=1]').focus();
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
			$('#WaitBox').hide();
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
			var qwerty=$('#qwerty').val();
			
			var c_email=$('#c_email').val();
			var c_address=$('#c_address').val();

			var offer_id=$('span.offer_id').text();
			
			var total=$('#billTable tfoot tr:nth-child(1) td:nth-child(4)').text();
			var roundOff=$('#billTable tfoot tr:nth-child(2) td:nth-child(2)').text();
			var net=$('#billTable tfoot tr:nth-child(3) td:nth-child(2)').text();
			var kot_ids=$('input[name=kot_ids]').val();
			
			var myJSON = JSON.stringify(postData);
			var url='".$this->Url->build(['controller'=>'Bills','action'=>'add'])."';
			url=url+'?myJSON='+myJSON+'&table_id='+table_id+'&total='+total+'&roundOff='+roundOff+'&net='+net+'&kot_ids='+kot_ids+'&c_name='+c_name+'&c_mobile_no='+c_mobile_no+'&dob='+dob+'&doa='+doa+'&c_email='+c_email+'&c_address='+c_address+'&c_pax='+c_pax+'&order_type='+order_type+'&employee_id='+employee_id+'&offer_id='+offer_id+'&qwerty='+qwerty;
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


		$('.commentRowOld').die().live('click',function(event){
			var c=$(this).closest('tr').find('.commentOld').val();
			$('.commentContainorOld').val(c);
			var line_no=$(this).closest('tr').attr('line_no');
			$('#rowSRold').val(line_no);
			$('#WaitBox8').show();
		});

		$('.commentRow').die().live('click',function(event){
			var c=$(this).closest('tr').find('.comment').val();
			$('.commentContainor').val(c);
			var sr_no=$(this).closest('tr').attr('row_no');
			$('#rowSR').val(sr_no);
			$('#WaitBox5').show();
		});

		$('.closeCommentBoxKOT').die().live('click',function(event){
			$('#WaitBox9').hide();
		});

		$('.closeCommentBoxOld').die().live('click',function(event){
			$('#WaitBox8').hide();
		});

		$('.closeCommentBox').die().live('click',function(event){
			$('#WaitBox5').hide();
		});

		$('.commentStringOld').die().live('click',function(event){
			var s=$(this).text();
			old_s=$('.commentContainorOld').val();
			if(old_s!=''){
				s=old_s+', '+s;
			}
			
			$('.commentContainorOld').val(s);
		});

		$('.commentStringKOT').die().live('click',function(event){
			var s=$(this).text();
			old_s=$('.commentContainorKOT').val();
			if(old_s!=''){
				s=old_s+', '+s;
			}
			
			$('.commentContainorKOT').val(s);
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
				if(c){
					$('#overallComnt').html('<span class=comnt style=\"font-size: 12px;color: #a5a5a5;\">['+c+']</span>');
				}else{
					$('#overallComnt').html('<span class=comnt style=\"font-size: 12px;color: #a5a5a5;\"></span>');
				}
				
				$('#oneComment').val(c);
				$('#WaitBox5').hide();
			}else{
				$('tr[row_no='+sr_no+']').find('.comment').val(c);
				$('tr[row_no='+sr_no+']').find('td:nth-child(2) span.comnt').remove();
				if(c){
					$('tr[row_no='+sr_no+']').find('td:nth-child(2)').append('<span class=comnt style=\"font-size: 11px;color: #a5a5a5;\"><br/>['+c+']</span>');
				}else{
					$('tr[row_no='+sr_no+']').find('td:nth-child(2)').append('<span class=comnt style=\"font-size: 11px;color: #a5a5a5;\"><br/></span>');
				}
				$('#WaitBox5').hide();
			}
			
		});

		$('.saveCommentKOT ').die().live('click',function(event){
			var c=$('.commentContainorKOT').val();
			var kot_id=$('#kot_id').val();
		
			$('.oneCommentOld_'+kot_id).html(c);
			if(c){
				$('span.comntOld_'+kot_id).text('['+c+']');
			}else{
				$('span.comntOld_'+kot_id).text('');
			}
			
			$('#WaitBox9').hide();
		});

		$('.saveCommentOld').die().live('click',function(event){
			var c=$('.commentContainorOld').val();
			var sr_no=$('#rowSRold').val();
			$('tr[line_no='+sr_no+']').find('.commentOld').html(c);
			$('tr[line_no='+sr_no+']').find('td:nth-child(2) span.comntOld').remove();
			if(c){
				$('tr[line_no='+sr_no+']').find('td:nth-child(2)').append('<span class=comntOld style=\"font-size: 11px;color: #a5a5a5;\"><br/>['+c+']</span>');
			}else{
				$('tr[line_no='+sr_no+']').find('td:nth-child(2)').append('<span class=comntOld style=\"font-size: 11px;color: #a5a5a5;\"><br/></span>');
			}
			
			$('#WaitBox8').hide();
			
		});


		$('.KOTComment').die().live('click',function(event){
			var c=$('#oneComment').val();
			$('.commentContainor').val(c);
			var sr_no=0;
			$('#rowSR').val(sr_no);
			$('#WaitBox5').show();
		});

		$('.KOTCommentOld').die().live('click',function(event){
			var kot_id = $(this).attr('kot_id');
			var c=$('.oneCommentOld_'+kot_id).val();
			$('.commentContainorKOT').val(c);
			$('#kot_id').val(kot_id);
			$('#WaitBox9').show();
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


		$('#closeWaitBox6').die().live('click',function(event){
			$('#WaitBox6').hide();
		});

		$('#AddCustomer').die().live('click',function(event){
			$('#WaitBox6').show();
		});

		$('#SaveNewCustomer').die().live('click',function(event){
			var c_name=$('#c_name').val();
			console.log(c_name);
			if(!c_name){
				alert('Enter Name');
				return;
			}

			var c_mobile_no=$('#c_mobile_no').val();
			if(!c_mobile_no){
				alert('Enter Mobile No.');
				return;
			}

			if(c_mobile_no.length!=10){
				alert('Enter Valid Mobile No.');
				return;
			}

			$('form#customerForm').submit();
		});

		$('#UpdateCustomer').die().live('click',function(event){

			$('form#customerForm').submit();
		});

		


		var table_id=$('#tableInput').val();
		if(table_id>0){
			var url='".$this->Url->build(['controller'=>'Customers','action'=>'autoFetchCustomer'])."';
			url=url+'?table_id='+table_id;
			
			$.ajax({
				url: url,
				dataType: 'json',
			}).done(function(response) {
				$('#CustomerInfo').html(response.customer_info);
			});
		}
		



		$('#closeWaitBox7').die().live('click',function(event){
			$('#WaitBox7').hide();
		});

		$('#EditCustomer').die().live('click',function(event){
			$('#WaitBox7').show();
			var table_id=$('#tableInput').val();
			var customer_id = $(this).attr('customer_id');
			var url='".$this->Url->build(['controller'=>'Customers','action'=>'fetchCustomerInfo'])."';
			url=url+'?customer_id='+customer_id+'&table_id='+table_id;
			$.ajax({
				url: url,
			}).done(function(response) {
				$('#WaitBox7 div.modal-body').html(response);
			});
		});

		$('#SaveNewCustomer').die().live('click',function(event){
			var customer_name = $('#customer-name').val();
			var customer_mobile = $('#customer-mobile').val();
			var table_id=$('#tableInput').val();

			var url='".$this->Url->build(['controller'=>'Customers','action'=>'saveNewCustomer'])."';
			url=url+'?table_id='+table_id+'&customer_name='+customer_name+'&customer_mobile='+customer_mobile;
			$.ajax({
				url: url,
			}).done(function(response) {
				if(response=='1'){
					if(table_id>0){
						var url='".$this->Url->build(['controller'=>'Customers','action'=>'autoFetchCustomer'])."';
						url=url+'?table_id='+table_id;
						$.ajax({
							url: url,
							dataType: 'json',
						}).done(function(response) {
							$('#CustomerInfo').html(response.customer_info);
							$('#customer-name').val('');
							$('#customer-mobile').val('');
						});
					}
				}
			});
		});

		$('#NewCustomer').die().live('click',function(event){
			$('#newCustomerTable').toggle();
			$('#customer-name').focus();
		});

		$('#UnlinkCustomer').die().live('click',function(event){
			var table_id=$('#tableInput').val();
			var url='".$this->Url->build(['controller'=>'Customers','action'=>'unlinkCustomer'])."';
			url=url+'?table_id='+table_id;
			$.ajax({
				url: url,
			}).done(function(response) {
				if(response=='1'){
					$('#CustomerInfo').html('');
				}
			});
		});

		$('#LinkCustomer').die().live('click',function(event){
			var table_id=$('#tableInput').val();
			var customer_id = $('#customer-id').find('option:selected').val();
			var url='".$this->Url->build(['controller'=>'Tables','action'=>'linkCustomer'])."';
			url=url+'?table_id='+table_id+'&customer_id='+customer_id;
			$.ajax({
				url: url,
			}).done(function(response) {
				$('#CustomerInfo').html('<br/><div align=center>Fatching...</div>');
				if(table_id>0){
					var url='".$this->Url->build(['controller'=>'Customers','action'=>'autoFetchCustomer'])."';
					url=url+'?table_id='+table_id;
					
					$.ajax({
						url: url,
						dataType: 'json',
					}).done(function(response) {
						$('#CustomerInfo').html(response.customer_info);
					});
				}
			});
		});

		$('#FetchCustomer').die().live('click',function(event){
			var mobile=$('#MobileBox').val();
			var code=$('#CodeBox').val();
			if(mobile=='' && code==''){
				return;
			}

			$('#CustomerInfo').html('<br/><div align=center>Fatching...</div>');

			var table_id=$('#tableInput').val();
			var url='".$this->Url->build(['controller'=>'Customers','action'=>'fetchCustomer'])."';
			url=url+'?mobile='+mobile+'&code='+code+'&table_id='+table_id;
			
			$.ajax({
				url: url,
				dataType: 'json',
			}).done(function(response) {
				if(response.linked=='yes'){
					$('#CustomerInfo').html(response.customer_info);
				}else{
					$('#WaitBox6').show();
					$('#CustomerInfo').html('');
					$('#c_mobile_no').val(mobile);
				}
				$('#MobileBox').val('');
				$('#CodeBox').val('');
			});
		});

		$('.saveReprint ').die().live('click',function(event){
			var kot_id = $(this).attr('kot_id');

			var postData=[];
			$('table[kot_id='+kot_id+'] tbody tr').each(function(){
				var kot_row_id=$(this).find('td:nth-child(1)').attr('kot_row_id');
				var item_id=$(this).find('td:nth-child(2)').attr('item_id');
				var quantity=$(this).find('td:nth-child(3) span.qtyOld').text();
				var rate=$(this).find('td:nth-child(4)').text();
				var amount=$(this).find('td:nth-child(5)').text();
				var comment=$(this).find('td:nth-child(6) textarea.commentOld').val();
				
				postData.push({kot_row_id : kot_row_id, item_id : item_id, quantity : quantity, rate : rate, amount : amount, comment : comment}); 
			});
			var myJSON = JSON.stringify(postData);
			
			var overallComment = $('textarea.oneCommentOld_'+kot_id).val();

			var url='".$this->Url->build(['controller'=>'Kots','action'=>'updateKot'])."';
			url=url+'?myJSON='+myJSON+'&overallComment='+overallComment+'&kot_id='+kot_id;
			url=encodeURI(url);
			console.log(url);
			$.ajax({
				url: url,
			}).done(function(response) {
				if(response==1){
					var url='".$this->Url->build(['controller'=>'kots','action'=>'viewkot'])."';
					url=url+'/'+kot_id;
					var win = window.open(url, '_blank');
					win.focus();

					location.reload();
				}
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

	function amountcalsOld(){
		$('#kotTable tbody tr').each(function(){
			var quantity=parseInt($(this).find('td span.qtyOld').html());
			var rate=parseInt($(this).find('td:nth-child(4)').text());
			var tot_amount=quantity*rate;
			$(this).find('td:nth-child(5)').text(tot_amount);
		});
	}	
	";



$js.="
	$(document).keydown(function(e) {
	    switch(e.which) {
	        case 37: // left
	       	var focused = $(':focus');
			var row_no=focused.attr('row_no');
			var column_no=focused.attr('column_no');
			column_no--;
			$('input[row_no='+row_no+'][column_no='+column_no+']').focus();
			break;

			case 39: // right
	       	var focused = $(':focus');
			var row_no=focused.attr('row_no');
			var column_no=focused.attr('column_no');
			column_no++;
			$('input[row_no='+row_no+'][column_no='+column_no+']').focus();
			break;

			case 40: // down
			var focused = $(':focus');
			var row_no=focused.attr('row_no');
			var column_no=focused.attr('column_no');
			row_no++;
			$('input[row_no='+row_no+'][column_no='+column_no+']').focus();
			break;

			case 38: // up
			var focused = $(':focus');
			var row_no=focused.attr('row_no');
			var column_no=focused.attr('column_no');
			row_no--;
			$('input[row_no='+row_no+'][column_no='+column_no+']').focus();
			break;
	       

	        default: return; // exit this handler for other keys
	    }
	    e.preventDefault(); // prevent the default action (scroll / move caret)
	});
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


<div id="WaitBox6" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<form method="post" id="customerForm">
					<input type="hidden" name="table_id" value="<?php echo $table_id; ?> ">
					<div align="center"><span style=" color: #2D4161; font-weight: bold; font-size: 14px; ">CUSTOMER INFORMATION</span></div>
					<div>
						<div style="padding: 5px 25px; ">
							<br>
							<table width="100%">
								<tr>
									<td style="padding-right: 5px;">
										<div class="input-icon">
											<i class="fa fa-user"></i>
											<input type="text" class="form-control" placeholder="Name" style="background-color: #f5f5f5 !important" name="c_name" id="c_name" value="" required="required">
										</div><br>
									</td>
									<td style="padding-right: 5px;">
										<div class="input-icon">
											<i class="fa fa-mobile" style="font-size: 20px;"></i>
											<input type="text" class="form-control" placeholder="Mobile" style="background-color: #f5f5f5 !important" name="c_mobile_no" id="c_mobile_no" value="" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required" minlength="10">
										</div><br>
									</td>
								</tr>
								<tr>
									<td style="padding-right: 5px;">
										<div class="input-icon">
											Date of Birth<i class="fa fa-child"></i>
											<input type="date" class="form-control" placeholder="Date of Birth" style="background-color: #f5f5f5 !important" name="dob" id="dob" value="">
										</div>
									</td>
									<td style="padding-left: 5px;">
										<div class="input-icon">
											Date of Anniversary<i class="fa fa-empire"></i>
											<input type="date" class="form-control" placeholder="Date of Anniversary" style="background-color: #f5f5f5 !important" name="doa" id="doa" value="">
										</div>
									</td>
								</tr>
							</table>
							<br>
							<div class="input-icon">
								<i class="fa fa-envelope-square" style="font-size: 20px;"></i>
								<input type="text" class="form-control" placeholder="Email" style="background-color: #f5f5f5 !important" name="c_email" id="c_email" value="">
							</div>
							<br>
							<textarea rows="4" cols="50" placeholder="Address..." name="c_address" id="c_address" style="line-height: 20px; background: whitesmoke;resize: none;" class="form-control"></textarea>
						</div>
						<br/>
						<div align="center">
							<button type="button" class="btn " id="closeWaitBox6">CLOSE</button>
							<button type="button" class="btn btn-danger" id="SaveNewCustomer">SAVE</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<div id="WaitBox7" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div align="center">Loading...</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="favStatus" value="0">

<div id="WaitBox8" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<input type="hidden" id="rowSRold">
				<div style=" text-align: center; padding: 0px 0 15px 0px; font-size: 15px; font-weight: bold; color: #2D4161; ">COMMENT BOX</div>
				<br/>
				<div class="form-group">
					<textarea class="form-control commentContainorOld" rows="3" style="background-color: #F5F5F5;"></textarea>
				</div>
				<br/>
				<div>
					<label style=" color: #2D4161; font-weight: bold; font-size: 14px; ">Predefined Comments</label>
					<div>
						<?php foreach ($Comments as $Comment) { ?>
							<span class="commentStringOld"><?php echo $Comment; ?></span>
						<?php } ?>
					</div>
				</div>
				<br/><br/>
				<div align="center">
					<a href="javascript:void(0)" class="closeCommentBoxOld btn default">CLOSE</a>
					<a href="javascript:void(0)" class="saveCommentOld btn btn-danger">SAVE COMMENT</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="WaitBox9" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<input type="hidden" id="kot_id">
				<div style=" text-align: center; padding: 0px 0 15px 0px; font-size: 15px; font-weight: bold; color: #2D4161; ">COMMENT BOX</div>
				<br/>
				<div class="form-group">
					<textarea class="form-control commentContainorKOT" rows="3" style="background-color: #F5F5F5;"></textarea>
				</div>
				<br/>
				<div>
					<label style=" color: #2D4161; font-weight: bold; font-size: 14px; ">Predefined Comments</label>
					<div>
						<?php foreach ($Comments as $Comment) { ?>
							<span class="commentStringKOT"><?php echo $Comment; ?></span>
						<?php } ?>
					</div>
				</div>
				<br/><br/>
				<div align="center">
					<a href="javascript:void(0)" class="closeCommentBoxKOT btn default">CLOSE</a>
					<a href="javascript:void(0)" class="saveCommentKOT btn btn-danger">SAVE COMMENT</a>
				</div>
			</div>
		</div>
	</div>
</div>