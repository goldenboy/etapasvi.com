var ap_stopAll = function(){};
var audioplayer  = false;
// здесь запоминается форма Предложить перевод, чтобы после подгрузки фото, её восстанавливать
var offer_tr_clone  = '';
// интервал показа цитат
var rotate_quotes_interval  = 15000;
// номер последней показанной цитаты
var last_quote_index  = -1;
// минимальный размер окна, при котором скрываются элементы
var window_size_hide_el  = 1000;

$(document).ready(function() {
    // сокрытие элементов в зависимости от размера окна
    onWindowResize();

    // цитаты отображаются, если есть перевод и размер окна больше минимального
    if (quote_list) {
        showQuotes();        
    }
    
    // random audio   
    if (audio_list) {
        var audio_index = Math.floor(Math.random( ) * (audio_list.length));
        if (audio_list[ audio_index ]) {
            $("#mp3").attr("title", audio_title_list[ audio_index ] );
            $("#mp3 span").html( audio_list[ audio_index ] );
        }
    }    
    
	// custom options
	$("#mp3").jmp3({
		//filepath: "http://etapasvi.zxq.net/"
		//filepath: "http://www.etapasvi.com/uploads/audio/",
		filepath: "http://k002.kiwi6.com/uploads/hotlink/",
        width: 24
	});

	// select language
	$("span.lang_selector").colorbox({inline:true, href:"#lang_box", opacity:"0.5", transition:"none"});

    // перемещение Предложения перевода наверх
    $("#offer_tr_ctr").insertAfter( "#content h1:eq(0)" );
    // текст в футере
    if (footer_text) {
        $("#f_line").after(footer_text);
    }
    
    // сокрытие элементов в зависимости от размера окна
    $(window).resize(function() {
        onWindowResize();
    });
});

// сокрытие элементов в зависимости от размера окна
function onWindowResize() 
{
    if ($(window).width() < window_size_hide_el) {
        $("#wrapper").css('margin', '0 auto 0 70px');
    } else {
        $("#wrapper").css('margin', '0 auto');
    }
}

// скрывает цитату
function hideQuotes()
{
    // fadeOut для элемента p вешает IE    
    $("#quote_p_cont").fadeOut(600);
    setTimeout( showQuotes, 700);
}

// отображает случайную цитату
function showQuotes()
{
    // если размер окна удовлетворяет, показываем цитату    
    if ($(window).width() > window_size_hide_el) {
        var quote_el = $("#bubble_quote p:first");    
        var quote_index = Math.floor(Math.random( ) * (quote_list.length));
        // если выбрана прошлая цитата, берём предыдущую в списке или последнюю
        if (quote_index == last_quote_index) {
            if (quote_index > 1) {
                quote_index = quote_index - 1;
            } else {
                quote_index = quote_list.length - 1;
            }
        }
        
        last_quote_index = quote_index;
        if (quote_list[ quote_index ]) {
            quote_el.html( quote_list[ quote_index ] + '...' );
        }        
        $("#quote_p_cont").fadeIn(600);
    }
    setTimeout( hideQuotes, rotate_quotes_interval);
}

// исходный текст учения
function showOriginal() 
{
	if ( $("#elOriginal").is(":hidden") ) {
		$("#elOriginal").slideDown("slow");
	} else {
		$("#elOriginal").slideUp("slow");
	}
}

// текст аудиозаписи
function showAudioBody(id) 
{    
    var element_id = "#elAudioBody" + id;

	if ( $(element_id).is(":hidden") ) {
		$(element_id).slideDown("slow");
	} else {
		$(element_id).slideUp("slow");
	}
}

//  модификация ссылок для подгрузки содержимого
function preparePhotoContent()
{    
    $(document).ready(function(){
        var href;
        $("#photo_content a.photo_content_link").each(function(index) {
            href = $(this).attr('href');

            href = "javascript: loadPhotoContent('" + href + "'); void(0)";
            $(this).attr('href', href);
        });
    });
}

// ссылка на текущую фотографию
var global_photo_href;

