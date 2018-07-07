<style>
.createCustomer{
	color: #FFF; background-color: #FA6775; padding: 7px 14px;font-size:12px;cursor: pointer;margin-left: 2px;
}
.closeCustomerBox{
	color: #000; background-color: #E6E7E8; padding: 7px 14px;font-size:12px;cursor: pointer;margin-right: 2px; 
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
.searchCustomer{
	color: #FFF; background-color: #FA6775; padding: 10px 18px;font-size:12px;cursor: pointer;margin-bottom: 2px;
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
	color: #FFF; background-color: #2D4161; padding: 7px 14px;cursor: pointer;margin-right: 8px;font-size:12px;
}
.topBtnActive{
	color: #FFF; border-radius: 5px !important; background-color: #FA6775; padding: 7px 18px;margin-left: 8px;
}
.topBtn{
	color: #818182; border-radius: 5px !important; background-color: #FFF; padding: 7px 18px;border:solid 1px #f0f0f0;margin-left: 8px;
}
.topBtn2{
	color: #818182; border-radius: 5px !important; background-color: #F5F5F5; padding: 7px 18px;border:solid 1px #f0f0f0;margin-left: 8px;
}
</style>
<?php $colors=['#1AB696', '#999DAB', '#F3CC6F', '#FA6E58', '#334D8F', '#C8A66A', '#A4BF5B', '#31A8B8', '#91AAC7', '#F24A4A']; ?>
<div class="row" style="background: #FEFEFE;padding: 15px;">
	<div class="col-md-6" >
		<span id="BackToTables" style="display:none;font-weight: bold;" ><i class="fa fa-arrow-left"></i></span>
		<span class="topBtnActive">Dinner In</span>
		<span class="topBtn">Delivery</span>
		<span class="topBtn">Take Away</span>
	</div>
	<div class="col-md-6" align="right">
		<span class="topBtn2">Booking</span>
		<span class="topBtn2">Bills</span>
		<span style="color: #96989A;font-size: 15px;margin-left: 8px;">Day Sale</span>
		<span style="color: #2FBD9F;font-size: 15px;margin-left: 8px;">₹5000</span>
	</div>
</div>
<div style="background: #EBEEF3;">
	<input type="hidden"  id="tableInput" />
	<div class="row TableView" style="padding:10px;">
		<div style=" margin-bottom: 10px; text-align: center; margin-top: 10px; "><span id="TablesHeading" style="font-weight: bold;color:#373435;" > TABLES </span></div>
		<div class="col-md-12"  align="center">
			<?php 
			$i=0;
			foreach($Tables as $Table){ ?>
			<div class="tblBox" table_id="<?= h($Table->id) ?>" table_name="<?= h($Table->name) ?>">
				<span class="tblLabel" style="background-color:<?php echo $colors[$i++]; ?>" ><?= h($Table->name) ?></span>
				<div style="font-size:14px;">
					<div align="center">
						<span style="font-size: 14px; color: #3b393a;">Steward Name</span>
						<span style="font-size: 14px;color: #BDBFC1;float:  right;"><i class="fa fa-ellipsis-v"></i></span>
					</div>
					<div style="padding:2px 10px;">
						<table width="100%" style="font-size:12px;line-height: 22px;">
							<tr>
								<td valign="top">
									<span style="color:#96989A;">Time</span>
									<span style="color:#373435;margin-left:13px;">15 min</span>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<span style="color:#96989A;">Customer Name</span>
									<span style="color:#373435;margin-left:13px;">Rahul Soni</span>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<span style="color:#96989A;">Pax Per Rate</span>
									<span style="color:#373435;margin-left:13px;">₹50</span>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<span style="color:#96989A;">Running Billing Amount</span>
									<span style="color:#373435;margin-left:13px;">₹450</span>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<?php 
			if($i==10){ $i=0; }
			} ?>
		</div>
	</div>
	<div class="row KOTView" style="display: none;padding:20px 10px;">
		<div class="col-md-12">
			<table width="100%">
				<tr>
					<td valign="top" width="50%" style=" padding: 0px 15px; ">
						<div style=" background-color: #FFF; border-radius: 8px !important; padding: 10px;">
							<table width="100%">
								<tr>
									<td id="ItemArea" style="padding:10px;padding-bottom: 5px; border-bottom: solid 1px #CCC;height: 300px;" valign="top">
										
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
											<div class="ItemBox" sub_category_id="<?= h($item_sub_category->id) ?>" item_id="<?= h($item->id) ?>" item_name="<?= h($item->name) ?>" rate="<?= h($item->rate) ?>" >
												<?= h($item->name) ?>
											</div>
										<?php } ?>
										</div>
									<?php } ?>
									</div>
									
								<?php } ?>
							</div>
						</div>
					</td>
					<td valign="top" width="50%" style=" padding: 0px 15px; ">
						<div style=" background-color: #FFF; border-radius: 8px !important; padding: 0px 15px;">
							<div style="padding-top:12px">
								<table width="100%">
									<tr>
										<td width="70%" style="padding:0 10px 0 0;">
											<?php
											foreach($Items as $Item){
												$options[]=['text' =>$Item->name, 'value' => $Item->id, 'rate' => $Item->rate];
											}
											
											echo $this->Form->input('item_sub_category_id',['options' =>$options,'label' => false,'class'=>'form-control select2me ItemDropDown','empty'=> 'Search Item']);?>
										</td>
										<td width="20%" style="padding:0 10px 0 0;">
											<input type="text" class="form-control QtyCatcher" placeholder="Quantity">
										</td>
										<td width="10%" >
											<span class="AddItemBtn">ADD</span>
										</td>
									</tr>
								</table>
							</div>
							<div style="padding-top:12px">
								<table class="table" id="kotBox">
									<thead>
										<tr>
											<th style="text-align:center;">S.No.</th>
											<th>Name</th>
											<th style="text-align:center;">Quantity</th>
											<th style="text-align:center;">Rate</th>
											<th style="text-align:center;">Amount</th>
											<th style="text-align:center;">Comment</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									
									</tbody>
								</table>
							</div>
							<div style="padding-top:12px" align="center">
								<span class="KOTComment" >KOT COMMENT</span>
								<span class="CreateKOT" >CREATE KOT </span>
							</div>
							<br/><br/>
							<div style="padding-top:12px" align="right">
								<span class="CreateBill" >GENERATE BILL </span>
								<span class="ViewAllKOT" >VIEW ALL KOT</span>
							</div>
							<br/><br/>
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
	$successMessage='<div align=center><br/><span aria-hidden=true class=icon-check style="font-size:50px;color: #096609; font-weight: bold;"></span><br/><span style="font-size: 18px; color: #096609; font-weight: bold;">KOT Created</span><div><span class="closePopup">Close</span></div></div>';
	$BillSuccessMessage='<div align=center><br/><span aria-hidden=true class=icon-check style="font-size:50px;color: #096609; font-weight: bold;"></span><br/><span style="font-size: 18px; color: #096609; font-weight: bold;">Bill Created</span><div><button type="button" class="btn btn-primary closePopup">Close</button></div></div>';
	$errorMessage='<div align=center><br/><span aria-hidden=true class=icon-close style="font-size:50px;color: #ae0808; font-weight: bold;"></span><br/><span style="font-size: 18px; color: #ae0808; font-weight: bold;">Something went wrong.</span><div><button type="button" class="btn btn-primary closePopup">Close</button></div></div>';
	
	$js="
	$(document).ready(function() {
		$('#BackToTables').die().live('click',function(event){
			$('.TableView').show().addClass('animated fadeIn');
			$('#BackToTables').hide();
			$('#TablesHeading').show();
			$('#KOTHeading').hide();
			$('.KOTView').removeClass('animated fadeIn').hide();
		});
		
		$('.tblBox').die().live('click',function(event){
			var table_id=$(this).attr('table_id');
			var table_name=$(this).attr('table_name');
			$('.TableView').hide();
			$('#BackToTables').show();
			$('#TablesHeading').hide();
			$('#KOTHeading').show();
			$('.KOTView').show().addClass('animated fadeIn');
			$('#tableInput').val(table_id);
			$('#tableOutput').text(table_name);
		});
		
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
		
		
		$('.ItemBox').die().live('click',function(event){
			var item_id=$(this).attr('item_id');
			var item_name=$(this).attr('item_name');
			var rate=$(this).attr('rate');
			var c=$('#kotBox tbody tr').length;
			c=c+1;
			$('#kotBox').append('<tr><td style=text-align:center;>'+c+'.</td><td item_id='+item_id+'>'+item_name+'</td><td style=text-align:center;><span>1</span></td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;><i class=\"fa fa-ellipsis-h commentRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i></td><td style=text-align:center;><i class=\"fa fa-trash-o removeRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i></td></tr>');
		});
		
		$('.commentRow').die().live('click',function(event){
		
		});
		
		$('.AddItemBtn').die().live('click',function(event){
			var item_id=$('.ItemDropDown option:selected').val();
			var Qty=parseFloat($('.QtyCatcher').val());
			if(item_id && Qty){
				var item_name=$('.ItemDropDown option:selected').text();
				var rate=$('.ItemDropDown option:selected').attr('rate');
				
				var c=$('#kotBox tbody tr').length;
				c=c+1;
				$('#kotBox').append('<tr><td style=text-align:center;>'+c+'.</td><td item_id='+item_id+'>'+item_name+'</td><td style=text-align:center;><span>'+Qty+'</span></td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;>'+rate+'</td><td style=text-align:center;><i class=\"fa fa-ellipsis-h commentRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i></td><td style=text-align:center;><i class=\"fa fa-trash-o removeRow\" style=\"color: #BDBFC1; font-size: 18px; cursor: pointer;\"></i></td></tr>');
			}
			
		});
		
		$('.removeRow').die().live('click',function(event){
			$(this).closest('tr').remove();
			var c=0;
			$('#kotBox tbody tr').each(function(){
				var item_id=$(this).find('td:nth-child(1)').text(++c);
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
				var quantity=$(this).find('td:nth-child(3)').text();
				var rate=$(this).find('td:nth-child(4)').text();
				var amount=$(this).find('td:nth-child(5)').text();
				postData.push({item_id : item_id, quantity : quantity, rate : rate, amount : amount}); 
			});
			var table_id=$('#tableInput').val();
			var myJSON = JSON.stringify(postData);
			var url='".$this->Url->build(['controller'=>'Kots','action'=>'add'])."';
			url=url+'?myJSON='+myJSON+'&table_id='+table_id;
			$.ajax({
				url: url,
			}).done(function(response) {
				if(response=='1'){
					$('#kotBox tbody tr').remove();
					$('#WaitBox div.modal-body').html('".$successMessage."');
				}else{
					$('#WaitBox div.modal-body').html('".$errorMessage."');
				}
				
			});
		});
		
		$('.closeViewKot').die().live('click',function(event){
			$('#WaitBox3').hide();
		});

		$('.ViewAllKOT').die().live('click',function(event){
			event.preventDefault();
			var table_id=$('#tableInput').val();
			$('#WaitBox3').show();
			$('#WaitBox3 div.modal-body').html('".$waitingMessage2."');
			var url='".$this->Url->build(['controller'=>'Kots','action'=>'index'])."';
			url=url+'?table_id='+table_id;
			$.ajax({
				url: url,
			}).done(function(response) {
				$('#WaitBox3 div.modal-body').html(response);
			});
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
		
		$('.CancelBill').die().live('click',function(event){
			event.preventDefault();
			$('#WaitBox3').hide();
		});
		
		$('.SubmitBill').die().live('click',function(event){
			event.preventDefault();
			$('#WaitBox2').show();
			$('#WaitBox2 div.modal-body').html('".$waitingMessage."');
			var postData=[];
			$('#billTable tbody tr').each(function(){
				var item_id=$(this).find('td:nth-child(2)').attr('item_id');
				var quantity=$(this).find('td:nth-child(3)').text();
				var rate=$(this).find('td:nth-child(4)').text();
				var amount=$(this).find('td:nth-child(5)').text();
				var discount_per=$(this).find('td:nth-child(6) input').val();
				var net_amount=$(this).find('td:nth-child(7)').text();
				postData.push({item_id : item_id, quantity : quantity, rate : rate, amount : amount, discount_per : discount_per, net_amount : net_amount}); 
			});
			var table_id=$('#tableInput').val();
			var customer_id=$('input[name=customer_id]').val();
			
			var total=$('#billTable tfoot tr:nth-child(1) td:nth-child(2)').text();
			var tax_id=$('#billTable tfoot tr:nth-child(2) td:nth-child(2) select option:selected').attr('tax_id');
			var roundOff=$('#billTable tfoot tr:nth-child(3) td:nth-child(2)').text();
			var net=$('#billTable tfoot tr:nth-child(4) td:nth-child(2)').text();
			var kot_ids=$('input[name=kot_ids]').val();
			
			var myJSON = JSON.stringify(postData);
			var url='".$this->Url->build(['controller'=>'Bills','action'=>'add'])."';
			url=url+'?myJSON='+myJSON+'&table_id='+table_id+'&total='+total+'&tax_id='+tax_id+'&roundOff='+roundOff+'&net='+net+'&kot_ids='+kot_ids+'&customer_id='+customer_id;
			$.ajax({
				url: url,
			}).done(function(bill_id) {
				if(bill_id!=0){
					$('#WaitBox3').hide();
					$('#WaitBox2').hide();
					
					var url='".$this->Url->build(['controller'=>'Bills','action'=>'view'])."';
					url=url+'?bill_id='+bill_id;
					var w = window.open(url, 'popupWindow', 'scrollbars=yes');
				}else{
					$('#WaitBox3 div.modal-body').html('".$errorMessage."');
				}
				
			});
		});
		
		$('.disBox').die().live('keyup',function(event){
			calculateBill();
		});
		
		function calculateBill(){
			var total=0;
			$('#billTable tbody tr').each(function(){
				var quantity=parseFloat($(this).find('td:nth-child(3)').text());
				var rate=parseFloat($(this).find('td:nth-child(4)').text());
				var amount=parseFloat($(this).find('td:nth-child(5)').text());
				var discount_per=parseFloat($(this).find('td:nth-child(6) input').val());
				if(!discount_per){ discount_per=0; }
				var net_amount=round(amount*(100-discount_per)/100,2);
				$(this).find('td:nth-child(7)').text(net_amount);
				total=total+net_amount;
			});
			total=round(total,2);
			$('#billTable tfoot tr:nth-child(1) td:nth-child(2)').text(total);
			var tax=$('#billTable tfoot tr:nth-child(2) td:nth-child(2) select option:selected').val();
			var totalAfterTax=total-round(total*tax/100,2);
			var totalAfterTaxRound=round(totalAfterTax,0);
			var roundOff=round(totalAfterTaxRound-totalAfterTax,2);
			$('#billTable tfoot tr:nth-child(3) td:nth-child(2)').text(roundOff);
			$('#billTable tfoot tr:nth-child(4) td:nth-child(2)').text(totalAfterTaxRound);
		}

		$('.accordion-toggle').die().live('click',function(event){
			$('div.panel-heading').css('background-color','#E6E7E8');
			$('div.panel-heading').find('a.accordion-toggle').css('color','#474445');
			$('div.panel-heading').find('span.iconBox').html('<i class=\"fa fa-plus\"></i>').css('color','#474445');
			$(this).closest('div.panel-heading').css('background-color','#2D4161');
			$(this).closest('div.panel-heading').find('a.accordion-toggle').css('color','#FFF');
			$(this).closest('div.panel-heading').find('span.iconBox').html('<i class=\"fa fa-minus\"></i>').css('color','#FFF');
		});

		$('.searchCustomer').die().live('click',function(event){
			var mobile_no=$('input[name=mobile_no]').val();
			if(mobile_no.length!=10){
				alert('Mobile No should be of 10 digits.');
				return;
			}
			var url='".$this->Url->build(['controller'=>'Customers','action'=>'check-customer'])."';
			url=url+'?mobile_no='+mobile_no;
			$.ajax({
				url: url,
			}).done(function(response) {
				if(response=='0'){
					$('#WaitBox4').show();
					$('#WaitBox4 div.modal-body').html('".$waitingMessage2."');
					var url='".$this->Url->build(['controller'=>'Customers','action'=>'add'])."';
					url=url+'?mobile_no='+mobile_no;
					$.ajax({
						url: url,
					}).done(function(response) {
						$('#WaitBox4 div.modal-body').html(response);
					});
				}else{
					var url='".$this->Url->build(['controller'=>'Customers','action'=>'view'])."';
					url=url+'?c_id='+response;
					$.ajax({
						url: url,
					}).done(function(response) {
						$('#customerView').html(response);
					});
				}
				
			});
		});

		$('.closeCustomerBox').die().live('click',function(event){
			$('#WaitBox4').hide();
		});

		$('.createCustomer').die().live('click',function(event){

			var ths=$(this);
			
			var c_name=$('input[name=c_name]').val();
			if(c_name.length==0){
				alert('Enter customer name.');
				return;
			}
			var c_mobile_no=$('input[name=c_mobile_no]').val();
			var c_address=encodeURI($('textarea[name=c_address]').val());
			$(this).html('<i class=\"fa fa-refresh fa-spin\"></i> Loading');
			var url='".$this->Url->build(['controller'=>'Customers','action'=>'saveCustomer'])."';
			url=url+'?c_name='+c_name+'&c_mobile_no='+c_mobile_no+'&c_address='+c_address;
			$.ajax({
				url: url,
			}).done(function(response) {
				$('#WaitBox4').hide();
				$('input[name=mobile_no]').val('');
				var url='".$this->Url->build(['controller'=>'Customers','action'=>'view'])."';
				url=url+'?c_id='+response;
				$.ajax({
					url: url,
				}).done(function(response) {
					$('#customerView').html(response);
				});
			});
		});

		$('input[name=mobile_no]').die().live('keydown',function(e){
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
	            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
	            (e.keyCode >= 35 && e.keyCode <= 40)) {
	                 return;
	        }
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }	
		});		

		
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
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog modal-lg">
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