<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Designation'); ?>
<!-- BEGIN PAGE CONTENT-->
<div class="row" style="margin-top:15px;">
	<div class="col-md-6">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<?php if(!empty($id)){ ?>
						Edit Designations
					<?php }else{ ?>
						Add Designations
					<?php } ?>
				</div>
				<div class="tools">
					<?php if(!empty($id)){ ?>
						<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add ','/ItemCategories/add/',array('escape'=>false,'style'=>'color:#fff'));?>
					<?php }?>
				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="">
					<?= $this->Form->create($Designations,['id'=>'CountryForm']) ?>
						<div class="form-group">
							<label class="control-label col-md-4" style="padding-left:14px;">Designation Name <span class="required" aria-required="true">
							</span>
							</label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" <?php if(!empty($id)){ echo "value='".$Designation->name."'"; } ?> name="name" class="form-control" Placeholder="Enter Designation Name">
									 
								</div>
							</div>
						</div>
						<div class="form-actions ">
							<div class="row">
								<div class="col-md-12" style=" text-align: center;">
									<hr></hr>
									<?php echo $this->Form->button('SUBMIT',['class'=>'btn btn-danger']); ?> 
								</div>
							</div>
						</div>
 						 
					<?= $this->Form->end() ?>
				</div> 
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					View Designation List
				</div>
				<div class="tools"> 
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
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $x=0; foreach ($Designations as $country): ?>
						<tr>
							<td><?= ++$x; ?></td> 
							<td><?= h($country->name) ?></td>
							<td class="actions">
								 

								<?php
									if($country->is_deleted==0){
									 echo $this->Html->image('edit.png',['url'=>['controller'=>'designations','action'=>'add',$country->id],'class'=>'tooltips','data-original-title'=>'Edit Category','data-container'=>'body']);?>
									<?php echo $this->Html->image('lock.png',['data-target'=>'#deletemodal'.$country->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Freeze Category','data-container'=>'body']);
									} else { ?>
										<?php echo $this->Html->image('unlock.png',['data-target'=>'#undeletemodal'.$country->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Unfreeze Category','data-container'=>'body']);
									}
									?>
								<div id="deletemodal<?php echo $country->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'designations','action'=>'delete',$country->id)) ?>">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">
														Are you sure you want to freeze this Category?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color: #000000;    background-color: #DDDDDD;;">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							    <div id="undeletemodal<?php echo $country->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'designations','action'=>'undelete',$country->id)) ?>">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">
														Are you sure you want to unfreeze this Category?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color: #000000;    background-color: #DDDDDD;;">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</td>
						</tr>
						<?php endforeach; ?> 
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>