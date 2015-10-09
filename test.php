<html>
<body>

<form action="test.php" method="post">
<textarea rows="4" name="try" cols="50">
</textarea>
<input type="submit">
</form>

</body>
</html>


<?php

if(isset($_POST["try"])) {
    $tab_paragraphs = explode("\r\n", $_POST["try"]);
    
    
    foreach ($tab_paragraphs as $value) {
    // <p class="lead">Paragraphe $i</p>
        if(str_word_count($value) > 0) {
             echo "<p >" . $value . "</p> <br>\n";
        }
   

  
}
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

