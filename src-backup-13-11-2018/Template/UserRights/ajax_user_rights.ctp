 
<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th scope="col">Menu Name</th>
			<th scope="col" >
				 <label> Select All <input type="checkbox" class="checkAll"></label>
			</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		foreach ($pages as $key => $value) { 
			?>
			<tr>
				<td scope="col"><?php echo  $value->name;?></td>
				<td scope="col">
					 <input type="checkbox" name="rights[]" <?php if(in_array($value->id, $assign_rights)){ echo "checked"; }?> value="<?php echo $value->id;?>">
				</td>
			</tr>
		<?php }
		?>
		 
	</tbody>
</table>