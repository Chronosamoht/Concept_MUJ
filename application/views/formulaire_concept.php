<div class="modal-content">
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo "<h2 class=\"text-muted\" > Recherche </h2>";
?>


<?php
// Change the css classes to suit your needs    
echo validation_errors();
$attributes = array('class' => 'form-inline ', 'id' => '');
echo form_open('../Concepts/', $attributes);

//echo form_open('../Backoffice/form_MUJ');
?>

<p>
    <label class="text-info" for="annee">Année de diffusion : <span class="required">*</span></label>
    <?php echo form_error('annee'); ?>
    <br /><input id="annee" type="text" name="annee" class="form-control" value="<?php echo set_value('annee'); ?>"  />
</p>

<p>
    <label class="text-info" for="Concept">Concept : <span class="required">*</span></label>
    <?php echo form_error('lettre'); ?>
    <br />
    <!-- -->
    <?php echo form_textarea(array('name' => 'lettre', 'rows' => '5', 'cols' => '80', 'class' => 'form-control', 'value' => set_value('lettre'))) ?>
</p>

<p>
    <label class="text-info" for="lettre">Copiez ici le texte de la lettre en anglais de la MUJ : <span class="required">*</span></label>
    <?php echo form_error('anglais'); ?>
    <br />

    <?php echo form_textarea(array('name' => 'anglais', 'rows' => '5', 'cols' => '80','class' => 'form-control', 'value' => set_value('anglais'))) ?>
</p>

<p>
    <?php echo form_submit(array('name' => 'submit', 'value' =>'Submit', 'class' => 'btn btn-primary  btn-lg')); ?>
</p>
 
<?php echo form_close(); ?>
</div>
