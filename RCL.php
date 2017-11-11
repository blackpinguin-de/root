<?php
if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
  ini_set('display_errors', 'on');
}
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php')) {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
}

/*
$rcl->impressum();

$rcl->page:
    $max = letzte Seite
    $see = ? wieviele Seiten vor und nach n ?
    $n = aktuelle Seite
    $vr="<a href=\"?n=";
    $mtt="&amp;lang=$lang\">";
    $nch="</a>";
    $rcl->page($max, $see, $n, $vr, $mtt, $nch [, $first]);

$rcl->lang($de, $en);
$rcl->a($url, $de, $en);
i18n($key, $de, $en);   // set
i18n($key);             // get

$rcl->contact_send('RCL', 'id', 'secret', 'email', 'subject', 'text'); // formular-namen
list($id, $nounce) = $rcl->contact_gen_nounce();
<?=$rcl->contact_js()?>(nounce, msg);
*/


class RCL
{

var $screenreader = false;

public function __construct() {
    if(strpos($_SERVER['HTTP_USER_AGENT'], "Lynx") !== false){ $this->screenreader = true; }
}

public function init() {
    $this->initLanguage();
}

//######################################################################
//######################################################################
//######   MySQL

private $_mysqli = null;
public function mysqli_init($host = null, $user = null, $pw = null, $db = null) {
  $host = ($host ?: ini_get("mysqli.default_host"));
  $user = ($user ?: ini_get("mysqli.default_user"));
  $pw   = ($pw   ?: ini_get("mysqli.default_pw"));
  $db   = ($db   ?: "blackpinguin");

  $this->_mysqli = @mysqli_connect($host, $user, $pw);
  if ($out = @mysqli_connect_error()) { return $out; }

  if ($db) {
    @mysqli_select_db($this->_mysqli, $db);
    if ($out = @mysqli_error($this->_mysqli)) { return $out; }

    @mysqli_query($this->_mysqli, "set names 'utf8';");
    if ($out = @mysqli_error($this->_mysqli)) { return $out; }
  }
  return false;
}

public function mysqli() {
  if (! $this->_mysqli && ($out = $this->mysqli_init())) { throw new \Exception('mysqli init failure: ' . $out); }
  return $this->_mysqli;
}

//######   MySQL
//######################################################################
//######################################################################
//######   Impressum

//eindeutige ID vergeben
var $jsencn = 0;

//"Verschlüsselt" den String, so dass er nur mit JavaScript gelesen werden kann
public function jsenc($str, $jserr = null, $click = null){
    $n = $this->jsencn;
    $this->jsencn = $n + 1;
    $ret = "<script type='text/javascript' id='jsenc".$n."'>";
    $ret .= "var s = document.getElementById('jsenc".$n."');";

    $jserr = ($jserr !== null ? $jserr : $this->lang("JavaScript wird für diese Information benötigt", "JavaScript is required to view this information"));
    $click = ($click !== null ? $click : $this->lang("Hier klicken, um diese Information anzuzeigen", "Click here to view this information"));

    $ret .= "var sp = document.createElement('span');";
    $ret .= "sp.innerHTML = '{ $click }';";
    $ret .= "sp.className = 'warn';";
    $ret .= "sp.style.textDecoration = 'underline';";
    $ret .= "sp.style.cursor = 'pointer';";
    $ret .= "sp.onclick = function(){";

    $ret .= "this.innerHTML = ";
    $ret .= "(function(){function r (a,b){return++b?String.fromCharCode((a<\"[\"?91:123)>(a=a.charCodeAt()+13)?a:a-26):a.replace(/[A-z]/g,r)}; return r;}())";
    $ret .= "((\"";
    $ret .= implode("\"+\"", str_split(str_rot13(str_replace("@","&#64;",$str)), 3));
    $ret .= "\"));";
    $ret .= "this.className = '';";
    $ret .= "this.style.textDecoration = '';";
    $ret .= "this.style.cursor = '';";
    $ret .= "this.onclick = undefined;};";

    $ret .= "s.parentNode.insertBefore(sp, s);";
    $ret .= "</script><noscript><span class='warn'>{ $jserr }</span></noscript>";
    return $ret;
}

//Ausgabe des Impressums
public function impressum(){
    $arr = array(
           array(
            "Name",
            "Robin Christopher Ladiges"
        ), array(
            $this->lang("Adresse", "Address"),
            "Krupunder Weg 6<br/>D-22523 Hamburg",
            "height: 44px;", "height: 44px;"
        ), array(
        ), array(
            $this->lang("Telefon", "Phone"),
            "+49 (0) 40 / 40 16 30 38"
        ), array(
            "E-Mail",
            $this->jsenc(
                 "<a href='mailto:rcl@blackpinguin.de'>rcl@blackpinguin.de</a>"
                ." <a class='extern' target='_blank' rel='noopener' href='https://ext.blackpinguin.de/certs/rclbp.smime'>S/MIME</a>"
                ." <a class='extern' target='_blank' rel='noopener' href='https://ext.blackpinguin.de/certs/rclbp.pgp'>PGP</a>"
                ."<br/><a href='mailto:robin.ladiges@web.de'>robin.ladiges@web.de</a>"
                ." <a class='extern' target='_blank' rel='noopener' href='https://ext.blackpinguin.de/certs/rlweb.smime'>S/MIME</a>"
                ." <a class='extern' target='_blank' rel='noopener' href='https://ext.blackpinguin.de/certs/rlweb.pgp'>PGP</a>"
            ),
            "height: 44px;", "height: 44px;"
        ), array(
            "XMPP (Jabber)",
            $this->jsenc("<a href='xmpp:rcl@xmpp.blackpinguin.de?message'>rcl@xmpp.blackpinguin.de</a>")
                ."<br/><a class='extern' target='_blank' rel='noopener' href='https://en.wikipedia.org/wiki/Off-the-Record_Messaging'>OTR</a> ".$this->lang("F","f")."ingerprint: "
                ."<span style='font-size: 10px;' class='style-hell'>E500CF7A 3285F36F 79FFADF3 CB381D44 1BF9096E</span>",
            "height: 44px;", "height: 44px;"
        ), array(
            "Twitter",
            "<a class='extern' target='_blank' rel='noopener' href='https://twitter.com/Istador'>@Istador</a>"
        ), array(
            "ICQ",
            "<a class='extern' target='_blank' rel='noopener' href='http://www.icq.com/people/342538015/'>342-538-015</a><br/><a class='extern' target='_blank' rel='noopener' href='http://www.icq.com/people/176736534/' style='text-decoration: line-through;'>176-736-534</a> (".$this->lang("stillgelegt","inoperative").")",
            "height: 44px;", "height: 44px;"
        ), array(
            "Skype",
            "<a href='skype:blackpinguin?chat' style='text-decoration: line-through;'>blackpinguin</a> (".$this->lang("stillgelegt","inoperative").")"
        )
    );

    echo "<style type='text/css' scoped='scoped'>
    .impcont{ width:100%; padding-top: 5px; text-align: left; }
    .impleft{ width: 24%; padding-left: 5px; float: left; line-height: 22px; }
    .impright{ width: 73%; margin-left: 2px; padding-left: 5px; float: left; line-height: 22px; }
    .clear{clear: both;}
    .impcont span.warn { color:red; font-weight:bold; }
</style>
<div style='width: 100%; position: static;'>
    <div style='width: 100%; text-align: center; font-size:15px; font-weight: bold;'>
        ".$this->lang("Inhaltlich verantwortlich im Sinne von", "Legally responsible according to")." <a class='extern' target='_blank' rel='noopener' href='http://bundesrecht.juris.de/tmg/__5.html'>§ 5 TMG</a>
    </div>
";

foreach($arr as $i => $entry){
    echo "\n\t<div class='impcont'>";
    if(count($entry) > 0){
        echo "\n\t\t<div class='style-dunkel impleft'";
        if(isset($entry[2])){ echo " style='".$entry[2]."'"; }
        echo ">";
        echo $entry[0];
        echo "</div>\n\t\t<div class='style-hell impright'";
        if(isset($entry[3])){ echo " style='".$entry[3]."'"; }
        echo ">";
        echo $entry[1];
        echo "</div>\n\t\t<div class='clear'></div>\n\t";
    }
    echo "</div>";
}

echo "</div>";
}

//######   Impressum
//######################################################################
//######################################################################
//######   Seitennavigation

public function page($max,$see,$akt,$vor,$mitte,$nach,$first=1,$vors="[",$nachs="]"){
  if( ($akt-$see)>$first )   { $this->page_linkl($vor,$mitte,$nach,$first,"|&lt;"); }         //   |<
  if( ($akt-$see*2)>$first ) { $this->page_linkl($vor,$mitte,$nach,$akt-$see*2,"&lt;&lt;"); } //   <<
//if( ($akt-1)>=1 )     { $this->page_linkl($vor,$mitte,$nach,$akt-1,"&lt;"); }               //   <
  for ($i=$akt-$see; $i<$akt; $i++) { if($i>=$first){$this->page_linkl($vor,$mitte,$nach,$i,$i);} }//   i
  if( $akt >= $first) echo $vors.$akt.$nachs;
  for ($i=$akt+1; $i<=$akt+$see; $i++) { if($i<=$max){$this->page_linkr($vor,$mitte,$nach,$i,$i);} } // i
//if( ($akt+1)<=$max )     { $this->page_linkr($vor,$mitte,$nach,$akt+1,"&gt;"); }            //   >
  if( ($akt+$see*2)<$max ) { $this->page_linkr($vor,$mitte,$nach,$akt+$see*2,"&gt;&gt;"); }   //   >>
  if(($akt+$see)<$max)     { $this->page_linkr($vor,$mitte,$nach,$max,"&gt;|"); }             //   >|
}

protected function page_echo($var) { if($var != "") {echo $var;} }

protected function page_link($vor, $mitte, $nach, $index, $text){
  $this->page_echo($vor);
  if($vor!="" && $mitte!=""){echo $index;}
  $this->page_echo($mitte);
  echo $text;
  $this->page_echo($nach);
}

protected function page_linkl($vor,$mitte,$nach,$index,$text){$this->page_link($vor,$mitte,$nach,$index,$text);echo " ";}

protected function page_linkr($vor,$mitte,$nach,$index,$text){echo " ";$this->page_link($vor,$mitte,$nach,$index,$text);}

//######   Seitennavigation
//######################################################################
//######################################################################
//######   Fußnoten

var $refid = 0;
var $refs = array();

//neue Fußnote
public function newFoot($desc){
    echo $this->newFootStr($desc);
}

public function newFootStr($desc){
    $this->refs[++$this->refid] = $desc;
    $str = "<span class='ref'>";
    $str .= "<span class='refnum'>";
    if(!$this->screenreader) $str .= "<span class='jsonly'>[".$this->refid."]</span>";
    $str .= "<noscript><a class='reflink' id='reftop".$this->refid."' href='#ref".$this->refid."'>[".$this->refid."]</a></noscript>";
    $str .= "</span>";
    if(!$this->screenreader) $str .= "<span class='refbody'>".$desc."</span>";
    $str .= "</span>";
    return $str;
}

//alle Fußnoten ausgeben
public function printFoots(){
    if($this->refid > 0){
        echo "<noscript><hr/><table id='reftable'><caption>".$this->lang("Fußnoten", "Footnotes")."</caption><tbody>";
        for($i = 1; $i <= $this->refid; $i++){
            echo "<tr><th><a class='reflink' href='#reftop".$i."' id='ref".$i."'>[".$i."]</a></th><td>".$this->refs[$i]."</td></tr>";
        }
        echo "</tbody></table>";
        echo "<p class='c'>".$this->lang("Empfehlung: JavaScript aktivieren, um Fußnoten nur bei Bedarf einzublenden.", "Suggestion: enable JavaScript to display footnotes only when needed.")."</p>";
        echo "</noscript>";
    }
}

//######   Fußnoten
//######################################################################
//######################################################################
//######   Sprache

var $lang = null;
var $langEqual = true;
var $langMap = array();

public function i18n($key, $de = null, $en = null){
    if($de === null && $en === null) {
        return isset($this->langMap[$key]) ? $this->langMap[$key] : "${".$key."}";
    }
    $this->langMap[$key] = $this->lang($de, $en);
}

protected function initLanguage(){
    //nur einmal initialisieren
    if($this->lang !== null) return;
    //einlesen
    $browser = ( isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ? substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2) : "en" );
    $this->lang = get("lang");
    //ob links nicht ergänzt werden müssen
    if($this->lang !== "" && $browser !== $this->lang) $this->langEqual = false;
    //nur de oder en
    if($this->lang !== "de" && $this->lang !== "en")
        if($browser === "de") $this->lang = "de";
        else $this->lang = "en";
}

