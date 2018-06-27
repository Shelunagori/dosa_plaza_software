<?php
/**
 * @Author: PHP Poets IT Solutions Pvt. Ltd.
 */
$this->set('title', 'Subject Master');
if(!empty($id)){
    @$updateId = @$id;
}
?>
<style>
.caption > i{
	margin: 2px 5px !important;
}
.caption{
	font-size: 14px !important;
}
</style>
<?= $this->Form->create($exam,['onsubmit'=>'return checkValidation()']) ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="row">
					<div class="col-md-4">
						<div class="caption" style=" font-size: 16px; ">
							<i class="fa fa-cogs"></i>
							<span class="caption-subject font-green-sharp bold " >Exam set-up</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<select class="form-control select2 input-sm select2me" name="section_id" required>
								<option value="">--Select Class--</option>
								<?= h($this->Recursive->sectionOptions($sectionList,$section_id)) ?>
							</select>
						</div>
					</div>
					<div class="col-md-4"></div>
				</div>
			</div>
			<div class="portlet-body">
				<?php if(@$section_id){
				if($id)
				{
					$panelClass='portlet box green-haze';
					$panelHeading='<i class="fa fa fa-edit"></i> Edit Exam';
					$submitClass='btn btn-success submit';
					$submitLabel='Edit';
					$CreateButton=$this->Html->link('<i class="fa fa-plus-square"></i>', ['action' => 'backup'],['escape'=>false,'class'=>'btn btn-sm btn-default easy-pie-chart-reload createSubjectClass tooltips', 'role'=>'button','data-original-title'=>'Create new exam']);
				}
				else
				{
					$panelClass='portlet box blue-steel';
					$panelHeading='<i class="fa fa-plus-square"></i> Create Exam';
					$submitClass='btn btn-primary submit';
					$submitLabel='Create';
					$CreateButton='';
				}
				?>
				<div class="row">
					<div class="col-md-6">
						<div class="<?php echo $panelClass; ?>">
							<div class="portlet-title">
								<div class="caption">
									<?php echo $panelHeading; ?>
								</div>
								<div class="actions">
									<?php echo $CreateButton; ?>
								</div>
							</div>
							<div class="portlet-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Exam Name <span class="required">*</span></label>
											<?php echo $this->Form->control('name',['class'=>'form-control input-sm','placeholder'=>'Name','label'=>false,'autofocus','required'=>'required']); ?>
										</div>
										<div class="form-group">
											<label>Parent  <span class="required">*</span></label>
											<?php echo $this->Form->control('parent_id',['class'=>'form-control input-sm select2me','label'=>false, 'options' => $examList,'empty'=>'--Select--']); ?>
										</div>
									</div>
								</div>
								<?= $this->Form->button(__($submitLabel),['class'=>$submitClass]) ?>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<?= h($this->Recursive->Exam($examList2)) ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?= $this->Form->end() ?>
	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->


<!-- BEGIN PAGE LEVEL PLUGINS -->
	<!-- BEGIN COMPONENTS PICKERS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/clockface/js/clockface.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END COMPONENTS PICKERS -->
	
	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_JS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<!-- BEGIN COMPONENTS PICKERS -->
	<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<!-- END COMPONENTS PICKERS -->

	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->script('/assets/global/scripts/metronic.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/layout/scripts/quick-sidebar.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<?php echo $this->Html->script('/assets/admin/pages/scripts/components-dropdowns.js', ['block' => 'PAGE_LEVEL_SCRIPTS_JS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL SCRIPTS -->

<style>
.headBox{
	text-align: center;
    vertical-align: bottom;
}
</style>
<?php
	$js="
	$(document).ready(function() {
	
		var allIds=[]; var vcAr=[]; var maxSize=0;
		varticalChain=0;
		$('#qwert tr:nth-child(1) td').each(function() {
			var key_path=$(this).attr('key_path');
			var full_path=$(this).text();
			var ids = key_path.split(' - ');
			var full_paths = full_path.split(' - ');
			$.each(ids, function( index, value ) {
				var l=$('table#asdfg tr[sr_no='+index+']').length;
				if(l==0){
					$('#asdfg').append('<tr sr_no='+index+'></tr>');
				}
				$('table#asdfg tr[sr_no='+index+']').append('<td class=headBox box_no='+value+' vc='+varticalChain+' > '+full_paths[index]+'  </td>');
			});
			allIds.push(ids);
			vcAr.push(varticalChain);
			if(ids.length>maxSize){
				maxSize=ids.length;
			}
			varticalChain++;
		});
		
		$.each(allIds, function( index, Ids ) {
			lastElement=Ids[Ids.length-1];
			var sr_no=parseInt($('td[box_no='+lastElement+']').parent('tr').attr('sr_no'));
			for (i = 1; i <= maxSize-Ids.length; i++) {
				sr_no=sr_no+1;
				var isTD=$('table#asdfg tr[sr_no='+sr_no+'] td:nth-child('+vcAr[index]+')').length;
				var last_vc=vcAr[index]-1;
				if(isTD>0){
					$('table#asdfg tr[sr_no='+sr_no+'] td[vc='+last_vc+']').after('<td box_no='+lastElement+' vc='+vcAr[index]+'>'+lastElement+'</td>');
				}else{
					$('table#asdfg tr[sr_no='+sr_no+']').prepend('<td box_no='+lastElement+' vc='+vcAr[index]+'>'+lastElement+'</td>');
				}
				//$('table#asdfg tr[sr_no='+sr_no+'] td:nth-child('+vcAr[index]+')').after('<td box_no='+lastElement+'>'+lastElement+'</td>');
			}
		});
		
		
		$('table#asdfg tr').each(function() {
			var currentTr=$(this);
			var ar=[];
			$(this).find('td').each(function() {
				ar.push($(this).attr('box_no'));
			});
			var counts = {};
			ar.forEach(function(x) { counts[x] = (counts[x] || 0)+1; });
			$.each(counts, function( index, value ) {
				currentTr.find('td[box_no='+index+']:not(:first)').remove();
				currentTr.find('td[box_no='+index+']').attr('colspan',value);
			});
		});
		
		var allTD=[];
		$('table#asdfg tr').each(function() {
			$(this).find('td').each(function() {
				allTD.push($(this).attr('box_no'));
			});
		});
		var counts = {};
		allTD.forEach(function(x) { counts[x] = (counts[x] || 0)+1; });
		$.each(counts, function( box_no, c ) {
			if(c>1){
				var vc=$('td[box_no='+box_no+']').attr('vc');
				$('table#asdfg').find('td[box_no='+box_no+'][vc='+vc+']:not(:first)').remove();
				$('table#asdfg').find('td[box_no='+box_no+'][vc='+vc+']').attr('rowspan',c);
			}
		});
		
		ComponentsPickers.init();
		
		$('.EditBox').die().live('click',function(event){
			var section_id=$('select[name=section_id] option:selected').val();
			var href=$(this).attr('href');
			window.location.href = href+'?'+$.param({'section-id':section_id});
		});
		
		$('select[name=section_id]').die().live('change',function(event){
			var section_id=$('select[name=section_id] option:selected').val();
			window.location.href = window.location.pathname+'?'+$.param({'section-id':section_id});
		});
	});	
	$('.createSubjectClass').die().live('click',function(event){
		var section_id=$('select[name=section_id] option:selected').val();
		var url = window.location.pathname;
		var str = url.substr(url.lastIndexOf('/') + 1) + '$';
		var path = url.replace( new RegExp(str), '' );
		window.location.href = path+'?'+$.param({'section-id':section_id});
	});
	function checkValidation()
	{
		$('.submit').attr('disabled','disabled');
		$('.submit').text('Submiting...');
    }
	
	";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>
