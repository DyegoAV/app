<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect('perfil/alterarsenha');
	}

	public function alterarsenha()
	{
		$this->form_validation->set_rules('old', 'Senha atual', 'required');
		$this->form_validation->set_rules('new', 'Nova senha', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', 'Confirmar nova senha', 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			$this->data['usuario'] = $user;

			// $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['_view'] = 'perfil/alterarsenha';
			$this->load->view('layouts/main', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('login/logout', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('perfil/alterarsenha', 'refresh');
			}
		}
	}

}
