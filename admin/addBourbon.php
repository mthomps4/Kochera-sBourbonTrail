<?php
session_start();
if(!$_SESSION["logged_in"]){
  $_SESSION['errorLoginMsg'] = "You have been logged out. Log back in to Add Item.";
  header("Location: /");
}
include '../inc/functions.php';

$Name = "";
$Distillery = "";
$Proof = "";
$Score = "";
$Reviewed = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $Name = trim(filter_input(INPUT_POST, 'NAME', FILTER_SANITIZE_STRING));
  $Distillery = trim(filter_input(INPUT_POST, 'Distillery', FILTER_SANITIZE_STRING));
  $Proof = trim(filter_input(INPUT_POST, 'Proof', FILTER_SANITIZE_STRING));
  $Score = trim(filter_input(INPUT_POST, 'Score', FILTER_SANITIZE_NUMBER_INT));
  $Reviewed = trim(filter_input(INPUT_POST, 'YearReviewed', FILTER_SANITIZE_NUMBER_INT));

if (empty($Name) || empty($Proof)){
      $error_message = 'Please fill in the fileds: Name / Proof';
    }
elseif($Distillery == ""){
      $error_message = "Please pick a Distillery";
    }
elseif($Score == ""){
      $error_message = "Please Rank Your Bourbon!";
    }
elseif($Reviewed == ""){
      $error_message = "What year is it?";
    }
else{
      if(add_item($Name, $Distillery, $Proof, $Score, $Reviewed)){
        header('Location: ../admin/admin.php');
        exit;
      }else{
        $error_message='Could not add project.';
      }
    }
}//IF POST

?>

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
  <a class="login" href="admin.php"> Admin Panel </a>
</div>

<header>
    <h1 class='title'> Add Bourbon Review </h1>
</header>

<?php
if(isset($error_message)){
  echo "<p>" . $error_message . "</p>";
}
?>


<div class="addFormFlex">
<form class="addForm" method="Post" action"#">
  <label for="NAME"> Name: </label>
    <input type="text" id="NAME" name="NAME" value="<?php if(isset($Name)){echo $Name;}?>" placeholder="Name">

  <label for="Distillery"> Distillery: </label>
    <select class="selectBox" id="Distillery" name="Distillery">
      <?php
        $DistilleryList = getDistilleryList();
          echo "<option";
          if($Distillery == ""){
            echo " selected";
          }
          echo "></option>";
        foreach($DistilleryList as $place){
        ?>
        <option value=
        <?php
          echo "'" . $place . "'";
            if($Distillery == $place){
              echo " selected";
            }
          echo ">";
          echo "$place";
          echo "</option>";
        }
        ?>

    </select>

    <label for="Proof"> Proof: </label>
    <input type="number" id="Proof" name="Proof" min="0" max="9999" step="0.1" size="4" value="<?php if(isset($Proof)){echo $Proof;}?>" />

    <label for="Score"> Score Ranking: </label>
    <select class="selectBox" name="Score" id="Score">
      <option value="" <?php if($Score == ""){echo " selected";}?>></option>
      <option value="1" <?php if($Score == "1"){echo " selected";}?>>1</option>
      <option value="2" <?php if($Score == "2"){echo " selected";}?>>2</option>
      <option value="3" <?php if($Score == "3"){echo " selected";}?>>3</option>
      <option value="4" <?php if($Score == "4"){echo " selected";}?>>4</option>
      <option value="5" <?php if($Score == "5"){echo " selected";}?>>5</option>
    </select>

    <label for="YearReviewed"> Reviewed: </label>
    <select id="YearReviewed" name="YearReviewed" class="selectBox">
        <option value="" <?php if($Reviewed == ""){echo " selected";}?>> </option>
        <?php
           for($i = 2010 ; $i <= date('Y'); $i++){
              echo "<option value='" . $i . "'";
              if($Reviewed == $i){echo " selected";}
              echo ">" . $i . "</option>";
           }
        ?>
    </select>

    <input class="submit" name="submit" type="submit" value="Add Review">

</form>
</div>
<?php include("../templates/_footer.php"); //BOGO ADFSD  ?>
