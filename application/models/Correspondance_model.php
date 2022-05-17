<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correspondance_model extends CI_Model {

    var $table = 'correspondance';
		var $column = array('id','im','nom','dateDepot','dateEnvoie','ministere');
		var $viewColumn = array('id','im','nom','dateDepot','dateEnvoie','observation','service_direction','nature','bordereau','analyse','ministere');
    var $order = array('id' => 'desc');
    
    
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		    $this->search = '';

	}

	// pour l'incrementation
	   public function select_maxid() {
		// $data = $this->db->query("SELECT MAX(`id`) as `maxid` FROM `chambre` ")->row()->maxid;
		// return json_encode($data);
		$query = $this->db->select_max('id','maxid')->from('correspondance')->get();
		return $query->row()->maxid;
		}

	// delete define by delete all
	function delete($id)  {   
		$this->db->where('id', $id);   
		$this->db->delete('correspondance');  
	} 

	 //rech pour la date depot
	 function searchDepot($first_date, $second_date) {
		$this->db->select('*');
		$this->db->from('correspondance');
		$this->db->where('dateDepot >=' , $first_date);
		$this->db->where('dateDepot <=' , $second_date);
		return $this->db->get();
	}

	//rech pour la date envoie
	function searchEnvoie($first_date, $second_date) {
		$this->db->select('*');
		$this->db->from('correspondance');
		$this->db->where('dateEnvoie >=' , $first_date);
		$this->db->where('dateEnvoie <=' , $second_date);
		return $this->db->get();
	}

	
	//count visee
	public function selectVisaa() {
		$column_name = 'observation';
		$table_name = 'correspondance';
		$type = 'visee';

		$this->db->select($column_name);
		$this->db->where($column_name,$type);
		$q = $this->db->get($table_name);
		$count = $q->result();
		return count($count);
	}

		//count arrivee
		public function selectArrr() {
			$column_name = 'observation';
			$table_name = 'correspondance';
			$type = 'arrivee';
	
			$this->db->select($column_name);
			$this->db->where($column_name,$type);
			$q = $this->db->get($table_name);
			$count = $q->result();
			return count($count);
		}

		//count rejete
		public function selectRejj() {
			$column_name = 'observation';
			$table_name = 'correspondance';
			$type = 'rejete';
	
			$this->db->select($column_name);
			$this->db->where($column_name,$type);
			$q = $this->db->get($table_name);
			$count = $q->result();
			return count($count);
		}


	// count total correspondance
	public function total_rows_corresp() {
		  $data = $this->db->get('correspondance');
		  return $data->num_rows();
	}

	//for simple table
	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

		public function get_by_id_view($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$results = $query->result();
		}
		return $results;
	}


	
/////////////For all view table//////////////////
private function _get_datatables_queryViewAll()
{
	
	$this->db->from($this->table);

	$i = 0;

	foreach ($this->viewColumn as $item) 
	{
		if($_POST['search']['value'])
			($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
		$viewColumn[$i] = $item;
		$i++;
	}
	
	if(isset($_POST['order']))
	{
		$this->db->order_by($viewColumn[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	} 
	else if(isset($this->order))
	{
		$order = $this->order;
		$this->db->order_by(key($order), $order[key($order)]);
	}
}

function get_datatablesViewAll()
{
	$this->_get_datatables_queryViewAll();
	if($_POST['length'] != -1)
	$this->db->limit($_POST['length'], $_POST['start']);
	$query = $this->db->get();
	return $query->result();
}

function count_filteredViewAll()
	{
		$this->_get_datatables_queryViewAll();
		$query = $this->db->get();
		return $query->num_rows();
	}

/////////////////////////////////////////////////////// FOR EXCEL ONLY //////////////////////////////////////////////////////////////////////////////////
 
  ///////////  VERIFIER IM ///////////
  public function check_im($im) {
	$this->db->where('im', $im);
	$data = $this->db->get('correspondance');
	return $data->num_rows();
  }

///////  function select all for export excel /////
public function select_all() {
	$this->db->select('*');
	$this->db->from('correspondance');
	$data = $this->db->get();
	return $data->result();
}

/////////////////////// inserer dans la base de donnee ////////////////////////////////////
   public function insert_batch($data) {
	$this->db->insert_batch('correspondance', $data);
	return $this->db->affected_rows();
}

    

}

/* End of file Correspondance.php */



























































?>