<?php include 'templates/header.php'; ?>





  <div class="print_unique col-md-10"> 
  
    <?php
//ucfirst(
   
    include 'templates/print.php';
    
    /*
 echo "<p>\n";
    if ($message->ID_LANG == 1) {
        echo "<p class=\"text-center\"><a href=\"" . base_url("Archives/index_eng") . "\">Message en anglais</a> </p>\n";
    } else {
        echo "<p class=\"text-center\"><a href=\"" . base_url("Archives/index_fra") . "\">Message en français</a> </p>\n";
    }
    echo "<p class=\"text-center\"><a href=\"" . base_url("Archives/index_both") . "\">Messages côte à côte</a> </p>\n";
      <p class="text-center"><img src="http://localhost/MUJ_Concept/toolkit/img/fra2.png" width="50" height="57" alt="Message en Français"> </p>
      <p class="text-center"><img src="http://localhost/MUJ_Concept/toolkit/img/eng2.png" width="50" height="57" alt="Message en Anglais"> </p>
       <p class="text-center"><img src="http://localhost/MUJ_Concept/toolkit/img/bothv3.png" width="50" height="57" alt="Messages côte à côte"> </p>
   */
    ?>
    <p class="text-center">
    <?php
          
    if ($message->ID_LANG == 1) { ?>
     <a href=" <?php echo base_url("Archives/index_eng") ?>"><img src="http://localhost/MUJ_Concept/toolkit/img/eng2.png" width="50" height="57" alt="Message en Anglais"></a>
      <?php   } else { ?>
     <a href=" <?php echo base_url("Archives/index_fra") ?>"><img src="http://localhost/MUJ_Concept/toolkit/img/fra2.png" width="50" height="57" alt="Message en Français"></a> 
     <?php   } ?>
      <a href=" <?php echo base_url("Archives/index_both") ?>"><img src="http://localhost/MUJ_Concept/toolkit/img/bothv3.png" width="50" height="57" alt="Messages côte à côte"> </a>
  
     
 </p>
      
  </div>
  
      <?php include 'templates/menu_years.php'; ?>
    
    
<?php include 'templates/footer.php'; ?>
