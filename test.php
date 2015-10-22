<html>
    <head>
    <meta charset="utf-8">
    <title>MUJ Concept</title>



    <!--     Latest compiled and minified CSS  -->
    <link rel="stylesheet" href="http://localhost/MUJ_Concept/toolkit/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/MUJ_Concept/toolkit/jquery-ui.min.css">

    <link rel="stylesheet" href="http://localhost/MUJ_Concept/toolkit/style.css">
    <link rel="stylesheet" href="http://localhost/MUJ_Concept/toolkit/choosen/chosen.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="http://localhost/MUJ_Concept/toolkit/jquery.js"></script>
    <script src="http://localhost/MUJ_Concept/toolkit/jquery-ui.min.js"></script>
    <script src="http://localhost/MUJ_Concept/toolkit/bootstrap.min.js"></script>
    <script src="http://localhost/MUJ_Concept/toolkit/choosen/chosen.jquery.js"></script>

</head>
<body>
<script>
    $(function () {
        $(".chosen-select").chosen({disable_search_threshold: 10});
        $(".chosen-select").chosen({max_selected_options: 5});
        $(".chosen-select").chosen({no_results_text: "Désolé ce concept n'existe pas. LINK HERE Souhaitez vous le proposer ?(NOPE LOL)"}); 
    });
</script>
<form action="test.php" method="post">
<textarea rows="4" name="try" cols="50">
</textarea>
      <h2><a name="multiple-select" class="anchor" href="#multiple-select">Multiple Select</a></h2>

    <select name="data[]" data-placeholder="Choose a Country..." class="chosen-select" multiple style="width:350px;" tabindex="4">
            <option value=""></option>
            <option value="United States">United States</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="Afghanistan">Afghanistan</option>
            <option value="Aland Islands">Aland Islands</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="American Samoa">American Samoa</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
            <option value="Anguilla">Anguilla</option>
            <option value="Antarctica">Antarctica</option>
            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
            <option value="Argentina">Argentina</option>
            <option value="Armenia">Armenia</option>
            <option value="Aruba">Aruba</option>
            <option value="Australia">Australia</option>
            <option value="Austria">Austria</option>
            <option value="Azerbaijan">Azerbaijan</option>
            <option value="Bahamas">Bahamas</option>
            <option value="Bahrain">Bahrain</option>
            <option value="Bangladesh">Bangladesh</option>
             </select>
        
     
    
<input type="submit">
</form>

<?php

    var_dump($_POST);

?>

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

