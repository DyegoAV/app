<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Evento extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Local_model');
        $this->load->model('Evento_model');
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
        $data['locais'] = $this->Local_model->get_locais_ativos();
        
        $data['js_scripts'] = array('evento/add.js');
        $data['_view'] = 'evento/add';
        $this->load->view('layouts/main',$data);
    }
}
?>