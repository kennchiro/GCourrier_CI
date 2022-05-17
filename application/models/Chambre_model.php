<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chambre_model extends CI_Model {

	var $table = 'chambre';
	var $column = array('id','im','nom','dateDepot','dateEnvoie');
	var $viewColumn = array('id','im','nom','dateDepot','dateEnvoie','dateDecision','observation','service','numeroCompte','bordereau','titulaire','analyse','montant');
	var $order = array('id' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		    $this->search = '';

	}

	// delete define by delete all
	function delete($id)  {   
		$this->db->where('id', $id);   
		$this->db->delete('chambre');  
	} 


 // pour l'incrementation
	public function select_maxid() {
	// $data = $this->db->query("SELECT MAX(`id`) as `maxid` FROM `chambre` ")->row()->maxid;
	// return json_encode($data);
	$query = $this->db->select_max('id','maxid')->from('chambre')->get();
	return $query->row()->maxid;
	}


	//count visee
	public function selectVisa() {
		$column_name = 'observation';
		$table_name = 'chambre';
		$type = 'visee';

		$this->db->select($column_name);
		$this->db->where($column_name,$type);
		$q = $this->db->get($table_name);
		$count = $q->result();
		return count($count);
	}

		//count arrivee
		public function selectArr() {
			$column_name = 'observation';
			$table_name = 'chambre';
			$type = 'arrivee';
	
			$this->db->select($column_name);
			$this->db->where($column_name,$type);
			$q = $this->db->get($table_name);
			$count = $q->result();
			return count($count);
		}

		//count rejete
		public function selectRej() {
			$column_name = 'observation';
			$table_name = 'chambre';
			$type = 'rejete';
	
			$this->db->select($column_name);
			$this->db->where($column_name,$type);
			$q = $this->db->get($table_name);
			$count = $q->result();
			return count($count);
		}

	/////////total count //////////
	public function total_rows_chambre() {
		$data =  $this->db->get('chambre');
		return $data->num_rows();
	}

	 //rech pour la date depot
	function searchDepot($first_date, $second_date) {
		$this->db->select('*');
		$this->db->from('chambre');
		$this->db->where('dateDepot >=' , $first_date);
		$this->db->where('dateDepot <=' , $second_date);
		return $this->db->get();
	}

	//rech pour la date envoie
	function searchEnvoie($first_date, $second_date) {
		$this->db->select('*');
		$this->db->from('chambre');
		$this->db->where('dateEnvoie >=' , $first_date);
		$this->db->where('dateEnvoie <=' , $second_date);
		return $this->db->get();
	}



////////////////////////////////////////////////////////////////////////////////////////////////

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


	// function get_datatablesDate($first_date, $second_date)
	// {
	// 	$this->_get_datatables_query();
	// 	if($_POST['length'] != -1)
	// 	$this->db->limit($_POST['length'], $_POST['start']);
  //   $this->db->where('dateDepot >=' , $first_date);
	// 	$this->db->where('dateDepot <=' , $second_date);
	// 	$query = $this->db->get('chambre');

	// 	return $query->result();
	// }

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

	//delete
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

//for simple table 
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
	$data = $this->db->get('chambre');
	return $data->num_rows();
  }

///////  function select all for export excel /////
public function select_all() {
	$this->db->select('*');
	$this->db->from('chambre');
	$data = $this->db->get();
	return $data->result();
}

/////////////////////// inserer dans la base de donnee ////////////////////////////////////
   public function insert_batch($data) {
	$this->db->insert_batch('chambre', $data);
	return $this->db->affected_rows();
}

//////////////////////////////////CHART////////////////////////////////////////////////////////

/////statistique count de mois janvier de l'observation visee//////
function countJanvierVisee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'visee';
	$debutJanvier = '2019-01-01';
	$finJanvier = '2019-01-31';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debutJanvier);
	$this->db->where('dateDepot <=', $finJanvier);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois fevrier de l'observation visee//////
