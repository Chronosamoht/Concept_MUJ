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
        $this->load->model('Paragraphe');
        $this->load->model('Concept');
    }

    public function print_unique($message, $tab_year, $byid = false) {
        $tab_paragraphs = $this->Paragraphe->fetch_paragraphs($message->ID);
        $id_reverse = $this->Message_muj->getID_reverselang($message->ID);
        if ($byid) {
            $this->load->view('print_unique', array('para' => $tab_paragraphs, 'message' => $message, 'years' => $tab_year, 'id_reverse' => $id_reverse));
        } else {
            $this->load->view('print_unique', array('para' => $tab_paragraphs, 'message' => $message, 'years' => $tab_year));
        }
    }

    public function print_both($message, $tab_year) {
        $tab_paragraphsfra = $this->Paragraphe->fetch_paragraphs($message['fra']->ID);
        $tab_paragraphseng = $this->Paragraphe->fetch_paragraphs($message['eng']->ID);
        $this->load->view('print_both', array('parafra' => $tab_paragraphsfra, 'paraeng' => $tab_paragraphseng, 'mess' => $message, 'years' => $tab_year));
    }

    public function index() {
        $this->index_fra();
    }

    public function index_fra() {
        $tab_year = array_unique(explode(',', $this->Message_muj->getyears()));
        sort($tab_year);
        $tab_messages = $this->Message_muj->get_last_messages();
        $this->print_unique($tab_messages['fra'], $tab_year);
    }

    public function index_eng() {
        $tab_year = array_unique(explode(',', $this->Message_muj->getyears()));
        sort($tab_year);
        $tab_messages = $this->Message_muj->get_last_messages();
        $this->print_unique($tab_messages['eng'], $tab_year);
    }

    public function index_both() {
        $tab_year = array_unique(explode(',', $this->Message_muj->getyears()));
        sort($tab_year);
        $tab_messages = $this->Message_muj->get_last_messages();
        $this->print_both($tab_messages, $tab_year);
    }

    public function byid($idmess) {
        $mess = $this->Message_muj->getmessagebyID($idmess);
        $tab_year = array_unique(explode(',', $this->Message_muj->getyears()));
        $this->print_unique($mess, $tab_year, true);
    }

    public function both_byid($idmess, $id_reverse) {
        $mess1 = $this->Message_muj->getmessagebyID($idmess);
        $mess2 = $this->Message_muj->getmessagebyID($id_reverse);
        $tab_year = array_unique(explode(',', $this->Message_muj->getyears()));

        if ($mess1->ID_LANG == 1) {
            $tab_paragraphsfra = $this->Paragraphe->fetch_paragraphs($mess1->ID);
            $tab_paragraphseng = $this->Paragraphe->fetch_paragraphs($mess2->ID);
            $mess = array('fra' => $mess1, 'eng' => $mess2);
        } else {
            $tab_paragraphsfra = $this->Paragraphe->fetch_paragraphs($mess2->ID);
            $tab_paragraphseng = $this->Paragraphe->fetch_paragraphs($mess1->ID);
            $mess = array('eng' => $mess2, 'fra' => $mess1);
        }
        $this->load->view('print_both', array('parafra' => $tab_paragraphsfra, 'paraeng' => $tab_paragraphseng, 'mess' => $mess, 'years' => $tab_year));
    }

}
