<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Archives extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('date');
        $this->load->helper('url');
        $this->load->model('Message_muj');
    }

    function getyears() {
        $this->db->distinct('Date');
        $query = $this->db->get('message');

        $dates = '';

        foreach ($query->result() as $row) {
            $year = substr($row->Date, 0, 4);
            $dates = $dates . ',' . $year;
        }


        return substr($dates, 1);
    }

    public function get_last_messages() {

        $this->db->select_max('Date');
        $query = $this->db->get('message');
        $res = $query->result();
        $this->db->select();
        $this->db->where('Date', $res[0]->Date);
        $query2 = $this->db->get('message');

        $res2 = $query2->result();
        $messagefra = $res2[0];
        $messageeng = $res2[1];

        return array('fra' => $messagefra, 'eng' => $messageeng);
    }

    public function print_unique($message, $tab_year) {
        $tab_paragraphs = $this->fetch_paragraphs($message->ID);

        $da = $this->getPara(0, $message->ID);
        
     //   $id = $this->format_concept($da->ID);


        $this->load->view('print_unique', array('para' => $tab_paragraphs, 'message' => $message, 'years' => $tab_year));
    }

    /////////////////TRY HARD HERE //////////////////////
    /////////////////////////////////////////////////////
    /////////////////////////////////////////////////////

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

        $tab_concept = array();
   
        foreach ( $query->result() as $id) {
            array_push($tab_concept, $this->getconcept_byid($id->ID_concept));
        }
       
        
        if (count($tab_concept) == 0) {
            return "Il n'y a pas encore de concept associé à ce paragraphe.";
        } else {
            $bla = "<ul> \n";
            foreach ($tab_concept as $concept) {
                $bla = $bla . "<li>" . $concept . "</li>\n";
            }
       
            return $bla . "</ul>\n";
        }
    }

    ///////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////:
    /////////////////////////////////////////////////////////////

    public function print_both($message, $tab_year) {
        $tab_paragraphsfra = $this->fetch_paragraphs($message['fra']->ID);
        $tab_paragraphseng = $this->fetch_paragraphs($message['eng']->ID);
        $this->load->view('print_both', array('parafra' => $tab_paragraphsfra, 'paraeng' => $tab_paragraphseng, 'mess' => $message, 'years' => $tab_year));
    }

    public function byyear($year) {

        $this->db->like('Date', $year, 'after');
        $query = $this->db->get('message');

        $tab_mess = array();

        foreach ($query->result() as $row) {
            $tab_paragraphs = explode(',', $this->fetch_paragraphs($row->ID));
            array_push($tab_mess, array('para' => $tab_paragraphs, 'mess' => $row));
        }

        $tab_year = array_unique(explode(',', $this->getyears()));
        sort($tab_year);

        $this->load->view('print_by_year', array('tab_mess' => $tab_mess, 'years' => $tab_year));
    }

    public function fetch_paragraphs($id_message) {
        $this->db->select('Text');
        $this->db->where('ID_MESSAGE', $id_message);
        $query = $this->db->get('paragraphe');

        $tab_text = [];
        foreach ($query->result() as $dude) {
            array_push($tab_text, $dude->Text);
        }

        return $tab_text;
    }

    public function index() {

        $this->index_fra();

        // menu right : 
        // select each years * DONE
        // print by order * DONE
        // link to select all messages for the year
    }

    public function index_fra() {

        $tab_year = array_unique(explode(',', $this->getyears()));
        sort($tab_year);

        $tab_messages = $this->get_last_messages();

        $this->print_unique($tab_messages['fra'], $tab_year);
    }

    public function index_eng() {

        $tab_year = array_unique(explode(',', $this->getyears()));
        sort($tab_year);

        $tab_messages = $this->get_last_messages();

        $this->print_unique($tab_messages['eng'], $tab_year);
    }

    public function index_both() {

        $tab_year = array_unique(explode(',', $this->getyears()));
        sort($tab_year);
        $tab_messages = $this->get_last_messages();

        $this->print_both($tab_messages, $tab_year);
    }

}
