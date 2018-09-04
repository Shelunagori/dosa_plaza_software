<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Bookings | DOSA PLAZA '); ?>

<div class="row" style="margin-top:15px;">
    <div class="col-md-12 main-div">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                     Bookings
                </div>
                <div class="tools"> 
                </div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-str " cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"><?= ('S.No.') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('booking_date') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('no_of_guests') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('customer_name', 'Customer Name') ?></th>
                            <th scope="col"><?= ('Customer Mobile') ?></th>
                            <th scope="col"><?= ('Description') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $d=0; foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?= (++$d) ?></td>
                            <td><?= h($booking->booking_date->format('d-m-Y')) ?></td>
                            <td><?= h($booking->no_of_guests) ?></td>
                            <td><?= h($booking->customer_name) ?></td>
                            <td><?= h($booking->customer_mobile) ?></td>
                            <td><?= $this->Text->autoParagraph($booking->description) ?></td>
                            <td class="actions">
                                 <?php 
                                 echo $this->Html->image('edit.png',['url'=>['controller'=>'Bookings','action'=>'add',$booking->id],'class'=>'tooltips showLoader','data-original-title'=>'Edit Category','data-container'=>'body']);
                                 ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

