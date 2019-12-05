<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Locais</h3>
                <div class="box-tools">
                    <a href="<?php echo site_url('local/add'); ?>" class="btn btn-success">Novo Local</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped" id="tabela-locais">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Endereco</th>
                        <th>Tipo de Local</th>
                        <th>Ativo?</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($locais as $local){ ?>
                    <tr>
                        <td><?php echo $local['nome']; ?></td>
                        <td><?php echo $local['endereco']; ?></td>
                        <td><?php echo $local['nome_tipo_local']; ?></td>
                        <td><?php echo $local['ativo'] == 1 ? "Sim" : "Não"; ?></td>
                        <td>
                            <a href="<?php echo site_url('local/edit/'.$local['id']); ?>"
                                class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Editar</a>
                            <!--<a href="<?php //echo site_url('responsavel/remove/'.$local['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>-->
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>