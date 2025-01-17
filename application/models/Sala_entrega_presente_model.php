<?php
 
class Sala_entrega_presente_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_por_ano($ano)
    {
        $this->db->select('sala_entrega_presente.*, local.nome as local_entrega_nome
            , regiao_administrativa.nome as regiao_administrativa_nome');
        $this->db->join('local', 'sala_entrega_presente.local_entrega = local.id');
        $this->db->join('regiao_administrativa', 'sala_entrega_presente.regiao_administrativa = regiao_administrativa.id');
        $this->db->where('ano', $ano);
        return $this->db->get('sala_entrega_presente')->result_array();
    }
    
    function get_por_id($id)
    {
        $this->db->select('sala_entrega_presente.*, local.nome as local_entrega_nome
            , regiao_administrativa.nome as regiao_administrativa_nome, regiao_administrativa.id as regiao_administrativa_id');
        $this->db->join('local', 'sala_entrega_presente.local_entrega = local.id');
        $this->db->join('regiao_administrativa', 'sala_entrega_presente.regiao_administrativa = regiao_administrativa.id');
        $this->db->where('sala_entrega_presente.id', $id);
        return $this->db->get('sala_entrega_presente')->row_array();
    }
}