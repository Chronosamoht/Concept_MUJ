
<script>

    function show_para(num_para) {
        $.ajax({
            url: '<?php echo base_url(); ?>Message/ajax_fetchpara',
            //url : 'http://localhost/MUJ_Concept/application/views/ajax_fetchpara.php', // Le nom du script a changé, c'est send_mail.php maintenant !
            type: 'POST', // Le type de la requête HTTP, ici devenu POST
            data: {num_para: num_para, id_message: <?php echo $message->ID; ?>},
            dataType: "json",
            success: function (data) {
                //var b = JSON.parse(data);
                var para = data.text;
                var concepts = data.concepts;
                $(".modal-title").text("Paragraphe n°" + (num_para));
                $(".modal-paragraph").html("<p>" + para + "</p>\n");
                $(".modal-concepts").html("<p>" + concepts + "</p>\n");

            }
            //data: 'num_para='+$num_para+'&id_message='+

        });
    }
</script>
<!-- Modal -->
<div class="modal fade in choosed_body1" id="para" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content choosed">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> </h4>
            </div>
            <div class="modal-body choosed_body">
                <div class="modal-paragraph col-md-9 span6">
                </div>
                <div class="modal-concepts col-md-3 span6">             
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
// echo "<p>Adressé ".$message->Adresse."</p>";
if (isset($message->ID_LANG) && $message->ID_LANG == 1) {
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    echo "<h3> Message du " . mdate("%j ", strtotime($message->Date)) . strftime("%B %Y", strtotime($message->Date)) . " </h3> ";
} else {
    setlocale(LC_TIME, 'en_US.UTF-8', 'eng');
    echo "<h3> Message of the " . mdate("%j ", strtotime($message->Date)) . ucfirst(strftime("%B %Y", strtotime($message->Date))) . " </h3>";
}

echo "<div class=\"paragraphe\">\n";
$i = 0;
foreach ($para as $value) {
    // <p class="lead">Paragraphe $i</p>
    $i++;
    echo "<a data-toggle=\"modal\" href=\"#para\"><p onclick=\"show_para($i)\" >" . $value . "</p> </a> \n";
    
}
?>


<?php
echo "</div>\n";





