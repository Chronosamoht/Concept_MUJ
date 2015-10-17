

<div class="modal-content">
    <?php
    // Change the css classes to suit your needs    

    $attributes2 = array('class' => 'form-inline', 'id' => '');
    echo form_open('../Backoffice/addconcept', $attributes2);
    ?>

    <p>
        <label class="text-info" for="concept">Concept</label>
<?php echo form_error('concept'); ?>
        <br /><input id="concept" type="text" name="concept"  value="<?php echo set_value('concept'); ?>"  />
    </p>


    <p>
    <?php echo form_submit(array('name' => 'addconcept', 'value' => 'Submit', 'class' => 'btn btn-primary  btn-lg')); ?>
    </p>

<?php echo form_close(); ?>
</div>
