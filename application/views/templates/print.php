<?php

// echo "<p>Adressé ".$message->Adresse."</p>";
if ($message->ID_LANG == 1) {
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    echo "<h2> Message de la Maison Universelle de Justice </h2> ";
    $det = "Le ";
} else {
    echo "<h2> Message of the Universal House of Justice </h2>";
    $det = "The ";
}

echo "<p>" . $det . mdate("%j ", strtotime($message->Date)) . strftime("%B %Y", strtotime($message->Date)) . "</p>";

echo "<div>";
foreach ($para as $value) {
    echo "<p>" . $value . "</p>";
}
echo "<div/>";




