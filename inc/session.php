<?php

	include('config.php');
	include('database.php');
	include('form.php');
	include('check.php');
	include('page.php');

class session {
	
	var $loggedIn; #true if the session is active
	var $time; #current time in ms 
	var $s_id; #current session id
	var $username; #current username active within the session
	var $isAdmin; #is the user currently logged in an admin? 
	
	 function Session() {
		 
      $this->time = time();
      $this->startSession();
			
   }
	
	/*
		Starts the session. Sets whether $this->loggedIn is true
		if it is true sets the variables that will be used.
		does nothing if $this->loggedIn is False.
	*/ 
	function startSession() {
		
		global $database;  //The database connection
		
		session_start();   //Tell PHP to start the session
		$this->s_id = session_id();
		$this->loggedIn = $this->checkLogin();
		
		if ($this->loggedIn) {
			
			$database->db_select("users", "WHERE userid = '$this->s_id'");
			//sets the session variables
			$this->username  = $database->db_select[0]["username"]; 	
			$this->userlevel = $database->db_select[0]["userlevel"];
			
			//check whether the user is an Admin
			if ($this->userlevel == 9) {
			
				$this->isAdmin = true;
			
			}
		
		}
		
	}
	
	/*
		Checks whether the user is loggedin and 
		returns true if the session id is present
	*/
	public function checkLogin() {
		
		global $dbh, $database;
		
		$database->db_count("userid", "users WHERE userid = '$this->s_id'");
				
		if ($database->db_count[0][0] > 0) {
		
			return true;
			
		} else {
		
			return false;
					
		}
		
	}
	
	/*
		Converts the users time into seconds and 
		performs addition or subtraction based on $take.
		When addition or subtraction has been performed 
		it converts the seconds back into the game time format.
	*/	
	public function convertTime($tm, $tmtk, $take) {
		
		$time = array(explode(':', $tm), explode(':', $tmtk)); #ln 94
		$initialArr = array("365", "365", "24", "60", "60", "1");  #ln 95
		$reverseArr = array_reverse($initialArr); #ln 107
		$numArr = array("4", "3", "2", "2", "2"); #ln 123
		
		$starttime = microtime();
		
		for($j = 0; $j < 2; $j++) {
		 unset($tmp_time); #Clear the $tmp_time var, avoid wrong integer reporting.
			for ($i = 0; $i < strlen($time); $i++) {
			
				$time_in_secs[$j] = $tmp_time + $time[$j][$i]; #Adds the value of $tmp_time to the current $time var based on the value of $j & $i. 
				$tmp_time = $time_in_secs[$j] * $initialArr[$i+1]; #Times the current $fin_time to the $initialArr var based on the value of $i+1
				
			}
		}
		
		if (!$take) {
			$fin_time = $time_in_secs[0] + $time_in_secs[1]; #adds the secnds array value to the first to get the $fin_time
		} else {
			$fin_time = $time_in_secs[0] - $time_in_secs[1]; #subtracts the secnds array value to the first to get the $fin_time
		}
					
		for ($t = 0; $t < strlen($time); $t++) {
			$create_float = $fin_time / $reverseArr[$t]; #creates the first float by dividing the time in seconds with the correct unit of time in reverseArr[$t]
			$fin_time = $create_float;		
		}
	
		$intval = intval($create_float); #snips the float value and creates the whole integer
		$float = $create_float - $intval; #subtracts the whole ineteger creaetd on ln 125 by the $fine_time toget the float value
		$time[0] = $intval; #sets the float value to $time[array]
						
		for ($i = 1; $i < strlen($initialArr); $i++) {							
			$gettime = $float * $initialArr[$i]; #finds the correct $gettime by * the $float by the correct unit of time in $initialArr[$i]
			$time[$i] = intval($gettime); #snips the whole integer from the result of $gettime and sets the var $time[$i]
			$float = $gettime - $time[$i]; #creates the $float for the next part of the time								
		}
		
		#incorporates the misc "0" to polish the time format.	
		for ($i = 0; $i < strlen($numArr); $i++) {								
			$time_len = strlen($time[$i]);				
				if ($numArr[$i]-$time_len > 0) {				
					for ($ii = 0; $ii < $numArr[$i]-$time_len; $ii++) {						
						$add_zero = "0" . $add_zero; 						
					}				
					$time[$i] = $add_zero . ceil($time[$i]);				
				}		
			 unset($add_zero);				
		}		
		#finally implode $time and echo the result;				
		return implode(":", $time);
		
	}
	
	public function login() {
		header("Location: http://fimbored.com/m/");
	}
	
	/*
		Updates the users userid to NULL, sets $this->loggedIn to false
		regenerates a new session id for the user, and relocates them to 
		the homepage.
	*/
	public function logout() {
	
		global $database;
	
		$logoutTrue = htmlspecialchars(stripslashes(trim($_GET['p'])));
		$getsID = htmlspecialchars(stripslashes(trim($_GET['sid'])));
		
		if ($this->s_id == $getsID && $logoutTrue == 'logout' && $this->loggedIn) {
			
			$database->db_update("users", "userid = ''", "WHERE username = '$this->username'");
			$this->loggedIn = false;
			session_regenerate_id(true);
			header('Location: /m');
						
		} 

	}
	
} $session = new session; //declare the class for use as an object