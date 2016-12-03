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
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<h1>Login</h1>
<div id="login">

<h2>Login Form</h2>

<?php
  if(isset($_SESSION['errorLoginMsg'])){
      echo "<h4>" . $_SESSION['errorLoginMsg'] . "</h4>";
  }
?>

    <form action="../admin/login.php" method="post">
    <label>UserName :</label>
    <input id="username" name="username" placeholder="username" type="text">
    <label>Password :</label>
    <input id="password" name="password" placeholder="**********" type="password">
    <input name="submit" type="submit" value=" Login ">
    </form>


</div>
</div>
</body>
</html>
