<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Vendor'); ?>
<div class="row">
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="caption top-caption">
				<span>View Vendor List</span>
			</div>
		</div>
	</div>
</div>
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
								<a class="btn btn-info btn-xs" data-target="#detailspopup<?php echo $vendor->id; ?>" data-toggle=modal><i class="fa fa-book"></i></a>
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
															<th scope="col" class="actions"><?= __('Actions') ?></th>
														</tr>
													</thead>
													<tbody>
														<?php $v=0; foreach ($vendor->vendor_items as $vendorItem): ?>
														<tr>
															<td><?= (++$v) ?></td>
															<td><?= ($vendorItem->item->name); ?></td>
															<td class="actions">
																<?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $vendorItem->id], ['escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $vendorItem->id)]) ?>
															</td>
														</tr>
														<?php endforeach; ?>													
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
								<?php echo $this->Html->image('edit.png',['url'=>['controller'=>'Vendors','action'=>'add',$vendor->id]]);?>
								<?php echo $this->Html->image('delete.png',['data-target'=>'#deletemodal'.$vendor->id,'data-toggle'=>'modal']);?>
								<div id="deletemodal<?php echo $vendor->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Vendors','action'=>'delete',$vendor->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													
													<h4 class="modal-title">
													Are you sure you want to remove this Vendor?
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
