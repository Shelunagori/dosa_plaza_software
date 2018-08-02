<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Employee'); ?>
<div style="height: 15px;" >.</div>
<div class="row">
    <div class="col-md-12 main-div">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    Customer List
                </div>
                <div class="tools">
                    

                </div>
                <div class="actions">
                    <?= $this->Html->link('Export Excel',['action' => 'excel',],['escape'=>false,'target'=>'_blank','class'=>'btn btn-danger btn-sm', 'style' => 'margin-right: 20px;color:#FFF;']);  ?>
                </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <?php $page_no=$this->Paginator->current('Customers'); $page_no=($page_no-1)*20; ?>
                <table class="table table-str " cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Sr.N.</th>
                            <th scope="col"><?= $this->Paginator->sort('customer_code') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('dob') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('anniversary') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= h(++$page_no) ?></td>
                            <td><?= h($customer->customer_code) ?></td>
                            <td><?= h($customer->name) ?></td>
                            <td><?= h($customer->mobile_no) ?></td>
                            <td><?php if($customer->dob){ echo $customer->dob->format('d-m-Y'); } ?></td>
                            <td><?php if($customer->anniversary){ echo $customer->anniversary->format('d-m-Y'); } ?></td>
                            <td><?= h($customer->email) ?></td>
                            <td><?= h($customer->address) ?></td>
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


