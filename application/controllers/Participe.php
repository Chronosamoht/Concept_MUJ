<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Participe extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('array_helper');
    }

    public function index() {
        $this->load->view('templates/header');

        $this->load->view('templates/footer');
    }

    public function getRandomPara() {
        $this->db->select('ID, Text');
        $query = $this->db->get('paragraphe');

        return random_element($query->result());
    }

}
