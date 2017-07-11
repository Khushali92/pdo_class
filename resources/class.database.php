<?php
 class Database
 { // Class : begin
 
	 var $host;  		//Hostname, Server
	 var $password; 	//Passwort MySQL
	 var $user; 		//User MySQL
	 var $database; 	//Datenbankname MySQL
	 var $link;
	 var $query;
	 var $result;
	 var $rows;
	 var $conn;
	 function Database()
	 { 
	
		 
		  $this->host = "localhost";
		  $this->dbPassword = "";   
		  $this->user = "root";     
		  $this->database = "gsecom";	//philly  //bidguru_associate
					// finger_scanner remax quickly   hairscouts  screen_capture4 agency_catalog blackbook  gsecom
		  $this->rows = 0;
		 
		 // **********************************************
		  try 
		  {
		  	$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->dbPassword);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		  }
		  catch(PDOException $e) 
		  {
		  	echo $e->getMessage();
		  }
			  
   	} // Method : end
		 
  
 } // Class : end
 
?>
