<?php
  include("inc/connection.php");
  include("inc/functions.php");
  include("templates/_header.php");

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

  include("templates/_filter.php");
?>

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
      echo "<div class='cardContainer' ontouchstart=this.classList.toggle('hover');>";
      echo "<div class='flipper'>";

        echo "<div class='cardFront'>";
          echo "<div class='frontInfo'>";
              echo "<img src='http://ultimatebourbonlist.com/wp-content/uploads/2015/08/bourbonglass20.jpg' alt='Woodford'/>";
            echo "<div class='flexTitle'>";
              echo "<h3 class='frontTitle'>" . $item['Name'] . "</h3>";
              // echo "<p class='frontDistillery'>" . $item['Distillery'] . "</p>";

           echo "<p class='frontScore'>";
              for ($i = 1; $i <= $item['Score']; $i++){
                echo "<img src='../styles/GoldStar.png' alt='star rank' />";
              }
            echo "</p>";//Star Rank


            echo "</div>";
          echo "</div>"; // frontInfo
        echo "</div>"; // cardFront

        echo "<div class='cardBack'>";
          echo "<div class='backInfo'>";
            echo "<p class='backTitle'>" . $item['Name'] . "</h3>";
            echo "<p class='Distillery'>" . $item['Distillery'] . " Distillery</p>";
            echo "<p class='proof'>" . $item['Proof'] . "  Proof</p>";
            echo "<p class='Reviewed'> Year Reviewed:  " . $item['Reviewed'] . "</p>";
            echo "<p class='backScore'> Ranking:  ";
                for ($i = 1; $i <= $item['Score']; $i++){
                  echo "<img src='../styles/GoldStar.png' alt='star rank' />";
                 }
            echo "</p>";//Star Rank
          echo "</div>"; // backInfo
        echo "</div>"; // cardBack


      echo "</div>"; //flipper
      echo "</div>"; // cardContainer
    }
}
?>

</div>



<?php include("templates/_footer.php"); ?>
