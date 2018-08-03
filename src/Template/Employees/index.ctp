<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Employee | DOSAPLAZA '); ?>

<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					 Employee List
				</div>
				<div class="tools"> 
 				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-str " cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No.') ?></th>
							<th scope="col"><?= $this->Paginator->sort('name') ?></th>
							<th scope="col"><?= $this->Paginator->sort('mobile_no') ?></th>
							<th scope="col"><?= $this->Paginator->sort('email') ?></th>
							<th scope="col"><?= ('Designation') ?></th>
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
							<td><?= h($vendor->designation->name) ?></td>
							<td><?= h($vendor->address) ?></td>
 							<td class="actions">
								
								<?php 
								if($vendor->is_deleted==0){
									echo $this->Html->image('edit.png',['url'=>['controller'=>'Employees','action'=>'add',$vendor->id],'class'=>'tooltips showLoader','data-original-title'=>'Edit Category','data-container'=>'body']);
									echo $this->Html->image('lock.png',['data-target'=>'#deletemodal'.$vendor->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Freeze Employee','data-container'=>'body']);
								}
								else{
									echo $this->Html->image('unlock.png',['data-target'=>'#undeletemodal'.$vendor->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Unfreeze Employee','data-container'=>'body']);
								}
								?>	 


								<div id="deletemodal<?php echo $vendor->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Employees','action'=>'delete',$vendor->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													
													<h4 class="modal-title">
													Are you sure you want to freeze this Employee?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color:#000000;background-color:#DDDDDD;">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>

								<div id="undeletemodal<?php echo $vendor->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Employees','action'=>'undelete',$vendor->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													
													<h4 class="modal-title">
													Are you sure you want to unfreeze this Employee?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color:#000000;background-color:#DDDDDD;">Cancel</button>
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
