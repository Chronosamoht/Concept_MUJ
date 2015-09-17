<?php

// echo "<p>Adressé ".$message->Adresse."</p>";
if ($message->ID_LANG == 1) {
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    echo "<h3> Message du ". mdate("%j ", strtotime($message->Date)) . strftime("%B %Y", strtotime($message->Date)) . " </h3> ";
} else {
    echo "<h3> Message of the " . mdate("%j ", strtotime($message->Date)) . ucfirst(strftime("%B %Y", strtotime($message->Date))) . " </h3>";

}

echo "<div>";
foreach ($para as $value) {
    echo "<p>" . $value . "</p>";
}
echo "<div/>";




