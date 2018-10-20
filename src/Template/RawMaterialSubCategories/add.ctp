<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Raw-Material-Sub-Category | DOSA PLAZA'); ?>
<!-- BEGIN PAGE CONTENT-->
<div class="row" style="margin-top:15px;">
    <div class="col-md-6">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <?php if(!empty($id)){ ?>
                        Edit Sub Raw Material Category
                    <?php }else{ ?>
                        Add Sub Raw Material Category
                    <?php } ?>
                </div>
                <div class="tools">
                    <?php if(!empty($id)){ ?>
                        <?php echo $this->Html->link('<i class="fa fa-plus"></i> Add ','/ItemSubCategories/add/',array('escape'=>false,'style'=>'color:#fff'));?>
                    <?php }?>
                </div>
                <div class="row">   
                    <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="">
                    <?= $this->Form->create($rawMaterialSubCategory,['id'=>'CountryForm']) ?>
                        <div class="form-group">
                            <label class="control-label col-md-4"> Sub Category <span class="required" >*
                             </span>
                            </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" <?php if(!empty($id)){ echo "value='".$rawMaterialSubCategory->name."'"; } ?> name="name" class="form-control  " Placeholder="Enter Sub Category Name">
                                </div>
                            </div>
                        </div>
                        <span class="help-block">&nbsp;</span>
                        <div class="form-group">
                            <label class="control-label col-md-4"> Select Category <span class="required" >*
                             </span></label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <?php echo $this->Form->input('raw_material_category_id',['options' =>$rawMaterialCategories,'label' => false,'class'=>'form-control select2 selectState','empty'=> 'Select...']);?>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 " style="text-align:center;">
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
        <div class="portlet  box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                     Sub Raw Material Category List
                </div>
                <div class="tools"> 
                    <input id="search3"  class="form-control" type="text" placeholder="Search" >
                </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-str " cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"><?= ('S.No') ?></th> 
                            <th scope="col"><?= ('Name') ?></th>
                            <th scope="col"><?= ('Item Category') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody id="main_tbody">
                        <?php $x=0; foreach ($rawMaterialSubCategories as $country): ?>
                        <tr>
                            <td><?= ++$x; ?></td> 
                            <td><?= h($country->name) ?></td>
                            <td><?= h($country->raw_material_category->name) ?></td>
                            <td class="actions">
                                 <?php
                                    if($country->is_deleted==0){
                                     echo $this->Html->image('edit.png',['url'=>['controller'=>'RawMaterialSubCategories','action'=>'add',$country->id],'class'=>'tooltips showLoader','data-original-title'=>'Edit Category','data-container'=>'body']);?>
                                    <?php echo $this->Html->image('lock.png',['data-target'=>'#deletemodal'.$country->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Freeze Category','data-container'=>'body']);
                                    } else { ?>
                                        <?php echo $this->Html->image('unlock.png',['data-target'=>'#undeletemodal'.$country->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Unfreeze Category','data-container'=>'body']);
                                    }
                                    ?>
                                <div id="deletemodal<?php echo $country->id; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-md" >
                                        <form method="post" action="<?php echo $this->Url->build(array('controller'=>'RawMaterialSubCategories','action'=>'delete',$country->id)) ?>">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                    <h4 class="modal-title">
                                                    Are you sure you want to freeze this Category?
                                                    </h4>
                                                </div>
                                                <div class="modal-footer"style="border:none;">
                                                    <button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
                                                    <button type="button" class="btn  btn-sm" data-dismiss="modal" style="color:#000000">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="undeletemodal<?php echo $country->id; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-md" >
                                        <form method="post" action="<?php echo $this->Url->build(array('controller'=>'RawMaterialSubCategories','action'=>'undelete',$country->id)) ?>">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                    <h4 class="modal-title">
                                                    Are you sure you want to unfreeze this Category?
                                                    </h4>
                                                </div>
                                                <div class="modal-footer"style="border:none;">
                                                    <button type="submit" class="btn  btn-sm btn-danger showLoader">Yes</button>
                                                    <button type="button" class="btn  btn-sm" data-dismiss="modal" style="color:#000000">Cancel</button>
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
            raw_material_category_id: { 
                required: true 
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
            error2.hide();
            $("#loading").show();
            form[0].submit(); // submit the form
        }
        
    });  

    var rows = $("#main_tbody tr");
    $("#search3").on("keyup",function() {
        var val = $.trim($(this).val()).replace(/ +/g, " ").toLowerCase();
        var v = $(this).val();
        
        if(v){
            rows.show().filter(function() {
                var text = $(this).text().replace(/\s+/g, " ").toLowerCase();
    
                return !~text.indexOf(val);
            }).hide();
        }else{
            rows.show();
        }
    }); 
       
 });';
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>
