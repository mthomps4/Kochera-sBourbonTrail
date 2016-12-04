<?php
session_start();
if(!$_SESSION["logged_in"]){
  $_SESSION['errorLoginMsg'] = "You have been logged out. Log back in to Add Item.";
  header("Location: /");
}
include '../inc/functions.php';
if (isset($_GET['id'])){
  $id = $_GET['id'];
  $results = get_item($id);

  $Name = $results['Name'];
  $Distillery = $results['Distillery'];
  $Proof = $results['Proof'];
  $Score = $results['Score'];
  $Reviewed = $results['Reviewed'];
}else{
  header("Location: profile.php");//return if no ID set
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['ID'])){
    include '../inc/connection.php';
    $id = trim(filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_STRING));
    $sql= "DELETE FROM `Bourbon List`
         WHERE `id` = $id
         LIMIT 1";
   try{
     $results = $db->prepare($sql);
     $results->execute();
   } catch(Exception $e){
     echo "Error!: " . $e->getMessage(). "<br>";
   }
   header('Location: ../profile.php');
 }
}
?>
<html>
<head>
  <title>Kochera's Bourbon Trail</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
      <link type="text/css" rel="stylesheet" href="../../styles/main.css">
</head>
<body>

<div class="loginFlex">
  <a class="login" href="../admin.php"> Admin Panel </a>
</div>

<header>
    <h1 class='title'> Delete Bourbon Review? </h1>
</header>

<?php
if(isset($error_message)){
  echo "<p>" . $error_message . "</p>";
}
?>

<div class="deleteContent">
  <h2>Confirm Delete</h2>
  <p><b>Name: <?php echo $Name;?></b></p>
  <p> Distillery: <?php echo $Distillery;?></p>
  <p> Proof: <?php echo $Proof;?></p>
  <p> Score: <?php echo $Score;?></p>
  <p> Reviewed: <?php echo $Reviewed;?></p>
</div>


<div class="confirm">
  <form method="post" action="#">
    <input type="hidden" value="<?php echo $id; ?>" name="ID" />
    <button class="confirmDelete" type='submit'>Yes, Delete</button>
  </form>

  <a href="../profile.php"><button class="cancelDelete" >No, Cancel</button></a>
</div>

<?php include("../templates/_footer.php"); //BOGO ADFSD  ?>
