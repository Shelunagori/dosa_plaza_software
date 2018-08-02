<?php 
	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());
	$filename="Customers_".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );
?>			
<table border="1">
	<thead>
        <tr>
            <th>Sr.N.</th>
            <th>Customer Code</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>DOB</th>
            <th>Anniversary</th>
            <th>Email</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sr=0;
        foreach ($customers as $customer): ?>
        <tr>
            <td><?= h(++$sr) ?></td>
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
				
