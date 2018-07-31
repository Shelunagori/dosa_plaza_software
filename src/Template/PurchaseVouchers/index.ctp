<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Employee'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="caption top-caption">
				<span>View Purchase Vouchers List</span>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 main-div">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					View Purchase Vouchers List
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
							<th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
							<th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
							<th scope="col"><?= $this->Paginator->sort('vandor_id') ?></th>
							<th scope="col"><?= ('grand_total') ?></th> 
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $d=0; foreach ($purchaseVouchers as $purchaseVoucher): ?>
						 <tr>
							<td><?= h($purchaseVoucher->id) ?></td>
							<td><?= h($purchaseVoucher->voucher_no) ?></td>
							<td><?= h($purchaseVoucher->transaction_date) ?></td>
							<td><?= h($purchaseVoucher->vandor_id) ?></td>
							<td><?= h($purchaseVoucher->grand_total) ?></td>
							<td class="actions">
								<?php echo $this->Html->image('edit.png',['url'=>['controller'=>'PurchaseVouchers','action'=>'edit',$purchaseVoucher->id]]);?>
								<?php echo $this->Html->image('delete.png',['data-target'=>'#deletemodal'.$purchaseVoucher->id,'data-toggle'=>'modal']);?>
								<div id="deletemodal<?php echo $purchaseVoucher->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'PurchaseVouchers','action'=>'delete',$purchaseVoucher->id)) ?>">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">
														Are you sure you want to remove this Employee?
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
