<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Expense-Heads | DOSA PLAZA'); ?>
<!-- BEGIN PAGE CONTENT-->
<div class="row" style="margin-top:15px;">
    <div class="col-md-6">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <?php if(!empty($id)){ ?>
                        Edit Expense-Head
                    <?php }else{ ?>
                        Add Expense-Head
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
                    <?= $this->Form->create($expanseHead,['id'=>'CountryForm']) ?>
                        <div class="form-group">
                            <label class="control-label col-md-4">Expense-Head  <span class="required"> * </span>
                            </span>
                            </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" value="<?php echo @$expanseHead->name; ?>" name="name" class="form-control" Placeholder="Enter Expense-Head">
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
                     Expanse-Heads
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
                        <?php $x=0; foreach ($expanseHeads as $expanseHead): ?>
                        <tr>
                            <td><?= ++$x; ?></td> 
                            <td><?= h($expanseHead->name) ?></td>
                            <td class="actions">
                                  <?php 
                                  echo $this->Html->image('edit.png',['url'=>['controller'=>'ExpanseHeads','action'=>'index',$expanseHead->id],'class'=>'tooltips showLoader','data-original-title'=>'Edit Category','data-container'=>'body']);
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
<!-- BEGIN PAGE LEVEL STYLES -->
    

<!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- BEGIN VALIDATEION -->
    <?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
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

