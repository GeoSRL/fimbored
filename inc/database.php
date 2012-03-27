<?php

class database {
	
	public $lenOfErr;

	/*
		Executes the database request and creates an array, $database->db_select[ROW_#]["ROW_NAME"],
		with the results. 
		@params;
			$table => What table to execute the db request on e.g: "news"
			$extra => Specify what specifics you want e.g: "WHERE name = 'Admin'"
	*/
	public function db_select($table, $extra) {
		
		global $dbh;

		$sth = $dbh->prepare("SELECT * FROM $table $extra"); //prepare the mysql query
		$sth->execute();

		$this->db_select = $sth->fetchAll(); //fetch the result within mysql to form an array

	}

	/*
		Execute a database insert request.bascially inserts the data within the params.
		@params;
			$table => What table to execute the db request on e.g: "news"
			$colname => what is the column name the information will be added too.
			$contents => the main information that will be spat out when using $database->db_select
	*/
	public function db_add($table, $columns, $contents) {

		global $dbh;

		$sth = $dbh->prepare("INSERT INTO $table ( $columns ) VALUES ( $contents )"); 
		$sth->execute(array($contents));

	}
	
	/*
		Updates the table with the contents provided, $extra is for anything specific.
		Example: $extra = "WHERE username = '$session->username'"
	*/
	public function db_update($table, $contents, $extra) {

		global $dbh;

		$sth = $dbh->prepare("UPDATE $table SET $contents $extra"); 
		$sth->execute();

	}
	
	/*
		Counts the table and outputs the result as $database->count_r[0][0]
		$name is used for specific counting, example being $database->countdb("id", "users")
	*/
	public function db_count($name, $table) {

		global $dbh;

		$sth = $dbh->prepare("SELECT COUNT($name) FROM $table");
		$sth->execute();

		$this->db_count = $sth->fetchAll();

	}
	
	/*
		prints the fail message that corresponds with $err_id, example being
		$err_id = 1 this would output "the form is incomplete". $styleid is for
		CSS used when specific styling is needed example is the login form
		located in form.php
	*/
	public function db_fail($error) {
		
		global $form;
		
		$this->lenOfErr = strlen($error);

		echo "<div class=\"error\"> " . $error . "</div>";
	
	 	echo "<script type=\"text/javascript\">";
	 	echo "		setTimeout(function hideIt() { $(\"div.error\").fadeOut() }, 10000);";
	 	echo "</script>";
					
	}

	/*
		prints the success message, $reason, using css
	*/
	public function db_success($reason) {
		
		echo "<div class=\"success\"><img style=\"float: right;\" src=\"http://fimbored.com/m/images/icons/accept.png\"> $reason</div>";

	}

	/*
		Generates a random string of numbers & letters for the forget 
		password form. $length is how many times the function will loop, 
		8 is recommended.
	*/
	public function db_randPass($length) {	

		$arrl = array("a", "b", "c", "d", "e", "f", "g", "h", "i","j", "k", "l", "m",
									"n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
		
		for($i = 0; $i < $length; $i++) {	

			$j = rand(0, 9); 
			$k = rand(0, 7);
				
				if ($k > $j) {

					$final = $fin . rand(0, 9);

				}	else {

					$final = $fin . $arrl[rand(0, 26)];

				}
				$fin = $final;
		 } 
		 echo $final;
	
	}
	
	/* 
		Groups digits upto the limit of 2147 etc.
		Example: input( 34654 )
						output( 34,654 )
	*/			
	public function db_groupDigits($value) {

		$valLength = strlen($value);
		$cutOffVal = array("0", "3", "6");
		$cutOffZone = array("0", "0", "0", "0", "1", "2", "3", "1", "2", "3", "1");
		$loopTimes = array("0", "0", "0", "1", "1", "1", "1", "2", "2", "2", "3");

		for($i = $valLength; $i > 0; $i--) {
			
			if ($valLength < 4) {
				
				echo $value; //no formatting needed, echo $value as is
				
				break; //break out of the loop to avoid duplicates
				
			}	elseif ($valLength == $i) { //if the length of $value = $i then trigger the if statement

				echo substr($value, 0, $cutOffZone[$i]); //echo the first digits

				for($j = 0; $j < $loopTimes[$i]; $j++) { //for loop to echo the rest of $value
					
					echo "," . substr($value, 1 + $cutOffZone[$i] - 1 + $cutOffVal[$j], 3);

				}
				
			} 

		} 	

	}

} $database = new database; //declare the class for use as an object