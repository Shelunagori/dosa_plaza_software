<?php $this->set("title", 'Employee'); ?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet blue box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-book"></i>View Employee List
				</div>
				<div class="tools"> 
 				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-bordered" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No.') ?></th>
							<th scope="col"><?= $this->Paginator->sort('name') ?></th>
							<th scope="col"><?= $this->Paginator->sort('mobile_no') ?></th>
							<th scope="col"><?= $this->Paginator->sort('email') ?></th>
							<th scope="col"><?= ('address') ?></th> 
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $d=0; foreach ($employees as $vendor): ?>
						<tr>
							<td><?= (++$d) ?></td>
							<td><?= h($vendor->name) ?></td>
							<td><?= h($vendor->mobile_no) ?></td>
							<td><?= h($vendor->email) ?></td>
							<td><?= h($vendor->address) ?></td>
 							<td class="actions">
								<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/Employees/add/'.$vendor->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
								<a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $vendor->id; ?>" data-toggle=modal><i class="fa fa-trash"></i></a>
								<div id="deletemodal<?php echo $vendor->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Employees','action'=>'delete',$vendor->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">
													Are you sure you want to remove this Employee?
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
						<?= $this->Paginator->first('<< ' . __('first')) ?>
						<?= $this->Paginator->prev('< ' . __('previous')) ?>
						<?= $this->Paginator->numbers() ?>
						<?= $this->Paginator->next(__('next') . ' >') ?>
						<?= $this->Paginator->last(__('last') . ' >>') ?>
					</ul>
					<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
				</div>
			</div>
		</div>
	</div>
</div>