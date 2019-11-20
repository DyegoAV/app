<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Local extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Local_entrega_model');
        $this->load->model('Local_entrega_regiao_model');
    }

    function index()
    {
        $data['locais'] = $this->Local_entrega_model->get_locais();
        
        $data['js_scripts'] = array('local/index.js');
        $data['_view'] = 'local/index';
        $this->load->view('layouts/main',$data);
    }

    function add()
    {
        $data['tipos'] = $this->Local_entrega_model->get_tipos();

        $data['js_scripts'] = array('local/add.js');
        $data['_view'] = 'local/add';
        $this->load->view('layouts/main',$data);
    }
}
?>