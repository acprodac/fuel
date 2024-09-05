	<h3><a class="btnCadastrarNovo btn btn-success btnLink" href="<?php echo Uri::create('admin/segmentos/cadastrar'); ?>">Cadastrar nova segmentos</a>

        <?php if(!empty($itens) && count($itens) >= 2) : ?>
            <a href="<?php echo Uri::create('admin/segmentos/ordenar'); ?>" class="btn btn-primary btnOrdenar btnLink">Ordenar</a>
        <?php endif; ?>

        segmentos
        
    </h3>
    <?php echo $boxFeedback; ?>
    
    <div id="containner">
        <form id="formSave" class="well well-large form-page form-page-margin form-create" action="<?php echo Uri::current(); ?>" method="POST" accept-charset="utf-8">
            <div class="formInit">
                
                <label for="descricao">Descrição:</label>
                <div class="boxTinyMce">
                    <textarea name="descricao" id="descricao" class="form form-text input-xxlarge required tinyMce tinyMce-min" data-height="150px"><?php echo stripslashes($page->descricao); ?></textarea>
                </div>
                
                <input type="submit" id="inputSubmitForm" class="btn btn-primary btn-large btnSubmit" value="Salvar" />
                <div class="boxMsg boxMsgForm">
                    <p class="error">Preencha corretamente os campos em vermelho.</p>
                    <p class="boxErrorServer errorServerLogin">Ocorreu um erro. Tente novamente.</p>
                    <div class="boxLoading boxLoadingBlue"><?php echo Asset::img('loading-blue-disabled.gif'); ?></div>
                </div>
                
                <span class="clear"></span>
            </div>
            <div class="bgDisabled">&nbsp;</div>
            <div class="msgErrorLabel">&nbsp;</div>
            
            <?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token(), array('class' => 'inputToken')); ?>
        </form>

        <hr>

        <form id="formBuscaEmpresas" class="well well-large form-page<?php echo !empty($termoBusca) ? ' result' : ''; ?>" action="<?php echo Uri::current(); ?>" method="GET" accept-charset="utf-8">

            <label for="empresa">Procurar segmentos:</label>
            <input type="text" name="s" id="empresa" class="form required input-xxlarge" placeholder="Título" value="<?php echo !empty($termoBusca) ? $termoBusca : ''; ?>" />

            <input type="submit" id="inputSubmitForm" class="btn btn-primary btn-medium btnSubmit" value="Procurar" />

            <?php if(!empty($termoBusca)) : ?>
                <a class="btn btn-link" href="<?php echo Uri::create('admin/segmentos'); ?>"><i class="icon-chevron-left"></i>Voltar</a>
            <?php endif; ?>

        </form>
        
        <?php if(empty($itens)) : ?>

            <h4>Nenhum segmentos <?php echo !empty($termoBusca) ? 'encontrado' : 'cadastrado'; ?>.</h4>

        <?php else : ?>

            <?php if(!empty($termoBusca) && !empty($totalBusca)) : ?>

                <p style="font-weight: bold; padding-bottom: 10px;"><?php echo $totalBusca; ?> resultado<?php echo $totalBusca > 1 ? 's' : ''; ?> encontrado<?php echo $totalBusca > 1 ? 's' : ''; ?>.</p>

            <?php endif; ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="first">Título</th>
                        <th class="">Data de cadastro</th>
                        <th class="">Exibir na home?</th>
                        <th class="status">Status</th>
                        <th class="min center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($itens as $item) : ?>
                        <tr>
                            <td class="name"><?php echo $item->titulo; ?></td>
                            <td class="center"><?php echo date('d/m/Y \à\s H:i', $item->created_at); ?></td>
                            <td class="center"><?php echo $item->exibir_home == 1 ? 'sim' : 'não'; ?></td>
                            <td class="center">
                                <a class="btn btn-<?php echo !empty($item->status) ? 'primary' : 'danger'; ?> btnStatus" href="<?php echo Uri::create('admin/segmentos/status/' . $item->id . '/' . (int) empty($item->status)); ?>" title="Clique para <?php echo !empty($item->status) ? 'desativar' : 'ativar'; ?>"><i class="glyphicon glyphicon-eye-<?php echo !empty($item->status) ? 'open' : 'close'; ?>"></i><?php echo !empty($item->status) ? 'ativo' : 'inativo'; ?></a>
                            <td class="center">
                                <div class="btn-group btnList">
                                    <a href="<?php echo Uri::create('admin/segmentos/editar/' . $item->id . '/'); ?>" class="btn btn-primary btnEditar btnLink"><i class="icon-edit icon-white"></i>Editar</a>

                                    
                                        <a href="<?php echo Uri::create('admin/segmentos/excluir/' . $item->id . '/'); ?>" class="btn btn-danger btnExcluir" rel="usuário"><i class="icon-remove icon-white"></i>Excluir</a>
                                    
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