<?php



class Paragraphe extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function SaveForm($data)
	{
		$this->db->insert('paragraphe', $data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
}

?>