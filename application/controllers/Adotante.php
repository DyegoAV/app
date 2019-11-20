<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); 
class Adotante extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        
        $this->load->model('Carta_model');
        $this->load->model('Campanha_model');
        $this->load->model('Adotante_model');
        $this->load->model('Brinquedo_classificacao_model');
        $this->load->model('Presente_model');
        $this->load->model('Local_entrega_regiao_model');
        $this->load->model('Local_entrega_model');
        $this->load->model('Presente_historico_situacao_model');
        $this->load->model('NatalSolidario_model');
        
        $this->session->set_userdata('nomeAdotante', '');
        $this->session->set_userdata('cartasAdotante', []);

        $this->campanha_atual = $this->Campanha_model->get_campanha_atual();
    }
    
    function index($idAdotante = null, $token = null)
    {
        $this->session->set_userdata('idAdotante', $idAdotante);
        $this->session->set_userdata('tokenAdotante', $token);
        
        $this->carregarMenu($idAdotante, $token);
        
        $data['campanha_atual'] = $this->campanha_atual;
        $data['_view'] = 'presente/index';
        $this->load->view('layouts/main_presente',$data);
    }
    
    function logar()
    {
		$this->form_validation->set_rules('usuario', 'Dados de acesso', 'required');
		if ($this->form_validation->run())
		{
            $valor = trim($this->input->post('usuario'));
            $adotante = $this->Adotante_model->get_adotante($valor);
            if (sizeof($adotante) > 0)
            {
                $adotante2 = $this->Adotante_model->get_adotante($adotante[0]['email']);
                $adotante3 = $this->Adotante_model->get_adotante($adotante[0]['telefone']);
                $adotante4 = $this->Adotante_model->get_adotante($adotante[0]['telefone_trabalho']);
    
                $adotante = array_merge($adotante2, $adotante3, $adotante4);
                $adotante = array_map("unserialize", array_unique(array_map("serialize", $adotante)));
                // echo "<pre>";
                // print_r($adotante);

                foreach ($adotante as $a)
                {
                    if (!isset($idPrincipal))
                    {
                        $idPrincipal = $a['id'];
                        $token = $a['token_acesso'];
                    }

                    // print_r($a);
                    $cartas = $this->Carta_model->pesquisar_por_ano_adotante($this->campanha_atual['AA_CAMPANHA'], $a['id']);
                    foreach ($cartas as $carta)
                    {
                        if ($carta['adotante'] != $idPrincipal)
                        {
                            $params = array(
                                'adotante' => $idPrincipal
                            );
                            $this->Carta_model->update_carta_pedido($carta['id'], $params);
                        }
                        // print_r($carta);
                    }
                }
                // exit();
                redirect('adotante/index/'.$idPrincipal.'/'.urlencode($token));
            }
            else
            {
                $this->session->set_flashdata('message', 'Adotante não localizado em nossa base de dados, por favor tente novamente!');
                redirect('adotante/logar');
            }
        }
        else
        {
            $data['campanha_atual'] = $this->campanha_atual;
            $this->load->view('login_adotante', $data);
        }
    }
    
    function add($idCarta = null)
    {
        $this->form_validation->set_rules('descricaoBrinquedo','Brinquedo','required');
        $this->form_validation->set_rules('classificacaoBrinquedo','Classificação do brinquedo','required');

        $presente = $this->Presente_model->pesquisar_por_carta($idCarta);
        $data['origem'] = ($this->session->userdata('origem') != null) ? $this->session->userdata('origem') : $this->input->post('hdnOrigem');
        
        if($this->form_validation->run())
        {
            $valorBrinquedo = $this->input->post('valorBrinquedo');
            if ($valorBrinquedo) {
                $valorBrinquedo = str_replace(".","",$valorBrinquedo);
                $valorBrinquedo = str_replace(",",".",$valorBrinquedo);
            }
            
            $params = array(
                'situacao' => 1 /*NOVO*/,
                'carta' => $idCarta,
                'brinquedo_descricao' => $this->input->post('descricaoBrinquedo'),
                'brinquedo_classificacao' => $this->input->post('classificacaoBrinquedo'),
                'valor' => $valorBrinquedo
            );
            
            if ($presente) {
                $this->Presente_model->update($presente['id'], $params);
            } else {
                $params['data_cadastro'] = date('Y-m-d H:i:s');
                $this->Presente_model->add($params);
            }
            
            redirect('adotante/index/'.$this->session->userdata('idAdotante').'/'.$this->session->userdata('tokenAdotante'), 'location');
        }
        else
        {
            $this->carregarMenu($this->session->userdata('idAdotante'), $this->session->userdata('tokenAdotante'));
            
            $data['descricaoPresente'] = ($presente) ? $presente['brinquedo_descricao'] : '';
            $data['valorBrinquedo'] = ($presente) ? $presente['valor'] : '';
            $data['classificacaoBrinquedo'] = ($presente) ? $presente['brinquedo_classificacao'] : '';
            $data['situacao'] = ($presente) ? $presente['situacao'] : '1';
            
            $data['brinquedo_classificacoes'] = $this->Brinquedo_classificacao_model->get_all_classificacao_brinquedo();
            
            if(isset($idCarta)) {
                $data['cartaSelecionada'] = $this->Carta_model->get_dados_complementares_carta_por_id($idCarta);
            }

            $data['idade'] = date("Y") - date("Y", strtotime($data['cartaSelecionada']['data_nascimento']));
            
            $data['locais_entrega'] = $this->Local_entrega_regiao_model->get_local_entrega_por_regiao($data['cartaSelecionada']['regiao_administrativa'], date('Y/m/d'));
            if (!$data['locais_entrega']) {
                $data['locais_entrega'] = [];
            }
            
            $data['local_entrega_familia'] = $this->Local_entrega_regiao_model->get_local_entrega_familias_por_regiao($data['cartaSelecionada']['regiao_administrativa']);
            if (!$data['local_entrega_familia']) {
                $data['local_entrega_familia'] = '';
            }
            $dadosPresente = $this->Presente_model->get_dados_presente($this->input->post('numeroCarta'));
            $data['nomeLocalEntrega'] = urlencode($dadosPresente['nomeLocalEntrega']);
            $data['numeroSalaEntrega'] = $dadosPresente['numeroSalaEntrega'];
            

            // echo "<pre>";
            // print_r($data);
            // print_r($this->session->userdata());
            // exit();

            $data['campanha_atual'] = $this->campanha_atual;
            $data['_view'] = 'presente/add';
            $this->load->view('layouts/main_presente',$data);    
        }
    }

    function gerarEtiqueta() {
        $data = Array(
            'numeroCarta' => urldecode($this->uri->segment(3)),
            'nomeResponsavel' => urldecode($this->uri->segment(4)),
            'nomeCrianca' => urldecode($this->uri->segment(5)),
            'localEntrega' => urldecode($this->uri->segment(6)) . "<br /> Data Limite: " . urldecode($this->uri->segment(7)),
            'localEvento' => urldecode($this->uri->segment(8)) . "<br /> Sala: " . urldecode($this->uri->segment(9)),
            'urlQrcode' => urlencode(site_url().'presente/menuPresente/'.$this->uri->segment(3))
        );

        //load the view and saved it into $html variable
        $this->load->view('presente/template_etiqueta', $data);
    }

    public function send_teste() {
        $this->send_mail("Mensagem de corpo do e-mail", "dyegoav@gmail.com");
    }
    
    private function carregarMenu($idAdotante = null, $token = null) {
        $token_decoded = urldecode($token);
        
        $adotante = $this->Adotante_model->get_adotante_por_id($idAdotante);
        if ($adotante) {
            if ($adotante['token_acesso'] == $token_decoded)
            {
                $pieces = explode(" ", $adotante['nome']);
                
                $this->session->set_userdata('nomeAdotante', $adotante['nome']);
                $this->session->set_userdata('cartasAdotante', $this->Carta_model->pesquisar_por_ano_adotante(date("Y"), $idAdotante));
            }
            else
            {
                $this->session->set_flashdata('message', 'O endereço acessado é inválido, verifique se ele está igual ao recebido por e-mail.');
            }
        }
        else
        {
            $this->session->set_flashdata('message', 'Não localizamos o seu cadastro.');
            redirect('adotante/logar');
        }
    }

    private function send_mail($body, $emailTo)
    {
        $sysconfig = $this->NatalSolidario_model->get_all_config();

        if (array_key_exists('smtp_host', $sysconfig) && array_key_exists('smtp_user', $sysconfig) && array_key_exists('smtp_pass', $sysconfig))
        {
            $config = Array(
                'protocol' => 'smtp', // 'mail', 'sendmail', 'smtp'
                'smtp_host' => $sysconfig['smtp_host'],
                'smtp_port' => (isset($sysconfig['smtp_port']) ? $sysconfig['smtp_port'] : 587),
                'smtp_user' => $sysconfig['smtp_user'],
                'smtp_pass' => $sysconfig['smtp_pass'],
                'mailtype'  => 'html', // 'text', 'html'
                'charset'   => 'utf-8',
                'smtp_crypto' => (isset($sysconfig['smtp_crypto']) ? $sysconfig['smtp_crypto'] : 'ssl'), // 'ssl', 'tls'
                'validate' => TRUE,
                'newline' => "\r\n"
                );
            
            $this->email->initialize($config);
        }
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from($sysconfig['email_from'], $sysconfig['nome_from']);
        $this->email->to($emailTo);
        $this->email->subject('Natal Solidário - Entrega do presente');
        $this->email->message($body);
        
        //$this->email->send(FALSE);
        //return $this->email->print_debugger(array('headers'));
        return $this->email->send();
    }
}