<div>
  <form method="post" action="#">
  <?php
    echo "<select name='Distillery' class='Search'>";
      $DistilleryList = getDistilleryList();
        echo "<option";
        if($Distillery == 'Search by Distillery'){echo ' selected';}
        echo ">Search by Distillery </option>";
        foreach($DistilleryList as $place){
?>

<option value="<?php echo $place;?>"
  <?php if($Distillery == $place){echo ' selected';}
          // echo "<option value='". $place . "'";
          // if($Distillery == $place){echo ' selected';}
          echo ">" . $place . "</option>";
        }
    echo "</select>";
  ?>

    <select name="StarRanking" class="Search">
      <option value='Star Ranking'<?php if($StarRanking == "Star Ranking"){echo ' selected';}?>>Star Ranking</option>
      <option value='1'<?php if($StarRanking == "1"){echo ' selected';}?>>1 Stars</option>
      <option value='2'<?php if($StarRanking == "2"){echo ' selected';}?>>2 Stars</option>
      <option value='3'<?php if($StarRanking == "3"){echo ' selected';}?>>3 Stars</option>
      <option value='4'<?php if($StarRanking == "4"){echo ' selected';}?>>4 Stars</option>
      <option value='5'<?php if($StarRanking == "5"){echo ' selected';}?>>5 Stars</option>
    </select>

    <input type="Text" name="BourbonSearch" placeholder="Search Bourbon Name" value="" class="Search">

    <input type="Submit" Value="Go" class="searchButton">

  </form>
</div>
