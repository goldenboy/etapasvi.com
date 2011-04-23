var quote_list = new Array(
<?php 
foreach($quote_list as $i=>$quote): 
    echo '"' . addslashes(html_entity_decode($quote->getTitle())) . '"';
    if ($i != count($quote_list) - 1) {
        echo ', ';
    }
endforeach
?>
);
var audio_list = new Array(
<?php 
foreach($audio_list as $i=>$audio): 
    echo '"' . addslashes(html_entity_decode($audio->getRemote())) . '"';
    if ($i != count($audio_list) - 1) {
        echo ', ';
    }
endforeach 
?>
);