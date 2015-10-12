<?php



class Paragraphe extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
        
        function getPara($num_para, $id_message) {
            
            $this->db->select('ID, Text, ID_MESSAGE');
            $this->db->where('ID_MESSAGE', $id_message);
            $query = $this->db->get('paragraphe');
            $res = $query->result();
            
            return $res[$num_para];
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
