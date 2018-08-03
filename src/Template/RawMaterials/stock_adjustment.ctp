<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Stock-Adjustment | DOSAPLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<?= $this->Form->create($RawMaterials, ['id'=>'configform']) ?>
			<div class="portlet-title">
				<div class="caption"style="padding:13px; color: red;">
					Stock Adjustment
				</div>
				<div style="text-align:right;padding:12px 51px 18px;">
					<input id="search3" type="text" placeholder="Search" />
					<i id="filtersubmit" class="fa fa-search"></i>
				</div>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
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
							<th style="width:20%;"><?= ('Commant') ?></th> 
						</tr>
					</thead>
					<tbody id="main_tbody">
					<?php $d=0;$x=0; foreach ($RawMaterials as $RawMaterial): ?>
						<tr class="main_tr">
							<td><?= (++$d) ?></td>
							<td><?= h($RawMaterial->name) ?>
							<?php echo $this->Form->input('StockLedgers['.$x.'][raw_material_id]',array('type'=>'hidden','value'=>$RawMaterial->id)); ?>
							</td>
							<td>
								<span class="current_stock" name ="quantity"><?= h($RawMaterial->total_in - $RawMaterial->total_out) ?></span> 
								<?= h($RawMaterial->primary_unit->quantity) ?> 
							</td>
							<td>
								<div class="input-group input-sm ">
									<input class="form-control physical" autocomplete="off">
									<span class="input-group-addon">
										<?= h($RawMaterial->primary_unit->name) ?>
									</span>
								</div> 
							</td>
							<td>
								<div class="input-group input-sm ">
									<input class="form-control adjust" autocomplete="off" name="StockLedgers[<?php echo $x;?>][adjust]">
									<span class="input-group-addon">
										<?= h($RawMaterial->primary_unit->name) ?>
									</span>
								</div>
								<div class="input-group  hiddendiv" style="padding-top:3%;">
									<div style="width:46%; float:left; margin-right:4%;text-align: left;	">
										<label style="text-align:left;">No resaon </label>
										<input  class="form-control input input-sm resaon" name="StockLedgers[<?php echo $x;?>][noresaon]" style ="width:60%"/>
										<span class="input-group-addon" style="float:left;">
											<?= h($RawMaterial->primary_unit->name) ?>
										</span>
									</div>
									<div style="width:46%; float:left;text-align: left;">
										<label style="text-align:left;">wastage</label>
										<input  class= "form-control input-sm  wastage" name="StockLedgers[<?php echo $x;?>][wastage]" style="width:60%" />
										<span class="input-group-addon" style="float:left";>
											<?= h($RawMaterial->primary_unit->name) ?>
										</span>
									</div>
								</div>
							</td>
							<td>
								<div class="input-group input-sm hiddencommant ">
									<input class="form-control " autocomplete="off" placeholder="Adjustment commant" name="StockLedgers[<?php echo $x;?>][hiddencommant]">
								</div>
								<div>
									<div class="input-group input-sm  hiddencom ">
										<input class="form-control " autocomplete="off" placeholder="Wastage" name="StockLedgers[<?php echo $x; ?>][hiddencom]">
									</div>
								</div>
							</td>
						</tr>
						<?php $x++; endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="box-footer"  style="text-align:center;padding-bottom:18px;padding: 25px;">
						<button type="submit" class="btn btn-danger showLoader" id="order_btn" value="submit">Submit</button>
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
		$('.hiddencommant').show()
		$('.hiddencom').hide()
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
					$(this).closest('tr').find('.hiddencom').hide();
				}	
				else {
					$(this).closest('tr').find('.adjust').val(adjustmant);
					$(this).closest('tr').find('.hiddendiv').show(); 
					$(this).closest('tr').find('.hiddencom').show();
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
				$(this).closest('tr').find('.hiddencom').hide();
			}else{
				var phy = cs - Math.abs(a);
				$(this).closest('tr').find('.hiddendiv').show();
				$(this).closest('tr').find('.hiddencom').show();
				
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
		
		var rows = $('#main_tbody tr.main_tr');
		$('#search3').on('keyup',function() {
	      
			var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
			var v = $(this).val();
			
    		if(v){ 
    			rows.show().filter(function() {
    				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
		
    				return !~text.indexOf(val);
    			}).hide();
    		}else{
    			rows.show();
    		}
    	}); 
		
		
	
	});
	";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>