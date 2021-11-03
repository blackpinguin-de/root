<?php
if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
  ini_set('display_errors', 'on');
}
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php')) {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
}


//Zeitzone setzen
date_default_timezone_set("Europe/Berlin");

//MySQL-Verbindung für mysql_real_escape_string
function get($value) { if(isset($_GET[$value])) { return mysql_real_escape_string($_GET[$value]);  } else return ""; }
function post($value){ if(isset($_POST[$value])){ return mysql_real_escape_string($_POST[$value]); } else return ""; }

/*
//Laptop
function get($value){   if(isset($_GET[$value])) return $_GET[$value]; else return ""; }
function post($value){   if(isset($_POST[$value])) return $_POST[$value]; else return ""; }
*/

function sha256($value){ return hash("sha256",$value); }
function sha512($value){ return hash("sha512",$value); }


function strtoup($string){
  $low = array("ü" => "Ü", "ö" => "Ö", "ä" => "Ä");
  return strtoupper(strtr($string, $low));
}


function alink($url,$show){
  //$jsfile=substr($url,0,-3).'js';
  echo '<a href="javascript:ajaxget(\''.$url.'\',\'content\');';
  //if(file_exists($jsfile)){echo 'ajaxget(\''.$jsfile.'\',\'content-ext\');';}
  echo '">',$show,'</a>';
}


function bb($text){
  for($i=0; $i<10; $i++){
    $text = eregi_replace("\[b\]([^\[]+)\[/b\]","<b>\\1</b>",$text);
    $text = eregi_replace("\[i\]([^\[]+)\[/i\]","<i>\\1</i>",$text);
    $text = eregi_replace("\[u\]([^\[]+)\[/u\]","<u>\\1</u>",$text);
    $text = eregi_replace("\[url\]([^\[]+)\[/url\]","<a href=\"\\1\" target=\"_blank\" rel=\"noopener\">\\1</a>",$text);
    $text = eregi_replace("\[url=\"([^\"]+)\"]([^\[]+)\[/url\]","<a href=\"\\1\" target=\"_blank\" rel=\"noopener\">\\2</a>",$text);
  }
  $text = str_replace("\n", "<br />", $text);
  return $text;
}


function text_to_html($text){

  $text = str_replace("&","&amp;",$text);
  $text = str_replace("<","&lt;",$text);
  $text = str_replace(">","&gt;",$text);
  $text = str_replace("\"","&quot;",$text);

  $text = preg_replace("(\r\n|\n|\r)","<br>",$text);
  return $text;
}


//Zufallsgenerator von OpenSSL
function sec_rand($min, $max){
    //identisch
    if($min == $max)
        return $min;
    //falsche reihenfolge
    if($min > $max){
        $tmp = $min;
        $min = $max;
        $max = $tmp;
    }
    $range = ((int)$max) - ((int)$min) + 1;
    $log = log($range, 2);
    $bytes = (int) ($log / 8) + 1;
    $bits = (int) $log + 1;
    $filter = (int) (1 << $bits) - 1;
    $length = (int)($range /  256) + 1;
    $s = true;
    do {
        $r = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes, $s)));
        $r = $r & $filter;
    } while($r >= $range);
    return $min + $r;
}


include("/rcl/www/RCL.php");
?>
