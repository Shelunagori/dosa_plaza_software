<?php echo $this->Html->css('mystyle'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="caption top-caption">
				<span>Add Raw Material</span>
			</div>
		</div>
	</div>
</div>	
<div class="col-md-6">
	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">
				Add Raw Material
			</div>
			<div class="tools">
				<?php if(!empty($id)){ ?>
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add ','/RawMaterials/add/',array('escape'=>false,'style'=>'color:#fff'));?>
					<?php }?>
			</div>
			<div class="row">	
				<div class="col-md-12 horizontal "></div>
			</div>
		</div>
		<div class="portlet-body">
			<?= $this->Form->create($rawMaterial, ['id'=>'configform']) ?>
				<div class="form-group">
					<label class="control-label col-md-4"> Name </label>
					<div class ="row">
						<div class="col-md-8">
							<?php echo $this->Form->control('name',['class'=>'form-control  ','label'=>false,'placeholder'=>'Enter RawMaterials']); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12"></div>
				</div>
				<label class="control-label col-md-4"> Tax </label>
				<div class="row">
					<div class="col-md-8">
						<?php echo $this->Form->input('tax_id',['options' =>$Taxes,'label' => false,'class'=>'form-control select2 ','empty'=> ' --select Tax--']);?>
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
	

	
