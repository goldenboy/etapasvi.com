<?php
$file = 'C:\s1\apps\glam\i18n\pl_PL\messages.xml';
//xliff from symfony 1.2.5


function stripslashes_deep($value)
{
    $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);

    return $value;
}

if((function_exists("get_magic_quotes_gpc") && get_magic_quotes_gpc())    || (ini_get('magic_quotes_sybase') && (strtolower(ini_get('magic_quotes_sybase'))!="off")) ){
    $_GET = stripslashes_deep($_GET);
    $_POST = stripslashes_deep($_POST);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
    <title>
      XLIFF EDIT
    </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <style type="text/css">
/*<![CDATA[*/
        body {font-size:75%; color:#333}
        #xliffList { list-style-type: none; margin: 0; padding: 0; width: 90%; }
        #xliffList li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; border:1px solid #999; background-color:#eee; display: block; border-left:4px solid #999; position:relative; -webkit-border-radius: 20px; /* Safari, Chrome */ -khtml-border-radius: 20px;    /* Konqueror */ -moz-border-radius: 20px; /* Firefox */ border-radius: 20px;}
        #xliffList li:hover { border-color:#222}
        #xliffList .changed { border-left:4px solid #333}
        #xliffList li label  { display: block;}
        #xliffList li label small { color:#666 }
        #xliffList li label input { width: 100%; display:block; border:none; border-bottom:1px solid #aaa; background-color:#eee }
        #xliffList li input:focus {  background-color:#ddd }
        #prev textarea { width:100%; height:400px; }
        #xliffList span.del {position:absolute; top:2px; right:2px; font-size:9px; width:4ex; height:1em; color: #F00; cursor: pointer;}
        #xliffList li.del { border-color: #f00; }
    /*]]>*/
    </style>
    <script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
    <script type="text/javascript">

//<![CDATA[

        $(function() {
                $("#xliffList input").change(function () {
                    $(this).parent().parent().addClass('changed');
                });

                $("#xliffList span.del").click( function() {
                    var unit = $(this).parent('.unit');
                    unit.addClass('del');
                    if (confirm('delete ›  '+ $(this).parent('li').children('input').val()+'  ‹ ?')) {
                        unit.fadeOut('slow', function() { unit.remove() } );
                    }
                    else {
                        unit.removeClass('del');
                    };
                });
                $("#xliffList li").css('border-radius', '10px');

                $('#prev textarea').click( function() {
                    $(this).select();
                });
        });
    //]]>
    </script>
  </head>
  <body>
    <form method="post" action="#prev">
      <ul id="xliffList">
<?php
$xmlSource = file_get_contents($file);
$xml = new SimpleXMLElement($xmlSource);
$i=1;
foreach ($xml->file->body->{'trans-unit'} as $transUnit) {
   echo '
   <li class="unit">
           <input type="hidden" value="'.htmlspecialchars($transUnit->source, ENT_QUOTES).'" name="source[]" />
       <label>
           <small>'.$transUnit['id'].' ['.$i.'] </small>
           <span>'.htmlspecialchars($transUnit->source, ENT_QUOTES).'</span>
           <input type="text" value="'.( isset($_POST['target'][$i]) ? htmlspecialchars($_POST['target'][$i], ENT_QUOTES) : htmlspecialchars($transUnit->target, ENT_QUOTES) ).'" name="target[]" />
       </label>
       <span class="del">[x]</span>
   </li>';
   $i++;
}


?>
       </ul>
       <input type="submit" value="go" name="go" />
    </form>


<?php
if(isset($_POST['go']) && isset($_POST['target']) && isset($_POST['source']) ){
$size = sizeof($_POST['source']);
echo '<div id="prev"> <textarea>';
    //print_r($_POST['source']);
    //print_r($_POST['target']);
for($i=0; $i<$size; $i++)
{
    echo '
      &lt;trans-unit id="'.($i+1).'"&gt;
        &lt;source&gt;'.htmlspecialchars($_POST['source'][$i], ENT_QUOTES).'&lt;/source&gt;
        &lt;target&gt;'.htmlspecialchars($_POST['target'][$i], ENT_QUOTES).'&lt;/target&gt;
      &lt;/trans-unit&gt;';
}
echo '</textarea> </div>';
}

?>
  </body>
</html>