function countFevierVisee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'visee';
	$debut = '2019-02-01';
	$fin = '2019-02-28';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}



/////statistique count de mois Mars de l'observation visee//////
function countMarsVisee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'visee';
	$debut = '2019-03-01';
	$fin = '2019-03-30';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois Avril de l'observation visee//////
function countAvrilVisee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'visee';

	$debut = '2019-04-01';
	$fin = '2019-04-30';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois Mai de l'observation visee//////
function countMaiVisee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'visee';

	$debut = '2019-05-01';
	$fin = '2019-05-30';
	
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}

/////statistique count de mois Juin de l'observation visee//////
function countJuinVisee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'visee';

	$debut = '2019-06-01';
	$fin = '2019-06-30';
	
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois Octobre de l'observation visee//////
function countOctobreVisee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'visee';

	$debut = '2019-10-01';
	$fin = '2019-10-30';
	
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}
////////////////////////////////////////////////////////////////////


/////statistique count de mois janvier de l'observation arrivee//////
function countJanvierArriver() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'arrivee';
	$debutJanvier = '2019-01-01';
	$finJanvier = '2019-01-31';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debutJanvier);
	$this->db->where('dateDepot <=', $finJanvier);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois fevrier de l'observation arrivee//////
function countFevierArrivee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'arrivee';
	$debut = '2019-02-01';
	$fin = '2019-02-28';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}



/////statistique count de mois Mars de l'observation arrivee//////
function countMarsArrivee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'arrivee';
	$debut = '2019-03-01';
	$fin = '2019-03-30';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois Avril de l'observation arrivee//////
function countAvrilArrivee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'arrivee';

	$debut = '2019-04-01';
	$fin = '2019-04-30';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois Mai de l'observation arrivee//////
function countMaiArrivee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'arrivee';

	$debut = '2019-05-01';
	$fin = '2019-05-30';
	
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}

/////statistique count de mois Juin de l'observation arrivee//////
function countJuinArrivee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'arrivee';

	$debut = '2019-06-01';
	$fin = '2019-06-30';
	
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois Octobre de l'observation arrivee//////
function countOctobreArrivee() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'arrivee';

	$debut = '2019-10-01';
	$fin = '2019-10-30';
	
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}

////////////////////////////////////////////////////////////////////



/////statistique count de mois janvier de l'observation rejete//////
function countJanvierRejete() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'rejete';
	$debutJanvier = '2019-01-01';
	$finJanvier = '2019-01-31';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debutJanvier);
	$this->db->where('dateDepot <=', $finJanvier);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois fevrier de l'observation rejete//////
function countFevierRejete() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'rejete';
	$debut = '2019-02-01';
	$fin = '2019-02-28';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}



/////statistique count de mois Mars de l'observation rejete//////
function countMarsRejete() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'rejete';
	$debut = '2019-03-01';
	$fin = '2019-03-30';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois Avril de l'observation rejete//////
function countAvrilRejete() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'rejete';

	$debut = '2019-04-01';
	$fin = '2019-04-30';
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois Mai de l'observation rejete//////
function countMaiRejete() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'rejete';

	$debut = '2019-05-01';
	$fin = '2019-05-30';
	
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}

/////statistique count de mois Juin de l'observation visee//////
function countJuinRejete() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'rejete';

	$debut = '2019-06-01';
	$fin = '2019-06-30';
	
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}


/////statistique count de mois Octobre de l'observation arrivee//////
function countOctobreRejete() {
	$column_name = 'observation';
	$table_name = 'chambre';
	$type = 'arrivee';

	$debut = '2019-10-01';
	$fin = '2019-10-30';
	
	
	$this->db->select($column_name);
	$this->db->from($table_name);
	$this->db->where($column_name,$type, 'AND');
	$this->db->where('dateDepot >=', $debut);
	$this->db->where('dateDepot <=', $fin);

	$q = $this->db->get();
	$count = $q->result();
	return count($count);
}
////////////////////////////////////////////////////////////////////



}
