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
        //var_dump($para1);
        
        $tab_para = array('text' => $para2->Text, 'concepts' => $para2->Tags);
       //echo $para2->Text.";;;".$para2->ID;
        $this->output->set_content_type('application/json')
        ->set_output(json_encode($tab_para));
    //   echo ['text'] ;
     //   var_dump($para2);
    }

}
