<?php
//require_once('config/config.php');
require_once($_SERVER['DOCUMENT_ROOT']."/assignment/config/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/assignment/database/DbConnectionCls.php");
class DbClass
{
 
  var $tempVar;
  var $resSet;
  var $query;
  var $result;
  var $error;
  var $numRows;
  var $recentId;
  var $arrays;
  var $val=array();

 function __construct()
 {
	//DbConnection::GetDbConnection();
 }	


 function getDbInstance(){
	$con = DbConnection::GetDbConnection();
	return $con;
 }

 /**
 * Inserts a table row with specified data.
 */
function InsertData($tableName, $inputData)
{	 
	$con = $this->getDbInstance();
    $q = "INSERT INTO `".$tableName."` ";
    $v = '';
    $n = '';
    
    foreach ($inputData as $col=>$val) {
        $n .= "`$col`, ";
        if (strtolower($val) == 'null')
            $v .= "NULL, ";
        elseif (strtolower($val) == 'now()')
            $v .= "NOW(), ";
        elseif (strtolower($val) == 'curdate()') 
            $v .= "CURDATE(), ";
        else 
            $v .= "N'".$this->EscapeInputData($con,trim($val))."', ";
    }
    
    $q .= "(".rtrim($n, ', ').") VALUES (".rtrim($v, ', ').");";
    
    $this->query=$q;

    if ($this->ExecuteQuery($con)) {

	   return true;
    } else 
        return false;
        
}


/**
 * Updates table rows with specified data based on a WHERE clause.
 *
 */
function UpdateData($tableName, $inputData, $where = false)
{
	$con = $this->getDbInstance();	
    $q = "UPDATE `".$tableName."` SET ";        
    foreach ($inputData as $col=>$val) {
        if (strtolower($val) == 'null')
            $q .= "`$col` = NULL, ";
        elseif (strtolower($val) == 'now()')
            $q .= "`$col` = NOW(), ";
        elseif (strtolower($val) == 'curdate()') 
            $q .= "`$col` = CURDATE(), ";
        else 
            $q .= "`$col`=N'".$this->EscapeInputData($con,trim($val))."', ";
    }        
    $q = rtrim($q, ', ').' WHERE '.$where.';';
	
	$this->query=$q;
	 
    if ($this->ExecuteQuery($con)) 
	return true;
    else 
    return false;
}


function CustomQuery($query)
{
	$con = $this->getDbInstance();	
   	
	$this->query=$query;
	 
    if ($this->ExecuteQuery($con)) 
	return true;
    else 
    return false;
}


function FetchRecord($tableName,$conditionArray)
{
	
	$con = $this->getDbInstance();
	$this->tempVar=1;
	$arraySize = count($conditionArray);
	$q="SELECT * FROM ".$tableName. " WHERE ";
	foreach($conditionArray as $col=>$val) 
	{ 
		if($this->tempVar < $arraySize)
		{
			$q .= "$col =N'".$this->EscapeInputData($con,trim($val))."' AND "; 
		}
		else
		{	$q .= "$col =N'".$this->EscapeInputData($con,trim($val))."'";
		}				
		$this->tempVar++;
	}
	$this->query=$q;
	if($this->ExecuteQuery($con))
	return true;
	else
	return false;

}

function FetchParticularColumn($tableName,$fetchcol,$conditionArray)
{
	
	$con = $this->getDbInstance();
	$this->tempVar=1;
	$arraySize = count($conditionArray);
	$q="SELECT ".$fetchcol."  FROM ".$tableName. " WHERE ";
	foreach($conditionArray as $col=>$val) 
	{ 
		if($this->tempVar < $arraySize)
		{
			$q .= "$col =N'".$this->EscapeInputData($con,trim($val))."' AND "; 
		}
		else
		{	$q .= "$col =N'".$this->EscapeInputData($con,trim($val))."'";
		}				
		$this->tempVar++;
	}
	$this->query=$q;
	if($this->ExecuteQuery($con))
	return true;
	else
	return false;

}


function FetchAllRecord($tableName)
{
	$con = $this->getDbInstance();
	$result = array(); 
	$q="SELECT * FROM ".$tableName;
	  
        $this->query=$q;
	if($this->ExecuteQuery($con))
	{
		return true;  
	}
	else
	{
		return false;  
	}
    
}


/** 
 * escapes characters to be mysql ready
 *
 */

function EscapeInputData($con,$inputString)
{
	// checks is there an active connection 
	if ($con != null) 
	{  		     
	    //  "magic quotes" are ON 
	    if (get_magic_quotes_gpc()) {       
	        // strip slashes 
	        $returnValue = stripslashes($inputString);
	    }
	    
	    // escape the string 
	    $returnValue = mysqli_real_escape_string($con,$inputString);
	    
	    // return escaped string 
	    return $returnValue;
	    
    }
    else
    {			
	    //if connection is not active 
	     return $inputString;
	    
	}
    
}


function DeleteData($tableName,$where)
{
	$con = $this->getDbInstance();
    $this->query="DELETE FROM ".$tableName." WHERE ".$where.";";  
   	return $this->ExecuteQuery($con);
}




function ExecuteQuery($con) 
{
	if(isset($this->query))
	{
		//execute query	
		
		mysqli_query($con,"set character_set_results='utf8'"); 
		$this->result = mysqli_query($con,$this->query);
		//log mysql error if any
		$message = '';
		$message = mysqli_error($con);
		//echo "hi".$message;
		if($message != '')
		{
			echo $message;
			$this->error = $message;
		}
		
		//recently inserted id				
		$this->recentId=mysqli_insert_id($con);

		if($this->result)
		{
			$this->numRows=mysqli_affected_rows($con);
		}
		
		// result of data array or assoc val		        
		if($this->numRows > 0)
		{
			$this->val = $this->ReturnAssocArray();
			$this->arrays = $this->ReturnArray();
			$this->rowVal = $this->ReturnRowVal();
			$this->query="";
			mysqli_close($con);
			 return 1;
		}else
	        { 
			return 0;
		}	
    }          
	else
	{
		echo "--Null Query--";
	}

}

function ReturnArray()
{
    $arrays=array(); 
    if(is_object($this->result)){
        while($row=mysqli_fetch_array($this->result))
		{
         		$arrays[]=$row;
		}	
	}			

	return $arrays;
}

function ReturnAssocArray()
{
    $arrays=array();
    if(is_object($this->result)){
        while($row=mysqli_fetch_assoc($this->result))
		{
             		$arrays[]=$row;
		}	
	}			

	return $arrays;
}



function ReturnRowVal()
{
    $rowval=array();
    if(is_object($this->result)){
        while($row=mysqli_fetch_row($this->result))
		{
             		$rowval[]=$row;
		}
	}				

	return $rowval;
}

}

?>


