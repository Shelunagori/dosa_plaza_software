<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Stock-Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption"style="padding:13px; color: red;">
					Filter: Sales-Report
				</div>
				
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">
				<?php $formAction=$this->Url->build(['controller'=>'Bills','action'=>'salesReport']); ?>
				<form method="GET" action="<?php echo $formAction; ?>">
					<div style="margin: auto;width: 60%;">
						<table class="table table-s-tr" >
							<tr>
								<td style="vertical-align: middle;">Bill Date</td>
								<td>
									<label>From</label>
									<input type="date" class="form-control" name="from_date"  required value="<?php echo date('Y-m-d'); ?>" />
								</td>
								<td>
									<label>To</label>
									<input type="date" class="form-control" name="to_date"  required value="<?php echo date('Y-m-d'); ?>" />
								</td>
							</tr>
							<tr>
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
							</tr>
							<tr>
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
							</tr>
							<tr>
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
							</tr>
						</table>
						<div align="center"><button type="submit" class="btn btn-danger">GO</button></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
