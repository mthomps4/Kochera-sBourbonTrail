<?php
  session_start();
?>

<?php
  include("../inc/connection.php");
  include("../inc/functions.php");

$Distillery = "Search by Distillery";
$StarRanking = "Star Ranking";
$BourbonSearch = "";
$reset = "";

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if($_POST['submit'] == "Search"){
      $Distillery = $_POST['Distillery'];
      // $Distillery = trim(filter_input(INPUT_POST, 'Distillery', FILTER_SANITIZE_STRING));
      $StarRanking = trim(filter_input(INPUT_POST, 'StarRanking', FILTER_SANITIZE_STRING));
      $BourbonSearch = trim(filter_input(INPUT_POST, 'BourbonSearch', FILTER_SANITIZE_STRING));
    }

      $reset = $_POST['reset'];
  }

  // echo $Distillery;
  // echo $StarRanking;
  // echo $BourbonSearch;
?>

<!doctype html>
<html>
<head>
  <title>Kochera's Bourbon Trail</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
      <link rel="stylesheet" href="../styles/main.css">
</head>
<body>

<div class="loginFlex">
  <a class="login" href="logout.php"> Logout </a>
</div>

<header>
    <h1 class='title'> Admin Panel</h1>
</header>

<?php include("../templates/_filter.php"); ?>

<div class="addFlex">
  <a href="addBourbon.php" class="addButton"> Add New Review </a>
</div>

<div class="bourbonListContainer">

<?php

  $BourbonList = getBourbonList($Distillery,$StarRanking,$BourbonSearch);
  if(empty($BourbonList)){
    echo "<h3 class= 'notFound'> No Bourbon Found </h3>";
  }else{

    //Sort by Name
    foreach($BourbonList as $key => $row){
      $name[$key] = $row['Name'];
    }
    array_multisort($name, SORT_STRING, $BourbonList);
    foreach($BourbonList as $item){
      echo "<div class='AdminCard'>";
        echo "<p class='AdminCardName'><b>" . $item['Name'] . "</b></p>";
        echo "<p>" . $item['Distillery'] . " Distillery</p>";
        echo "<p>" . $item['Proof'] . " Proof</p>";
        echo "<p>" . $item['Score'] . " Stars</p>";
        echo "<p> Reviewed in " . $item['Reviewed'] . "</p>";
        echo "<a class='editButton' href='../admin/edit.php/?id=" . $item['id'] . "'>Edit</a>";
        echo "<a class='deleteButton' ontouchstart=this.classList.toggle('hover'); href='../admin/delete.php/?id=" . $item['id'] ."'> Delete </a>";
      echo "</div>";
    }
  }
?>

</div>

<?php include("../templates/_footer.php"); ?>
