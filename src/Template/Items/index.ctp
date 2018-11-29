<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Item-List | DOSA PLAZA'); ?>

<div class="row" style="margin-top:-15px;">
	<div class="col-md-12 main-div">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					 Item List
				</div>
				
				<?php if (in_array("8", $userPages)){ ?>
				
				<div class="caption" style="float: left;">
					<?php
					echo $this->Html->link('<i class="fa fa-plus" style="font-size: 16px;padding-right:2px;" ></i> Add', '/Items/add',['escape' => false, 'class' => 'showLoader','style'=>'text-decoration: none;']);
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
				<table class="table table-str" cellpadding="0" cellspacing="0" id="main_tbody2">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No') ?></th> 
							<th scope="col"><?= ('Name') ?></th>
							<th scope="col"><?= ('Rate') ?></th>
							<th scope="col"><?= ('Item Sub Category') ?></th>
							<th scope="col"><?= ('Item Category') ?></th>
							<th scope="col"><?= ('Discount Applicable') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $x=0; foreach ($itemslist as $country): ?>
						<tr class="main_tr" data-id="<?php echo ($country->id) ?>">
							<td><?= ++$x; ?></td> 
							<td><?= h($country->name) ?></td>
							<td><?= h($country->rate) ?></td>
							<td><?= h($country->item_sub_category->name) ?></td>
							<td><?= h($country->item_sub_category->item_category->name) ?></td>
							<td><?php if($country->discount_applicable==0){ echo "No";} else{ echo "Yes";}?></td>
							<td class="actions">
								<?php
								if($country->is_deleted==0){
								 	echo $this->Html->link('Edit ', '/Items/add/'.$country->id, ['class' => 'btn btn-xs blue showLoader']);
									echo $this->Html->link('Freeze ', '#', ['data-target'=>'#deletemodal'.$country->id,'data-toggle'=>'modal','class'=>'btn btn-xs red','data-container'=>'body']);
								} else { ?>
									<?php 
									echo $this->Html->link('Unfreeze ', '#', ['data-target'=>'#undeletemodal'.$country->id,'data-toggle'=>'modal','class'=>'btn btn-xs red','data-container'=>'body']);
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
										$favdisplay="display:";
										$unfavdisplay="display:none";
									}else{
										$favdisplay="display:none";
										$unfavdisplay="display:";
									}
									echo '<span class=favbox row_no='.$country->id.' style='.$favdisplay.'>';
									echo $this->Html->image('unfavorite.png',['url'=>['controller'=>'Items','action'=>'favorite',$country->id],'class'=>'tooltips markFav','data-original-title'=>'Mark as favorite','data-container'=>'body','row_no'=>$country->id]);
									echo '</span>';

									echo '<span class=unfavbox row_no='.$country->id.' style='.$unfavdisplay.'>';
									echo $this->Html->image('favorite.png',['url'=>['controller'=>'Items','action'=>'unfavorite',$country->id],'class'=>'tooltips markunFav','data-original-title'=>'Remove from favorite list','data-container'=>'body','row_no'=>$country->id]);
									echo '</span>';
								}
								?>

								<?= $this->Html->link('Copy', '/Items/add/'.$country->id.'/copy', ['class'=>'btn btn-xs blue']) ?>
							    
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