
<style>
.saveCustomersearch{
	color: #FFF; background-color: #FA6775; padding: 9px 11px;font-size:12px;cursor: pointer;
}
.saveCustomer{
	color: #FFF; background-color: #FA6775; padding: 7px 14px;font-size:12px;cursor: pointer;margin-left: 2px;
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
.EmptyTbl{
	color: #FFF; background-color: #4FC777; padding: 7px 14px;font-size:12px;cursor: pointer;margin-left: 2px;
}
.EmptyTbl:hover{
	cursor: pointer;
}
</style>
<?php $colors=['#1AB696', '#999DAB', '#F3CC6F', '#FA6E58', '#334D8F', '#C8A66A', '#A4BF5B', '#31A8B8', '#91AAC7', '#F24A4A']; ?>
<?= $this->element('header'); ?>

<div style="background: #EBEEF3;">
	<input type="hidden"  id="tableInput" />
	<div class="row TableView" style="padding:10px;">
		<div style=" margin-bottom: 10px; text-align: center; margin-top: 10px; "><span id="TablesHeading" style="font-weight: bold;color:#373435;" > TABLES </span></div>
		<div class="col-md-12"  align="center">
			<?php 
			$i=0;
			foreach($Tables as $Table){ 
				$sum=0;
				$RatePerPax=0;
				if(array_key_exists($Table->id, $tableWiseAmount)){
					foreach($tableWiseAmount[$Table->id] as $item) {
				 		$sum += $item;
					}
				}
				if($sum>0){
					$RatePerPax=$sum/$Table->no_of_pax;
				}
				
				 
			?>
			<div class="tblBox <?php if($coreVariable['role']=='steward' && $Table->status=='occupied'){ echo 'goToKot'; } ?>" table_id="<?= h($Table->id) ?>" table_name="<?= h($Table->name) ?>">
				<span class="tblLabel" style="background-color:<?php echo $colors[$i++]; ?>" ><?= h($Table->name) ?></span>
				<?php if($Table->status=='occupied'){ ?>
					<div style="font-size:14px;">
						<div align="center">
							<span style="font-size: 14px; color: #3b393a;" class="steward">Select Steward</span>
						</div>
						<div style="padding:2px 10px;">
							<table width="100%" style="font-size:12px;line-height: 22px;">
								<tr>
									<td valign="top">
										<span style="color:#96989A;">Time</span>
										<span style="color:#373435;margin-left:13px;" id="timeLabel_<?php echo $Table->id; ?>" ></span>
									</td>
								</tr>
								<tr>
									<td valign="top">
										<span style="color:#96989A;">Customer Name</span>
										<span style="color:#373435;margin-left:13px;"><?php echo @ucwords($Table->c_name); ?> </span>
									</td>
								</tr>
								<tr>
									<td valign="top">
										<span style="color:#96989A;">No. of Pax</span>
										<span style="color:#373435;margin-left:13px;"><?php echo $Table->no_of_pax; ?></span>
									</td>
								</tr>
								<tr>
									<td valign="top">
										<span style="color:#96989A;">Pax Per Rate</span>
										<span style="color:#373435;margin-left:13px;"><?php if($sum>0){  echo round($RatePerPax,2); } ?></span>
									</td>
								</tr>
								<tr>
									<td valign="top">
										<span style="color:#96989A;">Running Billing Amount</span>
										<span style="color:#373435;margin-left:13px;"><?php if($sum>0){ echo $sum; } ?></span>
									</td>
								</tr>
								<tr>
									<td valign="Bottom" style="text-align: center;">
										<a style="color:#fa6775;" class="customer_info" table_id="<?php echo $Table->id; ?>" >Customer Info.</a>
										<span style=" margin: 0 10px;color:#96989A; ">|</span>
										<?= $this->Html->link(__('Create KOT'), ['controller' => 'Kots', 'action' => 'generate', $Table->id,'dinner'], ['style' => 'color:#fa6775;','class'=>'showLoader']) ?>
									</td>
								</tr>
							</table>
						</div>
					</div>
				<?php }else{ ?>
					<div style="font-size:14px;">
						<div align="center">
							<span style="font-size: 14px; color: #3b393a;">.</span>
						</div>
						<div style="padding:2px 10px;">
							<table width="100%" style="font-size:12px;line-height: 22px;">
								<tr>
									<td valign="top">
										<div align="center" >
											<?php echo $this->Html->image('/table-icon.png', ['alt' => 'Empty Table']); ?>
											<br/>
											<span class="EmptyTbl" table_id="<?= h($Table->id) ?>" table_name="<?= h($Table->name) ?>">Available Now</span>
											<div style="height: 60px;"></div>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php 
			if($i==10){ $i=0; }
			} ?>
		</div>
	</div>
</div>


<style>
.goToKot:hover{
	cursor: pointer;
}
.EmptyTbl{
	color: #FFF; background-color: #4FC777; padding: 7px 14px;font-size:12px;cursor: pointer;margin-left: 2px;
}
.EmptyTbl:hover{
	cursor: pointer;
}
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

#TablesHeading{
	color: #f16969;
	font-size: 16px;
}
.registerCustomer{
	color: #FFF; background-color: #FA6775; padding: 7px 14px;font-size:12px;cursor: pointer;margin-left: 2px;
}
.closeCustomerBox{
	color: #000; background-color: #E6E7E8; padding: 7px 14px;font-size:12px;cursor: pointer;margin-right: 2px; 
}
.closeCustomerBox2{
	color: #000; background-color: #E6E7E8; padding: 7px 14px;font-size:12px;cursor: pointer;margin-right: 2px; 
}
.steward:hover{
	cursor: pointer;color: #FA6775 !important;
}
.CloseSteward{
	color: #000; background-color: #E6E7E8; padding: 7px 14px;font-size:12px;cursor: pointer;margin-right: 2px; 
}
</style>


<?php echo $this->Html->css('/assets/animate.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
<?php
$waitingMessage='<div align=center><br/><i class="fa fa-gear fa-spin" style="font-size:50px"></i><br/><span style="font-size: 18px; font-weight: bold;">Loading...</span></div>';
$js="
$(document).ready(function() {
	$('.EmptyTbl').die().live('click',function(event){
		var table_id=$(this).attr('table_id');
		var table_name=$(this).attr('table_name');
		$('span#tableLabel').html(table_name);
		$('input[name=table_id]').val(table_id);
		$('#customerRegistrationBox').show();
	});

	$('.closeCustomerBox').die().live('click',function(event){
		$('#customerRegistrationBox').hide();
	});
	$('.CloseSteward').die().live('click',function(event){
		$('#WaitBox3').hide();
	});

	$('.registerCustomer').die().live('click',function(event){
		$('#loading').show();
		var table_id=$('input[name=table_id]').val();
		var c_name=$('input[name=c_name]').val();
		var c_mobile=$('input[name=c_mobile]').val();
		var c_pax=$('select[name=c_pax] option:selected').val();
		
		var url='".$this->Url->build(['controller'=>'Tables','action'=>'save-table'])."';
		url=url+'?c_name='+c_name+'&c_mobile='+c_mobile+'&c_pax='+c_pax+'&table_id='+table_id;
		$.ajax({
			url: url,
		}).done(function(response) {
			if(response==1){
				$('#customerRegistrationBox').hide();
				location.reload();
			}else{
				$('#loading').hide();
				alert('!! Something went wrong. Customer not registered.');
				return;
			}               
		});
	});

	$('input[name=c_mobile]').die().live('keydown',function(e){
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
			(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
			(e.keyCode >= 35 && e.keyCode <= 40)) {
				 return;
		}
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}   
	}); 

   
	$('.goToKot').die().live('click',function(event){
		var table_id=$(this).attr('table_id');
		var table_name=$(this).attr('table_name');
		var url='".$this->Url->build(['controller'=>'Kots','action'=>'new'])."';
		url=url+'/'+table_id;
		window.location.href = url;
	}); 


	$('.customer_info').die().live('click',function(event){
		$('#WaitBox2').show();
		$('#WaitBox2 div.modal-body').html('".$waitingMessage."');

		var table_id=$(this).attr('table_id');
		var url='".$this->Url->build(['controller'=>'Tables','action'=>'customer'])."';
		url=url+'/'+table_id;
		$.ajax({
			url: url,
		}).done(function(response) {
			$('#WaitBox2 div.modal-body').html(response);
		});
	});


	$('.closeCustomerBox2').die().live('click',function(event){
		$('#WaitBox2').hide();
	});

	$('.saveCustomer').die().live('click',function(event){
		$(this).text('Updating...');
		var c_table_id=$('#c_table_id').val();
		var c_name=$('#c_name').val();
		var c_mobile_no=$('#c_mobile_no').val();
		var c_pax=$('#c_pax').val();
		var dob=$('#dob').val();
		var doa=$('#doa').val();
		var c_email=$('#c_email').val();
		var c_address=$('#c_address').val();
		var url='".$this->Url->build(['controller'=>'Tables','action'=>'saveCustomer'])."';
		url=url+'?c_name='+c_name+'&c_mobile_no='+c_mobile_no+'&dob='+dob+'&doa='+doa+'&c_email='+c_email+'&c_address='+c_address+'&c_pax='+c_pax+'&table_id='+c_table_id;
		url=encodeURI(url);
		$.ajax({
			url: url,
		}).done(function(response) {
			if(response=='1'){
				$('#WaitBox2').hide();
			}else{
				alert('Not saved. Something went wrong.');
			}
		});
	});

	$('.steward').die().live('click',function(event){
		var table_id=$(this).closest('div.tblBox').attr('table_id');
		$('#steward_table_id').val(table_id);
		$('#WaitBox3').show();
	});

	$('.employee_id').die().live('change',function(event){
		var steward_name=$(this).find('option:selected').text();
		var steward_id=$(this).find('option:selected').val();
		var table_id=$('#steward_table_id').val();
		$('div.tblBox[table_id='+table_id+']').find('.steward').text(steward_name);
		$(this).val('');
		$('#WaitBox3').hide();
		var url='".$this->Url->build(['controller'=>'Tables','action'=>'saveSteward'])."';
		url=url+'?table_id='+table_id+'&steward_id='+steward_id;
		url=encodeURI(url);
		$.ajax({
			url: url,
		}).done(function(response) {
			
		});
	});

	$('.searchcustomber').die().live('click',function(event){
		var search_code = $('#search_code').val();
		var search_mobile = $('#search_mobile').val();
		if(search_mobile.length==0){search_mobile=0;}
		if(search_code.length==0){search_code=0;}
		$('#WaitBox2 div.modal-body').html('".$waitingMessage."');
		var table_id=$(this).attr('table_id');
		var url='".$this->Url->build(['controller'=>'Tables','action'=>'customer'])."';
		url=url+'/'+table_id+'/'+search_code+'/'+search_mobile; 
		$.ajax({
			url: url,
		}).done(function(response) {
			$('#WaitBox2 div.modal-body').html(response);
		});
	});





});
";

foreach($Tables as $Table){
	if($Table->status=='occupied'){
		$js.="
			setInterval(
				function(){
					var startTime = new Date(".$Table->occupied_time->format('Y,m-1,d,H,i,s').");
					var thisTime = new Date();
					var diff = thisTime.getTime() - startTime.getTime();
					var hh = Math.floor(diff / 1000 / 60 / 60);
					diff -= hh * 1000 * 60 * 60;
					var mm = Math.floor(diff / 1000 / 60);
					diff -= mm * 1000 * 60;
					var ss = Math.floor(diff / 1000);
					if(hh==0){ var t=mm+':'+ss; }
					else{ var t=hh+':'+mm+':'+ss; }
					$('span#timeLabel_".$Table->id."').html(t);
				}
			, 1000);
		";
	}
}

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));
?>

