<?php echo $this->Html->css('mystyle'); ?>

<?php $this->set("title", 'Bulk Edit | DOSA PLAZA'); ?>

<div style="height: 15px;" >.</div>
<div class="row">
    <div class="col-md-12 main-div">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    Bills
                </div>
                <div class="tools">
                </div>
                <div class="actions"></div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <form method="GET">
                    <div align="center">
                        <table>
                            <tr>
                                <td valign="bottom">
                                    <input type="text" class="form-control" placeholder="Bill No" name="bill_no" value="<?php echo @$bill_no; ?>">
                                </td>
                                <td valign="bottom">
                                    <?php 
                                    if(@$from_date=="1970-01-01" or $from_date==""){
                                        $PrintDate1 = "";
                                    }else{
                                        $PrintDate1 = date('d-m-Y', strtotime($from_date));
                                    } ?>
                                    <label>From Date</label>
                                    <input class="form-control date-picker" placeholder="From Date" name="from_date" value="<?php echo @$PrintDate1; ?>" data-date-format="dd-mm-yyyy" placeholder="Date" autocomplete="off">
                                </td>
                                <td valign="bottom">
                                    <?php 
                                    if(@$to_date=="1970-01-01" or $to_date==""){
                                        $PrintDate2 = "";
                                    }else{
                                        $PrintDate2 = date('d-m-Y', strtotime($to_date));
                                    } ?>
                                    <label>To Date</label>
                                    <input class="form-control date-picker" placeholder="To Date" name="to_date" value="<?php echo @$PrintDate2; ?>" data-date-format="dd-mm-yyyy" placeholder="Date" autocomplete="off">
                                </td>
                                <td valign="bottom">
                                    <input type="text" class="form-control" placeholder="Amount From" name="amount_from" value="<?php echo @$amount_from; ?>">
                                </td>
                                <td valign="bottom">
                                    <input type="text" class="form-control" placeholder="Amount to" name="amount_to" value="<?php echo @$amount_to; ?>">
                                </td>
                                <td valign="bottom">
                                    <input type="text" class="form-control" placeholder="Name" name="customer_name" value="<?php echo @$customer_name; ?>">
                                </td>
                                <td valign="bottom">
                                    <input type="text" class="form-control" placeholder="Mobile" name="mobile_no" value="<?php echo @$mobile_no; ?>">
                                </td>
                                <td valign="bottom">
                                    <input type="text" class="form-control" placeholder="Code" name="customer_code" value="<?php echo @$customer_code; ?>">
                                </td>
                                <td valign="bottom" style="width: 100px;">
                                    <?php 
                                    $payment_options['']='-select-';
                                    $payment_options['cash']='Cash';
                                    $payment_options['card']='Card';
                                    $payment_options['paytm']='Paytm';
                                    ?>
                                    <?= $this->Form->input('payment_type',['options' =>$payment_options,'label' => false,'class'=>'form-control','value'=>@$payment_type]) ?> 
                                </td>
                                <td valign="bottom">
                                    <button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;">Filter</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>

                <?php $action=$this->Url->build(['controller'=>'Bills','action'=>'modify']) ?>
                <form method="post" action="<?php echo $action; ?>">
                <table class="table table-str table-bordered" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" value="1" class="selectAll"></th>
                            <th>Bill No</th>
                            <th>Transaction Date</th>
                            <th style="text-align: right;">Amount</th>
                            <th>Payment Type</th>
                            <th>Order Type</th>
                            <th>Customer</th>
                            <th>Customer Code</th>
                            <th>Mobile</th>
                            <th>Table</th>
                            <th></th>
                            <!-- <th>Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bills as $bill): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="bill_ids[]" value="<?php echo $bill->id; ?>" class="chBox">
                            </td>
                            <td>RBL-<?php echo str_pad($bill->voucher_no, 6, "0", STR_PAD_LEFT); ?></td>
                            <td><?= h($bill->transaction_date->format('d-m-Y')) ?></td>
                            <td style="text-align: right;"><?= h($bill->grand_total) ?></td>
                            <td><?= h($bill->payment_type) ?></td>
                            <td><?= h(ucfirst($bill->order_type)) ?></td>
                            <td><?= h(@$bill->customer->name) ?></td>
                            <td><?= h(@$bill->customer->customer_code) ?></td>
                            <td><?= h(@$bill->customer->mobile_no) ?></td>
                            <td><?= h(@$bill->table->name) ?></td>
                            <td>
                                <button type="button" class="btn blue btn-xs billView" bill_id=<?php echo $bill->id; ?>>View</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div>
                    <table>
                        <tr>
                            <td>
                                <?php echo $this->Form->input('item_id',['options'=>$items,'class'=>'form-control input-sm select2me ','empty' => '--Select Item--','label'=>false,'required'=>'required']); ?>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-danger">Modify Bills</button>
                            </td>
                        </tr>
                    </table>
                </div>
                </form>

            </div>
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
    $('.selectAll').die().live('click',function(event){
        if($(this).is(':checked')){
            $('.chBox').closest('tr').find('input[type=checkbox]').attr('checked','checked');
            $('.chBox').closest('tr').css('background-color','#c9d7f9');
            $.uniform.update();
        }else{
            $('.chBox').closest('tr').find('input[type=checkbox]').removeAttr('checked');
            $('.chBox').closest('tr').css('background-color','');
            $.uniform.update();
        }
    });
    

    $('.billView').die().live('click',function(event){
        var ths=$(this);
        var bill_id=$(this).attr('bill_id');
        if($('tr.details[bill_id='+bill_id+']').length){
            $('tr.details[bill_id='+bill_id+']').remove();
        }else{
            var url='".$this->Url->build(['controller'=>'Bills','action'=>'billrows'])."';
            url=url+'?bill_id='+bill_id;
            $.ajax({
                url: url,
            }).done(function(response) {
                ths.closest('tr').after( response );
            });
        }
    });


    $('.chBox').die().live('click',function(event){
        if($(this).is(':checked')){
            $(this).closest('tr').css('background-color','#c9d7f9');
        }else{
            $(this).closest('tr').css('background-color','');
        }
    });
    
    ComponentsPickers.init();
});
";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>