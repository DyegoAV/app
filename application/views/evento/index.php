<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Eventos</h3>
                <div class="box-tools">
                    <a href="<?php echo site_url('evento/add'); ?>" class="btn btn-success">Novo Evento</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped" id="tabela-locais">
                <thead>
                    <tr>
                        <th>Local</th>
                        <th>Tipo de Evento</th>
                        <th>Data Início</th>
                        <th>Data Término</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($eventos as $evento) { ?>
                    <tr>
                        <td><?php echo $evento['nomeLocalEntrega']; ?></td>
                        <td><?php echo $evento['tipoLocal']; ?></td>
                        <td><span class="hidden"><?php echo date("Ymd", strtotime($evento['inicio'])); ?></span><?php echo date("d/m/Y", strtotime($evento['inicio'])); ?></td>
                        <td><span class="hidden"><?php echo date("Ymd", strtotime($evento['termino'])); ?></span><?php echo date("d/m/Y", strtotime($evento['termino'])); ?></td>
                        <td>
                            <a href="<?php echo site_url('evento/edit/'.$evento['id']); ?>"
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