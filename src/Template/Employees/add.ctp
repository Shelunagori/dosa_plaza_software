<div class="row">
	<div class="col-md-6">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i><?= __('Add Employee') ?>
				</div>
			</div>
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<?= $this->Form->create($employee , ['class' => 'form-horizontal' , 'id' => 'form_sample_2'])?>
				<div class="form-body">
					<div class="form-group">
						<label class="control-label col-md-3">Employee Name</label>
						<div class="col-md-6">
							<div class="input-icon right">								 
								<?= $this->Form->Control('name',['class' => 'form-control','placeholder'=>'Enter Employee Name','label'=>false]) ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">User Name</label>
						<div class="col-md-6">
							<div class="input-icon right">								 
								<?= $this->Form->Control('username',['class' => 'form-control','placeholder'=>'Enter User Name','label'=>false]) ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Password</label>
						<div class="col-md-6">
							<div class="input-icon right">								 
								<?= $this->Form->Control('password',['class' => 'form-control','placeholder'=>'Enter Password','label'=>false]) ?>
							</div>
						</div>
					</div>
					<div class="col-md-offset-5 col-md-6" style="">
						<?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
						<?= $this->Form->button(__('Cancel'),['class' => 'btn default']) ?>								 
					</div>
					</br>
					</br>
				</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
            <!-------------------------- View------------>
	<div class="col-md-6">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>View Employee
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>S/No.</th>
								<th>Name</th>
								<th>User Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i=0;
							foreach ($employees as $employee):
							$i++;	
							?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= h($employee->name) ?></td>
								<td><?= h($employee->username) ?></td>
								<td class="actions">
								<!--<?= $this->Html->link(__('View'), ['action' => 'view', $employee->id]) ?>-->
								<?= $this->Html->link(__(''), ['action' => 'edit', $employee->id],['class'=>'btn btn-success fa fa-edit'],'i') ?>
								<?= $this->Form->postLink(__(''), ['action' => 'delete', $employee->id],['class'=>'btn btn-danger fa fa-trash'],'i') ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>	
</div>
			
			
<!---			
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Add Employee') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('username');
            echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>-->

