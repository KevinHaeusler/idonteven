<?php


/* Datenbank ---------------------------------------------------------------- */

define("DB_HOST", "localhost");
define("DB_NAME", "art");
define("DB_USER", "root");
define("DB_PASS", "");



/* E-Mail ---------------------------------------------------------------- */

define("MAIL_HOST", "smtp.office365.com");
define("MAIL_USER", "noreply@bildxzug.ch");
define("MAIL_PASS", "anwendung.557");
define("MAIL_ENCRYPTION", "tls");
define("MAIL_PORT", "587");
define("MAIL_SENDER_NAME", "bildxzug - Sekretariat");
define("MAIL_REPLY", "info@bildxzug.ch");



/* Einstellungen ---------------------------------------------------------------- */


 /*
  * URL der Webseite
  */
 define("WEB_URL", "http://www.zugerjagd.ch/");
 

 /*
  * Webseitentitel, angezeigt oben links
  */
 define("WEB_TITEL", "ZKPJV");
 
 
 /*
  * Webseitentitel im Browser und Browser-Favorit
  */
 define("WEB_SEITENTITEL", "Jagdschiessverein des ZKPJV");
 
  
 /*
  * Name des Praxisbetriebs, deren Praxisbildner automatisch signieren
  */
 define("PRAXISBETRIEB_SYSTEM", "bildxzug - System");
 
 
 /*
  * Anzahl der Eintr�ge in einer Listendarstellung, ab welcher ein "Navigations-Alphabet" eingeblendet wird
  *
  * Konstante: Ganze Zahl, Bereich: 0 - x
  * Standardwert: 25
  *
  */
 define("LINKBAR_EINBLENDEN_AB_ANZAHL", 25);
 
 
 /*
  * Tag des Monats, ab welchem die "neuen" Rapporte bei "Eingegangen" angezeigt werden
  * 
  * Konstante: Ganze Zahl, Bereich: 1 - 28
  * Standardwert: 20
  *
  */
 define("RAPPORTE_EINGANG_MONATSWECHSEL_BEI_TAG", 20);
 
 
/*
  * Monat, ab welchem das kommende Jahr in der Jahres�bersicht der Rapporte angezeigt wird
  *
  * Konstante: Ganze Zahl, Bereich: 1 - 12
  * Standardwert: 8
  *
  */
 define("RAPPORTE_JAHRWECHSEL_BEI_MONAT", 8);
 
 
 /*
  * Anzahl Monate, die ein vergangener Rapport noch vom Sekretariat korrigiert werden darf
  *
  * Konstante: Ganze Zahl, Bereich: 0 - x
  * Standardwert: 3
  *
  */
 define("RAPPORT_KORREKTUR_SPERREN_NACH_MONATEN", 3);
 
 



?>
