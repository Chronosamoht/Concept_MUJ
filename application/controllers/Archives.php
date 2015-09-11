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

    public function print_unique($message) {
        $tab_paragraphs = explode(',', $this->fetch_paragraphs($message->ID));


        $this->load->view('print_unique', array('para' => $tab_paragraphs, 'message' => $message));
    }

    public function fetch_paragraphs($id_message) {
        $this->db->select('Text');
        $this->db->where('ID_MESSAGE', $id_message);
        $query = $this->db->get('paragraphe');

        $paras = '';

        foreach ($query->result() as $row) {
            $paras = $paras . ',' . $row->Text;
        }

        return substr($paras, 1);
    }

    public function index() {

        $this->load->view('templates/header');

        $tab_year = array_unique(explode(',', $this->getyears()));
        sort($tab_year);


        $tab_messages = $this->get_last_messages();

        $this->print_unique($tab_messages['fra']);

        /*
          foreach ($tab_year_distinct_sorted as $value) {
          echo "<p>"
          } */

        // Connect to database 
        // select * message
        // order by date
        // print the newer one
        // menu right : 
        // select each years 
        // print by order
        // link to select all messages for the year


        $this->load->view('templates/footer');
    }

}

?>