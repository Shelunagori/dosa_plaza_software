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
                                    <label>From Date</label>
                                    <input type="date" class="form-control" placeholder="From Date" name="from_date" value="<?php echo @$from_date; ?>">
                                </td>
                                <td valign="bottom">
                                    <label>To Date</label>
                                    <input type="date" class="form-control" placeholder="To Date" name="to_date" value="<?php echo @$to_date; ?>">
                                </td>
                                <td valign="bottom">
                                    <input type="text" class="form-control" placeholder="Amount From" name="amount_from" value="<?php echo @$amount_from; ?>">
                                </td>
                                <td valign="bottom">
                                    <input type="text" class="form-control" placeholder="Amount to" name="amount_to" value="<?php echo @$amount_to; ?>">
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
                                    echo $this->Html->image('edit.png',['url'=>['controller'=>'Bills','action'=>'customerinfo',$bill->id],'class'=>'tooltips showLoader','data-original-title'=>'Edit Customer Info','data-container'=>'body']);
                                    echo $this->Html->image('edit.png',['url'=>['controller'=>'Bills','action'=>'edit',$bill->id],'class'=>'tooltips showLoader','data-original-title'=>'Edit Bill','data-container'=>'body']);
                                    echo $this->Html->image('print.png',['url'=>['controller'=>'Bills','action'=>'view?bill_id='.$bill->id],'target'=>'_blank','class'=>'tooltips ','data-original-title'=>'Re-Print','data-container'=>'body']);

                                    echo $this->Html->image('delete.png',['data-target'=>'#deletemodal'.$bill->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Delete Bill','data-container'=>'body']);
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