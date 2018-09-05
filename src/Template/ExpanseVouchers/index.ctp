<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Expanse-Vouchers-List | DOSA PLAZA'); ?>

<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                     Expanse Vouchers List
                </div>
                <div class="tools"> 
                </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
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
                                echo $this->Html->image('edit.png',['url'=>['controller'=>'ExpanseVouchers','action'=>'edit',$expanseVoucher->id],'class'=>'tooltips showLoader','data-original-title'=>'Edit Item','data-container'=>'body']);?>                                
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

 