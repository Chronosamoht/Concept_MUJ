<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('Message_muj');
    }

    function index() {
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('adresse', 'Adresse', 'required|max_length[50]');
        $this->form_validation->set_rules('lettre', 'Lettre', 'required');
        $this->form_validation->set_rules('anglais', 'Anglais', 'required');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $this->load->view('templates/header');
            $this->load->view('backoffice');
            $this->load->view('templates/footer');
        } else {
            $form_data = array(
                'date' => set_value('date'),
                'adresse' => set_value('adresse'),
                'lettre' => set_value('lettre'),
                'anglais' => set_value('anglais')
            );


            is_save($this->Message_muj->SaveForm($form_data));
        }
    }

    function is_save($form) {
        if ($form == TRUE) {
            $this->load->view('templates/header');
            $this->load->view('templates/OK_form');
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header');
            $this->load->view('templates/error_form');
            $this->load->view('templates/footer');
        }
    }

    public function addConcept() {
        $this->form_validation->set_rules('concept', 'Concept', 'required');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $this->load->view('templates/header');
            $this->load->view('backoffice_add_concept');
            $this->load->view('templates/footer');
        } else {

            $form_data = array(
                'concept' => set_value('concept')
            );

            is_save($this->Message_muj->addConcept($form_data));
        }
    }

}
