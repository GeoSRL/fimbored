<? include('inc-main/header.php'); ?>
	
<div id="center-box">

	<? 
	  //query the db to check if registrations are open or closed.
		$database->db_select("sitesettings", "regstatus");
		
		//if the user is logged in show an error
		if ($session->loggedIn) { 
				
			$database->fail("", 12);
			exit;
		
		//check if registrations are open or closed.		
		}	elseif ($database->db_select[0]["regstatus"] === "closed") {
			
			$database->fail("", 14);
			exit;
			
		}
			
		$form->reg_form();
		
	?>

	<form class="reg_form" action="<? $_SERVER['SCRIPT_NAME'] ?>" method="post">
	
		<div class="search_txt">Username: 
			<input type="text" name="usr" class="search_box contact right" value="<? echo $form->user ?>">
		</div>
		<div class="search_txt">Password: 
			<input type="password" name="pwd" class="search_box contact right" value="">
		</div>
		<div class="search_txt">Retype password: 
			<input type="password" name="pwd2" class="search_box contact right" value="">
		</div>
		<div class="search_txt">Email: 
			<input type="text" name="email" class="search_box contact right" value="<? echo $form->email1 ?>">
		</div>
		<div class="search_txt">Retype email: 
			<input type="text" name="email2" class="search_box contact right" value="<? echo $form->email2 ?>">
		</div>
		<div class="search_txt" style="margin-bottom: 10px;">        
			<?
				$publickey = "6LdD48wSAAAAAHEZ46qlWqNMw3h1LvcMGKDTnOwj "; // you got this from the signup page
				echo recaptcha_get_html($publickey);
			?>
		</div>
		<input type="submit" name="reg_form" value="Register" class="search_btn left" >
		
	</form>

</div>
	
<? include('inc-main/footer.php'); ?>
