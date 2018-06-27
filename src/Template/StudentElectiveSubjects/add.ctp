<?php
/**
 * @Author: PHP Poets IT Solutions Pvt. Ltd.
 */
$this->set('title', 'Student Elective Subject');

?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light ">
			<div class="portlet-title">
				
					<div class="row">
						<div class="col-md-4"> 
							<i class="icon-bar-chart font-green-sharp hide"></i>
							<span class="caption-subject font-green-sharp bold " style="font-size: 16px;">Student Elective Subject</span>
						</div>
						<div class="col-md-3" > 
							<div class="form-group" >
						 
						<select class="form-control input-sm select2me" name="section_id" required>
							<option value="">----Select Class----</option>
							<?= h($this->Recursive->sectionOptions($sections)) ?>
						</select>
					</div>
						</div>
						<div class="col-md-3" style="float:right;"> 
							<input type="text" placeholder="Search..." id="search3" class="form-control input-sm" >
						</div>
					</div>
						
				
				
			</div>
			<div class="portlet-body">
				<span class="response" style="float: right; margin-left: 15%; background:#f16868;"></span>
				<div class="attachTabl">
				
				</div>
			</div>
		</div>
	</div>
</div>
<!-- BEGIN PAGE LEVEL STYLES -->
	<!-- BEGIN COMPONENTS PICKERS -->
	<?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<!-- END COMPONENTS PICKERS -->

	<!-- BEGIN COMPONENTS DROPDOWNS -->
	<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'PAGE_LEVEL_CSS']); ?>
	<!-- END COMPONENTS DROPDOWNS -->
<!-- END PAGE LEVEL STYLES -->

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

<?php
	$js="
	$(document).ready(function() {	
		//ComponentsPickers.init();
	});	
	function checkValidation()
	{
	        $('.submit').attr('disabled','disabled');
	        $('.submit').text('Submiting...');
    }	
	
	$(document).on('change', 'select[name=section_id]', function(e)
    { 
		var section_id = $('select[name=section_id]').find('option:selected').val(); 
		if(section_id!='')
		{
			$('.attachTabl').html('Loading...');
			
			var url='".$this->Url->build(["controller" => "StudentElectiveSubjects", "action" => "getStudentElectiveSubject"])."';
			url=url+'/'+section_id; 
			$.ajax({
				url: url,
				type: 'GET'
			}).done(function(response) { 
				$('.attachTabl').html(response);
			});	
		}
		else{
			$('.attachTabl').html('');
		}
    });
	
	$(document).on('change', '.chk', function(e)
    { 
		var student_id   = $(this).closest('tr').find('td:nth-child(1) input').val(); 
		var evective_sub = $(this).val();
		if (this.checked) {
			
			var url='".$this->Url->build(["controller" => "StudentElectiveSubjects", "action" => "assignStudentSubject"])."';
			url=url+'/'+student_id+'/'+evective_sub; 
			$.ajax({
				url: url,
				type: 'GET'
			}).done(function(response) { 

				$('.response').html(response);
			});	
		}
		else{
			var url='".$this->Url->build(["controller" => "StudentElectiveSubjects", "action" => "assignStudentSubjectDeleted"])."';
			url=url+'/'+student_id+'/'+evective_sub; 
			$.ajax({
				url: url,
				type: 'GET'
			}).done(function(response) {
				$('.response').html(response);

			});	
		}
	});
	
	
	
	
	
	
	$(document).on('keyup', '#search3', function(e)
	{ 
		var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		var v = $(this).val();
		if(v){ 
			rows.show().filter(function() {
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	           return !~text.indexOf(val);
			}).hide();
		}else{
			rows.show();
		}
	});
	
	function moveScroll(){ 
    var scroll = $(window).scrollTop();
    var anchor_top = $('#main_tble').offset().top;
    var anchor_bottom = $('#bottom_anchor').offset().top;
    if (scroll>anchor_top && scroll<anchor_bottom) {
    clone_table = $('#clone');
    if(clone_table.length == 0){
        clone_table = $('#main_tble').clone();
        clone_table.attr('id', 'clone');
        clone_table.css({position:'fixed',
                 'pointer-events': 'none',
                 top:48});
        clone_table.width($('#main_tble').width());
        $('#table-container').append(clone_table);
        $('#clone').css({visibility:'hidden'});
        $('#clone thead').css({visibility:'visible'});
    }
    } else {
    $('#clone').remove();
    }
}
   $(window).scroll(moveScroll);

	";

echo $this->Html->scriptBlock($js, array('block' => 'scriptBottom')); 
?>
