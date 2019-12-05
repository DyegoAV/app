<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Evento extends MY_Controller
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
        $data['eventos'] = $this->Evento_model->get_eventos();

        $data['js_scripts'] = array('evento/index.js');
        $data['_view'] = 'evento/index';
        $this->load->view('layouts/main',$data);
    }

    function add()
    {
        $this->form_validation->set_rules('data_inicio','Data de Início','required');
        $this->form_validation->set_rules('data_fim','Data Fim','required');
        $this->form_validation->set_rules('local','Local do Evento','required');

        if($this->form_validation->run())     
        {
            $campanha_atual = $this->Campanha_model->get_campanha_atual();
            $local = $this->Local_model->get_local($this->input->post('local'));

            $date1 = strtr($this->input->post('data_inicio'), '/', '-');
            $date2 = strtr($this->input->post('data_fim'), '/', '-');
            $params = array(
                'inicio' => date('Y-m-d', strtotime($date1)),
                'termino' => date('Y-m-d', strtotime($date2)),
                'local_entrega' => $this->input->post('local'),
                'ano_evento' => $campanha_atual['AA_CAMPANHA'],
                'data_regular' => 1,
                'possui_evento' => (int)($local['local_tipo'] == 1 ? 0 : 1),
                'possui_palestra' => (int)($local['local_tipo'] == 1 ? 0 : ((int)$this->input->post('quantidade_responsaveis') > 0 ? 1 : 0)),
                'NU_TBC01' => $campanha_atual['NU_TBC01'],
                'quantidade_beneficiados' => (int)$this->input->post('quantidade_beneficiados'),
                'quantidade_responsaveis' => (int)$this->input->post('quantidade_responsaveis'),
                'quantidade_salas_beneficiados' => 0,
                'quantidade_salas_resposaveis' => 0
            );

            $evento_id = $this->Evento_model->add_evento($params);
            $this->session->set_flashdata('message_ok', 'Evento cadastrado com sucesso, favor vincular as instituições que irão participar.');
            redirect('evento/index');
        }
        else
        {
            $data['locais'] = $this->Local_model->get_locais_ativos();
            
            $data['js_scripts'] = array('evento/add.js');
            $data['_view'] = 'evento/add';
            $this->load->view('layouts/main',$data);
        }
    }

    function edit($id)
    {
        $data['evento'] = $this->Evento_model->get_evento($id);
        if (isset($data['evento']['id']))
        {
            $data['local'] = $this->Local_model->get_local($data['evento']['local_entrega']);

            $this->form_validation->set_rules('data_inicio','Data de Início','required');
            $this->form_validation->set_rules('data_fim','Data Fim','required');
            $this->form_validation->set_rules('local','Local do Evento','required');

            if($this->form_validation->run())     
            {
                $campanha_atual = $this->Campanha_model->get_campanha_atual();

                $date1 = strtr($this->input->post('data_inicio'), '/', '-');
                $date2 = strtr($this->input->post('data_fim'), '/', '-');
                $params = array(
                    'inicio' => date('Y-m-d', strtotime($date1)),
                    'termino' => date('Y-m-d', strtotime($date2)),
                    'local_entrega' => $this->input->post('local'),
                    'ano_evento' => $campanha_atual['AA_CAMPANHA'],
                    'data_regular' => 1,
                    'possui_evento' => (int)($data['local']['local_tipo'] == 1 ? 0 : 1),
                    'possui_palestra' => (int)($data['local']['local_tipo'] == 1 ? 0 : ((int)$this->input->post('quantidade_responsaveis') > 0 ? 1 : 0)),
                    'NU_TBC01' => $campanha_atual['NU_TBC01'],
                    'quantidade_beneficiados' => (int)$this->input->post('quantidade_beneficiados'),
                    'quantidade_responsaveis' => (int)$this->input->post('quantidade_responsaveis'),
                    'quantidade_salas_beneficiados' => 0,
                    'quantidade_salas_resposaveis' => 0
                );

                $evento_id = $this->Evento_model->update_evento($id, $params);
                $this->session->set_flashdata('message_ok', 'Evento atualizado com sucesso.');
                redirect('evento/index');
            }
            else
            {
                $data['locais'] = $this->Local_model->get_locais_ativos();
                
                $data['js_scripts'] = array('evento/edit.js');
                $data['_view'] = 'evento/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('O evento que você está tentando editar não existe.');
    }
}
?>