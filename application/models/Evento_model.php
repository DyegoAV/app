<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Evento_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_eventos() {
        return $this->db->get('evento')->result_array();
    }

    function get_evento_por_regiao($idRegiaoAdministrativa, $dataAtual) {
        $this->db->select('evento.*, l.nome as nomeLocalEntrega, l.endereco as enderecoLocalEntrega'.
            ', l.url_google_maps as mapsLocalEntrega, l.evento_familias as entregaFamiliasLocalEntrega');
        $this->db->join('evento l', 'l.id = evento');
        $this->db->where('ano_evento', date("Y"));
        $this->db->where('l.evento_familias', false);
        $this->db->where('regiao_administrativa', $idRegiaoAdministrativa)
            ->group_start()
            ->where('data_regular', true)
            ->or_where('inicio <=', $dataAtual)
            ->group_end();
        $this->db->order_by('inicio', 'desc');
        
        $retorno = $this->db->get('evento')->result_array();
        
        return $retorno;
    }
    
    function get_evento_familias_por_regiao($idRegiaoAdministrativa) {
        $this->db->select('evento.*, l.nome as nomeLocalEntrega, l.endereco as enderecoLocalEntrega'.
            ', l.url_google_maps as mapsLocalEntrega, l.evento_familias as entregaFamiliasLocalEntrega');
        $this->db->join('evento l', 'l.id = evento');
        $this->db->where('ano_evento', date("Y"));
        $this->db->where('l.evento_familias', true);
        $this->db->where('regiao_administrativa', $idRegiaoAdministrativa);
        $this->db->order_by('inicio', 'desc');
        
        $retorno = $this->db->get('evento')->row_array();
        
        return $retorno;
    }
    
    function get_evento_familias() {
        $this->db->select('evento.*, l.nome as nomeLocalEntrega, l.id as idLocalEntrega, l.endereco as enderecoLocalEntrega'.
            ', l.url_google_maps as mapsLocalEntrega, l.evento_familias as entregaFamiliasLocalEntrega'.
            ', r.nome as regiao_administrativa_nome, r.id as regiao_administrativa_id');
        $this->db->join('evento l', 'l.id = evento');
        $this->db->join('regiao_administrativa r', 'r.id = evento.regiao_administrativa');
        $this->db->where('ano_evento', date("Y"));
        $this->db->where('l.evento_familias', true);
        $this->db->order_by('r.nome', 'asc');
        $this->db->order_by('l.nome', 'asc');

        return $this->db->get('evento')->result_array();
    }
}
?>