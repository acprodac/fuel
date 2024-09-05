<form id="formSave" class="well well-large form-page form-page-margin" action="<?php echo Uri::current(); ?>" method="POST" accept-charset="utf-8" data-redirect="<?php echo Uri::create('admin/emandamento'); ?>">
    <div class="formInit">

        <?php if(!empty($vitrines)) : ?>
            <div class="boxSelect">
                <label for="id_vitrine">Vitrine:</label>                        
                <select name="id_vitrine" id="id_vitrine" class="required select input-xlarge" style="float: left;">
                    <option value="0">Nenhuma</option>
                    <?php foreach($vitrines as $key=>$vitrine) : ?>
                        <option value="<?php echo $vitrine->id; ?>" <?php echo (isset($item->vitrine->id) && $item->vitrine->id == $key) || isset($formCreate) && $vitrineDefault == $key ? ' selected="selected"' : ''; ?>><?php echo $vitrine->titulo; ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="clear"></span>
            </div>
        <?php endif; ?>

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" class="form required input-xxlarge" value="<?php echo empty($formCreate) ? $item->titulo : ''; ?>" />

        <select id="baseArea" class="hide">
            <option rel="emandamento" value="emandamento" selected="selected">emandamento</option>
        </select>
    
        <label for="data_publicado">Data da obra:</label>
        <input type="text" name="data_publicado" id="data_publicado" class="form required input-xxlarge" value="<?php echo empty($formCreate) ? $item->data_publicado : ''; ?>" />

        <?php $count = 0; if(!isset($formCreate) && !empty($item->imagem)) : ?>
                
            <div class="uploadFile" rel="item-<?php echo $count; ?>">
                <label for="" class="itemUploadDoc">Imagem: <span>(tamanho mínimo: 487x189px)</span></label>
                
                <div class="boxBtnUpload<?php echo isset($item->imagem) && !empty($item->imagem) ? ' hide' : ''; ?>">
                    <button class="btnUploadFile btn btn-success"><i class="icon-plus icon-white"></i>Selecionar imagem</button>
                    <input type="file" id="materiaDocFile-<?php echo $count; ?>" name="materiaDocFile" class="uploadFile" accept=".jpg,.jpeg,.gif,.png,.tiff" rel="img" data-width="487" data-height="189" />
                    <span class="infoLoading">Fazendo upload da imagem. Aguarde...</span>
                    <span class="infoLoadingError feedback-hide">Ocorreu um erro durante o upload. Tente novamente.</span>
                    <span class="infoDeleteSuccess feedback-hide itemUploadDoc">A imagem foi excluída.</span>
                    <div class="boxLoadingFile"><?php echo Asset::img('loading-green-disabled.gif'); ?></div>
                    <input type="hidden" name="imagem" class="fileUploaded" value="<?php echo isset($item->imagem) ? $item->imagem : ''; ?>" />
                </div>
                
                <div class="boxInfosImg<?php echo isset($item->imagem) && !empty($item->imagem) ? ' show' : ''; ?>">
                    <div class="imgInfos">
                        
                        <div class="img img-polaroid" style="float: none;">
                            <?php if(isset($item->imagem) && !empty($item->imagem)) : ?>
                                <img src="<?php echo $baseUrl . 'upload/img/160x90_' . $item->imagem . '?_' . time(); ?>" alt="" />
                            <?php else : ?>
                                <?php echo Asset::img('interrogacao.jpg'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="imgInfos">
                            <p><strong>Tamanho:</strong> <span class="tamanho"><?php echo $item->imagem_tamanho; ?></span></p>
                            <p><strong>Formato:</strong> <span class="formato"><?php echo $item->imagem_formato; ?></span></p>
                            <p><strong>Peso:</strong> <span class="peso"><?php echo $item->imagem_peso; ?></span></p>
                        
                            <input type="hidden" name="imagem_tamanho" class="input-tamanho" value="<?php echo $item->imagem_tamanho; ?>">
                            <input type="hidden" name="imagem_formato" class="input-formato" value="<?php echo $item->imagem_formato; ?>">
                            <input type="hidden" name="imagem_peso" class="input-peso" value="<?php echo $item->imagem_peso; ?>">
                        </div>
                        
                       
                        <div class="boxBtnDelete">
                            <button class="btnDeleteFile btn btn-danger" rel="<?php echo isset($item->imagem) ? $item->imagem . '|img' : ''; ?>"><i class="icon-trash icon-white"></i>Excluir imagem</button>
                            <div class="boxLoadingDeleteFile"><?php echo Asset::img('loading-red-disabled.gif'); ?></div>
                            <span class="infoDeleteError feedback-hide">Ocorreu um erro. Tente novamente.</span>
                        </div>

                        <span class="clear"></span>                                
                    </div>
                </div>
            </div>

        <?php else : ?>

            <div class="uploadFile" rel="item-<?php echo $count; ?>">
                <label for="" class="itemUploadDoc">Imagem: <span>(tamanho mínimo: 487x189px)</span></label>
                
                <div class="boxBtnUpload">
                    <button class="btnUploadFile btn btn-success"><i class="icon-plus icon-white"></i>Selecionar imagem</button>
                    <input type="file" id="materiaDocFile-<?php echo $count; ?>" name="materiaDocFile" class="uploadFile" accept=".jpg,.jpeg,.gif,.png,.tiff" rel="img" data-width="487" data-height="189" />
                    <span class="infoLoading">Fazendo upload da imagem. Aguarde...</span>
                    <span class="infoLoadingError feedback-hide">Ocorreu um erro durante o upload. Tente novamente.</span>
                    <span class="infoDeleteSuccess feedback-hide itemUploadDoc">A imagem foi excluída.</span>
                    <div class="boxLoadingFile"><?php echo Asset::img('loading-green-disabled.gif'); ?></div>
                    <input type="hidden" name="imagem" class="fileUploaded" value="" />
                </div>
                
                <div class="boxInfosImg">
                    
                    <div class="img img-polaroid" style="float: none;">
                            
                    </div>
                    <div class="imgInfos">

                        <p><strong>Tamanho:</strong> <span class="tamanho"></span></p>
                        <p><strong>Formato:</strong> <span class="formato"></span></p>
                        <p><strong>Peso:</strong> <span class="peso"></span></p>

                        <input type="hidden" name="imagem_tamanho" class="input-tamanho" value="">
                        <input type="hidden" name="imagem_formato" class="input-formato" value="">
                        <input type="hidden" name="imagem_peso" class="input-peso" value="">

                    </div>
                   
                
                    <div class="boxBtnDelete">
                        <button class="btnDeleteFile btn btn-danger itemUploadDoc"><i class="icon-trash icon-white"></i>Excluir imagem</button>
                        <div class="boxLoadingDeleteFile"><?php echo Asset::img('loading-red2-disabled.gif'); ?></div>
                        <span class="infoDeleteError feedback-hide">Ocorreu um erro. Tente novamente.</span>
                    </div>

                    <span class="clear"></span>
                </div>
            </div>

        <?php endif; ?>

        <span class="clear"></span>

        <label for="texto">Texto:</label>
        <div class="boxTinyMce">
            <textarea name="texto" id="texto" class="form form-text input-xxlarge required tinyMce tinyMce-med" data-height="300px"><?php echo !isset($formCreate) ? $item->texto : ''; ?></textarea>
        </div>

        <label for="exibir_home1" class="lblCheck">Exibir na home do site?:</label>
        <div class="checkbox">
            <input type="radio" name="exibir_home" id="exibir_home1" value="1" <?php echo !empty($formCreate) || (empty($formCreate) && !empty($item->exibir_home)) ? ' checked="checked"' : ''; ?> />
            <label for="exibir_home1">Sim</label>
            <input type="radio" name="exibir_home" id="exibir_home2" value="0" <?php echo (empty($formCreate) && empty($item->exibir_home)) ? ' checked="checked"' : ''; ?> />
            <label for="exibir_home2">Não</label>
        </div>

        <span class="clear"></span>
        
        <input type="submit" id="inputSubmitForm" class="btn btn-primary btn-large btnSubmit" value="<?php echo !empty($item) ? 'Salvar' : 'Cadastrar'; ?>" />
        
        <div class="boxMsg boxMsgForm">
            <p class="error">Preencha corretamente os campos em vermelho.</p>
            <p class="boxErrorServer errorServerLogin">Ocorreu um erro. Tente novamente.</p>
            <div class="boxLoading boxLoadingBlue <?php echo !empty($item) ? 'boxLoadingEdit' : ''; ?>"><?php echo Asset::img('loading-blue-disabled.gif'); ?></div>
        </div>
        
        <span class="clear"></span>
    </div>
    <div class="bgDisabled">&nbsp;</div>
    <div class="msgErrorLabel">&nbsp;</div>
    
    <?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token(), array('class' => 'inputToken')); ?>
</form>