<? include('inc-main/header.php'); ?>
	
	<div id="body-container">
	
	<? 
		 
		if ($session->loggedIn) { //LOGGED IN
							
			include('inc-main/player-info.inc.php');
			 
		} else { //NOT LOGGED IN
		
			//include the sidebar	
			include('inc-main/sidebar.php');
		
			//selects the database, Call with $database->select[ROW_NUMBER]["TABLE_NAME"];		
			$database->db_select("news", "id ORDER BY id DESC"); //call a db select and order it by the ID descending
			$db = $database->db_select; //make the for loop more readable
					
		for($i = 0; $i < 5; $i++) {

	?>
		
			<div id="main_cont">
				
				<div class="post-header-txt left">
					Posted by <b><? echo $db[$i]["author"]; ?></b> on <? echo $db[$i]["date"]; ?> 
				</div>
				
				<div class="post-header-txt right">#<? echo $db[$i]["id"]; ?></div>
							
				<p class="body-text">
					<? echo $db[$i]["body"]; ?>
				</p>
				
			</div>
		
	<? } 
	
	}	?>
		
	</div>
	
<? include('inc-main/footer.php'); ?>