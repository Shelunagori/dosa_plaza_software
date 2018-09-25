<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Store Records | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption"style="padding:13px; color: red;">
					Store Records
				</div>
				<div class="actions" style="margin-right: 10px;">
					<table>
						<tr>
							<td>
								<?= $this->Html->link('Stock In', '/PurchaseVouchers/add',['escape' => false, 'class' => 'showLoader btn btn-primary', 'style' => 'color:#FFF;margin-right: 10px;']) ?>
							</td>
							<td>
								<?= $this->Html->link('Stock Adjustment', '/RawMaterials/stock-adjustment',['escape' => false, 'class' => 'showLoader btn red', 'style' => 'color:#FFF;margin-right: 10px;']) ?>
							</td>
							<td>
								<input id="search3"  class="form-control" type="text" placeholder="Search" style="float: right;">
							</td>
						</tr>
					</table>
					

					
				</div>
				<br/>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover" cellpadding="0" cellspacing="0" id="main_table">
					<thead>
						<tr>
							<th style="width:10%"><?= ('S.No.') ?></th>
							<th style="width:15%"><?= ('Raw materials') ?></th>
							<th style="width:5%"><?= ('Unit') ?></th>
							<th style="width:15%" ><?= ('Current stock') ?></th>
							<th style="width:15%"><?= ('Last Purchase ') ?></th> 
						</tr>
					</thead>
					<tbody id="main_tbody">
					<?php $d=0;$x=0; foreach ($RawMaterials as $RawMaterial): ?>
						<tr style="background-color: #d6d6d6;">
							<td colspan="5" raw_material_sub_category_id="<?= h($RawMaterial->raw_material_sub_category->id) ?>" class="subCatRow" >
								<?= h($RawMaterial->raw_material_sub_category->name) ?>
							</td>
						</tr>
						<tr class="main_tr">
							<td><?= (++$d) ?></td>
							<td><?= h($RawMaterial->name) ?></td>
							<td><?= h($RawMaterial->primary_unit->name) ?></td>
							<td>
								<span class="current_stock" name ="quantity"><?= h($RawMaterial->total_in - $RawMaterial->total_out) ?></span> 
								<?= h($RawMaterial->primary_unit->quantity) ?> 
							</td>
							<td>
								<?php
									if($RawMaterial->last_purchase){
										$date1 = $RawMaterial->last_purchase;
										$date2 = date('Y-m-d');
										$diff = abs(strtotime($date2) - strtotime($date1));
										echo $days = floor($diff / (60*60*24)); 
										echo ' Days Before';
									}
								?>
							</td>
						</tr>
						<?php $x++; endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
	$js="
	$(document).ready(function() {	
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

    	var sub_category_id=0;
    	$('.subCatRow').each(function(){
    		var raw_material_sub_category_id= $(this).attr('raw_material_sub_category_id');
			if(sub_category_id!=raw_material_sub_category_id){
				sub_category_id = raw_material_sub_category_id;
			}else{
				$(this).remove();
			}
		});
		
	});
	";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>