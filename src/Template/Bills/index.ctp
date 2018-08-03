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
                            <td><?= h(@$bill->table->name) ?></td>
                            <td class="actions">
                                <?php
                                    echo $this->Html->image('edit.png',['url'=>['controller'=>'Bills','action'=>'customerinfo',$bill->id],'class'=>'tooltips showLoader','data-original-title'=>'Edit Info','data-container'=>'body']);
                                    echo $this->Html->image('print.png',['url'=>['controller'=>'Bills','action'=>'view?bill_id='.$bill->id],'target'=>'_blank','class'=>'tooltips ','data-original-title'=>'Re-Print','data-container'=>'body']);

                                    if($bill->status=='canceled'){
                                        echo "<span>Canceled</span>";
                                    } 
                                    else{
                                       echo $this->Html->image('cancel.png',['data-target'=>'#deletemodal'.$bill->id,'data-toggle'=>'modal','class'=>'tooltips','data-original-title'=>'Cancel Bill','data-container'=>'body']);
                                    }
                                    ?>
                                <div id="deletemodal<?php echo $bill->id; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-md" >
                                        <form method="post" action="<?php echo $this->Url->build(array('controller'=>'Bills','action'=>'delete',$bill->id)) ?>">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">
                                                        Are you sure you want to cancel this Bill?
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