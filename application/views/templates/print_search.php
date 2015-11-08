
<script>

    function show_para(num_para) {
        $.ajax({
            url: '<?php echo base_url(); ?>Concepts/ajax_fetchpara',
            type: 'POST', // Le type de la requête HTTP, ici devenu POST
            data: {num_para: num_para},
            dataType: "json",
            success: function (data) {
                var para = data.text;
                var concepts = data.concepts;

                $(".modal-title").text("Paragraphe ");
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



<h3> Résultat de la recherche </h3>


<div class=paragraphe>
    <?php
    if ($mess) {
        foreach ($para as $value) {
            // <p class="lead">Paragraphe $i</p>
            echo "<a href=" . base_url("Archives/byid/" . $value->ID) . ">  <p><h3> Message du " . $value->Date . " </h3>  </p> </a>";
        }
    } else {
        foreach ($para as $value) {
            // <p class="lead">Paragraphe $i</p>
            echo "<a data-toggle=\"modal\" href=\"#para\"><p onclick=\"show_para($value->ID)\" >" . $value->Text . "</p> </a> \n";
        }
    }
    ?>

</div>





