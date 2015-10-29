<?php

class Message_muj extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function SaveForm($form_data) {
        $date = $form_data['date'];
        $adresse = $form_data['adresse'];

        $date2 = new DateTime($date);

        $this->db->set('Date', $date2->format('Y-m-d'));
        $this->db->set('Adresse', $adresse);
        $this->db->set('ID_LANG', 1);
        $this->db->insert('message');


        $this->db->set('Date', $date2->format('Y-m-d'));
        $this->db->set('Adresse', $adresse);
        $this->db->set('ID_LANG', 2);
        $this->db->insert('message');


        $this->save_paragraph($form_data['lettre'], $this->getIDmessage($date2->format('Y-m-d'), 1));
        $this->save_paragraph($form_data['anglais'], $this->getIDmessage($date2->format('Y-m-d'), 2));


        return TRUE;
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

    function getIDmessage($date, $id_lang) {

        //     $query = $this->db->query('SELECT ID FROM message WHERE Date='.$date.' AND ID_LANG='.$id_lang.';');
        $this->db->select('ID');
        $this->db->where('Date', $date);

        $this->db->where('ID_LANG', $id_lang);
        $query = $this->db->get('message');
        $res = $query->result();

        return intval($res[0]->ID);
    }
    
    function getmessagebyID($id_mess) {

        //     $query = $this->db->query('SELECT ID FROM message WHERE Date='.$date.' AND ID_LANG='.$id_lang.';');
        $this->db->select('ID, Date, Adresse');
        $this->db->where('ID', $id_mess);
        $query = $this->db->get('message');

        return $query->result();
    }
    
    
    function getmessagesbyyears($tabyears) {
        $query = "SELECT ID, Date, Adresse FROM message WHERE ID_LANG =1 ";
         if(!empty($tabyears)) {
            $where = "AND ( 0=1 ";
            foreach($tabyears as $a) {
                $where = $where . " OR Date LIKE '" . $a . "%'";
            }
            $query = $query . $where . ")";
        } 
        
        $res = $this->db->query($query);
        return $res->result();
    }
    

    function save_paragraph($text, $id_message) {


        $tab_paragraphs = explode("\n", $text);

        foreach ($tab_paragraphs as $para) {
            if (str_word_count($para) > 0) {
                $this->db->set('text', $para);
                $this->db->set('ID_MESSAGE', $id_message);

                $this->db->insert('paragraphe');
            }
        }

        return TRUE;
    }

}