<div id="customerRegistrationBox" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog modal-sm" style="width: 400px !important;">
		<div class="modal-content" style=" padding: 20px; ">
			<div class="modal-body">
				<div style=" text-align: center; padding: 0px 0 15px 0px; font-size: 15px; font-weight: bold; color: #2D4161; ">OCCUPY THE TABLE</div>
				<div align="center">TABLE: <span id="tableLabel"></span><input type="hidden" name="table_id"></div>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input type="text" name="c_name" class="form-control" placeholder="Name" style="background-color: #F5F5F5;">
				</div>
				<br/>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-mobile" style=" font-size: 20px; "></i></span>
					<input type="text" name="c_mobile" class="form-control" placeholder="Mobile No." style="background-color: #F5F5F5;" maxlength="10" minlength="10">
				</div>
				<br/>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
					<select name="c_pax" class="form-control" style="background-color: #F5F5F5;">
						<option value="" style="display: none;">Select No. of Pax</option>
						<option value="1" selected="selected">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</div>
				<br/><br/>
				<div align="center">
					<span class="closeCustomerBox">CLOSE</span>
					<span class="registerCustomer">BOOK THE TABLE</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="WaitBox2" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog" style="width: 500px !important;">
		<div class="modal-content">
			<div class="modal-body"></div>
		</div>
	</div>
</div>

<div id="WaitBox3" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none; padding-right: 12px;">
	<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog" style="width: 500px !important;">
		<div class="modal-content">
			<div class="modal-body">
				<div align="center" style=" font-size: 14px; color: #2D4161; font-weight: bold; "><span>SELECT STEWARD</span></div><br/><br/>
				<input type="hidden" id="steward_table_id" >
				<?php echo $this->Form->input('employee_id',['options'=>$Employees,'class'=>'form-control input-sm select2 employee_id','empty' => '--Select Steward--','label'=>false,'required'=>'required']); ?><br/><br/>
			</div>
			<div class="modal-footer"> 
			<div align="center">
				<span class="CloseSteward">CLOSE</span> 
			</div>
			</div>
		</div>
	</div>
</div>