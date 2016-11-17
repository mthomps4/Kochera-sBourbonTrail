<?php
include 'cred.php';
try{
  $db = new PDO("mysql:host=localhost;dbname=$dbname",$dbuser,$dbpw);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo 'Connected to Database';
}catch(Exception $e){
  echo $e->getMessage();
  exit;
}

?>
