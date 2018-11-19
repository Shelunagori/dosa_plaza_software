<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'RawMaterialslist | DOSA PLAZA '); ?>	
<div class="row" style="margin-top:-15px">
	<div class="col-md-12">
		<div class="portlet  box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Row Materials List
				</div>
				
				<?php if (in_array("12", $userPages)){ ?>
				
				<div class="caption" style="float: left;">
					<?php
					echo $this->Html->link('<i class="fa fa-plus" style="font-size: 16px;padding-right:2px;" ></i> Add', '/RawMaterials/add',['escape' => false, 'class' => 'showLoader','style'=>'text-decoration: none;']);
					?>
				</div>
				<?php } ?>
				
				
				<div class="tools" style=" margin-right: 10px; "> 
					<input id="search3"  class="form-control" type="text" placeholder="Search" >
 				</div>
				<div class="row">	
					<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body" style="height: 200px; overflow: auto;">
				<table class="table table-str table-hover " cellpadding="0" cellspacing="0" id="main_tbody">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No') ?></th> 
							<th scope="col"><?= ('Name') ?></th>
							<th scope="col"><?= ('Sub Category') ?></th>
							<th scope="col"><?= ('Tax') ?></th>
							<th scope="col"><?= ('Primary Unit') ?></th>
							<th scope="col"><?= ('Secondary Unit') ?></th>

							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $x=0; foreach ($rawMaterials as $rawMaterial): ?>
							<tr class="main_tr">
								<td><?= h(++$x) ?></td> 
								<td><?= h($rawMaterial->name) ?></td>
								<td><?= h($rawMaterial->raw_material_sub_category->name) ?></td>
								<td><?= h($rawMaterial->tax->name) ?></td>
								<td><?= h($rawMaterial->primary_unit->name) ?></td>
								<td><?= h(@$rawMaterial->secondary_unit->name) ?></td>
								<td class="actions">
									<?php
									if($rawMaterial->is_deleted==0){
									echo $this->Html->link('Edit ', '/rawMaterials/edit/'.$rawMaterial->id, ['class' => 'btn btn-xs blue showLoader']);
									echo $this->Html->link('Freeze ', '#', ['data-target'=>'#deletemodal'.$rawMaterial->id,'data-toggle'=>'modal','class'=>'btn btn-xs red','data-container'=>'body']);
									} else {
										echo $this->Html->link('Unfreeze ', '#', ['data-target'=>'#undeletemodal'.$rawMaterial->id,'data-toggle'=>'modal','class'=>'btn btn-xs red','data-container'=>'body']);
									}
									?>

									<div id="deletemodal<?php echo $rawMaterial->id; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-md" >
											<form method="post" action="<?php echo $this->Url->build(array('controller'=>'rawMaterials','action'=>'delete',$rawMaterial->id)) ?>">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">
															Are you sure you want to freeze this Raw Material?
														</h4>
													</div>
													<div class="modal-footer" style="border:none;">
														<button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
														<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color:#000000;background-color:#DDDDDD;">Cancel</button>
													</div>
												</div>
											</form>
										</div>
									</div>
									<div id="undeletemodal<?php echo $rawMaterial->id; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-md" >
											<form method="post" action="<?php echo $this->Url->build(array('controller'=>'rawMaterials','action'=>'undelete',$rawMaterial->id)) ?>">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">
															Are you sure you want to unfreeze this Raw Material?
														</h4>
													</div>
													<div class="modal-footer" style="border:none;">
														<button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
														<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color:#000000;background-color:#DDDDDD;">Cancel</button>
													</div>
												</div>
											</form>
										</div>
									</div>
									<?php  $this->Form->PostLink('<i class="fa fa-trash-o"></i>','/Countries/delete/'.$rawMaterial->id,array('escape'=>false,'class'=>'btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $rawMaterial->id)));?>
								</td>
							</tr>
							<?php endforeach; ?> 
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
		
	});
	";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>