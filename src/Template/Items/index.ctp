<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Item-List | DOSA PLAZA'); ?>

<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					 Item List
				</div>
				<div class="tools" style=" margin-right: 10px; "> 
					<input id="search3"  class="form-control" type="text" placeholder="Search" >
 				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-str" cellpadding="0" cellspacing="0" id="main_tbody">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No') ?></th> 
							<th scope="col"><?= ('Name') ?></th>
							<th scope="col"><?= ('Rate') ?></th>
							<th scope="col"><?= ('Item Sub Category') ?></th>
							<th scope="col"><?= ('Discount Applicable') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $x=0; foreach ($itemslist as $country): ?>
						<tr class="main_tr">
							<td><?= ++$x; ?></td> 
							<td><?= h($country->name) ?></td>
							<td><?= h($country->rate) ?></td>
							<td><?= h($country->item_sub_category->name) ?></td>
							<td><?php if($country->discount_applicable==0){ echo "No";} else{ echo "Yes";}?></td>
							<td class="actions">
								<?php
								if($country->is_deleted==0){
								 echo $this->Html->image('edit.png',['url'=>['controller'=>'Items','action'=>'add',$country->id],'class'=>'tooltips showLoader','data-original-title'=>'Edit Item','data-container'=>'body']);?>
								<?php echo $this->Html->image('lock.png',['data-target'=>'#deletemodal'.$country->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Freeze Item','data-container'=>'body']);
								} else { ?>
									<?php echo $this->Html->image('unlock.png',['data-target'=>'#undeletemodal'.$country->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Unfreeze Item','data-container'=>'body']);
								}
								?>
								<div id="deletemodal<?php echo $country->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Items','action'=>'delete',$country->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
												
													<h4 class="modal-title">
													Are you sure you want to freeze this Item?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal" style="color:#000000;background-color:#DDDDDD">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div id="undeletemodal<?php echo $country->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Items','action'=>'undelete',$country->id)) ?>">
											<div class="modal-content">
											  <div class="modal-header">
												
													<h4 class="modal-title">
													Are you sure you want to unfreeze this Item?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal" style="color:#000000;background-color:#DDDDDD">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>

								<?php
								if($country->is_deleted==0){
									if($country->is_favorite==0){
										echo $this->Html->image('unfavorite.png',['url'=>['controller'=>'Items','action'=>'favorite',$country->id],'class'=>'tooltips showLoader','data-original-title'=>'Mark as favorite','data-container'=>'body']);
									}else{
										echo $this->Html->image('favorite.png',['url'=>['controller'=>'Items','action'=>'unfavorite',$country->id],'class'=>'tooltips showLoader','data-original-title'=>'Remove from favorite list','data-container'=>'body']);
									}
								}
								?>
							    
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