<div>
  <form method="post" action="/">
  <?php
    echo "<select id='Distillery' class='Search'>";
      $DistilleryList = getDistilleryList();
        echo "<option> Distillery </option>";
        foreach($DistilleryList as $place){
          echo "<option>" . $place . "</option>";
        }
    echo "</select>";
  ?>

    <select id="StarRanking" class="Search">
      <option>Star Ranking</option>
      <option>1 Stars</option>
      <option>2 Stars</option>
      <option>3 Stars</option>
      <option>4 Stars</option>
      <option>5 Stars</option>
    </select>

    <input type="Text" id="BourbonSearch" placeholder="Search Bourbon Name" value="" class="Search">

    <input type="Submit" Value="Filter Results">

  </form>
</div>
