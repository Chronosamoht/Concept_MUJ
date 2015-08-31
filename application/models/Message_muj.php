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
		
		$ids_paragraphs_fr = $this->save_paragraph($form_data['lettre']);
		$ids_paragraphs_en = $this->save_paragraph($form_data['anglais']);
		
		$this->db->set('date', $date);
		$this->db->set('adresse', $adresse);
		$this->db->set('ID_LANG', 1);
		$this->db->set('Paragraphes', $ids_paragraphs_fr);
		$this->db->insert('message');
		
		$this->db->set('date', $date);
		$this->db->set('adresse', $adresse);
		$this->db->set('ID_LANG', 2);
		$this->db->set('Paragraphes', $ids_paragraphs_en);
		$this->db->insert('message');
		
		if ($this->db->affected_rows() == '2')
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	function save_paragraph($text)
	{
		$tab_paragraphs = explode("\r\n", trim($text));
		
		$this->db->select_max('id')->from('langue');
		$query = $this->db->get();
		
		$res =  $query->result();
		$id = intval($res[0]->id);
		$i = 0;
		$deb = 1 +$id;
		foreach($tab_paragraphs as $para)
		{
			if(str_word_count($para) > 2) {
				$this->db->set('text', $para);
				$this->db->set('Tags', '');
				$this->db->insert('paragraphe');
				++$i;
			}
		}
		
		return strval($deb).','.strval($deb+$i);
	}
		
		
}

?>