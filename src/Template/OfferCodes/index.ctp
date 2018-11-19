<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Offer Codes | DOSA PLAZA'); ?>
<!-- BEGIN PAGE CONTENT-->
<div class="row" style="margin-top:15px;">
    <div class="col-md-6">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    Create Offer Code
                </div>
                <div class="tools">
                    <?php if(!empty($id)){ ?>
                        <?php echo $this->Html->link('<i class="fa fa-plus"></i> Add ','/offerCodes/index',array('escape'=>false,'style'=>'color:#fff'));?>
                    <?php }?>
                </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="">
                    <?= $this->Form->create($offerCode,['id'=>'form_sample_1']) ?>
                        <div class="form-group">
                            <label class="control-label col-md-4">Offer Name  <span class="required"> * </span></label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" name="offer_name" class="form-control" Placeholder="Enter Offer Name" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Offer Code  <span class="required"> * </span></label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" name="offer_code" class="form-control" Placeholder="Enter Offer Code" required="required" style="text-transform:uppercase" pattern="^\S+$">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Discount Percentage <span class="required"> * </span></label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" name="discount_per" class="form-control" Placeholder="Enter Discount Percentage" required="required">
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
                     Offer Code
                </div>
                <div class="tools"> 
                    <input id="search3"  class="form-control" type="text" placeholder="Search" >
                </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-str table-hover " cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Offer ID</th>
                            <th>Offer Name</th>
                            <th>Offer Code</th>
                            <th>Discount Percentage</th>
                             <th>Status</th>
                            <th><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody id="main_tbody">
                        <?php foreach ($offerCodes as $offerCode): ?>
                        <tr>
                            <td><?= $this->Number->format($offerCode->id) ?></td>
                            <td><?= h($offerCode->offer_name) ?></td>
                            <td><?= h($offerCode->offer_code) ?></td>
                            <td style="text-align: center;"><?= $this->Number->format($offerCode->discount_per) ?>%</td>
                            <td><?php echo ($offerCode->is_enabled==1)?'Enabled':'Disabled' ?></td>
                            <td class="actions">
                                <?php if($offerCode->is_enabled==1){ ?>
                                    <?= $this->Html->link(__('Disable'), ['action' => 'disable', $offerCode->id],['class'=>'showLoader' ]) ?>
                                <?php } ?>
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
$(document).ready(function() {
    var form3 = $('#form_sample_1');
    var error3 = $('.alert-danger', form3);
    var success3 = $('.alert-success', form3);
    form3.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        rules: {

            discount_per: { 
                required: true,
                digits: true
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

    var rows = $('#main_tbody tr');
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