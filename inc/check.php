<?php

class check {
	
	/*
		Checks to see if you the username already 
		exists and whether it is long enough to be valid.
	*/
	public function chk_username($user) {
  
		global $database;
		
		//renamed to $username and capitalized the forst letter.
		$username = ucfirst($user);
		
		//check to see if the username already exists in the database.
		$database->db_count("username", "users WHERE username = '$username'");
				
		if ($database->db_count[0][0] > 0) {
			
			$this->result = $database->db_fail(USER_TAKEN);
			return false;
			
		} elseif (strlen($username) <= 4) {
			
			$this->result = $database->db_fail(USER_LENGTH);
			return false;
		
		} else {
			
			return true;
		
		}
	
	}
	
	/*
		Checks the email to see if valid also checks 
		if the user enetered it correctly
	*/
	public function chk_email($email1, $email2) {
	
		global $database;
		
		if (strpos($email1, "@") == 0 || strpos($email1, ".") == 0) {
			
			$this->result = $database->db_fail(EMAIL_INVALID);
			return false;
			
		} elseif ($email1 != $email2) {
			
			$this->result = $database->db_fail(EMAIL_MATCH);
			return false;
			
		} else {
			
			return true;
			
		}
		
	}
	
	/*
		Checks the pass too see if it's longer than 8 chars
		also checks if the user enetered the correct pass twice.	
	*/		
	public function chk_pass($p, $p1) {
		
		global $database;
		
		if (strlen($p) < 8) {
			
			$this->result = $database->db_fail(PASS_LENGTH);
			return false; 
		
		} elseif ($p != $p1) {
			
			$this->result = $database->db_fail(PASS_MATCH);
			return false;
			
		} else {
			
			return true;
			
		}
	
	}
	
	/*
		returns true if the password enetered is the same 
		as the password in the database, returns false otherwise.
	*/
	public function chk_valid_login($usr, $pwd) {
			
		global $database;
		
		$database->db_select("users", "password WHERE username = '$usr'"); 
						
		if (crypt($pwd, $database->db_select[0]["password"]) == $database->db_select[0]["password"]) {
			
			return true;
			
		} else {
			
			return false;
		
		}
						
	}
	
} $check = new check; //declare the class for use as an object 

