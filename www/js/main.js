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
var cb_resize_period = 100;
// пространство, изначально выделяемое для комментариев
var cb_comments_height = 500;
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
	$("span.lang_selector").colorbox({inline:true, fixed:true, href:"#lang_box", opacity:"0.5", transition:"none", close:"X"});

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
    if ($(window).width() < window_size_hide_el) {
        $("#wrapper").css('margin-left', '70px');
    } else {
        $("#wrapper").css('margin-left', 'auto');
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
            document.title = content_title;
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
    //cb_height = rect_height+cb_comments_height;
    
    // если колорбокс только открылся, делать resize нельзя,
    // т.к. объекты внутри ещё не подгружены    
    cbResize();
    //setTimeout(function(){ cbResize(); }, cb_resize_period);
    
    //setTimeout(function(){ $.colorbox.resize(); }, cb_resize_period);
    // каждую секунду вызываем resize
    //setTimeout(function(){ cbResize(); }, cb_resize_period);
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
    cb_prev_dusqus_url        = disqus_url;
    cb_prev_disqus_identifier = disqus_identifier;
    
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