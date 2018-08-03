<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Employee'); ?>
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
                 <?php $page_no=$this->Paginator->current('Bills'); $page_no=($page_no-1)*20; ?>
                <table class="table table-str " cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Sr.N.</th>
                            <th scope="col"><?= $this->Paginator->sort('voucher_no', 'Bill No') ?></th>
                            <th scope="col" style="text-align: right;"><?= $this->Paginator->sort('grand_total', 'Amount') ?></th>
                             <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
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
                            <td style="text-align: right;"><?= h($bill->grand_total) ?></td>
                            <td><?= h($bill->created_on->format('d-m-Y H:i')) ?></td>
                            <td><?= h(ucfirst($bill->order_type)) ?></td>
                            <td><?= h(@$bill->customer->name) ?></td>
                            <td><?= h(@$bill->customer->customer_code) ?></td>
                            <td><?= h(@$bill->customer->mobile_no) ?></td>
                            <td><?= h($bill->table->name) ?></td>
                            <td class="actions">
                                <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $bill->id]) ?> -->
                                <?php if($bill->status=="canceled"){ ?>
                                    <span>Canceled</span>
                                <?php }else{ ?>
                                    <?= $this->Form->postLink(__('Cancel'), ['action' => 'delete', $bill->id], ['confirm' => __('Are you sure you want to cancel this bill # {0}?', $bill->voucher_no)]) ?>
                                <?php } ?>
                                
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