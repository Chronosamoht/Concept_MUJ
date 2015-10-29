<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('date');
        $this->load->helper('url');
        $this->load->model('Message_muj');
        $this->load->model('Paragraphe');
    }

    function ajax_fetchpara() {
        $num_para = $this->input->post('num_para');
        $id_message = $this->input->post('id_message');

        $para = $this->Paragraphe->getPara($num_para, $id_message);

        $res = $this->Concept->getidconcept_byidpara($para->ID);

        if (count($res) == 0) {
            $bla = "Il n'y a pas encore de concept associé à ce paragraphe.";
        } else {

            $tab_concept = array();

            foreach ($res as $id) {
                array_push($tab_concept, $this->Concept->getconcept_byid($id->ID_concept));
            }
            $bla = "<ul> \n";
            foreach ($tab_concept as $concept) {
                $bla = $bla . "<li>" . $concept . "</li>\n";
            }

            $bla = $bla . "</ul>\n";
        }

        $tab_para = array('text' => $para->Text, 'concepts' => $bla);

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($tab_para));
    }

    function format_concept($id_para) {

        $res = $this->Concept->getidconcept_byidpara($id_para);

        if (count($res) == 0) {
            return "Il n'y a pas encore de concept associé à ce paragraphe.";
        } else {

            $tab_concept = array();

            foreach ($res as $id) {
                array_push($tab_concept, $this->getconcept_byid($id->ID_concept));
            }
            $bla = "<ul> \n";
            foreach ($tab_concept as $concept) {
                $bla = $bla . "<li>" . $concept . "</li>\n";
            }

            return $bla . "</ul>\n";
        }
    }

}
