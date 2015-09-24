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
    <?php
    echo "<p><a href=\"" . base_url("Archives/index_eng") . "\">Message en anglais</a> </p>";
    echo "<p><a href=\"" . base_url("Archives/index_fra") . "\">Messages en français</a> </p>";
    ?>
</div>
    
</div>



<?php // include 'templates/menu_years.php'; ?>

<?php  include 'templates/footer.php'; ?>
