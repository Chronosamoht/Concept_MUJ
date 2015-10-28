<?php

class Paragraphe extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getPara($num_para, $id_message) {

        $this->db->select('ID, Text, ID_MESSAGE');
        $this->db->where('ID_MESSAGE', $id_message);
        $query = $this->db->get('paragraphe');
        $res = $query->result();

        return $res[$num_para];
    }


    public function getparas_bytext($text) {
        $res = $this->db->query("SELECT ID, ID_MESSAGE, Text FROM paragraphe WHERE Text Like '%$text%'");
        $tab = array();
        foreach ($res->result() as $value) {
            array_push($tab, serialize($value));
        }
        
        return $tab;
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
    
    
    public function getparasbyidmess($id) {
        $res = $this->db->query("SELECT ID, ID_MESSAGE, Text FROM paragraphe WHERE ID_MESSAGE=$id");
        return $res->result();
    }

    
    
    public function getparabyid($id) {
        $res = $this->db->query("SELECT ID, ID_MESSAGE, Text FROM paragraphe WHERE ID='$id'");
        return $res->result()[0];
    }
    
    
    function SaveForm($data) {
        $this->db->insert('paragraphe', $data);

        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }
    
    

}

?>
