
<div class='years'> 
    <?php
    foreach ($years as $year) {
        echo "<p><a href=\"" . base_url("Archives/byyear") . "/" . $year . "\">" . $year . "</a> </p>";
    }
    ?>

</div> 
