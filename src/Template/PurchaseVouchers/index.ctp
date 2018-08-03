<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Stock_In_Voucher_List/dosa_plaza_software'); ?>
<div style="height: 15px;" >.</div>
<div class="row">
	<div class="col-md-12 main-div">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Stock In Voucher List
				</div>
				<div class="tools"> 
 				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body">
				<?php $page_no=$this->Paginator->current('PurchaseVouchers'); $page_no=($page_no-1)*20; ?>
				<table class="table table-str " cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No.') ?></th>
							<th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
							<th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
							<th scope="col"><?= $this->Paginator->sort('vandor_id') ?></th>
							<th scope="col" style="text-align: right;"><?= $this->Paginator->sort('grand_total') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $d=0; foreach ($purchaseVouchers as $purchaseVoucher): ?>
						 <tr>
							<td><?= h(++$page_no) ?></td>
							<td><?= h($purchaseVoucher->voucher_no) ?></td>
							<td><?= h($purchaseVoucher->transaction_date->format('d-m-Y')) ?></td>
							<td><?= h($purchaseVoucher->vendor->name) ?></td>
							<td style="text-align: right;"><?= h($purchaseVoucher->grand_total) ?></td>
							<td class="actions">
								<?php echo $this->Html->link($this->Html->image('edit.png'),['controller'=>'purchaseVouchers','action'=>'add',$purchaseVoucher->id], ['escape' => false, 'class' => 'showLoader']);?>
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
