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
        $this->load->model('Paragraphe');
        $this->load->model('Concept');
    }

    function ajax_fetchpara() {
        $num_para = $this->input->post('num_para');
        
        $para = $this->Paragraphe->getparabyid($num_para);

        $res = $this->Concept->getidconcept_byidpara($num_para);
        
        if(count($res)==0) {
            $bla = "Il n'y a pas encore de concept associé à ce paragraphe.";
        }else { 
        
        $tab_concept = array();
   
        foreach ( $res as $id) { 
            array_push($tab_concept, $this->Concept->getconcept_byid($id->ID_concept));
        }
            $bla = "<ul> \n";
            foreach ($tab_concept as $concept) {
                $bla = $bla . "<li>" . $concept . "</li>\n";
            }
       
            $bla = $bla . "</ul>\n";
        }
      //  $tab_para = array('text' => $para2->Text, 'concepts' => $da);

        $tab_para = array('text' => $para->Text, 'concepts' => $bla);
      
        $this->output->set_content_type('application/json')
        ->set_output(json_encode($tab_para));

    }
    
    
    function index() {
        $this->form_validation->set_rules('recheche', 'Recheche', '');
        $this->form_validation->set_rules('annee', 'Année', '');
        $this->form_validation->set_rules('concepts', 'Concepts associés :', '');
        $this->form_validation->set_rules('texte', 'Texte', '');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $this->load->view('templates/header');
            $this->load->view('recherche', array('concepts' => $this->Concept->getAllConcepts(), 'years' => $this->Message_muj->getAllyears()));
            $this->load->view('templates/footer');
        } else {
            redirect('Concept/result');
        }
    }

    public function result() {
        $form_data = array(
            'recherche' => set_value('recherche'),
            'annee' => set_value('annee'),
            'concepts' => set_value('concepts'),
            'texte' => set_value('texte')
        );
        //$annee = $form_data['annee'];
        if ($form_data['recherche'] == 'message') {
            // var_dump($form_data['annee']);
            $res = $this->recherche_message($form_data['annee'], $form_data['concepts'], $form_data['texte']);
            $mess = true;
        } else {
            $res = $this->recherche_paragraphe($form_data['annee'], $form_data['concepts'], $form_data['texte']);
            $mess = FALSE;
        }

        // run insert model to write data to db
//        $res1 = array();
//        foreach ($res as $v) {
//            array_push($res1, unserialize($v));
//        }

        $this->load->view('templates/header');
        $this->load->view('templates/print_search', array('para' => $res, 'mess' =>$mess));
        $this->load->view('templates/footer');
    }

    public function recherche_message($tab_annee, $concepts, $texte) {

//        $query = "SELECT ID, Date, Adresse FROM message WHERE ID_LANG =1 ";
//        if (!empty($tab_annee)) {
//            $where = "AND (0=1 ";
//            foreach ($tab_annee as $a) {
//                $where = $where . " OR Date LIKE '" . $a . "%'";
//            }
//            $query = $where . ")";
//        }
//
//        $res = $this->db->query($query);
        
       
         
        
        
        //$res = $this->Message_muj->getmessagesbyyears($tabyear);
       
        $res = $this->getmessagebytext($texte);
        $tab_search = array();
        foreach ($res as $id_mess) {
            $mess = $this->Message_muj->getmessagebyID($id_mess);
            if($mess->ID_LANG ==1) {
                array_push($tab_search, $mess);
            }
        }
        
        return $tab_search;
    }
    
    
    public function getmessagebytext($text) {
        $para = $this->Paragraphe->getparas_bytext($text);
        $c = count($para);
        if($c <1) {
            return -1;
        } else {
            $tab = array();
            foreach($para as $val) {
                array_push($tab, unserialize($val)->ID_MESSAGE);
            }
            ksort($tab);
            $tab_res = array_unique($tab);
        }
        
        return $tab_res;        
    }
    

    public function is_set($a, $c, $t) {
        $r = 0;
        if ($a != '') {
            $r = $r + 100;
        }
        if ($c != '') {
            $r = $r + 10;
        }
        if ($t != '') {
            $r = $r + 1;
        }
        return $r;
    }

    public function recherche_paragraphe($annee, $concepts, $texte) {

        $r = $this->is_set($annee, $concepts, $texte);

        switch ($r) {
            case 100:
                return $this->getparas_byyears($annee);

            case 110:
                return array_intersect($this->getparas_byconcepts($concepts), $this->getparas_byyears($annee));

            case 101:
                return array_intersect($this->getparas_byyears($annee), $this->Paragraphe->getparas_bytext($texte));

            case 111:
                return array_intersect($this->getparas_byconcepts($concepts), array_intersect($this->getparas_byyears($annee), $this->Paragraphe->getparas_bytext($texte)));

            case 10:
                return $this->getparas_byconcepts($concepts);

            case 11:
                return array_intersect($this->getparas_byconcepts($concepts), $this->Paragraphe->getparas_bytext($texte));

            case 1:
                return $this->Paragraphe->getparas_bytext($texte);
            default:
                return $this->Paragraphe->getparas_bytext(' ');
        }

    }

    public function getparas_byyears($tabyear) {
        $res = $this->Message_muj->getmessagesbyyears($tabyear);
        $tab = array();
        foreach ($res as $mess) {
            $para_mess = $this->Paragraphe->getparasbyidmess(intval($mess->ID));
            foreach ($para_mess as $para) {
                array_push($tab, serialize($para));
            }
        }

        return array_filter($tab);
    }

    function getparas_byconcepts($tabconcepts) {
        $tab = array();
        foreach ($tabconcepts as $concept) {
            $a = $this->Concept->getparas_byconcept($concept);
            foreach ($a as $aa) {
                array_push($tab, serialize($aa));
            }
        }

      

        return $tab;
    }

}
