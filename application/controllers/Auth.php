<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Auth_model');
	}
	
	public function index() {
		$session = $this->session->userdata('status');

		if ($session == '') {
			$this->load->view('login');
		} else {
			redirect('Welcome');
		}
	}

	public function login() {
		$this->form_validation->set_rules('nom', 'nom', 'required|min_length[4]|max_length[15]');
		$this->form_validation->set_rules('mdp', 'mdp', 'required');

		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['nom']);
			$password = trim($_POST['mdp']);

			$data = $this->Auth_model->login($username, $password);

			if ($data == false) {
				$this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.');
				redirect('Auth');
			} else {
				$session = [
					'userdata' => $data,
					'status' => "Loged in"
				];
				$this->session->set_userdata($session);
				redirect('Welcome');
			}
		} else {
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect('Auth');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('Auth');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */