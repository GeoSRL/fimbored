<?
 $dir = "../"; #for the session include in header.php
 include('../inc-main/header.php'); 
 
 if (!$session->isAdmin) {
	
		echo "<meta http-equiv=\"REFRESH\" content=\"0;url=http://fimbored.com/m/\">";	
		exit; 
	 
 }
 
?>
	 
<div id="body-container"> 
	
	<ul id="admin_nav">
		<li class="admin_navli left active"><a href="index.php">Home</a></li>
	</ul>
	
	<div class="center-box">
	 
		<h4 class="header-center-box">Site Settings</h4>
		<? 
			$form->adm_settings(); //check wether the form is submitted, and proccess reqeusts 
			$database->db_select("sitesettings", "regstatus", ""); //selects the regstatus for later use
		?>
		<form action="<? $_SERVER['SCRIPT_NAME']; ?>" method="POST">
		
			<? echo "<h4 class=\"chkboxform\">Registration are currently: 
			" . $database->db_select[0]["regstatus"] . "</h4>"; ?>
			
			<input class="chkbox-form" type="checkbox" value="open" name="reg_status"
			<? if ($database->db_select[0]["regstatus"] === "open") { echo "checked"; } ?>>
			
			 <h4 class="chkboxform">
			 <?
			 		if ($database->db_select[0]["regstatus"] === "open") {
						
							echo "Close registrations?";
						
					} else {
						
							echo "Open registrations?";
						
					}
			 ?>
			 </h4> 
			 			
			<input style="float: right; clear: both;" class="search_btn" type="submit" value="Submit" name="site_settings_form">
		</form>
		
		<h4 class="header-center-box">Add:</h4>
		
		<? 
		 $form->add_item();
		 $form->add_weap();
		 $form->add_job(); 
		
		include('../inc-main/adm-add.php'); ?>
		
	</div> 
	
	<div class="center-box">
		<h4 class="header-center-box">Placeholder</h4>
	</div>
	
	<div class="center-box" style="border-right: 0;">
		<h4 class="header-center-box">Placeholder</h4>
	</div>
	
</div>  
	
<? include('../inc-main/footer.php'); ?>
