<?php

spl_autoload_register(function ($class) {
	if (is_readable("classes/$class.php")) require "classes/$class.php"; }); // ben�tigte Klassen laden
require 'software/PHPMailer-master/PHPMailerAutoload.php'; // phpmailer laden
require 'config/conf.php'; // Konstanten laden
setlocale(LC_TIME, 'de_DE@euro', 'de_DE', 'deu_deu');
session_start();

_Database::create(); // DB-Verbindung er�ffnen
_Content::setPageValues(); // get-Parameter verarbeiten
_Form::splitButtonValues(); // post-Parameter verarbeiten

_Authentication::authenticate(); // authentifizieren
_Authorisation::benutzerInitialisieren(); // autorisieren

_Form::execute(); // post-Anfragen ausf�hren
$navigation = _Content::html_navigation(); // html der Navigation erzeugen
$content = _Content::create(); // html des Hauptinhalts erzeugen
$head = _Content::html_head(WEB_SEITENTITEL, "main.css"); // head erzeugen

$auswertung = _Resultate::html_resultateAuswerten(); // Drop-Down in _Resultate

$confirmation = _Meldung::get_confirmations(); // html der Best�tigungsdialoge erzeugen
$meldungen = _Meldung::get_messages(); // html mit Meldungen erzeugen
$feedback = ""; if (_Meldung::$feedback) $feedback = "saved"; if (count(_Meldung::$fehler)) $feedback = "error"; // css-klasse f�r feedback hinzuf�gen

// Ausgabe der Seite
echo "<!DOCTYPE html>
<html lang='de'>
	$head
	<body>
		$navigation
		<div class='container'>$confirmation $meldungen<div class='jumbotron $feedback'>$content</div></div>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
		<script src='software/bootstrap-3.3.7-dist/js/bootstrap.min.js'></script>
		<script src='software/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.min.js'></script>
		<script src='software/bootstrap-datepicker-1.6.4-dist/locales/bootstrap-datepicker.de.min.js'></script>
		<script src='software/smooth-scroll-master/dist/js/smooth-scroll.js'></script>
		<script src='styles/js/scripts.js'></script>
		<script>$('.datepicker').datepicker({language: 'de'});</script>
		<script>smoothScroll.init({ selector: \"a[href^='#']\", offset: 135 });</script>
		<script>window.onload = addScripts();</script>
	</body>
</html>";

_Database::close(); // DB-Verbindung schliessen

?>

