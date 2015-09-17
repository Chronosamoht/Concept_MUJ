<?php include 'templates/header.php'; ?>

<p class="lead"> Messages de la Maison Universelle de Justice : </p>



  <div class="col-md-8 print_unique"> 
  
    <?php
//ucfirst(
    include 'templates/print.php';

    if ($message->ID_LANG == 1) {
        echo "<p><a href=\"" . base_url("Archives/index_eng") . "\">Message en anglais</a> </p>";
    } else {
        echo "<p><a href=\"" . base_url("Archives/index_fra") . "\">Message en français</a> </p>";
    }
    echo "<p><a href=\"" . base_url("Archives/index_both") . "\">Messages côte à côte</a> </p>";
    ?>

  
  </div>
    
    
  <div class="col-md-4">
      
      <?php include 'templates/menu_years.php'; ?>
      
  </div>







    
    
<?php include 'templates/footer.php'; ?>
