<?php

echo "<div class='print_unique'>";

if($message->ID_LANG ==1) {
    echo "<h2> Message de la Maison Universelle de Justice </h2>";

    setlocale(LC_TIME, 'fr_FR.utf8','fra');
//ucfirst(
    
   echo "<p> Le ".mdate("%j ", strtotime($message->Date)).strftime("%B %Y", strtotime($message->Date))."</p>" ;
   
  // echo "<p>Adressé ".$message->Adresse."</p>";
   
   echo "<div>";
    foreach ($para as $value) {
        echo "<p>" . $value . "</p>";
    }
    echo "<div/>";
   
    
    
    
    
} else {
    echo "<h2> Message of the Universal House of Justice </h2>";
    
    echo "<p> Le ".mdate("%j ", strtotime($message->Date)).strftime("%B %Y", strtotime($message->Date))."</p>" ;
   
 //  echo "<p>To ".$message->Adresse."</p>";
    
    echo "<div>";
    foreach ($para as $value) {
        echo "<p>" . $value . "</p>";
    }
    echo "<div/>";
}






echo "<div/>";
?>
