<?php


class Site_model extends Eloquent {

    protected $table = 'my_users';

    function get_records()
	{
		// $query = $this->db->get('data');
		// return $query->result();



		//$allRecords = Site_model::all();
	}

	function add_record($data)
	{
		$this->db->insert('data', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('data', $data);
	}

	function delete_row()
	{
		$this->db->where('id', $this->uri->segment(3));
		$this->db->delete('data');
	}

	function get_specific_records($id)
	{
		$this->db->select('*');
		$this->db->from('data');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

}