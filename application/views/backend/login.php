<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Optimum Linkup Universal Concepts" />
	<meta name="author" content="optimumlinkup.com.ng" />
	
	<title><?php echo get_phrase('login');?> | <?php echo $system_title;?></title>
	

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="assets/images/favicon.png">
	
</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '<?php echo base_url();?>';
</script>

<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content" style="width:100%;">
			
			<a href="<?php echo base_url();?>" class="logo">
				<img src="uploads/logo.png" height="60" alt="" />
			</a>
			
			<p class="description">
            	<h2 style="color:#cacaca; font-weight:100;">
					<?php echo $system_name;?>
              </h2>
           </p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>33%</h3>
				<span>checking login information...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<div class="form-login-error">
				<h3>Invalid Login</h3>
				<p>Please enter correct email and password!</p>
			</div>
			
			<form method="post" role="form" id="form_login">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-users"></i>
						</div>
						
						<input type="text" class="form-control" name="email" id="email" value="admin@admin.com" autocomplete="off" data-mask="email" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" value="admin" autocomplete="off" />
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-red btn-block btn-login">
						<i class="entypo-login"></i>
						Login Now
					</button>
				</div>
									
			</form>
			
		
						
						
			
			<div class="login-bottom-links">
				<a href="<?php echo base_url();?>index.php?login/forgot_password" class="link">
					<?php echo get_phrase('forgot_your_password');?> ?
				</a>
			</div>
			
		</div>
		
	</div>
	
</div>



		<div class="modal fade" id="a" role="dialog">
    	<div class="modal-dialog">
	  	<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style=" color:#FF0000">&times;</button>
          <h4 class="modal-title" style="color:#006600"align="center">How To Purchase </h4>
        </div>
        <div class="modal-body">
		 Thanks for having interest in our software. To purhase this software, click on Buy Now Button Below to Purchase. Note that once your payment is succesfully, download link will be sent to your email address immediately, so you are required to type correct email address while during the payment process.</div> OR chat with us on watsapp, telegram on +23426634951, +2348161662924 OR message to optimumproblemsolver@gmail.com.
		 <br>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<form method="POST" action="https://voguepay.com/pay/" target="_blank"><input type="hidden" name="v_merchant_id" value="1567-0045444" /><input type="hidden" name="memo" value="Order from OPTIMUM LINKUP COMPUTER" /><input type="hidden" name="cur" value="NGN" /><input type="hidden" name="item_1" value="Software" /><input type="hidden" name="price_1" value="20000" /><input type="hidden" name="description_1" value="You are about to purchase latest single licence school management system from Optimum Linkup Computers. Kindly supply your card details to continue" /><br /><input type="image" src="https://voguepay.com/images/buttons/buynow_red.png" alt="PAY" /></form>
       <hr>
	   <div align="center">
	 	<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
        </div>
				<br>

      	</div>
		</div>
      
    	</div>
		</div>


	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>