<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Novo Local</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('local/add', array('id'=>'form-local')); ?>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <label for="nome" class="control-label"><span class="text-danger">*</span>Nome</label>
                        <div class="form-group">
                            <input type="text" name="nome" value="<?php echo $this->input->post('nome'); ?>"
                                class="form-control segunda-validacao" id="nome" />
                            <span class="text-danger"><?php echo form_error('nome');?></span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="endereco" class="control-label"><span class="text-danger">*</span>Endereço</label>
                        <div class="form-group">
                            <input type="text" name="endereco" value="<?php echo $this->input->post('endereco'); ?>"
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
                                value="<?php echo $this->input->post('url_google_maps'); ?>"
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
										echo '<option value="'.$tipo['id'].'">'.$tipo['nome'].'</option>';
									} 
								?>
							</select>
                            <span class="text-danger"><?php echo form_error('tipo');?></span>
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