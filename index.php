<? include('inc_html/header.php'); ?>
	
	<div id="body-container">
	
	<? 
		 
		if ($session->loggedIn) { //LOGGED IN
							
			include('inc_html/player-info.inc.php');
			 
		} else { //NOT LOGGED IN
		
			//include the sidebar	
			include('inc_html/sidebar.php');
		
			//selects the database, Call with $database->select[ROW_NUMBER]["TABLE_NAME"];		
			$database->db_select("news", "id ORDER BY id DESC"); //call a db select and order it by the ID descending
			$db = $database->db_select; //make the for loop more readable
					
		foreach($db as $dbr) {

	?>
		
			<div id="main_cont">
				
				<div class="post-header-txt left">
					Posted by <b><? echo $dbr["author"]; ?></b> on <? echo $dbr["date"]; ?> 
				</div>
				
				<div class="post-header-txt right">#<? echo $dbr["id"]; ?></div>
							
				<div class="body-text">
					<? echo $dbr["body"]; ?>
				</div>
				
			</div>
		
	<? } 
	
	}	?>
		
	</div>
	
<? include('inc_html/footer.php'); ?>