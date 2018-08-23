<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'KOT Report | DOSA PLAZA'); ?>
<style type="text/css">
.kotdetail td{
	border: 1px dotted #999;padding: 2px;
}
</style>
<style type="text/css" media="print">
@page {
	width:100%;
	size: auto;   /* auto is the initial value */
	margin: 0px 0px 0px 0px;  /* this affects the margin in the printer settings */
}
.hide_at_print {
	display:none !important;
}
.show_at_print {
	display:block !important;
}
</style>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title hide_at_print">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								KOT Report
							</div>
						</td>
						<td valign="button">
							<div align="center">
								<form method="GET">
									<table>
										<tr>
											<td>
												<input type="date" class="form-control" name="from_date" value="<?php echo $from_date; ?>" required />
											</td>
											<td>
												<input type="date" class="form-control" name="to_date" value="<?php echo $to_date; ?>" required />
											</td>
											<td>
												<button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;" >GO</button>
											</td>
										</tr>
									</table>
								</form>
							</div>
						</td>
						<td width="20%">
							<div class="actions" style="margin-right: 10px;">
								<input id="search3"  class="form-control" type="text" placeholder="Search" >
							</div>
						</td>
					</tr>
				</table>
				
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">
				<div align="center" class="show_at_print" style="display: none;">
					<h3>KOT HISTORY</h3>
				</div>
				<div class="table-scrollable">
					<?php if($from_date && $to_date){ ?>
					<table width="100%">
						<tbody id="main_tbody">
						<?php foreach ($Kots as $Kot): ?>
							<tr>
								<td style="border-top: solid 1px #8c8c8c;padding: 10px 2px;">
									<table width="100%">
										<tr>
											<td>
												<span style="color: #606062;">KOT No: </span>
												<span style="margin-left: 10px;"> <?= h($Kot->voucher_no) ?> </span>
											</td>
											<td>
												<span style="color: #606062;">Table: </span>
												<span style="margin-left: 10px;"> <?= h($Kot->table->name) ?> </span>
											</td>
											<td>
												<span style="color: #606062;">Create on: </span>
												<span style="margin-left: 10px;"> <?= h($Kot->created_on->format('d-m-Y h:i A')) ?> </span>
											</td>
											<td>
												<span style="color: #606062;">Order Type: </span>
												<span style="margin-left: 10px;"> 
												<?php 
												if($Kot->order_type=='dinner'){ echo "Dinner In";} 
												if($Kot->order_type=='takeaway'){ echo "Take Away";} 
												if($Kot->order_type=='delivery'){ echo "Delivery";} 
												?>
												</span>
											</td>
											<td>
												<span style="color: #606062;">Steward: </span>
												<span style="margin-left: 10px;"> <?= h($Kot->bill->employee->name) ?> </span>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style="padding: 0 2px 5px 2px;">
									<table width="100%" style="margin: 0;" class="kotdetail">
										<tr>
											<td style="text-align: center;" width="5%">Sr N.</td>
											<td width="40%">Item</td>
											<td style="text-align: center;" width="10%">Quantity</td>
											<td style="text-align: center;" width="10%">Rate</td>
											<td style="text-align: center;" width="10%">Amount</td>
											<td width="25%">Item comment</td>
										</tr>
										<?php $q=0; foreach ($Kot->kot_rows as $kot_row) { ?>
										<tr>
											<td style="text-align: center;"><?php echo ++$q; ?></td>
											<td><?= h($kot_row->item->name) ?></td>
											<td style="text-align: center;"><?= h($kot_row->quantity) ?></td>
											<td style="text-align: center;"><?= h($kot_row->rate) ?></td>
											<td style="text-align: center;"><?= h($kot_row->amount) ?></td>
											<td><?= h($kot_row->item_comment) ?></td>
										</tr>
										<?php } ?>
									</table>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php } ?>
				</div>
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