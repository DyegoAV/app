<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Alterar senha - <?php echo $usuario->email; ?></h3>
            </div>
            <div class="box-body">
                <?php echo form_open("perfil/alterarsenha");?>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <label for="old" class="control-label">Senha atual:</label>
                        <div class="form-group">
                            <input type="password" name="old" value="" class="form-control" id="old" />
                            <span class="text-danger"><?php echo form_error('old');?></span>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <label for="new" class="control-label">Nova senha:</label>
                        <div class="form-group">
                            <input type="password" name="new" value="" class="form-control" id="new"
                                pattern="^.{6}.*$" />
                            <span class="text-danger"><?php echo form_error('new');?></span>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <label for="new_confirm" class="control-label">Repetir nova senha:</label>
                        <div class="form-group">
                            <input type="password" name="new_confirm" value="" class="form-control" id="new_confirm"
                                pattern="^.{6}.*$" />
                            <span class="text-danger"><?php echo form_error('new_confirm');?></span>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <input type="hidden" name="user_id" value="<?php echo $usuario->id; ?>" class="form-control"
                            id="user_id" />

                        <input class="btn btn-primary" type="submit" name="submit" value="Alterar Senha" />
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>