//entweder de oder en String
public function lang($de, $en){
    if(isset($de) && $this->lang === "de") return $de;
    else if(isset($en) && $this->lang === "en") return $en;
    else if(isset($de) && !isset($en)) return $de;
    else if(!isset($de) && isset($en)) return $en;
    else "";
}

//echo Link
public function a($url, $de, $en){
    echo "<a href=\"";
    $this->href($url);
    echo "\">".$this->lang($de, $en)."</a>";
}

public function href($url){
    if($this->langEqual) echo $url;
    else echo $url.$this->lang("?lang=de","?lang=en");
}

//######   Sprache
//######################################################################
//######################################################################
//######   Kontaktformular

public function contact_gen_nounce(){
    if(! isset($_SESSION['RCL::contact-id'])){
        $_SESSION['RCL::contact-id'] = (int) mt_rand();
        $_SESSION['RCL::contact-nounce'] = (int) mt_rand();
    }
    $_SESSION['RCL::contact-time'] = (int) time();
    sleep(1);
    return array(
          $_SESSION['RCL::contact-id']
        , $_SESSION['RCL::contact-nounce']
    );
}

public function contact_js(){
    return "function(n,s){"
            ."s=s.trim().replace(/[^a-z0-9]/gi,'');"
            ."var c=n;"
            ."for(var i=0;i<s.length;i++){"
                ."c=c^((c<<8)^s.charCodeAt(i));"
            ."}"
            ."return Math.abs(c^~n);"
        ."}"
    ;
}

