<?php include_component('text', 'js') ?>

// main
var ap_stopAll = function(){};
var audioplayer  = false;
// здесь запоминается форма Предложить перевод, чтобы после подгрузки фото, её восстанавливать
var page_toolbar_clone  = '';
// позиция в окне перед активацией одной из кнопок панели инструментов
var page_toolbar_window_pos  = 0;
// интервал показа цитат
var rotate_quotes_interval  = 15000;
// номер последней показанной цитаты
var last_quote_index  = -1;
// минимальный размер окна, при котором скрываются элементы
var window_size_hide_el  = 1000;
// ссылки на фото преобразованы
var ph_links_ready = false;
// ссылка на текущую фотографию
var global_photo_href;
// режим отображения страницы
var page_mode = '';
// режим отображения страницы до открыти всплывающего окна
var prev_page_mode = '';
// минимальная ширина фото во всплывающем окне
var min_photo_full_width = 566;
// максимальная высота фото во всплывающем окне
var min_photo_full_height = 300;
// отступы при вычислении размеров всплывающего окна
var p_cb_horiz_margin = 50;
var p_cb_vert_margin  = 80; // только снизу
var p_cb_horiz_padding = 50;
var p_cb_vert_padding  = 0;
// вертикальную позицию в окне
var cb_window_pos = 0;
// период вызова resize всплывающего окна
var cb_resize_period = 1000;
// пространство, изначально выделяемое для комментариев
var cb_comments_height = 398;
// после открытия resize всплывающего окна ещё не делаллся
var cb_first_resize = true;
// URL до открытия всплывающего окна
var cb_prev_url = "";
// заголовок страницы до открытия всплывающего окна
var cb_prev_title = "";
// всплывающее окно было открыто на странице с фото
var cb_from_photo_page = false;
// адрес страницы для страницы комментариев до открытия всплывающего окна
var cb_prev_dusqus_url = '';
var cb_prev_disqus_identifier = '';
// циклический ресайз после открытия фото во всплывающем окне
var first_cyclic_resize = true;


