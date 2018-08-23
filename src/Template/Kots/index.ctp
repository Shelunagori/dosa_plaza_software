<style type="text/css">
	#kotTable tr td{
		padding: 5px 0px;
	}
</style>  
<div id="accordion1" class="panel-group">
	<?php foreach ($kots as $kot): ?>
	<div class="panel panel-default" style=" border: none; ">
		<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion_<?php echo $kot->id; ?>" aria-expanded="false">
			<div class="panel-heading" style="padding:5px;background-color: #E6E7E8;">
				<span class="panel-title" style="font-size: 14px; color: #373435;">
					KOT#<?php echo $kot->voucher_no; ?> [<?php echo $kot->created_on->format('d-m-Y h:i A'); ?>]
				</span>
				<span data-target="#delete<?php echo $kot->id; ?>" data-toggle='modal' style="color: #000; float: right;margin-right: 15px;" >
					<i class="fa fa-trash pointer" style="color: #fa6775;font-size: 17px;"></i>
				</span> 
			</div>
		</a>

		<div id="delete<?php echo $kot->id; ?>" class="modal fade" role="dialog">
			<div class="modal-dialog modal-md" >
				<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Kots','action'=>'deletekot',$kot->id,$table_id,$order)) ?>">
					<div class="modal-content">
					  <div class="modal-header" align="center">
							<h4 class="modal-title">
							Are you sure you want to delete this KOT?
							</h4><br/>
							<label>Delete Comment</label>
							<textarea class="form-control" name="delete_comment"></textarea>
						</div>
						<div class="modal-footer" style="border:none;">
							<button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
							<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color:#000000;background-color:#DDDDDD;">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div id="accordion_<?php echo $kot->id; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
			<div class="panel-body" style="border: none;padding: 5px;">
				 <table width="100%" id="kotTable">
					<thead>
						<tr style="border-bottom: solid 1px #F1F1F2;font-size: 12px; " > 
							<th width="5%">#</th>
							<th>Item</th>
							<th style="text-align:center;" width="5%">Qty</th>
							<th style="text-align:center;" width="10%">Rate</th>
							<th style="text-align:center;" width="10%">Amount</th>
							<th style="text-align:center;" width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$i=0; $total=0;
					foreach($kot->kot_rows as $kot_row){ ?>
						<tr style="border-bottom: solid 1px #F1F1F2;font-size: 12px; ">
							<td><?php echo ++$i.'.'; ?></td>
							<td ><?php echo $kot_row->item->name; ?></td>
							<td style="text-align:center;"><?php echo $kot_row->quantity; ?></td>
							<td style="text-align:center;"><?php echo $kot_row->rate; ?></td>
							<td style="text-align:center;"><?php echo $kot_row->amount; ?></td>
							<td style="text-align:center;">

								<?php echo $this->Html->image('delete.png',['data-target'=>'#deleteitem'.$kot_row->id,'data-toggle'=>'modal','class'=>'tooltips ','style'=>'height: 15px;']); ?>



								<div id="deleteitem<?php echo $kot_row->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Kots','action'=>'deletekotitem',$kot_row->id,$table_id,$order)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													<h4 class="modal-title">
													Are you sure you want to delete this Item?
													</h4><br/>
													<label>Delete Comment</label>
													<textarea class="form-control" name="delete_comment"></textarea>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color:#000000;background-color:#DDDDDD;">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>


        

