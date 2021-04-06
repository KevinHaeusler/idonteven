<?php

class _Authorisation
{
	static public $login_animation = 0;
	
	
	static function benutzerInitialisieren()
	{
		$benutzer = new Benutzer($_SESSION['id']);
		
		// Benutzerdaten in Session laden
		$_SESSION['vorname'] = $benutzer->get_property("vorname");
		$_SESSION['name'] = $benutzer->get_property("name");
		$_SESSION['rollen'] = $benutzer->get_property("rollen");
		$_SESSION['berechtigungen'] = $benutzer->get_property("berechtigungen");
		
		// Rolle definieren
		if (!isset($_SESSION['rolle'])) {
			
			// Lehrling startet als Lehrling
			if (in_array("lehrling", $_SESSION['rollen'])) {
				$_SESSION['rolle'] = "lehrling";
			}
				
			// Praxisbildner startet, falls nicht Berufsbildner, als Praxisbildner
			else if (in_array("praxisbildner", $_SESSION['rollen']) && !in_array("berufsbildner", $_SESSION['rollen'])) {
				$_SESSION['rolle'] = "praxisbildner";
			}
				
			// Berufsbildner startet als Berufsbildner
			else if (in_array("berufsbildner", $_SESSION['rollen'])) {
				$_SESSION['rolle'] = "berufsbildner";
			}
				
			// Nur reine Verwaltungsbenutzer starten in der Verwaltungsansicht
			else {
				$_SESSION['rolle'] = "verwaltung";
			}
			
			// Falls Startrolle in Einstellungen gesetzt, wird die vorher definierte Rolle überschrieben
			if ($benutzer->get_property("startrolle")) {
				$_SESSION['rolle'] = $benutzer->get_property("startrolle");
			}
		}
		
		// Rollenwechsel
		else if (isset($_POST['button'][0]) && $_POST['button'][0] == "rolle") {
				
			// Prüfe ob Rolle bei Benutzer vorhanden
			if (in_array($_POST['button'][1], $_SESSION['rollen'])) {
				
				$_SESSION['rolle'] = $_POST['button'][1];
				
				// Startseite forcieren
				$_SESSION['page'] = array("");
			}
			
			// Login-Animation bei Rollenwechsel
			self::$login_animation = 1;
		}
	}
	
	static function verifyPermission_monat($lehrling, $monat)
	{
		switch ($_SESSION['rolle']) {
			
			case "lehrling" :
				if ($_SESSION['id'] == $lehrling) return true;
				break;
				
			case "praxisbildner" :
				if (in_array($_SESSION['id'], _Praxiseinsatz::get_praxisbildnerImMonat($lehrling, $monat))) return true;
				break;
				
			case "berufsbildner" :
				return true;
				break;
				
			case "verwaltung" :
				if (in_array("RAP", $_SESSION['berechtigungen'])) return true;
				break;
		}
		return false;
	}
	
}

?>