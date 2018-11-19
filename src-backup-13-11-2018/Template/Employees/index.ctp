<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Employee | DOSA PLAZA '); ?>

<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					 Employee List
				</div>
				
				<?php if (in_array("15", $userPages)){ ?>
				
				<div class="caption" style="float: left;">
					<?php
					echo $this->Html->link('<i class="fa fa-plus" style="font-size: 16px;padding-right:2px;" ></i> Add', '/Employees/add',['escape' => false, 'class' => 'showLoader','style'=>'text-decoration: none;']);
					?>
				</div>
				<?php } ?>
				
				
				
				<div class="tools" style=" margin-right: 10px; "> 
					<input id="search3"  class="form-control" type="text" placeholder="Search" >
 				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-str " cellpadding="0" cellspacing="0" id="main_tbody">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No.') ?></th>
							<th scope="col"><?= $this->Paginator->sort('name') ?></th>
							<th scope="col"><?= $this->Paginator->sort('mobile_no') ?></th>
							<th scope="col"><?= $this->Paginator->sort('email') ?></th>
							<th scope="col"><?= $this->Paginator->sort('salary') ?></th>
							<th scope="col"><?= ('Designation') ?></th>
							<th scope="col"><?= ('address') ?></th> 
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $d=0; foreach ($employees as $vendor): ?>
						<tr class="main_tr">
							<td><?= (++$d) ?></td>
							<td><?= h($vendor->name) ?></td>
							<td><?= h($vendor->mobile_no) ?></td>
							<td><?= h($vendor->email) ?></td>
							<td><?= h($vendor->salary) ?></td>
							<td><?= h($vendor->designation->name) ?></td>
							<td><?= h($vendor->address) ?></td>
 							<td class="actions">
								<?php 
								if($vendor->is_deleted==0){
									echo $this->Html->link('Edit ', '/Employees/add/'.$vendor->id, ['class' => 'btn btn-xs blue showLoader']);
									echo $this->Html->link('Freeze ', '#', ['data-target'=>'#deletemodal'.$vendor->id,'data-toggle'=>'modal','class'=>'btn btn-xs red','data-container'=>'body']);
								}
								else{
									echo $this->Html->link('Unfreeze ', '#', ['data-target'=>'#undeletemodal'.$vendor->id,'data-toggle'=>'modal','class'=>'btn btn-xs red','data-container'=>'body']);
								}
								?>	 


								<div id="deletemodal<?php echo $vendor->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Employees','action'=>'delete',$vendor->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													
													<h4 class="modal-title">
													Are you sure you want to freeze this Employee?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color:#000000;background-color:#DDDDDD;">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>

								<div id="undeletemodal<?php echo $vendor->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Employees','action'=>'undelete',$vendor->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
													
													<h4 class="modal-title">
													Are you sure you want to unfreeze this Employee?
													</h4>
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