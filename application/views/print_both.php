<?php include 'templates/header.php'; ?>

<p class="lead"> Messages de la Maison Universelle de Justice : </p>

<div class='print_both' >

    <div >

        <?php
        $message = $mess['fra'];
        $para = $parafra;
        include 'templates/print.php';
        ?>

    </div>
    
    <div >

        <?php
        $message = $mess['eng'];
        $para = $paraeng;
        include 'templates/print.php';
        ?>

    </div>

</div>

<div>
    <?php
    echo "<p><a href=\"" . base_url("Archives/index_eng") . "\">Message en anglais</a> </p>";
    echo "<p><a href=\"" . base_url("Archives/index_fra") . "\">Messages en français</a> </p>";
    ?>
</div>

<?php include 'templates/menu_years.php'; ?>

<?php  include 'templates/footer.php'; ?>
