<form id="formSave" class="well well-large form-page form-page-margin form-lightbox" action="<?php echo Uri::current(); ?>" method="POST" accept-charset="utf-8" data-redirect="<?php echo Uri::create('admin/galerias'); ?>">
    <div class="formInit">

        <label for="titulo">Nome da galeria:</label>
        <input type="text" name="titulo" id="titulo" class="form required input-xxlarge" value="<?php echo !empty($item) ? $item->titulo : $itemTitulo; ?>" <?php echo !empty($item) && $item->id <= 2 ? 'readonly="readonly"' : ''; ?> />

        <br><br>
        <label for="">Imagens: <span>(tamanho ideal: 998x367px)</span></label>

        <?php $count = 0; ?>
        <div class="tplGray">
            <div class="boxTarget boxTarget-250 boxTarget-250-gal sortable">

                <?php if(!empty($item->imagens) && is_array($item->imagens)) : foreach($item->imagens as $doc) : if(empty($doc->imagem)) continue;
                    if(!file_exists(DOCROOT . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $doc->imagem)){
                        continue;
                    }
                 ?>
                
                    <div class="uploadFile uploadFile-sort uploadFile-mult boxItem-sort" rel="item-<?php echo $count; ?>">
                        <label for="materiaDocFile-<?php echo $count; ?>" class="itemUploadDoc">Imagem:</label>
                        
                        <div class="boxBtnUpload<?php echo isset($doc->imagem) && !empty($doc->imagem) ? ' hide' : ''; ?>">
                            <button class="btnUploadFile btn btn-success"><i class="icon-plus icon-white"></i>Selecionar imagem</button>
                            <input type="file" id="materiaDocFile-<?php echo $count; ?>" name="materiaDocFile" class="uploadFile" accept=".jpg,.jpeg,.gif,.png,.tiff" rel="img" data-width="1" data-height="1" />
                            <span class="infoLoading">Fazendo upload da imagem. Aguarde...</span>
                            <span class="infoLoadingError feedback-hide">Ocorreu um erro durante o upload. Tente novamente.</span>
                            <span class="infoDeleteSuccess feedback-hide itemUploadDoc">A imagem foi excluída.</span>
                            <div class="boxLoadingFile"><?php echo Asset::img('loading-green-disabled.gif'); ?></div>
                            <input type="hidden" name="imagem[<?php echo $count; ?>][imagem]" class="fileUploaded" value="<?php echo isset($doc->imagem) ? $doc->imagem : ''; ?>" />
                        </div>
                        
                        <div class="boxInfosImg<?php echo isset($doc->imagem) && !empty($doc->imagem) ? ' show' : ''; ?>">
                            <div class="imgInfos">
                                <div class="imgLeft">
                                    <div class="img img-polaroid" style="float: none;">
                                        <?php if(isset($doc->imagem) && !empty($doc->imagem)) : ?>
                                            <img src="<?php echo $baseUrl . 'upload/img/160x90_' . $doc->imagem . '?_' . time(); ?>" alt="<?php echo $doc->titulo; ?>" />
                                        <?php else : ?>
                                            <?php echo Asset::img('interrogacao.jpg'); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="imgInfos">
                                        <p><strong>Tamanho:</strong> <span class="tamanho"><?php echo $doc->imagem_tamanho; ?></span></p>
                                        <p><strong>Formato:</strong> <span class="formato"><?php echo $doc->imagem_formato; ?></span></p>
                                        <p><strong>Peso:</strong> <span class="peso"><?php echo $doc->imagem_peso; ?></span></p>
                                    
                                        <input type="hidden" name="imagem[<?php echo $count; ?>][imagem_tamanho]" class="input-tamanho" value="<?php echo $doc->imagem_tamanho; ?>">
                                        <input type="hidden" name="imagem[<?php echo $count; ?>][imagem_formato]" class="input-formato" value="<?php echo $doc->imagem_formato; ?>">
                                        <input type="hidden" name="imagem[<?php echo $count; ?>][imagem_peso]" class="input-peso" value="<?php echo $doc->imagem_peso; ?>">
                                    </div>
                                </div>
                                <div class="imgOpts">
                                    <input type="text" name="imagem[<?php echo $count; ?>][titulo]" id="vitrineTitulo-<?php echo $count; ?>" class="form required-link input-xlarge" value="<?php if(isset($doc->titulo)) echo $doc->titulo; ?>" placeholder="Título" /><br><br>
                                    <input type="text" name="imagem[<?php echo $count; ?>][texto]" id="vitrineTitulo-<?php echo $count; ?>" class="form required-link input-xlarge" value="<?php if(isset($doc->texto)) echo $doc->texto; ?>" placeholder="texto" /><br>
                                </div>

                                <div class="boxBtnDelete">
                                    <button class="btnDeleteFile btn btn-danger" rel="<?php echo isset($doc->imagem) ? $doc->imagem . '|img' : ''; ?>"><i class="icon-trash icon-white"></i>Excluir imagem</button>
                                    <div class="boxLoadingDeleteFile"><?php echo Asset::img('loading-red-disabled.gif'); ?></div>
                                    <span class="infoDeleteError feedback-hide">Ocorreu um erro. Tente novamente.</span>
                                </div>

                                <span class="clear"></span>                                
                            </div>
                        </div>
                    </div>

                <?php $count++; endforeach; endif; ?>

                    <div class="uploadFile uploadFile-sort uploadFile-mult boxItem-sort" rel="item-<?php echo $count; ?>">
                        <label for="materiaDocFile-<?php echo $count; ?>" class="itemUploadDoc">Imagem:</label>
                        
                        <div class="boxBtnUpload">
                            <button class="btnUploadFile btn btn-success"><i class="icon-plus icon-white"></i>Selecionar imagem</button>
                            <input type="file" id="materiaDocFile-<?php echo $count; ?>" name="materiaDocFile" class="uploadFile" accept=".jpg,.jpeg,.gif,.png,.tiff" rel="img" data-width="1" data-height="1" />
                            <span class="infoLoading">Fazendo upload da imagem. Aguarde...</span>
                            <span class="infoLoadingError feedback-hide">Ocorreu um erro durante o upload. Tente novamente.</span>
                            <span class="infoDeleteSuccess feedback-hide itemUploadDoc">A imagem foi excluída.</span>
                            <div class="boxLoadingFile"><?php echo Asset::img('loading-green-disabled.gif'); ?></div>
                            <input type="hidden" name="imagem[<?php echo $count; ?>][imagem]" class="fileUploaded" value="" />
                        </div>
                        
                        <div class="boxInfosImg">
                        <div class="boxInfosImg">
                            <div class="imgLeft">
                                <div class="img img-polaroid" style="float: none;">
                                        
                                </div>
                                <div class="imgInfos">

                                    <p><strong>Tamanho:</strong> <span class="tamanho"></span></p>
                                    <p><strong>Formato:</strong> <span class="formato"></span></p>
                                    <p><strong>Peso:</strong> <span class="peso"></span></p>

                                    <input type="hidden" name="imagem[<?php echo $count; ?>][imagem_tamanho]" class="input-tamanho" value="">
                                    <input type="hidden" name="imagem[<?php echo $count; ?>][imagem_formato]" class="input-formato" value="">
                                    <input type="hidden" name="imagem[<?php echo $count; ?>][imagem_peso]" class="input-peso" value="">

                                </div>
                            </div>
                            <div class="imgOpts">
                                <input type="text" name="imagem[<?php echo $count; ?>][titulo]" id="vitrineTitulo-<?php echo $count; ?>" class="form required-link input-xlarge" value="<?php if(isset($doc->titulo)) echo $doc->titulo; ?>" placeholder="Título" /><br><br>
                                    <input type="text" name="imagem[<?php echo $count; ?>][texto]" id="vitrineTitulo-<?php echo $count; ?>" class="form required-link input-xlarge" value="<?php if(isset($doc->texto)) echo $doc->texto; ?>" placeholder="texto" /><br>
                                
                            </div>

                            <div class="boxBtnDelete">
                                <button class="btnDeleteFile btn btn-danger itemUploadDoc"><i class="icon-trash icon-white"></i>Excluir imagem</button>
                                <div class="boxLoadingDeleteFile"><?php echo Asset::img('loading-red2-disabled.gif'); ?></div>
                                <span class="infoDeleteError feedback-hide">Ocorreu um erro. Tente novamente.</span>
                            </div>

                            <span class="clear"></span>
                        </div>
                    </div>
                    <span class="clear"></span>
            </div>
            <span class="clear"></span>
        </div>

        <span class="clear"></span>
        
        <input type="submit" id="inputSubmitForm" class="btn btn-primary btn-large btnSubmit" value="<?php echo !empty($tltArea) ? 'Salvar galeria' : (!empty($item) ? 'Salvar' : 'Cadastrar'); ?>" />
        
        <div class="boxMsg boxMsgForm">
            <p class="error">Preencha corretamente os campos em vermelho.</p>
            <p class="boxErrorServer errorServerLogin">Ocorreu um erro. Tente novamente.</p>
            <div class="boxLoading boxLoadingBlue <?php echo !empty($item) ? 'boxLoadingEdit' : ''; ?>"><?php echo Asset::img('loading-blue-disabled.gif'); ?></div>
        </div>
        
        <span class="clear"></span>
        <?php if(!empty($tltArea)) : ?>
            <a href="#" class="btn-voltar-gal"><i class="icon-chevron-left"></i>Voltar para "<?php echo $tltArea; ?>" sem salvar a galeria</a>
        <?php endif; ?>

    </div>
    <div class="bgDisabled">&nbsp;</div>
    <div class="msgErrorLabel">&nbsp;</div>
    
    <?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token(), array('class' => 'inputToken')); ?>
</form>