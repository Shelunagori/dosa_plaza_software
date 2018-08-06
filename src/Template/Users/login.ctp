<?php
/**
 * @Author: PHP Poets IT Solutions Pvt. Ltd.
 */
$this->set('title', 'LOGIN | DOSA PLAZA');
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
		<div align="center" >
			<h4 class="form-title" style="color: #FFF;">Login to your account</h4>
		</div>
		<?= $this->Flash->render() ?>
        <style type="text/css">
        	.toast-error{
        		background-color: #f2dede;
        	}
        </style>
		
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<?php echo $this->Form->input('username', ['label'=>false,'required'=>'required','class' => 'form-control','placeholder'=>'Username','maxlength'=>'30','autofocus']); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<?php echo $this->Form->input('password', ['label'=>false,'required'=>'required','class' => 'form-control','placeholder'=>'Password','maxlength'=>'30']); ?>
			</div>
		</div>
        <div align="center">
        	<button type="submit" name="login_submit" class="btn btn-block showLoader" style=" background-color: #f1b11b; color: #FFF; ">
			Login 
			</button>
        </div>
		<?= $this->Form->end() ?>
	</form>
  </div>
</div>
