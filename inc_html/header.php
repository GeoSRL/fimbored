<? # NOSTRA TEMPO
if ($dir) { 
	include( $dir . 'inc/session.php');  
}	else { 
	include('inc/session.php'); 
}

	$session->logout();
	$starttime = microtime();
	$token = sha1(session_id() . PRIVATE_KEY);
	$_SESSION['token'] = $token;

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="http://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css">
<link href="http://fimbored.com/m/css/style.css" type="text/css" rel="stylesheet">
<? if (preg_match("/9admin3/", $_SERVER['PHP_SELF'])) { 
	echo "<link href=\"http://fimbored.com/m/css/admin-style.css\" rel=\"stylesheet\" type=\"text/css\">";
} ?>

<link rel="shortcut icon" href="http://fimbored.com/m/images/icons/favicon.ico">
<title>Fimbored</title>
<!-- Start of Woopra Code -->
<script type="text/javascript">
function woopraReady(tracker) {
    tracker.setDomain('fimbored.com');
    tracker.setIdleTimeout(300000);
    tracker.track();
    return false;
}
(function() {
    var wsc = document.createElement('script');
    wsc.src = document.location.protocol+'//static.woopra.com/js/woopra.js';
    wsc.type = 'text/javascript';
    wsc.async = true;
    var ssc = document.getElementsByTagName('script')[0];
    ssc.parentNode.insertBefore(wsc, ssc);
})();
</script>
<!-- End of Woopra Code --> 
</head>
<body>

<div id="header-container">
	<div id="wrapper">
		<div class="text"><img style="float: left;" src="http://fimbored.com/m/images/alien.png" alt="<?=date("h:m:s");?>" /><a href="/m" class="header">Fimbored</a></div>
			<ul class="navigation">
				<li class="nav left"><a href="/m/" class="header_links">Home</a></li>
				<li class="nav left"><a href="/m/about.php" class="header_links">About</a></li>

		<? if ($session->loggedIn) { ?>
		
				<li class="nav right" style="color:#fff;"><?=$session->username?></li>
				<li class="nav right"><a href="?p=logout&sid=<?=session_id()?>" class="header_links">Logout</a></li>
				<li class="nav right"><a href="#" class="header_links">Settings</a></li>
				
			<? 
			
				if ($session->isAdmin) {
				 
					echo "<li class=\"nav left\"><a href=\"9admin3\" class=\"header_links\">Admin CP</a></li>"; 
					
				}
			
			 } else {  
	
					 echo "<li class=\"nav left\"><a href=\"register.php\" class=\"header_links\">Register</a></li>";
					 $form->login_form();
					 
			 ?>
			
				<form class="login_form right" action="<? $_SERVER['SCRIPT_NAME'] ?>" method="POST">
					<input type="hidden"  name="tkn" value="<?php echo $_SESSION['token']; ?>">
					<input type="text" size="15" name="usr" class="search_box left login_box">
					<input type="password" size="15" name="pwd" class="search_box left login_box">
					<input type="submit" name="login_form" value="Login" class="search_btn left login_box">
				</form>
	
		<? } ?>
	
		</ul>
	</div>
</div><!-- end header-container -->
	
<div id="wrapper">
<!-- Start Wrapper -->