<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'RawMaterials'); ?>	
<div class="row" style="margin:15px">
	<div class="col-md-12">
		<div class="portlet  box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Row Materials List
				</div>
				
				<div class="row">	
					<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-str table-hover " cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No') ?></th> 
							<th scope="col"><?= ('Name') ?></th>
							<th scope="col"><?= ('Tax') ?></th>
							<th scope="col"><?= ('Primary Unit') ?></th>
							<th scope="col"><?= ('Secondary Unit') ?></th>

							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $x=0; foreach ($rawMaterials as $rawMaterial): ?>
							<tr>
								<td><?= ++$x; ?></td> 
								<td><?= h($rawMaterial->name) ?></td>
								<td><?= h($rawMaterial->tax->name) ?></td>
								<td><?= h($rawMaterial->primary_unit->name) ?></td>
								<td><?= h(@$rawMaterial->secondary_unit->name) ?></td>
								<td class="actions">
									<?php echo $this->Html->image('edit.png',['url'=>['controller'=>'rawMaterials','action'=>'edit',$rawMaterial->id]]);?>
									<?php echo $this->Html->image('delete.png',['data-target'=>'#deletemodal'.$rawMaterial->id,'data-toggle'=>'modal']);?>
									<div id="deletemodal<?php echo $rawMaterial->id; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-md" >
											<form method="post" action="<?php echo $this->Url->build(array('controller'=>'rawMaterials','action'=>'delete',$rawMaterial->id)) ?>">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">
															Are you sure you want to remove this Category?
														</h4>
													</div>
													<div class="modal-footer" style="border:none;">
														<button type="submit" class="btn  btn-sm btn-danger">Yes</button>
														<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color: #000000;">Cancel</button>
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
