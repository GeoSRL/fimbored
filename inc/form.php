<?php

class form {
	
	/* 
		Message form for fimbored.com/index.php
		$cat = category 
	*/
	public function msgform($cat) {
		
		global $database;
				
	if(isset($_POST['msgform'])) {
				
			$this->name = htmlspecialchars(trim($_POST['name']));
			$this->email = htmlspecialchars(trim($_POST['email']));
			$this->message = htmlspecialchars(trim($_POST['message']));
			$ip = $_SERVER['REMOTE_ADDR'];
			$database->db_select("privemails", "ORDER BY id DESC");
			$time = microtime(true) + 300;
			$category = $cat;
						
			if (!$this->name || !$this->email || !$this->message) {
				
				$database->db_fail(FORM_INCOMPLETE);
					
			} elseif(strpos($this->email, "@") == 0 || strpos($this->email, ".") == 0) {
				
				$database->db_fail(EMAIL_INVALID);
					
			} elseif ($ip == $database->db_select[0]["ip"] && $database->db_select[0]["time"] > microtime(true)) {
														
				$database->db_fail(FORM_LIMIT);
						
			} else {
			
				$database->db_add("privemails", "name, email, message, ip, time, category", 
													"'$this->name', '$this->email', '$this->message', '$ip', '$time', '$category'");
													
				$database->db_success("name { $this->name }, email { $this->email }, msg { $this->message } has been sent!");
				
				unset($this->name);	
				unset($this->email);	
				unset($this->message);
				
			}
		}
	} 
	
	
	/*
		Login form
	*/
	public function login_form() {
		
		global $database, $check, $session;
				
		if(isset($_POST['login_form']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$username = htmlspecialchars($_POST['usr']);
			$password = htmlspecialchars($_POST['pwd']);
			$token_f = htmlspecialchars($_POST['tkn']);
			$s_id = session_id();
			$this->chk_login = false;
			$time = microtime(true);
												
			$database->db_count("username", "users WHERE username = '$username'");
								
			if (!$username || !$password || !$token_f) {
				
				$database->db_fail(FORM_INCOMPLETE);
				
			} elseif ($database->db_count[0][0] == 0) {
				
				$database->db_fail(USER_INVALID);
							
			} elseif (!$check->chk_valid_login(ucfirst($username), $password)) {
				
				$database->db_fail(LOGIN_INVALID);				
				
			} elseif ($token_f != $_SESSION['token']) {
				
				$database->db_fail(REPORT);
				
			} else {
			
				$database->db_update("users", "userid = '$s_id', timestamp = '$time'", "WHERE username = '$username'");
				echo "<meta http-equiv=\"REFRESH\" content=\"0;url=http://fimbored.com/m/\">";
															
			}
		
		}
			
	}
	
	/*
		Registration form
	*/
	public function reg_form() {
		
		global $database, $check;
		
		require_once('recaptchalib.php');
				
		$this->user = htmlspecialchars($_POST['usr']);
		$password = htmlspecialchars($_POST['pwd']);
		$password2 = htmlspecialchars($_POST['pwd2']);
		$this->email1 = htmlspecialchars($_POST['email']);
	  $this->email2 = htmlspecialchars($_POST['email2']);
		$ip = $_SERVER['REMOTE_ADDR'];
		$time = microtime(true);
		$privatekey = RECAPTCHA_PRIV;
  	$resp = recaptcha_check_answer ($privatekey,
    $_SERVER["REMOTE_ADDR"],
    $_POST["recaptcha_challenge_field"],
    $_POST["recaptcha_response_field"]);
												
		if(isset($_POST['reg_form'])) {
			
			if (!$this->user || !$password || !$password2 || !$this->email1 || !$this->email2) {
				
					$database->db_fail(FORM_INCOMPLETE);
										
			} elseif (!$check->chk_username($this->user)) {
				
					$check->result;
					
			} elseif (!$check->chk_pass($password, $password2)) {
				
					$check->result;
				
			} elseif (!$check->chk_email($this->email1, $this->email2)) {
				
					$check->result;
					
			} elseif (!$resp->is_valid) {   
  				
    			echo "<div class=\"error\">". $database->db_fail(CAPTCHA) ." {(reCAPTCHA said: " . $resp->error . ")}</div>";

			} else {
				
					$s_pwd = crypt($password);
					$cfl_user = ucfirst($this->user);
					
					$database->db_add("users", "", "'$cfl_user','$s_pwd', '', '1', '$this->email1', '$time', 
			 		'0001:000:00:00:00', '1', '0', '60', '0', '0', '1', '1', '1', '1', '1', '1'");
				
					$database->db_success("Registration complete, your account <b>$cfl_user</b> 
								has now been created, you may login and begin your journey for time.");
					
					unset($this->user);
					unset($this->email1);
					unset($this->email2);
											
			}
						
		}
			
	} 
	
	/*
		Admin settings
	*/
	public function adm_settings() {
		
		global $database, $check;
		
		$reg_status = $_POST['reg_status'];
		
		if(isset($_POST['site_settings_form'])) {
			
			if ($reg_status == "open") {
				
			 $database->db_update("sitesettings", "regstatus = 'open'", "");
			 
			} else {
				
			 $database->db_update("sitesettings", "regstatus = 'closed'", "");

			}
			
			$database->db_success("Settings changed.");
			
		}
		
	}
	
	public function add_weap() {
		
		global $database, $check;
		
		$this->name = htmlspecialchars($_POST['name']);
		$this->ammo = htmlspecialchars($_POST['ammo']);
		$this->price = htmlspecialchars($_POST['price']);
		$this->level = htmlspecialchars($_POST['level']); 
		$this->damage = htmlspecialchars($_POST['damage']);
		$this->reqs = htmlspecialchars($_POST['reqs']);
		
		if (isset($_POST['addWeap'])) {
			
			if (!$session->isAdmin) {
				
					echo "You shouldn't be here";
					
			}
			
			if (!$this->name || !$this->ammo || !$this->price || !$this->level || !$this->damage || !$this->reqs) {
				
				$database->db_fail(FORM_INCOMPLETE);
							
			} else {
			
					$database->db_success("Weapon added");
					$database->db_add("nc_weap", "", "'', '$this->name', '$this->ammo', '$this->price', '$this->level', '$this->damage', '$this->reqs'");
				
			}
			
		}
		
	}

	
	public function add_item() {
		
		global $database, $check;
		
		$this->name = htmlspecialchars($_POST['name']);
		$this->effect = htmlspecialchars($_POST['effect']);
		$this->level = htmlspecialchars($_POST['level']);
		$this->price = htmlspecialchars($_POST['price']);
		
		if (isset($_POST['addItem'])) {
			
			if (!$session->isAdmin) {
				
					echo "You shouldn't be here";
					
			}
			
			if (!$this->name || !$this->effect || !$this->level || !$this->price) {	
				
				$database->db_fail(FORM_INCOMPLETE);
				
			}	else {
				
				$database->db_success("Item added");
								
			}
		
		}
		
	}
	
	public function add_job() {
		
		global $database, $check;
		
		$this->name = htmlspecialchars($_POST['name']);
		$this->obj = htmlspecialchars($_POST['obj']);
		$this->desc = htmlspecialchars($_POST['desc']);
		$this->reward = htmlspecialchars($_POST['reward']);
		$this->money = htmlspecialchars($_POST['money']);
		$this->reqs = htmlspecialchars($_POST['reqs']);
		
		if (isset($_POST['addJob'])) {
		
			if (!$session->isAdmin) {
				
					echo "You shouldn't be here";
					
			}
		
			if (!$this->name || !$this->obj || !$this->desc || !$this->reward || !$this->money || !$this->reqs) {
				
				$database->db_fail(FORM_INCOMPLETE);
				
			} else {
				
				$database->db_success("Job added");
			
			}
		
		}
		
	}
	
} $form = new form;