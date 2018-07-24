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
<div class="col-md-12">
	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">
				Add
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
				<div class="form-group col-md-6">
					<label class="control-label col-md-12"> Name </label>
					<div class ="row">
						<div class="col-md-12">
							<?php echo $this->Form->control('name',['class'=>'form-control  ','label'=>false,'placeholder'=>'Enter RawMaterials']); ?>
						</div>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="control-label col-md-12"> Tax </label>
					<div class="row">
						<div class="col-md-12">
							<?php echo $this->Form->input('tax_id',['options' =>$Taxes,'label' => false,'class'=>'form-control select2 ','empty'=> 'Select...']);?>
						</div>
					</div>	
				</div>

				<div class="form-group col-md-5">
					<label class="control-label col-md-12"> Primary Unit </label>
					<div class ="row">
						<div class="col-md-12">
							<?php echo $this->Form->input('tax_id',['options' =>$units,'label' => false,'class'=>'form-control select2 ','empty'=> 'Select...']); ?>
						</div>
					</div>
				</div>

				<div class="form-group col-md-2">
					<label>&nbsp;</label>
					<div class="checkbox-list">
						<label class="checkbox-inline">
						<input type="checkbox" name="has_secondary_unit" id="alterneteunit" value="1">Alternate Unit </label> 
					</div>
				</div>
				 
				<div class="form-group col-md-5">
					<label class="control-label col-md-12"> Secondary Unit </label>
					<div class="row">
						<div class="col-md-12">
							<?php echo $this->Form->input('tax_id',['options' =>$units,'label' => false,'class'=>'form-control select2 ','empty'=> 'Select...']);?>
						</div>
					</div>	
				</div>

				 
				<div class="form-group col-md-5">
										<label for="exampleInputPassword1">Where</label>
										<div class="input-group">
											<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
											<span class="input-group-addon">
											<i class="fa fa-user"></i>
											</span>
										</div>
									</div>


				<div class="form-group col-md-2">
					<label>&nbsp;</label>
					<div align="center">
						=
					</div>
				</div>

				<div class="form-group col-md-5">
					<label class="control-label col-md-12"> Equeal To </label>
					<div class="row">
						<div class="col-md-12">
							<?php echo $this->Form->control('dd',['class'=>'form-control  ','label'=>false,'placeholder'=>'Equal to Primary Unit','value'=>'1','readonly'=>'readonly']); ?>
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
	

	
