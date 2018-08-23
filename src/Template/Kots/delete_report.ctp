<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'KOT Delete History Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								KOT Delete History Report
							</div>
						</td>
						<td valign="button">
							<div align="center">
								<form method="GET">
									<table>
										<tr>
											<td>
												<input type="date" class="form-control" name="from_date" value="<?php echo @$from_date; ?>" required />
											</td>
											<td>
												<input type="date" class="form-control" name="to_date" value="<?php echo @$to_date; ?>" required />
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
				<div class="table-scrollable">
					<?php if($from_date && $to_date){ ?>
					<table class="table table-bordered table-str">
						<thead>
							<tr>
								<th style="text-align: center;">S.No.</th>
								<th style="text-align: center;">KOT No.</th>
								<th style="text-align: center;">Table</th>
								<th style="text-align: center;">Created on</th>
								<th style="text-align: center;">Details</th>
							</tr>
						</thead>
						<tbody id="main_tbody">
						<?php $x=0; foreach ($Kots as $Kot): ?>
							<?php if($Kot->deleted_rows>0){ ?>
							<tr class="main_tr">
								<td style="text-align: center;"><?= (++$x) ?></td>
								<td style="text-align: center;"><?= h($Kot->voucher_no) ?></td>
								<td style="text-align: center;"><?= h($Kot->table->name) ?></td>
								<td style="text-align: center;"><?= h($Kot->created_on->format('d-m-Y h:i A')) ?></td>
								<td style="padding: 0;">
									<table class="table table-bordered table-condensed" width="100%" style="margin: 0;">
										<tr>
											<td>Item</td>
											<td style="text-align: center;">Quantity</td>
											<td style="text-align: center;">Rate</td>
											<td style="text-align: center;">Amount</td>
											<td>Item comment</td>
											<td style="text-align: center;">Delete Time</td>
											<td>Delete comment</td>
										</tr>
										<?php foreach ($Kot->kot_rows as $kot_row) { ?>
										<tr>
											<td><?= h($kot_row->item->name) ?></td>
											<td style="text-align: center;"><?= h($kot_row->quantity) ?></td>
											<td style="text-align: center;"><?= h($kot_row->rate) ?></td>
											<td style="text-align: center;"><?= h($kot_row->amount) ?></td>
											<td><?= h($kot_row->item_comment) ?></td>
											<td style="text-align: center;"><?= h($kot_row->delete_time->format('d-m-Y h:i A')) ?></td>
											<td><?= h($kot_row->delete_comment) ?></td>
										</tr>
										<?php } ?>
									</table>
								</td>
							</tr>
							<?php } ?>
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