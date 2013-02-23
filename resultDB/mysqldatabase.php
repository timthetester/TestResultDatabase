<?php

require_once "databaseinterface.php";
require_once "DB.php";

// Implement the database interface
class mysqlDatabase implements iDatabase
{
	private $pdo;
	
	public function Connect()
	{		
		$this->pdo = new PDO('mysql:host=localhost;dbname=testresult', '', '');		
	}
    public function Disconnect()
    {
		print "Disconnect";
	}

	public function RetrieveHeaderNames()
	{
		$headerNames = "";
		
		$sql = "SHOW COLUMNS FROM summary";
		
		$statement = $this->pdo->query($sql);
        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {        
           $headerNames[] = $row['Field'];
        }
        
		return $headerNames;
	}
	
	/*public function RetrieveTableData($ColumnNames)*/
	public function RetrieveTableData($filter)	
	{
		$sql = "SELECT * from summary $filter";
		
		$statement = $this->pdo->query($sql);
		
	    while($row = $statement->fetch(PDO::FETCH_NUM))
        {        
        	$json[]=$row;        	
        }
        return $json;
	}
	
	public function RetrieveTableFields()	
	{
		$Fields = $this->RetrieveHeaderNames();
		$returnData = array();
		foreach ($Fields as $Field)
		{
		   $sql = "SELECT DISTINCT($Field) from summary";
		   $statement = $this->pdo->query($sql);
		
		   $json = array();
		   $json[] = $Field;
	       while($row = $statement->fetch(PDO::FETCH_NUM))
           {        
        	  $json[]=$row;        	
           }
           $returnData[]=$json;
		}
        return $returnData;
	}
	
	public function RetrieveSortedTableData($x, $y, $z)	
	{
		$sql = "SELECT $x, $y from summary";
		$statement = $this->pdo->query($sql);
		
		while($row = $statement->fetch(PDO::FETCH_NUM))
        {                	
        	$columnName[$row[0]] = "a";
        	$rowName[$row[1]]="b";
        }
        
        foreach ($columnName as $col => $val1)
        {
        	foreach ($rowName as $row => $val2)
        	{        		        		
        		$matrix[$col][$row] = "-";           		
        	}
        }       
        
        $label[]=$x;
	    foreach ($rowName as $row => $val)
	    {        		        		        	
        	$label[]="SWID" . $row;     	
        }
		
		$sql = "SELECT $x, $y, $z from summary";
		$statement = $this->pdo->query($sql);
		
	    while($row = $statement->fetch(PDO::FETCH_NUM))
        {        	
        	$matrix[$row[0]][$row[1]] = $row[2];       
        }       
       
        
        
        foreach ($matrix as $key => $val)
        {        	
        	$mymatrix = array();
        	$mymatrix[]=$key;
        	foreach ($val as $column)
            {
               $mymatrix[]=$column;
            }
            $json[]=$mymatrix;            
        }
        
        $returnjson[]=$label;
        $returnjson[]=$json;
     
        return $returnjson;
	}
}
?>