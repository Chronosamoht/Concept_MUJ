<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Concepts extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('date');
        $this->load->helper('url');
        $this->load->model('Message_muj');
    }

    public function index() {
        $this->load->view('templates/header');

        //   $this->load->view('formulaire_concept');

        $this->load->view('templates/footer');
    }

}

?>
