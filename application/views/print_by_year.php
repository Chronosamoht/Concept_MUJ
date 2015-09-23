<?php include 'templates/header.php'; ?>

<div class="col-md-12"> 

<?php
foreach ($tab_mess as $tab ) {
    $message = $tab['mess'];
    $para =  $tab['para'];

    include 'templates/print.php';

}
?>
    
  </div>

<?php
 include 'templates/menu_years.php';

 include 'templates/footer.php'; 
