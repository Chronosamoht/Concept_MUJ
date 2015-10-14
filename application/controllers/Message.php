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
        $para = new Paragraphe();
        
        $para2 = $para->getPara($num_para, $id_message);
        //$da = format_concept($para2->ID);
        //var_dump($da);
        //
        //
        $this->db->select('ID_concept');
        $this->db->where('ID_para', $para2->ID);
        $query = $this->db->get('tags');
        $res = $query->result();
        if(count($res)==0) {
            $bla = "Il n'y a pas encore de concept associé à ce paragraphe.";
        }else { 
        
        $tab_concept = array();
   
        foreach ( $res as $id) { 
            array_push($tab_concept, $this->getconcept_byid($id->ID_concept));
        }
            $bla = "<ul> \n";
            foreach ($tab_concept as $concept) {
                $bla = $bla . "<li>" . $concept . "</li>\n";
            }
       
            $bla = $bla . "</ul>\n";
        }
      //  $tab_para = array('text' => $para2->Text, 'concepts' => $da);

        $tab_para = array('text' => $para2->Text, 'concepts' => $bla);
      
        $this->output->set_content_type('application/json')
        ->set_output(json_encode($tab_para));
        
       

    }
    
    function getPara($num_para, $id_message) {

        $this->db->select('ID, Text');
        $this->db->where('ID_MESSAGE', $id_message);
        $query = $this->db->get('paragraphe');
        $res = $query->result();

        return $res[$num_para];
    }

    function getconcept_byid($idconcept) {
        $this->db->select('Name');
        $this->db->where('ID', $idconcept);
        $query = $this->db->get('concepts');
        return $query->result()[0]->Name;
    }

    function format_concept($id_para) {
        $this->db->select('ID_concept');
        $this->db->where('ID_para', $id_para);
        $query = $this->db->get('tags');
        $res = $query->result();
        if(count($res)==0) {
            return "Il n'y a pas encore de concept associé à ce paragraphe.";
        }else { 
        
        $tab_concept = array();
   
        foreach ( $res as $id) { 
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
