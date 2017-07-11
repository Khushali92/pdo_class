<?php
// Class genterator PDO version-2 
// Changes from version-1
// A) Change in update query
// B) Connection close after query execution.(Pending)
//Developer: Ammar Morvania
//Date: 05-August-2016


error_reporting(0);
include("resources/class.database.php");
$database = new Database();

//this code is for change name of child class
function dashesToCamelCase($string, $capitalizeFirstCharacter = false) {
  return preg_replace_callback("/-|_[a-zA-Z]/", 'removeDashAndCapitalize', $string);
}
function removeDashAndCapitalize($matches) {
  return strtoupper($matches[0][1]);
}
//end of change child class name
	
if((@$_REQUEST['f']==""))
{
?>
<font face="Arial" size="3"><b>
PHP PDO Class Generator Version: 2                  
</b>
(From BlackBook Project - August'16)
</font>

<font face="Arial" size="2"><b>
<form action="index.php" method="POST" name="FORMGEN">
1) Select Table Name: 
<br>
<select name="tablename">
<?php
/* $database->OpenLink();
//$tablelist = mysql_list_tables($database->database, $database->link);
$tablelist = mysqli_query($database->link,"SHOW TABLES");

while ($row = mysqli_fetch_row($database->link,$tablelist)) {
print "<option value=\"$row[0]\">$row[0]</option>"; */
//$database->OpenLink();
$database->conn;// to open the connection.
var_dump($database->conn);
//var_dump($conn);
//var_dump($database);
//$tablelist = mysql_list_tables($database->database, $database->link);
//$tablelist = mysqli_query($database->link,"SHOW TABLES");
//$tablelist = $database->conn->query("SHOW TABLES");

$sql = $database->conn->prepare("SHOW TABLES");
//$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute();
$tablelist = $sql->fetchAll();
//echo $rowCount = $sql->rowCount();;
/* $sql = 'SHOW TABLES';
$query = $this->conn->execute($sql);
$tablelist =  $query->fetchAll(PDO::FETCH_COLUMN); */

/* 
echo '<pre>';
 print_r($tablelist); */
 
//while ($row = mysqli_fetch_row($tablelist))
 //while ($tablelist)	
foreach ($tablelist as $tablelist)
{
	//print "<option value=\"$row[0]\">$row[0]</option>";
	print "<option value=\"$tablelist[0]\">$tablelist[0]</option>";
}
?>
</select>
<p>
2) Type Class Name (ex. "test"): <br>
<input type="text" name="classname" size="50" value="">
<p>
3) Type Name of Key Field:
<br>
<input type="text" name="keyname" value="" size="50">
<br>
<font size=1>
(Name of key-field with type number with autoincrement!)
</font>
<p>
<input type="submit" name="s1" value="Generate Class">
<input type="hidden" name="f" value="formshowed">
</form>
</b>
</font>
<p>

