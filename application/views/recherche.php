<?php
// Change the css classes to suit your needs    
defined('BASEPATH') OR exit('No direct script access allowed');
$attributes = array('class' => 'form-inline', 'id' => '');
echo "<h2 class=\"text-muted\" > Recherche </h2>"; ?>

<script>
    $(function () {
        $(".chosen-select").chosen({disable_search_threshold: 10});
        $(".chosen-select").chosen({max_selected_options: 5});
        $(".chosen-select").chosen({no_results_text: "Désolé, ce concept n'existe pas. LINK HERE Souhaitez vous le proposer ?(NOPE LOL)"}); 
    });
</script>

<p class="text-info"> La recherche est basée sur les textes français. Aucun des champs n'est requis pour la recherche.</p>
<div class="modal-content">   
    <?php echo form_open('../Concepts/result', $attributes);?>


<p>
    <label for="recheche">Type de recherche :</label>
    <?php echo form_error('recherche'); ?>

<?php // Change or Add the radio values/labels/css classes to suit your needs  ?>
    
    <label class="checkbox-inline" for="recheche" class=""><input id="recherche" name="recherche" type="radio" checked="checked" class="" value="message" <?php echo $this->form_validation->set_radio('recherche', 'message'); ?> />Message</label>

    
    <label class="checkbox-inline" for="recheche" class=""><input id="recherche" name="recherche" type="radio" class="" value="paragraphe" <?php echo $this->form_validation->set_radio('recherche', 'paragraphe'); ?> />Paragraphe</label>
</p>


<p>
    <label for="annee">Année(s) :</label>
<?php echo form_error('annee'); ?>
    <br /><?php echo form_dropdown(array('name' => 'annee', 'options' =>$years, 'value' =>set_value('annee'),'data-placeholder'=>' ', 'class' =>'chosen-select', 'multiple'=>'multiple', 'style'=> 'width:350px', 'tabindex'=>'4'));?>
   
</p>

<p>
    <label for="concepts">Concept(s) associé(s) :</label>
    <?php echo form_error('concepts'); ?>

    <?php // Change the values in this array to populate your dropdown as required ?>
    <br /><?php 
   
     echo form_dropdown(array('name' => 'concepts', 'options' =>$concepts, 'value' =>set_value('concepts'),'data-placeholder'=>' ', 'class' =>'chosen-select', 'multiple'=>'multiple', 'style'=> 'width:350px', 'tabindex'=>'4'));
            
            ?>
</p>                                             

<p>
    <label for="texte">Extrait :</label>
<?php echo form_error('texte'); ?>
    <br />

    <?php echo form_textarea(array('name' => 'texte', 'rows' => '5', 'cols' => '80', 'value' => set_value('texte'))) ?>
</p>

<p>
    <?php echo form_submit(array('name' => 'submit', 'value' =>'Submit', 'class' => 'btn btn-primary btn-lg')); ?>
</p>

<?php echo form_close(); ?>
</div>
