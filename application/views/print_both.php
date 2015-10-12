<?php include 'templates/header.php'; ?>

<div class='print_both col-md-14' >

    <div class="col-md-6">

        <?php
        $message = $mess['fra'];
        $para = $parafra;
        include 'templates/print.php';
        ?>

    </div>
    
    <div class="col-md-6" >

        <?php
        $message = $mess['eng'];
        $para = $paraeng;
        include 'templates/print.php';
        ?>

    </div>

<div>
    <p class="text-center">
     <a href=" <?php echo base_url("Archives/index_eng") ?>"><img src="http://localhost/MUJ_Concept/toolkit/img/eng2.png" width="50" height="57" alt="Message en Anglais"></a>
     <a href=" <?php echo base_url("Archives/index_fra") ?>"><img src="http://localhost/MUJ_Concept/toolkit/img/fra2.png" width="50" height="57" alt="Message en Français"></a> 
    </p>
    
</div>
    
</div>



<?php // include 'templates/menu_years.php'; ?>

<?php  include 'templates/footer.php'; ?>
