<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Current-Stock Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption"style="padding:13px; color: red;">
					Current-Stock Report
				</div>
				<div class="actions" style="margin-right: 10px;">
					<table>
						<tr>
							<td>
								<a href="javascript:void()" id="exportExcel" class="btn btn-danger" style="margin-right: 10px;color: #FFF;"> Excel</a>
							</td>
							<td>
								<div class="actions" style="margin-right: 10px;">
									<input id="search3"  class="form-control" type="text" placeholder="Search" >
								</div>
							</td>
						</tr>
					</table>
				</div>
				<br/>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body" id="ExcelPage">
				<div align="center">
					<h4><?php echo $coreVariable['company_name']; ?></h4>
					<span><?php echo $coreVariable['company_address']; ?></span><br/>

				</div>
				<div>
					<b>Bill Wise Sales Report</b><br/>
					<b>From <?php echo $exploded_date_from_to[0].' To '.$exploded_date_from_to[1]; ?></b>
					<b style="float: right;"><?php echo date('d-m-Y H:i A'); ?></b>
				</div>
				<table border="1" class="table table-condensed table-hover table-bordered"  id="main_table" style="border: none;">
					<thead>
						<tr>
							<th style="width:10%"><?= ('S.No.') ?></th>
							<th style="width:15%"><?= ('Raw materials') ?></th>
							<th style="width:15%" ><?= ('Current stock') ?></th>
							<th style="width:15%"><?= ('Last Purchase ') ?></th> 
						</tr>
					</thead>
					<tbody id="main_tbody">
					<?php $d=0;$x=0; foreach ($RawMaterials as $RawMaterial): ?>
						<tr style="background-color: #d6d6d6;" class="subCatRow" raw_material_sub_category_id="<?= h($RawMaterial->raw_material_sub_category->id) ?>">
							<td colspan="4"   >
								<?= h($RawMaterial->raw_material_sub_category->name) ?>
							</td>
						</tr>
						<tr class="main_tr">
							<td><?= (++$d) ?></td>
							<td><?= h($RawMaterial->name) ?></td>
							<td>
								<span class="current_stock" name ="quantity"><?= h($RawMaterial->total_in - $RawMaterial->total_out) ?></span> 
								<?= h($RawMaterial->primary_unit->quantity.' '.$RawMaterial->primary_unit->name) ?> 
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

<?php $formAction=$this->Url->build(['controller'=>'RawMaterials','action'=>'currentStockExcel']); ?>
<form method="POST" action="<?php echo $formAction; ?>" id="ExcelForm" style="display: none;">
	<textarea id="ExcelBox" name="excel_box"></textarea>
	<button type="submit">EXCEL</button>
</form>

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

    	var ht = $('#ExcelPage').html();
		$('#ExcelBox').html(ht);

		
		$('#exportExcel').die().live('click',function(event){
			$('#ExcelForm').submit();
		});
		
	});
	";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>