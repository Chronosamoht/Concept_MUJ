<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {

	public function index()
	{
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		
		
		$this->load->view('templates/header');
	    $this->load->view('Backoffice', array('error' => ' ' ));
		

		$this->load->view('templates/footer');
	}
	
	public function valide()
	{
	   
	if ( ! $this->index->valide())    {
      $error = array('error' => $this->index->display_errors());
      $this->load->view('templates/header');
      $this->load->view('Backoffice', $error);
      $this->load->view('templates/footer');
    }
    else    {
      $data = array('MUJ_data' => $this->index->data());
      $this->load->view('templates/header');
      $this->load->view('backvalide', $data);
      $this->load->view('templates/footer');
    }
	 
		$this->load->view('templates/footer');
	}
}

?>
