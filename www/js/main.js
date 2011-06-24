var ap_stopAll = function(){};
var audioplayer  = false;

$(document).ready(function(){
    // random quote    
    if (quote_list) {
        var quote_index = Math.floor(Math.random( ) * (quote_list.length));
        if (quote_list[ quote_index ]) {
            $("#bubble_quote p").html( quote_list[ quote_index ] + '...' );
        }
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
	$(".lang_selector").click(
		function (event) {
			event.stopPropagation();
			if ( $("#lang_list").is(":hidden") ) {
				$("#lang_list").slideDown("fast");
			} else {
				$("#lang_list").slideUp("fast");
			}
		}
	);

	$("html").click(
		function () {
			$("#lang_list").slideUp("fast");
		}
	);
});

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

    $("#photo_content").load(content_href, function(response, status, xhr) {

        if (status == "error") {
            $("#photo_loader").hide();
            if (global_photo_href) {
                window.location = global_photo_href;
                return;
            }            
        } else {            
            // модификация URL
            if (history && history.pushState) {
                history.pushState({isMine:true}, 'title',  global_photo_href );
            } else {
                $.address.value('/!' + href); 
            }
            // title
            var content_title = $("#photo_content_title").text() + ' - eTapasvi.com';
            if (content_title) {
                document.title = content_title;
            }
            // culture switcher
            cur_href_no_culture = href.replace(/[^\/]+\//, '');
            $("#lang_list a").each(function(index) {
                culture_href = $(this).attr('href').replace(/(http:\/\/[^\/]+\/[^\/]+\/).*/, '$1' + cur_href_no_culture);
                
                $(this).attr('href', culture_href);
            });
        }
    });
}

// получение адреса из хэша и загрузка фото
function loadPhotoContentFromHash(domain)
{    
    var hash_url = $.address.value();
    if (hash_url && hash_url.substr(0, 2) == '/!') {            
        loadPhotoContent( hash_url.substr(2, hash_url.length), true, domain );
    }
}