<?php include 'templates/header.php'; ?>





  <div class="print_unique col-md-12"> 
  
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
  
      <?php include 'templates/menu_years.php'; ?>
    
    
<?php include 'templates/footer.php'; ?>
