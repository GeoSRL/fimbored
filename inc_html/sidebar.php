<div id="sidebar_cont">
	<h4 class="right" style="color: #95AA61;">Contact Me</h4>		
	<?php $form->msgform("CosaNostra"); ?>
	<form method="post">
		<div class="msg_form search_txt">
			Name: <input type="text" value="<? echo $form->name; ?>" class="search_box contact right" name="name"></div>
		<div class="msg_form search_txt">
			Email: <input type="text" value="<? echo $form->email; ?>" class="search_box contact right" name="email"></div>
		<div class="msg_form search_txt">
			Message:  
			<textarea class="search_box contact" rows="5" cols="26" name="message"><? echo $form->message; ?></textarea></div>
		<input type="submit" class="main_btn search_btn right" value="Send" name="msgform">
	</form>			
</div>	