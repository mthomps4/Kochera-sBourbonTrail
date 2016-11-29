<?php

function getBourbonList($Distillery,$StarRanking,$BourbonSearch){
  include 'connection.php';
  $sql = "SELECT * FROM `Bourbon List`"; //get all

  if(isset($Distillery) && isset($StarRanking)){
    $Distillery = str_replace("'", "\'", $Distillery);
      if($Distillery != "Search by Distillery"){
        if($StarRanking != "Star Ranking"){
          $sql = "SELECT * FROM `Bourbon List` WHERE `Distillery`= '$Distillery' && `Score` = $StarRanking";
        }
      }
    }

  if(isset($Distillery) && ($StarRanking == "Star Ranking")){
    $Distillery = str_replace("'", "\'", $Distillery);
      if($Distillery != "Search by Distillery"){
        $sql = "SELECT * FROM `Bourbon List` WHERE `Distillery`= '$Distillery'";
      }
    }

  if(isset($StarRanking) && ($Distillery == "Search by Distillery")){
    if($StarRanking != "Star Ranking"){
      $sql = "SELECT * FROM `Bourbon List` WHERE `Score` = $StarRanking";
        }
      }

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
     return false;
   }
   $temp = $results->fetchAll(PDO::FETCH_ASSOC);

   $list = array();
   foreach($temp as $item){
     if(!in_array(trim($item['Distillery']), $list)){
       array_push($list, trim($item['Distillery']));
     }
   }
   asort($list);
   return $list;
}//getDistilleryList

?>
