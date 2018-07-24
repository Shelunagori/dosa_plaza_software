<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="caption top-caption">
				<span>Add Tables</span>
			</div>
		</div>
	</div>
</div>	
<div class="row">
	<div class="col-md-6">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<?php if(!empty($id)){ ?>
						Edit Category
					<?php }else{ ?>
						Add Tables
					<?php } ?>
				</div>
				<div class="tools">
					<?php if(!empty($id)){ ?>
						<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add ','/ItemCategories/add/',array('escape'=>false,'style'=>'color:#fff'));?>
					<?php }?>
				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="">
					<?= $this->Form->create($table,['id'=>'CountryForm']) ?>
						<div class="form-group">
							<label class="control-label col-md-4"> Name <span class="required" aria-required="true">
							</span>
							</label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" <?php if(!empty($id)){ echo "value='".$itemCategory->name."'"; } ?> name="name" class="form-control" Placeholder="Table Name">
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-6 col-md-9">
									<?php echo $this->Form->button('SUBMIT',['class'=>'btn btn-danger']); ?> 
								</div>
							</div>
						</div>
 					<?= $this->Form->end() ?>
				</div> 
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Tables List
				</div>
				<div class="tools"> 
 				</div>
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-str table-hover " cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No') ?></th> 
							<th scope="col"><?= ('Name') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $x=0; foreach ($tables as $table): ?>
						<tr>
							<td><?= ++$x; ?></td> 
							<td><?= h($table->name) ?></td>
							<td class="actions">
								<?php //echo $this->Html->link('<img src="",height="34",width="38"/>','/ItemSubCategories/add/'.$country->id,array('escape'=>false,));?>
								<?php echo $this->Html->image('edit.png',['url'=>['controller'=>'tables','action'=>'add',$table->id]]);?>
								<?php echo $this->Html->image('delete.png',['data-target'=>'#deletemodal'.$table->id,'data-toggle'=>'modal']);?>
								
							
								<div id="deletemodal<?php echo $table->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'tables','action'=>'delete',$table->id)) ?>">
											<div class="modal-content">
											<div class="modal-header">
													<h4 class="modal-title">
													Are you sure you want to remove this Category?
													</h4>
											</div>
												<div class="modal-footer"style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger">Yes</button>
													<button type="button" class="btn  btn-sm" data-dismiss="modal" style="color:#000000">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							   <?php  $this->Form->PostLink('<i class="fa fa-trash"></i>','/Countries/delete/'.$table->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $table->id)));?>
							</td>
						</tr>
						<?php endforeach; ?> 
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>	
<style>
	.portlet.light{
		padding: 14px 20px 14px 25px !important;
		margin: 0px 0px 15px !important;
	}
	.horizontal{
		   
			border-top: solid 2px  #eee !important;
			border-bottom: 0;
	}
	.form-actions{
		    padding: 71px 71px 18px 71px
	}
	.portlet.box.blue-hoki > .portlet-title > .caption {
		color: #F3565D;
    }
	.portlet.box>.portlet-title>.caption {
		padding: 13px 0 11px 18px;
	}
	.portlet.box.blue-hoki > .portlet-title {
		background-color: #FFFFFF;
		padding-left:0;
		padding-right:0;
	}
	.table>thead>tr>th{
		border-bottom: 1px solid #eee;
		color: black;
		font-weight:500;
	}
</style>