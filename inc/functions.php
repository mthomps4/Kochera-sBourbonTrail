<?php

function getBourbonList(){
  include 'connection.php';
      $sql = "SELECT * FROM `Bourbon List`"; //get all
  try{
    $results = $db->prepare($sql);
      if(isset($filter)){
        $results->bindParam(1, $filter);
      }
    $results->execute();
  }catch(Exception $e){
    echo "Error: " . $e->getMessage() . "<br>";
    return false;
  }
  $wishlist = $results->fetchAll(PDO::FETCH_ASSOC);
  return $wishlist;
}//getBourbonList


function getDistilleryList(){
  include 'connection.php';
   $sql = "SELECT `Distillery` FROM `Bourbon List`";
   try{
     $results = $db->prepare($sql);
     $results->execute();

   }catch(Exception $e){
     echo "Error: " . $e->getMessage() . "<br>";
     echo "BLAH";
     return false;
   }
   $temp = $results->fetchAll(PDO::FETCH_ASSOC);
   $list = array();
   foreach($temp as $item){
     if(!in_array($item['Distillery'], $list)){
       array_push($list, $item['Distillery']);
     }
   }
   return $list;
}//getDistilleryList

?>
