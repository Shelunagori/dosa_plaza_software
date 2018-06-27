<style>
.div_heading{
	margin: 1% 15% 4% 12%;
    background-color: #FFAB41;
    color: white;
    font-size: 17px;
	border: 3px solid #c0853a;
}
</style>
<?php  
if(sizeof($sections)>0){ ?>
<hr>
	<div class="row">
		<div class="col-md-5">
			<ul style="margin-top: 15%;font-size: 15px;">
			<?php if(sizeof($sections->exams)>0){
				foreach($sections->exams as $exam)
				{
			?>
				<li><b><?php echo $exam->name;?></b></li>
				<?php }}?>
			</ul>
		</div>
		<div class="col-md-7">
		<?php if(sizeof($sections->exams)>0){
				foreach($sections->exams as $exam)
				{
			?>
			<div align="center" class="div_heading"><?php echo $exam->name;?></div>
			<table class="table table-bordered table-hover table-condensed" style="display:;">
				<thead>
					<tr>
						<th scope="col" width="35%">Subject</th>
						<th scope="col">Maximum Marks</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($sections->subjects as $subject): ?>
					<tr>
						<td><?= h($subject->name) ?>
						<?php echo $this->Form->control('subject_id',['type'=>'hidden','value'=>$subject->id,'class'=>'subject']); ?>
						<?php echo $this->Form->control('exam_id',['type'=>'hidden','value'=>$exam->id,'class'=>'exam']); ?>
						<?php echo $this->Form->control('id',['type'=>'hidden','value'=>@$ids[@$sections->id][@$exam->id][@$subject->id],'class'=>'ids']); ?>
						</td>
						<td><?php echo $this->Form->control('max_marks',['class'=>'form-control input-sm insert_marks','placeholder'=>'Marks','label'=>false,'autofocus','required'=>'required','value'=>@$datail[@$sections->id][@$exam->id][@$subject->id]]); ?></td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		<?php }  } ?>
		</div>
	</div>

<?php }else{ ?> 
<table class="table table-bordered table-hover table-condensed" >
	<tr>
		<td align="center"><h4>Detail not found.</h4></td>
	</tr>
</table>
<?php } ?> 
