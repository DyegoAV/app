<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Local extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Local_model');
        $this->load->model('Evento_model');
        $this->load->model('Campanha_model');
    }

    function index()
    {
        $data['locais'] = $this->Local_model->get_locais();

        $data['js_scripts'] = array('local/index.js');
        $data['_view'] = 'local/index';
        $this->load->view('layouts/main',$data);
    }

    function add()
    {
        $this->form_validation->set_rules('nome','Nome','required');
        $this->form_validation->set_rules('endereco','Endereço','required');
        $this->form_validation->set_rules('tipo','Tipo de Local','required');
        
        if($this->form_validation->run())     
        {
            $params = array(
                'nome' => mb_strtoupper(trim($this->input->post('nome'))),
                'endereco' => mb_strtoupper(trim($this->input->post('endereco'))),
                'url_google_maps' => trim($this->input->post('url_google_maps')),
                'local_tipo' => $this->input->post('tipo'),
                'ativo' => 1
            );
            $local_id = $this->Local_model->add_local($params);

            $this->session->set_flashdata('message_ok', 'Local cadastrado com sucesso.');
            redirect('local/index');
        }
        else
        {
            $data['tipos'] = $this->Local_model->get_tipos();

            $data['js_scripts'] = array('local/add.js');
            $data['_view'] = 'local/add';
            $this->load->view('layouts/main',$data);
        }
    }

    function edit($id)
    {
        $data['local'] = $this->Local_model->get_local($id);
        if(isset($data['local']['id']))
        {
            $this->form_validation->set_rules('nome','Nome','required');
            $this->form_validation->set_rules('endereco','Endereço','required');
            $this->form_validation->set_rules('tipo','Tipo de Local','required');
            
            if ($this->form_validation->run())
            {
                $params = array(
                    'nome' => mb_strtoupper(trim($this->input->post('nome'))),
                    'endereco' => mb_strtoupper(trim($this->input->post('endereco'))),
                    'url_google_maps' => trim($this->input->post('url_google_maps')),
                    'local_tipo' => $this->input->post('tipo'),
                    'ativo' => (array_key_exists('ativo', $this->input->post()) ? 1 : 0)
                );
                $local_id = $this->Local_model->update_local($id, $params);

                $this->session->set_flashdata('message_ok', 'Local alterado com sucesso.');
                redirect('local/index');
            }
            else
            {
                $data['tipos'] = $this->Local_model->get_tipos();

                $data['js_scripts'] = array('local/edit.js');
                $data['_view'] = 'local/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('O local que você está tentando editar não existe.');
    }
}
?>