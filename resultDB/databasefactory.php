<?php

require_once "databaseinterface.php";
require_once "mysqldatabase.php";

class DatabaseCreator
{
	public function Create($DatabaseType)
	{
		if ($DatabaseType == "mysql")
		{
			return new mysqldatabase();
		}
		else
		{
			// Not supported yet
		}
	}
}

?>