// подгрузка содрежимого фото
function loadPhotoContent(href, hide_content, domain)
{
    if (!href || $("#photo_loader").is("visible")) {
        return;
    }
    // получаем домен
    if (!domain) {
        domain = href.replace(/http:\/\/([^\/]+).*/, '$1');
    }
    if (!domain) {
        return;
    }

    // домен не включается
    href = href.replace(/http:\/\/[^\/]+\//, '');

    if (hide_content) {
        $("#photo_content .photofull").html( '<p id="photo_loader" class="hidden center_text" ><img src="/i/loader.gif" /></p>' );
        $("#disqus_thread").hide();
        $("#photo_content div.social").remove();
        $("#photo_content .dsq-brlink").remove();
    }
    global_photo_href = 'http://' + domain + '/' + href;

    var content_href = '/' + href.replace(/\/photo\//, '/photo/content/');
    $("#photo_loader").show();

    // сохраняем форму Предложить перевод
    $("#offer_tr").hide();
    offer_tr_clone = $("#offer_tr_ctr").clone();

    // отправка запроса
    $("#photo_content").load(content_href, function(response, status, xhr) {
        if (status == "error") {
            $("#photo_loader").hide();
            if (global_photo_href) {
                window.location = global_photo_href;
                return;
            }            
        } else {   
            // восстанавливаем форму Предложить перевод
            offer_tr_clone.insertAfter( "#content h1:eq(0)" );      
            // модификация URL
            setUrl(global_photo_href, href);
            // title
            var content_title = $("#photo_content_title").text() + ' - eTapasvi.com';
            if (content_title) {
                document.title = content_title;
            }
            // указывается новый URL в форме Предложить перевод
            $("#offer_tr_uri").val(global_photo_href);
            // вытаскивается ID из URL
            $("#offer_tr_id").val(getElementIdFromUrl(global_photo_href));
        }
    });
}

function getElementIdFromUrl(url)
{
    var match = url.match(/^[^\d]+(\d+).*$/);
    return match[1];
}

// получение адреса из хэша и загрузка фото
function loadPhotoContentFromHash(domain)
{    
    var hash_url = $.address.value();
    if (hash_url && hash_url.substr(0, 2) == '/!') {            
        loadPhotoContent( hash_url.substr(2, hash_url.length), true, domain );
    }
}

// установка URL
function setUrl(full, relative)
{
    try {
        if (history && history.pushState) {
            history.pushState({isMine:true}, 'title',  full );
        } else {
            $.address.value('/!' + relative); 
        }
        // меняем ссылку на мобильную версию
        setUrlMobile(full);
        setUrlLangList(full);
    } catch (e) {
    }
}

// установка ссылки на мобильную версию
function setUrlMobile(url)
{
    var mobile_url = url.replace("www.", "m.");
    $("#m_link a").each(function(n,element){
        $(element).attr("href", mobile_url);
    });
    $("#m_link img").each(function(n,element){
        var m_src = $(element).attr("src");
        $(element).attr("src", m_src.replace(/(.*&d=).*/, "$1") + mobile_url);
    });
}

// установка ссылок в переключателе языка
function setUrlLangList(href)
{
    cur_href_no_culture = href.replace(/http:\/\/[^\/]+\//, '').replace(/[^\/]+\//, '');
    $("#lang_list a").each(function(index) {
        culture_href = $(this).attr('href').replace(/(http:\/\/[^\/]+\/[^\/]+\/).*/, '$1' + cur_href_no_culture);
        
        $(this).attr('href', culture_href);
    });  
}

// отображение формы Предолжить перевод
function switchOfferTr(fields_url, error_msg) 
{    
    // если поля уже загружены
    if (!$("#offer_tr_fields").is(':empty')) {
        if ( $("#offer_tr").is(":hidden") ) {
            $("#offer_tr").show();
            // если форма была отправлена
            if (!$("#offer_tr_success").is(":hidden")) {
                $("#offer_tr_fields textarea").val('');            
            }
            $("#offer_tr_success").hide();
        } else {
            $("#offer_tr").hide();
        }
    } else {
        // загрузка полей
        $("#offer_tr_loader").show();
        $.ajax({
            url: fields_url,
            dataType: "html",
            success: function(data) {
                $("#offer_tr_fields").html(data);
                $("#offer_tr_loader").hide();
                $("#offer_tr").show();
            },
            error: function(data) {
                $("#offer_tr_loader").hide();
                alert(error_msg);
            }
        });
    }
}

// отправка Перевода
function offerTrSubmit()
{    
    $("#offer_tr_success").show();
    $("#offer_tr").hide();
    return true;
}

// отображения формы отправки перевода
function showOfferTrMethod(radio)
{    
    $(".offer_tr_method").hide();
    $("#" + $(radio).val() ).show();
}