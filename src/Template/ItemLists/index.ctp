<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Daily Inventory Item Master  | DOSA PLAZA'); ?>
<!-- BEGIN PAGE CONTENT-->
<div class="row" style="margin-top:15px;">
    <div class="col-md-6">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <?php if(!empty($id)){ ?>
                        Edit Daily Inventory Item
                    <?php }else{ ?>
                        Add Daily Inventory Item
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
                    <?= $this->Form->create($itemList,['id'=>'CountryForm']) ?>
                        <div class="form-group">
                            <label class="control-label col-md-4">Name  <span class="required"> * </span>
                            </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" <?php if(!empty($id)){ echo "value='".$itemList->name."'"; } ?> name="name" class="form-control" Placeholder="Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Unit  <span class="required"> * </span>
                            </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" <?php if(!empty($id)){ echo "value='".$itemList->unit."'"; } ?> name="unit" class="form-control" Placeholder="Unit">
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
                    Daily Inventory Item List 
                </div>
                <div class="tools"> 
                    <input id="search3"  class="form-control" type="text" placeholder="Search" >
                </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-str table-hover"  >
                    <thead>
                        <tr>
                            <th scope="col"><?= ('S.No') ?></th> 
                            <th scope="col"><?= ('Name') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody id="main_tbody">
                        <?php foreach ($itemLists as $itemList): ?>
                        <tr>
                            <td><?= h($itemList->name) ?></td>
                            <td><?= h($itemList->unit) ?></td>
                            <td class="actions">
                                <?php
                                echo $this->Html->link('Edit ', '/ItemLists/index/'.$itemList->id, ['class' => 'btn btn-xs blue showLoader']);
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

