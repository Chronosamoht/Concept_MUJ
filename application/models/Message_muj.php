<?php

class Message_muj extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

        
	function SaveForm($form_data)
	{
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
                
                
                $this->save_paragraph($form_data['lettre'], $this->getIDmessage($date2->format('Y-m-d'),  1));
                $this->save_paragraph($form_data['anglais'], $this->getIDmessage($date2->format('Y-m-d'),  2));
		
		
		return TRUE;
	}
        
        function getIDmessage($date,$id_lang) {
            
       //     $query = $this->db->query('SELECT ID FROM message WHERE Date='.$date.' AND ID_LANG='.$id_lang.';');
            $this->db->select('ID');
            $this->db->where('Date', $date);
            
            $this->db->where('ID_LANG', $id_lang);
            $query = $this->db->get('message');
            $res =  $query->result();

            return intval($res[0]->ID);
        }
        
	function save_paragraph($text, $id_message)
	{
		
                
                $tab_paragraphs = explode("\r\n", trim($text));
                
		foreach($tab_paragraphs as $para)
		{
			if(str_word_count($para) > 2) {
				$this->db->set('text', $para);
                                $this->db->set('ID_MESSAGE', $id_message);
				$this->db->set('Tags', '');
				$this->db->insert('paragraphe');
				
			}
		}
                
		return TRUE;
	}
		
		
}

?>