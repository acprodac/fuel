<div id="wrapperLogin">
    <div class="page-header">
        <h1><?php echo Asset::img('logo.png', array('alt' => 'PRODAC')); ?></h1>
    </div>
    <div id="boxLogin">
		<form id="formLogin" class="well well-large" action="<?php echo Uri::create('admin/login/'); ?>" method="POST">
            <h2>Login</h2>
            <div class="formInit">
                <label for="inputUsuario">E-mail:</label>
                <input type="text" name="email" id="inputUsuario" class="form email required" />
                <br clear="all" />
                <label for="inputSenha">Senha:</label>
                <input type="password" name="password" id="inputSenha" class="form required" />
                <br clear="all" />
                <div class="boxCheck">
					<input type="checkbox" name="remember" id="inputRemember" value="1" />
					<label for="inputRemember">Lembrar senha</label>
					<br clear="all" />
				</div>
                <div class="boxMsg">
                    <a href="#" class="btnEsqueciSenha"><i class="icon-info-sign"></i>Esqueci minha senha</a>
                    <p class="error feedback-hide">Preencha os campos em vermelho.</p>
                    <p class="errorServer errorServerLogin feedback-hide">Usuário ou senha inválidos.</p>
                    <div class="imgLoading"><?php echo Asset::img('loading-blue-disabled.gif'); ?></div>
                </div>
                <input type="submit" id="inputSubmit" class="btn btn-primary btn-large btnSubmit" value="Entrar" />
                <br clear="all" />
            </div>
            <div class="bgDisabled">&nbsp;</div>
            <div class="msgErrorLabel">&nbsp;</div>
			<?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token(), array('class' => 'inputToken')); ?>
        </form>
        <form id="formEsqueciSenha" class="well well-large" action="<?php echo Uri::create('admin/login/senha/'); ?>" method="POST">
            <h2>Esqueci minha senha</h2>
            <div class="formInit">
                <label for="inputUsuarioSenha">E-mail:</label>
                <input type="text" name="email" id="inputUsuarioSenha" class="form email required" />
                <br clear="all" />
                
                <div class="boxMsg">
                    <a href="#" class="btnVoltarLogin"><i class="icon-chevron-left"></i>Login</a>
                    <p class="error">Preencha os campos em vermelho.</p>
                    <p class="errorServer errorServerLogin feedback-hide">E-mail não encontrado.</p>
                    <div class="imgLoading"><?php echo Asset::img('loading-blue-disabled.gif'); ?></div>
                </div>
                <input type="submit" id="inputSubmitSenha" class="btn btn-primary btn-large btnSubmit" value="Recuperar senha" />
                <br clear="all" />
            </div>
            <div class="formSucesso">
                <p><span class="label label-success">Sucesso!</span> Em breve enviaremos um e-mail para <code>email@email.com</code> com as instruções para recuperar sua senha.</p>
                <a href="#" class="btnVoltarLogin"><i class="icon-chevron-left"></i>Voltar para o Login</a>
            </div>
            <div class="bgDisabled">&nbsp;</div>
            <div class="msgErrorLabel">&nbsp;</div>
			<?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token(), array('class' => 'inputToken')); ?>
        </form>
    </div>
    <?php echo $footer; ?>
</div>