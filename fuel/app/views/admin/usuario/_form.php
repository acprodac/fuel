            <form id="formSave" class="formUsuario well well-large form-page<?php echo $formCreate ? ' form-create' : ''; ?>" action="<?php echo Uri::current(); ?>" method="POST" accept-charset="utf-8" data-redirect="<?php echo Uri::create('admin/usuarios'); ?>">
                <div class="formInit">
                    <label for="userNome">Nome:</label>
                    <input type="text" name="nome" id="userNome" class="form required input-xxlarge" tabindex="1" value="<?php echo !empty($item) ? $item->name : ''; ?>" />
                    
                    <label for="userEmail">E-mail:</label>
                    <input type="text" name="email" id="userEmail" class="form email required input-xxlarge" tabindex="2" value="<?php echo !empty($item) ? $item->email : ''; ?>" <?php echo !empty($item) ? 'readonly="readonly"' : ''; ?> />
                    <div class="infos infosEmail">
                        <p class="feedback-hide">O e-mail "<em></em>" já está cadastrado.</p>
                        <div class="boxLoadingInfo boxLoadingBlue"><?php echo Asset::img('loading-white2.gif'); ?></div>
                    </div>
                    <span class="clear"></span>
                    
                    <div class="boxInputSenha">
                        <label for="userSenha" style="float: left;">Senha: <?php echo $formCreate ? '<a href="#" class="btn btn-info btn-small btnGerarSenha" title="Clique para criar uma senha aleatória para esse usuário.">Gerar senha</a>' : ''; ?>
                        </label>
                        <div class="boxInfo boxInfoGerarSenha hide">
                            <span class="info">Senha gerada. O usuário receberá a senha por e-mail após o cadastro.</span>
                        </div>
                        <br clear="all" />
                        
                        <input type="password" name="senha" id="userSenha" class="form input-xlarge<?php echo $formCreate ? ' required' : ''; ?>" style="float: left;" minLength="4" tabindex="3" />
                        <br clear="all" />
                        
                        <label for="userSenhaConfirmar">Confirmar senha:</label>
                        <input type="password" name="senhaConfirmar" id="userSenhaConfirmar" class="form input-xlarge<?php echo $formCreate ? ' required' : ''; ?>" minLength="4" equalTo="#userSenha" tabindex="4" />
                    </div>
                    
                    <span class="clear"></span>
                    
                    <input type="submit" id="inputSubmitForm" class="btn btn-primary btn-large btnSubmit" value="<?php echo $formCreate ? 'Cadastrar' : 'Salvar'; ?>" tabindex="5" />
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