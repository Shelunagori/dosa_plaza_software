<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Sales-Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption"style="padding:13px; color: red;">
					Sales-Report
				</div>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable">
					<?php $page_no=$this->Paginator->current('Bills'); $page_no=($page_no-1)*20; ?>	
					<table class="table table-bordered qwerty">
						<thead>
							<tr>
								<th scope="col">Sr.N.</th>
								<th scope="col"><?= $this->Paginator->sort('voucher_no', 'Bill No.') ?></th>
								<th scope="col"><?= $this->Paginator->sort('transaction_date', 'Bill Date') ?></th>
								<th scope="col"><?= $this->Paginator->sort('created_on', 'Bill Time') ?></th>
								<th scope="col"><?= $this->Paginator->sort('no_of_pax', 'No of Pax') ?></th>
								<th>Time Taken</th>
								<th scope="col"><?= $this->Paginator->sort('order_type', 'Order Type') ?></th>
								<th scope="col"><?= $this->Paginator->sort('table_id', 'Table No.') ?></th>
								<th scope="col"><?= $this->Paginator->sort('employee_id', 'Steward') ?></th>
								<th>Customer Code</th>
								<th>Customer Mobile</th>
								<th>Customer Name</th>
								<th>Bill Details</th>
								<th>Round off</th>
								<th>Total Bill Amount</th>
							</tr>
						</thead>
						<tbody id="main_tbody">
						<?php foreach ($Bills as $Bill): ?>
							<tr class="main_tr">
								<td><?= h(++$page_no) ?></td>
								<td><?= h($Bill->voucher_no) ?></td>
								<td><?php echo date('d-m-Y', strtotime($Bill->transaction_date)); ?></td>
								<td><?php echo date('h:i A', strtotime($Bill->created_on)); ?></td>
								<td><?= h($Bill->no_of_pax) ?></td>
								<td>
									<?php 
										$datetime1 = new DateTime($Bill->occupied_time);//start time
										$datetime2 = new DateTime($Bill->created_on);//end time
										$interval = $datetime1->diff($datetime2);
										echo $interval->format(' %i min %s sec');
									?>
								 </td>
								 <td><?= h($Bill->order_type) ?></td>
								 <td><?= h(@$Bill->table->name) ?></td>
								 <td><?= h(@$Bill->employee->name) ?></td>
								 <td><?= h(@$Bill->customer->customer_code) ?></td>
								 <td><?= h(@$Bill->customer->mobile_no) ?></td>
								 <td><?= h(@$Bill->customer->name) ?></td>
								 <td style="padding: 0;">
								 	<table width="100%" class="table table-bordered" style="margin: 0;">
								 		<tr>
								 			<th>Item</th>
								 			<th>Quantity</th>
								 			<th>Rate</th>
								 			<th>Amount</th>
								 			<th>Discount %</th>
								 			<th>Discount Rs</th>
								 			<th>Taxable Value</th>
								 			<th>GST %</th>
								 			<th>GST Rs</th>
								 			<th>Net</th>
								 		</tr>
								 		<?php 
								 		$totalAmount=0;
								 		$totalDisAmount=0;
								 		$totalTV=0;
								 		$totalGSTAmount=0;
								 		$totalNet=0;
								 		foreach ($Bill->bill_rows as $bill_row) { 
								 			$totalAmount+=$bill_row->amount;
								 			$totalDisAmount+=$bill_row->discount_amount;
								 			$totalTV+=$bill_row->amount-$bill_row->discount_amount;
								 			$totalGSTAmount+=round(($bill_row->amount-$bill_row->discount_amount)*($bill_row->tax_per)/100,2);
								 			$totalNet+=$bill_row->net_amount;
								 		?>
								 		<tr>
								 			<td><?php echo $bill_row->item->name; ?></td>
								 			<td><?php echo $bill_row->quantity; ?></td>
								 			<td><?php echo $bill_row->rate; ?></td>
								 			<td><?php echo $bill_row->amount; ?></td>
								 			<td><?php echo $bill_row->discount_per; ?></td>
								 			<td><?php echo $bill_row->discount_amount; ?></td>
								 			<td><?php echo $bill_row->amount-$bill_row->discount_amount; ?></td>
								 			<td><?php echo $bill_row->tax_per; ?></td>
								 			<td><?php echo round(($bill_row->amount-$bill_row->discount_amount)*($bill_row->tax_per)/100,2); ?></td>
								 			<td><?php echo $bill_row->net_amount; ?></td>
								 		</tr>
								 		<?php }?>
								 		<tr>
								 			<th colspan="3">Total</th>
								 			<th><?php echo $totalAmount; ?></th>
								 			<th>-</th>
								 			<th><?php echo $totalDisAmount; ?></th>
								 			<th><?php echo $totalTV; ?></th>
								 			<th>-</th>
								 			<th><?php echo $totalGSTAmount; ?></th>
								 			<th><?php echo $totalNet; ?></th>
								 		</tr>
								 	</table>
								 </td>
								 <td><?= h(@$Bill->round_off) ?></td>
								 <td><?= h(@$Bill->grand_total) ?></td>
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
</div>

<style type="text/css">
.qwerty td{
	white-space: nowrap;
}
.qwerty th{
	white-space: nowrap;
}
</style>