<?php
/**
 * @Author: PHP Poets IT Solutions Pvt. Ltd.
 */
$this->set('title', 'DOSA PLAZA');
if(!empty($id)){
    @$updateId = @$id;
}
?>
<div class="login-box" style="">
	<?php $this->Form->templates([
			'inputContainer' => '{{content}}'
		]); 
			
	?>
	<div class="login-logo">
		
	</div>
   <div class="login-box-body">
   
    <p class="login-box-msg">  
		<?= $this->Form->create() ?>  
		<h3 class="form-title">Login to your account</h3>
        <div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter your login ID and password. </span>
		</div>
		<?php if(@$number==0){?>
			<!--<div class="alert alert-danger ">
				<span>Enter Correct login ID and password. </span>
			</div>-->
		<?php } ?>
         <?php
		if(!empty(@$wrong))
		{
		?>
        <!--<div class="alert alert-danger">
			<button class="close" data-close="alert"></button>
			<span>
			<?php //echo $wrong; ?> </span>
		</div>-->
        <?php
		}
		?>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<?php echo $this->Form->input('username', ['label'=>false,'required'=>'required','class' => 'form-control','placeholder'=>'Username','maxlength'=>'30']); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<?php echo $this->Form->input('password', ['label'=>false,'required'=>'required','class' => 'form-control','placeholder'=>'Password','maxlength'=>'30']); ?>
			</div>
		</div>
        
		<div class="form-actions">
			<label class="checkbox">
			<input type="hidden" name="remember" value="1"/> </label>
			<button type="submit" name="login_submit" class="btn green-haze pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<?= $this->Form->end() ?>
	</form>
  </div>
</div>
