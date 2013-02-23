<?php

require_once "databasefactory.php";

$arr = get_defined_vars();
$filter="";
//print_r($arr);


if (isset($_POST['request']))
{
   if ($_POST['request']=="headers")
   {
   	  $db = new DatabaseCreator();
      $database = $db->Create("mysql");
      $database->Connect();

      $HeaderNames = $database->RetrieveHeaderNames();
      
      print json_encode($HeaderNames);     
   }
}

if (isset($_GET['headers']))
{
   
   	  $db = new DatabaseCreator();
      $database = $db->Create("mysql");
      $database->Connect();

      $HeaderNames = $database->RetrieveHeaderNames();     
      
      $data["aaData"] = $HeaderNames;
      
      print json_encode($data);	
}
else if (isset($_GET['tableData']))
{	 
      if (isset($_GET['filter']))
      {
      	 $filter = "WHERE ";      	
	      foreach ($_GET['filter'] as $key => $value)
	      {
	         $filter .= "$key IN ('$value')"; // TODO: ereg_replace A,B by 'A','B'	         		     
		     $filter .= " AND ";
		  }
	      $filter = substr($filter, 0, (strlen($filter) - strlen(" AND ")) );
      }      
      
   	  $db = new DatabaseCreator();
      $database = $db->Create("mysql");
      $database->Connect();
// TODO: Handle empty reults
      $tableData["aaData"] = $database->RetrieveTableData($filter);   
           
      print json_encode($tableData);      
}
else if (isset($_GET['sortedTableData']))
{	
   	  $db = new DatabaseCreator();
      $database = $db->Create("mysql");
      $database->Connect();

      $returnData = $database->RetrieveSortedTableData("TestName","SWID","Actual");
      $json["labels"] = $returnData[0];
      $json["aaData"] = $returnData[1];
                    
      print json_encode($json);      
}
else if (isset($_GET['RetrieveTableFields']))
{	
   	  $db = new DatabaseCreator();
      $database = $db->Create("mysql");
      $database->Connect();

      $returnData = $database->RetrieveTableFields();      
                    
      print json_encode($returnData);      
}
?>