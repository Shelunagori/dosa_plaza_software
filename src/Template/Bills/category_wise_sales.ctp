<?php 
$GrandTotal=0;
foreach ($Rows as $Row) {
	$GrandTotal+=$Row->TotalSale;
}
if(sizeof($Rows->toArray())>0){
?>
<div class="portlet light" style="border-radius: 0;padding: 20px !important;">
	<table width="100%">
		<?php foreach ($Rows as $Row) { 
			$per=round($Row->TotalSale*100/$GrandTotal, 2);
			?>
			<tr>
				<td width="30%"><h6 style="font-size: 15px;font-weight: 200;color: #7E8082;">
					<?php echo $Row->Category_name; ?>
				</h6></td>
				<td width="15%"><h6 style="font-size: 15px;font-weight: 200;color: #656363;font-weight: bold;">₹ <?php echo $Row->TotalSale; ?></h6></td>
				<td width="15%"></td>
				<td width="35%">
					<?php
					$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    				$ChColor = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
					?>
					<div style="width: 100%;background-color: #dedede;">
						<div style="width: <?php echo $per; ?>%;background-color: <?php echo $ChColor; ?>;height: 10px;"></div>
					</div>
				</td>
				<td width="5%"><span style="font-size: 14px;font-weight: 200;color: #7E8082;margin-left: 10px;"> <?php echo $per; ?>%</span></td>
			</tr>
		<?php } ?>
	</table>
</div>
<?php } ?>
