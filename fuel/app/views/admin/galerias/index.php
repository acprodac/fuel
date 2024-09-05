	<h3><a class="btnCadastrarNovo btn btn-success btnLink" href="<?php echo Uri::create('admin/galeria/cadastrar'); ?>">Cadastrar nova galeria</a>

        Galerias
        
    </h3>
    <?php echo $boxFeedback; ?>
    
    <div id="containner">

        <form id="formBuscaEmpresas" class="well well-large form-page<?php echo !empty($termoBusca) ? ' result' : ''; ?>" action="<?php echo Uri::current(); ?>" method="GET" accept-charset="utf-8">

            <label for="empresa">Procurar galeria:</label>
            <input type="text" name="s" id="empresa" class="form required input-xxlarge" placeholder="Título" value="<?php echo !empty($termoBusca) ? $termoBusca : ''; ?>" />

            <input type="submit" id="inputSubmitForm" class="btn btn-primary btn-medium btnSubmit" value="Procurar" />

            <?php if(!empty($termoBusca)) : ?>
                <a class="btn btn-link" href="<?php echo Uri::create('admin/galerias'); ?>"><i class="icon-chevron-left"></i>Voltar</a>
            <?php endif; ?>

        </form>
        
        <?php if(empty($itens)) : ?>

            <h4>Nenhuma galeria <?php echo !empty($termoBusca) ? 'encontrada' : 'cadastrada'; ?>.</h4>

        <?php else : ?>

            <?php if(!empty($termoBusca) && !empty($totalBusca)) : ?>

                <p style="font-weight: bold; padding-bottom: 10px;"><?php echo $totalBusca; ?> resultado<?php echo $totalBusca > 1 ? 's' : ''; ?> encontrado<?php echo $totalBusca > 1 ? 's' : ''; ?>.</p>

            <?php endif; ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="first">Título</th>
                        <th class="">Data de cadastro</th>
                        <th class="status">Status</th>
                        <th class="min center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($itens as $item) : ?>
                        <tr>
                            <td class="name"><?php echo $item->titulo; ?></td>
                            <td class="center"><?php echo date('d/m/Y \à\s H:i', $item->created_at); ?></td>
                            <td class="center">
                                <a class="btn btn-<?php echo !empty($item->status) ? 'primary' : 'danger'; ?> btnStatus" href="<?php echo Uri::create('admin/galeria/status/' . $item->id . '/' . (int) empty($item->status)); ?>" title="Clique para <?php echo !empty($item->status) ? 'desativar' : 'ativar'; ?>"><i class="glyphicon glyphicon-eye-<?php echo !empty($item->status) ? 'open' : 'close'; ?>"></i><?php echo !empty($item->status) ? 'ativo' : 'inativo'; ?></a>
                            <td class="center">
                                <div class="btn-group btnList">
                                    <a href="<?php echo Uri::create('admin/galeria/editar/' . $item->id . '/'); ?>" class="btn btn-primary btnEditar btnLink"><i class="icon-edit icon-white"></i>Editar</a>

                                    
                                        <a href="<?php echo Uri::create('admin/galeria/excluir/' . $item->id . '/'); ?>" class="btn btn-danger btnExcluir" rel="usuário"><i class="icon-remove icon-white"></i>Excluir</a>
                                    
                                </div>
                                <div class="bgDisabled"></div>
                                <div class="boxLoading">
                                    <?php echo Asset::img('loading-red-disabled.gif'); ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php echo htmlspecialchars_decode($pagination); ?>

        <?php endif; ?>
    </div>