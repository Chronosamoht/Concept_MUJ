
<script>

function show_para($a) {
    
    //alert($a);
    var id = '<?php echo $message->ID; ?>';
    alert(id);
}
</script>


<?php
// echo "<p>Adressé ".$message->Adresse."</p>";
if ($message->ID_LANG == 1) {
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    echo "<h3> Message du ". mdate("%j ", strtotime($message->Date)) . strftime("%B %Y", strtotime($message->Date)) . " </h3> ";
} else {
    echo "<h3> Message of the " . mdate("%j ", strtotime($message->Date)) . ucfirst(strftime("%B %Y", strtotime($message->Date))) . " </h3>";

}

//
//Remplacer le paragraphe cliqué par une fenetre modale :
//
//<div class="modal hide" id="infos">
//  <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
//    <p class="lead">Paragraphe $i</h3>
//  </div>
//  <div class="modal-body">
//    <p>Paragraphe</p>
//  </div>
//</div>
//

echo "<div class=\"paragraphe\">";
$i = 0;
foreach ($para as $value) {
    echo "<p onclick=\"show_para($i)\" >" . $value . "</p>";
}
echo "</div>";





