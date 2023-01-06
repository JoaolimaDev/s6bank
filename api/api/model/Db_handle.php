<?php 
namespace model;

require_once("Database.php");

class Handle 
{

public static function Db_handle()
{
    $database = new Database;


   

        return $database->connect();

    

 

  
  
}
    
}





?>