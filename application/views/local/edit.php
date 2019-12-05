<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Local</h3>
            </div>
            <?php echo form_open('local/edit/'.$local['id'], array('id'=>'form-local')); ?>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-4">
                        <label for="nome" class="control-label"><span class="text-danger">*</span>Nome</label>
                        <div class="form-group">
                            <input type="text" name="nome"
                                value="<?php echo ($this->input->post('nome') ? $this->input->post('nome') : $local['nome']); ?>"
                                class="form-control segunda-validacao" id="nome" />
                            <span class="text-danger"><?php echo form_error('nome');?></span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="endereco" class="control-label"><span class="text-danger">*</span>Endereço</label>
                        <div class="form-group">
                            <input type="text" name="endereco"
                                value="<?php echo ($this->input->post('endereco') ? $this->input->post('endereco') : $local['endereco']); ?>"
                                class="form-control" id="endereco" />
                            <span class="text-danger"><?php echo form_error('endereco');?></span>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="url_google_maps" class="control-label">URL Google Maps</label>
                        <div class="form-group">
                            <input type="text" name="url_google_maps"
                                value="<?php echo ($this->input->post('url_google_maps') ? $this->input->post('url_google_maps') : $local['url_google_maps']); ?>"
                                class="form-control demais-campos" id="url_google_maps" />
                            <span class="text-danger"><?php echo form_error('url_google_maps');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo" class="control-label"><span class="text-danger">*</span>Tipo de Local</label>
                        <div class="form-group">
                            <select name="tipo" class="form-control">
                                <option value="">Selecione</option>
                                <?php

								    foreach($tipos as $tipo) {
                                        $selected = (($this->input->post('tipo') ? $this->input->post('tipo') : $local['local_tipo']) == $tipo['id'] ? " selected" : "");
										echo '<option value="'.$tipo['id'].'"'.$selected.'>'.$tipo['nome'].'</option>';
									} 
								?>
                            </select>
                            <span class="text-danger"><?php echo form_error('tipo');?></span>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="ativo" name="ativo"
                                <?php echo (($this->input->post('ativo') ? $this->input->post('ativo') : $local['ativo']) == 1 ? " checked" : ""); ?> />
                            <label class="form-check-label" for="ativo">Ativo?</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success" id="salvar-responsavel">
                    <i class="fa fa-check"></i> Salvar
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>