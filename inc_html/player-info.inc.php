		<? 
			$database->db_select("users", "WHERE username = '$session->username'"); 
			$db = $database->db_select;
		?>
		
		<div class="pinfo_avatar">
			<img src="http://fimbored.com/m/images/avatar.png" alt="<? echo $session->username; ?>">
		</div>
		
		<div class="pinfo one">
			<div class="time text"><?=$db[0]["time"] ?></div>
			<? echo $session->convertTime($db[0]["time"], "0000:000:10:00:00", true); ?>
		</div>
		
		<div class="pinfo two">
					
			<div class="left stats">
				<div id="str_icon"></div>
				<div class="left">Muscle</div>
				<div class="right"><?=$db[0]["muscle"]?></div>
			</div>
			
			<div class="left stats">
				<div id="def_icon"></div>
				<div class="left">Mercenaries</div>
				<div class="right"><?=$db[0]["mercs"]?></div>
			</div>	
			
			<div class="left stats">
				<div id="def_icon"></div>
				<div class="left">Family</div>
				<div class="right"><?=$db[0]["family"]?></div>
			</div>						
		
		</div>
		
		<div class="pinfo three" style="border: 0;"> 
				
			<div class="left stats">
				<div id="atk_icon"></div>
				<div class="left">Atk</div>
				<div class="left"> &nbsp; [<?=$db[0]["atk_lvl"]?>] </div>
			</div>
			
			<div class="left stats">
				<div id="str_icon"></div>
				<div class="left">Str</div>
				<div class="left"> &nbsp; [<?=$db[0]["str_lvl"]?>] </div>
			</div>
			
			<div class="left stats">
				<div id="def_icon"></div>
				<div class="left">L:<?=$db[0]["def_lvl"]?> &ndash; Def</div>
				<div class="right">  </div>
			</div>
							
		</div>
		
		
		
		