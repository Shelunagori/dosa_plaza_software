<?php echo $this->Html->css('mystyle'); ?>

<?php $this->set("title", 'Bills | DOSA PLAZA'); ?>

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
                                <td valign="bottom">
                                    <button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;">Filter</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>

                 <?php $page_no=$this->Paginator->current('Bills'); $page_no=($page_no-1)*20; ?>
                <table class="table table-str " cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Sr.N.</th>
                            <th scope="col"><?= $this->Paginator->sort('voucher_no', 'Bill No') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('transaction_date', 'Transaction Date') ?></th>
                            <th scope="col" style="text-align: right;"><?= $this->Paginator->sort('grand_total', 'Amount') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('order_type') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Customers.name', 'Customer') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Customers.customer_code', 'Customer Code') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Customers.mobile_no', 'Mobile') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('table_id') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bills as $bill): ?>
                        <tr>
                            <td><?= h(++$page_no) ?></td>
                            <td><?= h($bill->voucher_no) ?></td>
                            <td><?= h($bill->transaction_date->format('d-m-Y')) ?></td>
                            <td style="text-align: right;"><?= h($bill->grand_total) ?></td>
                            <td><?= h(ucfirst($bill->order_type)) ?></td>
                            <td><?= h(@$bill->customer->name) ?></td>
                            <td><?= h(@$bill->customer->customer_code) ?></td>
                            <td><?= h(@$bill->customer->mobile_no) ?></td>
                            <td><?= h(@$bill->table->name) ?></td>
                            <td class="actions">
                                <?php
                                    echo $this->Html->link('Edit Customer Info ', '/Bills/customerinfo/'.$bill->id, ['class' => 'btn btn-xs blue showLoader']);
                                    echo $this->Html->link('Edit Bill ', '/Bills/edit/'.$bill->id, ['class' => 'btn btn-xs blue showLoader']);
                                    echo $this->Html->link('Re-Print ', '/Bills/view?bill-id='.$bill->id, ['class' => 'btn btn-xs blue showLoader','target'=>'_blank']);

                                    echo $this->Html->link('Delete ', '#', ['data-target'=>'#deletemodal'.$bill->id,'data-toggle'=>'modal','class'=>'btn btn-xs red','data-container'=>'body']);
                                    ?>
                                    <div id="deletemodal<?php echo $bill->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                            <form method="post" action="<?php echo $this->Url->build(array('controller'=>'Bills','action'=>'delete',$bill->id)) ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">
                                                            Are you sure you want to delete this Bill?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer" style="border:none;">
                                                        <button type="submit" class="btn  btn-sm btn-danger">Yes</button>
                                                        <button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal"style="color: #000000;    background-color: #DDDDDD;;">Cancel</button>
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
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                    </ul>
                    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL STYLES -->
    <!-- BEGIN COMPONENTS DROPDOWNS -->
    <?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
    <!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->

 <!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/clockface/js/clockface.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/global/scripts/metronic.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/quick-sidebar.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
<!-- END PAGE LEVEL SCRIPTS -->
<?php
$js="
$(document).ready(function() {
    ComponentsPickers.init();
});
";
echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>