public function contact_send($system, $id_id, $id_secret, $id_email, $subject_id, $id_text){
    // Exception-Handling (Error 8)
    try {
        // Validate ID (Error 1)
        if(! isset($_SESSION['RCL::contact-id'])){return 1;}
        $id = (int) trim(post($id_id));
        $saved_id = (int) $_SESSION['RCL::contact-id'];
        if($id !== $saved_id){sleep(3); return 1;}

        // Validate E-Mail (Error 2)
        $email = trim(post($id_email));
        if(! preg_match('/^[^@]+@[^@\.]{2,64}(\.[^@\.]{2,64})*\.[^@\.\d]{2,64}\.?$/i', $email)){sleep(3); return 2;}
        if(! preg_match('/^[\w\d@\-_+\.]+$/i', $email)){sleep(3); return 2;}
        if(  preg_match('/^.+@(.*\.)?blackpinguin(\.spdns)?\.de$/i', $email)){sleep(3); return 2;}
        if(! filter_var($email, FILTER_VALIDATE_EMAIL)){sleep(3); return 2;}

        // Validate Text (Error 3)
        $text = trim(post($id_text));
        $_text = preg_replace('/\s/i', '', $text);
        if(strlen($_text) < 20 || strlen($text) > 3000){sleep(3); return 3;}

        // Validate Subject (Error 4)
        $subject = trim(post($subject_id));
        $_subject = preg_replace('/\s/i', '', $subject);
        if(strlen($_subject) < 5 || strlen($subject) > 80){sleep(3); return 4;}

        // Validate Secret derived from Text and Nounce (Error 5)
        $strip = preg_replace("/[^a-z0-9]/i", "", $text);
        $secret = (int) trim(post($id_secret));
        $nounce = (int) $_SESSION['RCL::contact-nounce'];
        $code = $nounce;
        for($i = 0; $i < strlen($strip); $i++){
            $code = ($code ^ (($code << 8) ^ ord($strip[$i]))) & 0x7fffffff;
        }
        $code = abs($code ^ ~$nounce);
        if($code !== $secret){sleep(3); echo "g"; return 5;}

        // Validate Time (Error 7)
        $now = (int) time();
        $then = (int) $_SESSION['RCL::contact-time'];
        if($now <= $then + 2) {sleep(3); return 7;}

        // Additional Informations for me
        $body  = "[Important: If this message is spam, please imediately notify me via rcl@blackpinguin.de]\n\n";
        $body .= "Nachricht über das Kontaktformular auf ".$_SERVER['HTTP_HOST']."\n";
        $body .= "Von: " . $_SERVER['REMOTE_ADDR'];
        $body .= " (" . gethostbyaddr($_SERVER['REMOTE_ADDR']) . ")" ;
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $body .= " [ " . $_SERVER['HTTP_X_FORWARDED_FOR'] . " ]";
        }
        $body .= "\nUm: " . date('Y-m-d H:i:s T');
        $body .= "\nBrowser: " . $_SERVER['HTTP_USER_AGENT'];
        $body .= "\n\n";
        $body .= $text;
        $body .= "\n\n[Important: If this message is spam, please imediately notify me via rcl@blackpinguin.de]";

        // Send mail (Error 6)
        $message = (new Swift_Message)
            ->setSender('php@blackpinguin.de')
            ->setFrom($email)
            ->setReplyTo($email)
            ->setTo(array('rcl@blackpinguin.de' => 'Robin C. Ladiges'))
            ->setSubject("[$system]".$this->lang("[Kontaktformular] ", "[Contact Form] ").$subject)
            ->setBody($body, 'text/plain')
        ;
        $transport = new Swift_SendmailTransport;
        $mailer = new Swift_Mailer($transport);

        $success = $mailer->send($message) === 1;
        if($success){
            unset($_SESSION['RCL::contact-id']);
            unset($_SESSION['RCL::contact-nounce']);
            $_SESSION['RCL::contact-sent'] = true;
        }

        sleep(1);
        return $success ? 0 : 6;

    } catch (Exception $e) {
        sleep(3);
        return 8;
    }
}

//######   Kontaktformular
//######################################################################
//######################################################################
//######   Ende
}
//Objekt erstellen
$rcl = new RCL();

// simple functions without $rcl->
function i18n($key, $de = null, $en = null) { global $rcl; return $rcl->i18n($key, $de, $en); }

function mysql_init($host = null, $user = null, $pw = null, $db = null) {
  global $rcl; return $rcl->mysqli_init($host, $user, $pw, $db);
}
function mysql_close($conn = null) {
  global $rcl; return mysqli_close($conn ?: $rcl->mysqli());
}
function mysql_query($qry, $conn = null) {
  global $rcl; return mysqli_query($conn ?: $rcl->mysqli(), $qry);
}
function mysql_fetch_object($res) { return mysqli_fetch_object($res); }
function mysql_num_rows($res) { return mysqli_num_rows($res); }
function mysql_real_escape_string($str) {
  global $rcl; return mysqli_real_escape_string($rcl->mysqli(), $str);
}

$rcl->init();

