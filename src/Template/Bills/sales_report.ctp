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
				<?php $formAction=$this->Url->build(['controller'=>'Bills','action'=>'salesReport']); ?>
				<form method="GET" action="<?php echo $formAction; ?>" id="FilterBox" >
					<div style="margin: auto;width: 100%;">
						<table class="table table-s-tr" >
							<tr>
								<td >Bill Date</td>
								<td colspan="2">
									<div class="form-group ">
                                        <div class="col-md-4">
                                            <div id="reportrange" class="btn default" style="padding: 5px;">
                                                <i class="fa fa-calendar"></i>
                                                &nbsp; 
                                                <span><?php echo $exploded_date_from_to[0].' - '.$exploded_date_from_to[1]; ?></span>
                                                <input type="hidden" name="date_from_to" id="date_from_to" value="<?php echo @$exploded_date_from_to[0].'/'.@$exploded_date_from_to[1]; ?>">
                                                <b class="fa fa-angle-down"></b>
                                            </div>
                                        </div>
                                    </div>
								</td>
							
								<td style="vertical-align: middle;">No of Pax</td>
								<td>
									<select class="form-control" name="no_of_pax_parameter">
										<option value="Equal-to">Equal to</option>
										<option value="Greater-than">Greater than</option>
										<option value="Less-than">Less than</option>
									</select>
								</td>
								<td>
									<input type="text" class="form-control" name="no_of_pax" />
								</td>
							</tr>
							<tr>
								<td style="vertical-align: middle;">Order Type</td>
								<td >
									<select class="form-control" name="order_type">
										<option value=""></option>
										<option value="dinner">Dinner In</option>
										<option value="takeaway">Take Away</option>
										<option value="delivery">Delivery</option>
									</select>
								</td>
								<td></td>
							
								<td style="vertical-align: middle;">Table No</td>
								<td>
									<?php
									echo $this->Form->input('table_id', ['empty' => true, 'label' => false,'options' => $Tables,'class' => 'form-control']);
									?>
								</td>
								<td></td>
							</tr>
							<tr>
								<td style="vertical-align: middle;">Steward</td>
								<td>
									<?php
									echo $this->Form->input('employee_id', ['empty' => true, 'label' => false,'options' => $Employees,'class' => 'form-control']);
									?>
								</td>
								<td></td>
							
								<td style="vertical-align: middle;">Customer</td>
								<td>
									<?php
									echo $this->Form->input('customer_id', ['empty' => true, 'label' => false,'options' => $Customers,'class' => 'form-control']);
									?>
								</td>
								<td></td>
							</tr>
							<tr>
								<td style="vertical-align: middle;">Total bill amount</td>
								<td>
									<select class="form-control" name="bill_amount_parameter">
										<option value="Equal-to">Equal to</option>
										<option value="Greater-than">Greater than</option>
										<option value="Less-than">Less than</option>
									</select>
								</td>
								<td>
									<input type="text" class="form-control" name="bill_amount" />
								</td>
							
								<td style="vertical-align: middle;">Payment Mode</td>
								<td>
									<select class="form-control" name="payment_type">
										<option value=""></option>
										<option value="cash">cash</option>
										<option value="card">card</option>
										<option value="paytm">paytm</option>
									</select>
								</td>
								<td></td>
							</tr>
						</table>
						<div align="center"><button type="submit" class="btn btn-danger">GO</button></div>
					</div>
				</form>

				<div align="center">
					<h4><?php echo $coreVariable['company_name']; ?></h4>
					<span><?php echo $coreVariable['company_address']; ?></span><br/>

				</div>
				<div>
					<b>Bill Wise Sales Report</b><br/>
					<b>From <?php echo @$exploded_date_from_to[0].' To '.@$exploded_date_from_to[1]; ?></b>
					<b style="float: right;"><?php echo date('d-m-Y H:i A'); ?></b>
				</div>
				<div align="right">
					<table>
						<tr>
							<td>
								<?php 
									$excelUrl = $this->Url->build(['controller'=>'Bills','action'=>'salesReportExcel']);
									$excelUrl.='?'.$seturl[1];
								 ?>
								<a href="<?php echo $excelUrl; ?>" class="btn btn-danger" style="margin-right: 10px;">Excel</a>
							</td>
							<td style=" padding: 3px 10px; background-color: #FA6775; color: #FFF; border: solid 1px #FA6775; font-size: 14px; ">Total Sale</td>
							<td style=" border: solid 1px #FA6775; padding: 3px 10px; font-size: 14px; color: #FA6775; "><?php echo $Total_grand_total->Total_grand_total; ?></td>
						</tr>
					</table>
					
				</div>
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
								<th scope="col"><?= $this->Paginator->sort('payment_type', 'Payment Mode') ?></th>
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
									$Bill->occupied_time->format('Y-m-d H:i:s').'<br/>';
									$Bill->created_on->format('Y-m-d H:i:s').'<br/>';
									$datetime1 = new DateTime($Bill->occupied_time->format('Y-m-d H:i:s'));//start time
									$datetime2 = new DateTime($Bill->created_on->format('Y-m-d H:i:s'));//end time
									$interval = $datetime1->diff($datetime2);
									echo $time    = $interval->format('%h')*60+$interval->format('%i') .' min ';
									echo $interval->format('%s sec');
									?>
								</td>
								<td>
									<?php 
									if($Bill->order_type=='dinner'){ echo "Dine In";} 
									if($Bill->order_type=='takeaway'){ echo "Take Away";} 
									if($Bill->order_type=='delivery'){ echo "Delivery";} 
									?>	
								</td>
								<td><?= h(@$Bill->table->name) ?></td>
								<td><?= h(@$Bill->employee->name) ?></td>
								<td><?= h(@$Bill->payment_type) ?></td>
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
								 			$totalTV+=round($bill_row->amount-$bill_row->discount_amount,2);
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
								 			<td><?php echo round($bill_row->amount-$bill_row->discount_amount,2); ?></td>
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
				</div>
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

<style type="text/css">
.qwerty td{
	white-space: nowrap;
}
.qwerty th{
	white-space: nowrap;
}
</style>

<!-- BEGIN PAGE LEVEL STYLES -->
    <!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->

 <!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/clockface/js/clockface.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/global/scripts/metronic.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/quick-sidebar.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END PAGE LEVEL SCRIPTS -->
<?php 
$js="
$(document).ready(function() {
    ComponentsPickers.init();
});
";
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>