<?php include 'templates/header.php'; ?>

<div class="print_unique col-md-10"> 

    <?php

    include 'templates/print.php';
    ?>
    <p class="text-center">
        <?php
        if (isset($id_reverse)) {
            $url = base_url("Archives/byid/$id_reverse");
        } else {
            if ($message->ID_LANG == 1) {
                $url = base_url("Archives/index_eng");
            } else {
                $url = base_url("Archives/index_fra");
            }
        }

        if ($message->ID_LANG == 1) {
            ?>
            <a href=" <?php echo $url ?>"><img src="http://localhost/MUJ_Concept/toolkit/img/eng2.png" width="50" height="57" alt="Message en Anglais"></a>
        <?php } else { ?>
            <a href=" <?php echo $url ?>"><img src="http://localhost/MUJ_Concept/toolkit/img/fra2.png" width="50" height="57" alt="Message en Français"></a> 
        <?php } ?>
        <a href=" <?php echo base_url("Archives/index_both") ?>"><img src="http://localhost/MUJ_Concept/toolkit/img/bothv3.png" width="50" height="57" alt="Messages côte à côte"> </a>

    </p>

</div>

<?php include 'templates/menu_years.php'; ?>


<?php include 'templates/footer.php'; ?>
