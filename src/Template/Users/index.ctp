<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Users | DOSA PLAZA'); ?>
<!-- BEGIN PAGE CONTENT-->
<div class="row" style="margin-top:15px;">
    <div class="col-md-6">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <?php if(!empty($id)){ ?>
                        Edit User
                    <?php }else{ ?>
                        Add User
                    <?php } ?>
                </div>
                <div class="tools">
                    
                </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="">
                    <?= $this->Form->create($user,['id'=>'CountryForm']) ?>
                       
					   <div class="form-group">
							<label class="control-label col-md-4"> Employee <span class="required" name="dName" >
							 *</span>
							</label>
							<div class="col-md-8">
								<div class="input-icon right">
									<i class="fa"></i>
									<?php echo $this->Form->input('employee_id',['options' =>$employees,'label' => false,'class'=>'form-control select2me','empty'=> 'Select...','required'=>'required', 'value'=>$user->employee_id]);?>
								</div>
							</div>
						</div>
					   
					   

                        <div class="form-group">
                            <label class="control-label col-md-4">Username  <span class="required"> * </span>
                            </span>
                            </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" <?php if(!empty($id)){ echo "value='".$user->username."'"; } ?> name="username" class="form-control" Placeholder="Username" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">Password  <span class="required"> * </span>
                            </span>
                            </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="password" name="password" class="form-control" Placeholder="Password" required="required">
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
                     Users
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
                            <th scope="col"><?= ('Name') ?></th>
                            <th scope="col"><?= ('username') ?></th>
							<th scope="col"><?= ('Employee') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= h($user->employee->name) ?></td>
                            <td><?= h($user->username) ?></td>
							<td><?= h($user->employee->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Edit'), ['action' => 'index', $user->id]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
<!-- BEGIN PAGE LEVEL STYLES -->
    

<!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- BEGIN VALIDATEION -->
    <?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <!-- END VALIDATEION --> 
<!-- END PAGE LEVEL SCRIPTS -->

<?php 
$js='
$(document).ready(function() {
    jQuery(".loadingshow").submit(function(){
        jQuery("#loader-1").show();
    });
     
    
    //-- Validation
    var form2 = $("#CountryForm");
    var error2 = $(".alert-danger", form2);
    var success2 = $(".alert-success", form2);

    form2.validate({
        errorElement: "span", //default input error message container
        errorClass: "help-block help-block-error", // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        rules: {
            name: { 
                required: true, 
            },
        },

         

        errorPlacement: function (error, element) { // render error placement for each input type
            var icon = $(element).parent(".input-icon").children("i");
            icon.removeClass("fa-check").addClass("fa-warning");  
            icon.attr("data-original-title", error.text()).tooltip({"container": "body"});
        },

        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest(".form-group").removeClass("has-success").addClass("has-error"); // set error class to the control group   
        },
        success: function (label, element) {
            var icon = $(element).parent(".input-icon").children("i");
            $(element).closest(".form-group").removeClass("has-error").addClass("has-success"); // set success class to the control group
            icon.removeClass("fa-warning").addClass("fa-check");
        },

        submitHandler: function (form) {
            
            success2.show();
            $("#loading").show();
            error2.hide();
            
            form[0].submit(); // submit the form
        }
    });     
 });';
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>

