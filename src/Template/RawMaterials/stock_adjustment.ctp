<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<?= $this->Form->create($RawMaterials, ['id'=>'configform']) ?>
			<div class="portlet-title">
				<div class="caption"style="padding: 13px; color: red;">
					Stock Adjustment
				</div>
				<div class="row">	
					<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table " cellpadding="0" cellspacing="0" id="main_table">
					<thead>
						<tr>
							<th style="width:10%"><?= ('S.No.') ?></th>
							<th style="width:15%"><?= ('Item') ?></th>
							<th style="width:15%" ><?= ('Current stock') ?></th>
							<th style="width:15%"><?= ('Physical stock') ?></th>
							<th style="width:20%;"><?= ('Adjustment') ?></th> 
						</tr>
					</thead>
					<tbody id="main_tbody">
						<?php $d=0; foreach ($RawMaterials as $RawMaterial): ?>
						<tr class="main_tr">
							<td><?= (++$d) ?></td>
							<td><?= h($RawMaterial->name) ?></td>
							<td>
								<span class="current_stock"><?= h($RawMaterial->total_in - $RawMaterial->total_out) ?></span> 
								<?= h($RawMaterial->primary_unit->name) ?>
							</td>
							<td>
								<div class="input-group input-sm ">
									<input class="form-control physical" autocomplete="off">
									<span class="input-group-addon">
										<?= h($RawMaterial->primary_unit->name) ?>
									</span>
								</div>
								<div style="padding: 12px;">
									<textarea rows="1" cols="15" name="comment" form="" style="padding: 10px 33px 2px 11px;">
									Enter text here...</textarea>
								</div>
									<?php //echo $this->Form->input('physical_stock', ['label' => false,'class'=>'form-control input-sm physical','required'=>'required','style'=>'width: 60%;']); ?>
							</td>
							<td>
								<div class="input-group input-sm ">
									<input class="form-control adjust" autocomplete="off">
									<span class="input-group-addon">
										<?= h($RawMaterial->primary_unit->name) ?>
									</span>
								</div>
									<?php // echo $this->Form->input('Adjustment', ['label' => false,'class'=>'form-control input-sm adjust','required'=>'required','style'=>'width:60%;']); ?>
								<div class="input-group  hiddendiv" style="padding-top:3%;">
									<div style="width:42%; float:left; margin-right:4%;text-align: left;	">
									<label style="text-align:left;">No resaon </label>
									<input  class="form-control input input-sm resaon" style ="width:60%"/>
										<span class="input-group-addon" style="float:left;">
												<?= h($RawMaterial->primary_unit->name) ?>
										</span>
									</div>
									<div style="width:42%; float:left;text-align: left;">
										<label style="text-align:left;">wastage</label>
										<input  class= "form-control input-sm  wastage" style="width:60%" />
										<span class="input-group-addon" style="float:left";>
											<?= h($RawMaterial->primary_unit->name) ?>
										</span>
									</div>
								</div>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="box-footer"  style="text-align:center;padding-bottom: 18px;padding: 25px;">
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
		
		$('.hiddendiv').hide()
		$(document).on('keyup', '.physical', function()
		{   
			var cs 	=  $(this).closest('tr').find('span.current_stock').text();
			var p   =  parseFloat($(this).closest('tr').find('.physical').val());
			if(!isNaN(p))
			{
				var adjustmant =  p-cs;
				adjustmant =round(adjustmant,2);
				if (adjustmant>=0){
					$(this).closest('tr').find('.adjust').val(adjustmant);
					$(this).closest('tr').find('.hiddendiv').hide();
				}	
				else {
					$(this).closest('tr').find('.adjust').val(adjustmant);
					$(this).closest('tr').find('.hiddendiv').show(); 
				}
				$(this).closest('tr').find('.resaon').val(Math.abs(adjustmant));
			}
			var wastage = parseFloat($(this).closest('tr').find('.wastage').val());
			if(!isNaN(wastage)){
				if(wastage>adjustmant){
					var r = Math.abs(adjustmant) - Math.abs(wastage);
					$(this).closest('tr').find('.resaon').val(Math.abs(r));
				}
				else{
					$(this).closest('tr').find('.wastage').val('0')
					r = adjustmant;
				}
			}
		});
		$(document).on('keyup', '.adjust', function()
		{  
			var cs	=  parseFloat($(this).closest('tr').find('span.current_stock').text());
			var a   =  parseFloat($(this).closest('tr').find('.adjust').val());
			
			if(isNaN(cs)){cs=0;}
			if(isNaN(a)){a=0;}
			if(a>=0){
				var phy = cs + a;
				$(this).closest('tr').find('.hiddendiv').hide();
			}else{
				var phy = cs - Math.abs(a);
				$(this).closest('tr').find('.hiddendiv').show();
			}
			phy   = round(phy,2);
			$(this).closest('tr').find('.physical').val(phy);
			//$(this).closest('tr').find('.resaon').val(Math.abs(a));
			var wastage = parseFloat($(this).closest('tr').find('.wastage').val());
			if(!isNaN(wastage)){
				
				if(wastage>a){
					var r = Math.abs(a) - Math.abs(wastage);
					$(this).closest('tr').find('.resaon').val(Math.abs(r));
				}
				else{
					$(this).closest('tr').find('.wastage').val('0')
					r = a;
				}
			}
		});
		
		$(document).on('keyup', '.resaon', function(){
			var adjust  = $(this).closest('tr').find('.adjust').val();
			if(isNaN(adjust)){ adjust=0; }
			adjust=Math.abs(adjust);
			
			var  resaon = parseFloat($(this).closest('tr').find('.resaon').val());
			if(isNaN(resaon)){resaon=0;}
			
			if(resaon>adjust){resaon=0; $(this).closest('tr').find('.resaon').val('0')}
			
			var w = Math.abs(adjust)-Math.abs(resaon);
			w = round(w,2);
			$(this).closest('tr').find('.wastage').val(w);
			
		});
		$(document).on('keyup', '.wastage', function(){
			var adjust  = $(this).closest('tr').find('.adjust').val();
			if(isNaN(adjust)){ adjust=0; }
			adjust=Math.abs(adjust);
			
			var wastage = parseFloat($(this).closest('tr').find('.wastage').val());
			if(isNaN(wastage)){ wastage=0; }
			
			if(wastage>adjust){ wastage=0; $(this).closest('tr').find('.wastage').val('0') }
			
			var NR= Math.abs(adjust)-wastage;
			NR = round(NR,2);
			
			$(this).closest('tr').find('.resaon').val(NR);
			
		});
		
		
	
	});
	";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>