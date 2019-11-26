<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Eventos</h3>
                <div class="box-tools">
                    <a href="<?php echo site_url('local/add'); ?>" class="btn btn-success btn-sm">Novo</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped" id="tabela-locais">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Endereco</th>
                        <th>Tipo de Local</th>
                        <th>Ativo?</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($eventos as $evento) { ?>
                    <tr>
                        <td><?php echo $evento['id']; ?></td>
                        <td><span class="hidden"><?php echo date("Ymd", strtotime($evento['inicio'])); ?></span><?php echo date("d/m/Y", strtotime($evento['inicio'])); ?></td>
                        <td><span class="hidden"><?php echo date("Ymd", strtotime($evento['termino'])); ?></span><?php echo date("d/m/Y", strtotime($evento['termino'])); ?></td>
                        <td><?php echo $evento['nome_tipo_local']; ?></td>
                        <td><?php echo $evento['ativo'] == 1 ? "Sim" : "Não"; ?></td>
                        <td>
                            <a href="<?php echo site_url('local/edit/'.$evento['id']); ?>"
                                class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Editar</a>
                            <!--<a href="<?php //echo site_url('responsavel/remove/'.$evento['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>-->
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>