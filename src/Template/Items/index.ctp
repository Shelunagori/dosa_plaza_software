<?php $this->set("title", 'Item'); ?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet blue box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-book"></i>View Item List
				</div>
				<div class="tools"> 
 				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-bordered" cellpadding="0" cellspacing="0">
					<thead>
						<tr style="background-color:#DFD9C4;">
							<th scope="col"><?= ('S.No') ?></th> 
							<th scope="col"><?= ('Name') ?></th>
							<th scope="col"><?= ('Rate') ?></th>
							<th scope="col"><?= ('Item Sub Category') ?></th>
							<th scope="col"><?= ('Discount Applicable') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $x=0; foreach ($itemslist as $country): ?>
						<tr>
							<td><?= ++$x; ?></td> 
							<td><?= h($country->name) ?></td>
							<td><?= h($country->rate) ?></td>
							<td><?= h($country->item_sub_category->name) ?></td>
							<td><?php if($country->discount_applicable==0){ echo "No";} else{ echo "Yes";}?></td>
							<td class="actions">
								<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/Items/add/'.$country->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
								<a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $country->id; ?>" data-toggle=modal><i class="fa fa-trash"></i></a>
								<div id="deletemodal<?php echo $country->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Items','action'=>'delete',$country->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">
													Are you sure you want to remove this Category?
													</h4>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn  btn-sm btn-info">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
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
				<div class="paginator">
					<ul class="pagination">
						<?= $this->Paginator->prev('< ' . __('previous')) ?>
						<?= $this->Paginator->numbers() ?>
						<?= $this->Paginator->next(__('next') . ' >') ?>
					</ul>
					<p><?= $this->Paginator->counter() ?></p>
				</div>
			</div>
		</div>
	</div>
</div>