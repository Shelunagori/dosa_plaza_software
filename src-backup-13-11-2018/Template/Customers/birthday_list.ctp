<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", ' Customer-List | DOSA PLAZA'); ?>
<div style="height: 15px;" >.</div>
<div class="row">
    <div class="col-md-12 main-div">
        <!-- BEGIN ALERTS PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    Customer List for Upcoming Brithday & Anniversary
                </div>
                <div class="tools"></div>
                <div class="row">   
                        <div class="col-md-12 horizontal "></div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-str " cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.N.</th>
                            <th>Name</th>
                            <th>Customer Code</th>
                            <th>Mobile</th>
                            <th>DOB</th>
                            <th>Anniversary</th>
                            <th>Email</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sr=0; foreach ($customers as $customer): ?>
                        <tr>
                            <td><?php echo ++$sr; ?></td>
                            <td><?php echo $customer['name']; ?></td>
                            <td><?php echo $customer['customer_code']; ?></td>
                            <td><?php echo $customer['mobile_no']; ?></td>
                            <td><?php if($customer['dob']){ echo date('d-m-Y', strtotime($customer['dob'])); } ?></td>
                            <td><?php if($customer['anniversary']){ echo date('d-m-Y', strtotime($customer['anniversary'])); } ?></td>
                            <td><?php echo $customer['email']; ?></td>
                            <td><?php echo $customer['address']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


