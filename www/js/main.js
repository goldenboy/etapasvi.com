ar ap_stopAll = function(){};
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

// оформляем или отключаем подписку
function subscribeClick( subscribeCheckbox, url ) 
{
	if (!url) return;
	if (subscribeCheckbox.checked == true) {
		value = 1;
	} else {
		value = 0;
	}

	$.getJSON(url + "/value/" + value, function(data) {	
		if (data.redirect != '') {
			window.location.href = data.redirect;		
		}
	});
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