<?php
// **********************
// CLASS DECLARATION
// **********************

class master_attribute extends Database
{ 	// class : begin

// **********************
// ATTRIBUTE DECLARATION
// **********************

var $id;   // KEY ATTR. WITH AUTOINCREMENT

		var $name;   // (normal Attribute)
		var $category_id;   // (normal Attribute)
		var $created;   // (normal Attribute)
		var $modified;   // (normal Attribute)

var $criteria; //criteria of search
var $numRows; // numRows for total records

// **********************
// CONSTRUCTOR METHOD
// **********************
function master_attribute()
{
	$this->Database();
	$this->condition = '1 = 1';
}

// **********************
// SELECT METHOD / LOAD
// **********************

function select()
{
$query = "SELECT * FROM master_attribute WHERE ";
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
$this->name = $sqlResult["name"];
$this->category_id = $sqlResult["category_id"];
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
	$sql = $this->conn->prepare("SELECT * FROM master_attribute");
	//echo "<pre>";print_r($sql);
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	$sql->execute();
	$sqlResult = $sql->fetchAll();
	

$this->id = $sqlResult["id"];
$this->name = $sqlResult["name"];
$this->category_id = $sqlResult["category_id"];
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
	
$query = "SELECT * FROM master_attribute WHERE ";
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
$this->name = $sqlResult["name"];
$this->category_id = $sqlResult["category_id"];
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
		$sql =  $this->conn->prepare("DELETE FROM master_attribute  WHERE $this->condition");
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
	if(isset($this->name))
	 { 
		array_push($columnClause,"name" );
		array_push($valueClause,"$this->name");
	 } 
	if(isset($this->category_id))
	 { 
		array_push($columnClause,"category_id" );
		array_push($valueClause,"$this->category_id");
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
		$sql = $this->conn->prepare("INSERT INTO master_attribute ($columnName ) VALUES ( $tempColumnValues )");
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
	if(isset($this->name))
	 { 
		array_push($setClause,"name" );
		array_push($valueClause,"$this->name");
	 } 
	if(isset($this->category_id))
	 { 
		array_push($setClause,"category_id" );
		array_push($valueClause,"$this->category_id");
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
		$sql = $this->conn->prepare("UPDATE master_attribute SET  $columnName WHERE $this->condition ");
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
