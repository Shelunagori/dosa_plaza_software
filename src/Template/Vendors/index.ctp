<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Vendor-List | DOSA PLAZA '); ?>
<div class="row" style="margin-top:15px;">

	<div class="col-md-12 main-div">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					 Vendor List
				</div>
				<div class="tools" style=" margin-right: 10px; "> 
					<table>
						<tr>
							<td></td>
							<td>
								<?= $this->Html->link('Add New', '/Vendors/add',['escape' => false, 'class' => 'showLoader btn btn-primary', 'style' => 'color:#FFF;margin-right: 10px;']) ?>
							</td>
							<td>
								<input id="search3"  class="form-control" type="text" placeholder="Search" >
							</td>
						</tr>
					</table>
					
 				</div>
			</div>
			<div class="row">	
				<div class="col-md-12 horizontal "></div>
			</div>
			<div class="portlet-body">
				<table class="table table-str" cellpadding="0" cellspacing="0" id="main_tbody">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No.') ?></th>
							<th scope="col"><?= $this->Paginator->sort('name') ?></th>
							<th scope="col"><?= $this->Paginator->sort('contact_person') ?></th>
							<th scope="col"><?= $this->Paginator->sort('contact_number') ?></th>
							<th scope="col"><?= $this->Paginator->sort('gst_no', 'GST No.') ?></th>
							<th scope="col"><?= $this->Paginator->sort('email', 'Email') ?></th>
							<th scope="col"><?= ('Items List') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $d=0; foreach ($vendors as $vendor): ?>
						<tr class="main_tr">
							<td><?= (++$d) ?></td>
							<td><?= h($vendor->name) ?></td>
							<td><?= h($vendor->contact_person) ?></td>
							<td><?= h($vendor->contact_number) ?></td>
							<td><?= h($vendor->gst_no) ?></td>
							<td><?= h($vendor->email) ?></td>
							<td> 
								<a class="" data-target="#detailspopup<?php echo $vendor->id; ?>" data-toggle=modal>
									<i class="fa fa-ellipsis-h" style="color: #BDBFC1; font-size: 18px; cursor: pointer;"></i>
								</a>
								<div id="detailspopup<?php echo $vendor->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">
													Item Lists
												</h4>
											</div>
											<div class="modal-body">
												<table class="table table-bordered" cellpadding="0" cellspacing="0">
													<thead>
														<tr>
															<th scope="col"><?= ('S.No.') ?></th>
															<th scope="col"><?= ('Item Name') ?></th>  
														</tr>
													</thead>
													<tbody>
														<?php $v=0;  
														if($vendor->vendor_items){ 
														foreach ($vendor->vendor_items as $vendorItem): ?>
														<tr>
															<td><?= (++$v) ?></td>
															<td><?= ($vendorItem->raw_material->name); ?></td>
														</tr>
														<?php endforeach; }?>													
													</tbody>
												</table>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td class="actions">
								<?php
									if($vendor->is_deleted==0){
									 echo $this->Html->image('edit.png',['url'=>['controller'=>'Vendors','action'=>'add',$vendor->id],'class'=>'tooltips showLoader','data-original-title'=>'Edit Vendor','data-container'=>'body']);

									echo $this->Html->image('lock.png',['data-target'=>'#deletemodal'.$vendor->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Freeze Vendor','data-container'=>'body']);
									} else { ?>
										<?php echo $this->Html->image('unlock.png',['data-target'=>'#undeletemodal'.$vendor->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Unfreeze Vendor','data-container'=>'body']);
									}
									?>

								<?= $this->Html->link('View Purchase', '/PurchaseVouchers/index?vendor_id='.$vendor->id, ['escape' => false, 'class' => 'showLoader']) ?>

								<div id="deletemodal<?php echo $vendor->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Vendors','action'=>'delete',$vendor->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													<h4 class="modal-title">
													Are you sure you want to freeze this Vendor?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal" style="color:#000000;background-color:#DDDDDD;">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div id="undeletemodal<?php echo $vendor->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Vendors','action'=>'undelete',$vendor->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													
													<h4 class="modal-title">
													Are you sure you want to unfreeze this Vendor?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal" style="color:#000000;background-color:#DDDDDD;">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
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