<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", ' Customer-List | DOSA PLAZA'); ?>
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
                    <?= $this->Html->link('Add',['action' => 'new',],['escape'=>false,'class'=>'btn btn-danger btn-sm', 'style' => 'margin-right: 20px;color:#FFF;']);  ?>
                    <?= $this->Html->link('Export Excel',['action' => 'excel',],['escape'=>false,'target'=>'_blank','class'=>'btn btn-danger btn-sm', 'style' => 'margin-right: 20px;color:#FFF;']);  ?>
                </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <form method="GET">
                    <div align="center">
                        <table>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" placeholder="Customer Code" name="code" value="<?php echo @$code; ?>">
                                </td>
                                 <td>
                                    <input type="text" class="form-control" placeholder="Unique Code" name="c_unique_code" value="<?php echo @$c_unique_code; ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Mobile" name="mobile" value="<?php echo @$mobile; ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo @$name; ?>">
                                </td>
                                <td>
                                    <button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;">Filter</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
                <?php $page_no=$this->Paginator->current('Customers'); $page_no=($page_no-1)*20; ?>
                <table class="table table-str " cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Sr.N.</th>
                            <th scope="col"><?= $this->Paginator->sort('customer_code') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('c_unique_code', 'Unique Code') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('dob') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('anniversary') ?></th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= h(++$page_no) ?></td>
                            <td><?= h($customer->customer_code) ?></td>
                            <td><?= h($customer->c_unique_code) ?></td>
                            <td><?= h($customer->name) ?></td>
                            <td><?= h($customer->mobile_no) ?></td>
                            <td><?php if($customer->dob){ echo $customer->dob->format('d-m-Y'); } ?></td>
                            <td><?php if($customer->anniversary){ echo $customer->anniversary->format('d-m-Y'); } ?></td>
                            <td><?= h($customer->email) ?></td>
                            <td><?= h($customer->address) ?></td>
                            <td>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Customers', 'action' => 'edit', $customer->id], ['class' => '']) ?>
                                <?= $this->Html->link(__('Bill Summary'), ['controller' => 'Customers', 'action' => 'portfolio', $customer->id], ['class' => '']) ?>
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


