<?php echo $this->Html->css('mystyle'); ?>
<style>
    .help-block-error{
        font-size: 12px; 
    }
</style>
<div style="height: 10px;" >.</div>
<div class="row">
    <div class="col-md-12 main-div">
        <div class= "portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    Stock In Voucher Edit: <?= h($purchaseVoucher->voucher_no) ?>
                </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <?= $this->Form->create($purchaseVoucher, ['id'=>'form_sample_1']) ?>
            <div class="portlet-body">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label class="control-label" style="padding:0;">Transaction Date <span class="required">* </span></label>
                        <input class="form-control input-sm" type="date" name="transaction_date" required value="<?php echo date('Y-m-d', strtotime($purchaseVoucher->transaction_date)); ?>" /> 
                    </div>  
                    <div class="form-group col-md-4">
                        <label class="control-label" style="padding:0;">Vendors <span class="required" required name="vandors">*</span></label>
                        <?php echo $this->Form->input('vendor_id',['options' =>$Vendors,'label' => false,'class'=>'form-control input-sm  select2me ','empty'=> '--select--','required'=>'required']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="margin-top:10px;" id="main">
                        <table class="table table-bordered" id="main_table">    
                            <thead class="bg_color">
                                <tr align="center">
                                    <th rowspan="2" style="text-align:left;">Sr</th>
                                    <th rowspan="2" style="text-align:left;">Item</th>
                                    <th rowspan="2" style="text-align:left;">Quantity</th>
                                    <th rowspan="2" style="text-align:left;">Unit</th>
                                    <th rowspan="2" style="text-align:left;">Rate</th>
                                    <th colspan="2" style="text-align:center;">Discount</th>
                                    <th rowspan="2" style="text-align:left;"> Taxable Value</th>
                                    <th colspan="2" style="text-align:center;"> GST</th>
                                    <th rowspan="2" style="text-align:left;"> Round off </th>
                                    <th rowspan="2" style="text-align:left;">Total </th>
                                    <th rowspan="2" style="text-align:left;">Action</th>
                                </tr>
                                <tr>
                                    <th><div align="center">%</div></th>
                                    <th><div align="center">Rs</div></th>
                                    <th><div align="center">%</div></th>
                                    <th><div align="center">RS</div></th>
                                </tr>
                                
                            </thead>
                            <tbody id="main_tbody">
                                <?php 
                                $c=0;
                                foreach ($purchaseVoucher->purchase_voucher_rows as $purchase_voucher_row) { ?>
                                    <tr class="main_tr">
                                        <td style="vertical-align: top !important;">
                                            <?php echo ++$c; ?>
                                        </td>
                                        <td width="15%" align="left">
                                            <?php echo $this->Form->input('raw_material_id',['options'=>$option,'class'=>'form-control input-sm select2 raw_material ','empty' => '--Select Item--','label'=>false,'required'=>'required', 'value' => $purchase_voucher_row->raw_material_id]); ?>
                                            <input type="hidden" class="purchase_voucher_row_id" value="<?php echo $purchase_voucher_row->id; ?>" /> 
                                        </td>
                                        <td width="5%" align="center">
                                            <?php echo $this->Form->input('quantity', ['label' => false,'placeholder'=>'Qty','class'=>'form-control input-sm quantity rightAligntextClass','required'=>'required', 'value' => $purchase_voucher_row->quantity]); ?>
                                        </td>
                                        <td width="5%" align="center"></td>

                                        <td width="8%" align="center">
                                            <?php echo $this->Form->input('rate',['class'=>'form-control input-sm rate numberOnly rightAligntextClass','placeholder'=>'Rate','label'=>false,'required'=>'required', 'value' => $purchase_voucher_row->rate]); ?>
                                        </td>       
                                        <td width="8%" align="center">
                                            <?php echo $this->Form->input('discount_per',['class'=>' discount_per form-control input-sm discount_per numberOnly rightAligntextClass','label'=>false, 'value' => $purchase_voucher_row->discount_per]); ?>
                                        </td>
                                        <td  width="10%" align="center">
                                            <?php echo $this->Form->input('discount_amt', ['style'=>'text-align:right','label' => false,'class' => 'discount_amt form-control input-sm numberOnly','type'=>'text', 'value' => $purchase_voucher_row->discount_amt]);
                                            ?>  
                                        </td>
                                        <td  width="10%" align="center">
                                            <?php echo $this->Form->input('taxable_value', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm taxable_value','type'=>'text', 'value' => $purchase_voucher_row->taxable_value]);
                                            ?>  
                                        </td>
                                        <td  width="6%" align="center">
                                            <?php echo $this->Form->input('tax_per', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm  tax_per  numberOnly ','type'=>'text','value'=>0, 'readonly', 'tabindex' => '-1', 'value' => $purchase_voucher_row->tax_per]);
                                            ?>  
                                        </td>
                                        <td  width="10%" align="center">
                                            <?php echo $this->Form->input('tax_amt', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm  tax_amt numberOnly','type'=>'text','value'=>0, 'readonly', 'tabindex' => '-1', 'value' => $purchase_voucher_row->tax_amt]);
                                            ?>  
                                        </td>
                                        <td  width="7%" align="center">
                                            <?php echo $this->Form->input('round_off', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm round_off','placeholder'=>'','type'=>'text', 'value' => $purchase_voucher_row->round_off]);
                                            ?>  
                                        </td>
                                        <td  width="15%" align="center">
                                            <?php echo $this->Form->input('net_amt_total', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm net_amt_total','type'=>'text', 'value' => $purchase_voucher_row->net_amt_total]);
                                            ?>  
                                        </td>
                                        <td>
                                            <?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-times']),['class'=>'btn  btn-danger btn-xs remove_row','type'=>'button', 'value' => $purchaseVoucher->grand_total ]); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']).'Add Row',['class'=>'btn btn-primary btn-xs add_row','type'=>'button']); ?></td>
                                    <td  colspan="9" style ="text-align:right; font-weight:bold;">Grand Total</td>
                                    <td>
                                        <?php echo $this->Form->input('grand_total', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm grand_total','type'=>'text','readonly'=>'readonly', 'tabindex' => '-1']); ?>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="box-footer"  style="text-align:center;padding-bottom: 18px;">
                    <button type="submit" class="btn btn-danger" id="order_btn" value="submit">SUBMIT</button>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<!-- BEGIN PAGE LEVEL STYLES -->
    <!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- BEGIN COMPONENTS PICKERS -->
    <?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <!-- END COMPONENTS PICKERS -->
    
    <!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>           
    <!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
    <!-- BEGIN COMPONENTS PICKERS -->
    <?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?> 
    <!-- END COMPONENTS PICKERS -->

    <!-- BEGIN COMPONENTS DROPDOWNS -->
     
    <?php echo $this->Html->script('/assets/admin/pages/scripts/components-dropdowns.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- BEGIN VALIDATEION -->
    <?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
    <?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
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
                    transaction_date:{
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
                form[0].submit(); // submit the form
            }

        });
        jQuery.extend(jQuery.validator.messages, {
            required: 'Required.',
        });
            
        $(document).on('click', '.add_row', function(e){ 
            add_row();
        });


        function add_row(){
            var tr=$('#sample tbody tr.main_tr').clone();
            $('#main_table tbody#main_tbody').append(tr);
        
            rename_rows();
        }
        
        $(document).on('keyup','.quantity,  .rate, .round_off', function(e){
            calculation();
        });
        $(document).on('change','.raw_material', function(e){
            calculation();
        });


        function calculation(){
            var total_amount_fixed=0;
            var grand_total = 0;
            var Total_amount=0;
            $('#main_table tbody#main_tbody tr.main_tr').each(function()
            {
                var unit_name     = $(this).closest('tr').find('select.raw_material option:selected').attr('unit_name');
                $(this).closest('tr').find('td:nth-child(4)').html(unit_name);

                var qty           = parseFloat($(this).closest('tr').find('input.quantity').val());
                if(isNaN(qty)){ qty=0; }
                var rate          = parseFloat($(this).closest('tr').find('input.rate').val());
                if(isNaN(rate)){ rate=0; }
                var discount_Rs   = parseFloat($(this).closest('tr').find('input.discount_amt').val());
                if(isNaN(discount_Rs)){ discount_Rs=0; }
                var round_off     = parseFloat($(this).closest('tr').find('input.round_off').val());
                if(isNaN(round_off)){ round_off=0; }


                if(!isNaN(qty) && !isNaN(rate))
                { 
                    var finalAmt = 0; 
                    var amount   = qty*rate;                        
                    if(discount_Rs)
                    {   
                        var finalAmt  = amount - discount_Rs;
                    }
                    else
                    {
                        finalAmt = amount;
                    }
                    finalAmt =  round(finalAmt,2);

                    $(this).closest('tr').find('input.taxable_value').val(finalAmt);
                }
            
                var tax     = $(this).closest('tr').find('select.raw_material option:selected').attr('tax');
                $(this).closest('tr').find('input.tax_per').val(tax);
                var gstamt =(finalAmt*tax)/100;
                gstamt     = round(gstamt,2);
                if(isNaN(gstamt))
                {
                    gstamt=0;
                }
                $(this).closest('tr').find('input.tax_amt').val(gstamt);
                var Total_amount   = finalAmt+gstamt+round_off;
                Total_amount= round(Total_amount,2);
                Total_amount =round(Total_amount,2);

                $(this).closest('tr').find('input.net_amt_total').val(Total_amount); 
                
                grand_total += Total_amount;
            
            });
            $('.grand_total').val(round(grand_total,2));
        }
          
        $(document).on('keyup','.discount_per',function(e){
            var qty           = parseFloat($(this).closest('tr').find('input.quantity').val());
            if(isNaN(qty)){ qty=0; }

            var rate          = parseFloat($(this).closest('tr').find('input.rate').val());
            if(isNaN(rate)){ rate=0; }

            var discount_per  = parseFloat($(this).closest('tr').find('input.discount_per').val());
            if(isNaN(discount_per)){ discount_per=0; }
            
            var amount   = qty*rate;                        
            if(discount_per)
            {   
                var disAmt    = (amount*discount_per)/100;
                disAmt  = round(disAmt,2);
            
            }
            $(this).closest('tr').find('input.discount_amt').val(disAmt);
            calculation();
        });
         
        $(document).on('keyup','.discount_amt',function(e){
            var qty           = parseFloat($(this).closest('tr').find('input.quantity').val());
            if(isNaN(qty)){ qty=0; }

            var rate          = parseFloat($(this).closest('tr').find('input.rate').val());
            if(isNaN(rate)){ rate=0; }

            var discount_amt  = parseFloat($(this).closest('tr').find('input.discount_amt').val());
            if(isNaN(discount_amt)){ discount_amt=0; }
            
            var amount   = qty*rate;

            if(discount_amt && amount>0)
            {   
                var dis_per   = (discount_amt*100)/amount;
                dis_per = round(dis_per,2);
                
            }
            $(this).closest('tr').find('input.discount_per').val(dis_per);
            calculation();
        });

        $(document).on('blur','.taxable_value',function(e){
            var taxable_value = parseFloat($(this).val());
            if(isNaN(taxable_value)){ taxable_value=0; }

            var discount_amt  = parseFloat($(this).closest('tr').find('input.discount_amt').val());
            if(isNaN(discount_amt)){ discount_amt=0; }

            var quantity  = parseFloat($(this).closest('tr').find('input.quantity').val());
            if(isNaN(quantity)){ quantity=0; }

            var amount=taxable_value+discount_amt;
            if(quantity>0){
                var rate=amount/quantity;
            }
            if(isNaN(rate)){ rate=0; }
            $(this).closest('tr').find('input.rate').val(round(rate,2));
            calculation();
        });

        $(document).on('blur','.net_amt_total',function(e){
            var net_amt_total = parseFloat($(this).val());
            if(isNaN(net_amt_total)){ net_amt_total=0; }

            var round_off  = parseFloat($(this).closest('tr').find('input.round_off').val());
            if(isNaN(round_off)){ round_off=0; }

            var amountBeforeRoundoff=net_amt_total-round_off;

            var tax_per  = parseFloat($(this).closest('tr').find('input.tax_per').val());
            if(isNaN(tax_per)){ tax_per=0; }

            var taxable_value = amountBeforeRoundoff*100/(100+tax_per);
            $(this).closest('tr').find('input.taxable_value').val(round(taxable_value,2));

            var discount_amt  = parseFloat($(this).closest('tr').find('input.discount_amt').val());
            if(isNaN(discount_amt)){ discount_amt=0; }

            var quantity  = parseFloat($(this).closest('tr').find('input.quantity').val());
            if(isNaN(quantity)){ quantity=0; }

            var amount=taxable_value+discount_amt;
            if(quantity>0){
                var rate=amount/quantity;
            }
            if(isNaN(rate)){ rate=0; }
            $(this).closest('tr').find('input.rate').val(round(rate,2));
            calculation();


        });
        
        
        $(document).on('click', '.remove_row', function(e){ 
            var rowCount = $('#main_table tbody#main_tbody tr.main_tr').length; 
            if(rowCount>1)
            {
                $(this).closest('tr').remove();
                rename_rows();
                calculation();
            }
        });
        
        rename_rows();
        calculation();
        function rename_rows(){
            var i=0;
            $('#main_table tbody#main_tbody tr.main_tr').each(function(){
                var row_no = $(this).attr('row_no');                    
                $(this).find('td:nth-child(1)').html(i+1);

                $(this).find('input.purchase_voucher_row_id').attr({name:'purchase_voucher_rows['+i+'][id]', id:'purchase_voucher_rows-'+i+'-id'});

                $(this).find('td:nth-child(2) select').select2().attr({name:'purchase_voucher_rows['+i+'][raw_material_id]', id:'purchase_voucher_rows-'+i+'-raw_material_id'
                        });
                $(this).find('td:nth-child(3) input').attr({name:'purchase_voucher_rows['+i+'][quantity]', id:'Purchase_Voucher_Rows-'+i+'-quantity'
                        });
                 $(this).find('td:nth-child(5) input').attr({name:'purchase_voucher_rows['+i+'][rate]', id:'Purchase_Voucher_Rows-'+i+'-rate'
                        });
                
                $(this).find('td:nth-child(6) input').attr({name:'purchase_voucher_rows['+i+'][discount_per]', id:'Purchase_Voucher_Rows-'+i+'-discount_per'
                
                        });
                $(this).find('td:nth-child(7) input').attr({name:'purchase_voucher_rows['+i+'][discount_amt]', id:'Purchase_Voucher_Rows-'+i+'-discount_amt'
                });
                
                $(this).find('td:nth-child(8) input').attr({name:'purchase_voucher_rows['+i+'][taxable_value]', id:'Purchase_Voucher_Rows-'+i+'-taxable_value'
                });
                
                $(this).find('td:nth-child(9) input').attr({name:'purchase_voucher_rows['+i+'][tax_per]', id:'Purchase_Voucher_Rows-'+i+'-tax_per'
                });
                $(this).find('td:nth-child(10) input').attr({name:'purchase_voucher_rows['+i+'][tax_amt]', id:'Purchase_Voucher_Rows-'+i+'-tax_amt'
                });
                $(this).find('td:nth-child(11) input').attr({name:'purchase_voucher_rows['+i+'][round_off]', id:'Purchase_Voucher_Rows-'+i+'-round_off'
                });
                $(this).find('td:nth-child(12) input').attr({name:'purchase_voucher_rows['+i+'][net_amt_total]', id:'Purchase_Voucher_Rows-'+i+'-net_amt_total'
                });
                
                i++;
            });
        }


        ComponentsPickers.init();
        FormValidation.init();

    });
    ";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>
<table id="sample" style="display:none;"  width="1500px">
    <tbody class="table_br">
        <tr class="main_tr">
            <td style="vertical-align: top !important;"></td>
            <td width="15%" align="left">
                <?php echo $this->Form->input('raw_material_id',['options'=>$option,'class'=>'form-control input-sm select2 raw_material ','empty' => '--Select Item--','label'=>false,'required'=>'required']); ?>
            </td>
            <td width="5%" align="center">
                <?php echo $this->Form->input('quantity', ['label' => false,'placeholder'=>'Qty','class'=>'form-control input-sm quantity rightAligntextClass','required'=>'required']); ?>
            </td>
            <td width="5%" align="center"></td>

            <td width="8%" align="center">
                <?php echo $this->Form->input('rate',['class'=>'form-control input-sm rate numberOnly rightAligntextClass','placeholder'=>'Rate','label'=>false,'required'=>'required']); ?>
            </td>       
            <td width="8%" align="center">
                <?php echo $this->Form->input('discount_per',['class'=>' discount_per form-control input-sm discount_per numberOnly rightAligntextClass','label'=>false]); ?>
            </td>
            <td  width="10%" align="center">
                <?php echo $this->Form->input('discount_amt', ['style'=>'text-align:right','label' => false,'class' => 'discount_amt form-control input-sm numberOnly','type'=>'text']);
                ?>  
            </td>
            <td  width="10%" align="center">
                <?php echo $this->Form->input('taxable_value', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm taxable_value','type'=>'text']);
                ?>  
            </td>
            <td  width="6%" align="center">
                <?php echo $this->Form->input('tax_per', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm  tax_per  numberOnly ','type'=>'text','value'=>0, 'readonly', 'tabindex' => '-1']);
                ?>  
            </td>
            <td  width="10%" align="center">
                <?php echo $this->Form->input('tax_amt', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm  tax_amt numberOnly','type'=>'text','value'=>0, 'readonly', 'tabindex' => '-1']);
                ?>  
            </td>
            <td  width="7%" align="center">
                <?php echo $this->Form->input('round_off', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm round_off','placeholder'=>'','type'=>'text']);
                ?>  
            </td>
            <td  width="15%" align="center">
                <?php echo $this->Form->input('net_amt_total', ['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm net_amt_total','type'=>'text']);
                ?>  
            </td>
            <td>
                <?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-times']),['class'=>'btn  btn-danger btn-xs remove_row','type'=>'button']); ?>
            </td>
        </tr>
    </tbody>
</table>    