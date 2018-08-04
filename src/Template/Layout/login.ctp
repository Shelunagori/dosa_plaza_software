<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.1
Version: 3.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
	<head>
		<?= $this->Html->charset() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?php echo @$title; ?>
		</title>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
		<?php echo $this->Html->css('/assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>
		<?php echo $this->Html->css('/assets/global/plugins/uniform/css/uniform.default.css'); ?>
		<!-- END GLOBAL MANDATORY STYLES -->
		
		<!-- BEGIN PAGE LEVEL STYLES -->
		<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css'); ?>
		<?php echo $this->Html->css('/assets/admin/pages/css/login3.css'); ?>
		<!-- END PAGE LEVEL SCRIPTS -->
		
		<!-- BEGIN THEME STYLES -->
		<?php echo $this->Html->css('/assets/global/css/components.css'); ?>
		<?php echo $this->Html->css('/assets/global/css/plugins.css'); ?>
		<?php echo $this->Html->css('/assets/admin/layout/css/layout.css'); ?>
		<?php echo $this->Html->css('/assets/admin/layout/css/themes/darkblue.css'); ?>
		<?php echo $this->Html->css('/assets/admin/layout/css/custom.css'); ?>
		<!-- END THEME STYLES -->
		<link rel="shortcut icon" href="<?php echo $this->Url->build(['controller' =>'/img/favicon.ico', '_full'=>true, '_ssl'=>false]); ?>"/>
		<style type="text/css">
		#loading{
			background-color: rgba(0, 0, 0, 0.21);
			height: 100%;
			width: 100%;
			position: fixed;
			z-index: 999999;
			margin-top: 0px;
			top: 0px;
			display:none;
		}
		#loading-center{
			width: 100%;
			height: 100%;
			position: relative;
		}
		#loading-center-absolute {
			position: absolute;
			left: 50%;
			top: 50%;
			height: 150px;
			width: 150px;
			margin-top: -75px;
			margin-left: -75px;
		}
		.object{
			width: 20px;
			height: 20px;
			background-color: #F15340;
			float: left;
			margin-right: 20px;
			margin-top: 65px;
			-moz-border-radius: 50% 50% 50% 50% !important;
			-webkit-border-radius: 50% 50% 50% 50% !important;
			border-radius: 50% 50% 50% 50% !important;
		}

		#object_one {	
			-webkit-animation: object_one 1.5s infinite;
			animation: object_one 1.5s infinite;
			}
		#object_two {
			-webkit-animation: object_two 1.5s infinite;
			animation: object_two 1.5s infinite;
			-webkit-animation-delay: 0.25s; 
		    animation-delay: 0.25s;
			}
		#object_three {
		    -webkit-animation: object_three 1.5s infinite;
			animation: object_three 1.5s infinite;
			-webkit-animation-delay: 0.5s;
		    animation-delay: 0.5s;
			
			}
		@-webkit-keyframes object_one {
		75% { -webkit-transform: scale(0); }
		}

		@keyframes object_one {

		  75% { 
		    transform: scale(0);
		    -webkit-transform: scale(0);
		  }

		}
		@-webkit-keyframes object_two {
		  75% { -webkit-transform: scale(0); }
		}

		@keyframes object_two {
		  75% { 
		    transform: scale(0);
		    -webkit-transform:  scale(0);
		  }

		}

		@-webkit-keyframes object_three {
		  75% { -webkit-transform: scale(0); }
		}

		@keyframes object_three {

		  75% { 
		    transform: scale(0);
		    -webkit-transform: scale(0);
		  }
		  
		}
		</style>
	</head>
	<!-- END HEAD -->
	<!-- BEGIN BODY -->
	<body class="login" style="background: url(<?php echo $this->Url->build(['controller' =>'/img/bg3.jpg', '_full'=>true, '_ssl'=>false]); ?>);" >

		<div id="loading">
			<div id="loading-center">
				<div id="loading-center-absolute">
					<div class="object" id="object_one"></div>
					<div class="object" id="object_two"></div>
					<div class="object" id="object_three"></div>
				</div>
			</div>
		</div>

		<!-- BEGIN LOGO -->
		<div class="logo">
			<?php echo $this->Html->Image('/img/Dosa-Plaza-Login.png',['style' => 'height: 90px;']); ?>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		<div class="menu-toggler sidebar-toggler">
		</div>
		<!-- END SIDEBAR TOGGLER BUTTON -->
		<!-- BEGIN LOGIN -->
		<div class="content" style="background-color: #000000b5;" >
			<?= $this->fetch('content') ?>
		</div>
		<!-- END LOGIN -->
		<!-- BEGIN COPYRIGHT -->
		<!-- <div class="copyright">
			2018 © PHP Poets IT Solutions Pvt. Ltd.
		</div> -->
		<!-- END COPYRIGHT -->
		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		<!-- BEGIN CORE PLUGINS -->
		<!--[if lt IE 9]>
		<script src="../../assets/global/plugins/respond.min.js"></script>
		<script src="../../assets/global/plugins/excanvas.min.js"></script> 
		<![endif]-->
		<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery-migrate.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery.blockui.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/uniform/jquery.uniform.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/jquery.cokie.min.js'); ?>
		<!-- END CORE PLUGINS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>
		<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js'); ?>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<?php echo $this->Html->script('/assets/global/scripts/metronic.js'); ?>
		<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js'); ?>
		<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js'); ?>
		<?php echo $this->Html->script('/assets/admin/pages/scripts/login.js'); ?>
		<!-- END PAGE LEVEL SCRIPTS -->
		<script>
		jQuery(document).ready(function() {    
			$('.showLoader').live('click',function(e) {
				$('#loading').show();
			});
		 
			Metronic.init(); // init metronic core components
			Layout.init(); // init current layout
			Login.init();
			Demo.init();
		});
		</script>
		<!-- END JAVASCRIPTS -->
	</body>
<!-- END BODY -->
</html>