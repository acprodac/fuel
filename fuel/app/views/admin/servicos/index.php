    <h3>Serviços</h3>
    <?php echo $boxFeedback; ?>

    <div id="containner">
        
        <form id="formSave" class="well well-large form-page form-page-margin form-create" action="<?php echo Uri::current(); ?>" method="POST" accept-charset="utf-8">
            <div class="formInit">

                <label for="subtitulo">Título:</label>
                <input type="text" name="fields[0][titulo]" id="subtitulo1" class="form input-xxlarge" value="<?php if(isset($item->fields[0]['titulo'])) echo $item->fields[0]['titulo']; ?>" />

                <label for="descricao">Descrição:</label>
                <div class="boxTinyMce">
                    <textarea name="fields[0][descricao]" id="descricao1" class="form form-text input-xxlarge required tinyMce tinyMce-med" data-height="200px"><?php if(isset($item->fields[0]['descricao'])) echo stripslashes($item->fields[0]['descricao']); ?></textarea>
                </div>

                <span class="clear"></span>

                <label for="subtitulo">Título:</label>
                <input type="text" name="fields[1][titulo]" id="subtitulo2" class="form input-xxlarge" value="<?php if(isset($item->fields[1]['titulo'])) echo $item->fields[1]['titulo']; ?>" />

                <label for="descricao">Descrição:</label>
                <div class="boxTinyMce">
                    <textarea name="fields[1][descricao]" id="descricao2" class="form form-text input-xxlarge required tinyMce tinyMce-med" data-height="200px"><?php if(isset($item->fields[1]['descricao'])) echo stripslashes($item->fields[1]['descricao']); ?></textarea>
                </div>

                <span class="clear"></span>
                
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
    </div>