<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Expense Voucher | DOSA PLAZA'); ?>
<!-- BEGIN PAGE CONTENT-->
<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">Add Expense Voucher</div>
                <div class="tools"> </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="">
                    <?= $this->Form->create($expanseVoucher,['id'=>'form_sample_1']); ?>
                    <div class="row">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="form-group col-md-4">
                            <label class="control-label col-md-12"> 
                                Transaction Date <span class="required" aria-required="true">*</span>
                            </label>
                            <div class=" ">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="date" name="transaction_date" class="form-control" required="required" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-12"> 
                                Narration <span class="required" aria-required="true">*</span>
                            </label>
                            <div class=" ">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <textarea style="resize:none" name="narration" class="form-control" required="required"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="col-md-1">&nbsp;</div>
                   <div class="col-md-10" style="margin-top:10px;" id="main">
                        <table class="table table-bordered" id="main_table">    
                            <thead class="bg_color">
                                <tr align="">
                                    <th style="text-align:left; width: 5%;">Sr</th>
                                    <th style="text-align:left;">Expanse Head</th>
                                    <th style="text-align:left;width:15%">Amount</th> 
                                    <th style="width: 5%;">Action</th>
                                </tr> 
                            </thead>
                            <tbody id="main_tbody">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan=""><?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-primary btn-xs add_row','type'=>'button']); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="form-actions ">
                        <div class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <hr>
                                <?php echo $this->Form->button('Submit',['class'=>'btn btn-danger']); ?> 
                            </div>
                        </div>
                    </div>   
                    <?= $this->Form->end() ?>
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- BEGIN PAGE LEVEL STYLES -->
<!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- BEGIN VALIDATEION -->
    <?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>

    <!-- END VALIDATEION --> 
<!-- END PAGE LEVEL SCRIPTS -->

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
            name: { 
                required: true 
            },
            narration:{
                required: true,
            }
             
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


    $(document).on('click', '.add_row', function(e)
    { 
        add_row();
    });
    $(document).on('click', '.remove_row', function(e)
    { 
        var x=0;
        $('#main_table tbody#main_tbody tr.main_tr').each(function(){
            x++;
        });
        if(x>1){
            $(this).closest('tr.main_tr').remove();
        }
        rename_rows();
    });

    add_row();
    function add_row(){ 
        var tr=$('#sample tbody tr.main_tr').clone();
        $('#main_table tbody#main_tbody').append(tr);
        rename_rows();
    }

    function rename_rows(){
        var i=0;
        $('#main_table tbody#main_tbody tr.main_tr').each(function(){
            $(this).find('td:nth-child(1)').html(i+1);
            $(this).find('td:nth-child(2) select').select2().attr({name:'expanse_voucher_rows['+i+'][expanse_head_id]', id:'expanse_voucher_rows-'+i+'-expanse_head_id'});
            $(this).find('td:nth-child(3) input').attr({name:'expanse_voucher_rows['+i+'][amount]', id:'expanse_voucher_rows-'+i+'-amount'});
            i++;
        });
    }

});


";
?>


<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>
<style>
.btn-sets{
    
}
</style>

<table id="sample" style="display:none;"  width="1500px">
    <tbody class="table_br">
        <tr class="main_tr">
            <td style="vertical-align: top !important;"></td>
            <td>
                <?php echo $this->Form->input('expanse_head_id',['options'=>$ExpanseHeads,'class'=>'form-control expanse_head_id','empty' => '--Select Head--','label'=>false,'required'=>'required']); ?>
            </td>
            <td width="20%" >
                <?php echo $this->Form->control('amount', ['label' => false, 'placeholder'=>'0.00','class'=>'form-control rightAligntextClass','required'=>'required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>
            </td>
            <td width="20%">
                <?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-times']),['class'=>'btn  btn-danger btn-xs remove_row','type'=>'button']); ?>
            </td>
        </tr>
    </tbody>        
</table>