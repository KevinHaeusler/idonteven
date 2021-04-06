<?php

class _Monat
{
	
	static function praxisbildnerHabenSigniert($lehrling, $monat)
	{
		$praxisbildner = _Praxiseinsatz::get_praxisbildnerImMonat($lehrling, $monat);
		if (in_array(false, $praxisbildner)) return false;
		
		foreach ($praxisbildner as $praxisbildner) {
			$rapport = new Rapport($lehrling, $monat, $praxisbildner);
			if ($rapport->get_property("signiert_praxisbildner") != "ja") return false;
		}
		return true;
	}
	
	static function berufsbildnerHatSigniert($lehrling, $monat)
	{
		$praxisbildner = _Praxiseinsatz::get_praxisbildnerImMonat($lehrling, $monat);
		if (in_array(false, $praxisbildner)) return false;
		
		foreach ($praxisbildner as $praxisbildner) {
			$rapport = new Rapport($lehrling, $monat, $praxisbildner);
			if ($rapport->get_property("signiert_berufsbildner") != "ja") return false;
		}
		return true;
	}
	
	static function get_lehrlingeEingangPraxisbildner($monat, $praxisbildner)
	{
		$lehrlinge = array();
		
		$aktivelehrlinge = _Lehrling::get_aktiveLehrlingeImMonatZuPraxisbildner($monat, $praxisbildner);
		
		foreach ($aktivelehrlinge as $lehrling) {
			$rapport = new Rapport($lehrling, $monat, $praxisbildner);
			if ($rapport->get_property("signiert_lehrling") == "ja") $lehrlinge[] = $lehrling;
		}
		return $lehrlinge;
	}
	
	static function get_lehrlingeEingangBerufsbildner($monat, $berufsbildner)
	{
		$lehrlinge = array();
		$aktivelehrlinge = _Lehrling::get_aktiveLehrlingeImMonatZuBerufsbildner($monat, $berufsbildner);
		
		foreach ($aktivelehrlinge as $lehrling) {
			if (self::praxisbildnerHabenSigniert($lehrling, $monat)) $lehrlinge[] = $lehrling;
		}
		return $lehrlinge;
	}
	
	static function get_lehrlingeEingangSekretariat($monat)
	{
		$lehrlinge = array();
		$aktivelehrlinge = _Lehrling::get_aktiveLehrlingeImMonat($monat);
		
		foreach ($aktivelehrlinge as $lehrling) {
			if (self::berufsbildnerHatSigniert($lehrling, $monat)) $lehrlinge[] = $lehrling;
		}
		return $lehrlinge;
	}
	
