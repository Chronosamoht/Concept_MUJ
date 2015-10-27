<?php

class Concept extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    
    function getparas_byconcept($concept) {      
        
        $res = $this->db->query("SELECT p.ID, p.ID_MESSAGE, p.Text "
                . "FROM paragraphe p, concepts, tags "
                . "WHERE concepts.Name='$concept' AND concepts.ID=tags.ID_concept AND tags.ID_para=p.ID "
                . "ORDER BY tags.nb_values+0");
        
        return $res->result();
    }

    
}
