<!DOCTYPE html> 
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	</head>
	<body style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 12px;" onload="window.prinst();">
		<div style="width: 300px;">
			<div align="center">
				<h4 style="margin: 0;"><?php echo $coreVariable['company_name']; ?></h4>
				<span><?php echo $coreVariable['company_address']; ?></span><br/>

			</div>
			<div align="center">
				<span>Daily Sales - Sub Group Wise</span><br/>
				<span>From <?php echo $exploded_date_from_to[0].' To '.$exploded_date_from_to[1]; ?></span>
			</div>
			<div style=" padding: 5px; " id='DivIdToPrint'>
				<?php
				foreach ($ItemSubCategories as $ItemSubCategory) { ?>
					<div class="header" align="center" style="border-top: solid 1px #CCC; border-bottom: solid 1px #CCC;" sub_cat_id="<?php echo $ItemSubCategory->id; ?>" ><?= $ItemSubCategory->name; ?></div>
					<table width="100%" sub_cat_id="<?php echo $ItemSubCategory->id; ?>" >
						<?php
						foreach ($ItemSubCategory->items as $item) {
							if($item->Total_qty>0){ ?>
							<tr>
								<td><?= h($item->name) ?></td>
								<td width="10%"><?= h($item->Total_qty) ?></td>
								<td width="15%" style="text-align: right"><?= h($item->Total_Net) ?></td>
							</tr>
						<?php } } ?>
					</table>
					
				<?php } ?>
			</div>
		</div>
		<style type="text/css" media="print">
		@page {
			width:100%;
			size: auto;   /* auto is the initial value */
			margin: 0px 0px 0px 0px;  /* this affects the margin in the printer settings */
		}
		.hide_at_print {
			display:none !important;
		}
		</style>
	</body>
</html>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script type="text/javascript">
	$(document).ready(function() {	
		$('div.header').each(function(){
			var sub_cat_id = $(this).attr('sub_cat_id');
			var l = $('table[sub_cat_id='+sub_cat_id+']').find('tr').length;
			if(l==0){
				$(this).remove();
			}
		});
	});
</script>