	static function html_uebersichtMonate()
	{
		// Monat f�r Eingang berechnen
		$eingangMonat = strftime("%Y-%m-01", strtotime("-1 month"));
		if (strftime("%d") >= RAPPORTE_EINGANG_MONATSWECHSEL_BEI_TAG) {
			$eingangMonat = strftime("%Y-%m-01");
		}
		
		// Berechne den j�ngsten (= am weitesten in Zukunft liegenden) Rapport
		switch ($_SESSION['rolle']) {
				
			case "lehrling" :
				$lehrende = _Lehrling::get_lehrlinge($_SESSION['id'])[5];
				$juengsterRapport = strftime("%Y-%m", strtotime($lehrende)) ."-01";
				break;
		
			case "praxisbildner" :
			case "berufsbildner" :
			case "verwaltung" :
				
				// Berechne Ende Jahr bzw. Ende n�chstes Jahr
				$maximalesJahr = strftime("%Y");
				if (strftime("%m") >= RAPPORTE_JAHRWECHSEL_BEI_MONAT) {
					$maximalesJahr++;
				}
				$juengsterRapport = $maximalesJahr . "-12-01";
		}
		$maximalesJahr = strftime("%Y", strtotime($juengsterRapport));
		
		// Berechne den �ltesten (= am weitesten zur�ckliegenden) Rapport
		switch ($_SESSION['rolle']) {
			
			case "lehrling" :
				$lehrbeginn = _Lehrling::get_lehrlinge($_SESSION['id'])[4];
				$aeltesterRapport = strftime("%Y-%m", strtotime($lehrbeginn)) ."-01";
				break;

			case "praxisbildner" :
				// Nur bis Anfang letztes Jahr bzw. bis Anfang aktuelles Jahr anzeigen
				$minimalesJahr = strftime("%Y");
				if (strftime("%m") < RAPPORTE_JAHRWECHSEL_BEI_MONAT) { $minimalesJahr--; }
				$aeltesterRapport = $minimalesJahr . "-01-01";
				break;
			
			case "berufsbildner" :
			case "verwaltung" :
				// Fall : Nur bis Anfang letztes Jahr bzw. bis Anfang aktuelles Jahr anzeigen
				$minimalesJahr = strftime("%Y");
				if (strftime("%m") < RAPPORTE_JAHRWECHSEL_BEI_MONAT) { $minimalesJahr--; }
				$aeltesterRapport = $minimalesJahr . "-01-01";
				
				// Fall : Alle Jahre anzeigen
				if (isset($_SESSION['page'][1]) && $_SESSION['page'][1] == "allejahre") {
					
					$sql = "SELECT monat FROM rapport ORDER BY monat ASC LIMIT 1;";
					$result = _Database::query($sql);
					if (_Database::$result_num_rows) $aeltesterRapport = $result[0]->monat;
				}
				break;
		}
		$minimalesJahr = strftime("%Y", strtotime($aeltesterRapport));
		
		
		// Alle Rapporte
		$html = "<h1>Rangliste</h1>"
			. "<p>&nbsp;</p>";
		
		// Eingegangen
		if ($_SESSION['rolle'] == "praxisbildner" || $_SESSION['rolle'] == "berufsbildner" || $_SESSION['rolle'] == "verwaltung") {
			
			if ($_SESSION['rolle'] == "praxisbildner") {
				$aktivelehrlinge = _Lehrling::get_aktiveLehrlingeImMonatZuPraxisbildner($eingangMonat, $_SESSION['id']);
				$signiertelehrlinge = self::get_lehrlingeEingangPraxisbildner($eingangMonat, $_SESSION['id']);
			}
			if ($_SESSION['rolle'] == "berufsbildner") {
				$aktivelehrlinge = _Lehrling::get_aktiveLehrlingeImMonatZuBerufsbildner($eingangMonat, $_SESSION['id']);
				$signiertelehrlinge = self::get_lehrlingeEingangBerufsbildner($eingangMonat, $_SESSION['id']);
			}
			if ($_SESSION['rolle'] == "verwaltung") {
				$aktivelehrlinge = _Lehrling::get_aktiveLehrlingeImMonat($eingangMonat);
				$signiertelehrlinge = self::get_lehrlingeEingangSekretariat($eingangMonat);				
			}
			
			$html .= "<h3>" . utf8_encode(strftime("%B %Y", strtotime($eingangMonat))) . " (" . count($signiertelehrlinge) . "/" . count($aktivelehrlinge) . " eingegangen)</h3>"
			. "<div class='flex-row flex-wrap monate'>";
			
			foreach ($signiertelehrlinge as $lehrling) {
				
				$class = "class='success'";
				$glyphicon = "<span class='glyphicon glyphicon-ok-circle'></span> ";
				
				if ($_SESSION['rolle'] == "praxisbildner") {
					$rapport = new Rapport($lehrling, $eingangMonat, $_SESSION['id']);
					if ($rapport->get_property("signiert_praxisbildner") == "offen") { $class = ""; $glyphicon = ""; }
				}
				if ($_SESSION['rolle'] == "berufsbildner") {
					$lehrlingmonat = new Monat($lehrling, $eingangMonat);
					if (!self::berufsbildnerHatSigniert($lehrling, $eingangMonat)) { $class = ""; $glyphicon = ""; }
				}
				
				$html .= "<a $class href='?page=rapport_" . $eingangMonat . "_" . $lehrling . "'>"
					. $glyphicon . _Lehrling::get_lehrlinge($lehrling)[2] . "</a>";
			}
			$html .= "</div><p>&nbsp;</p>";
		}
		
		// Jahre
		for ($i=$maximalesJahr; $i>=$minimalesJahr; $i--) {
			$html .= "<h3>" . $i . "</h3>"
				. "<div class='flex-row flex-wrap monate'>";
			
			$first = 1;
			$last = 12;	
			if ($i == $maximalesJahr) { $last = strftime("%m", strtotime($juengsterRapport)); }
			if ($i == $minimalesJahr) { $first = strftime("%m", strtotime($aeltesterRapport)); }
			
			for ($m=$first; $m<=$last; $m++) {
				$timestamp = strtotime("$i-$m-01");
				$monat = strftime("%Y-%m-01", $timestamp);
				$title = utf8_encode(strftime("%B", $timestamp));
				$link = $monat;
				$class = "";
				
				// Lehrling
				if ($_SESSION['rolle'] == "lehrling") {
					$link .= "_" . $_SESSION['id']; // Link-Anpassung
					
					// Darstellung abgeschlossene Monate
					if (self::berufsbildnerHatSigniert($_SESSION['id'], $monat)) {
						$class = "class = 'success'";
						$title = "<span class='glyphicon glyphicon-ok-circle'></span> " . $title;
					}
				}
				$html .= "<a $class href='?page=rapport_" . $link . "'>" . $title . "</a>";
			}
			
			$html .= "</div><p>&nbsp;</p>";
		}
		
		// Button 'Alle Jahre anzeigen'
		if ($_SESSION['rolle'] == "berufsbildner" || $_SESSION['rolle'] == "verwaltung") {
			
			$html .= "<div class='flex-row button-row'>";
			
			if (isset($_SESSION['page'][1]) && $_SESSION['page'][1] == "allejahre")
				$html .= "<a class='btn btn-default' href='?page=rapport'><span class='glyphicon glyphicon-eye-open'></span> Weniger anzeigen</a>";
			else
				$html .= "<a class='btn btn-default' href='?page=rapport_allejahre'><span class='glyphicon glyphicon-eye-open'></span> Alle anzeigen</a>";
			
			$html .= "</div>";
		}
		
		return $html;
	}
	
