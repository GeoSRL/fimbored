<?
 $dir = "../"; #for the session include in header.php
 include('../inc_html/header.php'); 
 
 if (!$session->isAdmin) {
	
		echo "<meta http-equiv=\"REFRESH\" content=\"0;url=http://fimbored.com/m/\">";	
		exit; 
	 
 }
 
?>
	
<div id="body-container">
	
	<ul id="admin_nav">
		<li class="admin_navli left"><a class="main_link" href="index.php">Home</a></li>
		<li class="admin_navli left active"><a class="main_link" href="forms.php">Forms</a></li>
		<li class="admin_navli left"><a class="main_link" href="extra.php">Extra</a></li>
	</ul>
	
</div>
	
<? include('../inc_html/footer.php'); ?>