$(document).ready(function() {
    var embedded_or_print = false;
    var hash = window.location.hash;
    
    loadPhotoContentFromHash();
    
    page_mode = hash.substring(1);
    
    //if (page_mode == 'enlarge_photo') {
    //    // увеличенное фото
    //    $("body").addClass("enlarge_photo");
    //    return;
    //} else {
    // страница встроена
    if (top !== self) { 
        $("body").addClass("embedded");
        page_mode = "embedded";
        embedded_or_print = true;
    }
    // версия для печати
    if (page_mode == "print_version") {
        $("body").addClass("print_version");
        embedded_or_print = true;
    }
    if (embedded_or_print) {
        // сообщение о том, что страница встроена
        // путь без параметров и хэша 

        var embed_source = window.location + "";
        //embed_source = embed_source.substring(0, embed_source.indexOf('#'));
        //embed_source = embed_source.substring(0, embed_source.indexOf('?'));
        embed_source = embed_source.replace(/([^#?]+)[#?]?.*/g, "$1");

        $("#content").append('<p class="small"><?php echo __("Source") ?>: <br/><a href="' + embed_source + '">' + embed_source + '</a></p>');
        return;
    }
    //}

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
	//$("span.lang_selector").colorbox({inline:true, fixed:true, href:"#lang_box", opacity:"0.5", transition:"none", close:"X"});

    // перемещение Предложения перевода наверх

    $("#page_toolbar").insertAfter( "#content h1:eq(0)" );        
    
    // текст в футере
    if (footer_text) {
        $("#lang_plain").after(footer_text);
    }   
    
    // сокрытие элементов в зависимости от размера окна
    $(window).resize(function() {
        onWindowResize();
    });
});

// сокрытие элементов в зависимости от размера окна
function onWindowResize() 
{

    if (!$("body").hasClass('direction_rtl')) {
        // left aligned text
        if ($(window).width() < window_size_hide_el) {
            $("#wrapper").css('margin-left', '70px');
        } else {
            $("#wrapper").css('margin-left', 'auto');
        }        
    } else {
        // right aligned text
        if ($(window).width() < window_size_hide_el) {
            $("#wrapper").css('margin-right', '70px');
        } else {
            $("#wrapper").css('margin-right', 'auto');
        } 
    }

    // если просматриваем фото
    if (page_mode == 'enlarge_photo') {
        // если в функции сделать alert, Mozilla зависает
        resizePhotoColorbox();
        cbResize();
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
            quote_el.html( quote_list[ quote_index ]);
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
    $(document).ready(function() {
        // если фото открыто во всплывающем окне в iframe
        if (page_mode == "enlarge_photo") {
            var full_photo_img = $("#colorbox img.full_photo_img");            
            // замена превью на полную версию фото
            //full_photo_img.attr("src", $("#photo_full_url").val());
            resizePhotoColorbox(full_photo_img);           
        }        
        
        // title
        var content_title = $("#photo_content_title").text() + ' - eTapasvi.com';

        if (content_title) {
            document.title = unescapeHTML(content_title);
        }

        // преобразование ссылок на предыдущую и следующую фото
        /*var href;
        $("#photo_content a.photo_content_link").each(function(index) {
            href = $(this).attr('href');

            href = "javascript: loadPhotoContent('" + href + "'); void(0)";
            $(this).attr('href', href);
        });*/
    });
}

// преобразование HTML-сущностей в их печатные аналоги
function unescapeHTML(html) {
   return $("<div />").html(html).text();
}

// подгонка размера фото
function resizePhotoColorbox(full_photo_img)
{
    if (!full_photo_img) {
        full_photo_img = $("#colorbox img.full_photo_img");
    }

    // установка размера фото, контейнеров и всплывающего окна
    // размеры окна
    var w_width  = $(window).width() * 1;
    var w_height = $(window).height() * 1;
    // размеры фото
    var p_width  = $("#photo_full_width").val() * 1;
    var p_height = $("#photo_full_height").val() * 1;
    // подобранные размеры
    var rect_width;
    var rect_height;

    // Подбор ширины и высоты области с фото (rect_):
    // Если размер фото меньше минимально допустимого или размер окна меньше минимально допустимого
    // размер области устанавливается равным минимально допустимому.
    // Если размер фото больше размера окна, устанавливаем размер области равным размеру окна.
    // Иначе размер области устанавливается равным размеру фото
    if (p_width > min_photo_full_width && w_width > min_photo_full_width + p_cb_horiz_margin) {
        if (p_width > (w_width - p_cb_horiz_margin - p_cb_horiz_padding) ) {
            rect_width = w_width - p_cb_horiz_margin;
        } else {
            rect_width = p_width + p_cb_horiz_padding;
        }
    } else {
        rect_width = min_photo_full_width;
    }
    if (p_height > min_photo_full_height && w_height > min_photo_full_height + p_cb_vert_margin) {
        if (p_height > (w_height - p_cb_vert_margin - p_cb_vert_padding) ) {
            rect_height = w_height - p_cb_vert_margin;
        } else {
            rect_height = p_height;
        }
    } else {
        rect_height = min_photo_full_height;
    }   

    // пропорционально изменяем размеры фото
    var new_photo_width;
    var new_photo_height;
    
    p_width     += 0.0;
    p_height    += 0.0;
    rect_width  += 0.0;
    rect_height += 0.0;

    new_photo_width  = rect_width - p_cb_horiz_padding;
    new_photo_height = rect_height - p_cb_vert_padding;

    if ( (p_width / p_height) > (new_photo_width / new_photo_height) ) {
        // уменьшаем высоту       
        new_photo_height = Math.floor( (p_height * new_photo_width) / p_width );        
    } else {
        // уменьшаем ширину
        new_photo_width  = Math.floor( (p_width * new_photo_height) / p_height );        
    }

    if (new_photo_height > p_height) {
        new_photo_height = p_height;
    }

    if (new_photo_width > p_width) {
        new_photo_width = p_width;
    }
    
    // устанавливаем размеры области после пересчёта размера изображения
    // если одна из сторон получилась меньше минимальной, устанавливаем равной минимальной 
    rect_height = new_photo_height + p_cb_vert_padding;
    if (rect_height < min_photo_full_height) {
        rect_height = min_photo_full_height;
    }    
    rect_width  = new_photo_width + p_cb_horiz_padding;
    if (rect_width < min_photo_full_width) {
        rect_width = min_photo_full_width;
    }

    // после открытия colorbox считывает размеры содержимого
    $("#photo_content").css( {"width": rect_width/*, "height": rect_height*/} );
    // шириной фото руководит родительский элемент
    full_photo_img.css( {"max-width": new_photo_width/*, "height": new_photo_height*/} );
    //$("#colorbox a.photo_frame").css( {"width": (rect_width - p_cb_horiz_padding)} );

    cb_width = rect_width+p_cb_horiz_margin;
    cb_height = rect_height+cb_comments_height;
    
    first_cyclic_resize = true;
    
    cbResize();
}

// установка размеров всплывающего окна
// необходимо вызывать resize с явно указанными размерами, 
// т.к. после открытия colorbox больше не считывает размеры содержимого
function cbResize(scroll_to_pos)
{
    if (page_mode != "enlarge_photo") {
        return;
    }
    // первый вызов после открытия всплывающего окна пропускаем
    // т.к. после открытия колорбокс сам делает ресайз
    if (cb_first_resize) {
        cb_first_resize = false;
        // webkit-браузеры при окрытии всплывающего окна выставляют высоту не по контенту, а по своему усмотрению
        // если вызвать ресайз через какое-то время, высота будет подобрана верно
        
        if ($.browser.webkit) {
            setTimeout(function(){ cbResize(); }, cb_resize_period);
        } else {
            return;
        }
    } else {
        // если высота всплывающего окна удовлетворительная, выходим
        // иначе вызываем ресайз высплывающего окна
        if (!first_cyclic_resize && $("#cboxLoadedContent").height() >= cb_height) {
            first_cyclic_resize = false;
            return;
        }
    }
    /*if (!cb_width) {
        setTimeout(function(){ cbResize(); }, cb_resize_period);
        return;
    } */
    //if (!no_scroll_to_top) {
    //$(window).scrollTop(0);
    //}

    $.colorbox.resize({width: cb_width});
    // прокручиваем окно к указанной позиции    
    if (typeof scroll_to_pos != "undefined") {
        $(window).scrollTop(scroll_to_pos);
    }
    
    // функция ресайза запускается до тех пор, пока высота всплывающего окна не будет адекватной
    setTimeout(function(){ cbResize(); }, cb_resize_period);
    first_cyclic_resize = false;
}

//  модификация ссылок на фотографии (не испольузется)
function phLinks()
{    
    if (ph_links_ready) {
        return ph_links_ready;
    }    
    $(document).ready(function(){
        var href;
        $("#content a.ph_link").each(function(index) {
            href = $(this).attr('href');

            href = "javascript: enlargePhoto('" + href + "#enlarge_photo'); void(0)";
            $(this).attr('href', href);
        });
    });
    ph_links_ready = true;
}

// подгрузка содрежимого фото
function enlargePhoto(href, from_photo_page)
{
    // запоминается режим, чтобы после закрытия всплывающего окна, восстановить
    prev_page_mode = page_mode;
    page_mode      = 'enlarge_photo';
    
    // фото было увеличено со страницы фотографии
    if (from_photo_page) {
        cb_from_photo_page = true;
    } else {
        cb_from_photo_page = false;
    }
    
    // запоминаем вертикальную позицию в окне
    //cb_window_pos = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
    cb_window_pos   = $(window).scrollTop();
    if (cb_window_pos) {
        // фиксируем позицию и устанавливаем высоту контейнера страницы
        $("#wrapper").css({"top": (cb_window_pos*(-1))});
        $(window).scrollTop(0);
    }   
    
    // устанавливаем URL страницы
    cb_prev_url = document.location + "";
    setUrl(href);
    
    // запоминаем адрес страницы для скрипта комментариев
    if (typeof disqus_url != "undefined") {
        cb_prev_dusqus_url        = disqus_url;
        cb_prev_disqus_identifier = disqus_identifier;
    }
    cb_prev_title = document.title + "";
    
    cb_first_resize = true;

    $.colorbox({
        href:getContentUrl(href),
        initialWidth:min_photo_full_width,
        initialHeight:min_photo_full_height,
        top:"0px",
        opacity:"0.5",
        transition:"none",
        close:"X",
        scrolling: "visible",
        onClosed: function () {
            if (cb_from_photo_page) {
                window.location.href = cb_prev_url;
            }
        
            // восстанавливаем размер и позицию основного контейнера страницы
            $("#wrapper").css({"top": 0});
            $(window).scrollTop(cb_window_pos);            
            cb_from_photo_page
            // устанавливаем URL, который был до открытия колорбокса
            if (cb_prev_url) {
                setUrl(cb_prev_url, true);
                cb_prev_url = "";
            }
            
            if (cb_prev_title) {
                document.title = cb_prev_title;
                cb_prev_title = "";
            }
            
            // в IE изменение адресной строки прокручивает окно наверх
            $(window).scrollTop(cb_window_pos);

            // восстанавливаем комментарии на основной странице
            //eval( $("#disqus_config_script").text() );   
            disqus_url        = cb_prev_dusqus_url;
            disqus_identifier = cb_prev_disqus_identifier;
            
            if (disqus_url) {
                $("#disqus_thread").html(
                    "<script type=\"text/javascript\">" +
                    $("#disqus_config_script").text() +        		
                    //"var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true; " +
                    //"dsq.src = $(\"#disqus_script\").attr(\"src\"); " +
                    //"(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq); " + 
                    "</script>"
                );
                // в IE обработка скрипта работает с небольшой задержкой, поэтому скрипт disqs надо подключать немного погодя
                // при динамической вставке disqus как script в DOM сыпятся ошибки
                //if ($.browser.msie) {
                    //setTimeout(function() {
                        //$("#disqus_thread").html(
                        //    "<script src=\"" + $("#disqus_script").attr("src") + "\" type=\"text/javascript\"></script>"
                        //);
                    //}, 1000);
                //} else {
                $("#disqus_thread").html(
                    "<script src=\"" + $("#disqus_script").attr("src") + "\" type=\"text/javascript\"></script>"
                );			
                //}
            }
            page_mode           = prev_page_mode;
            prev_page_mode      = '';
            cb_window_pos       = 0;
            cb_prev_dusqus_url  = '';
            cb_prev_disqus_identifier  = '';
        },
        onComplete: function () {
            // перемещаем page_toolbar из основной страницы во всплывающее окно
            //$("#page_toolbar").insertAfter("#dsq-brlink");            
            //$("#page_toolbar").insertAfter("#dsq-brlink");            
        }
    });
}

// получение адреса content фото из полного URL фотографии
function getContentUrl(href)
{
    href = href.replace(/http:\/\/[^\/]+\//, '');
    return '/' + href.replace(/\/photo\//, '/photo/content/');
}

// подгрузка содержимого фото
function loadPhotoContent(href, hide_content, domain)
{
    if (!href || $("#photo_loader").is("visible")) {
        return;
    }
    
    // чтобы при просмотре фотографий, пользователь постепенно не смещался вниз
    // перед отрытием всплывающего окна запоминаем позицию в окне и при переходе по фотографиям,
    // прокручиваем окно к запомненной позиции
    if (page_mode == 'enlarge_photo') {
        //$(window).scrollTop(cb_window_pos);        
        $(window).scrollTop(0);
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

    var content_href = getContentUrl(href);
    $("#photo_loader").show();

    // сохраняем форму Предложить перевод
    //$("#offer_tr").hide();
    //page_toolbar_clone = $("#page_toolbar").clone();

    // отправка запроса
    $.get(content_href, function(response, status, xhr) {         
        if (status == "error") {
            $("#photo_loader").hide();
            if (global_photo_href) {
                window.location = global_photo_href;
                return;
            }            
        } else {   
            // модификация URL
            setUrl(global_photo_href);
        
            $("#photo_content").replaceWith(response);
            // восстанавливаем форму Предложить перевод
            //page_toolbar_clone.insertAfter( "#content h1:eq(0)" );      

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

// получение адреса из хэша и редирект на страницу
function loadPhotoContentFromHash(domain)
{    
    var hash_url = $.address.value();
    if (hash_url && hash_url.substr(0, 2) == '/!') {            
        //loadPhotoContent( hash_url.substr(2, hash_url.length), true, domain );
        // получение домена 
        if (!domain) {
            domain = document.domain;
        }
        window.location  = 'http://' + domain + '/' + hash_url.substr(2, hash_url.length);
    }
}

// установка URL
function setUrl(full, remove_hash)
{
    if (!full) {
        return false;
    }
    try {
        if (history && history.pushState) {
            history.pushState({isMine:true}, 'title',  full );
        } else {
            if (remove_hash) {
                // удаляем хэш полностью, чтобы восстановить прежний адрес страницы
                // если использовать
                // $.address.value(''); 
                // браузер прокрутит на самый верх страницы
                window.location.hash = '';
            } else {
                // получаем всё, что идёт после домена без начального /
                relative_url = full.replace(/http:\/\/[^\/]+\//, '');
                $.address.value('/!' + relative_url); 
            }
        }
        // меняем ссылку на мобильную версию и язык
        if (page_mode != 'enlarge_photo') {
            setUrlMobile(full);
            setUrlLangList(full);
        }
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
            pageToolsTriggerShow("offer_tr");
            
            // если форма была отправлена
            if (!$("#offer_tr_success").is(":hidden")) {
                $("#offer_tr_fields textarea").val('');            
            }
            $("#offer_tr_success").hide();
        } else {
            pageToolsTriggerHide("offer_tr");
        }
    } else {
        // загрузка полей
        $("#offer_tr_loader").show();
        pageToolsTriggerShow("offer_tr");
        
        $.ajax({
            url: fields_url,
            dataType: "html",
            success: function(data) {
                $("#offer_tr_fields").html(data);
                $("#offer_tr_loader").hide();
                $("#offer_tr").show();
                cbResize($(window).scrollTop());
            },
            error: function(data) {
                $("#offer_tr_loader").hide();
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
    cbResize($(window).scrollTop());
}

// отображение Истории изменений
function switchRevhistory()
{
    if ( $("#revhistory").is(":hidden") ) {
        pageToolsTriggerShow("revhistory");
    } else {
        pageToolsTriggerHide("revhistory");
    }
}

// отображение Истории изменений
function switchEmbed()
{
    if ( $("#embed").is(":hidden") ) {
        pageToolsTriggerShow("embed");
    } else {
        pageToolsTriggerHide("embed");
    }
}

// показать кнопку
function pageToolsTriggerShow(mnemonic_id)
{
    // скрываются все остальные кнопки
    $(".page_tools").each(function(index) {
        pageToolsTriggerHide( $(this).attr('id') );
    });    
        
    $("#"+mnemonic_id).show();
    $("#"+mnemonic_id+"_trigger").addClass('pt_btn_disabled');
    cbResize($(window).scrollTop());
}

// скрыть кнопку
function pageToolsTriggerHide(mnemonic_id)
{
    if ( !$("#"+mnemonic_id).is(":hidden") ) {
        $("#"+mnemonic_id).hide();
        $("#"+mnemonic_id+"_trigger").removeClass('pt_btn_disabled');
    }
    cbResize($(window).scrollTop());
}

// jmp3
jQuery.fn.jmp3=function(passedOptions){var playerpath="/swf/";var options={"filepath":"","backcolor":"","forecolor":"ffffff","width":"25","repeat":"no","volume":"50","autoplay":"false","showdownload":"true","showfilename":"true"};if(passedOptions){jQuery.extend(options,passedOptions)}return this.each(function(){var filename=options.filepath+jQuery(this).children().html();var mp3html='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';mp3html+='width="'+options.width+'" height="20" ';mp3html+='codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">';mp3html+='<param name="movie" value="'+playerpath+'singlemp3player.swf?';mp3html+='showDownload='+options.showdownload+'&file='+filename+'&autoStart='+options.autoplay;mp3html+='&backColor='+options.backcolor+'&frontColor='+options.forecolor;mp3html+='&repeatPlay='+options.repeat+'&songVolume='+options.volume+'" />';mp3html+='<param name="wmode" value="transparent" />';mp3html+='<embed wmode="transparent" width="'+options.width+'" height="20" ';mp3html+='src="'+playerpath+'singlemp3player.swf?';mp3html+='showDownload='+options.showdownload+'&file='+filename+'&autoStart='+options.autoplay;mp3html+='&backColor='+options.backcolor+'&frontColor='+options.forecolor;mp3html+='&repeatPlay='+options.repeat+'&songVolume='+options.volume+'" ';mp3html+='type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />';mp3html+='</object>';if(options.showfilename=="false"){jQuery(this).html("")}jQuery(this).prepend(mp3html+"&nbsp;");if(jQuery.browser.msie){this.outerHTML=this.outerHTML}})};


// jQuery Address Plugin v1.4
(function(c){c.address=function(){var v=function(a){c(c.address).trigger(c.extend(c.Event(a),function(){for(var b={},e=c.address.parameterNames(),f=0,p=e.length;f<p;f++)b[e[f]]=c.address.parameter(e[f]);return{value:c.address.value(),path:c.address.path(),pathNames:c.address.pathNames(),parameterNames:e,parameters:b,queryString:c.address.queryString()}}.call(c.address)))},w=function(){c().bind.apply(c(c.address),Array.prototype.slice.call(arguments));return c.address},r=function(){return M.pushState&&
d.state!==k},s=function(){return("/"+g.pathname.replace(new RegExp(d.state),"")+g.search+(D()?"#"+D():"")).replace(U,"/")},D=function(){var a=g.href.indexOf("#");return a!=-1?B(g.href.substr(a+1),l):""},u=function(){return r()?s():D()},ha=function(){return"javascript"},N=function(a){a=a.toString();return(d.strict&&a.substr(0,1)!="/"?"/":"")+a},B=function(a,b){if(d.crawlable&&b)return(a!==""?"!":"")+a;return a.replace(/^\!/,"")},x=function(a,b){return parseInt(a.css(b),10)},V=function(a){for(var b,
e,f=0,p=a.childNodes.length;f<p;f++){try{if("src"in a.childNodes[f]&&a.childNodes[f].src)b=String(a.childNodes[f].src)}catch(J){}if(e=V(a.childNodes[f]))b=e}return b},F=function(){if(!K){var a=u();if(h!=a)if(y&&q<7)g.reload();else{y&&q<8&&d.history&&t(O,50);h=a;E(l)}}},E=function(a){v(W);v(a?X:Y);t(Z,10)},Z=function(){if(d.tracker!=="null"&&d.tracker!==null){var a=c.isFunction(d.tracker)?d.tracker:j[d.tracker],b=(g.pathname+g.search+(c.address&&!r()?c.address.value():"")).replace(/\/\//,"/").replace(/^\/$/,
"");if(c.isFunction(a))a(b);else if(c.isFunction(j.urchinTracker))j.urchinTracker(b);else if(j.pageTracker!==k&&c.isFunction(j.pageTracker._trackPageview))j.pageTracker._trackPageview(b);else j._gaq!==k&&c.isFunction(j._gaq.push)&&j._gaq.push(["_trackPageview",decodeURI(b)])}},O=function(){var a=ha()+":"+l+";document.open();document.writeln('<html><head><title>"+n.title.replace("'","\\'")+"</title><script>var "+C+' = "'+encodeURIComponent(u())+(n.domain!=g.hostname?'";document.domain="'+n.domain:
"")+"\";<\/script></head></html>');document.close();";if(q<7)m.src=a;else m.contentWindow.location.replace(a)},aa=function(){if(G&&$!=-1){var a,b=G.substr($+1).split("&");for(i=0;i<b.length;i++){a=b[i].split("=");if(/^(autoUpdate|crawlable|history|strict|wrap)$/.test(a[0]))d[a[0]]=isNaN(a[1])?/^(true|yes)$/i.test(a[1]):parseInt(a[1],10)!==0;if(/^(state|tracker)$/.test(a[0]))d[a[0]]=a[1]}G=null}h=u()},ca=function(){if(!ba){ba=o;aa();var a=function(){ia.call(this);ja.call(this)},b=c("body").ajaxComplete(a);
a();if(d.wrap){c("body > *").wrapAll('<div style="padding:'+(x(b,"marginTop")+x(b,"paddingTop"))+"px "+(x(b,"marginRight")+x(b,"paddingRight"))+"px "+(x(b,"marginBottom")+x(b,"paddingBottom"))+"px "+(x(b,"marginLeft")+x(b,"paddingLeft"))+'px;" />').parent().wrap('<div id="'+C+'" style="height:100%;overflow:auto;position:relative;'+(H&&!window.statusbar.visible?"resize:both;":"")+'" />');c("html, body").css({height:"100%",margin:0,padding:0,overflow:"hidden"});H&&c('<style type="text/css" />').appendTo("head").text("#"+
C+"::-webkit-resizer { background-color: #fff; }")}if(y&&q<8){a=n.getElementsByTagName("frameset")[0];m=n.createElement((a?"":"i")+"frame");if(a){a.insertAdjacentElement("beforeEnd",m);a[a.cols?"cols":"rows"]+=",0";m.noResize=o;m.frameBorder=m.frameSpacing=0}else{m.style.display="none";m.style.width=m.style.height=0;m.tabIndex=-1;n.body.insertAdjacentElement("afterBegin",m)}t(function(){c(m).bind("load",function(){var e=m.contentWindow;h=e[C]!==k?e[C]:"";if(h!=u()){E(l);g.hash=B(h,o)}});m.contentWindow[C]===
k&&O()},50)}t(function(){v("init");E(l)},1);if(!r())if(y&&q>7||!y&&"on"+I in j)if(j.addEventListener)j.addEventListener(I,F,l);else j.attachEvent&&j.attachEvent("on"+I,F);else ka(F,50)}},ia=function(){var a,b=c("a"),e=b.size(),f=-1,p=function(){if(++f!=e){a=c(b.get(f));a.is('[rel*="address:"]')&&a.address();t(p,1)}};t(p,1)},la=function(){if(h!=u()){h=u();E(l)}},ma=function(){if(j.removeEventListener)j.removeEventListener(I,F,l);else j.detachEvent&&j.detachEvent("on"+I,F)},ja=function(){if(d.crawlable){var a=
g.pathname.replace(/\/$/,"");c("body").html().indexOf("_escaped_fragment_")!=-1&&c('a[href]:not([href^=http]), a[href*="'+document.domain+'"]').each(function(){var b=c(this).attr("href").replace(/^http:/,"").replace(new RegExp(a+"/?$"),"");if(b===""||b.indexOf("_escaped_fragment_")!=-1)c(this).attr("href","#"+b.replace(/\/(.*)\?_escaped_fragment_=(.*)$/,"!$2"))})}},k,C="jQueryAddress",I="hashchange",W="change",X="internalChange",Y="externalChange",o=true,l=false,d={autoUpdate:o,crawlable:l,history:o,
strict:o,wrap:l},z=c.browser,q=parseFloat(c.browser.version),da=z.mozilla,y=z.msie,ea=z.opera,H=z.webkit||z.safari,P=l,j=function(){try{return top.document!==k?top:window}catch(a){return window}}(),n=j.document,M=j.history,g=j.location,ka=setInterval,t=setTimeout,U=/\/{2,9}/g;z=navigator.userAgent;var m,G=V(document),$=G?G.indexOf("?"):-1,Q=n.title,K=l,ba=l,R=o,fa=o,L=l,h=u();if(y){q=parseFloat(z.substr(z.indexOf("MSIE")+4));if(n.documentMode&&n.documentMode!=q)q=n.documentMode!=8?7:8;var ga=n.onpropertychange;
n.onpropertychange=function(){ga&&ga.call(n);if(n.title!=Q&&n.title.indexOf("#"+u())!=-1)n.title=Q}}if(P=da&&q>=1||y&&q>=6||ea&&q>=9.5||H&&q>=523){if(ea)history.navigationMode="compatible";if(document.readyState=="complete")var na=setInterval(function(){if(c.address){ca();clearInterval(na)}},50);else{aa();c(ca)}c(window).bind("popstate",la).bind("unload",ma)}else!P&&D()!==""?g.replace(g.href.substr(0,g.href.indexOf("#"))):Z();return{bind:function(a,b,e){return w(a,b,e)},init:function(a){return w("init",
a)},change:function(a){return w(W,a)},internalChange:function(a){return w(X,a)},externalChange:function(a){return w(Y,a)},baseURL:function(){var a=g.href;if(a.indexOf("#")!=-1)a=a.substr(0,a.indexOf("#"));if(/\/$/.test(a))a=a.substr(0,a.length-1);return a},autoUpdate:function(a){if(a!==k){d.autoUpdate=a;return this}return d.autoUpdate},crawlable:function(a){if(a!==k){d.crawlable=a;return this}return d.crawlable},history:function(a){if(a!==k){d.history=a;return this}return d.history},state:function(a){if(a!==
k){d.state=a;var b=s();if(d.state!==k)if(M.pushState)b.substr(0,3)=="/#/"&&g.replace(d.state.replace(/^\/$/,"")+b.substr(2));else b!="/"&&b.replace(/^\/#/,"")!=D()&&t(function(){g.replace(d.state.replace(/^\/$/,"")+"/#"+b)},1);return this}return d.state},strict:function(a){if(a!==k){d.strict=a;return this}return d.strict},tracker:function(a){if(a!==k){d.tracker=a;return this}return d.tracker},wrap:function(a){if(a!==k){d.wrap=a;return this}return d.wrap},update:function(){L=o;this.value(h);L=l;return this},
title:function(a){if(a!==k){t(function(){Q=n.title=a;if(fa&&m&&m.contentWindow&&m.contentWindow.document){m.contentWindow.document.title=a;fa=l}if(!R&&da)g.replace(g.href.indexOf("#")!=-1?g.href:g.href+"#");R=l},50);return this}return n.title},value:function(a){if(a!==k){a=N(a);if(a=="/")a="";if(h==a&&!L)return;R=o;h=a;if(d.autoUpdate||L){E(o);if(r())M[d.history?"pushState":"replaceState"]({},"",d.state.replace(/\/$/,"")+(h===""?"/":h));else{K=o;if(H)if(d.history)g.hash="#"+B(h,o);else g.replace("#"+
B(h,o));else if(h!=u())if(d.history)g.hash="#"+B(h,o);else g.replace("#"+B(h,o));y&&q<8&&d.history&&t(O,50);if(H)t(function(){K=l},1);else K=l}}return this}if(!P)return null;return N(h)},path:function(a){if(a!==k){var b=this.queryString(),e=this.hash();this.value(a+(b?"?"+b:"")+(e?"#"+e:""));return this}return N(h).split("#")[0].split("?")[0]},pathNames:function(){var a=this.path(),b=a.replace(U,"/").split("/");if(a.substr(0,1)=="/"||a.length===0)b.splice(0,1);a.substr(a.length-1,1)=="/"&&b.splice(b.length-
1,1);return b},queryString:function(a){if(a!==k){var b=this.hash();this.value(this.path()+(a?"?"+a:"")+(b?"#"+b:""));return this}a=h.split("?");return a.slice(1,a.length).join("?").split("#")[0]},parameter:function(a,b,e){var f,p;if(b!==k){var J=this.parameterNames();p=[];b=b?b.toString():"";for(f=0;f<J.length;f++){var S=J[f],A=this.parameter(S);if(typeof A=="string")A=[A];if(S==a)A=b===null||b===""?[]:e?A.concat([b]):[b];for(var T=0;T<A.length;T++)p.push(S+"="+A[T])}c.inArray(a,J)==-1&&b!==null&&
b!==""&&p.push(a+"="+b);this.queryString(p.join("&"));return this}if(b=this.queryString()){e=[];p=b.split("&");for(f=0;f<p.length;f++){b=p[f].split("=");b[0]==a&&e.push(b.slice(1).join("="))}if(e.length!==0)return e.length!=1?e:e[0]}},parameterNames:function(){var a=this.queryString(),b=[];if(a&&a.indexOf("=")!=-1){a=a.split("&");for(var e=0;e<a.length;e++){var f=a[e].split("=")[0];c.inArray(f,b)==-1&&b.push(f)}}return b},hash:function(a){if(a!==k){this.value(h.split("#")[0]+(a?"#"+a:""));return this}a=
h.split("#");return a.slice(1,a.length).join("#")}}}();c.fn.address=function(v){if(!c(this).attr("address")){var w=function(r){if(r.shiftKey||r.ctrlKey||r.metaKey)return true;if(c(this).is("a")){var s=v?v.call(this):/address:/.test(c(this).attr("rel"))?c(this).attr("rel").split("address:")[1].split(" ")[0]:c.address.state()!==undefined&&c.address.state()!="/"?c(this).attr("href").replace(new RegExp("^(.*"+c.address.state()+"|\\.)"),""):c(this).attr("href").replace(/^(#\!?|\.)/,"");c.address.value(s);
r.preventDefault()}};c(this).click(w).live("click",w).live("submit",function(r){if(c(this).is("form")){var s=c(this).attr("action");s=v?v.call(this):(s.indexOf("?")!=-1?s.replace(/&$/,""):s+"?")+c(this).serialize();c.address.value(s);r.preventDefault()}}).attr("address",true)}return this}})(jQuery);

// ColorBox v1.3.18 - a full featured, light-weight, customizable lightbox based on jQuery 1.3+
// Copyright (c) 2011 Jack Moore - jack@colorpowered.com
// Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php

(function(H,k,U){var I={transition:"elastic",speed:300,width:false,initialWidth:"600",innerWidth:false,maxWidth:false,height:false,initialHeight:"450",innerHeight:false,maxHeight:false,scalePhotos:true,scrolling:true,inline:false,html:false,iframe:false,fastIframe:true,photo:false,href:false,title:false,rel:false,opacity:0.9,preloading:true,current:"image {current} of {total}",previous:"previous",next:"next",close:"close",open:false,returnFocus:true,loop:true,slideshow:false,slideshowAuto:true,slideshowSpeed:2500,slideshowStart:"start slideshow",slideshowStop:"stop slideshow",onOpen:false,onLoad:false,onComplete:false,onCleanup:false,onClosed:false,overlayClose:true,escKey:true,arrowKey:true,top:false,bottom:false,left:false,right:false,fixed:false,data:undefined},v="colorbox",Q="cbox",p=Q+"Element",T=Q+"_open",e=Q+"_load",S=Q+"_complete",s=Q+"_cleanup",Z=Q+"_closed",i=Q+"_purge",t=H.browser.msie&&!H.support.opacity,ac=t&&H.browser.version<7,Y=Q+"_IE6",O,ad,ae,d,F,o,b,N,c,X,L,j,h,n,r,V,q,P,x,z,ab,af,l,g,a,u,G,m,B,W,K,y,J,aa="div";function E(ag,aj,ai){var ah=k.createElement(ag);if(aj){ah.id=Q+aj}if(ai){ah.style.cssText=ai}return H(ah)}function C(ah){var ag=c.length,ai=(G+ah)%ag;return(ai<0)?ag+ai:ai}function M(ag,ah){return Math.round((/%/.test(ag)?((ah==="x"?X.width():X.height())/100):1)*parseInt(ag,10))}function A(ag){return ab.photo||/\.(gif|png|jpe?g|bmp|ico)((#|\?).*)?$/i.test(ag)}function R(){var ag;ab=H.extend({},H.data(u,v));for(ag in ab){if(H.isFunction(ab[ag])&&ag.slice(0,2)!=="on"){ab[ag]=ab[ag].call(u)}}ab.rel=ab.rel||u.rel||"nofollow";ab.href=ab.href||H(u).attr("href");ab.title=ab.title||u.title;if(typeof ab.href==="string"){ab.href=H.trim(ab.href)}}function D(ag,ah){H.event.trigger(ag);if(ah){ah.call(u)}}function w(){var ah,aj=Q+"Slideshow_",ak="click."+Q,al,ai,ag;if(ab.slideshow&&c[1]){al=function(){V.text(ab.slideshowStop).unbind(ak).bind(S,function(){if(G<c.length-1||ab.loop){ah=setTimeout(J.next,ab.slideshowSpeed)}}).bind(e,function(){clearTimeout(ah)}).one(ak+" "+s,ai);ad.removeClass(aj+"off").addClass(aj+"on");ah=setTimeout(J.next,ab.slideshowSpeed)};ai=function(){clearTimeout(ah);V.text(ab.slideshowStart).unbind([S,e,s,ak].join(" ")).one(ak,function(){J.next();al()});ad.removeClass(aj+"on").addClass(aj+"off")};if(ab.slideshowAuto){al()}else{ai()}}else{ad.removeClass(aj+"off "+aj+"on")}}function f(ah){if(!K){u=ah;R();c=H(u);G=0;if(ab.rel!=="nofollow"){c=H("."+p).filter(function(){var ai=H.data(this,v).rel||this.rel;return(ai===ab.rel)});G=c.index(u);if(G===-1){c=c.add(u);G=c.length-1}}if(!B){B=W=true;ad.show();if(ab.returnFocus){try{u.blur();H(u).one(Z,function(){try{this.focus()}catch(ai){}})}catch(ag){}}O.css({opacity:+ab.opacity,cursor:ab.overlayClose?"pointer":"auto"}).show();ab.w=M(ab.initialWidth,"x");ab.h=M(ab.initialHeight,"y");J.position();if(ac){X.bind("resize."+Y+" scroll."+Y,function(){O.css({width:X.width(),height:X.height(),top:X.scrollTop(),left:X.scrollLeft()})}).trigger("resize."+Y)}D(T,ab.onOpen);z.add(n).hide();x.html(ab.close).show()}J.load(true)}}J=H.fn[v]=H[v]=function(ag,ai){var ah=this;ag=ag||{};J.init();if(!ah[0]){if(ah.selector){return ah}ah=H("<a/>");ag.open=true}if(ai){ag.onComplete=ai}ah.each(function(){H.data(this,v,H.extend({},H.data(this,v)||I,ag));H(this).addClass(p)});if((H.isFunction(ag.open)&&ag.open.call(ah))||ag.open){f(ah[0])}return ah};J.init=function(){if(!ad){if(!H("body")[0]){H(J.init);return}X=H(U);ad=E(aa).attr({id:v,"class":t?Q+(ac?"IE6":"IE"):""});O=E(aa,"Overlay",ac?"position:absolute":"").hide();ae=E(aa,"Wrapper");d=E(aa,"Content").append(L=E(aa,"LoadedContent","width:0; height:0; overflow:hidden"),h=E(aa,"LoadingOverlay").add(E(aa,"LoadingGraphic")),n=E(aa,"Title"),r=E(aa,"Current"),q=E(aa,"Next"),P=E(aa,"Previous"),V=E(aa,"Slideshow").bind(T,w),x=E(aa,"Close"));ae.append(E(aa).append(E(aa,"TopLeft"),F=E(aa,"TopCenter"),E(aa,"TopRight")),E(aa,false,"clear:left").append(o=E(aa,"MiddleLeft"),d,b=E(aa,"MiddleRight")),E(aa,false,"clear:left").append(E(aa,"BottomLeft"),N=E(aa,"BottomCenter"),E(aa,"BottomRight"))).find("div div").css({"float":"left"});j=E(aa,false,"position:absolute; width:9999px; visibility:hidden; display:none");H("body").prepend(O,ad.append(ae,j));af=F.height()+N.height()+d.outerHeight(true)-d.height();l=o.width()+b.width()+d.outerWidth(true)-d.width();g=L.outerHeight(true);a=L.outerWidth(true);ad.css({"padding-bottom":af,"padding-right":l}).hide();q.click(function(){J.next()});P.click(function(){J.prev()});x.click(function(){J.close()});z=q.add(P).add(r).add(V);O.click(function(){if(ab.overlayClose){J.close()}});H(k).bind("keydown."+Q,function(ah){var ag=ah.keyCode;if(B&&ab.escKey&&ag===27){ah.preventDefault();J.close()}if(B&&ab.arrowKey&&c[1]){if(ag===37){ah.preventDefault();P.click()}else{if(ag===39){ah.preventDefault();q.click()}}}})}};J.remove=function(){ad.add(O).remove();ad=null;H("."+p).removeData(v).removeClass(p)};J.position=function(ah,ag){var aj=0,ai=0,ak=ad.offset();X.unbind("resize."+Q);ad.css({top:-99999,left:-99999});if(ab.fixed&&!ac){ad.css({position:"fixed"})}else{aj=X.scrollTop();ai=X.scrollLeft();ad.css({position:"absolute"})}if(ab.right!==false){ai+=Math.max(X.width()-ab.w-a-l-M(ab.right,"x"),0)}else{if(ab.left!==false){ai+=M(ab.left,"x")}else{ai+=Math.round(Math.max(X.width()-ab.w-a-l,0)/2)}}if(ab.bottom!==false){aj+=Math.max(X.height()-ab.h-g-af-M(ab.bottom,"y"),0)}else{if(ab.top!==false){aj+=M(ab.top,"y")}else{aj+=Math.round(Math.max(X.height()-ab.h-g-af,0)/2)}}ad.css({top:ak.top,left:ak.left});ah=(ad.width()===ab.w+a&&ad.height()===ab.h+g)?0:ah||0;ae[0].style.width=ae[0].style.height="9999px";function al(am){F[0].style.width=N[0].style.width=d[0].style.width=am.style.width;h[0].style.height=h[1].style.height=d[0].style.height=o[0].style.height=b[0].style.height=am.style.height}ad.dequeue().animate({width:ab.w+a,height:ab.h+g,top:aj,left:ai},{duration:ah,complete:function(){al(this);W=false;ae[0].style.width=(ab.w+a+l)+"px";ae[0].style.height=(ab.h+g+af)+"px";if(ag){ag()}setTimeout(function(){X.bind("resize."+Q,J.position)},1)},step:function(){al(this)}})};J.resize=function(ag){if(B){ag=ag||{};if(ag.width){ab.w=M(ag.width,"x")-a-l}if(ag.innerWidth){ab.w=M(ag.innerWidth,"x")}L.css({width:ab.w});if(ag.height){ab.h=M(ag.height,"y")-g-af}if(ag.innerHeight){ab.h=M(ag.innerHeight,"y")}if(!ag.innerHeight&&!ag.height){L.css({height:"auto"});ab.h=L.height()}L.css({height:ab.h});J.position(ab.transition==="none"?0:ab.speed)}};J.prep=function(ah){if(!B){return}var ak,ai=ab.transition==="none"?0:ab.speed;L.remove();L=E(aa,"LoadedContent").append(ah);function ag(){ab.w=ab.w||L.width();ab.w=ab.mw&&ab.mw<ab.w?ab.mw:ab.w;return ab.w}function aj(){ab.h=ab.h||L.height();ab.h=ab.mh&&ab.mh<ab.h?ab.mh:ab.h;return ab.h}L.hide().appendTo(j.show()).css({width:ag(),overflow:ab.scrolling?ab.scrolling:"auto"}).css({height:aj()}).prependTo(d);j.hide();H(m).css({"float":"none"});if(ac){H("select").not(ad.find("select")).filter(function(){return this.style.visibility!=="hidden"}).css({visibility:"hidden"}).one(s,function(){this.style.visibility="inherit"})}ak=function(){var av,ar,at=c.length,ap,au="frameBorder",ao="allowTransparency",am,al,aq;if(!B){return}function an(){if(t){ad[0].style.removeAttribute("filter")}}am=function(){clearTimeout(y);h.hide();D(S,ab.onComplete)};if(t){if(m){L.fadeIn(100)}}n.html(ab.title).add(L).show();if(at>1){if(typeof ab.current==="string"){r.html(ab.current.replace("{current}",G+1).replace("{total}",at)).show()}q[(ab.loop||G<at-1)?"show":"hide"]().html(ab.next);P[(ab.loop||G)?"show":"hide"]().html(ab.previous);if(ab.slideshow){V.show()}if(ab.preloading){av=[C(-1),C(1)];while((ar=c[av.pop()])){al=H.data(ar,v).href||ar.href;if(H.isFunction(al)){al=al.call(ar)}if(A(al)){aq=new Image();aq.src=al}}}}else{z.hide()}if(ab.iframe){ap=E("iframe")[0];if(au in ap){ap[au]=0}if(ao in ap){ap[ao]="true"}ap.name=Q+(+new Date());if(ab.fastIframe){am()}else{H(ap).one("load",am)}ap.src=ab.href;if(!ab.scrolling){ap.scrolling="no"}H(ap).addClass(Q+"Iframe").appendTo(L).one(i,function(){ap.src="//about:blank"})}else{am()}if(ab.transition==="fade"){ad.fadeTo(ai,1,an)}else{an()}};if(ab.transition==="fade"){ad.fadeTo(ai,0,function(){J.position(0,ak)})}else{J.position(ai,ak)}};J.load=function(ai){var ah,aj,ag=J.prep;W=true;m=false;u=c[G];if(!ai){R()}D(i);D(e,ab.onLoad);ab.h=ab.height?M(ab.height,"y")-g-af:ab.innerHeight&&M(ab.innerHeight,"y");ab.w=ab.width?M(ab.width,"x")-a-l:ab.innerWidth&&M(ab.innerWidth,"x");ab.mw=ab.w;ab.mh=ab.h;if(ab.maxWidth){ab.mw=M(ab.maxWidth,"x")-a-l;ab.mw=ab.w&&ab.w<ab.mw?ab.w:ab.mw}if(ab.maxHeight){ab.mh=M(ab.maxHeight,"y")-g-af;ab.mh=ab.h&&ab.h<ab.mh?ab.h:ab.mh}ah=ab.href;y=setTimeout(function(){h.show()},100);if(ab.inline){E(aa).hide().insertBefore(H(ah)[0]).one(i,function(){H(this).replaceWith(L.children())});ag(H(ah))}else{if(ab.iframe){ag(" ")}else{if(ab.html){ag(ab.html)}else{if(A(ah)){H(m=new Image()).addClass(Q+"Photo").error(function(){ab.title=false;ag(E(aa,"Error").text("This image could not be loaded"))}).load(function(){var ak;m.onload=null;if(ab.scalePhotos){aj=function(){m.height-=m.height*ak;m.width-=m.width*ak};if(ab.mw&&m.width>ab.mw){ak=(m.width-ab.mw)/m.width;aj()}if(ab.mh&&m.height>ab.mh){ak=(m.height-ab.mh)/m.height;aj()}}if(ab.h){m.style.marginTop=Math.max(ab.h-m.height,0)/2+"px"}if(c[1]&&(G<c.length-1||ab.loop)){m.style.cursor="pointer";m.onclick=function(){J.next()}}if(t){m.style.msInterpolationMode="bicubic"}setTimeout(function(){ag(m)},1)});setTimeout(function(){m.src=ah},1)}else{if(ah){j.load(ah,ab.data,function(al,ak,am){ag(ak==="error"?E(aa,"Error").text("Request unsuccessful: "+am.statusText):H(this).contents())})}}}}}};J.next=function(){if(!W&&c[1]&&(G<c.length-1||ab.loop)){G=C(1);J.load()}};J.prev=function(){if(!W&&c[1]&&(G||ab.loop)){G=C(-1);J.load()}};J.close=function(){if(B&&!K){K=true;B=false;D(s,ab.onCleanup);X.unbind("."+Q+" ."+Y);O.fadeTo(200,0);ad.stop().fadeTo(300,0,function(){ad.add(O).css({opacity:1,cursor:"auto"}).hide();D(i);L.remove();setTimeout(function(){K=false;D(Z,ab.onClosed)},1)})}};J.element=function(){return H(u)};J.settings=I;H("."+p,k).live("click",function(ag){if(!(ag.which>1||ag.shiftKey||ag.altKey||ag.metaKey)){ag.preventDefault();f(this)}});J.init()}(jQuery,document,this));