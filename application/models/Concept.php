<?php

class Concept extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    
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
    
    function addConcept($concept) {
        $this->db->set('Name', $concept['concept']);
        $this->db->insert('concepts');

        return TRUE;
    }
    
    function getidconcept_byidpara($id) {
        $this->db->select('ID_concept');
        $this->db->where('ID_para', $id);
        $query = $this->db->get('tags');
        
        return $query->result();
    }
    
    
    
    
    function getparas_byconcept($concept) {      
        
        $res = $this->db->query("SELECT p.ID, p.ID_MESSAGE, p.Text "
                . "FROM paragraphe p, concepts, tags "
                . "WHERE concepts.Name='$concept' AND concepts.ID=tags.ID_concept AND tags.ID_para=p.ID "
                . "ORDER BY tags.nb_values+0");
        
        return $res->result();
    }

    
}
