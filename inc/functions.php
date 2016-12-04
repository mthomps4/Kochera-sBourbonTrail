<?php

function getBourbonList($Distillery,$StarRanking,$BourbonSearch){
  include 'connection.php';
  $sql = "SELECT * FROM `Bourbon List`"; //get all
if(isset($BourbonSearch)){

    if(isset($BourbonSearch) && isset($Distillery) && isset($StarRanking)){
      $Distillery = str_replace("'", "\'", $Distillery);
      if($Distillery != "Search by Distillery"){
        if($StarRanking != "Star Ranking"){
          $sql = "SELECT * FROM `Bourbon List` WHERE `Distillery`= '$Distillery' && `Score` = $StarRanking && `Name` LIKE '%$BourbonSearch%'";
        }
      }
    }

    if(isset($BourbonSearch) && isset($Distillery) && ($StarRanking == "Star Ranking")){
      $Distillery = str_replace("'", "\'", $Distillery);
      if($Distillery != "Search by Distillery"){
          $sql = "SELECT * FROM `Bourbon List` WHERE `Distillery`= '$Distillery' && `Name` LIKE '%$BourbonSearch%'";
        }
      }

      if(isset($BourbonSearch) && isset($StarRanking) && ($Distillery == "Search by Distillery")){
        if($StarRanking != "Star Ranking"){
          $sql = "SELECT * FROM `Bourbon List` WHERE `Score` = $StarRanking && `Name` LIKE '%$BourbonSearch%'";
        }
      }

      if(isset($BourbonSearch) && ($StarRanking == "Star Ranking") && ($Distillery == "Search by Distillery")){
        $sql = "SELECT * FROM `Bourbon List` WHERE `Name` LIKE '%$BourbonSearch%'";
      }
}

else{
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


function add_item($Name, $Distillery, $Proof, $Score, $Reviewed){
  include 'connection.php';
    $sql = 'INSERT INTO `Bourbon List` (`Name`, `Distillery`, `Proof`, `Score`, `Reviewed`)
    VALUES(?, ?, ?, ?, ?)';
    try {
      $results = $db->prepare($sql);
      $results->bindValue(1, $Name, PDO::PARAM_STR);
      $results->bindValue(2, $Distillery, PDO::PARAM_STR);
      $results->bindValue(3, $Proof, PDO::PARAM_STR);
      $results->bindValue(4, $Score, PDO::PARAM_STR);
      $results->bindValue(5, $Reviewed, PDO::PARAM_STR);
      $results->execute();
    } catch (Exception $e) {
      echo "Error!: " . $e->getMessage() . "<br>";
      return false;
    }
    return true;
}//Add Item
?>
