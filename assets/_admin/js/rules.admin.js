function validateEmail(email){
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function getMetaValue($key){
    if(typeof $key == 'undefined'){
        return null;
    }
    
    var $meta = document.getElementsByTagName('meta');
    
    for(var $i = 0, $total = $meta.length; $i < $total; $i++){
        if($meta[$i].name == $key){
            return $meta[$i].content;
        }
    }
}

function saveGaleria($titulo, $id){
    $titulo = (typeof $titulo == 'undefined' ? null : $titulo);
    $id = (typeof $id == 'undefined' ? null :$id);

    $('#box-edit-galeria').hide();
    $('#box-edit-galeria iframe').remove();

    $('#formSave .formInit').fadeIn('fast');
    $('#formSave').css({ height: '' });

    $('#containner > a.btnLink').removeClass('hidden');

    if($id){
        $('.box-cadastrar').hide();
        $('.box-editar').show();

        $('.btn-galeria-edit').attr('href', $('.btn-galeria-edit').attr('href').replace('{ID}', $id));
        $('.btn-galeria-delete').attr('href', $('.btn-galeria-delete').attr('href').replace('{ID}', $id));
        $('#id_galeria').val($id);
        $('.btn-galeria-edit span').text($titulo);
    }
}

function setIFrameHeight(height){
    $('#iframe-galeria').height(height);
    $('#formSave').height(height);
}

(function(){
    "use strict";
    
    if(! window.console){
        console = { log: function(){} };
    }

    var $baseUrl = getMetaValue('baseUrl');
    
    requirejs.config({
        baseUrl: $baseUrl + 'assets/_admin/js/',
        urlArgs: 'v=_5',
        shim: {
            'jquery.migrate': ['jquery-1.10.2.min'],
            'jquery.passstrength.min': ['jquery.migrate'],
            'jquery.ui-1.10.3': ['jquery.migrate'],
            'jquery.validate.min': ['jquery.migrate', 'jquery.metadata'],
            'jquery.metadata': ['jquery.migrate'],
            'jquery.meio.mask.min': ['jquery.migrate'],
            'jquery.masktelsp': ['jquery.migrate', 'jquery.meio.mask.min'],
            'jquery.upload-1.0.2.min': ['jquery.migrate'],
            'jquery.maskedinput.min': ['jquery.migrate'],
            'jquery.tinymce.min': ['jquery.migrate', 'tinymce.min'],
            'bootstrap.min': ['jquery.migrate'],
            'jquery.filter_input': ['jquery.migrate'],
            'jquery.color': ['jquery.migrate'],
            'jquery.Jcrop.min': ['jquery.migrate'],
            'jquery.fancybox.pack': ['jquery.migrate']
        },
        waitSeconds: 200
    });

    require(['jquery-1.10.2.min', 'jquery.migrate', 'jquery.validate.min', 'jquery.ui-1.10.3', 'jquery.metadata', 'jquery.maskedinput.min', 'jquery.color', 'jquery.Jcrop.min', 'bootstrap.min', 'jquery.filter_input', 'jquery.fancybox.pack'], function(){
        
        (function(){
            var $hash = window.location.hash;
            $hash = $hash.replace('#', '');
            if($hash != ''){
                $('.label-success.label-' + $hash).fadeIn('fast');
                window.location.hash = '';
                var $waitHide = setTimeout(function(){
                    $('.label-success.label-' + $hash).fadeOut('fast');
                }, 4000);
            }
        })();

        $(document).on('click', '.btn', function(){
            $(this).blur();
        });
        
        $(document).on('click', '.feedback-hide', function(){
            $(this).stop().fadeOut('fast');
            return false;
        });

        if($('#formSave.form-lightbox').length){
            parent.setIFrameHeight($('body').outerHeight());

            $('body').bind('heightChange', function(){
                parent.setIFrameHeight($('body').outerHeight());
            });
        }



        
        /*$('#wrapper h1 img').click(function(){
            $('.btnHome').click();
            return false;
        });*/
        
        if($('.uploadFile-mult').length > 1){
            PageMethods.sortableImgsGal();
        }

        $('.select-tipo-post').change(function(){
            var $val = $(this).val();

            $('.boxInputsPost').hide().fadeIn('fast');

            $('.box-post-input, .tlt-post').hide();
            $('.box-post-input.item-' + $val + ', .tlt-post.tlt-' + $val).show();
        });

        if($('.select-tipo-post').length){
            var $val = $('.select-tipo-post').val();
            if($val != ''){
                $('.boxInputsPost').hide().fadeIn('fast');

                $('.box-post-input, .tlt-post').hide();
                $('.box-post-input.item-' + $val + ', .tlt-post.tlt-' + $val).show();
            }
        }

        $('#tipo_eventos').change(function(){
            var $url = $(this).closest('form').attr('action');
            window.location = $url + $(this).val();
        });

        $('#videoLink').keyup(function(){
            var $this = $(this);
            var $waitTest = setTimeout(function(){
                var $data = testUrlForMedia($this.val());
                
                if($this.hasClass('error') || $data == null){
                    $('#videoId').val('');
                    $('#videoType').val('');
                    return null;
                }
                
                $('#videoId').val($data.id);
                $('#videoType').val($data.type);
                
            }, 100);
        });

        $('.btn-cont-instagram').tooltip({
            placement: 'top'
        });

        if($('.autocomplete-autor').length){
            var cacheAutor = {};
            $('.autocomplete-autor').autocomplete({
                minLength: 2,
                delay: 5,
                source: function( request, response ) {
                    var term = request.term;
                    if(term in cacheAutor){
                        response(cacheAutor[term]);
                        return;
                    }

                    $.getJSON( $baseUrl + 'admin/assinatura/autor', request, function( data, status, xhr ) {
                        cacheAutor[ term ] = data;
                        response( data );
                    });
                }
            });
        }

        if($('.autocomplete-convidado').length){
            var cacheConvidado = {};
            $('.autocomplete-convidado').autocomplete({
                minLength: 2,
                delay: 5,
                source: function( request, response ) {
                    var term = request.term;
                    if(term in cacheConvidado){
                        response(cacheConvidado[term]);
                        return;
                    }

                    $.getJSON( $baseUrl + 'admin/assinatura/convidado', request, function( data, status, xhr ) {
                        cacheConvidado[ term ] = data;
                        response( data );
                    });
                }
            });
        }

        $('.btn-groupPaginate button').click(function($e){
            if($(this).hasClass('active') || $(this).hasClass('disabled')){
                $e.stopPropagation();
                return;
            }
        });
        
        $('#menuLeft a, .btnLink, .btnList .btnEditar, h3 a').click(function(){
            if(! $(this).hasClass('btnDisabled')){
                var $location;

                if($(this).hasClass('btn-act')){
                    return false;
                }
            
                if($(this).closest('div').hasClass('btn-groupPaginate')){
                    $location = $(this).attr('data-uri');
                } else {
                    $location = $(this).attr('href');
                }
                
                LoadPage(function(){
                    window.location = $location;
                });
                return false;
            }
        });

        if($('.btnSelecionarCheck').length){
            $('.btnSelecionarCheck').each(function(){
                var $p = $(this).closest('.cont-checkbox');
                var $total = $p.find('input.item').length;
                var $totalCheck = $p.find('input.item:checked').length;

                if($totalCheck >= $total){
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });

            $('.btnSelecionarCheck').change(function(){
                var $p = $(this).closest('.cont-checkbox');
                var $prop = $(this).is(':checked');

                $p.find('input.item').each(function(){
                    $(this).prop('checked', $prop);
                });                
            });
        }
        
        $('a.btn-galeria-cad').click(function($e){
            $e.preventDefault();

            var $title = $('#titulo').val();
            var $url = $(this).attr('href');

            if($.trim($title) == ''){
                $title = 'Título';
            }

            $('#box-edit-galeria').html('<iframe id="iframe-galeria" name="iframe-galeria" src="' + $url + '&titulo=Galeria - ' + $title + '" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>');

            $('#formSave .formInit').hide();
            $('#box-edit-galeria').fadeIn();

            $('#containner > a.btnLink').addClass('hidden');

            /*$.fancybox.open({'href': $url + '&titulo=Galeria - ' + $title}, {type: 'iframe', helpers: {
                overlay: {
                  locked: false,
                  closeClick: false
                }
            }});*/
        });
        
        $('a.btn-galeria-edit').click(function($e){
            $e.preventDefault();

            var $url = $(this).attr('href');

            $('#box-edit-galeria').html('<iframe id="iframe-galeria" name="iframe-galeria" src="' + $url + '" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>');

            $('#formSave .formInit').hide();
            $('#box-edit-galeria').fadeIn();

            $('#containner > a.btnLink').addClass('hidden');

            /*$.fancybox.open({'href': $url}, {type: 'iframe', helpers: {
                overlay: {
                  locked: false,
                  closeClick: false
                }
            }});*/
        });

        $('a.btn-galeria-delete').click(function($e){
            $e.preventDefault();

            var $this = $(this);
            var $dialog = $('.dialog-confirm');
            var $name = $this.closest('.box-item-galeria').find('.btn-galeria-edit span').text();
            var $url = $this.attr('href');
            
            $dialog.find('p .name').text('"' + $name + '"');
            
            $('.dialog-confirm-excluir').dialog({
                resizable: false,
                height: 280,
                modal: true,
                buttons: {
                    'Sim': function(){
                        $(this).dialog('close');
                        $this.addClass('disabled');
                        
                        var $send = new Ajax($url, $this.closest('tr'));
                        $send.method = 'POST';
                        $send.callbackSuccess = function(){
                            $this.removeClass('disabled');

                            $('.box-editar').hide();
                            $('.box-cadastrar').fadeIn();

                            $('.box-editar a span').text('');
                            $('#id_galeria').val(0);

                            var $url = $('.btn-galeria-edit').attr('href');
                            $url = $url.replace(/\/(\d+)/, '/{ID}');
                            $('.btn-galeria-edit').attr('href', $url);

                            $url = $('.btn-galeria-delete').attr('href');
                            $url = $url.replace(/\/(\d+)/, '/{ID}');
                            $('.btn-galeria-delete').attr('href', $url);
                        };
                        $send.callbackError = function(){
                            $this.removeClass('disabled');
                        };
                        $send.send();
                    },
                    'Não': function() {
                        $(this).dialog('close');
                    }
                }
            });
            
            return false;
        });

        $('.checkbox input:radio').each(function(){
            if($(this).prop('checked')){
                $(this).addClass('checked');
            }
        });

        /*
        $(document).on('click', '.btnAddInst', function(){
                var $this = $(this);
                var $box = $this.closest('.boxItemInst');
                var $boxParent = $this.closest('.tplGray .boxTarget');
                var $index = parseInt($boxParent.find('.boxItemInst:last').attr('rel').split('-')[1]);

                if($boxParent.find('.boxItemInst-pesquisa').length){
                    $index = parseInt($boxParent.find('.boxItemInst-pesquisa:last').attr('rel').split('-')[1]);
                }
               
                $this.addClass('btnEspecDisabled');
                $box.find('.btnRemoveInst:last').removeClass('btnEspecDisabled');
                
                var $clone = $box.clone();
                $clone.attr('rel', $clone.attr('rel').replace(/\-(\d+)/, '-' + ($index + 1)));
                $clone.find('.form').val('');
                $clone.find('.btnAddInst:last').removeClass('btnEspecDisabled');
                $clone.find('.btnRemoveInst:last').addClass('btnEspecDisabled');
                $index++;
                
                if(! $(this).hasClass('btnAddInst-nocount')){

                    $clone.find('label').each(function(){
                        if(typeof $(this).attr('for') != 'undefined' && $(this).attr('for').indexOf('-') != -1){
                            $(this).attr('for', $(this).attr('for').replace(/\-(\d+)/, '-' + $index));
                        }
                    });
                    
                    $clone.find('input, select').each(function(){
                        if(typeof $(this).attr('id') != 'undefined' && $(this).attr('id').indexOf('-') != -1){
                            $(this).attr('id', $(this).attr('id').replace(/\-(\d+)/, '-' + $index));
                        }
                        
                        if(typeof $(this).attr('name') != 'undefined'){
                            $(this).attr('name', $(this).attr('name').replace(/\[(\d+)\]/, '[' + $index + ']'));
                        }
                    });

                }

                if($clone.find('.boxOpcoes').length){
                    $clone.find('.boxOpcoes').hide();
                }

                if($clone.find('.boxRespostas').length){
                    $clone.find('.boxRespostas').hide();
                }

                if($clone.find('.checkComplemento-2').length){
                    var $name = $clone.find('.checkComplemento-2').attr('name');
                    $clone.find('input[name="' + $name + '"]').removeClass('checked');

                    $clone.find('.checkComplemento-2').addClass('checked');
                    $clone.find('.checkComplemento-2').prop('checked', true);
                    $clone.find('.boxComplemento').hide();
                }

                if($clone.find('.checkRequired2').length){
                    var $name = $clone.find('checkRequired2').attr('name');
                    $clone.find('input[name="' + $name + '"]').removeClass('checked');

                    $clone.find('.checkRequired2').addClass('checked');
                    $clone.find('.checkRequired2').prop('checked', true);
                }

                if($clone.find('.boxItemRespInner .boxItemInst').length > 1){
                    $clone.find('.boxItemRespInner .boxItemInst').each(function($i){
                        if($i){
                            $(this).remove();
                        } else {
                            $(this).find('.btnRemoveInst').addClass('btnEspecDisabled');
                            $(this).find('.btnAddInst').removeClass('btnEspecDisabled');
                        }
                    })
                }
                
                $boxParent.append($clone);

                if($clone.find('.tipoPesquisa').length){
                    $clone.find('.tipoPesquisa').focus();
                }

                PageMethods.maskTel();
                
                PageMethods.sortAssuntos();
                
                if($boxParent.hasClass('tplGrayAssuntos')){
                    $clone.find('input.form').focus();
                }
                
                return false;
            });
*/
        
        $(document).on('click', '.disabled', function($e){
            $e.stopPropagation();
            return false;
        });
        
        $('#formFiltro.formFiltroExtracoes').submit(function($e){
            $e.stopPropagation();
            
            var $data1, $data2;
            
            $data1 = $('#contatoData1').val();
            $data2 = $('#contatoData2').val();
            
            if($data1 != ''){
                $data1 = $data1.split('/');
                $data1 = $data1[2] + $data1[1] + $data1[0];
            }
            
            if($data2 != ''){
                $data2 = $data2.split('/');
                $data2 = $data2[2] + $data2[1] + $data2[0];
            }

            if($data1 != '' && $data2 != '' && $data2 < $data1){
                
                $('#contatoData1, #contatoData2').val('');
                $('#contatoData1').focus();
                return false;
            }
            
            $('#contatoData1').val($('#contatoData1').val().replace(/\//g, '-'));
            $('#contatoData2').val($('#contatoData2').val().replace(/\//g, '-'));
            
            var $waitChange = setTimeout(function(){
                $('#contatoData1').val($('#contatoData1').val().replace(/\-/g, '/'));
                $('#contatoData2').val($('#contatoData2').val().replace(/\-/g, '/'));
            }, 1000);
            
        });
        
        $('.itemTipoApoiador').change(function(){
            var $val = $(this).val();
            
            if($val == 'apoiador'){
                $('.descrFinanciador').hide();
            } else {
                $('.descrFinanciador').show();
            }
            
        });
        
        if($('.boxSlug').length){
            var $slugEdit = false;
            var $prevSlug = '';
            
            $('.itemSlug').filter_input({ regex:'[a-z0-9-]' });
            $('.itemSlug').focus(function(){
                $prevSlug = $(this).val();
            }).keyup(function(){
                var start = this.selectionStart, end = this.selectionEnd;
                var $str = $(this).val();
                $str = $str.replace(/[^a-z0-9]+/g, '-');
                $(this).val($str);
                this.setSelectionRange(start, end);
            }).blur(function(){
                var $str = $(this).val();
                $str = $str.replace(/^-|-$/g, '');
                $(this).val($str);
                if($prevSlug != $(this).val()){
                    $slugEdit = true;
                }
            });
            
            var $makeBaseUrl = function($prev){
                var $urlPrev = '';
                
                for(var $i = 0, $total = $prev.length; $i < $total; $i++){
                    if(! $('#' + $prev[$i]).val()){
                        return false;
                    }
                    
                    var $slugItem = $('#' + $prev[$i] + ' option[value="' + $('#' + $prev[$i]).val() + '"]').attr('rel');
                    
                    if($prev[$i] == 'materiaTemplate' && $slugItem == 'galeria-fotos'){
                        $slugItem = 'galeria';
                    }
                    
                    $urlPrev += ($slugItem + '/');
                }
                
                return $urlPrev;
            };
            
            if($('.itemSlug').hasClass('itemSlugEdit')){
                $slugEdit = true;
                
                var $prev = $('.boxSlug').attr('rel').split('|');
                var $urlPrev = '';
                
                if($prev){
                    for(var $i = 0, $total = $prev.length; $i < $total; $i++){
                        $('#' + $prev[$i]).on('change', function(){
                            $('.urlForm .baseUrl').text($makeBaseUrl($prev));
                        });
                    }
                }
            }
            
            $('.inputBaseSlug').keyup(function(){
                if($(this).val() == '' || $slugEdit){
                    return false;
                }
                
                var $prev = $('.boxSlug').attr('rel').split('|');
                var $urlPrev = '';
                
                if($prev){
                    for(var $i = 0, $total = $prev.length; $i < $total; $i++){
                        $('#' + $prev[$i]).on('change', function(){
                            $('.urlForm .baseUrl').text($makeBaseUrl($prev));
                        });
                    }
                    
                    $urlPrev = $makeBaseUrl($prev);
                    var $totalPrev = $urlPrev ? $urlPrev.split('/') : 0;
                    
                    if(($totalPrev.length < $prev.length) || !$totalPrev){
                        return false;
                    }
                }
                
                var $data = {};
                $data.title = $(this).val();
                
                var $ajax = new Ajax($(this).closest('form').attr('action') + '/verifyslug', $('.boxSlug'), $data);
                $ajax.callbackSuccess = function($data){
                    $('.urlForm .baseUrl').text($urlPrev);
                    $('.itemSlug').val($data.slug);
                    $('.infoSlug').hide();
                    $('.urlForm, .itemSlug').show()
                };
                $ajax.callbackError = function(){};
                $ajax.send();
            });
        }
        
        if($('#formSave').length){
            $('.btn-voltar-gal').click(function(){
                parent.saveGaleria();
            });

            if($('#formSave').hasClass('form-posts')){
                $('#formSave').attr('data-redirect', $('#formSave').attr('data-redirect').replace('{ID}', $('#id_evento').val()));
            }

            var $validaForm = new Form($('#formSave'));
            var $redir = typeof $('#formSave').attr('data-redirect') != 'undefined' ? $('#formSave').attr('data-redirect') : $('#formSave').attr('action');

            if($('#formSave').hasClass('form-lightbox')){
                $validaForm.callbackSuccess = function(json){
                    parent.saveGaleria($('#titulo').val(), json.id);
                };
            } else {
                $validaForm.redirect = $redir;
            }

            $validaForm.callbackError = function(json){
                $('#formSave .boxErrorServer').show();
            };
            $validaForm.validate();

            var $wBtn = parseInt($('#inputSubmitForm').outerWidth());
            $('.boxMsgForm .boxLoading').css({ width: $wBtn + 'px', left: '-' + $wBtn + 'px' });
        }
        
        $('.label-feedback').click(function(){
            $(this).fadeOut('fast');
        });

        if($('.label-success-inner').is(':visible')){
            var $waitHide = setTimeout(function(){
                $('.label-success-inner').click();
            }, 5000);
        }

        $(document).on('change', '.checkbox input', function(){
            var $this = $(this);
            $this.closest('.checkbox').find('input').removeClass('checked');
            $this.addClass('checked');
        });

        $('.btnStatus').click(function($e){
            $e.preventDefault();

            var $this = $(this);
            var $verify = new Ajax($(this).attr('href'), undefined, {});
            $verify.callbackSuccess = function($data){
                var $url = $this.attr('href').split($baseUrl)[1].split('/');
                $url.pop();

                if($this.hasClass('btn-primary')){
                    $this.removeClass('btn-primary');
                    $this.addClass('btn-danger');
                    $this.html('inativo');
                    $this.prepend('<i class="glyphicon glyphicon-eye-close"></i>');
                    $this.attr('href', $baseUrl + $url.join('/') + '/1');
                } else {
                    $this.addClass('btn-primary');
                    $this.removeClass('btn-danger');
                    $this.html('ativo');
                    $this.prepend('<i class="glyphicon glyphicon-eye-open"></i>');
                    $this.attr('href', $baseUrl + $url.join('/') + '/0');
                }
            };
            $verify.callbackError = function(){};
            $verify.send();
        });
        
        $('.box-btn-instagram a').click(function($e){
            $e.preventDefault();

            if($(this).hasClass('disabled')){
                return false;
            }

            var $this = $(this);
            var $btnAprov = $this.hasClass('btn-aprov');
            var $verify = new Ajax($(this).attr('href'), undefined, {});
            $verify.method = 'POST';
            $verify.callbackSuccess = function($data){
                $this.closest('.box-btn-instagram').find('a').each(function(){
                    if($btnAprov == $(this).hasClass('btn-aprov')){
                        $(this).addClass('disabled');
                        $(this).find('span.txt').text($(this).attr('rel').split('|')[0]);
                    } else {
                        $(this).removeClass('disabled');
                        $(this).find('span.txt').text($(this).attr('rel').split('|')[1]);
                    }
                });
                verifyInstagram();
            };
            $verify.callbackError = function(){};
            $verify.send();
        });

        $('.img-polaroid-instagram').click(function(){
            var $this = $(this);
            var $id = $this.find('.id').text();
            var $autor = $this.find('.autor').text();
            var $texto = $this.find('.conteudo').text();

            $('#id_instagram').val($id);
            $('#autor').val('@' + $autor);
            $('#conteudo').val($texto);

            $('.img-polaroid-instagram').removeClass('active');
            $this.addClass('active');
        });

        $(document).on('click', '.btnPadrao', function($e){
            $e.preventDefault();

            var $this = $(this);
            var $verify = new Ajax($(this).attr('href'), undefined, {});
            $verify.callbackSuccess = function($data){
                var $url = $this.attr('href').split($baseUrl)[1].split('/');
                var $idOrigin = $url.pop();

                $('.btnPadrao-ativo').each(function(){
                    var $target = $(this).closest('td');
                    var $id = $(this).attr('rel');
                    $target.html('<a class="btn btn-danger btnPadrao" href="' + ($baseUrl + $url.join('/') + $id) + '" title="Clique para tornar padrão"><i class="glyphicon glyphicon-eye-close"></i>Não</a>');
                });

                $this.closest('td').html('<span class="btn btnPadrao-ativo disabled" rel="' + $idOrigin + '">Sim</span>');

            };
            $verify.callbackError = function(){};
            $verify.send();
        });
        
    
        $(document).on('change', '.tipoPesquisa', function(){
            var $val = $(this).val();
            var $target = $(this).closest('.boxItemInst');
            if($val != ''){
                $target.find('.boxOpcoes').show();
                if($val != 'texto'){
                    $target.find('.boxRespostas').show();
                } else {
                    $target.find('.boxRespostas').hide();
                }
            } else {
                $target.find('.boxOpcoes').hide();
            }
        });

        $(document).on('change', '.checkComplemento', function(){
            var $val = $(this).val();
            var $target = $(this).closest('.boxItemInst');
            if($val == 1){
                $target.find('.boxComplemento').show();
                $target.find('.boxComplemento').focus();
            } else {
                $target.find('.boxComplemento').hide();
            }
        });

        $(document).on('change', 'input:radio', function(){
            var $name = $(this).attr('name');
            $('input[name="' + $name + '"]').removeClass('checked');
            $(this).addClass('checked');
        });

        $(document).on('keyup', '.input-pergunta', function(){
            var $val = $(this).val();
            var $target = $(this).closest('.boxItemInst');
            $target.find('.info-pergunta span').text($val);
        });

        $(document).on('click', '.btnOrdenarPesquisa', function($e){
            $e.preventDefault();

            if($(this).hasClass('edit')){
                $('.btnOrdenarPesquisa').text('Ordenar');
                $('.btnOrdenarPesquisa').removeClass('edit');
                $('.boxFormInit').show();
                $('p.info-pergunta').hide();
                $('.sortable').sortable('disable');
                $('.boxTarget-pesquisa').removeClass('sortable');


                var $waitReview = setTimeout(function(){
                    $('.boxOpcoes input:radio').each(function(){
                        if($(this).hasClass('checked') && ! $(this).prop('checked')){
                            $(this).prop('checked', true);
                        }
                    });
                    $('#inputSubmitForm').show();
                }, 200);
            } else {
                $('.btnOrdenarPesquisa').text('Voltar para edição');
                $('.btnOrdenarPesquisa').addClass('edit');

                $('.boxItemInst-pesquisa').each(function(){
                    var $tlt = $(this).find('.input-pergunta').val();
                    $(this).find('.info-pergunta span').text($tlt);
                });

                $('.boxFormInit').hide();
                $('p.info-pergunta').show();
                $('.boxTarget-pesquisa').addClass('sortable');
                PageMethods.sortAssuntos();
                $('.sortable').sortable('enable');
                $('#inputSubmitForm').hide();
            }

        });

        $('.boxItemInst-pesquisa').each(function(){
            $(this).find('input:radio').each(function(){
                if($(this).prop('checked')){
                    $(this).addClass('checked');
                } else {
                    $(this).removeClass('checked');
                }
            });
        });

        var $valTpl;

        if($('#id_tipo_template.alterado').length){
            $valTpl = $('#id_tipo_template.alterado').val();
        }

        $('#id_tipo_template').change(function(){
            var $this = $('#id_tipo_template');
            var $val = $this.val();
            if($val == ''){
                return false;
            }

            var $cont = true;
            var $dialogOk = true;

            if($this.hasClass('alterado')){
                $dialogOk = false;
                $('.dialog-confirm-alterar-tpl').dialog({
                    resizable: false,
                    width: 350,
                    height: 250,
                    modal: true,
                    buttons: {
                        'Sim': function(){
                            $dialogOk = true;
                            $(this).dialog('close');
                        },
                        'Não': function() {
                            $dialogOk = true;
                            $cont = false;
                            $(this).dialog('close');
                        }
                    }
                });
            }

            var $waitSelect = setInterval(function(){
                //console.log($dialogOk);
                if($dialogOk){
                    clearInterval($waitSelect);

                    if(!$cont){
                        $this.val($valTpl);
                        return false;
                    }

                    if($val == 'nao'){
                        if($this.hasClass('alterado')){
                            window.location = $baseUrl + 'admin/pesquisa-de-satisfacao/cadastrar/?tpl=novo';
                        } else {
                            $('.boxTemplate').show();
                            $('#titulo').focus();    
                        }
                    } else {
                        window.location = $baseUrl + 'admin/pesquisa-de-satisfacao/cadastrar/' + $val;
                    }

                    $this.addClass('alterado');
                }
            }, 50);

        });

        function loadCidades(t){
            $.ajax({
                'type'  : 'GET',
                'url'   : $baseUrl + 'assets/js/jsons/cidade_' + t.val().toLowerCase() + '.json',
                'dataType' : 'json',
                'success': function(data, status, xhr) {
                    var htmls = new Array();
                    for(var k in data){
                        htmls.push('<option value="' + data[k]['value'] + '">' + data[k]['value'] + '</option>');
                    }
                    
                    var $target = t.closest('div').find('.slCidade');


                    $target.html('').html(htmls.join(''));

                    $target.each(function(){
                        if($(this).hasClass('edit')){
                            $(this).val($(this).attr('rel'));
                        }
                    });

                }
            });
        }

        //Select UF/Cidade
        /*$.ajax({
            'type'  : 'GET',
            'url'   : $baseUrl + 'assets/js/jsons/estados.json',
            'dataType' : 'json',
            'success': function(data, status, xhr) {
                var htmls = new Array();
                for(var k in data){
                    htmls.push('<option value="' + data[k]['value'] + '">' + data[k]['label'] + '</option>');
                }
                
                $('.slEstado').html(htmls.join(''));

                $('.slEstado').each(function(){
                    if($(this).hasClass('edit')){
                        $(this).val($(this).attr('rel'));
                        loadCidades($(this));
                    }
                });
            }
        }); 
        
        $('.slEstado').change(function(){
            var t = $(this);
            loadCidades(t);
        });*/

        $('.dropdown-menu-relat-pesquisa a').click(function($e){
            $e.preventDefault();
            $('#tpl_relat').val($(this).attr('href'));
            $(this).closest('form').submit();
            return false;
        })

        
        // Mask

        $('input.num').mask('9?9', {placeholder:' '});
        $('input.cep').mask('99999-999');
        
        $('.dropdown-toggle').dropdown();
        
        $('.formFiltroPage').submit(function($form){
            LoadPage();
        });
        
        if($('#page-login').length){
            PageMethods.login();
        }
        
        if($('.formUsuario').length){
            PageMethods.usuarioForm();
        }
        
        if($('#formAlterarSenha').length){
            PageMethods.alterarSenhaForm();
        }
        
        if($('.formVitrineOrdenar').length){
            PageMethods.vitrineOrdenar();
        }
        
        if($('#formVitrine').length){
            PageMethods.vitrineForm();
        }
        
        if($('#formImagens').length){
            PageMethods.pageImagensForm();
        }
        
        if($('#formVideo').length){
            PageMethods.pageVideo();
        }
        
        if($('#page-oquefazemos-materias').length){
            PageMethods.pageMaterias();
        }
        
        if($('#formMaterias').length){
            PageMethods.pageMateriasForm();
        }
        
        if($('#formGerOquefazemos').length){
            PageMethods.pageGerenciamentoOqueFazemos();
        }
        
        if($('#formGerFrentes').length){
            PageMethods.pageGerenciamentoFrentes();
        }
        
        if($('#page-oquefazemos-gerenciamento-categorias').length){
            PageMethods.btnsList();
        }
        
        if($('#page-oquefazemos-gerenciamento-subcategorias').length){
            PageMethods.btnsList();
        }
        
        if($('#page-oquefazemos-gerenciamento-especificidade').length){
            PageMethods.btnsList();
        }
        
        if($('#formGerCategEdit').length){
            PageMethods.pageGerenciamentoCategForm();
        }
        
        if($('#formGerSubcategEdit').length){
            PageMethods.pageGerenciamentoSubCategForm();
        }
        
        if($('#formGerEspecEdit').length){
            PageMethods.pageGerenciamentoEspecForm();
        }
        
        if($('.boxFilterCategs').length){
            PageMethods.btnLoadCategs();
        }
        
        if($('.btnList').length){
            PageMethods.btnsList();
        }
        
        if($('input.data').length){
            PageMethods.btnDate();
        }
        
        if($('.btnAddCategoria').length){
            PageMethods.btnAddCateg();
        }
        
        if($('input.uploadFile').length){
            PageMethods.btnUpload();
        }
        
        if($('textarea.tinyMce').length){
            PageMethods.initTinyMce();
        }
        
        if($('.boxItemInst').length){
            PageMethods.btnItemInst();
        }
        
        if($('input.tel').length){
            PageMethods.maskTel();
        }
        
        /* Formulários - Notícia */
        
        if($('#formNoticia').length){
            PageMethods.pageNoticiaForm();
        }
        
        if($('#formNoticiaCategoria').length){
            PageMethods.pageNoticiaCategoriaForm();
        }
        
        
        /* Formulários - Institucional */
        
        if($('#formInstitucionalContato').length){
            PageMethods.pageInstitucionalContato();
        }
        
        if($('#formInstitucional8Frases').length){
            PageMethods.pageInstitucional8Frases();
        }
        
        if($('#formInstitucionalHistoria').length){
            PageMethods.pageInstitucionalHistoria();
        }
        
        if($('#formEquipe').length){
            PageMethods.pageFormEquipe();
        }
        
        if($('#formTextoIntro').length){
            PageMethods.pageFormTextoIntro();
        }
        
        if($('#formEnglishResult').length){
            PageMethods.pageFormEnglishResult();
        }
        
        if($('#formCategoriaDesc').length){
            PageMethods.pageFormCategoria();
        }
        
        if($('#formParceiros').length){
            PageMethods.pageFormParceiros();
        }
        
        if($('#formResultados').length){
            PageMethods.pageFormResultados();
        }
        
        if($('#formTransparencia').length){
            PageMethods.pageFormTransparencia();
        }
        
        if($('#formOportunidades').length){
            PageMethods.pageFormOportunidades();
        }
    });
    
    
    var PageMethods = {
        
        login: function(){
            $('a.btnEsqueciSenha').click(function(){
                var $valEmail = $('#inputUsuario').val();
                
                if(!validateEmail($valEmail)){
                    $valEmail = '';
                }
                
                $('#inputUsuarioSenha').val($valEmail);
                
                $('#formLogin').hide();
                $('#formEsqueciSenha').fadeIn('fast', function(){
                    $('#inputUsuarioSenha').focus();
                });
                
                $('#boxLogin input.error').removeClass('error');
                $('.boxMsg p').hide();
                
                return false;
            });
            
            $('a.btnVoltarLogin').click(function(){
                $('#formEsqueciSenha').hide();
                $('#formLogin').fadeIn('fast');
                
                $('#formEsqueciSenha .formSucesso').hide();
                $('#formEsqueciSenha .formInit').show();
                
                $('#boxLogin input.error').removeClass('error');
                $('.boxMsg p').hide();
                
                return false;
            });

            var $redirectLogin = getMetaValue('urlRedirect');

            var $validaLogin = new Form($('#formLogin'));
            $validaLogin.redirect = $redirectLogin ? $redirectLogin : $baseUrl + 'admin/';
            $validaLogin.callbackError = function(json){
                $('#formLogin .errorServerLogin').show();
            };
            $validaLogin.validate();
           
            var $validaEsqueciSenha = new Form($('#formEsqueciSenha'));
            $validaEsqueciSenha.callbackSuccess = function(json){
                $('#formEsqueciSenha .formInit').hide();
                $('#formEsqueciSenha .formSucesso code').text(json.info);
                $('#formEsqueciSenha .formSucesso').fadeIn();
            };
            $validaEsqueciSenha.callbackError = function(json){
                $('#formEsqueciSenha .errorServerLogin').show();
            };
            $validaEsqueciSenha.validate();
        },
        
        usuarioForm: function(){
            
            require(['strength', 'jquery.generateRandomPassword'], function(){
                /*var $userForm = new Form($('#formUsuario'));
                $userForm.redirect = $baseUrl + 'admin/usuarios/#' + ($('#formUsuario').hasClass('form-create') ? 'usuario-criado' : 'usuario-editado');
                $userForm.validate();*/
                
                $('#userSenha').strength({
                    strengthButtonText: 'Exibir senha',
                    strengthButtonTextToggle: 'Esconder senha'
                });
                
                $('a.btnGerarSenha').click(function(){
                    var $pwd = $.generateRandomPassword(12);
                    $('#userSenha, #userSenhaConfirmar, .strength[data-password="userSenha"]').val($pwd);
                    $('#userSenha').keyup();
                    
                    $('.boxInfoGerarSenha').removeClass('hide').hide().fadeIn('fast');
                    
                    var $waitHide = setTimeout(function(){
                        $('.boxInfoGerarSenha').stop().fadeOut('fast', function(){
                            $('.boxInfoGerarSenha').addClass('hide');
                        });
                    }, 5000);
                    
                    return false;
                });
            });
            
            if($('.formUsuario').hasClass('form-create')){
                $('#userEmail').blur(function(){
                    var $this = $(this);
                    
                    var $waitVerify = setTimeout(function(){
                        if($this.hasClass('valid')){
                            var $val = $this.val();
                            
                            $('.infosEmail p').hide();
                            $('.infosEmail .boxLoadingInfo').stop().fadeIn('fast');
                            
                            var $verify = new Ajax($baseUrl + 'admin/usuarios/verifyemail/', undefined, {email: $val});
                            $verify.callbackSuccess = function($data){
                                $('.infosEmail .boxLoadingInfo').stop().fadeOut('fast');
                                
                                if(parseInt($data.cadastrado) == 1){
                                    $('.infosEmail p em').text($val);
                                    $('.infosEmail p').stop().fadeIn('fast');
                                    
                                    $('#userEmail').val('').addClass('error');
                                    
                                    var $waitHide = setTimeout(function(){
                                        $('.infosEmail p').fadeOut('fast');
                                    }, 6000);
                                }
                                
                            };
                            $verify.callbackError = function(){
                                $('.infosEmail .boxLoadingInfo').stop().fadeOut('fast');
                            };
                            $verify.send();
                        }
                    }, 150);
                });
            }
        },
        
        alterarSenhaForm: function(){
            
            require(['strength', 'jquery.generateRandomPassword'], function(){
                var $senhaForm = new Form($('#formAlterarSenha'));
                $senhaForm.redirect = $baseUrl + 'admin';
                $senhaForm.validate();
                
                $('#userSenhaNova').strength({
                    strengthButtonText: 'Exibir senha',
                    strengthButtonTextToggle: 'Esconder senha'
                });
                
            });
            
        },
        
        vitrineOrdenar: function(){
            var $total = parseInt($('#numItens').val());
            
            /*$('.sortable .ordemVitrine').each(function($i){
                $(this).val($i+1);
            });*/
            
            $('.sortable').sortable({
                revert: true,
                placeholder: 'ui-state-highlight',
                update: function(e, ui){
                    $total = parseInt($('#numItens').val());
                    
                    if(isFinite($total) && $total > 0){
                        var $itens = $('.sortable li');
                        $itens.removeClass('ui-state-hover');
                        
                        for(var $i = 0; $i < $total; $i++){
                            if($itens.eq($i).hasClass('inativo')){
                                $total++;
                                continue;
                            }

                            $itens.eq($i).addClass('ui-state-hover');
                        }
                    }
                    
                    /*$('.sortable .ordemVitrine').each(function($i){
                        $(this).val($i+1);
                    });*/
                    
                    $('#inputSubmitForm').removeClass('disabled');
                }
            });
            
            /*var $formOrdenar = new Form($('#formVitrineOrdenar'));
            var $urlVitrine;
            
            if($('#formVitrineOrdenar').hasClass('page-equipe')){
                $urlVitrine = $baseUrl + 'admin/institucional/equipe/colaboradores/#item-ordem-atualizada';
            } else if($('#formVitrineOrdenar').hasClass('page-ordenar')){
                $urlVitrine = $baseUrl + 'admin/institucional/parceiros/#ordem-atualizada';
            } else {
                $urlVitrine = $baseUrl + 'admin/home/vitrine/#ordem-atualizada';
            }
            
            $formOrdenar.redirect = $urlVitrine;
            $formOrdenar.validate();*/
            
            $('ul.sortable, ul.sortable li').disableSelection();
        },
        
        vitrineForm: function(){            
            var $formVitrine = new Form($('#formVitrine'));
            $formVitrine.redirect = $baseUrl + 'admin/home/vitrine/#' + ($('.form-create').length ? 'destaque-criado' : 'destaque-editado');
            $formVitrine.validate();            
        },
        
        pageImagensForm: function(){
            var $formImagens = new Form($('#formImagens'));
            $formImagens.redirect = $baseUrl + 'admin/home/imagem-de-fundo/#' + ($('.form-create').length ? 'imagem-criada' : 'imagem-editada');
            $formImagens.validate();
        },
        
        pageVideo: function(){
            var $formVideo = new Form($('#formVideo'));
            $formVideo.callbackSuccess = function(json){
                $('html, body').scrollTop(0);
                $('.label-video-editado').fadeIn('fast');
                var $waitHide = setTimeout(function(){
                    $('.label-video-editado').fadeOut('fast');
                }, 4000);
            };
            $formVideo.validate();
            
            
            
            $('#videoLink').blur(function(){
                var $this = $(this);
                var $waitTest = setTimeout(function(){
                    var $data = testUrlForMedia($this.val());
                    
                    if($this.hasClass('error') || $data == null){
                        $('#videoId').val('');
                        $('#videoType').val('');
                        return null;
                    }
                    
                    $('#videoId').val($data.id);
                    $('#videoType').val($data.type);
                    
                }, 150);
            });
        },
        
        pageMaterias: function(){
            this.btnsList();
        },
        
        pageMateriasForm: function(){
            var $formMaterias = new Form($('#formMaterias'));
            $formMaterias.redirect = $baseUrl + 'admin/o-que-fazemos/materias/#' + ($('.form-create').length ? 'item-criado' : 'item-editado');
            $formMaterias.validate();
            
            $('.select-ini').change(function(){
                var $this = $(this);
                var $boxRef = $this.closest('.boxSelect');
                var $itens = $('.boxSelect-ini');
                var $id = $this.attr('id');
                var $val = $this.val();
                var $data = {'id': $val};
                
                var $url, $next;
                
                $('.boxSelectTemplate .bgDisabledSelect').show();
                $('#materiaTemplate option:eq(0)').prop('selected',true);
                $('.boxTemplate').addClass('boxTemplateHide');
                
                switch($id){
                    case 'materiaFrente':
                        $url = $baseUrl + 'admin/o-que-fazemos/getcategoria/';
                        $next = 'materiaCategoria';
                        break;
                    case 'materiaCategoria':
                        $url = $baseUrl + 'admin/o-que-fazemos/getsubcategoria/';
                        $next = 'materiaSubcategoria';
                        break;
                    case 'materiaSubcategoria':
                        $url = $baseUrl + 'admin/o-que-fazemos/getespecificidade/';
                        $next = 'materiaEspecificidade';
                        break;
                    case 'materiaEspecificidade':
                        $('.boxSelectTemplate .bgDisabledSelect').hide();
                        return false;
                }
                
                $this.blur();
                $boxRef.find('.boxLoadingSelect').stop().fadeIn('fast');
                $itens.removeClass('boxSelectShow');
                $itens.find('p.error').hide();
                
                var $ajax = new Ajax($url, undefined, $data);
                $ajax.callbackSuccess = function($data){
                    $('#' + $next).find('option.new').remove();
                    
                    var $html = '';
                    
                    for(var $i = 0, $total = $data.itens.length; $i < $total; $i++){
                        var $elem = $data.itens[$i];
                        $html += ('<option rel="' + $elem.slug + '" class="new" value="' + $elem.id + '">' + $elem.titulo + '</option>');
                    }
                    
                    $('#' + $next).append($html);
                    
                    $boxRef.find('.boxLoadingSelect').stop().fadeOut('fast');
                    
                    var $verifyNext = false;
                    $itens.each(function(){
                        if(!$verifyNext){
                            $(this).addClass('boxSelectShow');   
                        } else {
                            $(this).find('.select option:eq(0)').attr('selected','selected');
                        }
                        
                        if($(this).find('.select').attr('id') == $next){
                            $verifyNext = true;
                        }
                    });
                };
                $ajax.callbackError = function(){
                    $boxRef.find('.boxLoadingSelect').stop().fadeOut('fast');
                    $boxRef.find('p.error').show();
                    
                    $itens.each(function(){
                        var $verifyNext;
                        if($(this).find('.select').attr('id') == $next){
                            $verifyNext = true;
                        }
                        
                        if(typeof $verifyNext != 'undefined' && !$verifyNext){
                            $(this).addClass('boxSelectShow');   
                        } else {
                            $(this).find('.select option:eq(0)').attr('selected','selected');
                        }
                    });
                };
                $ajax.send();
                
            });
            
            $('.boxSelectTemplate select').change(function(){
                var $val = $(this).find('option:selected').attr('rel');
                $('.boxTemplate').addClass('boxTemplateHide');
                $('.boxTemplate .required-ini').removeClass('required error valid');
                
                if($val == ''){
                    return false;
                }
                
                $('#boxTemplate-' + $val).removeClass('boxTemplateHide').hide().fadeIn();
                $('#boxTemplate-' + $val).find('.required-ini').addClass('required');
                
                $(this).blur();
            });
            
            $('.checkbox-tplGray input').change(function(){
                var $boxRef = $(this).closest('.checkbox-tplGray');
                $boxRef.find('label').removeClass('checked');
                $boxRef.find('input:checked').next().addClass('checked');
                
                var $val = $boxRef.find('input:checked').attr('rel');
                
                $('#boxInnerGalImagens').show();
                $('.boxInnerGalImagens').hide();
                $('#boxInnerGalImagens-' + $val).stop().fadeIn('fast');
            });
            
            $('.btnAlbumFlickr').click(function(){
                var $this = $(this);
                var $id = $('#materiaGalOrigemFlickr').val().split('/sets/');
                var $boxRef = $this.closest('.boxInnerGalImagens');
                var $userFlickr = $id[0];
                
                if($id.length == 2){
                    $id = $id[1].split('/');
                    $userFlickr = $userFlickr.split('/photos/')[1];
                    if(typeof $id[0] == undefined){
                        return false;
                    }
                }
                
                $this.addClass('disabled');
               
                var $ajax = new Ajax($baseUrl + 'flickr/getPhotoset/', $boxRef, {'id': $id[0]});
                $ajax.callbackSuccess = function($data){
                    
                    if(!$data.imagens.length){
                        $boxRef.find('p.error').stop().fadeIn('fast');
                        var $waitHide = setTimeout(function(){
                            $boxRef.find('p.error').stop().fadeOut('fast');
                        }, 5000);
                    }
                    
                    $('#idFlickr').val($id[0]);
                    $('#userFlickr').val($userFlickr);
                    
                    var $alvo = $('#boxInnerGalImagens-flickr .boxImgs');
                    var $img = $data.imagens;
                    var $html = '';
                    
                    var $tlt = $img.length + ($img.length > 1 ? ' imagens' : ' imagem');
                    $('h5.totalImgFlickr span').text($tlt);
                    
                    for(var $i = 0, $total = $img.length; $i < $total; $i++){
                        $html += ('<div class="uploadFile">\
                                    <div class="img img-polaroid"><img src="' + $img[$i].url_m + '" alt="' + $img[$i].title + '" /></div>\
                                    <div class="imgInfos">\
                                        <p><span class="titulo">' + $img[$i].title + '</span></p>\
                                    </div>\
                                </div>');
                    }
                    
                    $('#boxInnerGalImagens-flickr .boxInit').hide();
                    $('h5.totalImgFlickr').show();
                    $alvo.prepend($html).fadeIn('fast');
                    
                };
                $ajax.send();
                
                return false;
            });
            
            if($('.btnAlbumFlickr-loadimg').length){
                $('.btnAlbumFlickr').click();
            }
            
            $('.btnExcluirImgFlickr').click(function(){
                $('.dialog-confirm-imagemFlickr').dialog({
                    resizable: false,
                    width: 350,
                    height: 202,
                    modal: true,
                    buttons: {
                        'Sim': function(){
                            $(this).dialog('close');
                            $('#boxInnerGalImagens-flickr .boxImgs').html('<br clear="all" />').hide();
                            $('#boxInnerGalImagens-flickr .boxInit').show();
                            $('h5.totalImgFlickr').hide();
                            $('#idFlickr').val('');
                            $('#materiaGalOrigemFlickr').val();
                        },
                        'Não': function() {
                            $(this).dialog('close');
                        }
                    }
                });
                
                return false;
            });
            
            $('.btnUrlVideo').click(function(){
                var $val = $('#materiaVideoUrl').val();
                
                if($val == ''){
                    return false;
                }
                
                if($val.substr(0, 7) != 'http://'){
                    $('#materiaVideoUrl').val('http://' + $val).removeClass('error');
                    $val = 'http://' + $val;
                }
                
                var $data = testUrlForMedia($val);
                var $embed = '';
                
                $('#boxTemplate-video .boxBtn p.error').hide();
                $('#boxPreviewVideo').find('iframe').remove();
                
                if($data == null){
                    
                    $('#boxTemplate-video .boxBtn p.error').stop().fadeIn('fast');
                    
                    var $waitHide = setTimeout(function(){
                        $('#boxTemplate-video .boxBtn p.error').stop().fadeOut('fast');
                    }, 5000);
                    
                    $('#boxPreviewVideo').slideUp(function(){
                        $('#materiaVideoUrl').removeClass('videoPreview');
                    });
                    
                    $('#materiaVideoId').val('');
                    $('#materiaVideoTipo').val('');
                    
                    return false;
                }
                
                $('#materiaVideoId').val($data.id);
                $('#materiaVideoTipo').val($data.type);
                
                $('.boxLoadingPreview').stop().fadeIn('fast');
               
                if($data.type == 'youtube'){
                    $embed = '<iframe width="500" height="281" src="//www.youtube.com/embed/' + $data.id + '?rel=0" frameborder="0" allowfullscreen></iframe>';
                } else if($data.type == 'vimeo'){
                    $embed = '<iframe src="http://player.vimeo.com/video/' + $data.id + '?byline=0&amp;portrait=0&amp;badge=0&amp;color=c2c2c2" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                }
                
                $('#materiaVideoUrl').addClass('videoPreview');
                
                $('#boxPreviewVideo').slideDown(function(){
                    $('#boxPreviewVideo').append($embed);
                });
                
                var $waitHideLoading = setTimeout(function(){
                    $('.boxLoadingPreview').hide();
                }, 6000);
               
               return false; 
            });
            
            if($('.btnUrlVideo-load').length){
                $('.btnUrlVideo').click();
            }
            
            $('#materiaVideoUrl').blur(function(){
                if($(this).val() == ''){
                    $('#materiaVideoId').val('');
                    $('#materiaVideoTipo').val('');
                }
            });
            
            var $materiaDocTipoPrev = '';
            $('#materiaDocTipo4').change(function(){
                var $val = $(this).val();
                
                if($val == ''){
                    $('#boxOptDoc .bgDisabled').show();
                    $('#boxOptDoc div.uploadFile, #boxOptDoc .boxDocLink').stop().fadeOut('fast');
                    return false;
                }
                
                $('#boxOptDoc .bgDisabled').hide();
                $('#boxOptDoc div.uploadFile').find('.feedback-hide').hide();
                
                if($val == 'link'){
                    $('#boxOptDoc div.uploadFile').hide();
                    $('#boxOptDoc .boxDocLink').stop().fadeIn();
                } else  if($val == 'imagem'){
                    
                    $('#boxOptDoc div.uploadFile .boxBtnUpload').show();
                    $('#boxOptDoc div.uploadFile .boxInfosImg').hide();
                    
                    $('#boxOptDoc .boxDocLink').hide();
                    $('#boxOptDoc div.uploadFile').removeClass('uploadFileDoc').stop().fadeIn('fast');
                    $('#boxOptDoc .itemUploadImg').show();
                    $('#boxOptDoc .itemUploadDoc').hide();
                    $('#boxOptDoc .infoDeleteSuccess').hide();
                    $('#boxOptDoc input.uploadFile').attr('accept', UploadFileData.format.img);
                    
                    $('#materiaDocFile4').attr('rel', 'img');
                    
                } else {
                    
                    $('#boxOptDoc div.uploadFile .boxBtnUpload').show();
                    $('#boxOptDoc div.uploadFile .boxInfosImg').hide();
                    $('#boxOptDoc .itemUploadImg').hide();
                    $('#boxOptDoc .itemUploadDoc').show();
                    $('#boxOptDoc .infoDeleteSuccess').hide();
                    
                    var $accept = '';
                    
                    switch($val){
                        case 'pdf':
                            $accept = UploadFileData.format.pdf;
                            break;
                        case 'doc':
                            $accept = UploadFileData.format.doc;
                            break;
                        case 'xls':
                            $accept = UploadFileData.format.xls;
                            break;
                        case 'ppt':
                            $accept = UploadFileData.format.ppt;
                            break;
                        default:
                            $accept = '.*';
                    };
                    
                    $('#materiaDocFile4').attr('rel', $val);
                    
                    $('#boxOptDoc .boxDocLink').hide();
                    $('#boxOptDoc div.uploadFile').addClass('uploadFileDoc').stop().fadeIn('fast');
                    
                    $('#boxOptDoc input.uploadFile').attr('accept', $accept);
                }
                
                $(this).blur();  
            });
        },
        
        pageGerenciamentoOqueFazemos: function(){
            
            var $formGerenciamento = new Form($('#formGerOquefazemos'));
            $formGerenciamento.callbackSuccess = function($data){
                $('.boxFeedback .label').hide();
                $('.boxFeedback .label-success').stop().fadeIn('fast');
                $('#inputSubmitForm').addClass('disabled');
                $('html,body').animate({ scrollTop: 0 }, 'fast');
            };
            $formGerenciamento.validate();
            
        },
        
        pageGerenciamentoFrentes: function(){
            var $formGerenciamento = new Form($('#formGerFrentes'));
            $formGerenciamento.callbackSuccess = function($data){
                $('.boxFeedback .label').hide();
                $('.boxFeedback .label-success').stop().fadeIn();
                $('#inputSubmitForm').addClass('disabled');
                
                $('html,body').animate({ scrollTop: 0 }, 'fast');
            };
            $formGerenciamento.validate();
        },
        
        pageGerenciamentoCategForm: function(){
            var $formGerenciamento = new Form($('#formGerCategEdit'));
            $formGerenciamento.redirect = $baseUrl + 'admin/o-que-fazemos/gerenciamento/categorias/#' + ($('.form-create').length ? 'item-criado' : 'item-editado');
            $formGerenciamento.validate();
        },
        
        pageGerenciamentoSubCategForm: function(){
            var $formGerenciamento = new Form($('#formGerSubcategEdit'));
            $formGerenciamento.redirect = $baseUrl + 'admin/o-que-fazemos/gerenciamento/subcategorias/#' + ($('.form-create').length ? 'item-criado' : 'item-editado');
            $formGerenciamento.validate();
        },
        
        pageGerenciamentoEspecForm: function(){
            var $formGerenciamento = new Form($('#formGerEspecEdit'));
            $formGerenciamento.redirect = $baseUrl + 'admin/o-que-fazemos/gerenciamento/especificidades/#' + ($('.form-create').length ? 'item-criado' : 'item-editado');
            $formGerenciamento.validate();
        },
        
        pageNoticiaForm: function(){
            $(document).on('change', '.select-filtro-especificidade', function(){
                var $val = $(this).val();
                var $box = $(this).closest('.boxFilterCategs');
                
                if($val == ''){
                    $box.find('.btnAddEspec').addClass('disabled');
                } else {
                    $box.find('.btnAddEspec').removeClass('disabled');
                }
            });
            
            $(document).on('click', '.btnAddEspec', function(){
                var $this = $(this);
                
                if($this.hasClass('disabled')){
                    return false;
                }
                
                var $box = $(this).closest('.boxFilterCategs');
                var $index = parseInt($box.attr('id').split('-')[1]) + 1;
                
                $this.addClass('btnEspecDisabled');
                $box.find('.btnRemoveEspec').removeClass('btnEspecDisabled');
                
                var $clone = $box.clone();
                $clone.find('.btnRemoveEspec').addClass('btnEspecDisabled');
                $clone.find('.btnAddEspec').removeClass('btnEspecDisabled').addClass('disabled');
                $clone.find('.bgDisabledSelect').show();
                $clone.find('.boxSelect:eq(0) .bgDisabledSelect').hide();
                
                $clone.attr('id', $clone.attr('id').replace('-' + ($index - 1), '-' + ($index)));
                
                $clone.find('label').each(function(){
                    if(typeof $(this).attr('for') != 'undefined' && $(this).attr('for').indexOf('-') != -1){
                        $(this).attr('for', $(this).attr('for').replace(/\-(\d+)/, '-' + $index));
                    }
                });
                
                $clone.find('select').each(function(){
                    if(typeof $(this).attr('id') != 'undefined' && $(this).attr('id').indexOf('-') != -1){
                        $(this).attr('id', $(this).attr('id').replace(/\-(\d+)/, '-' + $index));
                    }
                    
                    if(typeof $(this).attr('name') != 'undefined'){
                        $(this).attr('name', $(this).attr('name').replace(/\[(\d+)\]/, '[' + $index + ']'));
                    }
                });
                
                $('#boxNotRelatEspec').append($clone);
                
                return false;
            });
            
            $(document).on('click', '.btnRemoveEspec', function(){
                var $box = $(this).closest('.boxFilterCategs');
                var $espec = $box.find('.select-filtro-especificidade option:selected').text();
                
                $('.dialog-confirm-especificidade p.tlt .name').text($espec);
                
                $('.dialog-confirm-especificidade').dialog({
                    resizable: false,
                    width: 450,
                    height: 210,
                    modal: true,
                    buttons: {
                        'Sim': function(){
                            $(this).dialog('close');
                            $box.fadeOut('fast', function(){
                                $box.remove();
                            });
                        },
                        'Não': function() {
                            $(this).dialog('close');
                        }
                    }
                });
                
                return false;
            });
            
            var $formNot = new Form($('#formNoticia'));
            $formNot.redirect = $baseUrl + 'admin/noticias/#' + ($('.form-create').length ? 'item-criado' : 'item-editado');
            $formNot.validate();
        },
        
        pageNoticiaCategoriaForm: function(){
            var $formCateg = new Form($('#formNoticiaCategoria'));
            $formCateg.redirect = $baseUrl + 'admin/noticias/categorias/#' + ($('.form-create').length ? 'item-criado' : 'item-editado');
            $formCateg.validate();
        },
        
        pageInstitucionalContato: function(){
            var $formInst = new Form($('#formInstitucionalContato'));
            $formInst.callbackSuccess = function($data){
                $('html, body').scrollTop(0);
                $('.label-success-inner').fadeIn('fast');
                var $waitHide = setTimeout(function(){
                    $('.label-success-inner').fadeOut('fast');
                }, 4000);
            };
            $formInst.validate();
        },
        
        pageInstitucional8Frases: function(){
            var $formInst = new Form($('#formInstitucional8Frases'));
            $formInst.callbackSuccess = function($data){
                $('html, body').scrollTop(0);
                $('.label-success-inner').fadeIn('fast');
                var $waitHide = setTimeout(function(){
                    $('.label-success-inner').fadeOut('fast');
                }, 4000);
            };
            $formInst.validate();
        },
        
        pageInstitucionalHistoria: function(){
            var $formInst = new Form($('#formInstitucionalHistoria'));
            $formInst.callbackSuccess = function($data){
                $('html, body').scrollTop(0);
                $('.label-success-inner').fadeIn('fast');
                var $waitHide = setTimeout(function(){
                    $('.label-success-inner').fadeOut('fast');
                }, 4000);
            };
            $formInst.validate();
        },
        
        pageFormCategoria: function(){
            var $formCateg = new Form($('#formCategoriaDesc'));
            var $url;
            
            if($('#formCategoriaDesc').hasClass('page-resultados')){
                $url = $baseUrl + 'admin/institucional/resultados/categorias/#'
            } else if($('#formCategoriaDesc').hasClass('page-transparencia')){
                $url = $baseUrl + 'admin/institucional/transparencia/categorias/#'
            } else if($('#formCategoriaDesc').hasClass('page-resultados-en')){
                $url = $baseUrl + 'admin/english/results/categorias/#'
            } else {
                $url = $baseUrl + 'admin/institucional/equipe/categorias/#'
            }
            
            $formCateg.redirect = $url + ($('.form-create').length ? 'item-criado' : 'item-editado');
            $formCateg.validate();
        },
        
        pageFormEnglishResult: function(){
            var $formInst = new Form($('#formEnglishResult'));
            $formInst.redirect = 'dsafdsfds';
            $formInst.validate();
        },
        
        pageFormTextoIntro: function(){
            var $formCateg = new Form($('#formTextoIntro'));
            var $url;
            
            if($('#formTextoIntro').hasClass('page-parceiros')){
                $url = $baseUrl + 'admin/institucional/parceiros/#item-texto-editado';
            } else if($('#formTextoIntro').hasClass('page-resultados')){
                $url = $baseUrl + 'admin/institucional/resultados/#item-texto-editado';
            } else if($('#formTextoIntro').hasClass('page-transparencia')){
                $url = $baseUrl + 'admin/institucional/transparencia/#item-texto-editado';
            } else if($('#formTextoIntro').hasClass('page-oportunidades')){
                $url = $baseUrl + 'admin/institucional/oportunidades/#item-texto-editado';
            } else if($('#formTextoIntro').hasClass('page-resultados-en')){
                $url = $baseUrl + 'admin/english/results/#item-texto-editado';
            } else {
                $url = $baseUrl + 'admin/institucional/equipe/#item-texto-editado';
            }
            
            $formCateg.redirect = $url;
            $formCateg.validate();
        },
        
        pageFormEquipe: function(){
            var $formCateg = new Form($('#formEquipe'));
            var $url;
            
            if($('#formEquipe').hasClass('page-resultados')){
                $url = $baseUrl + 'admin/institucional/resultados/#';
            } else if($('#formEquipe').hasClass('page-transparencia')){
                $url = $baseUrl + 'admin/institucional/transparencia/#';
            } else if($('#formEquipe').hasClass('page-oportunidades')){
                $url = $baseUrl + 'admin/institucional/oportunidades/#';
            } else if($('#formEquipe').hasClass('page-resultados-en')){
                $url = $baseUrl + 'admin/english/results/#';
            } else {
                $url = $baseUrl + 'admin/institucional/equipe/#';
            }
            
            $formCateg.redirect = $url + ($('.form-create').length ? 'item-criado' : 'item-editado');
            $formCateg.validate();
        },
        
        pageFormParceiros: function(){
            var $formCateg = new Form($('#formParceiros'));
            $formCateg.redirect = $baseUrl + 'admin/institucional/parceiros/#' + ($('.form-create').length ? 'item-criado' : 'item-editado');
            $formCateg.validate();
        },
        
        pageFormResultados: function(){
            var $formInst = new Form($('#formResultados'));
            $formInst.redirect = 'dsafdsfds';
            $formInst.validate();
        },
        
        pageFormTransparencia: function(){
            var $formInst = new Form($('#formTransparencia'));
            $formInst.redirect = 'dsafdsfds';
            $formInst.validate();
        },
        
        pageFormOportunidades: function(){
            var $formInst = new Form($('#formOportunidades'));
            $formInst.redirect = 'dsafdsfds';
            $formInst.validate();
        },

        sortAssuntos: function(){
            var $elemRadio = [];

            $('.sortable').sortable({
                revert: true,
                placeholder: 'ui-state-highlight',
                start: function(e, ui){
                    /*$elemRadio = [];

                    $('.boxTarget').each(function(){
                        $(this).find('input:radio').each(function($i){
                            $elemRadio[$i] = {
                                id: $(this).attr('id'),
                                checked: $(this).prop('checked')
                            }
                        });
                    });*/
                },
                update: function(e, ui){
                    /*if($elemRadio.length){
                        for(var $i = 0, $total = $elemRadio.length; $i < $total; $i++){
                            if($elemRadio[$i].checked){
                                console.log($elemRadio[$i].checked);
                                $('#' + $elemRadio[$i].id).prop('checked', true);
                            }
                        }
                    }*/

                    $('.boxTarget').each(function(){
                        $(this).find('.boxItem-sort').each(function($index){
                            var $elem = $(this);
                            $elem.attr('rel', $elem.attr('rel').replace(/\-(\d+)/, '-' + $index));
                            $elem.find('label').each(function(){
                                if(typeof $(this).attr('for') != 'undefined' && $(this).attr('for').indexOf('-') != -1){
                                    $(this).attr('for', $(this).attr('for').replace(/\-(\d+)/, '-' + $index));
                                }
                            });
                            
                            $elem.find('input, select, textarea').each(function(){
                                if(typeof $(this).attr('id') != 'undefined' && $(this).attr('id').indexOf('-') != -1){
                                    $(this).attr('id', $(this).attr('id').replace(/\-(\d+)/, '-' + $index));
                                }
                                
                                if(typeof $(this).attr('name') != 'undefined'){
                                    $(this).attr('name', $(this).attr('name').replace(/\[(\d+)\]/, '[' + $index + ']'));
                                }
                            });
                        });
                    });
                }
            });

            // sort-inner
            
            $('.sortable-respotas').sortable({
                revert: true,
                placeholder: 'ui-state-highlight'
            });
        },
        
        btnItemInst: function(){
                
            //PageMethods.sortAssuntos();

            $('.boxItemInst-email input').removeClass('required');
            $('.boxItemInst-email:first input').addClass('required');

            $(document).on('click', '.btnAddInst', function(){
                var $this = $(this);
                var $box = $this.closest('.boxItemInst');
                var $boxParent = $this.closest('.tplGray .boxTarget');
                var $index = parseInt($boxParent.find('.boxItemInst:last').attr('rel').split('-')[1]);

                if($boxParent.find('.boxItemInst-pesquisa').length){
                    $index = parseInt($boxParent.find('.boxItemInst-pesquisa:last').attr('rel').split('-')[1]);
                }
               
                $this.addClass('btnEspecDisabled');
                $box.find('.btnRemoveInst:last').removeClass('btnEspecDisabled');
                
                var $clone = $box.clone();
                $clone.attr('rel', $clone.attr('rel').replace(/\-(\d+)/, '-' + ($index + 1)));
                $clone.find('.form').val('');
                $clone.find('.btnAddInst:last').removeClass('btnEspecDisabled');
                $clone.find('.btnRemoveInst:last').addClass('btnEspecDisabled');
                $index++;
                
                if(! $(this).hasClass('btnAddInst-nocount')){

                    $clone.find('label').each(function(){
                        if(typeof $(this).attr('for') != 'undefined' && $(this).attr('for').indexOf('-') != -1){
                            $(this).attr('for', $(this).attr('for').replace(/\-(\d+)/, '-' + $index));
                        }
                    });
                    
                    $clone.find('input, select').each(function(){
                        if(typeof $(this).attr('id') != 'undefined' && $(this).attr('id').indexOf('-') != -1){
                            $(this).attr('id', $(this).attr('id').replace(/\-(\d+)/, '-' + $index));
                        }
                        
                        if(typeof $(this).attr('name') != 'undefined'){
                            $(this).attr('name', $(this).attr('name').replace(/\[(\d+)\]/, '[' + $index + ']'));
                        }
                    });

                }

                if($clone.find('.boxOpcoes').length){
                    $clone.find('.boxOpcoes').hide();
                }

                if($clone.find('.boxRespostas').length){
                    $clone.find('.boxRespostas').hide();
                }

                if($clone.find('.checkComplemento-2').length){
                    var $name = $clone.find('.checkComplemento-2').attr('name');
                    $clone.find('input[name="' + $name + '"]').removeClass('checked');

                    $clone.find('.checkComplemento-2').addClass('checked');
                    $clone.find('.checkComplemento-2').prop('checked', true);
                    $clone.find('.boxComplemento').hide();
                }

                if($clone.find('.checkRequired2').length){
                    var $name = $clone.find('checkRequired2').attr('name');
                    $clone.find('input[name="' + $name + '"]').removeClass('checked');

                    $clone.find('.checkRequired2').addClass('checked');
                    $clone.find('.checkRequired2').prop('checked', true);
                }

                if($clone.find('.boxItemRespInner .boxItemInst').length > 1){
                    $clone.find('.boxItemRespInner .boxItemInst').each(function($i){
                        if($i){
                            $(this).remove();
                        } else {
                            $(this).find('.btnRemoveInst').addClass('btnEspecDisabled');
                            $(this).find('.btnAddInst').removeClass('btnEspecDisabled');
                        }
                    })
                }
                
                $boxParent.append($clone);

                if($clone.find('.tipoPesquisa').length){
                    $clone.find('.tipoPesquisa').focus();
                }

                //PageMethods.maskTel();
                
                //PageMethods.sortAssuntos();
                
                if($boxParent.hasClass('tplGrayAssuntos')){
                    $clone.find('input.form').focus();
                }

                $('.boxItemInst-email input').removeClass('required');
                $('.boxItemInst-email:first input').addClass('required');
                
                return false;
            });
            
            $(document).on('click', '.btnRemoveInst', function(){
                var $box = $(this).closest('.boxItemInst');
                /*var $name = $box.find('.input-name').val();
                
                $('.dialog-confirm-acessoria p.tlt .name').text($name);*/
                
                $('.dialog-confirm-acessoria').dialog({
                    resizable: false,
                    width: 450,
                    height: 210,
                    modal: true,
                    buttons: {
                        'Sim': function(){
                            $(this).dialog('close');
                            $box.fadeOut('fast', function(){
                                $box.remove();
                                $('.boxItemInst-email input').removeClass('required');
                                $('.boxItemInst-email:first input').addClass('required');
                                //PageMethods.sortAssuntos();
                            });
                        },
                        'Não': function() {
                            $(this).dialog('close');
                        }
                    }
                });
                
                return false;
            });
        },
        
        sortableImgsGal: function(){


            $('.sortable').sortable({
                revert: true,
                placeholder: 'ui-state-highlight',
                forcePlaceholderSize: true,
                update: function(event, ui){
                    $('.sortable div.uploadFile-mult').each(function($index){
                        var $this = $(this);
                        
                        $this.find('label').each(function(){
                            if(typeof $(this).attr('for') != 'undefined' && $(this).attr('for').indexOf('-') != -1){
                                $(this).attr('for', $(this).attr('for').replace(/\-(\d+)/, '-' + $index));
                            }
                        });
                        
                        $this.find('input, textarea').each(function(){
                            if(typeof $(this).attr('id') != 'undefined' && $(this).attr('id').indexOf('-') != -1){
                                $(this).attr('id', $(this).attr('id').replace(/\-(\d+)/, '-' + $index));
                            }
                            
                            if(typeof $(this).attr('name') != 'undefined'){
                                $(this).attr('name', $(this).attr('name').replace(/imagem\[(\d+)\]/, 'imagem[' + $index + ']'));
                                $(this).attr('name', $(this).attr('name').replace(/\[imagem\]\[(\d+)\]/, '[imagem][' + $index + ']'));
                            }
                        });

                        $this.find('.checkbox input').each(function(){
                            if($(this).hasClass('checked')){
                                $(this).prop('checked', true);
                            }
                        });
                    
                    });
                    
                }


            });
            //$('.sortable').disableSelection();

            $('.sortable').sortable( "option", "tolerance", "pointer" );

            if($('.sortable').hasClass('boxTarget-full')){
                $('.sortable').sortable("option", "axis", "y");
            }
        },
        
        btnUpload: function(){
            
            //PageMethods.sortableImgsGal();
            
            $(document).on('mouseenter', 'input.uploadFile', function(){
                $(this).closest('.boxBtnUpload').find('.btnUploadFile').addClass('active');
            }).on('mouseleave', 'input.uploadFile', function(){
                $(this).closest('.boxBtnUpload').find('.btnUploadFile').removeClass('active');
            }).on('change', 'input.uploadFile', function(){
                var $this = $(this);
                var $containner = $this.closest('div.uploadFile');
                $('.infoLoadingError').hide();
                
                $containner.find('.btnUploadFile').addClass('disabled');
                $containner.find('.boxLoadingFile').stop().fadeIn('fast');
                $containner.find('.infoLoading').show();
                
                $containner.find('.infoLoadingError').click(function(){
                    $(this).stop().fadeOut('fast', function(){
                        $(this).remove();
                    });
                });
                
                var $fileUpload = new UploadFile($this);
                $fileUpload.callbackSucess = function($data){
                    
                    if($data.status == 'error'){
                        $containner.find('.btnUploadFile').removeClass('disabled');
                        $containner.find('.boxLoadingFile').stop().hide();
                        $containner.find('.infoLoading').hide();
                        $containner.find('.infoLoadingError').text($data.info);
                        $containner.find('.infoLoadingError').stop().fadeIn('fast');
                        return false;
                    }

                    if($containner.hasClass('uploadFileDoc')){
                        if($('.select-docTipo').length){
                            var $tipo = $('.select-docTipo').val();
                            $data.img = $baseUrl + 'assets/_admin/img/';
                            
                            switch($tipo){
                                case 'pdf':
                                    $data.img += 'icone-pdf.jpg';
                                    break;
                                case 'doc':
                                    $data.img += 'icone-doc.jpg';
                                    break;
                                case 'xls':
                                    $data.img += 'icone-xls.jpg';
                                    break;
                                case 'ppt':
                                    $data.img += 'icone-ppt.jpg';
                                    break;
                                default:
                                    $data.img += 'interrogacao.jpg';
                            }
                        } else {
                            $data.img = $baseUrl + 'assets/_admin/img/interrogacao.jpg';
                        }
                        
                        if($containner.hasClass('uploadFileDocLink')){
                            $containner.find('.nome').html('<a href="' + $baseUrl + 'upload/file/' + $data.nome + '" target="_blank">' + $data.nome + '</a>');
                        } else {
                            $containner.find('.nome').text($data.nome);    
                        }
                        
                        $data.fileUploaded = $data.nome;
                    } else {
                        
                        $data.fileUploaded = $data.img;
                        $data.img = $baseUrl + 'upload/img/' + $data.img;
                        $containner.find('.tamanho').text($data.tamanho);

                        initJcrop($data.base_w, $data.base_h, $data.img, $data.img_w, $data.img_h,
                            function($remove, $compData){
                                if(typeof $compData != 'undefined'){
                                    $data.tamanho = $compData.tamanho;
                                    $data.formato = $compData.formato;
                                    $data.peso = $compData.peso;
                                    $data.img = $baseUrl + 'upload/img/' + $compData.img;
                                }

                                insertImgUpload($containner, $data, $remove);
                            }
                        );
                    }
                    
                    $containner.find('.formato').text($data.formato);
                    $containner.find('.peso').text($data.peso);
                    
                    if($containner.hasClass('uploadFileDoc')){
                        insertImgUpload($containner, $data);
                    }

                };
                $fileUpload.callbackError = function($data){
                    
                    $containner.find('.btnUploadFile').removeClass('disabled');
                    $containner.find('.boxLoadingFile').stop().hide();
                    $containner.find('.infoLoading').hide();
                    $containner.find('.infoLoadingError').text($data.info);
                    $containner.find('.infoLoadingError').stop().fadeIn('fast');
                };
                $fileUpload.send();
            });
            
            $(document).on('click', '.btnDeleteFile', function(){
                var $this = $(this);
                var $containner = $(this).closest('div.uploadFile');
                var $img = $containner.find('.boxInfosImg .img img').clone();
                var $dialog;
                
                $img.addClass('img-polaroid');                
                
                if($img.hasClass('delete')){
                    deleteImgUpload($this, $containner, $img);
                    return false;
                }

                if($containner.hasClass('uploadFileDoc')){
                    var $arquivo = $containner.find('.nome').text();
                    $dialog = $('.dialog-confirm-imagemDoc');
                    $dialog.find('em').text($arquivo);
                } else {
                    $dialog = $('.dialog-confirm-imagem');
                }
                
                $dialog.find('.img').html('').wrapInner($img);
                
                $dialog.dialog({
                    resizable: false,
                    width: 400,
                    height: 300,
                    modal: true,
                    buttons: {
                        'Sim': function(){
                            $(this).dialog('close');

                            deleteImgUpload($this, $containner, $img);
                            
                        },
                        'Não': function() {
                            $(this).dialog('close');
                        }
                    }
                });
                return false;
            });
            
        },
        
        btnDate: function(){
            
            $.datepicker.regional['pt-BR'] = {
                closeText: 'Fechar',
                prevText: '&#x3c;Anterior',
                nextText: 'Pr&oacute;ximo&#x3e;',
                currentText: 'Hoje',
                monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
                'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
                'Jul','Ago','Set','Out','Nov','Dez'],
                dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
            
            $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
            
            $('input.data').mask('99/99/9999');
            
            $('input.data').each(function(){
                var $config = {};
                
                if($(this).hasClass('data-limit')){
                    //$config.maxDate = new Date;
                    
                    if($(this).hasClass('data-limit-min')){
                        var $dateMin, $dia, $mes, $ano;
                        
                        var $dateMin = $(this).attr('data-min').split('-');
                        $dia = parseInt($dateMin[0]);
                        $mes = parseInt($dateMin[1]) - 1;
                        $ano = parseInt($dateMin[2]);
                        
                        $config.minDate = new Date($ano, $mes, $dia);
                    }

                    if($(this).hasClass('data-limit-max')){
                        var $dateMin, $dia, $mes, $ano;
                        
                        var $dateMin = $(this).attr('data-max').split('-');
                        $dia = parseInt($dateMin[0]);
                        $mes = parseInt($dateMin[1]) - 1;
                        $ano = parseInt($dateMin[2]);
                        
                        $config.maxDate = new Date($ano, $mes, $dia);
                    }
                    
                }
                
                $(this).datepicker($config);
            });
        
        },
        
        btnsList: function(){
            
            $('.btnExcluir').click(function(){
                var $this = $(this);
                var $dialog = $('.dialog-confirm');
                var $name = $this.closest('tr').find('.name').text();
                var $url = $this.attr('href');
                
                $dialog.find('p .name').text('"' + $name + '"');
                
                $('.dialog-confirm-excluir').dialog({
                    resizable: false,
                    height: 280,
                    modal: true,
                    buttons: {
                        'Sim': function(){
                            $(this).dialog('close');
                            $this.addClass('disabled');
                            
                            var $send = new Ajax($url, $this.closest('tr'));
                            $send.method = 'POST';
                            $send.callbackSuccess = function(){
                                $this.removeClass('disabled');
                                $('.boxFeedback .label').hide();
                                $('.boxFeedback .label-success-excluir').fadeIn('fast');
                                $this.closest('tr').find('td').fadeOut('slow', function(){
                                    $this.closest('tr').remove();
                                });
                                var $waitHide = setTimeout(function(){
                                    $('.boxFeedback .label').stop().fadeOut('fast');
                                }, 5000);
                            };
                            $send.callbackError = function(){
                                $this.removeClass('disabled');
                                $('.boxFeedback .label').hide();
                                $('.boxFeedback .label-error').fadeIn('fast');
                                var $waitHide = setTimeout(function(){
                                    $('.boxFeedback .label').stop().fadeOut('fast');
                                }, 5000);
                            };
                            $send.send();
                        },
                        'Não': function() {
                            $(this).dialog('close');
                        }
                    }
                });
                
                return false;
            });
            
            $('.boxFeedback span').click(function(){
                $(this).fadeOut('fast');
            });
        },
        
        initTinyMce: function(){
            require(['tinymce/jquery.tinymce.min'], function(){
                $('.tinyMce').each(function(){
                    var $this = $(this);
                    var $plugins = [];
                    var $toolbars = [];

                    if($this.hasClass('tinyMce-min')){
                        $plugins = ["autolink link", "paste"];
                        $toolbars =  "undo redo wordcount | bold italic | alignleft aligncenter alignright alignjustify | link";
                    } else {
                        $plugins = [
                            "table wordcount advlist autolink lists link image charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime image media table contextmenu paste filemanager"
                        ];
                        $toolbars =  "insertfile undo redo table wordcount |  | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image";
                    }

                    $(this).tinymce({
                        relative_urls: false,
                        remove_script_host: false,
                        convert_urls: true,
                        script_url : $baseUrl + 'assets/_admin/js/tinymce/tinymce.min.js?_v7',
                        theme : 'modern',
                        height: $this.attr('data-height') != undefined ? $this.attr('data-height') : '460px',
                        language: 'pt_BR',
                        content_css: $baseUrl + 'assets/_admin/css/style.tinymce.css?_v10',
                        style_formats: [
                            {title: 'Prêmios - Publico em...', inline: '', classes: 'data-premios'},
                            /*{title: 'Texto laranja e negrito', inline: 'span', classes: 'text-orange'},
                            {title: 'Texto verde e negrito', inline: 'span', classes: 'text-green'},
                            {title: 'Texto branco e fundo cinza', block: 'p', classes: 'box-color box-gray'},
                            {title: 'Texto branco e fundo azul escuro', block: 'p', classes: 'box-color box-darkblue'},
                            {title: 'Texto branco e fundo azul claro', block: 'p', classes: 'box-color box-lightblue'},
                            {title: 'Texto branco e fundo laranja', block: 'p', classes: 'box-color box-orange'},
                            {title: 'Texto branco e fundo verde', block: 'p', classes: 'box-color box-green'}*/
                        ],
                        /*formats: {
                            alignleft: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'left'},
                            aligncenter: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'center'},
                            alignright: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'right'},
                            alignfull: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'full'}
                        },*/
                        plugins: $plugins,
                        image_advtab: true,
                        toolbar: $toolbars
                    });
                });
            });
        },
        
        btnAddCateg: function(){
            $('.btnAddCategoria').click(function(){
                $(this).hide();
                $('.boxContBtnCateg').stop().fadeIn('fast');
                $('#addCategoria, #addCategoria1, #addCategoria2').stop().fadeIn('fast', function(){
                    $('#addCategoria, #addCategoria1').focus();
                });
                return false;  
            });
            
            $('.btnOkAddCateg').click(function(){
                var $this = $(this);
                var $val, $val1, $val2;
                
                if($this.hasClass('categEn')){
                    $val1 = $('#addCategoria1').val();
                    $val2 = $('#addCategoria2').val();
                    
                    if($val1 == ''){
                        $('#addCategoria1').focus();
                        return false;
                    }
                    
                    if($val2 == ''){
                        $('#addCategoria2').focus();
                        return false;
                    }
                    
                } else if($this.hasClass('categResult')){
                    $val1 = $('#addCategoria1').val();
                    $val2 = $('#addCategoria2').val();
                    
                    if($val1 == ''){
                        $('#addCategoria1').focus();
                        return false;
                    }
                    
                    if($val2 == ''){
                        $('#addCategoria2').focus();
                        return false;
                    }
                    
                } else if($this.hasClass('categTransp')){
                    $val1 = $('#addCategoria1').val();
                    $val2 = $('#addCategoria2').val();
                    
                    if($val1 == ''){
                        $('#addCategoria1').focus();
                        return false;
                    }
                    
                    if($val2 == ''){
                        $('#addCategoria2').focus();
                        return false;
                    }
                    
                } else {
                    $val = $('#addCategoria').val();
                    
                    if($val == ''){
                        $('#addCategoria').focus();
                        return false;
                    }
                    
                }
                
                var $box = $(this).closest('.boxAddCateg');
                var $data, $ajaxUrl;
                
                if($this.hasClass('categEn')){
                    $data = {tituloPt: $val1, tituloEn: $val2};
                    $ajaxUrl = $baseUrl + 'admin/institucional/equipe/categorias/create/';
                } else if($this.hasClass('categResult')){
                    $data = {titulo: $val1, descricao: $val2};
                    $ajaxUrl = $baseUrl + 'admin/institucional/resultados/categorias/create/';
                } else if($this.hasClass('categTransp')){
                    $data = {titulo: $val1, descricao: $val2};
                    $ajaxUrl = $baseUrl + 'admin/institucional/transparencia/categorias/create/';
                } else {
                    $data = {titulo: $val};
                    $ajaxUrl = $baseUrl + 'admin/noticias/categorias/create/';
                }
                
                if($('#itemLang').length){
                    $data.language = $('#itemLang').val();
                }
                
                $this.addClass('disabled');
                $box.find('.bgDisabledCateg').show();
                $box.find('.boxLoadingCateg').stop().fadeIn('fast');
                
                var $ajax = new Ajax($ajaxUrl, undefined, $data);
                $ajax.callbackSuccess = function($data){
                    var $itensCateg = $('#noticiaCategoria option');
                    
                    for(var $i = 1, $total = $itensCateg.length; $i <= $total; $i++){
                        var $tltItem;
                        
                        if($this.hasClass('categEn')){
                            $tltItem = $data.tituloPt;
                        } else {
                            $tltItem = $data.titulo;
                        }
                        
                        if($tltItem.toLowerCase() < $itensCateg.eq($i).text().toLowerCase()){
                            $('<option value="' + $data.id + '">' + ($this.hasClass('categEn') ? $data.tituloPt + ' / ' + $data.tituloEn : $data.titulo) + '</option>').insertBefore($itensCateg.eq($i));
                            $('#noticiaCategoria').prop('selectedIndex', $i);
                            break;
                        } else if($total - $i == 1){
                            $('<option value="' + $data.id + '">' + ($this.hasClass('categEn') ? $data.tituloPt + ' / ' + $data.tituloEn : $data.titulo) + '</option>').insertAfter($itensCateg.eq($i));
                            $('#noticiaCategoria').prop('selectedIndex', $i + 1);
                            break;
                        }
                    }
                    
                    $box.find('.bgDisabledCateg, .boxLoadingCateg').hide();
                    $this.removeClass('disabled');
                    
                    $('#addCategoria, #addCategoria1, #addCategoria2, .boxContBtnCateg').hide();
                    $('#addCategoria, #addCategoria1, #addCategoria2').val('');
                    $('.btnAddCategoria').stop().fadeIn('fast');
                };
                $ajax.callbackError = function($data){
                    $this.removeClass('disabled');
                    $box.find('.bgDisabledCateg').hide();
                    $box.find('.boxLoadingCateg').hide();
                };
                $ajax.send();
                
                return false;
            });
        },
        
        btnLoadCategs: function(){
            $(document).on('change', '.boxFilterCategs select', function(){
                var $this = $(this);
                var $box = $this.closest('.boxFilterCategs');
                var $boxRef = $this.closest('.boxSelect');
                var $itens = $box.find('.boxSelect');
                var $id;
                
                $box.find('p.error').hide();
                
                if($box.hasClass('box-mult')){
                    $id = $this.attr('rel');
                } else {
                    $id = $this.attr('id');
                }
                
                var $val = $this.val();
                var $data = {'id': $val};
                
                var $url, $next;
                
                $box.find('.bgDisabledSelect').show();
                
                switch($id){
                    case 'filtroFrente':
                        $url = $baseUrl + 'admin/o-que-fazemos/getcategoria/';
                        $next = 'filtroCategoria';
                        break;
                    case 'filtroCategoria':
                        $url = $baseUrl + 'admin/o-que-fazemos/getsubcategoria/';
                        $next = 'filtroSubcategoria';
                        break;
                    case 'filtroSubcategoria':
                        $url = $baseUrl + 'admin/o-que-fazemos/getespecificidade/';
                        $next = 'filtroEspecificidade';
                        break;
                    case 'filtroEspecificidade':
                        $box.find('.bgDisabledSelect').hide();
                }
                
                if(typeof $url != 'undefined'){
                    $this.blur();
                    var $compare;
                    
                    if($box.hasClass('box-mult')){
                        $compare = !$box.find('select[rel="' + $next + '"]').length;
                    } else {
                        $compare = !$box.find('#' + $next).length;
                    }
                    
                    if($compare){
                        $box.find('.bgDisabledSelect').hide();
                    } else {
                        $boxRef.find('.boxLoadingSelect').stop().fadeIn('fast');
                        $itens.removeClass('boxSelectShow');
                        $itens.find('p.error').hide();
                        
                        var $ajax = new Ajax($url, undefined, $data);
                        $ajax.callbackSuccess = function($data){
                            var $elemItem;
                            
                            if($box.hasClass('box-mult')){
                                $elemItem = $box.find('select[rel="' + $next + '"]');
                            } else {
                                $elemItem = $('#' + $next);
                            }
        
                            $elemItem.find('option.new').remove();
                            
                            var $html = '';
                            
                            if(!$data.itens.length){
                                
                                if($box.hasClass('box-mult')){
                                    $next = $this.attr('rel');
                                } else {
                                    $next = $this.attr('id');
                                }
                                
                            } else {
                                for(var $i = 0, $total = $data.itens.length; $i < $total; $i++){
                                    var $elem = $data.itens[$i];
                                    $html += ('<option rel="' + $elem.slug + '" class="new" value="' + $elem.id + '">' + $elem.titulo + '</option>');
                                }
        
                                $elemItem.append($html);
                            }
                            
                            $boxRef.find('.boxLoadingSelect').stop().fadeOut('fast');
                            
                            var $verifyNext = false;
                            $itens.each(function(){
                                if(!$verifyNext){
                                    $(this).addClass('boxSelectShow');
                                    $(this).closest('.boxSelect').find('.bgDisabledSelect').hide();
                                } else {
                                    $(this).find('select option:eq(0)').attr('selected','selected');
                                }
                                
                                if($(this).find('select').attr('id') == $next || $(this).find('select').attr('rel') == $next){
                                    $verifyNext = true;
                                }
                            });
                        };
                        $ajax.callbackError = function(){
                            var $verifyNext;
                            $boxRef.find('.boxLoadingSelect').stop().fadeOut('fast');
                            $boxRef.find('.error').show();
                            
                            $itens.each(function(){
                                if($(this).find('select').attr('id') == $next){
                                    $verifyNext = true;
                                }
                                
                                if(typeof $verifyNext != 'undefined' && !$verifyNext){
                                    $(this).addClass('boxSelectShow');   
                                } else {
                                    $(this).find('.select option:eq(0)').attr('selected','selected');
                                }
                            });
                        };
                        $ajax.send();
                    }
                }
                
            });
        },
        
        maskTel: function(){
            require(['jquery.meio.mask.min', 'jquery.masktelsp'], function(){
                $('.tel').maskTelSp({ type: 'fixo' });
            });
        }
        
    };
    
    function Form($form){
    $.validator.setDefaults({
        ignore: []
    });

    if(typeof $form != 'undefined'){
        this.form = $form;
    }

    this.redirect = null;
    this.callbackSuccess = null;
    this.callbackError = null;
    this.method = 'POST'

    this.validate = function(){
        $.validator.addMethod("verificaCPF", function(value, element) {
        value = value.replace('.', '');
        value = value.replace('.', '');
        cpf = value.replace('-', '');
        while (cpf.length < 11)
        cpf = "0" + cpf;
        var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
        var a = [];
        var b = new Number;
        var c = 11;
        for ( i = 0; i < 11; i++) {
            a[i] = cpf.charAt(i);
            if (i < 9)
                b += (a[i] * --c);
        }
        if (( x = b % 11) < 2) {
            a[9] = 0
        } else {
            a[9] = 11 - x
        }
        b = 0;
        c = 11;
        for ( y = 0; y < 10; y++)
            b += (a[y] * c--);
        if (( x = b % 11) < 2) {
            a[10] = 0;
        } else {
            a[10] = 11 - x;
        }
        if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg))
            return false;
        return true;
    }, "Informe um CPF válido.");
    
    $.validator.addMethod("dataExpiracao", function(value, element){
        var $data = value.split('/');
        if($data.length != 3){
        return false;
        }
        
        var $dia = $data[0];
        var $mes = $data[1];
        var $ano = $data[2];
        
        if(isNaN($dia) || isNaN($mes) || isNaN($ano)){
        return false;
        }
        
        var $d = new Date($ano + '/' + $mes + '/' + $dia + ' 23:59:59');
        var $time = $d.getTime();
        var $timeMin = $('#dateMin').val() * 1000;
        var $timeMax = $('#dateMax').val() * 1000;
        
        return $time > $timeMin && $time <= $timeMax;
        
    }, 'Data inválida.');
        
        if(typeof this.form == 'undefined'){
            return false;
        }

        var $obj = this;
        var $form = this.form;

        $form.validate({ errorContainer: $form.find('.msgForm p.aviso'), errorLabelContainer: $form.find('.msgErrorLabel'),
            submitHandler: function(){
                $form.find('.bgDisabledForm, .bgDisabled').show();
                $form.find('.boxLoading, .imgLoading, p.load, span.load').stop().fadeIn('fast');
                $form.find('p.error, p.erro, p.error, p.erroServer, .boxErrorServer').hide();
                $form.find('.btnSubmit').addClass('disabled');

                var $waitForm = setTimeout(function(){
                    $.ajax({
                        type: $obj.method,
                        data: $form.serialize(),
                        dataType: 'json',
                        url: $form.attr('action'),
                        cache: false,
                        success: function(json){
                            $('.inputToken').val(json.token);

                            if(json != null && json.status == 'ok'){

                                if($obj.redirect == null){
                                    $form.find('.bgDisabledForm, .bgDisabled').hide();
                                    $form.find('.boxLoading, .imgLoading, p.load, span.load').stop().fadeOut('fast', function(){
                                        $form.find('.btnSubmit').removeClass('disabled');
                                    });
                    $form.find('p.sucesso').fadeIn();

                                } else {
                                    window.location = $obj.redirect;
                                    return false;
                                }

                                if($obj.callbackSuccess != null){
                                    $obj.callbackSuccess(json);
                                }

                            } else {

                                $form.find('.bgDisabledForm, .bgDisabled').hide();
                                $form.find('.boxLoading, .imgLoading, p.load, span.load').stop().fadeOut('fast', function(){
                                    $form.find('.btnSubmit').removeClass('disabled');
                                });
                
                showErrorsForm($form, json);

                                $form.find('.boxErrorServer, p.erro').fadeIn('fast');

                                if($obj.callbackError != null){
                                    $obj.callbackError(json);
                                }

                            }

                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){

                            $form.find('.bgDisabledForm, .bgDisabled').hide();
                            $form.find('.boxLoading, .imgLoading, p.load, span.load').stop().fadeOut('fast', function(){
                                $form.find('.btnSubmit').removeClass('disabled');
                            });
                            $form.find('.boxErrorServer').fadeIn('fast');
                
                /*if($form.find('p.erro').length){
                    $form.find('p.erro').html('Ocorreu um erro. <a href="javascript:location.reload();">Atualize a página</a> e tente novamente.');
                    $form.find('p.erro').fadeIn();
                }*/

                            if($obj.callbackError != null){
                                $obj.callbackError();
                            }

                        }
                    });
                }, 10);
            },
            highlight : function(element, errorClass, validClass){
                    $(element).addClass(errorClass).removeClass(validClass);
                    $('#sbHolder_' + $(element).attr('sb')).addClass(errorClass).removeClass(validClass);
            },
            unhighlight : function(element, errorClass, validClass) {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $('#sbHolder_' + $(element).attr('sb')).removeClass(errorClass).addClass(validClass);
            },
            ignore: []
        });
    }
};

function Ajax($url, $objRef, $data){

    this.data = {};
    this.callbackSuccess = null;
    this.callbackError = null;
    this.method = 'POST'

    if(typeof $url != 'undefined'){
        this.url = $url;
    }

    if(typeof $objRef != 'undefined'){
        this.objRef = $objRef;
    }

    if(typeof $data != 'undefined'){
        this.data = $data;
    }

    this.send = function(){

        var $obj = this;

        if(typeof this.url == 'undefined'){
            return false;
        }

        if(typeof $obj.objRef != 'undefined'){
            $obj.objRef.find('.bgDisabled, .bgDisabledGal').show();
            $obj.objRef.find('.boxLoading, .boxLoadingGal, p.load, span.load').stop().fadeIn('fast');
            $obj.objRef.find('p.error, p.erro').hide();
        }

        $obj.data.cgm_csrf_token = $('.inputToken').val();

        var $waitAjax = setTimeout(function(){
            
            $.ajax({
                type: $obj.method,
                data: $obj.data,
                dataType: 'json',
                url: $obj.url,
                cache: false,
                success: function(json){
                    if(typeof $obj.objRef != 'undefined'){
                        $obj.objRef.find('.bgDisabled, .bgDisabledGal').hide();
                        $obj.objRef.find('.boxLoading, .boxLoadingGal, p.load, span.load').stop().fadeOut('fast');
                        $obj.objRef.find('button').removeClass('disabled');
                    }
                    
                    
                    if(json != null && json.status == 'ok'){
                        $('.inputToken').val(json.token);
                        if($obj.callbackSuccess != null){
                            $obj.callbackSuccess(json);
                        }

                    } else {

                        $('.inputToken').val(json.token);
                
                        showErrorsForm($obj.objRef, json);

                        if($obj.callbackError != null){
                            $obj.callbackError(json);
                        }

                    }


                },
                error: function(XMLHttpRequest, textStatus, errorThrown){

                    if(typeof $obj.objRef != 'undefined'){
                        $obj.objRef.find('.bgDisabled, .bgDisabledGal').hide();
                        $obj.objRef.find('.boxLoading, .boxLoadingGal, p.load, span.load').stop().fadeOut('fast');
                        $obj.objRef.find('p.error, p.erro').show();
                        $obj.objRef.find('button').removeClass('disabled');
            
            if($obj.objRef.find('p.erro').length){
                $obj.objRef.find('p.erro').html('Ocorreu um erro. <a href="javascript:location.reload();">Atualize a página</a> e tente novamente.');
                $obj.objRef.find('p.erro').fadeIn();
            }
                    }

                    if($obj.callbackError != null){
                        $obj.callbackError();
                    }

                }
            });
        }, 10);

    }
};

function objLength(obj){
    var i=0;
    for (var x in obj){
        if(obj.hasOwnProperty(x)){
            i++;
        }
    }
    return i;
}

function insertImgUpload($containner, $data, $remove){
    if(typeof $remove == 'undefined'){
        $remove = false;
    }

    $containner.find('.tamanho').text($data.tamanho);
    $containner.find('.formato').text($data.formato);
    $containner.find('.peso').text($data.peso);

    $containner.find('.input-tamanho').val($data.tamanho);
    $containner.find('.input-formato').val($data.formato);
    $containner.find('.input-peso').val($data.peso);

    var $img = new Image();
    $img.src = $data.img;
    $img.onload = function(){
        $containner.find('.uploadFile').val('');
        $containner.find('.fileUploaded').val($data.fileUploaded);
        $containner.find('.img').html('').wrapInner($img);
        $containner.find('.btnDeleteFile').attr('rel', $data.fileUploaded + '|' + $data.uploadType);
        
        if(!$remove){
            $containner.find('.btnUploadFile').removeClass('disabled');
            $containner.find('.boxLoadingFile').stop().hide();
            $containner.find('.infoLoading').hide();
            
            $containner.find('.boxBtnUpload').hide();
            $containner.find('.boxInfosImg').fadeIn('fast');
        } else {
            //$containner.find('.img img').addClass('delete');
            //$containner.find('.btnDeleteFile').click();
        }

        $containner.find('.form-place').each(function(){
            $(this).val($(this).attr('data-placeholder'));
        });
        
        if($containner.hasClass('uploadFile-mult')){
            var $containnerNew = $containner.clone();
            var $index = parseInt($containnerNew.find('label:first').attr('for').split('-')[1]) + 1;
            
            $containnerNew.find('.boxBtnUpload').show();
            $containnerNew.find('.boxLoadingFile, .infoLoading').hide();
            $containnerNew.find('.btnUploadFile').removeClass('disabled');
            $containnerNew.find('.fileUploaded').val('');
            $containnerNew.find('.boxInfosImg').fadeTo(1, 1.0).hide();
            
            $containnerNew.find('label').each(function(){
                if(typeof $(this).attr('for') != 'undefined' && $(this).attr('for').indexOf('-') != -1){
                    $(this).attr('for', $(this).attr('for').replace(/\-(\d+)/, '-' + $index));
                }
            });
            
            $containnerNew.find('input, textarea').each(function(){
                if(typeof $(this).attr('id') != 'undefined' && $(this).attr('id').indexOf('-') != -1){
                    $(this).attr('id', $(this).attr('id').replace(/\-(\d+)/, '-' + $index));
                }
                
                if(typeof $(this).attr('name') != 'undefined'){
                    $(this).attr('name', $(this).attr('name').replace(/\[(\d+)\]/, '[' + $index + ']'));
                }
            });
            
            $containnerNew.insertAfter($containner);
            
            PageMethods.sortableImgsGal();
        }

        if($remove){
            $containner.find('.img img').addClass('delete');
            $containner.find('.btnDeleteFile').click();
        }

        $('body').trigger('heightChange');
    }
    $img.onerror = function(){
        $containner.find('.btnUploadFile').removeClass('disabled');
        $containner.find('.boxLoadingFile').stop().hide();
        $containner.find('.infoLoading').hide();
        
        $containner.find('.infoLoadingError').stop().fadeIn('fast');
    }
}

function deleteImgUpload($this, $containner, $img){
    $this.addClass('disabled');
    $containner.find('.boxLoadingDeleteFile').show();
    $containner.find('.feedback-hide').hide();
    $containner.find('.fileUploaded').val('');
    
    var $configDelete = {
        file: $this.attr('rel').split('|')[0],
        type: $this.attr('rel').split('|')[1]
    };
    
    var $deleteImg = new Ajax($baseUrl + 'admin/upload/delete/', undefined, $configDelete);
    $deleteImg.callbackSuccess = function($data){
        
        if($containner.hasClass('uploadFile-mult')){
            var $itemSelecione = $containner.closest('.boxImgs').find('.boxBtnUpload:visible');
            
            if($itemSelecione.length <= 1){
                $containner.fadeOut('fast', function(){
                    $containner.remove();
                });
            }
        } else {
            $containner.find('.boxInfosImg').hide();
            $this.removeClass('disabled');
            $containner.find('.boxLoadingDeleteFile').hide();
            
            $containner.find('.boxBtnUpload .boxLoadingFile, .infoLoading').hide();
            $containner.find('.btnUploadFile').removeClass('disabled');

            $containner.find('.infoDeleteSuccess').show();
            $containner.find('.boxBtnUpload').fadeIn('fast');
            
            var $waitTime = setTimeout(function(){
                $containner.find('.feedback-hide').stop().fadeOut('fast');
            }, 4000);    
        }
        
    };
    $deleteImg.callbackError = function($data){
        $this.removeClass('disabled');
        $containner.find('.boxLoadingDeleteFile').hide();
        $containner.find('.infoDeleteError').stop().fadeIn('fast');
        
        var $waitTime = setTimeout(function(){
            $containner.find('.feedback-hide').stop().fadeOut('fast');
        }, 4000);
    };
    $deleteImg.send();
}

function cropImg($cropContainner, $callback){
    var $config = {
        x: $cropContainner.find('.x').val(),
        y: $cropContainner.find('.y').val(),
        x2: $cropContainner.find('.x2').val(),
        y2: $cropContainner.find('.y2').val(),
        w: $cropContainner.find('.w').val(),
        h: $cropContainner.find('.h').val(),
        ratio: $cropContainner.find('.ratio').val(),
        img: $cropContainner.find('.img').val(),
        w_base: $cropContainner.find('.w_base').val(),
        h_base: $cropContainner.find('.h_base').val()
    }

    var $cropImg = new Ajax($baseUrl + 'admin/upload/crop/', undefined, $config);
    $cropImg.callbackSuccess = function($data){
        if(typeof $callback != 'undefined'){
            $callback($data);
        }
    };
    $cropImg.callbackError = function($data){
        
        var $containner;

        $('.boxBtnUpload').each(function(){
            if($(this).find('.infoLoading').is(':visible')){
                $containner = $(this);
                return false;
            }
        });

        $containner.find('.btnUploadFile').removeClass('disabled');
        $containner.find('.boxLoadingFile').stop().hide();
        $containner.find('.infoLoading').hide();
        $containner.find('.infoLoadingError').html("Ocorreu um erro no upload. Favor reduzir um pouco o tamanho da imagem.")
        $containner.find('.infoLoadingError').stop().fadeIn('fast');
    }
    $cropImg.send();
}

function initJcrop($w, $h, $img, $imgW, $imgH, $callback){

        $img = $img + '?' + new Date().getTime();
        var $localAppend = $('#boxCrop');

        $localAppend.find('.jcropContent').remove();

        $('#bgCrop, #boxCrop').show();

        var $docW = parseInt($(window).width());
        var $docH = parseInt($(window).height());
        var $docRatio = $docW / $docH;

        var $imgRatio = $imgW / $imgH;
        var $maxW = $docW - 20;
        var $maxH = $docH - 52;

        var $boxCropW, $boxCropH;

        var $imgName = $img.split('/');
        $imgName = $imgName.pop();
        $imgName = $imgName.substr(0, $imgName.indexOf('?'));

        if($docRatio > $imgRatio){
            $boxCropH = $imgH > $maxH ? $maxH : $imgH;
            $boxCropW = Math.round($boxCropH * $imgRatio);
        } else {
            $boxCropW = $imgW > $maxW ? $maxW : $imgW;
            $boxCropH = Math.round($boxCropW / $imgRatio); 
        }

        var $ratioCrop = $boxCropW / $imgW;
        var $htmlImg;
        if($w == 1 && $h == 1){
            $htmlImg = '\
                <div class="jcropContent">\
                <input type="hidden" name="x" class="x" value="" />\
                <input type="hidden" name="y" class="y" value="" />\
                <input type="hidden" name="x2" class="x2" value="" />\
                <input type="hidden" name="y2" class="y2" value="" />\
                <input type="hidden" name="w" class="w" value="" />\
                <input type="hidden" name="h" class="h" value="" />\
                <input type="hidden" name="ratio" class="ratio" value="' + $ratioCrop + '" />\
                <input type="hidden" name="img" class="img" value="' + $imgName + '" />\
                <input type="hidden" name="w_base" class="w_base" value="' + $imgW + '" />\
                <input type="hidden" name="h_base" class="h_base" value="' + $imgH + '" />\
                <div class="boxImg" style="width: ' + $boxCropW + 'px; height: ' + $boxCropH + 'px;">\
                    <img class="jcropTarget" src="' + $img + '" width="' + $boxCropW + '" height="' + $boxCropH + '" />\
                </div>\
                <a class="btnActImg btn btn-success btn-small" id="btnSalvarImg" href="' + $img + '">Salvar</a>\
                <a class="btnActImg btn btn-danger btn-small" id="btnExcluirImg" href="' + $img + '">Cancelar</a>\
                <br clear="all" />\
                </div>\
            ';
        }else{
            $htmlImg = '\
                <div class="jcropContent">\
                <input type="hidden" name="x" class="x" value="" />\
                <input type="hidden" name="y" class="y" value="" />\
                <input type="hidden" name="x2" class="x2" value="" />\
                <input type="hidden" name="y2" class="y2" value="" />\
                <input type="hidden" name="w" class="w" value="" />\
                <input type="hidden" name="h" class="h" value="" />\
                <input type="hidden" name="ratio" class="ratio" value="' + $ratioCrop + '" />\
                <input type="hidden" name="img" class="img" value="' + $imgName + '" />\
                <input type="hidden" name="w_base" class="w_base" value="' + $w + '" />\
                <input type="hidden" name="h_base" class="h_base" value="' + $h + '" />\
                <div class="boxImg" style="width: ' + $boxCropW + 'px; height: ' + $boxCropH + 'px;">\
                    <img class="jcropTarget" src="' + $img + '" width="' + $boxCropW + '" height="' + $boxCropH + '" />\
                </div>\
                <a class="btnActImg btn btn-success btn-small" id="btnSalvarImg" href="' + $img + '">Salvar</a>\
                <a class="btnActImg btn btn-danger btn-small" id="btnExcluirImg" href="' + $img + '">Cancelar</a>\
                <br clear="all" />\
                </div>\
            ';
        }

        $localAppend.html($htmlImg);

        $('#boxCrop').css({ marginTop: '-' + Math.round($('#boxCrop').height() / 2) + 'px', marginLeft: '-' + Math.round($('#boxCrop').width() / 2) + 'px' });

        var $showCoords = function(c){
            $('.jcropContent.selected .x').val(c.x);
            $('.jcropContent.selected .y').val(c.y);
            $('.jcropContent.selected .x2').val(c.x2);
            $('.jcropContent.selected .y2').val(c.y2);
            $('.jcropContent.selected .w').val(c.w);
            $('.jcropContent.selected .h').val(c.h);
        }

        /*if($tipoImg == 'thumb'){
            $ratio = 1.50246;
        } else if($tipoImg == 'thumbBanco') {
            $ratio = 1.1667;
        } else if($tipoImg == 'thumbGaleria'){
            $ratio = 1;
        } else {
            $ratio = 1.5013;
        }*/

        var $ratio = $w / $h;
        
        if($w == 1 && $h == 1){
            $localAppend.find('.jcropTarget').Jcrop({ 
                onChange: $showCoords, 
                onSelect: $showCoords, 
                setSelect: [0, 0, $imgW, $imgH],
                
            }).parents('.jcropContent').addClass('selected');
        }else{
            $localAppend.find('.jcropTarget').Jcrop({ 
                onChange: $showCoords, 
                onSelect: $showCoords, 
                setSelect: [0, 0, Math.round($w * $ratioCrop), Math.round($h * $ratioCrop)],
                aspectRatio: $ratio,
                minSize: [Math.round($w * $ratioCrop), Math.round($h * $ratioCrop)],
            }).parents('.jcropContent').addClass('selected');    
        }
        
        
        /*$('.jcropContent').live('mouseenter', function(){
            $(this).addClass('selected');
        }).live('mouseleave', function(){
            $(this).removeClass('selected');
        });*/

    /*if(typeof $callback != 'undefined'){
        $callback();
    }*/

    //console.log($callback);

    $('#btnExcluirImg').click(function(){
        $('#bgCrop, #boxCrop').fadeOut('fast');
        $callback(true);
        return false;
    });

    $('#btnSalvarImg').click(function(){
        $('#bgCrop, #boxCrop').fadeOut('fast');
        cropImg($localAppend, function($data){
            $callback(false, $data);
        });

        return false;
    });

}
    
    var UploadFileData = {
        format: {
            img: '.jpg,.jpeg,.gif,.png,.tiff',
            pdf: '.pdf',
            doc: '.doc,.docx,.rtf,.odt',
            xls: '.xls,.xlsx,.xml,.csv,.ods',
            ppt: '.ppt,.pptx,.pps,.ppsx,.odp'
        }
    }
    
    function UploadFile($elem){
        this.action = $baseUrl + 'admin/upload/';
        this.elem = $elem;
        this.returnType = 'json';
        this.callbackSucess = null;
        this.callbackError = null;
        this.idForm = '';
        this.idIframe = '';
        
        this.construct = function(){
            if(! $('#boxFormUpload').length){
                $('body').append('<div id="boxFormUpload"></div>');
            }
            
            this.idForm = 'formUpload-' + this.elem.attr('id');
            this.idIframe = 'iframeUpload-' + this.elem.attr('id');

            this.action += (this.elem.attr('rel') + '/');

            if(typeof this.elem.attr('data-width') != 'undefined' && typeof this.elem.attr('data-height') != 'undefined'){
                this.action += (this.elem.attr('data-width') + '/' + this.elem.attr('data-height') + '/');
            }
        }
        
        this.send = function(){
            var $form = $('<form id="' + this.idForm + '" target="' + this.idIframe + '" method="POST" enctype="multipart/form-data" action="' + this.action + '"></form>').appendTo('#boxFormUpload');
            var $iframe = $('<iframe frameborder="0" name="' + this.idIframe + '" id="' + this.idIframe + '"></iframe>').appendTo('#boxFormUpload');
            
            var $containner = this.elem.closest('div.uploadFile');
            var $inputCsrf = $('.inputToken').clone();
            
            this.elem.appendTo('#' + this.idForm);
            
            $('#boxFormUpload form').append($inputCsrf);
            
            //$inputCsrf.appendTo($form);
            
            var $obj = this;
            
            $form.submit(function(){
                $iframe.load(function(){
                    var $data = handleData(this, $obj.returnType);
                   
                    var $waitTime = setTimeout(function(){
                        $iframe.remove();
                        $form.find('input[type="file"]').appendTo($containner.find('.boxBtnUpload'));
                        $form.remove();
                        
                        $containner.find('.boxBtnUpload .btnUploadFile').removeClass('active');
                        $containner.find('.boxBtnUpload .uploadFile').val('');
                        
                        $('.inputToken').val($data.token);
                        
                        if($obj.callbackSucess != null){
                            $obj.callbackSucess($data);
                        }
                    }, 10);
                });
            });
            
            $form.submit();
        },
        
        this.construct();
    }
    
    function handleData(iframe, type) {
		var data, contents = $(iframe).contents().get(0);

		if ($.isXMLDoc(contents) || contents.XMLDocument) {
			return contents.XMLDocument || contents;
		}
		data = $(contents).find('body').html();

		switch (type) {
			case 'xml':
				data = parseXml(data);
				break;
			case 'json':
				data = window.eval('(' + data + ')');
				break;
		}
		return data;
	}

	function parseXml(text) {
		if (window.DOMParser) {
			return new DOMParser().parseFromString(text, 'application/xml');
		} else {
			var xml = new ActiveXObject('Microsoft.XMLDOM');
			xml.async = false;
			xml.loadXML(text);
			return xml;
		}
	}
    
    function testUrlForMedia(pastedData){
        var success = false;
        var media = {};
        var youtube_id = 0;
        var vimeo_id = 0;
        var soundcloud_id = 0;
        var soundcloud_url = '';
        
        if(pastedData.match('http(s)?://(www.)?youtube|youtu\.be')){
            if(pastedData.match('embed')){
                youtube_id = pastedData.split(/embed\//)[1].split('"')[0];
            } else {
                youtube_id = pastedData.split(/v\/|v=|youtu\.be\//)[1].split(/[?&]/)[0];
            }
            media.type = "youtube";
            media.id = youtube_id;
            success = true;
        
        } else if (pastedData.match('http(s)?://(player.)?vimeo\.com')){
            vimeo_id = pastedData.split(/video\/|http:\/\/vimeo\.com\//)[1].split(/[?&]/)[0];
            media.type = "vimeo";
            media.id = vimeo_id;
            success = true;
        
        } else if (pastedData.match('http(s)?://player\.soundcloud\.com')) {
            soundcloud_url = unescape(pastedData.split(/value="/)[1].split(/["]/)[0]);
            soundcloud_id = soundcloud_url.split(/tracks\//)[1].split(/[&"]/)[0];
            media.type = "soundcloud";
            media.id = soundcloud_id;
            success = true;
        }
        
        if(success){
            return media;
        }
        
        return null;
    }
    
    function LoadPage($callback){
        var opts = {
            lines: 10,
            length: 10,
            width: 4,
            radius: 8,
            color: '#084073',
            speed: 1,
            trail: 60,
            hwaccel: true
        };
        
        var target = document.getElementById('boxPageLoadingImg');
        var spinner = new Spinner(opts).spin(target);
        
        $('#boxPageLoading').fadeIn('fast');
        $('#boxPageLoadingImg').fadeIn('fast', function(){
            if(typeof $callback == 'function'){
                $callback();
            }
        });
    }

})();