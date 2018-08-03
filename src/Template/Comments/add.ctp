<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Comments/dosa_plaza_software'); ?>

<div class="row" style="margin-top:15px;">
	<div class="col-md-6">
		<!-- BEGIN ALERTS PORTLET-->
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<?php if(!empty($id)){ ?>
						Edit Comments
					<?php }else{ ?>
						Add Comments
					<?php } ?>
				</div>
				
				<div class="row">	
						<div class="col-md-12 horizontal "></div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="">
					<?= $this->Form->create($comment,['id'=>'form_sample_1']) ?>
						<div class="form-group">
							<label class="control-label col-md-4"style="padding-left:34px;">Comment <span class="required"> * </span></label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" value="<?php echo @$comment->comment; ?>" name="comment" class="form-control" required Placeholder="Enter Comments Name">
									 
								</div>
							</div>
						</div>
						<div class="form-actions ">
							<div class="row">
								<div class="col-md-12" style=" text-align: center;">
									<hr></hr>
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
					 Comments List
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
							<th scope="col"><?= ('comment') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $x=0; foreach ($Comments as $comment): ?>
						<tr>
							<td><?= ++$x; ?></td> 
							<td><?= h($comment->comment) ?></td>
							<td class="actions">
								<?php echo $this->Html->image('edit.png',['url'=>['controller'=>'Comments','action'=>'add',$comment->id]]);?>
								<?php echo $this->Html->image('delete.png',['data-target'=>'#deletemodal'.$comment->id,'data-toggle'=>'modal','class'=>'pointer']);?>
								<div id="deletemodal<?php echo $comment->id; ?>" class="modal fade " role="dialog">
									<div class="modal-dialog modal-md" >
										<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Comments','action'=>'delete',$comment->id)) ?>">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">
														Are you sure you want to Delete this comment?
													</h4>
												</div>
												<div class="modal-footer" style="border:none;">
													<button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color: #000000;    background-color: #DDDDDD;">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							   <?php  $this->Form->PostLink('<i class="fa fa-trash-o"></i>','/Countries/delete/'.$comment->id,array('escape'=>false,'class'=>'btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $comment->id)));?>
							</td>
						</tr>
						<?php endforeach; ?> 
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
 <?php
$js="
	var form3 = $('#form_sample_1');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		rules: {
			name: { 
				required: true, 
			},
			tax_id: { 
				required: true, 
			},
			primary_unit_id: { 
				required: true, 
			},
			secondary_unit_id: { 
				required: true, 
			},
			formulas: { 
				required: true, 
			}, 
		},

		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent('.input-group').size() > 0) {
				error.insertAfter(element.parent('.input-group'));
			} else if (element.attr('data-error-container')) { 
				error.appendTo(element.attr('data-error-container'));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr('data-error-container'));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr('data-error-container'));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr('data-error-container'));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr('data-error-container'));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},

		invalidHandler: function (event, validator) { //display error alert on form submit   
			success3.hide();
			error3.show();
		},

		highlight: function (element) { // hightlight error inputs
		   $(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},

		unhighlight: function (element) { // revert the change done by hightlight
			$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
		},

		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},

		submitHandler: function (form) {
			success3.show();
			error3.hide();
			$('#loading').show();
			form[0].submit(); // submit the form
		}

	}); 
";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>