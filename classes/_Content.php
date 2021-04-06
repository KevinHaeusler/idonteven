<?php

class _Content
{
	
	static function setPageValues()
	{
		$_SESSION['page'] = array("");
		
		if (isset($_GET['page'])) {
			
			$value = $_GET['page'];
			
			if (strpos($value, "_") !== false) $_SESSION['page'] = explode("_", $value);
			else $_SESSION['page'] = array($value);
		}
	}
	
	/**
	 * 
	 * 
	 * @return string
	 */

	static function create()
	{
		// 
		switch ($_SESSION['page'][0]) {

			case "rapport" :
			
				//
				if (!isset($_SESSION['page'][1]) || isset($_SESSION['page'][1]) && $_SESSION['page'][1] == "allejahre") {
					return _Monat::html_uebersichtMonate();
				}
			
				//
				if (isset($_SESSION['page'][1]) && _Content::checkIsoDate($_SESSION['page'][1])
				&& (!isset($_SESSION['page'][2]) || isset($_SESSION['page'][2]) && $_SESSION['page'][2] == "allelernende") ) {
					return _Monat::html_uebersichtLernende();
				}
				
				//
				if (isset($_SESSION['page'][1]) && _Content::checkIsoDate($_SESSION['page'][1]) && isset($_SESSION['page'][2])) {
					$monat = new Monat($_SESSION['page'][2], $_SESSION['page'][1]);
					return $monat->html_monatAnzeigen();
				}
				break;

			case "absenzen" :
			
				return _Absenz::html_anfragen();
				break;
				
			case "ferien" :
				
				if ($_SESSION['rolle'] == "lehrling") {
					return _Absenz::html_ferien();
				}
				if ($_SESSION['rolle'] == "berufsbildner" || $_SESSION['rolle'] == "verwaltung") {
					
					if (isset($_SESSION['page'][1])) return _Absenz::html_ferien();
					else return _Absenz::html_ferienUebersicht();
				}
				break;
				
			case "lehrlingverwaltung" :
				
				//
				if (!isset($_SESSION['page'][1]) || $_SESSION['page'][1] == "zukuenftige" || $_SESSION['page'][1] == "ehemalige")
					return _Lehrling::html_lernendeAnzeigen();
				
				//
				if ($_SESSION['page'][1] == "neu") {
					$lehrling = new Lehrling();
					return $lehrling->html_lehrlingErstellen();
				}
				
				//
				if ($_SESSION['page'][1] == "bearbeiten" && isset($_SESSION['page'][2])) {
					$lehrling = new Lehrling($_SESSION['page'][2]);
					return $lehrling->html_lehrlingBearbeiten();
				}
				
				//
				if ($_SESSION['page'][1] == "praxisbildner" && isset($_SESSION['page'][2]) && !isset($_SESSION['page'][3])) {
					return _Praxiseinsatz::html_praxiseinsaetzeAnzeigen();
				}
				
				//
				if ($_SESSION['page'][1] == "praxisbildner" && isset($_SESSION['page'][2]) && $_SESSION['page'][3] == "neu") {
					return _Praxiseinsatz::html_praxiseinsatzErstellen();
				}
				
				//
				if ($_SESSION['page'][1] == "praxisbildner" && isset($_SESSION['page'][2]) && isset($_SESSION['page'][3])) {
					return _Praxiseinsatz::html_praxiseinsatzBearbeiten();
				}
				break;



///////////////////////////////////////////////////////////////////////////////////

				case "schuetzenverwaltung" :
				
					//
					if (!isset($_SESSION['page'][1]) || $_SESSION['page'][1] == "u65")
						return _Schuetze::html_schuetzeAnzeigen();
				

					//
					if ($_SESSION['page'][1] == "neu") {
						$schuetze = new Schuetze();
						return $schuetze->html_schuetzeErstellen();
					}
					
					//
					if ($_SESSION['page'][1] == "bearbeiten" && isset($_SESSION['page'][2])) {
						$schuetze = new Schuetze($_SESSION['page'][2]);
						return $schuetze->html_schuetzeBearbeiten();
					}
					break;

///////////////////////////////////////////////////////////////////////////////////
				
				case "anlassverwaltung" :
				
					//
					if (!isset($_SESSION['page'][1]) || $_SESSION['page'][1] == "zukuenftige" || $_SESSION['page'][1] == "ehemalige")
						return _Anlass::html_anlaesseAnzeigen();
					
					//
					if ($_SESSION['page'][1] == "neu") {
						$anlass = new Anlass();
						return $anlass->html_anlaesseErstellen();
					}
					
					//
					if ($_SESSION['page'][1] == "bearbeiten" && isset($_SESSION['page'][2])) {
						$anlass = new Anlass($_SESSION['page'][2]);
						return $anlass->html_anlaesseBearbeiten();
					}
					
					break;

///////////////////////////////////////////////////////////////////////////////////

					case "resultatverwaltung" :
				
					//
					if (!isset($_SESSION['page'][1]) || $_SESSION['page'][1] == "zukuenftige" || $_SESSION['page'][1] == "ehemalige")
						return _Resultate::html_resultateAnzeigen();
					
					//

					// Vereinsmeisterschaft Resultate erfassen
					if ($_SESSION['page'][1] == "neu") {
						$resultat = new Resultate();
						return $resultat->html_vmErstellen();
					}
					
					// Vereinsmeisterschaft Resultate bearbeiten
					if ($_SESSION['page'][1] == "bearbeiten" && isset($_SESSION['page'][2])) {
						$resultat = new Resultate($_SESSION['page'][2]);
						return $resultat->html_vmBearbeiten();
					}

					// Resultatverwaltung suchen
					if ($_SESSION['page'][1] == "search") {

						return _Resultate::suchen();
					}
					
					break;

///////////////////////////////////////////////////////////////////////////////////

			case "praxisbildnerverwaltung" :
				
				//
				if (!isset($_SESSION['page'][1]) || $_SESSION['page'][1] == "archivierte")
					return _Praxisbildner::html_praxisbildnerAnzeigen();
				
				//
				if ($_SESSION['page'][1] == "neu") {
					$praxisbildner = new Praxisbildner();
					return $praxisbildner->html_praxisbildnerErstellen();
				}
				
				//
				if ($_SESSION['page'][1] == "bearbeiten" && isset($_SESSION['page'][2])) {
					$praxisbildner = new Praxisbildner($_SESSION['page'][2]);
					return $praxisbildner->html_praxisbildnerBearbeiten();
				}
				
				//
				if ($_SESSION['page'][1] == "praxisbetrieb" && isset($_SESSION['page'][2])) {
					$praxisbildner = new Praxisbildner($_SESSION['page'][2]);
					return $praxisbildner->html_praxisbetriebBearbeiten();
				}
				
				break;
				
			case "praxisbetriebe" :
				
				//
				return _Praxisbetrieb::html_praxisbetriebeAnzeigen();
				break;
				
			case "schulferien" :
				
				//
				return _Schulferien::html_schulferienBearbeiten();
				break;
				
			case "statistik" :
				
				//
				return _Statistik::html_statistikAuswerten();
				break;
				
		}
	}