<?php
} 
else 
{
// fill parameters from form
$table = $_REQUEST["tablename"];
$class = $_REQUEST["classname"];
$key = $_REQUEST["keyname"];
$childClassName = $_REQUEST["classname"].".child";
$childClass = $_REQUEST["classname"]."Child";
$childClass = dashesToCamelCase($childClass);

$dir = dirname(__FILE__);

$filename = $dir . "/generated_classes/" .$class . ".php";

// if file exists, then delete it
if(file_exists($filename))
{
unlink($filename);
}
// open file in insert mode
$file = fopen($filename, "w+");
$filedate = date("d.m.Y");
$c = "";
$c = "<?php
// **********************
// CLASS DECLARATION
// **********************

class $class extends Database
{ 	// class : begin

// **********************
// ATTRIBUTE DECLARATION
// **********************

var $$key;   // KEY ATTR. WITH AUTOINCREMENT
";

/* $sql = "SHOW COLUMNS FROM $table;";
$database->query($sql);
$result = $database->result; */
$sql = $database->conn->prepare("SHOW COLUMNS FROM $table");
$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute();
$result = $sql->fetchAll();
/* echo "<pre/>";
print_r($result); */
foreach ($result as $row)
{
	$col=$row['Field'];
	if($col!=$key)
	{
		$c.= "
		var $$col;   // (normal Attribute)";
		//print "$col"; exit;
	}
}

$criteria = "$" . "criteria";
$numRows = "$" . "numRows";
$newLine = "\n" ;
//$cdb = "$" . "database";
//$cdb2 = "database";
$c.="

var $criteria; //criteria of search
var $numRows; // numRows for total records
";

$cthis = "$" . "this->";
$thisdb = $cthis . "Database();";
$thisdefaultCondition = $cthis . "condition = '1 = 1';";
$c.= "
// **********************
// CONSTRUCTOR METHOD
// **********************
function $class()
{
	$thisdb
	$thisdefaultCondition
}
";


/*START HERE SELECT ALL RECORDS*/
$c.='
// **********************
// SELECT METHOD / LOAD
// **********************

function select()
{
$query = "SELECT * FROM '.$table.' WHERE ";
$condition= $this->condition;
$param = $this->param;
	if (is_array($condition)) 
	{
		if(isset($condition[\'where_clause\']) && !empty($condition[\'where_clause\']))
		{
			$query .= $condition[\'where_clause\'];
		} // if ends here of checking where_clause
		else 
		{
			$this->error = "where clause is  missing";
			return $this->error;
		} // else ends here of checking where_clause
		
		if(isset($condition[\'limit_clause\']) && !empty($condition[\'limit_clause\']))
		{
			$query .= $condition[\'limit_clause\'];
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
';	

	$sql = $database->conn->prepare("SHOW COLUMNS FROM $table");
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	$sql->execute();
	$result = $sql->fetchAll();
	
	foreach ($result as $row)
	{
		$col=$row["Field"];
		
		$temp = '$this->'.$col.' = $sqlResult["'.$col.'"];';
		
		$c.=$newLine . $temp;
		
	}
	
$c.='
		
		
		return $result;
	} // try block ends here
	catch(PDOException $e)
	{
    	return $this->error = "Query execution error";
    	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
	    
	} // catch block ends here
} // function ends here
';	


/*START HERE SELECT ALL RECORDS*/
$c.='
// **********************
// SELECTALL  METHOD / LOAD
// **********************

function selectAll()
{
		
try
{
	$sql = $this->conn->prepare("SELECT * FROM '. $table.'");
	//echo "<pre>";print_r($sql);
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	$sql->execute();
	$sqlResult = $sql->fetchAll();
	
';

$sql = $database->conn->prepare("SHOW COLUMNS FROM $table");
$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute();
$result = $sql->fetchAll();

foreach ($result as $row)
{
	$col=$row["Field"];

	$temp = '$this->'.$col.' = $sqlResult["'.$col.'"];';

	$c.=$newLine . $temp;

}

$c.='
return $sqlResult;
} // try block ends here
catch(PDOException $e)
{
    	return $this->error = "Query execution error";
    	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
    
} // catch block ends here
} // function ends here
				
';
/*SELECT ALL RECORDS END HERE*/


$c.='
// **********************
// selectByCriteria  METHOD / LOAD
// **********************

function selectByCriteria()
{
	
$query = "SELECT * FROM '.$table.' WHERE ";
$condition= $this->condition;
$param = $this->param;
	if (is_array($condition)) 
	{
		if(isset($condition[\'where_clause\']) && !empty($condition[\'where_clause\']))
		{
			$query .= $condition[\'where_clause\'];
		} // if ends here of checking where_clause
		else 
		{
			$this->error = "where clause is  missing";
			return $this->error;
		} // else ends here of checking where_clause
		
		if(isset($condition[\'limit_clause\']) && !empty($condition[\'limit_clause\']))
		{
			$query .= $condition[\'limit_clause\'];
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
';
$sql = $database->conn->prepare("SHOW COLUMNS FROM $table");
$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute();
$result = $sql->fetchAll();

foreach ($result as $row)
{
	$col=$row["Field"];

	$temp = '$this->'.$col.' = $sqlResult["'.$col.'"];';

	$c.=$newLine . $temp;

}

$c.='
$this->numRows = $sql->rowCount();

		
return $result;
} // try block ends here
catch(PDOException $e)
{
   	return $this->error = "Query execution error";
   	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
	    
} // catch block ends here
} // function ends here
';
/*END HERE SEARCH METHOD*/

/*DELETE METHOD STARTS HERE*/
$c.='
// **********************
// DELETE
// **********************

function delete()
{
	try
	{	
		$sql =  $this->conn->prepare("DELETE FROM '. $table.'  WHERE $this->condition");
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
    			
';

/*DELETE METHOD ENDS HERE*/


/*INSERT METHOD STARTS HERE*/

$sql = $database->conn->prepare("SHOW COLUMNS FROM $table");
$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute();
$result = $sql->fetchAll();

foreach ($result as $row)
{
	$col=$row["Field"];

	if($col!=$key)
	{
		$columnInsert .= "\tif(isset("."$"."this->$col))\n";
		$columnInsert .= "\t { \n";
		$columnInsert .= "\t\tarray_push($"."columnClause,".'"'."$col".'" );'."\n";
		$columnInsert .= "\t\tarray_push($"."valueClause,".'"'."$" . "this->$col".'"'.");\n";
		//$columnInsert .= "\t\tarray_push($"."valueClause,"."."$" . "this->$col".'"'.");\n";
		//$columnInsert .= '\t\tarray_push($valueClause ,"$this->'.$col.'");';
		//$columnInsert .= "\t\tarray_push($".valueClause .",$"."this->$col".");\n";
		$columnInsert .= "\t } \n";
	}

}	
$columnImpload = "$"."columnName = implode(',',"."$"."columnClause);";
$valueImpload = "$"."columnValue = implode(',',"."$"."valueClause);";	
		
$c.='
// **********************
// INSERT
// **********************

function insert()
{

$this->'.$key.' = ""; // clear key for autoincrement

$valueClause = array();
$columnClause = array();
'.$columnInsert.'
for ($i=0; $i<count($columnClause);$i++)
	{
		if ($i != 0)
			$tempColumnValues .= ", ";
			
		$tempColumnValues .= "?";
	} 
'.$columnImpload.' 
'.$valueImpload.'
	try
	{	
		$sql = $this->conn->prepare("INSERT INTO '.$table.' ($columnName ) VALUES ( $tempColumnValues )");
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
		
		
		
';


/*INSERT METHOD ENDS HERE*/

/*UPDATE METHOD STARTS HERE*/

$sql = $database->conn->prepare("SHOW COLUMNS FROM $table");
$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute();
$result = $sql->fetchAll();

foreach ($result as $row)
{
	$col=$row["Field"];

	if($col!=$key)
	{
		$columnUpdate .= "\tif(isset("."$"."this->$col))\n";
		$columnUpdate .= "\t { \n";
		$columnUpdate .= "\t\tarray_push($"."setClause,".'"'."$col".'" );'."\n";
		$columnUpdate .= "\t\tarray_push($"."valueClause,".'"'."$" . "this->$col".'"'.");\n";
		$columnUpdate .= "\t } \n";
	}

}

$columnImpload = "$"."columnName = implode(',',"."$"."setClause);";
$valueImpload = "$"."columnValue = implode(',',"."$"."valueClause);";	

$c.='
// **********************
// UPDATE
// **********************

function update()
{
$valueClause = array();
$setClause = array();
'.$columnUpdate.'
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
		$sql = $this->conn->prepare("UPDATE '.$table.' SET  $columnName WHERE $this->condition ");
		//echo "<pre>";print_r($sql); print_r($valueClause);
		$result = $sql->execute($valueClause);
		$this->'.$key.' = $sql->rowCount();
		return $result;
	} // try block ends here
	catch(PDOException $e)
	{
    	return $this->error = "Query execution error";
    	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
    
	} // catch block ends here
} // function ends here
';

/*UPDATE METHOD ENDS HERE*/



$c.="
} // class ends here
";


fwrite($file, $c);

$dir = dirname(__FILE__);

$filename = $dir . "/generated_classes/" .$childClassName . ".php";

// if file exists, then delete it
if(file_exists($filename))
{
	unlink($filename);
}
// open file in insert mode
$file = fopen($filename, "w+");
$filedate = date("d.m.Y");
$c = "";
$c = "<?php
// **********************
// CLASS DECLARATION
// **********************

require_once('baseclasses/$class.php');

class $childClass extends $class
{ 	// class : begin


// **********************
// CONSTRUCTOR METHOD
// **********************

function $childClass()
{
$"."this->$class();
}
";
/*SELECT BY JOIN METHOD STARTS HERE*/
$c .= '
//**************//
//SELECT BY JOIN//
//**************//

function selectByJoin()
{

$query = "SELECT $this->selectColumn FROM $this->alias WHERE ";
$condition= $this->condition;
$param = $this->param;
	if (is_array($condition)) 
	{
		if(isset($condition[\'where_clause\']) && !empty($condition[\'where_clause\']))
		{
			$query .= $condition[\'where_clause\'];
		} // if ends here of checking where_clause
		else 
		{
			$this->error = "where clause is  missing";
			return $this->error;
		} // else ends here of checking where_clause
		
		if(isset($condition[\'limit_clause\']) && !empty($condition[\'limit_clause\']))
		{
			$query .= $condition[\'limit_clause\'];
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
		$this->numRows = $sql->rowCount();
		//print_r($result);
		
		return $result;
	} // try block ends here
	catch(PDOException $e)
	{
    	return $this->error = "Query execution error";
    	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
	    
	} // catch block ends here
} // function ends here
';
/*SELECT BY JOIN METHOD ENDS HERE*/

/*SELECT BY COLUMN METHOD STARTS HERE*/
$c .= '
//****************//
//SELECT BY COLUMN//
//****************//

function selectByColumn()
{
		
$query = "SELECT $this->selectColumn FROM '.$table.' WHERE ";
$condition= $this->condition;
$param = $this->param;
	if (is_array($condition)) 
	{
		if(isset($condition[\'where_clause\']) && !empty($condition[\'where_clause\']))
		{
			$query .= $condition[\'where_clause\'];
		} // if ends here of checking where_clause
		else 
		{
			$this->error = "where clause is  missing";
			return $this->error;
		} // else ends here of checking where_clause
		
		if(isset($condition[\'limit_clause\']) && !empty($condition[\'limit_clause\']))
		{
			$query .= $condition[\'limit_clause\'];
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
		$this->numRows = $sql->rowCount();
		//print_r($result);
		
		return $result;
	} // try block ends here
	catch(PDOException $e)
	{
    	return $this->error = "Query execution error";
    	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
	    
	} // catch block ends here
} // function ends here
';
/*SELECT BY COLUMN METHOD ENDS HERE*/

/*BULK INSERT METHOD STARTS HERE*/
$c .= '
//**************//
//  BULK INSERT //
//**************//

function bulkInsert($data)
{
$this->'.$key.' = "" ;
	try
	{
		//Will contain SQL snippets.
		$rowsSQL = array();

		//Will contain the values that we need to bind.
		$toBind = array();

		//Get a list of column names to use in the SQL statement.
		$columnNames = array_keys($data[0]);	
			
		//Loop through our $data array.
		foreach($data as $arrayIndex => $row)
		{
			$params = array();
			foreach($row as $columnName => $columnValue)
			{
				$param = ":" . $columnName . $arrayIndex;
				$params[] = $param;
				$toBind[$param] = $columnValue;
			} // foreach loop ends here
			$rowsSQL[] = "(" . implode(", ", $params) . ")";
		}	//foreach loop ends here
			
		//Construct our SQL statement

		$sql = $this->conn->prepare("INSERT INTO '.$table.' (" . implode(", ", $columnNames) . ") VALUES " . implode(", ", $rowsSQL));
		
	    //Bind the values.
		foreach($toBind as $param => $val)
		{
			$sql->bindValue($param, $val);
		}
		
		$result = $sql->execute();
		$this->id = $this->conn->lastInsertId();
		return $result;
	} // try block ends here
	catch(PDOException $e)
	{
    	return $this->error = "Query execution error";
    	file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
	} // catch block ends here
} // function ends here
';
/*BULK INSERT METHOD ENDS HERE*/


$c.= "
} // class : end
?>
";	
//echo "C Value : <br/>".$c;

fwrite($file, $c);


print "
<font face=\"Arial\" size=\"3\"><b>
PHP PDO Class Generator
</b>
<p>
<font face=\"Arial\" size=\"2\"><b>
Class '$class' successfully generated as file '$filename'!
<p>
<a href=\"javascript:history.back();\">
back
</a>

</b></font>

";

?>


<?php
} // endif
?>
