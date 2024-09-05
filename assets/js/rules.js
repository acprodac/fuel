/*
 *
 *	author: Alan David
 *
 */

//$('#header').load('header.html');
//$('#footer').load('footer.html');

$(document).ready(function() {


	/* CAROUSEL ********/
		/* Carousel Topo */

		var timer = setInterval(function(){
if($('#destaque_in li img').width() > 0) {clearInterval(timer);}
		
			$('#destaque_in').jcarousel({
				wrap: 		'circular',
				easing: 	'ease',
				animation: {
			        duration: 1000,
			        easing:   'swing',
			        complete: function() {
			        }
			    }
			});
			
			var items = $('#destaque_in').jcarousel('items');
			if (items.length > 1) {
				$('#destaque_in').jcarouselAutoscroll({
				    target: '+=1',
				    interval: '5000'
				});
			}
		/*Paginação  */
		
		$('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .jcarouselPagination();

        $(window).load(function(){
        	Destaque();
        });
        
        /* Sumir com paginação com um item no carousel */
        var items = $('#destaque_in').jcarousel('items');
		if (items.length == 1) {
			$('.jcarousel-pagination').hide();
		}
		
		/* Carousel Galeria Geral */
		
		Galeria();
		legendaCar();

	
	/* Segmentos Grid  */
	//segGrid();

	if ($('.jcarousel').length > 0){
		var carousel = $('.carousel-navigation');

	    carousel.swipe({
	        swipeLeft: function(event, direction, distance, duration, fingerCount) {   
	            carousel.jcarousel('scroll', '+=1');
	            return false
	        },
	        swipeRight: function(event, direction, distance, duration, fingerCount) {
	            carousel.jcarousel('scroll', '-=1');
	            return false
	        }
	    });

	    $('.carousel-stage li a').fancybox({
	    	'padding': 	0,
	    	'margin': 	0
	    });
	}
	},100)
	/* CONTATO */

	window.initialize = function( id, lat, lng , end){
		if($('body').hasClass("contato")){
		var latlng = new google.maps.LatLng( lat + 0.0005, lng );
		var myOptions = {
				zoom : 16,
				center : latlng,
				mapTypeId : google.maps.MapTypeId.ROADMAP,
				panControl: true,
				zoomControl: true,
				mapTypeControl: true,
				scaleControl: true,
				streetViewControl: true,
				overviewMapControl: true

			};

		var map = new google.maps.Map( document.getElementById( id ), myOptions );
		var myLatLng = new google.maps.LatLng( lat, lng );

		var beachMarker = new google.maps.Marker({
				position : myLatLng,
				map : map,
			});

		var contentString = '<h2>Prodac Ar Condicionado</h2><br><p>'+end+'</p>'

		var info = new google.maps.InfoWindow({
				content : contentString
			});

		
		info.open(map, beachMarker);
		}
	}
	/*
	var form = $("form#contato"),
		data;

	$.validator.addMethod("placeholder", function (value, element) {
       if (value == $(element).attr('placeholder')) {
          return false;
       } else {
           return true;
         }
    });	

	$.validator.addMethod('verifyEmail', function (value, element) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (regex.test(value)) { return (this.optional(element) || true);	}
	});
	
	form.validate({
        rules: {
            nome: "required",
			"email": {
                required: true,
                verifyEmail: true
            },
			msg: "required"			
        },
		highlight: function( element, errorClass, validClass ) {
			if ( element.type === "radio" ) {
				this.findByName( element.name ).addClass( errorClass ).removeClass( validClass );
			} else {
				$( element ).parent().addClass( errorClass ).removeClass( validClass );
				$( element ).addClass( errorClass ).removeClass( validClass );
			}
		},
		unhighlight: function( element, errorClass, validClass ) {
			if ( element.type === "radio" ) {
				this.findByName( element.name ).removeClass( errorClass ).addClass( validClass );
			} else {
				$( element ).parent().removeClass( errorClass ).addClass( validClass );
				$( element ).removeClass( errorClass ).addClass( validClass );
			}
		},		
		errorContainer: $("div.errorMessage")
    });

	$('#submit').on('click', function(event){
		if($('textarea[name="msg"]').text() === ''){
			$('textarea[name="msg"]').text('GOSTARIA DE RECEBER MAIS \nINFORMAÇÕES SOBRE O \nPRODUTO. OBRIGADO! ')
		}
		event.preventDefault();
		if(form.valid()){
			//$('.btnEnviar').hide();
			//$('.loading').show();
			data = form.serialize();
			$.ajax({
				url: "enviar",
				type: "post",
				data: data,
				dataType: 'json',
				success: function(data){
					$('.btnEnviar').show();
					$('.loading').hide();
					if(eval(data.codigo) === 1){
						ga('send', 'event', 'button', 'click', 'enviar/embusa.com.br/sucesso');
						openSucesso();
						clearForm();
					}else{
						ga('send', 'event', 'button', 'click', 'enviar/embusa.com.br/erro');
						alert("Ocorreu um erro, tente novamente mais tarde!");
					}
				},
				error:function(){
					$('.btnEnviar').show();
					$('.loading').hide();
					ga('send', 'event', 'button', 'click', 'enviar/iamtatuape.com.br/erro');
					alert("Ocorreu um erro, tente novamente mais tarde!");
				}
			});
		}
	}); */

	$(window).load(function(){
		Destaque();
	});
});


$(window).resize(function(){ 
	Destaque();
	
	Galeria();
	
	$('.segmentos .content ul li').height('auto');
	//segGrid();
});

$(window).on('scroll resize load', function(){ 
	if ($(this).scrollTop() > 100 && $(this).width() > 825) {
		$('#header #header_in').css({ 'height': 60 }, 500);
		$('#header #nav a').css({ 'lineHeight': '60px' }, 500);
		$('#header h1 a img').css({ 'width': 150, 'marginTop': 0 }, 500);
		$('#nav a.mark, #nav a:hover').css({ 'backgroundPosition': '50% 40px' }, 500);
	} else if ($(this).scrollTop() < 100 && $(this).width() > 825) {
		$('#header #header_in').css({ 'height': 100 }, 500);
		$('#header #nav a').css({ 'lineHeight': '100px' }, 500);
		$('#header h1 a img').css({ 'width': 181, 'marginTop': '0.6em' }, 500);
		$('#nav a.mark, #nav a:hover').css({ 'backgroundPosition': '50% 60px' }, 500);
	}
});

function Menu(){


	/* MENU MOBILE*/
	$('#btnMenu').click(function(){
		var top = $('.menuContent').css('top');
		

		if (top == '-220px') {
			
			$('.menuContent').css({
				top: '60px',
				easing: "easein"
			}),1000;
		} else if (top == '60px') {
			$('.menuContent').css({
				top: '-220px',
				easing: "easein"
			}), 1000;
		}
		return false;
	});
}



function legendaCar(){
    /* Carousel Legenda */
    var first = $('.carousel-stage').jcarousel('first');
    var texto = $(first).find('img').attr('alt');

    

    $('#legenda_galeria strong').text(texto);

    /*if ($('.carousel-stage').length>0){
	    var t = $('.carousel-stage').position().top;
	     $('#legenda_galeria').css('top',t);
	}*/
};

function Galeria(){
	
	var wid = $('.carousel-stage').width();
	 $('.carousel-stage li').width(wid);

	var t1 = $('.carousel-stage').height();
	var t2 = $('.carousel-navigation').height();

	$('.prev-stage').css('height', t1);
	$('.next-stage').css('height', t1);
	$('.prev-navigation').css('height', t2);
	$('.next-navigation').css('height', t2);
	
	//var jcarousel = $('.carousel-navigation');
	//jcarousel.jcarousel('items').css('display', 'none');
	// setTimeout(function(){
	
	var jcarousel = $('.carousel-navigation');
    jcarousel
        .on('jcarousel:reload jcarousel:create', function () {
        	
            var width = jcarousel.innerWidth();

            if (width >= 700) {
                width = width / 6;
            } else if (width < 700) {
                width = width / 4;
            } else if (width < 480) {
                width = width / 3;
            }
			
			jcarousel.jcarousel('items').css('display', 'block');
			jcarousel.jcarousel('items').show();
            jcarousel.jcarousel('items').css('width', width + 'px');
            //console.log(width);
        });
    // },500)
};

function segGrid(){
	/* segmentos Grid  */
	var lii = $('.segmentos .content ul li:first-child').height();

	$('.segmentos .content ul li').each(function(){
		li = $(this).height();

		if (lii > li){
			li = lii;
		} else {
			lii = li;
		}
		$(this).height(lii);
	});
}
function Destaque(){

	$('#destaque_in li').each(function(){
		var w = $(window).width();
    	var img = $(this).find('img').width();
    	var h = $(this).find('img').height();

    	$(this).find('img').css({
	    	'margin-left': 	-(img - w)/2,
	    	'width': 		img,
	    	'height': 		h
	    });
	});

    /* Sumir carousel mobile */
    if ($(window).width() < 800){
		$('#destaque_in').hide();
	} else {
		$('#destaque_in').show();
	}
}

function clearForm(){
	$('form#contato input').each(function(){
		if($(this).prop("id") !== 'submit'){
			$(this).val('');	
		}
	});
}
