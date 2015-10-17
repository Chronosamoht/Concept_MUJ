<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Concepts extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('Message_muj');
    }

    function index() {
        $this->form_validation->set_rules('recheche', 'Recheche', '');
        $this->form_validation->set_rules('annee', 'Année', '');
        $this->form_validation->set_rules('concepts', 'Concepts associés :', '');
        $this->form_validation->set_rules('texte', 'Texte', '');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $this->load->view('templates/header');
            $this->load->view('recherche', array('concepts' => $this->getAllConcepts(), 'years' =>$this->getAllyears()));
            $this->load->view('templates/footer');
        } 
    }
    
    public function result() {
          $form_data = array(
                'recherche' => set_value('recherche'),
                'annee' => set_value('annee'),
                'concepts' => set_value('concepts'),
                'texte' => set_value('texte')
            );

            // run insert model to write data to db

        echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
        $this->load->view('templates/header');
         var_dump($form_data);
        $this->load->view('templates/footer');
       
        
        
    }

    public function getAllConcepts() {
        $this->db->select('Name');
        $query = $this->db->get('concepts');

        $tab_name = array();
        foreach ($query->result() as $val) {
            array_push($tab_name, $val->Name);
        }
        unset($tab_name[0]);
        return $tab_name;
    }

    
     function getAllyears() {
        $this->db->select('Date');
        $query = $this->db->get('message');

        $year = array();

        foreach ($query->result() as $row) {
            array_push($year, substr($row->Date, 0, 4)); 
        }
        $year = array_unique($year);
        return $year;
    }
//    
//    function dump($array) {
//        foreach ($array as $value) {
//            var_dump($value);
//        }
//    }
}
