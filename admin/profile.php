<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Your Home Page</title>
  </head>
<body>

<?php
  if(isset($_SESSION['username'])){
    echo "Your name transfered YO!";
    echo "<br>";
    echo $_SESSION['username'];
  }
?>

<div>
<p>Welcome : <?php echo $_SESSION['username']; ?></p>
<a href="logout.php">Log Out</a>
</div>

</body>
</html>
