<div class="modal-content">
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo "<h2 class=\"text-muted\" > Backoffice </h2>";
?>
<script>
    $(function () {
        $("#date").datepicker();
    });
</script>

<?php
// Change the css classes to suit your needs    
echo validation_errors();
$attributes = array('class' => 'form-inline ', 'id' => '');
echo form_open('../Backoffice/', $attributes);

//echo form_open('../Backoffice/form_MUJ');
?>

<p>
    <label class="text-info" for="date">Date : <span class="required">*</span></label>
    <?php echo form_error('date'); ?>
    <br /><input id="date" type="text" name="date" class="form-control" value="<?php echo set_value('date'); ?>"  />
</p>

<p>
    <label class="text-info" for="adresse">Adressé à : (Exemple : "Adressé aux bahais d'Iran" en entier) <span class="required">*</span></label>
    <?php echo form_error('adresse'); ?>
    <br /><input id="adresse" type="text" class="form-control" name="adresse" maxlength="50" value="<?php echo set_value('adresse'); ?>"  />
</p>

<p>
    <label class="text-info" for="lettre">Copiez ici le texte de la lettre en français de la MUJ : <span class="required">*</span></label>
    <?php echo form_error('lettre'); ?>
    <br />

    <?php echo form_textarea(array('name' => 'lettre', 'rows' => '5', 'cols' => '80', 'class' => 'form-control', 'value' => set_value('lettre'))) ?>
</p>

<p>
    <label class="text-info" for="lettre">Copiez ici le texte de la lettre en anglais de la MUJ : <span class="required">*</span></label>
    <?php echo form_error('anglais'); ?>
    <br />

    <?php echo form_textarea(array('name' => 'anglais', 'rows' => '5', 'cols' => '80','class' => 'form-control', 'value' => set_value('anglais'))) ?>
</p>

<p>
    <?php echo form_submit(array('name' => 'submit', 'value' =>'Submit', 'class' => 'btn btn-success btn-lg')); ?>
</p>
 
<?php echo form_close(); ?>
</div>
