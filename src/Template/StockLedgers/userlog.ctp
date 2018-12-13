<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Daily Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption" style="padding:13px; color: red;">
					User Log
				</div>
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">
				<div>
					<table class="table table-bordered" >
						<tr>
							<th>Date</th>
							<th>Qty</th>
							<th>In/Out</th>
							<th>Employee</th>
							<th>Module</th>
							<th>Adjustment Commant</th>
							<th>Wastage Commant</th>
						</tr>
						<?php foreach ($StockLedgers as $StockLedger) { ?>
							<tr>
								<td><?php echo date('d-m-Y', strtotime($StockLedger->transaction_date)); ?></td>
								<td><?php echo $StockLedger->quantity; ?></td>
								<td><?php echo $StockLedger->status; ?></td>
								<td><?= $StockLedger->user->name ?></td>
								<td><?php echo ucfirst($StockLedger->voucher_name); ?></td>
								<td><?= $StockLedger->adjustment_commant ?></td>
								<td><?= $StockLedger->wastage_commant ?></td>
							</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
