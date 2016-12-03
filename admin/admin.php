<?php
session_id();
session_start();
//var_dump(get_defined_vars());

if(isset($_SESSION['DataPassword'])){
  echo "DataPassword";
  var_dump( $_SESSION['DataPassword']);
  echo "<br>";
}
if(isset($_SESSION['UserPassword'])){
  echo "UserPassword: ";
  var_dump($_SESSION['UserPassword']);
  echo "<br>";
}
  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
    header("location: profile.php");
  }
?>


<!DOCTYPE html>
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
    <a class="login" href="/"> Home </a>
  </div>

<?php
  if(isset($_SESSION['errorLoginMsg'])){
      echo "<h4>" . $_SESSION['errorLoginMsg'] . "</h4>";
  }
?>

<div  class="loginFormFlex">
    <form class="loginForm" action="../admin/login.php" method="post">
      <h2>Login</h2>

  <div class="formField">
    <label>UserName :</label>
    <input id="username" name="username" placeholder="username" type="text">
  </div>

  <div  class="formField">
    <label>Password :</label>
    <input id="password" name="password" placeholder="**********" type="password">
  </div>

  <div  class="formField">
    <input class="submit" name="submit" type="submit" value=" Login ">
  </div>
    </form>
</div>

<?php include("../templates/_footer.php"); ?>


</body>
</html>
