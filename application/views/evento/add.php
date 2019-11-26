<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Novo Evento</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('evento/add', array('id'=>'form-evento')); ?>
                <div class="row clearfix">
                    <div class="col-md-3">
                        <label for="data_inicio" class="control-label"><span class="text-danger">*</span>Data de Início</label>
                        <div class="form-group">
                            <input type="text" name="data_inicio" value="<?php echo $this->input->post('data_inicio'); ?>"
                                class="form-control segunda-validacao" id="data_inicio" />
                            <span class="text-danger"><?php echo form_error('data_inicio');?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="data_fim" class="control-label"><span class="text-danger">*</span>Data Fim</label>
                        <div class="form-group">
                            <input type="text" name="data_fim" value="<?php echo $this->input->post('data_fim'); ?>"
                                class="form-control" id="data_fim" />
                            <span class="text-danger"><?php echo form_error('data_fim');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="local" class="control-label"><span class="text-danger">*</span>Local do Evento</label>
                        <div class="form-group">
                            <select id="local" name="local" class="form-control">
								<option value="">Selecione</option>
								<?php 
								    foreach($locais as $local) {
										echo '<option value="'.$local['id'].'" data-tipo="'.$local['id_tipo_local'].'">'.$local['nome'].' ('.$local['nome_tipo_local'].')</option>';
									}
								?>
							</select>
                            <span class="text-danger"><?php echo form_error('local');?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="checkbox" value="1" name="pontoColeta" id="pontoColeta" />
                            <label class="distancia">Apenas Ponto de Coleta</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="checkbox" value="1" name="entregaPresentes" id="entregaPresentes" />
                            <label class="distancia">Possui Entrega de Presentes?</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="checkbox" value="1" name="palestraResponsaveis" id="palestraResponsaveis" />
                            <label class="distancia">Possui Palestras para os Responsáveis?</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"><br />
                            <input type="checkbox" value="1" name="palestraResponsaveis" id="palestraResponsaveis" />
                            <label class="distancia">As salas para entrega dos presentes são limitadas?</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="data_inicio" class="control-label">Quantidade de Salas</label>
                        <div class="form-group">
                            <input type="text" name="data_inicio" value="<?php echo $this->input->post('data_inicio'); ?>"
                                class="form-control segunda-validacao" id="data_inicio" />
                            <span class="text-danger"><?php echo form_error('data_inicio');?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="data_inicio" class="control-label">Quantidade de Crianças por Sala</label>
                        <div class="form-group">
                            <input type="text" name="data_inicio" value="<?php echo $this->input->post('data_inicio'); ?>"
                                class="form-control segunda-validacao" id="data_inicio" />
                            <span class="text-danger"><?php echo form_error('data_inicio');?></span>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success" id="salvar-responsavel">
                    <i class="fa fa-check"></i> Salvar
                </button>
            </div>
        </div>
    </div>
</div>