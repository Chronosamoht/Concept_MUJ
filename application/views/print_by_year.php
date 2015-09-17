<?php include 'templates/header.php'; ?>

<p class="lead"> Messages de l'année choisie : </p>

<?php
foreach ($tab_mess as $tab ) {
    $message = $tab['mess'];
    $para =  $tab['para'];

    include 'templates/print.php';

}

 include 'templates/menu_years.php';

 include 'templates/footer.php'; 
