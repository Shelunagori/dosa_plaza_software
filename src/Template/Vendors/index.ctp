<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Vendor'); ?>
<div class="row" style="margin-top:15px;">

	<div class="col-md-12 main-div">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					View Vendor List
				</div>
				<div class="tools"> 
 				</div>
			</div>
			<div class="row">	
				<div class="col-md-12 horizontal "></div>
			</div>
			<div class="portlet-body">
				<table class="table table-str" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No.') ?></th>
							<th scope="col"><?= $this->Paginator->sort('name') ?></th>
							<th scope="col"><?= $this->Paginator->sort('contact_person') ?></th>
							<th scope="col"><?= $this->Paginator->sort('contact_number') ?></th>
							<th scope="col"><?= ('Items List') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $d=0; foreach ($vendors as $vendor): ?>
						<tr>
							<td><?= (++$d) ?></td>
							<td><?= h($vendor->name) ?></td>
							<td><?= h($vendor->contact_person) ?></td>
							<td><?= h($vendor->contact_number) ?></td>
							<td> 
								<a class="" data-target="#detailspopup<?php echo $vendor->id; ?>" data-toggle=modal>
									<i class="fa fa-ellipsis-h" style="color: #BDBFC1; font-size: 18px; cursor: pointer;"></i>
								</a>
								<div id="detailspopup<?php echo $vendor->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">
													Item Lists
												</h4>
											</div>
											<div class="modal-body">
												<table class="table table-bordered" cellpadding="0" cellspacing="0">
													<thead>
														<tr>
															<th scope="col"><?= ('S.No.') ?></th>
															<th scope="col"><?= ('Item Name') ?></th>  
														</tr>
													</thead>
													<tbody>
														<?php $v=0;  
														if($vendor->vendor_items){ 
														foreach ($vendor->vendor_items as $vendorItem): ?>
														<tr>
															<td><?= (++$v) ?></td>
															<td><?= ($vendorItem->raw_material->name); ?></td>
														</tr>
														<?php endforeach; }?>													
													</tbody>
												</table>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td class="actions">
								<?php
									if($vendor->is_deleted==0){
									 echo $this->Html->image('edit.png',['url'=>['controller'=>'Vendors','action'=>'add',$vendor->id],'class'=>'tooltips','data-original-title'=>'Edit Vendor','data-container'=>'body']);?>
									<?php echo $this->Html->image('lock.png',['data-target'=>'#deletemodal'.$vendor->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Freeze Vendor','data-container'=>'body']);
									} else { ?>
										<?php echo $this->Html->image('unlock.png',['data-target'=>'#undeletemodal'.$vendor->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Unfreeze Vendor','data-container'=>'body']);
									}
									?>

								<div id="deletemodal<?php echo $vendor->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Vendors','action'=>'delete',$vendor->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													
													<h4 class="modal-title">
													Are you sure you want to freeze this Vendor?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal" style="color:#000000;background-color:#DDDDDD;">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div id="undeletemodal<?php echo $vendor->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Vendors','action'=>'undelete',$vendor->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													
													<h4 class="modal-title">
													Are you sure you want to unfreeze this Vendor?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal" style="color:#000000;background-color:#DDDDDD;">Cancel</button>
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
