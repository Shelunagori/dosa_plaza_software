<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Expense-Vouchers-List | DOSA PLAZA'); ?>

<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                     Expense Vouchers List
                </div>
                <div class="tools"> 
                </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <form method="GET">
                        <table>
                            <tr>
                                <td>
                                    <div class="form-group ">
                                        <div class="col-md-4">
                                            <div id="reportrange" class="btn default" style="padding: 5px;">
                                                <i class="fa fa-calendar"></i>
                                                &nbsp; 
                                                <span><?php echo $exploded_date_from_to[0].' - '.$exploded_date_from_to[1]; ?></span>
                                                <input type="hidden" name="date_from_to" id="date_from_to" value="<?php echo @$exploded_date_from_to[0].' - '.@$exploded_date_from_to[1]; ?>">
                                                <b class="fa fa-angle-down"></b>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-danger" type="submit">Filter</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                <table class="table table-str" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"><?= ('S. No.') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('total_amount') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x=0; foreach ($expanseVouchers as $expanseVoucher): ?>
                        <tr>
                            <td><?= ++$x; ?></td>
                            <td><?= $this->Number->format($expanseVoucher->voucher_no) ?></td>
                            <td><?= h($expanseVoucher->transaction_date->format('d-m-Y')) ?></td>
                            <td><?= $this->Number->format($expanseVoucher->total_amount) ?></td>
                            
                            <td class="actions">
                                <?php
                                echo $this->Html->link('Edit ', '/ExpanseVouchers/edit/'.$expanseVoucher->id, ['class' => 'btn btn-xs blue showLoader']);
                                ?>                                
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
?>
<?php echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom'));  ?>
 