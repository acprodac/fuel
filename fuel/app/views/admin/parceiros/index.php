    <h3>Prêmios</h3>
    <?php echo $boxFeedback; ?>
    
    <div id="containner">
        
        <form id="formSave" class="well well-large form-page form-page-margin form-create" action="<?php echo Uri::current(); ?>" method="POST" accept-charset="utf-8">

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

                
                <label for="">Imagens: <span>(tamanho mínimo: 220x80px)</span></label>

                <?php $count = 0; ?>
                <div class="tplGray">
                    <div class="boxTarget boxTarget-250 boxTarget-250-gal boxTarget-250-parc sortable">

                        <?php if(!empty($item->fields['imagem']) && is_array($item->fields['imagem'])) : foreach($item->fields['imagem'] as $doc) : if(empty($doc['imagem']) || !isset($doc['titulo'])) continue; ?>
                        
                            <div class="uploadFile uploadFile-sort uploadFile-mult boxItem-sort" rel="item-<?php echo $count; ?>">
                                <label for="materiaDocFile-<?php echo $count; ?>" class="itemUploadDoc">Imagem:</label>
                                
                                <div class="boxBtnUpload<?php echo isset($doc['imagem']) && !empty($doc['imagem']) ? ' hide' : ''; ?>">
                                    <button class="btnUploadFile btn btn-success"><i class="icon-plus icon-white"></i>Selecionar imagem</button>
                                    <input type="file" id="materiaDocFile-<?php echo $count; ?>" name="materiaDocFile" class="uploadFile" accept=".jpg,.jpeg,.gif,.png,.tiff" rel="img" data-width="220" data-height="80" />
                                    <span class="infoLoading">Fazendo upload da imagem. Aguarde...</span>
                                    <span class="infoLoadingError feedback-hide">Ocorreu um erro durante o upload. Tente novamente.</span>
                                    <span class="infoDeleteSuccess feedback-hide itemUploadDoc">A imagem foi excluída.</span>
                                    <div class="boxLoadingFile"><?php echo Asset::img('loading-green-disabled.gif'); ?></div>
                                    <input type="hidden" name="fields[imagem][<?php echo $count; ?>][imagem]" class="fileUploaded" value="<?php echo isset($doc['imagem']) ? $doc['imagem'] : ''; ?>" />
                                </div>
                                
                                <div class="boxInfosImg<?php echo isset($doc['imagem']) && !empty($doc['imagem']) ? ' show' : ''; ?>">
                                    <div class="imgInfos">
                                        <div class="imgLeft">
                                            <div class="img img-polaroid" style="float: none;">
                                                <?php if(isset($doc['imagem']) && !empty($doc['imagem'])) : ?>
                                                    <img src="<?php echo $baseUrl . 'upload/img/160x90_' . $doc['imagem'] . '?_' . time(); ?>" alt="<?php echo $doc['titulo']; ?>" />
                                                <?php else : ?>
                                                    <?php echo Asset::img('interrogacao.jpg'); ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="imgInfos">
                                                <p><strong>Tamanho:</strong> <span class="tamanho"><?php echo $doc['imagem_tamanho']; ?></span></p>
                                                <p><strong>Formato:</strong> <span class="formato"><?php echo $doc['imagem_formato']; ?></span></p>
                                                <p><strong>Peso:</strong> <span class="peso"><?php echo $doc['imagem_peso']; ?></span></p>
                                            
                                                <input type="hidden" name="fields[imagem][<?php echo $count; ?>][imagem_tamanho]" class="input-tamanho" value="<?php echo $doc['imagem_tamanho']; ?>">
                                                <input type="hidden" name="fields[imagem][<?php echo $count; ?>][imagem_formato]" class="input-formato" value="<?php echo $doc['imagem_formato']; ?>">
                                                <input type="hidden" name="fields[imagem][<?php echo $count; ?>][imagem_peso]" class="input-peso" value="<?php echo $doc['imagem_peso']; ?>">
                                            </div>
                                        </div>
                                        <div class="imgOpts">
                                            <label style="width: auto; font-size: 12px; text-align: left;">Título: <span style="font-size: 11px;">(SHIFT+ENTER para pular uma linha)</span></label>
                                            <textarea name="fields[imagem][<?php echo $count; ?>][titulo]" id="vitrineTitulo-<?php echo $count; ?>" class="form input-xlarge" placeholder="Título" style="width: 206px;"><?php echo isset($doc['titulo']) ? stripslashes($doc['titulo']) : ''; ?></textarea>
                                        </div>

                                        <div class="boxBtnDelete">
                                            <button class="btnDeleteFile btn btn-danger" rel="<?php echo isset($doc['imagem']) ? $doc['imagem'] . '|img' : ''; ?>"><i class="icon-trash icon-white"></i>Excluir imagem</button>
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
                                    <input type="file" id="materiaDocFile-<?php echo $count; ?>" name="materiaDocFile" class="uploadFile" accept=".jpg,.jpeg,.gif,.png,.tiff" rel="img" data-width="220" data-height="80" />
                                    <span class="infoLoading">Fazendo upload da imagem. Aguarde...</span>
                                    <span class="infoLoadingError feedback-hide">Ocorreu um erro durante o upload. Tente novamente.</span>
                                    <span class="infoDeleteSuccess feedback-hide itemUploadDoc">A imagem foi excluída.</span>
                                    <div class="boxLoadingFile"><?php echo Asset::img('loading-green-disabled.gif'); ?></div>
                                    <input type="hidden" name="fields[imagem][<?php echo $count; ?>][imagem]" class="fileUploaded" value="" />
                                </div>
                                
                                <div class="boxInfosImg">
                                    <div class="imgLeft">
                                        <div class="img img-polaroid" style="float: none;">
                                                
                                        </div>
                                        <div class="imgInfos">

                                            <p><strong>Tamanho:</strong> <span class="tamanho"></span></p>
                                            <p><strong>Formato:</strong> <span class="formato"></span></p>
                                            <p><strong>Peso:</strong> <span class="peso"></span></p>

                                            <input type="hidden" name="fields[imagem][<?php echo $count; ?>][imagem_tamanho]" class="input-tamanho" value="">
                                            <input type="hidden" name="fields[imagem][<?php echo $count; ?>][imagem_formato]" class="input-formato" value="">
                                            <input type="hidden" name="fields[imagem][<?php echo $count; ?>][imagem_peso]" class="input-peso" value="">

                                        </div>
                                    </div>
                                    <div class="imgOpts">
                                        <label style="width: auto; font-size: 12px; text-align: left;">Título: <span style="font-size: 11px;">(SHIFT+ENTER para pular uma linha)</span></label>
                                        <textarea name="fields[imagem][<?php echo $count; ?>][titulo]" id="vitrineTitulo-<?php echo $count; ?>" class="form input-xlarge" placeholder="Título" style="width: 206px;"></textarea>
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