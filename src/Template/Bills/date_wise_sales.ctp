<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Date Wise Sales Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Date Wise Sales Report
							</div>
						</td>
						<td valign="button">
							<div align="center">
								<form method="GET">
									<table>
										<tr>
											<td>
												<input type="date" class="form-control" name="from_date" value="<?php echo date('Y-m-d', strtotime($from_date)); ?>" required />
											</td>
											<td>
												<input type="date" class="form-control" name="to_date" value="<?php echo date('Y-m-d', strtotime($to_date)); ?>" required />
											</td>
											<td>
												<button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;" >GO</button>
											</td>
										</tr>
									</table>
								</form>
							</div>
						</td>
						<td width="20%"></td>
					</tr>
				</table>
				
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">

				<?php if($from_date && $to_date){ ?>
				
				<div class="table-scrollable">
				<table class="table table-bordered table-str">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Date</th>
							<th>Gross value</th>
							<th>Discount</th>
							<th>CGST</th>
							<th>SGST</th>
							<th>Net Value</th>
						</tr>
					</thead>
					<tbody id="main_tbody">
					<?php 
					$ColumnTotalAmount = 0;
					$ColumnTotalDiscountAmount = 0;
					$ColumnTotalCGST = 0;
					$ColumnTotalSGST = 0;
					$ColumnTotalNetAmount = 0;
					$start_date=$from_date;
					$end_date=$to_date;
					while (strtotime($start_date) <= strtotime($end_date)) { ?>
		                <tr class="main_tr">
							<td><?= (++$d) ?></td>
							<td><?php echo date('d-m-Y', strtotime($start_date)); ?></td>
							<td><?php echo $TotalAmount = $data[strtotime($start_date)]['TotalAmount']; ?></td>
							<td><?php echo $TotalDiscountAmount = $data[strtotime($start_date)]['TotalDiscountAmount']; ?></td>
							<?php 
								$Taxable = $TotalAmount - $TotalDiscountAmount;
								$TotalNetAmount = $data[strtotime($start_date)]['TotalNetAmount'];
								$GST = $TotalNetAmount - $Taxable;
							?>
							<td><?php echo $TotalCGST = round($GST/2, 2); ?></td>
							<td><?php echo $TotalSGST = round($GST/2, 2); ?></td>
							<td><?php echo $TotalNetAmount; ?></td>
						</tr>
					<?php
					$ColumnTotalAmount+=$TotalAmount;
					$ColumnTotalDiscountAmount+=$TotalDiscountAmount;
					$ColumnTotalCGST+=$TotalCGST;
					$ColumnTotalSGST+=$TotalSGST;
					$ColumnTotalNetAmount+=$TotalNetAmount;
					$start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
					} ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2" style="text-align: right;">Total</td>
							<td><?php echo $ColumnTotalAmount; ?></td>
							<td><?php echo $ColumnTotalDiscountAmount; ?></td>
							<td><?php echo $ColumnTotalCGST; ?></td>
							<td><?php echo $ColumnTotalSGST; ?></td>
							<td><?php echo $ColumnTotalNetAmount; ?></td>
						</tr>
					</tfoot>
				</table>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>



<?php
	$js="
	$(document).ready(function() {	
		var rows = $('#main_tbody tr.main_tr');
		$('#search3').on('keyup',function() {
	      
			var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
			var v = $(this).val();
			
    		if(v){ 
    			rows.show().filter(function() {
    				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
		
    				return !~text.indexOf(val);
    			}).hide();
    		}else{
    			rows.show();
    		}
    	}); 


		
	});
	";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>