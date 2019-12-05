<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Local_model extends CI_Model
{
    const LOCAL_COLETA = 1;
    const LOCAL_EVENTO = 2;

    function __construct()
    {
        parent::__construct();
    }
    
    function get_locais() {
        $this->db->select('local.*, local_tipo.nome as nome_tipo_local');
        $this->db->join('local_tipo', 'local_tipo.id = local.local_tipo', 'INNER');
        $this->db->order_by('local_tipo.id, local.nome');
        return $this->db->get('local')->result_array();
    }
    
    function get_local($id) {
        $this->db->select('local.*, local_tipo.nome as nome_tipo_local');
        $this->db->join('local_tipo', 'local_tipo.id = local.local_tipo', 'INNER');
        return $this->db->get_where('local', array('local.id' => $id))->row_array();
    }
    
    function get_locais_ativos() {
        $this->db->select('local.*, local_tipo.id as id_tipo_local, local_tipo.nome as nome_tipo_local');
        $this->db->join('local_tipo', 'local_tipo.id = local.local_tipo', 'INNER');
        $this->db->order_by('local.nome');
        return $this->db->get_where('local', array('local.ativo' => 1))->result_array();
    }

    function get_tipos() {
        return $this->db->get_where('local_tipo', array('ativo' => 1))->result_array();
    }

    function get_locais_armazenamento() {
        return $this->db->get_where('local',array('local_tipo' => self::LOCAL_COLETA))->result_array();
    }

    function get_locais_entrega_presente() {
        return $this->db->get_where('evento',array('local_tipo' => self::LOCAL_EVENTO))->result_array();
    }

    function add_local($params) {
        $this->db->insert('local', $params);
        return $this->db->insert_id();
    }

    function update_local($id, $params)
    {
        $this->db->where('id', $id);
        return $this->db->update('local', $params);
    }
}
?>