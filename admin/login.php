<?php
session_start();
include('../inc/connection.php'); // Includes Login Script
if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty($_POST['password'])) {
    $_SESSION['errorLoginMsg'] = "Username or Password is empty.";
    header("Location: admin.php");
  }
  else
    {
      // Define $username and $password
      $username= $_POST['username'];
      $password= $_POST['password'];
      $password= md5($password);
      $sql="SELECT `password` FROM `login` WHERE `username` = ? LIMIT 1";
      try {
      $results = $db->prepare($sql);
      $results->bindParam(1,$username, PDO::PARAM_STR);
      $results->execute();
      } catch(Exception $e){
        echo "Error!: " . $e->getMessage() . "<br>";
       return false;
      }
        $DataPassword = $results->fetch(PDO::FETCH_ASSOC);
        $DataPassword = md5($DataPassword['password']);
        if($password === $DataPassword)
        {
          $_SESSION['logged_in'] = true;
          $_SESSION['username'] = $username;
          header("Location: profile.php");
        }
        else{
          $_SESSION['logged_in'] = false;
          $_SESSION['errorLoginMsg'] = "Username and Password do not match!";
          header("Location: admin.php");
        }
    }//else
  }
//if empty
?>
