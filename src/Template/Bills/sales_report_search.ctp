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
								<td style="vertical-align: middle;">
									Date
								</td>
								<td>
									<label>From</label>
									<input type="date" class="form-control" name="from_date"  required />
								</td>
								<td>
									<label>To</label>
									<input type="date" class="form-control" name="to_date"  required />
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
