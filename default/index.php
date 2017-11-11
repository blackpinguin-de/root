<?php
$param="";
$rq = "";

foreach ($_GET as $name=>$value)
    {
    if ($name == "rquri")
		{
		$rq = $value;
		}
	else
        {
        if ($param == "") {$param = "?";}
        else {$param .= "&amp;";}
        $param .= "$name=$value";
        }
    }
if($rq==""){$rq="/";}
$url = "https://".$_SERVER['SERVER_NAME'].$rq.$param;
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="de">
<head>
	<title>Diese Seite erfordert eine gesicherte HTTPS-Verbindung </title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="content-language" content="de">
	<meta name="DC.Language" content="de">
	<meta name="author" content="Robin Christopher Ladiges">
	<meta name="DC.Creator" content="Robin Christopher Ladiges">
	<meta name="robots" content="all">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

	<style title="Standard (blau / gelb)" type="text/css">
		*{ font-family:helvetica; font-size:10pt;}
		body{ background-color:#e0e0e0; }
		a{ color:#005500; text-decoration:none; }
		img{ max-width:100%; border:0px; }
		.img-box{ width:100%; text-align:center; }

		.round{ border-width:2px; border-style:outset; border-color:#000000; -moz-border-radius:10px; border-radius:10px; } 
		.sub{ padding: 4px 8px 4px 8px; margin: 4px 0px 0px 0px; background-color:#ffff99; border-color:#ffff99; }

		div.title { text-align:center; }
		.title{ font-size:14pt; font-weight:bold; color:#000000; }
		.header{ font-size:12pt; font-weight:bold; }

		.clickon{ font-weight:bold; }
		a.clickon{ color:#ff0000; text-decoration:underline; }

		.fingerprint{ font-size:6pt; }
		.certclass{ font-size:8pt; }

		#main{ width:100%; min-width:550px; max-width:1200px; margin: 0 auto;}
		#round{ padding: 0px 4px 4px 4px; background-color:#aaaaff; border-color:#aaaaff; }

		#url{ text-align:center; font-size:10pt; color:#ffffff; background-color:#555555; border-color:#555555; }
		#url-link{ font-size:20pt; display:block; background-color:#55ff55; border-color:#55ff55; }

		#solution-left{ float:left; width:50%; }
		#solution-right{ float:right; width:50%; }
		div.solution-cacert{ margin-right:2px; }
		div.solution-exception{ margin-left:2px; }
		#solution-clear{ clear:both; }

		.footer{ font-size:10pt; }
		div.footer{ text-align:center; height:31px; }
		a.footer{ color:#000000; font-weight:bold; }
		
		#cc{ display:block; float:right; width:88px; height:31px; background-image:url('cc.png'); }
		#w3c{ display:block; float:left; width:88px; height:31px; background-image:url('w3c.png'); }
	</style>
	
</head>
<body>
<div id="main">
	<div id="round" class="round">
	
		<!-- URL with https instead of http -->
		<div id="url" class="round sub">
			<div>Die von Ihnen aufgerufene Seite ist unter folgender URL erreichbar:</div>
			<a id="url-link" class="round sub clickon" href="<?php echo $url; ?>"><?php echo $url ?></a>
		</div>
	
		<!-- Title -->
		<br><div class="title">Diese Seite erfordert eine gesicherte <a class="title" href="https://secure.wikimedia.org/wikipedia/de/wiki/Hypertext_Transfer_Protocol_Secure" target="_blank" rel="noopener">HTTPS</a>-Verbindung</div>
		
		<!-- Reason why HTTPS is forced -->
		<div class="round sub">
			<span class="header">Warum wird keine <a class="header" href="https://secure.wikimedia.org/wikipedia/de/wiki/Hypertext_Transfer_Protocol" target="_blank" rel="noopener">HTTP</a>-Verbindung zugelassen?</span>
			<br>Weil eine <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Hypertext_Transfer_Protocol" target="_blank" rel="noopener">HTTP</a>-Verbindung unsicher ist. Jeder in ihrem Netzwerk (<a href="https://secure.wikimedia.org/wikipedia/de/wiki/Wireless_Local_Area_Network" target="_blank" rel="noopener">WLAN</a>, <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Global_System_for_Mobile_Communications" target="_blank" rel="noopener">GSM</a>, ...), ihr <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Internetdienstanbieter" target="_blank" rel="noopener">Internetprovider</a>, ihre Regierung, Regierungen anderer Länder und viele weitere hätten die Möglichkeit zu erfahren welche Internetseite sie aufrufen und was sie auf dieser machen. Z.B. könnten so Dritte die Zugangsdaten zu ihrem <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Benutzerkonto" target="_blank" rel="noopener">Benutzerkonto</a> erfahren.
		</div>
		
		<!-- nothing to hide -->
		<div class="round sub">
			<span class="header">Aber ich habe doch nichts zu verbergen und auf dieser Seite habe ich keinen <a class="header" href="https://secure.wikimedia.org/wikipedia/de/wiki/Benutzerkonto" target="_blank" rel="noopener">Account</a>!</span>
			<br>Auch wenn sie nichts zu verbergen haben, lohnt sich eine geschützte Verbindung. Mit ihr können sie sich relativ sicher sein auch mit der richtigen Internetseite zu kommunizieren. Das ist nicht nur eine Frage des <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Phishing" target="_blank" rel="noopener">Phishings</a>, sondern auch der <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Integrit%C3%A4t_(Informationssicherheit)" target="_blank" rel="noopener">Integrität</a> der Seite selbst. Andernfalls könnten Dritte die Seite verfälschen, z.B. in dem Werbung eingeblendet wird, oder <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Computervirus" target="_blank" rel="noopener">Viren</a> und <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Trojanisches_Pferd_(Computerprogramm)" target="_blank" rel="noopener">Trojaner</a> angehängt werden.
		</div>
		
		<!-- how HTTPS works -->
		<div class="round sub">
			<span class="header">Wie funktioniert <a class="header" href="https://secure.wikimedia.org/wikipedia/de/wiki/Hypertext_Transfer_Protocol_Secure" target="_blank" rel="noopener">HTTPS</a>?</span>
			<br>Wenn Sie eine Seite über <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Hypertext_Transfer_Protocol_Secure" target="_blank" rel="noopener">HTTPS</a> aufrufen, wird zuerst der entsprechende <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Webserver" target="_blank" rel="noopener">Server</a> anhand seiner <a href="https://secure.wikimedia.org/wikipedia/de/wiki/IP-Adresse" target="_blank" rel="noopener">IP-Adresse</a> angesprochen. Ihr <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Webbrowser" target="_blank" rel="noopener">Browser</a> bekommt dann ein <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Digitales_Zertifikat" target="_blank" rel="noopener">Zertifikat</a> ausgehändigt, in dem unter anderem steht für welche <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Domain" target="_blank" rel="noopener">Domain</a> das <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Digitales_Zertifikat" target="_blank" rel="noopener">Zertifikat</a> zuständig ist. Wichtig in dem <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Digitales_Zertifikat" target="_blank" rel="noopener">Zertifikat</a> ist vorallem der öffentliche <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Schl%C3%BCssel_%28Kryptologie%29" target="_blank" rel="noopener">Schlüssel</a>. Mit diesem kann ihr <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Webbrowser" target="_blank" rel="noopener">Browser</a> <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Verschl%C3%BCsselung" target="_blank" rel="noopener">verschlüsselte</a> Anfragen an den <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Webserver" target="_blank" rel="noopener">Server</a> senden, die nur er und niemand sonst lesen kann. Über solche Anfragen einigen sich ihr <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Webbrowser" target="_blank" rel="noopener">Browser</a> und der <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Webserver" target="_blank" rel="noopener">Server</a> wie Ihrem <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Webbrowser" target="_blank" rel="noopener">Browser</a> die gewünschte Seite <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Verschl%C3%BCsselung" target="_blank" rel="noopener">verschlüsselt</a> übermittelt werden kann.
		</div>
		
		<!-- sec_error_unknown_issuer -->
		<div class="round sub">
			<span class="header">Warum kommt eine "Dieser Verbindung wird nicht vertraut" Fehlermeldung?</span>
			<br>Das liegt daran, dass das <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Digitales_Zertifikat" target="_blank" rel="noopener">Zertifikat</a> dieses <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Webserver" target="_blank" rel="noopener">Servers</a> von einer <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Zertifizierungsstelle" target="_blank" rel="noopener">Zertifizierungsstelle</a> ausgestellt wurde, die (<a href="http://wiki.cacert.org/InclusionStatus" target="_blank" rel="noopener">noch</a>) nicht standardmäßig in allen <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Webbrowser" target="_blank" rel="noopener">Browsern</a> integriert ist. Das diese <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Zertifizierungsstelle" target="_blank" rel="noopener">Zertifizierungsstelle</a> gewählt wurde liegt daran, dass andere <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Zertifizierungsstelle" target="_blank" rel="noopener">Zertifizierungsstellen</a> sehr hohe Gebühren für die von ihnen unterschriebenen <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Digitales_Zertifikat" target="_blank" rel="noopener">Zertifikate</a> verlangen. Um diese Internetseite aufzurufen ist es entweder nötig die <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Zertifizierungsstelle" target="_blank" rel="noopener">Zertifizierungsstelle</a> als vertrauenswürdig einzustufen, oder eine Ausnahme für das <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Digitales_Zertifikat" target="_blank" rel="noopener">Zertifikat</a> anzulegen.
		</div>

		<!-- how to resolve error-warnings -->
		<div id="solution">
		
			<!-- LEFT: trust CAcert -->
			<div id="solution-left">
			
				<!-- how to trust CAcert in Firefox -->
				<div class="solution-cacert round sub">
					<span class="header"><a class="header" href="http://www.cacert.org/" target="_blank" rel="noopener">CAcert</a> als vertrauensvolle <a class="header" href="https://secure.wikimedia.org/wikipedia/de/wiki/Zertifizierungsstelle" target="_blank" rel="noopener">Zertifizierungsstelle</a> einrichten</span>
					<br>In <a href="https://www.mozilla.org/" target="_blank" rel="noopener">Mozilla</a> <a href="https://www.mozilla.org/firefox" target="_blank" rel="noopener">Firefox</a> klicken sie <a class="clickon" href="http://www.cacert.org/certs/root.crt">hier</a> (Klasse&nbsp;1) und <a class="clickon" href="http://www.cacert.org/certs/class3.crt">hier</a> (Klasse&nbsp;3), und vertrauen <a href="http://www.cacert.org/" target="_blank" rel="noopener">CAcert</a> anhand folgenden Bildes als <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Zertifizierungsstelle" target="_blank" rel="noopener">Zertifizierungsstelle</a>:
					<br><br><div class="img-box"><a href="ca.png"><img src="ca.png" alt="CA vertrauen"></a></div>
					<br>Achten Sie hierbei auf jedenfall mit einen Klick auf <span class="clickon">"Ansicht"</span>, dass die Fingerabdrücke mit den folgenden übereinstimmen:
					<br>
					<br><span class="certclass">Klasse 1</span>
					<br><span class="fingerprint">SHA1: 13:5C:EC:36:F4:9C:B8:E9:3B:1A:B2:70:CD:80:88:46:76:CE:8F:33<br>MD5: A6:1B:37:5E:39:0D:9C:36:54:EE:BD:20:31:46:1F:6B</span>
					<br><span class="certclass">Klasse 3</span>
					<br><span class="fingerprint">SHA1: AD:7C:3F:64:FC:44:39:FE:F4:E9:0B:E8:F4:7C:6C:FA:8A:AD:FD:CE<br>MD5: F7:25:12:82:4E:67:B5:D0:8D:92:B7:7C:0B:86:7A:42</span>
				</div>
				
				<!-- better then exception -->
				<div class="solution-cacert round sub">
					<span class="header">Warum lohnt es sich dies statt einer Ausnahme zu tun?</span>
					<br>Eine Ausnahme gilt nur für ein ganz bestimmtes <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Digitales_Zertifikat" target="_blank" rel="noopener">Zertifikat</a>, wenn sie hingegen die <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Zertifizierungsstelle" target="_blank" rel="noopener">Zertifizierungsstelle</a> als vertrauenswürdig einstellen, müssen Sie nicht für jedes <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Digitales_Zertifikat" target="_blank" rel="noopener">Zertifikat</a> dieser <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Zertifizierungsstelle" target="_blank" rel="noopener">Zertifizierungsstelle</a> eine eigene Ausnahmeregel anlegen, sondern ihr <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Webbrowser" target="_blank" rel="noopener">Browser</a> akzeptiert diese <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Digitales_Zertifikat" target="_blank" rel="noopener">Zertifikate</a> automatisch.
				</div>
				
				<!-- other browser -->
				<div class="solution-cacert round sub">
					<span class="header">Und wie mache ich das in anderen <a class="header" href="https://secure.wikimedia.org/wikipedia/de/wiki/Webbrowser" target="_blank" rel="noopener">Browsern</a>?</span>
					<br>Eine umfassende (englische) Anleitung um <a href="http://www.cacert.org/" target="_blank" rel="noopener">CAcert</a> in anderen <a href="https://secure.wikimedia.org/wikipedia/de/wiki/Webbrowser" target="_blank" rel="noopener">Browsern</a> als vertrauenswürdig einzustellen finden Sie <a href="http://wiki.cacert.org/BrowserClients" target="_blank" rel="noopener">hier</a>.
				</div>
			</div>
			
			<!-- RIGHT: Firefox exception -->
			<div id="solution-right">
				<div class="solution-exception round sub">
					<span class="header">Eine Ausnahmeregel in <a class="header" href="https://www.mozilla.org/" target="_blank" rel="noopener">Mozilla</a> <a class="header" href="https://www.mozilla.org/firefox" target="_blank" rel="noopener">Firefox</a> anlegen</span>
					<br><br><div class="img-box"><a href="exc1.png"><img src="exc1.png" alt="Dieser Verbindung wird nicht vertraut"></a></div>
					<br>Auf der Seite auf der sie eine "Dieser Verbindung wird nicht vertraut" Fehlermeldung bekommen klicken Sie auf <span class="clickon">"Ich kenne das Risiko"</span> und anschließend auf <span class="clickon">"Ausnahmen hinzufügen..."</span>.
					<br><br><div class="img-box"><a href="exc2.png"><img src="exc2.png" alt="Sicherheits-Ausnahmeregel hinzufügen"></a></div>
					<br>In dem sich nun öffnenden Fenster klicken Sie auf <span class="clickon">"Sicherheits-Ausnahmeregel bestätigen"</span> und Sie sind fertig.
				</div>
				<!--
				<div class="solution-exception round sub">
					<span class="header">Und wie mache ich das in anderen <a class="header" href="https://secure.wikimedia.org/wikipedia/de/wiki/Webbrowser" target="_blank" rel="noopener">Browsern</a>?</span>
					<br>&lt;to do&gt;
				</div>				
				-->
				
			</div>
			
			<div id="solution-clear"></div>
		</div>

		<!-- Usefull FireFox-Addons for HTTPS usage -->
		<!--
		<div id="ff-addons" class="round sub">
			<a href="https://addons.mozilla.org/de/firefox/addon/force-tls/" target="_blank" rel="noopener">Force-TLS</a> / <a href="https://www.eff.org/https-everywhere" target="_blank" rel="noopener">HTTPS-Everywhere</a> &lt;to do&gt;
		</div>
		-->
		
	</div>

	<!-- author and creative commons licence information -->
	<div class="footer">
		<a id="w3c" title="Valid HTML 4.01 Transitional" href="http://validator.w3.org/check?uri=referer" target="_blank" rel="noopener"></a>
		Diese Seite wurde erstellt von <a class="footer" href="https://rcl.blackpinguin.de/" target="_blank" rel="noopener">Robin&nbsp;Christopher&nbsp;Ladiges</a>
		<a id="cc" title="cc by-sa" href="https://creativecommons.org/licenses/by-sa/3.0/de/" target="_blank" rel="noopener"></a>
		<!-- This page (not the page and content it's linking to) is under creative commons by-sa 3.0 de license, you can read it here: https://creativecommons.org/licenses/by-sa/3.0/de/legalcode -->
	</div>

</div>

</body>
</html>
