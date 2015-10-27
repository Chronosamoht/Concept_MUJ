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

    function index() {
        $this->form_validation->set_rules('recheche', 'Recheche', '');
        $this->form_validation->set_rules('annee', 'Année', '');
        $this->form_validation->set_rules('concepts', 'Concepts associés :', '');
        $this->form_validation->set_rules('texte', 'Texte', '');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $this->load->view('templates/header');
            $this->load->view('recherche', array('concepts' => $this->getAllConcepts(), 'years' => $this->getAllyears()));
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
            var_dump($res);
        } else {
            $res = $this->recherche_paragraphe($form_data['annee'], $form_data['concepts'], $form_data['texte']);
            var_dump($res);
        }

        // run insert model to write data to db


        $this->load->view('templates/header');
        echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
        var_dump($form_data);
        $this->load->view('templates/footer');
    }

    public function recherche_message($tab_annee, $concepts, $texte) {

        $query = "SELECT ID, Date, Adresse FROM message WHERE ID_LANG =1 ";
        if (!empty($tab_annee)) {
            $where = "AND (0=1 ";
            foreach ($tab_annee as $a) {
                $where = $where . " OR Date LIKE '" . $a . "%'";
            }
            $query = $where . ")";
        }

        $res = $this->db->query($query);
        return $res->result();
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
//        $query = "SELECT ID, ID_Message, Text FROM Paragraphe WHERE ID_LANG =1 AND (";
//        if(isset($annee)) {
//            $a = $this->getparas_byyears($annee);
//        }        
//        $res = $this->db->query($query);
//        return $res->result();
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


//        if($annee != '' ) {
//            $res1 = 
//        }
//        if($concepts != '') {
//            $res2 = $this->getparas_byconcepts($concepts);
//        }
//        if($texte != '' ) {
//            $res3 = $this->Paragraphe->getparas_bytext($texte);
//        }
//        
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

        // sum($key => Name $value => Nbclics);

        return $tab;
    }

//    
//    function fetchconceptbypara($idpara, $tab_concepts) {
//        $res = "SELECT ID_Concepts FROM concepts where Name =$tab_concepts";
//        
//        // recupérer une liste ($nbclics, $nameconcepts) en finction de l'id et de la table de concepts
//        
//       //"SELECT nb_clics form tags where ID_para=$idpara and ID_concept = $res->result()";
//        
//        
//    }



    public function getAllConcepts() {
        $this->db->select('Name');
        $query = $this->db->get('concepts');

        $tab_name = array();
        foreach ($query->result() as $val) {
            array_push($tab_name, $val->Name);
        }
        unset($tab_name[0]);
        return array_combine($tab_name, $tab_name);
    }

    function getAllyears() {
        $this->db->select('Date');
        $query = $this->db->get('message');

        $year = array();

        foreach ($query->result() as $row) {

            array_push($year, substr($row->Date, 0, 4));
        }
        $years = array_unique($year);
        return array_combine($years, $years);
    }

}
