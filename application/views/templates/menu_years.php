
<div class='years modal-content text-center col-md-3'> 
    
    <h3> Archives </h3>
    <?php
    foreach ($years as $year) {
        echo "<p><a href=\"" . base_url("Archives/byyear") . "/" . $year . "\">" . $year . "</a> </p>";
    }
    ?>

</div> 
