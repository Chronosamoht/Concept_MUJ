<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {

	function __construct()
		{
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->database();
			$this->load->helper('form');
			$this->load->helper('url');
			$this->load->model('Message_muj');
		}	


	function index()
	{			
		$this->form_validation->set_rules('date', 'Date', 'required');			
		$this->form_validation->set_rules('adresse', 'Adresse', 'required|max_length[50]');			
		$this->form_validation->set_rules('lettre', 'Lettre', 'required');
		$this->form_validation->set_rules('anglais', 'Anglais', 'required');
		
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$this->load->view('templates/header');
			$this->load->view('backoffice');
			$this->load->view('templates/footer');
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'date' => set_value('date'),
					       	'adresse' => set_value('adresse'),
					       	'lettre' => set_value('lettre'),
						'anglais' => set_value('anglais')
						);
					
			// run insert model to write data to db
			
	
			if ($this->Message_muj->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				$this->load->view('templates/header');
                                $this->load->view('templates/OK_form');
				$this->load->view('templates/footer');
			}
			else
			{
                            
                            $this->load->view('templates/header');
                            $this->load->view('templates/error_form');
                            $this->load->view('templates/footer');
			// Or whatever error handling is necessary
			}
			
		}
	}
 
}
/*
	public function form_MUJ()
	{
	   $this->load->library('form_validation');
	   $this->load->view('templates/header');
	   
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('Backoffice');
		}
		else
		{
			
			$dat = $this->input->post('datepicker');
 
			$data = array('datepicker' => $dat);
			
			$this->load->view('backvalide', $data);
		}
		$this->load->view('templates/footer');
	}
	
}
*/
?>