	static function checkIsoDate($date)
	{
		$date = explode("-", $date);
		if (count($date) == 3) return checkdate($date[1], $date[2], $date[0]);
		return false;
	}
	
	static function set_startseite()
	{
		if ($_SESSION['page'][0] == "" || $_SESSION['page'][0] == "rangliste") {
			switch ($_SESSION['rolle']) {
				case "lehrling" : $_SESSION['page'][0] = "rapport"; break;
				case "praxisbildner" : $_SESSION['page'][0] = "rapport"; break;
				case "berufsbildner" : $_SESSION['page'][0] = "rapport"; break;
				case "verwaltung" :
					if (in_array("ADM", $_SESSION['berechtigungen'])) { $_SESSION['page'][0] = "administrator"; break; }
					if (in_array("RAP", $_SESSION['berechtigungen'])) { $_SESSION['page'][0] = "rapport"; break; }
					if (in_array("LLV", $_SESSION['berechtigungen'])) { $_SESSION['page'][0] = "lehrlingverwaltung"; break; }
					if (in_array("PBV", $_SESSION['berechtigungen'])) { $_SESSION['page'][0] = "praxisbildnerverwaltung"; break; }
					if (in_array("SFE", $_SESSION['berechtigungen'])) { $_SESSION['page'][0] = "schulferien"; break; }
					if (in_array("STA", $_SESSION['berechtigungen'])) { $_SESSION['page'][0] = "statistik"; break; }
			}
		}
	}
		
	/**
	 * Erstellt Men�punkte-Arrays f�r die verschiedenen Benutzerrollen
	 * 
	 * @return array $menupunkte :
	 *   $menupunkte[][0] = Titel, bsp: "Rapporte"
	 *   $menupunkte[][1] = Link, bsp: "rapport" (wird zu $_GET['page']-Wert)
	 *   
	 */
	static function get_menupunkte()
	{
		$menupunkte = array();
		
		switch ($_SESSION['rolle']) {
			case "lehrling" :
				break;
			case "praxisbildner" :

				break;
			case "berufsbildner" :
				break;
			case "verwaltung" :
				if (in_array("ADM", $_SESSION['berechtigungen'])) $menupunkte[] = array("Administrator", "administrator");
				if (in_array("LLV", $_SESSION['berechtigungen'])) $menupunkte[] = array("Rangliste", "rangliste");
				if (in_array("LLV", $_SESSION['berechtigungen'])) $menupunkte[] = array("Schützen verwalten", "schuetzenverwaltung");
				if (in_array("LLV", $_SESSION['berechtigungen'])) $menupunkte[] = array("Anlässe verwalten", "anlassverwaltung");
				if (in_array("LLV", $_SESSION['berechtigungen'])) $menupunkte[] = array("Resultate verwalten", "resultatverwaltung");

				break;
		}
		return $menupunkte;
	}
	
