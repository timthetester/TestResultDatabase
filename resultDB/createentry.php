<?php
require_once "databaseinterface.php";
require_once "DB.php";
require_once "config.php";

// Check if the table already exists
// Insert 
$mycreate = new create();
$mycreate->InsertData();

class create
{
    function InsertData()
    {
        global $Resultdb;
        
        $this->pdo = new PDO('mysql:host='.$Resultdb['host'].';dbname='.$Resultdb['db'], '', '');
    
        $filter="";
        
    if (isset($_GET['filter']))
    {
       $filter = $_GET['filter'];
    }
        if (!empty($filter))
        {  	              
          foreach ($filter as $key => $value)
          {
              
              $sql = "SHOW TABLES";
		      $statement = $this->pdo->query($sql);
          	  if (!empty($statement))
		      {
		        $match=false;
		        while($row = $statement->fetch(PDO::FETCH_NUM))
	            {        	                
    	            if (strcasecmp($key,$row[0])==0)
	                {
                        $match=true;	            
	                }
	            }
	            if ($match==false)
	            {
	                //$sql = "CREATE TABLE";
		            //$statement = $this->pdo->query($sql);
	            
	            }
		      }		
    	  }      
        }      
    }   
    private $pdo;
}
?>