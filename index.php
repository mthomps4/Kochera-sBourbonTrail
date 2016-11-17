<?php
include("connection.php");
include("functions.php");


$wishlist = getBourbonList();
foreach($wishlist as $item){
  echo "Name: " .  $item['Name'] . " Proof: " . $item['Proof'] . "<br>" ;
}



?>
