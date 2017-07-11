<?php
// **********************
// CLASS DECLARATION
// **********************

class product_attribute_value extends Database
{ 	// class : begin

// **********************
// ATTRIBUTE DECLARATION
// **********************

var $id;   // KEY ATTR. WITH AUTOINCREMENT

		var $product_attribute_id;   // (normal Attribute)
		var $master_attribute_id;   // (normal Attribute)
		var $master_attribute_value_id;   // (normal Attribute)
		var $value;   // (normal Attribute)
		var $price;   // (normal Attribute)
		var $display_order;   // (normal Attribute)
		var $created;   // (normal Attribute)
		var $modified;   // (normal Attribute)

var $criteria; //criteria of search
var $numRows; // numRows for total records

// **********************
// CONSTRUCTOR METHOD
// **********************
function product_attribute_value()
{
	$this->Database();
	$this->condition = '1 = 1';
}

// **********************
// SELECT METHOD / LOAD
// **********************

function select()
{
$query = "SELECT * FROM product_attribute_value WHERE ";
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
$this->product_attribute_id = $sqlResult["product_attribute_id"];
$this->master_attribute_id = $sqlResult["master_attribute_id"];
$this->master_attribute_value_id = $sqlResult["master_attribute_value_id"];
$this->value = $sqlResult["value"];
$this->price = $sqlResult["price"];
$this->display_order = $sqlResult["display_order"];
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
	$sql = $this->conn->prepare("SELECT * FROM product_attribute_value");
	//echo "<pre>";print_r($sql);
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	$sql->execute();
	$sqlResult = $sql->fetchAll();
	

$this->id = $sqlResult["id"];
$this->product_attribute_id = $sqlResult["product_attribute_id"];
$this->master_attribute_id = $sqlResult["master_attribute_id"];
$this->master_attribute_value_id = $sqlResult["master_attribute_value_id"];
$this->value = $sqlResult["value"];
$this->price = $sqlResult["price"];
$this->display_order = $sqlResult["display_order"];
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
	
$query = "SELECT * FROM product_attribute_value WHERE ";
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
$this->product_attribute_id = $sqlResult["product_attribute_id"];
$this->master_attribute_id = $sqlResult["master_attribute_id"];
$this->master_attribute_value_id = $sqlResult["master_attribute_value_id"];
$this->value = $sqlResult["value"];
$this->price = $sqlResult["price"];
$this->display_order = $sqlResult["display_order"];
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
		$sql =  $this->conn->prepare("DELETE FROM product_attribute_value  WHERE $this->condition");
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
	if(isset($this->product_attribute_id))
	 { 
		array_push($columnClause,"product_attribute_id" );
		array_push($valueClause,"$this->product_attribute_id");
	 } 
	if(isset($this->master_attribute_id))
	 { 
		array_push($columnClause,"master_attribute_id" );
		array_push($valueClause,"$this->master_attribute_id");
	 } 
	if(isset($this->master_attribute_value_id))
	 { 
		array_push($columnClause,"master_attribute_value_id" );
		array_push($valueClause,"$this->master_attribute_value_id");
	 } 
	if(isset($this->value))
	 { 
		array_push($columnClause,"value" );
		array_push($valueClause,"$this->value");
	 } 
	if(isset($this->price))
	 { 
		array_push($columnClause,"price" );
		array_push($valueClause,"$this->price");
	 } 
	if(isset($this->display_order))
	 { 
		array_push($columnClause,"display_order" );
		array_push($valueClause,"$this->display_order");
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
		$sql = $this->conn->prepare("INSERT INTO product_attribute_value ($columnName ) VALUES ( $tempColumnValues )");
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
	if(isset($this->product_attribute_id))
	 { 
		array_push($setClause,"product_attribute_id" );
		array_push($valueClause,"$this->product_attribute_id");
	 } 
	if(isset($this->master_attribute_id))
	 { 
		array_push($setClause,"master_attribute_id" );
		array_push($valueClause,"$this->master_attribute_id");
	 } 
	if(isset($this->master_attribute_value_id))
	 { 
		array_push($setClause,"master_attribute_value_id" );
		array_push($valueClause,"$this->master_attribute_value_id");
	 } 
	if(isset($this->value))
	 { 
		array_push($setClause,"value" );
		array_push($valueClause,"$this->value");
	 } 
	if(isset($this->price))
	 { 
		array_push($setClause,"price" );
		array_push($valueClause,"$this->price");
	 } 
	if(isset($this->display_order))
	 { 
		array_push($setClause,"display_order" );
		array_push($valueClause,"$this->display_order");
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
		$sql = $this->conn->prepare("UPDATE product_attribute_value SET  $columnName WHERE $this->condition ");
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