	static function html_uebersichtLernende()
	{
		$monat = $_SESSION['page'][1];
		
		$html = "<h1>" . utf8_encode(strftime("%B %Y", strtotime($monat))) . "</h1>
				<div class='button-row'><a class='btn btn-default' href='?page=rapport'>Zur&uuml;ck</a>";
		
		// Alle Lernende zur Stellvertretung einblenden
		if ($_SESSION['rolle'] == "berufsbildner") {
			
			// Button "Eigene Lernende"
			if (isset($_SESSION['page'][2]) && $_SESSION['page'][2] == "allelernende")
				$html .= "<a class='btn btn-default' href='?page=rapport_" . $monat . "'><span class='glyphicon glyphicon-eye-open'></span> Eigene Lernende</a>";
			
			// Button "Alle Lernende"
			else 
				$html .= "<a class='btn btn-default' href='?page=rapport_" . $monat . "_allelernende'><span class='glyphicon glyphicon-eye-open'></span> Alle Lernende</a>";
		}
		
		$html .= "</div><p>&nbsp;</p>";
		
		switch ($_SESSION['rolle']) {
			
			case "verwaltung" :
				$aktivelehrlinge = _Lehrling::get_aktiveLehrlingeImMonat($monat);
				$signiertelehrlinge = self::get_lehrlingeEingangSekretariat($monat);
				break;
				
			case "berufsbildner" :
				$aktivelehrlinge = _Lehrling::get_aktiveLehrlingeImMonatZuBerufsbildner($monat, $_SESSION['id']);
				$signiertelehrlinge = self::get_lehrlingeEingangBerufsbildner($monat, $_SESSION['id']);
				
				// Falls Stellvertretung gew�nscht : alle Lernenden einblenden
				if (isset($_SESSION['page'][2]) && $_SESSION['page'][2] == "allelernende") $aktivelehrlinge = _Lehrling::get_aktiveLehrlingeImMonat($monat);
				break;
				
			case "praxisbildner" :
				$aktivelehrlinge = _Lehrling::get_aktiveLehrlingeImMonatZuPraxisbildner($monat, $_SESSION['id']);
				$signiertelehrlinge = self::get_lehrlingeEingangSekretariat($monat, $_SESSION['id']);
				break;
		}
		
		// Links zu den Anfangsbuchstaben
		if (count($aktivelehrlinge) >= LINKBAR_EINBLENDEN_AB_ANZAHL) $html .= _Content::anchorlinkbar();
		
		$letter = "";
		$html .= "<div>";
		
		foreach ($aktivelehrlinge as $lehrling) {
			$firstletter = _Lehrling::get_lehrlinge($lehrling)[2][0];
			$title = _Lehrling::get_lehrlinge($lehrling)[2];
			
			// Titel Buchstabe
			if ($firstletter != $letter) {
				$html .= "</div>
						<h3 id='" . strtolower($firstletter) . "'>$firstletter</h3>
						<div class='flex-row flex-wrap monate'>";
			}
			
			// Signierte Lehrlinge gr�n ausgeben, sonstige normal
			if (in_array($lehrling, $signiertelehrlinge)) {
				$html .= "<a class='success' href='?page=rapport_" . $monat . "_" . $lehrling . "'>"
					. "<span class='glyphicon glyphicon-ok-circle'></span> " . $title . "</a>";
			}
			else {
				$html .= "<a href='?page=rapport_" . $monat . "_" . $lehrling . "'>" . $title . "</a>";
			}
			
			$letter = $firstletter;
		}
		$html .= "</div>";
		
		return $html;
	}
	
}

?>