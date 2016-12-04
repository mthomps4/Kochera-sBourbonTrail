<?php

function getBourbonList($Distillery,$StarRanking,$BourbonSearch){
  include 'connection.php';
  $sql = "SELECT * FROM `Bourbon List`"; //get all
  $Distillery = str_replace("'", "\'", $Distillery);

if(!empty($BourbonSearch)){

    if(isset($BourbonSearch) && isset($Distillery) && isset($StarRanking)){
      // $Distillery = str_replace("'", "\'", $Distillery);
      if($Distillery != "Search by Distillery"){
        if($StarRanking != "Star Ranking"){
          $sql = "SELECT * FROM `Bourbon List` WHERE `Distillery`= '$Distillery' && `Score` = $StarRanking && `Name` LIKE '%$BourbonSearch%'";
        }
      }
    }

    if(isset($BourbonSearch) && isset($Distillery) && ($StarRanking == "Star Ranking")){
      // $Distillery = str_replace("'", "\'", $Distillery);
      if($Distillery != "Search by Distillery"){
          $sql = "SELECT * FROM `Bourbon List` WHERE `Distillery`= '$Distillery' && `Name` LIKE '%$BourbonSearch%'";
        }
      }

      if(isset($BourbonSearch) && isset($StarRanking) && ($Distillery == "Search by Distillery")){
        // $Distillery = str_replace("'", "\'", $Distillery);
        if($StarRanking != "Star Ranking"){
          $sql = "SELECT * FROM `Bourbon List` WHERE `Score` = $StarRanking && `Name` LIKE '%$BourbonSearch%'";
        }
      }

      if(isset($BourbonSearch) && ($StarRanking == "Star Ranking") && ($Distillery == "Search by Distillery")){
        // $Distillery = str_replace("'", "\'", $Distillery);
        $sql = "SELECT * FROM `Bourbon List` WHERE `Name` LIKE '%$BourbonSearch%'";
      }
}

else{
  if(isset($Distillery) && isset($StarRanking)){
    // $Distillery = str_replace("'", "\'", $Distillery);
      if($Distillery != "Search by Distillery"){
        if($StarRanking != "Star Ranking"){
          $sql = "SELECT * FROM `Bourbon List` WHERE `Distillery`= '$Distillery' && `Score` = $StarRanking";
        }
      }
    }

  if(isset($Distillery) && ($StarRanking == "Star Ranking")){
    // $Distillery = str_replace("'", "\'", $Distillery);
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

function get_item($id){
  include 'connection.php';
     $sql = 'SELECT * FROM `Bourbon List` WHERE `id` = ?';
     try {
       $results = $db->prepare($sql);
       $results->bindValue(1, $id, PDO::PARAM_INT);
       $results->execute();
     } catch (Exception $e) {
       echo "Error!: " . $e->getMessage() . "<br>";
       return false;
     }
     return $results->fetch(PDO::FETCH_ASSOC);
}//get_Item

function update_item($Name, $Distillery, $Proof, $Score, $Reviewed,$id){
  include '../inc/connection.php';
  $sql = "UPDATE `Bourbon List`
          SET `Name`= '$Name',
              `Distillery` = '$Distillery',
              `Proof` = '$Proof',
              `Score` = '$Score',
              `Reviewed` = '$Reviewed'
              WHERE `id` = '$id'";
  try{
    echo $sql;
    $results = $db->prepare($sql);
    $results->execute();
  }catch (Exception $e) {
    echo "Error!: " . $e->getMessage() . "<br>";
    return false;
  }
  return header('Location: ../profile.php');
}
?>
