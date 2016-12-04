<?php

  include("inc/connection.php");
  include("inc/functions.php");


  $DistilleryList = getDistilleryList();
  foreach($DistilleryList as $item){
    echo "<p> $item distillery logo </p>";
  }

?>
