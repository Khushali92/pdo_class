<?php
// **********************
// CLASS DECLARATION
// **********************

class user extends Database
{ 	// class : begin

// **********************
// ATTRIBUTE DECLARATION
// **********************

var $id;   // KEY ATTR. WITH AUTOINCREMENT

		var $uid;   // (normal Attribute)
		var $technology_id;   // (normal Attribute)
		var $oauth_token;   // (normal Attribute)
		var $first_name;   // (normal Attribute)
		var $last_name;   // (normal Attribute)
		var $mobile_no;   // (normal Attribute)
		var $location;   // (normal Attribute)
		var $dob;   // (normal Attribute)
		var $timezone;   // (normal Attribute)
		var $email;   // (normal Attribute)
		var $gender;   // (normal Attribute)
		var $profile_pic;   // (normal Attribute)
		var $college_name;   // (normal Attribute)
		var $university_enrollment_no;   // (normal Attribute)
		var $residence_city;   // (normal Attribute)
		var $status;   // (normal Attribute)
		var $puzzle_score;   // (normal Attribute)
		var $quiz_time;   // (normal Attribute)
		var $invite_friend_credit;   // (normal Attribute)
		var $created;   // (normal Attribute)
		var $modified;   // (normal Attribute)

var $criteria; //criteria of search
var $numRows; // numRows for total records

// **********************
// CONSTRUCTOR METHOD
// **********************
function user()
{
	$this->Database();
	$this->condition = '1 = 1';
}

// **********************
// SELECT METHOD / LOAD
// **********************

function select()
{
$query = "SELECT * FROM user WHERE ";
$condition= $this->condition;
$param = $this->param;
	if (is_array($condition)) 
	{
		if(isset($condition['where_clause']) && !empty($condition['where_clause']))
		{
			$query .= $condition['where_clause'];
		} // if ends here of checking where_clause
		else 
		{
			$this->error = "where clause is  missing";
			return $this->error;
		} // else ends here of checking where_clause
		
		if(isset($condition['limit_clause']) && !empty($condition['limit_clause']))
		{
			$query .= $condition['limit_clause'];
		} // if ends here of checking limit_clause
		
	}// if ends here
	else
	{
		$query .= $condition;
	} // else ends here
		
	try
	{		
		$sql = $this->conn->prepare("$query");
		//echo "<pre>";print_r($sql);	
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$sql->execute($param);
		$result = $sql->fetch();	
		//print_r($result);	

$this->id = $sqlResult["id"];
$this->uid = $sqlResult["uid"];
$this->technology_id = $sqlResult["technology_id"];
$this->oauth_token = $sqlResult["oauth_token"];
$this->first_name = $sqlResult["first_name"];
$this->last_name = $sqlResult["last_name"];
$this->mobile_no = $sqlResult["mobile_no"];
$this->location = $sqlResult["location"];
$this->dob = $sqlResult["dob"];
$this->timezone = $sqlResult["timezone"];
$this->email = $sqlResult["email"];
$this->gender = $sqlResult["gender"];
$this->profile_pic = $sqlResult["profile_pic"];
$this->college_name = $sqlResult["college_name"];
$this->university_enrollment_no = $sqlResult["university_enrollment_no"];
$this->residence_city = $sqlResult["residence_city"];
$this->status = $sqlResult["status"];
$this->puzzle_score = $sqlResult["puzzle_score"];
$this->quiz_time = $sqlResult["quiz_time"];
$this->invite_friend_credit = $sqlResult["invite_friend_credit"];
$this->created = $sqlResult["created"];
$this->modified = $sqlResult["modified"];
		
		
		return $result;
	} // try block ends here
	catch(PDOException $e)
	{
    	return $this->error = "Query execution error";
    	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
	    
	} // catch block ends here
} // function ends here

// **********************
// SELECTALL  METHOD / LOAD
// **********************

function selectAll()
{
		
try
{
	$sql = $this->conn->prepare("SELECT * FROM user");
	//echo "<pre>";print_r($sql);
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	$sql->execute();
	$sqlResult = $sql->fetchAll();
	

$this->id = $sqlResult["id"];
$this->uid = $sqlResult["uid"];
$this->technology_id = $sqlResult["technology_id"];
$this->oauth_token = $sqlResult["oauth_token"];
$this->first_name = $sqlResult["first_name"];
$this->last_name = $sqlResult["last_name"];
$this->mobile_no = $sqlResult["mobile_no"];
$this->location = $sqlResult["location"];
$this->dob = $sqlResult["dob"];
$this->timezone = $sqlResult["timezone"];
$this->email = $sqlResult["email"];
$this->gender = $sqlResult["gender"];
$this->profile_pic = $sqlResult["profile_pic"];
$this->college_name = $sqlResult["college_name"];
$this->university_enrollment_no = $sqlResult["university_enrollment_no"];
$this->residence_city = $sqlResult["residence_city"];
$this->status = $sqlResult["status"];
$this->puzzle_score = $sqlResult["puzzle_score"];
$this->quiz_time = $sqlResult["quiz_time"];
$this->invite_friend_credit = $sqlResult["invite_friend_credit"];
$this->created = $sqlResult["created"];
$this->modified = $sqlResult["modified"];
return $sqlResult;
} // try block ends here
catch(PDOException $e)
{
    	return $this->error = "Query execution error";
    	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
    
} // catch block ends here
} // function ends here
				

// **********************
// selectByCriteria  METHOD / LOAD
// **********************

function selectByCriteria()
{
	
$query = "SELECT * FROM user WHERE ";
$condition= $this->condition;
$param = $this->param;
	if (is_array($condition)) 
	{
		if(isset($condition['where_clause']) && !empty($condition['where_clause']))
		{
			$query .= $condition['where_clause'];
		} // if ends here of checking where_clause
		else 
		{
			$this->error = "where clause is  missing";
			return $this->error;
		} // else ends here of checking where_clause
		
		if(isset($condition['limit_clause']) && !empty($condition['limit_clause']))
		{
			$query .= $condition['limit_clause'];
		} // if ends here of checking limit_clause
		
	}// if ends here
	else
	{
		$query .= $condition;
	} // else ends here
		
	try
	{		
		$sql = $this->conn->prepare("$query");
		//echo "<pre>";print_r($sql);	
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$sql->execute($param);
		$result = $sql->fetchAll();	
		//print_r($result);

$this->id = $sqlResult["id"];
$this->uid = $sqlResult["uid"];
$this->technology_id = $sqlResult["technology_id"];
$this->oauth_token = $sqlResult["oauth_token"];
$this->first_name = $sqlResult["first_name"];
$this->last_name = $sqlResult["last_name"];
$this->mobile_no = $sqlResult["mobile_no"];
$this->location = $sqlResult["location"];
$this->dob = $sqlResult["dob"];
$this->timezone = $sqlResult["timezone"];
$this->email = $sqlResult["email"];
$this->gender = $sqlResult["gender"];
$this->profile_pic = $sqlResult["profile_pic"];
$this->college_name = $sqlResult["college_name"];
$this->university_enrollment_no = $sqlResult["university_enrollment_no"];
$this->residence_city = $sqlResult["residence_city"];
$this->status = $sqlResult["status"];
$this->puzzle_score = $sqlResult["puzzle_score"];
$this->quiz_time = $sqlResult["quiz_time"];
$this->invite_friend_credit = $sqlResult["invite_friend_credit"];
$this->created = $sqlResult["created"];
$this->modified = $sqlResult["modified"];
$this->numRows = $sql->rowCount();

		
return $result;
} // try block ends here
catch(PDOException $e)
{
   	return $this->error = "Query execution error";
   	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
	    
} // catch block ends here
} // function ends here

// **********************
// DELETE
// **********************

function delete()
{
	try
	{	
		$sql =  $this->conn->prepare("DELETE FROM user  WHERE $this->condition");
		//echo "<pre>";print_r($sql);
		$result = $sql->execute();
		$this->numRows = $sql->rowCount();
		return $result;
	} // try block ends here
	catch(PDOException $e)
	{
    	return $this->error = "Query execution error";
    	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
	    
	} // catch block ends here
} // function ends here
    			

// **********************
// INSERT
// **********************

function insert()
{

$this->id = ""; // clear key for autoincrement

$valueClause = array();
$columnClause = array();
	if(isset($this->uid))
	 { 
		array_push($columnClause,"uid" );
		array_push($valueClause,"$this->uid");
	 } 
	if(isset($this->technology_id))
	 { 
		array_push($columnClause,"technology_id" );
		array_push($valueClause,"$this->technology_id");
	 } 
	if(isset($this->oauth_token))
	 { 
		array_push($columnClause,"oauth_token" );
		array_push($valueClause,"$this->oauth_token");
	 } 
	if(isset($this->first_name))
	 { 
		array_push($columnClause,"first_name" );
		array_push($valueClause,"$this->first_name");
	 } 
	if(isset($this->last_name))
	 { 
		array_push($columnClause,"last_name" );
		array_push($valueClause,"$this->last_name");
	 } 
	if(isset($this->mobile_no))
	 { 
		array_push($columnClause,"mobile_no" );
		array_push($valueClause,"$this->mobile_no");
	 } 
	if(isset($this->location))
	 { 
		array_push($columnClause,"location" );
		array_push($valueClause,"$this->location");
	 } 
	if(isset($this->dob))
	 { 
		array_push($columnClause,"dob" );
		array_push($valueClause,"$this->dob");
	 } 
	if(isset($this->timezone))
	 { 
		array_push($columnClause,"timezone" );
		array_push($valueClause,"$this->timezone");
	 } 
	if(isset($this->email))
	 { 
		array_push($columnClause,"email" );
		array_push($valueClause,"$this->email");
	 } 
	if(isset($this->gender))
	 { 
		array_push($columnClause,"gender" );
		array_push($valueClause,"$this->gender");
	 } 
	if(isset($this->profile_pic))
	 { 
		array_push($columnClause,"profile_pic" );
		array_push($valueClause,"$this->profile_pic");
	 } 
	if(isset($this->college_name))
	 { 
		array_push($columnClause,"college_name" );
		array_push($valueClause,"$this->college_name");
	 } 
	if(isset($this->university_enrollment_no))
	 { 
		array_push($columnClause,"university_enrollment_no" );
		array_push($valueClause,"$this->university_enrollment_no");
	 } 
	if(isset($this->residence_city))
	 { 
		array_push($columnClause,"residence_city" );
		array_push($valueClause,"$this->residence_city");
	 } 
	if(isset($this->status))
	 { 
		array_push($columnClause,"status" );
		array_push($valueClause,"$this->status");
	 } 
	if(isset($this->puzzle_score))
	 { 
		array_push($columnClause,"puzzle_score" );
		array_push($valueClause,"$this->puzzle_score");
	 } 
	if(isset($this->quiz_time))
	 { 
		array_push($columnClause,"quiz_time" );
		array_push($valueClause,"$this->quiz_time");
	 } 
	if(isset($this->invite_friend_credit))
	 { 
		array_push($columnClause,"invite_friend_credit" );
		array_push($valueClause,"$this->invite_friend_credit");
	 } 
	if(isset($this->created))
	 { 
		array_push($columnClause,"created" );
		array_push($valueClause,"$this->created");
	 } 
	if(isset($this->modified))
	 { 
		array_push($columnClause,"modified" );
		array_push($valueClause,"$this->modified");
	 } 

for ($i=0; $i<count($columnClause);$i++)
	{
		if ($i != 0)
			$tempColumnValues .= ", ";
			
		$tempColumnValues .= "?";
	} 
$columnName = implode(',',$columnClause); 
$columnValue = implode(',',$valueClause);
	try
	{	
		$sql = $this->conn->prepare("INSERT INTO user ($columnName ) VALUES ( $tempColumnValues )");
		//echo "<pre>";print_r($sql); print_r($valueClause);
		$result = $sql->execute($valueClause);
		$this->id = $this->conn->lastInsertId();	
		return $result;		
	} // try block ends here
	catch(PDOException $e)
	{
    	return $this->error = "Query execution error";
    	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
	    
	} // catch block ends here
} // function ends here
		
		
		

// **********************
// UPDATE
// **********************

function update()
{
$valueClause = array();
$setClause = array();
	if(isset($this->uid))
	 { 
		array_push($setClause,"uid" );
		array_push($valueClause,"$this->uid");
	 } 
	if(isset($this->technology_id))
	 { 
		array_push($setClause,"technology_id" );
		array_push($valueClause,"$this->technology_id");
	 } 
	if(isset($this->oauth_token))
	 { 
		array_push($setClause,"oauth_token" );
		array_push($valueClause,"$this->oauth_token");
	 } 
	if(isset($this->first_name))
	 { 
		array_push($setClause,"first_name" );
		array_push($valueClause,"$this->first_name");
	 } 
	if(isset($this->last_name))
	 { 
		array_push($setClause,"last_name" );
		array_push($valueClause,"$this->last_name");
	 } 
	if(isset($this->mobile_no))
	 { 
		array_push($setClause,"mobile_no" );
		array_push($valueClause,"$this->mobile_no");
	 } 
	if(isset($this->location))
	 { 
		array_push($setClause,"location" );
		array_push($valueClause,"$this->location");
	 } 
	if(isset($this->dob))
	 { 
		array_push($setClause,"dob" );
		array_push($valueClause,"$this->dob");
	 } 
	if(isset($this->timezone))
	 { 
		array_push($setClause,"timezone" );
		array_push($valueClause,"$this->timezone");
	 } 
	if(isset($this->email))
	 { 
		array_push($setClause,"email" );
		array_push($valueClause,"$this->email");
	 } 
	if(isset($this->gender))
	 { 
		array_push($setClause,"gender" );
		array_push($valueClause,"$this->gender");
	 } 
	if(isset($this->profile_pic))
	 { 
		array_push($setClause,"profile_pic" );
		array_push($valueClause,"$this->profile_pic");
	 } 
	if(isset($this->college_name))
	 { 
		array_push($setClause,"college_name" );
		array_push($valueClause,"$this->college_name");
	 } 
	if(isset($this->university_enrollment_no))
	 { 
		array_push($setClause,"university_enrollment_no" );
		array_push($valueClause,"$this->university_enrollment_no");
	 } 
	if(isset($this->residence_city))
	 { 
		array_push($setClause,"residence_city" );
		array_push($valueClause,"$this->residence_city");
	 } 
	if(isset($this->status))
	 { 
		array_push($setClause,"status" );
		array_push($valueClause,"$this->status");
	 } 
	if(isset($this->puzzle_score))
	 { 
		array_push($setClause,"puzzle_score" );
		array_push($valueClause,"$this->puzzle_score");
	 } 
	if(isset($this->quiz_time))
	 { 
		array_push($setClause,"quiz_time" );
		array_push($valueClause,"$this->quiz_time");
	 } 
	if(isset($this->invite_friend_credit))
	 { 
		array_push($setClause,"invite_friend_credit" );
		array_push($valueClause,"$this->invite_friend_credit");
	 } 
	if(isset($this->created))
	 { 
		array_push($setClause,"created" );
		array_push($valueClause,"$this->created");
	 } 
	if(isset($this->modified))
	 { 
		array_push($setClause,"modified" );
		array_push($valueClause,"$this->modified");
	 } 

    for ($i=0; $i<count($setClause);$i++)
    {
        if ($i != 0)
        {
            $columnName .= " , $setClause[$i] = ?";
        }
        else
        {
            $columnName .= "$setClause[$i] = ?";
        }
    } 

	try
	{	
		$sql = $this->conn->prepare("UPDATE user SET  $columnName WHERE $this->condition ");
		//echo "<pre>";print_r($sql); print_r($valueClause);
		$result = $sql->execute($valueClause);
		$this->id = $sql->rowCount();
		return $result;
	} // try block ends here
	catch(PDOException $e)
	{
    	return $this->error = "Query execution error";
    	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
    
	} // catch block ends here
} // function ends here

} // class ends here
