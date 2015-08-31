<?php

class Message_muj_fr extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function SaveForm($form_data)
	{
		$this->db->insert('message', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
}


class Message_muj_en extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function SaveForm($form_data)
	{
		$this->db->insert('message', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
}


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