	static function html_navigation()
	{
		self::set_startseite();
		
		// Login-Animation
		$loginanimation = "";
		if (_Authorisation::$login_animation) $loginanimation = "login";
		
		// Navigation
		$html = "<nav class='navbar $loginanimation navbar-default navbar-fixed-top'>
				<div class='container'>"
		
		// Titel in Navigationsleiste
		. "<div class='navbar-header'>
		<a class='navbar-brand' href='" . WEB_URL . "'>" . WEB_TITEL . "</a>
		</div>
		<div id='navbar' class='navbar-collapse collapse'>"
		
		// Linksb�ndig
		. "<ul class='nav navbar-nav'>";
		
		$menupunkte = self::get_menupunkte();
		
		foreach ($menupunkte as $menupunkt) {
			$html .= "<li";
			if ($_SESSION['page'][0] == $menupunkt[1]) $html .= " class='active'";
			
			$html .= " ><a href='?page=" . $menupunkt[1] . "'>" . $menupunkt[0] . "</a></li>";
		}
		$html .= "</ul>"
		
		// Rechtsb�ndig
		. "<ul class='nav navbar-nav navbar-right'>
		<li class='dropdown'>
		<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>"
		. $_SESSION['vorname'] . " " . $_SESSION['name'] . " <span class='caret'></span></a>
		<ul class='dropdown-menu'>";
		
		// Rollen-Wechsel
		if (count($_SESSION['rollen']) > 1) {
			if (($_SESSION['rolle'] == "verwaltung" || $_SESSION['rolle'] == "berufsbildner") && in_array("praxisbildner", $_SESSION['rollen'])) {
				$html .= "<li><form method='POST'><button class='btn btn-link' name='button' type='submit' value='rolle_praxisbildner'>Zu Praxisbildner wechseln</button></form></li>";
			}
			if (($_SESSION['rolle'] == "verwaltung" || $_SESSION['rolle'] == "praxisbildner") && in_array("berufsbildner", $_SESSION['rollen'])) {
				$html .= "<li><form method='POST'><button class='btn btn-link' name='button' type='submit' value='rolle_berufsbildner'>Zu Berufsbildner wechseln</button></form></li>";
			}
			if ($_SESSION['rolle'] == "verwaltung" && in_array("lehrling", $_SESSION['rollen'])) {
				$html .= "<li><form method='POST'><button class='btn btn-link' name='button' type='submit' value='rolle_lehrling'>Zu Lehrling wechseln</button></form></li>";
			}
			if ($_SESSION['rolle'] != "verwaltung" && !empty($_SESSION['berechtigungen'])) {
				$html .= "<li><form method='POST'><button class='btn btn-link' name='button' type='submit' value='rolle_verwaltung'>Zur Verwaltung wechseln</button></form></li>";
			}
			$html .= "<li role='separator' class='divider'></li>";
		}
		// Einstellungen und Logout
		$html .= "
	
		<li><a href='?page=logout'>Logout</a></li> 
		</ul></li></ul>
		</div></div>
		</nav>";
		
		return $html;
	}
	
	static function anchorlinkbar()
	{
		$html = "<div class='flex-row flex-wrap anchorlinks fixedbuttons'>";
		
		foreach (range('a', 'z') as $linktoletter) {
			$html .= "<a class='btn btn-link' href='#$linktoletter'>" . strtoupper($linktoletter) . "</a>";
		}
		$html .= "</div>";
		
		return $html;
	}
	
	static function html_datum($datum)
	{
		return utf8_encode(strftime("%e. %b. %Y", strtotime($datum)));
	}
	
	static function html_head($title, $css)
	{
		$html = "<head>
				<meta charset='utf-8'>
				<meta http-equiv='X-UA-Compatible' content='IE=edge'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
				<title>$title</title>
				<link href='software/bootstrap-3.3.7-dist/css/bootstrap.min.css' rel='stylesheet'>
				<link href='software/bootstrap-datepicker-1.6.4-dist/css/bootstrap-datepicker3.min.css' rel='stylesheet'>
				<link href='styles/css/displayflex.css' rel='stylesheet'>
				<link href='styles/css/$css' rel='stylesheet'>
				</head>";
		return $html;
	}
	
	
}

?>