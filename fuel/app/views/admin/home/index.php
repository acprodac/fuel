    <h3>Home</h3>
    <?php echo $boxFeedback; ?>
    
    <div id="containner">
        
        <form id="formSave" class="well well-large form-page form-page-margin form-create" action="<?php echo Uri::current(); ?>" method="POST" accept-charset="utf-8">
            <div class="formInit">

                <?php $count = 0; if(!empty($item->fields['logo'])) : ?>
                
                    <div class="uploadFile" rel="item-0">
                        <label for="" class="itemUploadDoc">Logo: <span>(tamanho mínimo: 219x81px)</span></label>
                        
                        <div class="boxBtnUpload<?php echo isset($item->fields['logo']) && !empty($item->fields['logo']) ? ' hide' : ''; ?>">
                            <button class="btnUploadFile btn btn-success"><i class="icon-plus icon-white"></i>Selecionar imagem</button>
                            <input type="file" id="materiaDocFile-<?php echo $count; ?>" name="materiaDocFile" class="uploadFile" accept=".jpg,.jpeg,.gif,.png,.tiff" rel="img" data-width="219" data-height="81" />
                            <span class="infoLoading">Fazendo upload da imagem. Aguarde...</span>
                            <span class="infoLoadingError feedback-hide">Ocorreu um erro durante o upload. Tente novamente.</span>
                            <span class="infoDeleteSuccess feedback-hide itemUploadDoc">A imagem foi excluída.</span>
                            <div class="boxLoadingFile"><?php echo Asset::img('loading-green-disabled.gif'); ?></div>
                            <input type="hidden" name="fields[logo]" class="fileUploaded" value="<?php echo isset($item->fields['logo']) ? $item->fields['logo'] : ''; ?>" />
                        </div>
                        
                        <div class="boxInfosImg<?php echo isset($item->fields['logo']) && !empty($item->fields['logo']) ? ' show' : ''; ?>">
                            <div class="imgInfos">
                                
                                <div class="img img-logo img-polaroid" style="float: none;">
                                    <?php if(isset($item->fields['logo']) && !empty($item->fields['logo'])) : ?>
                                        <img src="<?php echo $baseUrl . 'upload/img/' . $item->fields['logo'] . '?_' . time(); ?>" alt="<?php echo $item->titulo; ?>" />
                                    <?php else : ?>
                                        <?php echo Asset::img('interrogacao.jpg'); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="imgInfos">
                                    <p><strong>Tamanho:</strong> <span class="tamanho"><?php echo $item->fields['logo_tamanho']; ?></span></p>
                                    <p><strong>Formato:</strong> <span class="formato"><?php echo $item->fields['logo_formato']; ?></span></p>
                                    <p><strong>Peso:</strong> <span class="peso"><?php echo $item->fields['logo_peso']; ?></span></p>
                                
                                    <input type="hidden" name="fields[logo_tamanho]" class="input-tamanho" value="<?php echo $item->fields['logo_tamanho']; ?>">
                                    <input type="hidden" name="fields[logo_formato]" class="input-formato" value="<?php echo $item->fields['logo_formato']; ?>">
                                    <input type="hidden" name="fields[logo_peso]" class="input-peso" value="<?php echo $item->fields['logo_peso']; ?>">
                                </div>
                                
                               
                                <div class="boxBtnDelete">
                                    <button class="btnDeleteFile btn btn-danger" rel="<?php echo isset($item->fields['logo']) ? $item->fields['logo'] . '|img' : ''; ?>"><i class="icon-trash icon-white"></i>Excluir imagem</button>
                                    <div class="boxLoadingDeleteFile"><?php echo Asset::img('loading-red-disabled.gif'); ?></div>
                                    <span class="infoDeleteError feedback-hide">Ocorreu um erro. Tente novamente.</span>
                                </div>

                                <span class="clear"></span>                                
                            </div>
                        </div>
                    </div>

                <?php else : ?>

                    <div class="uploadFile" rel="item-0">
                        <label for="" class="itemUploadDoc">Logo: <span>(tamanho mínimo: 219x81px)</span></label>
                        
                        <div class="boxBtnUpload">
                            <button class="btnUploadFile btn btn-success"><i class="icon-plus icon-white"></i>Selecionar imagem</button>
                            <input type="file" id="materiaDocFile-<?php echo $count; ?>" name="materiaDocFile" class="uploadFile" accept=".jpg,.jpeg,.gif,.png,.tiff" rel="img" data-width="219" data-height="81" />
                            <span class="infoLoading">Fazendo upload da imagem. Aguarde...</span>
                            <span class="infoLoadingError feedback-hide">Ocorreu um erro durante o upload. Tente novamente.</span>
                            <span class="infoDeleteSuccess feedback-hide itemUploadDoc">A imagem foi excluída.</span>
                            <div class="boxLoadingFile"><?php echo Asset::img('loading-green-disabled.gif'); ?></div>
                            <input type="hidden" name="fields[logo]" class="fileUploaded" value="" />
                        </div>
                        
                        <div class="boxInfosImg">
                            
                            <div class="img img-logo img-polaroid" style="float: none;">
                                    
                            </div>
                            <div class="imgInfos">

                                <p><strong>Tamanho:</strong> <span class="tamanho"></span></p>
                                <p><strong>Formato:</strong> <span class="formato"></span></p>
                                <p><strong>Peso:</strong> <span class="peso"></span></p>

                                <input type="hidden" name="fields[logo_tamanho]" class="input-tamanho" value="">
                                <input type="hidden" name="fields[logo_formato]" class="input-formato" value="">
                                <input type="hidden" name="fields[logo_peso]" class="input-peso" value="">

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

                <label for="fields[central_vendas]">Central de vendas:</label>
                <input type="text" name="fields[central_vendas]" id="fields[central_vendas]" class="form input-large" value="<?php echo $item->fields['central_vendas']; ?>" />
    
                <label for="fields[email]">Email:</label>
                <input type="text" name="fields[email]" id="fields[email]" class="form input-large" value="<?php echo $item->fields['email']; ?>" />

                <label for="fields[enderendo_contato]">Endereço de contato:</label>
                <input type="text" name="fields[enderendo_contato]" id="fields[enderendo_contato]" class="form input-large" value="<?php echo $item->fields['enderendo_contato']; ?>" />
    
                <label for="fields[texto_footer]">Texto do footer:</label>
                <input type="text" name="fields[texto_footer]" id="fields[texto_footer]" class="form input-xxlarge" value="<?php echo $item->fields['texto_footer']; ?>" />


                <h3>Destaque 1</h3>

                <label for="fields[destaque][0][titulo]">Título:</label>
                <input type="text" name="fields[destaque][0][titulo]" id="fields[destaque][0][titulo]" class="form input-xxlarge" value="<?php echo $item->fields['destaque'][0]['titulo']; ?>" />

                <label for="fields[destaque][0][subtitulo]">Subtítulo:</label>
                <input type="text" name="fields[destaque][0][subtitulo]" id="fields[destaque][0][subtitulo]" class="form input-xxlarge" value="<?php echo $item->fields['destaque'][0]['subtitulo']; ?>" />

                <label for="fields[destaque][0][texto]">Texto:</label>
                <div class="boxtinyMce tinyMce-min">
                    <textarea name="fields[destaque][0][texto]" id="fields[destaque][0][texto]" class="form form-text input-xxlarge required tinyMce tinyMce-min" data-height="150px"><?php echo stripslashes($item->fields['destaque']['0']['texto']); ?></textarea>
                </div>

                <span class="clear"></span>
                
                <div class="box-float" style="margin-right: 3%;">
                    <h3>Destaque 2</h3>
                    <select name="fields[destaque][1]" id="fields[destaque][1]" class="input-xlarge">
                        <option value="">Nenhum</option>
                        <option value="segmentos" <?php echo (isset($item->fields['destaque'][1]) && $item->fields['destaque'][1] == 'segmentos') ? 'selected="selected"' : ''; ?>>Segmentos em destaque</option>
                        <option value="premios" <?php echo (isset($item->fields['destaque'][1]) && $item->fields['destaque'][1] == 'premios') ? 'selected="selected"' : ''; ?>>Prêmios em destaque</option>
                        <option value="obras" <?php echo (isset($item->fields['destaque'][1]) && $item->fields['destaque'][1] == 'obras') ? 'selected="selected"' : ''; ?>>Obras em destaque</option>
                    </select>
                    </select>
                </div>
                <div class="box-float">
                    <h3>Destaque 3</h3>
                    <select name="fields[destaque][2]" id="fields[destaque][2]" class="input-xlarge">
                        <option value="">Nenhum</option>
                        <option value="segmentos" <?php echo (isset($item->fields['destaque'][2]) && $item->fields['destaque'][2] == 'segmentos') ? 'selected="selected"' : ''; ?>>Segmentos em destaque</option>
                        <option value="premios" <?php echo (isset($item->fields['destaque'][2]) && $item->fields['destaque'][2] == 'premios') ? 'selected="selected"' : ''; ?>>Prêmios em destaque</option>
                        <option value="obras" <?php echo (isset($item->fields['destaque'][2]) && $item->fields['destaque'][2] == 'obras') ? 'selected="selected"' : ''; ?>>Obras em destaque</option>
                    </select>
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