<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 echo "<h2> Connection </h2>";



		echo form_open('Backoffice/valide');
		echo form_fieldset('Ajout de message :');
		

		
	$date = array(
	  'name'        => 'date',
	  'id'          => 'date',
	   'value'       => '',
	  'maxlength'   => '20',
	 'size'        => '20');
		echo form_label('Date  :', 'date');
		echo form_input($date);
		
			$adress_data = array(
		                    'name'        => 'adresse',
		                    'id'          => 'adresse',
		                    'value'       => '',
		                    'maxlength'   => '20',
		                    'size'        => '20');
		echo form_label('Adressé à :', 'adresse');
		echo "<p> Exemple : Adressé aux bahais d'Iran  </p>";
		echo form_input($adress_data);
		
		$text_data = array(
		                    'name'        => 'text',
		                    'id'          => 'text',
		                    'value'       => ''
		                    );
							
		echo form_label('Copiez ici la lettre de la MUJ :', 'text');
		echo form_textarea($text_data);


		echo form_submit('submit', 'valider');
		echo form_fieldset_close();
		form_close();

?>