    <h3>Contato</h3>
    <?php echo $boxFeedback; ?>
    
    <div id="containner">
        
        <form id="formSave" class="well well-large form-page form-page-margin form-create" action="<?php echo Uri::current(); ?>" method="POST" accept-charset="utf-8">

            
            <div class="formInit">

                <label for="descricao">Texto Direitos:</label>
                <div class="boxTinyMce">
                    <textarea name="fields[descricao]" id="fields[descricao]" class="form form-text input-xxlarge required tinyMce tinyMce-min" data-height="150px"><?php echo stripslashes($item->descricao); ?></textarea>

                </div>

                <label for="fields[onde_estamos]">Onde estamos:</label>
                <div class="boxTinyMce">
                    <textarea name="fields[onde_estamos]" id="fields[onde_estamos]" class="form form-text input-xxlarge required tinyMce tinyMce-min" data-height="150px"><?php echo stripslashes($item->fields['onde_estamos']); ?></textarea>
                </div>

                <label for="fields[mapa]">Link do mapa: <span>(CERTIFIQUE-SE QUE O LINK SEGUE O PADRÃO DO QUE ESTÁ HOJE)</span></label>
                <input type="text" name="fields[mapa]" id="fields[mapa]" class="form required input-xxlarge" value="<?php echo $item->fields['mapa']; ?>" />


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