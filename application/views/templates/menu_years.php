
<div class='years modal-content text-center'> 
    <h3> Archives </h3>
    <?php
    foreach ($years as $year) {
        echo "<p><a href=\"" . base_url("Archives/byyear") . "/" . $year . "\">" . $year . "</a> </p>";
    }
    ?>

</div> 
