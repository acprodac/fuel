	<h3>Usuários <span>&gt; Alterar senha</span></h3>
    <?php echo $boxFeedback; ?>
    
    <div id="containner">
    	<form id="formAlterarSenha" class="well well-large form-page" action="<?php echo Uri::create('admin/alterar-senha'); ?>" method="POST">
            <div class="formInit">
                <?php if($resetPasswd === false): ?>
                    <label for="userSenha">Senha:</label>
                    <input type="password" name="senha" id="userSenha" class="form required input-xlarge" style="float: none;" tabindex="1" />
                <?php endif; ?>
                
                <div class="boxInputSenha" style="float: none; margin-top: 18px;">
                    <label for="userSenhaNova">Nova senha:</label>
                    <input type="password" name="senhaNova" id="userSenhaNova" class="form required input-xlarge" tabindex="2" />
                    <span class="clear"></span>
                    
                    <label for="userSenhaNovaConfirmar">Confirmar nova senha:</label>
                    <input type="password" name="senhaNovaConfirmar" id="userSenhaNovaConfirmar" class="form required input-xlarge" equalTo="#userSenhaNova" tabindex="3" />
                </div>
                
                <input type="submit" id="inputSubmitForm" class="btn btn-primary btn-large btnSubmit" value="Alterar Senha" tabindex="4" />
                <div class="boxMsg boxMsgForm">
                    <p class="error">Preencha corretamente os campos em vermelho.</p>
                    <p class="boxErrorServer errorServerLogin">Ocorreu um erro. Tente novamente.</p>
                    <div class="boxLoading boxLoadingBlue"><?php echo Asset::img('loading-blue-disabled.gif'); ?></div>
                </div>
                
                <br clear="all" />
            </div>
            <div class="bgDisabled">&nbsp;</div>
            <div class="msgErrorLabel">&nbsp;</div>
            <?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token(), array('class' => 'inputToken')); ?>
        </form>
    </div>