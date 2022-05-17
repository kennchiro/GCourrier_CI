<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	public function login($user, $pass) {
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('nom', $user);
		$this->db->where('mdp', $pass);

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}


}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */