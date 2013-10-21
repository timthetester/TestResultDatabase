<?php
// Dependent on the api.php file
require_once "api.php";


$filter="";
$api = new Api("unit");

// Retrieve the column names of the table
if (isset($_GET['headers']))
{
   print $api->RetrieveHeaders();   	 
}
// Return table data whether the filter is set or not 
else if (isset($_GET['tableData']) )
{	 
    $filter = "";
    if (isset($_GET['filter']))
    {
       $filter = $_GET['filter'];
    }
   print $api->RetrieveTableData($filter);   
}
// Return sorted data whether the filter is set or not
else if (isset($_GET['sortedTableData']))
{	
    $filter = "";
    if (isset($_GET['filter']))
    {
       $filter = $_GET['filter'];
    }
	  print $api->RetrieveSortedTableData($filter);
}
else if (isset($_GET['RetrieveTableFields']))
{	    
   	  print $api->RetrieveTableFields();          
}
else if (isset($_GET['RetrieveTableField']) && isset($_GET['field']))
{	
   	  print $api->RetrieveTableField($_GET['field']);           
}
?>