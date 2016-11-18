<?php

function getBourbonList($Distillery,$StarRanking,$BourbonSearch){
  include 'connection.php';
  $sql = "SELECT * FROM `Bourbon List`"; //get all

  if(isset($Distillery)){
    $Distillery = str_replace("'", "\'", $Distillery);
      if($Distillery != "Search by Distillery"){
      $sql = "SELECT * FROM `Bourbon List` WHERE `Distillery`= '$Distillery'";
        }
    }

  if(isset($StarRanking)){
    if($StarRanking != "Star Ranking"){
      $sql = "SELECT * FROM `Bourbon List` WHERE `Score` = $StarRanking";
        }
      }

    var_dump($sql);

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
