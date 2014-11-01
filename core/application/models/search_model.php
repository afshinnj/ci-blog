<?php
class search_model extends AB_Model
{

	public function search(){
		$search = $this->input->post('search',TRUE);
		if($search){
			$this->db->like('title', $search, 'both');
			$this->db->or_like('summary', $search, 'both');
			$this->db->or_like('fulltext', $search, 'both');
			return $this->db->get('article')->result();
		}else{
			return FALSE;
			}
		}

}