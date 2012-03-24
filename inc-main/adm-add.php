  <h4 class="hide_all">Hide</h4>
	<ul class="tabs">
			<li><a href="#tab1">Weapon</a></li>
			<li><a href="#tab2">Item</a></li>
			<li><a href="#tab3">Job</a></li>
	</ul>
	<div class="tab_container">
	
			<div id="tab1" class="tab_content">
		<form method="post" action="">
			<div class="search_txt">
				Name: </div> 
					<input type="text" value="<? echo $form->name; ?>" class="search_box contact right" name="name">
			<div class="search_txt">
				Ammo: </div>
					<input type="text" value="<? echo $form->ammo; ?>" class="search_box contact right" name="ammo">
			<div class="search_txt">
				Price (InTime): </div>
					<input type="text" value="0000:000:00:00:00" class="search_box contact right" name="price">
			<div class="search_txt">
				Level: </div>
					<input type="text" value="<? echo $form->level; ?>" class="search_box contact right" name="level">
			<div class="search_txt">
				Damage: </div>
					<input type="text" value="<? echo $form->damage; ?>" class="search_box contact right" name="damage">
			<div class="search_txt">
				Reqs: </div>
					<input type="text" value="<? echo $form->reqs; ?>" class="search_box contact right" name="reqs">
			<input type="submit" class="search_btn clearb right" value="Send" name="addWeap">
		</form>	
			</div>
			
			<div id="tab2" class="tab_content">
		<form method="post" action="">
			<div class="search_txt">
				Name: </div> 
					<input type="text" value="<? echo $form->name; ?>" class="search_box contact right" name="name">
			<div class="search_txt">
				Effect: </div>
					<input type="text" value="<? echo $form->effect; ?>" class="search_box contact right" name="effect">
			<div class="search_txt">
				Level: </div> 
					<input type="text" value="<? echo $form->level; ?>" class="search_box contact right" name="level">
			<div class="search_txt">
				Price (InTime): </div> 
					<input type="text" value="0000:000:00:00:00" class="search_box contact right" name="price">
			<input type="submit" class="search_btn clearb right" value="Send" name="addItem">
		</form>	
			</div>
			
			<div id="tab3" class="tab_content">
		<form method="post" action="">
			<div class="search_txt">
				Name: </div> 
					<input type="text" value="<? echo $form->name; ?>" class="search_box contact right" name="name">
			<div class="search_txt">
				Obj: </div>
					<input type="text" value="<? echo $form->obj; ?>" class="search_box contact right" name="obj">
			<div class="search_txt">
				Desc: </div>
					<input type="text" value="<? echo $form->desc; ?>" class="search_box contact right" name="desc">
			<div class="search_txt">
				Reward: </div>
					<input type="text" value="<? echo $form->reward; ?>" class="search_box contact right" name="reward">
			<div class="search_txt">
				Time: </div>
					<input type="text" value="0000:000:00:00:00" class="search_box contact right" name="money">
			<div class="search_txt">
				Reqs: </div>
					<input type="text" value="<? echo $form->reqs; ?>" class="search_box contact right" name="reqs">
			<input type="submit" class="search_btn clearb right" value="Send" name="addJob">
		</form>	
			</div>
			
	</div>

