<?php

// sql to delete a record
include ("connection.php");
 $connection=new Connection();
 include ("client.php");
 $connection->selectDatabase("cdtx");

 Client::deleteClient("clients",$connection->conn,$_GET['deletedId']);


?>