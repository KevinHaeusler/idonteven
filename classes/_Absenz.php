<?php

class _Absenz
{
	static private $absenzen = array();
	
	
	/**
	 * Gibt alle Absenzen sortiert nach der Spalte reihenfolge zurück
	 *
	 * $array[][0] = id
	 * $array[][1] = Absenz
	 *
	 */
	static function get_absenzen($id = null)
	{
		if (empty(self::$absenzen)) {
			
			$sql = "SELECT * FROM _absenz ORDER BY reihenfolge;";
			$result = _Database::query($sql);
			
			$absenzen = array();
			foreach ($result as $result) {
				$absenzen[] = array($result->id, $result->absenz);
			}
			self::$absenzen = $absenzen;
		}
		
		if ($id) {
			foreach (self::$absenzen as $absenz) {
				if ($absenz[0] == $id) return $absenz[1];
			}
			return false;
		}
		return self::$absenzen;
	}
	
	static function get_anfragen()
	{
		switch ($_SESSION['rolle']) {
			
			case "lehrling" :
				$lehrling = $_SESSION['id'];
				
				$sql = "SELECT absenz_anfrage.id, absenz_anfrage.anfrage, absenz_anfrage.anfrage_kommentar, absenz_anfrage.anfrage_datum, 
							absenz_anfrage.signiert_praxisbildner, absenz_anfrage.signiert_praxisbildner_datum, absenz_anfrage.signiert_praxisbildner_nachricht, 
							absenz_anfrage.signiert_berufsbildner, absenz_anfrage.signiert_berufsbildner_datum, absenz_anfrage.signiert_berufsbildner_nachricht, 
							halbtag.lehrling, halbtag.tag, halbtag.halbtag 
						FROM absenz_anfrage, halbtag 
						WHERE absenz_anfrage.id = halbtag.id AND halbtag.lehrling = $lehrling 
						ORDER BY halbtag.tag ASC, halbtag.halbtag ASC;";
				return _Database::query($sql);
				break;
			
			case "praxisbildner" :
				$praxisbildner = $_SESSION['id'];
				$datum = strftime("%Y-%m-%d");
				
				$sql = "SELECT absenz_anfrage.id, absenz_anfrage.anfrage, absenz_anfrage.anfrage_kommentar, absenz_anfrage.anfrage_datum, 
							absenz_anfrage.signiert_praxisbildner, absenz_anfrage.signiert_praxisbildner_datum, 
							halbtag.lehrling, halbtag.tag, halbtag.halbtag 
						FROM absenz_anfrage, halbtag, praxiseinsatz 
						WHERE absenz_anfrage.id = halbtag.id 
						AND halbtag.lehrling = praxiseinsatz.lehrling 
						AND praxiseinsatz.praxisbildner = $praxisbildner 
						AND praxiseinsatz.startdatum <= '$datum' 
						AND praxiseinsatz.enddatum >= '$datum' 
						AND halbtag.taetigkeit = 'PRA' 
						ORDER BY halbtag.lehrling, halbtag.tag ASC, halbtag.halbtag ASC;";
				return _Database::query($sql);
				break;
				
			case "berufsbildner" :
				$berufsbildner = $_SESSION['id'];
				
				$sql = "SELECT absenz_anfrage.id, absenz_anfrage.anfrage, absenz_anfrage.anfrage_kommentar, absenz_anfrage.anfrage_datum, 
							absenz_anfrage.signiert_berufsbildner, absenz_anfrage.signiert_berufsbildner_datum, 
							halbtag.lehrling, halbtag.tag, halbtag.halbtag 
						FROM absenz_anfrage, halbtag 
						WHERE absenz_anfrage.id = halbtag.id 
						AND halbtag.lehrling IN (SELECT id FROM lehrling WHERE berufsbildner = $berufsbildner) 
						AND (halbtag.taetigkeit = 'PRA' AND absenz_anfrage.signiert_praxisbildner = 'ja' OR halbtag.taetigkeit != 'PRA')
						ORDER BY halbtag.lehrling, halbtag.tag ASC, halbtag.halbtag ASC;";
				return _Database::query($sql);
				break;
		}
	}
	
	static function get_anfragenOffen()
	{
		switch ($_SESSION['rolle']) {
			
			case "lehrling" :
				
				$anfragen = array();
				foreach (self::get_anfragen() as $anfrage) {
					
					// nur offene Anfragen wählen
					if ($anfrage->signiert_praxisbildner != "abgelehnt" && $anfrage->signiert_berufsbildner == "offen") $anfragen[] = $anfrage;
					
				}
				return $anfragen;
				break;
			
			case "praxisbildner" :
				
				// Unterteilung in Subarray für jeden Lehrling
				$anfragenNachLehrling = array();
				$index = -1;	/* beginnt bei -1, da es auch das erste Mal inkrementiert wird */
				$lehrling = null;
				
				foreach (self::get_anfragen() as $anfrage) {
					
					// nur offene Anfragen wählen
					if ($anfrage->signiert_praxisbildner == "offen") {
						
						if ($anfrage->lehrling != $lehrling) $anfragenNachLehrling[++$index] = array();
						
						$anfragenNachLehrling[$index][] = $anfrage;
						$lehrling = $anfrage->lehrling;
					}
				}
				return $anfragenNachLehrling;
				break;
				
			case "berufsbildner" :
				
				// Unterteilung in Subarray für jeden Lehrling
				$anfragenNachLehrling = array();
				$index = -1;	/* beginnt bei -1, da es auch das erste Mal inkrementiert wird */
				$lehrling = null;
				
				foreach (self::get_anfragen() as $anfrage) {
					
					// nur offene Anfragen wählen
					if ($anfrage->signiert_berufsbildner == "offen") {
						
						if ($anfrage->lehrling != $lehrling) $anfragenNachLehrling[++$index] = array();
						
						$anfragenNachLehrling[$index][] = $anfrage;
						$lehrling = $anfrage->lehrling;
					}
				}
				return $anfragenNachLehrling;
				break;
		}
	}
	
	static function get_anfragenSigniert()
	{
		switch ($_SESSION['rolle']) {
			
			case "lehrling" :
				
				$anfragen = array();
				foreach (self::get_anfragen() as $anfrage) {
					
					// nur signierte Anfragen nicht weiter zurück als 1 Monat wählen
					if ($anfrage->signiert_berufsbildner == "ja" && strtotime($anfrage->tag) >= strtotime("-4 week")) $anfragen[] = $anfrage;
					
				}
				return $anfragen;
				break;
			
			case "praxisbildner" :
				
				// Unterteilung in Subarray für jeden Lehrling
				$anfragenNachLehrling = array();
				$index = -1;	/* beginnt bei -1, da es auch das erste Mal inkrementiert wird */
				$lehrling = null;
				
				foreach (self::get_anfragen() as $anfrage) {
					
					// nur signierte Anfragen nicht weiter zurück als 1 Monat wählen
					if ($anfrage->signiert_praxisbildner == "ja" && strtotime($anfrage->tag) >= strtotime("-4 week")) {
						
						if ($anfrage->lehrling != $lehrling) $anfragenNachLehrling[++$index] = array();
						
						$anfragenNachLehrling[$index][] = $anfrage;
						$lehrling = $anfrage->lehrling;
					}
				}
				return $anfragenNachLehrling;
				break;
				
			case "berufsbildner" :
				
				// Unterteilung in Subarray für jeden Lehrling
				$anfragenNachLehrling = array();
				$index = -1;	/* beginnt bei -1, da es auch das erste Mal inkrementiert wird */
				$lehrling = null;
				
				foreach (self::get_anfragen() as $anfrage) {
					
					// nur signierte Anfragen nicht weiter zurück als 1 Monat wählen
					if ($anfrage->signiert_berufsbildner == "ja" && strtotime($anfrage->tag) >= strtotime("-4 week")) {
						
						if ($anfrage->lehrling != $lehrling) $anfragenNachLehrling[++$index] = array();
						
						$anfragenNachLehrling[$index][] = $anfrage;
						$lehrling = $anfrage->lehrling;
					}
				}
				return $anfragenNachLehrling;
				break;
		}
	}
	
	static function get_anfragenAbgelehnt()
	{
		switch ($_SESSION['rolle']) {
			
			case "lehrling" :
				
				$anfragen = array();
				foreach (self::get_anfragen() as $anfrage) {
					
					// nur abgelehnte Anfragen nicht weiter zurück als 1 Monat wählen
					if (($anfrage->signiert_praxisbildner == "abgelehnt" || $anfrage->signiert_berufsbildner == "abgelehnt") 
					&& strtotime($anfrage->tag) >= strtotime("-4 week")) $anfragen[] = $anfrage;
					
				}
				return $anfragen;
				break;
			
			case "praxisbildner" :
				
				// Unterteilung in Subarray für jeden Lehrling
				$anfragenNachLehrling = array();
				$index = -1;	/* beginnt bei -1, da es auch das erste Mal inkrementiert wird */
				$lehrling = null;
				
				foreach (self::get_anfragen() as $anfrage) {
					
					// nur abgelehnte Anfragen nicht weiter zurück als 1 Monat wählen
					if ($anfrage->signiert_praxisbildner == "abgelehnt" && strtotime($anfrage->tag) >= strtotime("-4 week")) {
						
						if ($anfrage->lehrling != $lehrling) $anfragenNachLehrling[++$index] = array();
						
						$anfragenNachLehrling[$index][] = $anfrage;
						$lehrling = $anfrage->lehrling;
					}
				}
				return $anfragenNachLehrling;
				break;
				
			case "berufsbildner" :
				
				// Unterteilung in Subarray für jeden Lehrling
				$anfragenNachLehrling = array();
				$index = -1;	/* beginnt bei -1, da es auch das erste Mal inkrementiert wird */
				$lehrling = null;
				
				foreach (self::get_anfragen() as $anfrage) {
					
					// nur abgelehnte Anfragen nicht weiter zurück als 1 Monat wählen
					if ($anfrage->signiert_berufsbildner == "abgelehnt" && strtotime($anfrage->tag) >= strtotime("-4 week")) {
						
						if ($anfrage->lehrling != $lehrling) $anfragenNachLehrling[++$index] = array();
						
						$anfragenNachLehrling[$index][] = $anfrage;
						$lehrling = $anfrage->lehrling;
					}
				}
				return $anfragenNachLehrling;
				break;
		}
	}
	
	static function buendleAbsenzAnfrageHalbtage($anfragen)
	{
		$gebuendelteAnfragen = array();
		$index = -1;	/* beginnt bei -1, da es auch das erste Mal inkrementiert wird */
		
		for ($i=0; $i<count($anfragen); $i++) {
			
			$gebuendelteAnfragen[++$index] = array();
			$gebuendelteAnfragen[$index][] = $anfragen[$i];
			
			while ($i + 1 < count($anfragen) && $anfragen[$i + 1]->anfrage == $anfragen[$i]->anfrage 
				&& strtotime($anfragen[$i + 1]->tag) == strtotime(Halbtag::get_nachfolger($anfragen[$i]->tag, $anfragen[$i]->halbtag)['tag'])
				&& $anfragen[$i + 1]->halbtag == Halbtag::get_nachfolger($anfragen[$i]->tag, $anfragen[$i]->halbtag)['halbtag']) {
					
					$gebuendelteAnfragen[$index][] = $anfragen[++$i];
			}
		}
		
		return $gebuendelteAnfragen;		
	}
	
	static function buendleFerienHalbtage($ferien)
	{
		$gebuendelteFerien = array();
		$index = -1;	/* beginnt bei -1, da es auch das erste Mal inkrementiert wird */
		
		for ($i=0; $i<count($ferien); $i++) {
			
			$gebuendelteFerien[++$index] = array();
			$gebuendelteFerien[$index][] = $ferien[$i];
			
			while ($i + 1 < count($ferien)
				&& strtotime($ferien[$i + 1]->tag) == strtotime(Halbtag::get_nachfolger($ferien[$i]->tag, $ferien[$i]->halbtag)['tag'])
				&& $ferien[$i + 1]->halbtag == Halbtag::get_nachfolger($ferien[$i]->tag, $ferien[$i]->halbtag)['halbtag']) {
					
					$gebuendelteFerien[$index][] = $ferien[++$i];
			}
		}
		
		return $gebuendelteFerien;		
	}
	
	static function html_anfragen()
	{
		$html = "<h1>Absenzen</h1>
				<p>&nbsp;</p>";
			
		if ($_SESSION['rolle'] == "lehrling") {
			
			// Abgelehnte Anfragen anzeigen
			$anfragenAbgelehnt = self::get_anfragenAbgelehnt();
			if (count($anfragenAbgelehnt)) {
				
				$html .= "<h3>Abgelehnte</h3>";
				
				foreach (self::buendleAbsenzAnfrageHalbtage($anfragenAbgelehnt) as $anfrage) {
					$html .= self::html_anfrage($anfrage);
				}
				$html .= "<p>&nbsp;</p>";
			}
			
			// Signierte Anfragen anzeigen
			$anfragenSigniert = self::get_anfragenSigniert();
			if (count($anfragenSigniert)) {
				
				$html .= "<h3>Signierte</h3>";
				
				foreach (self::buendleAbsenzAnfrageHalbtage($anfragenSigniert) as $anfrage) {
					$html .= self::html_anfrage($anfrage);
				}
				$html .= "<p>&nbsp;</p>";
			}
			
			// Offene Anfragen anzeigen
			$anfragenOffen = self::get_anfragenOffen();
			if (count($anfragenOffen)) {
				
				$html .= "<h3>Offene</h3>";
				
				foreach (self::buendleAbsenzAnfrageHalbtage($anfragenOffen) as $anfrage) {
					$html .= self::html_anfrage($anfrage);
				}
				$html .= "<p>&nbsp;</p>";
			}
		}
		
		if ($_SESSION['rolle'] == "berufsbildner" || $_SESSION['rolle'] == "praxisbildner") {
			
			// Offene Anfragen anzeigen
			foreach (self::get_anfragenOffen() as $anfragenVonLehrling) {
				
				$html .= "<h3>" . _Lehrling::get_lehrlinge($anfragenVonLehrling[0]->lehrling)[1] . "</h3>
						<form method='POST'>";
				
				// aufeinanderfolgende Absenzen 'bündeln' und die 'Bündel' ausgeben
				foreach (self::buendleAbsenzAnfrageHalbtage($anfragenVonLehrling) as $anfrage) {
					$html .= self::html_anfrage($anfrage);
				}
				
				$html .= "</form>
						<p>&nbsp;</p><p>&nbsp;</p>";
			}
			
			// Signierte Anfragen anzeigen
			$html .= "<h2>Signierte</h2>
					<p>&nbsp;</p>";
			
			foreach (self::get_anfragenSigniert() as $anfragenVonLehrling) {
				
				$html .= "<h3>" . _Lehrling::get_lehrlinge($anfragenVonLehrling[0]->lehrling)[1] . "</h3>";
				
				// aufeinanderfolgende Absenzen 'bündeln' und die 'Bündel' ausgeben
				foreach (self::buendleAbsenzAnfrageHalbtage($anfragenVonLehrling) as $anfrage) {
					$html .= self::html_anfrage($anfrage);
				}
				
				$html .= "<p>&nbsp;</p><p>&nbsp;</p>";
			}
			
			// Abgelehnte Anfragen anzeigen
			$html .= "<h2>Abgelehnte</h2>
					<p>&nbsp;</p>";
			
			foreach (self::get_anfragenAbgelehnt() as $anfragenVonLehrling) {
				
				$html .= "<h3>" . _Lehrling::get_lehrlinge($anfragenVonLehrling[0]->lehrling)[1] . "</h3>";
				
				// aufeinanderfolgende Absenzen 'bündeln' und die 'Bündel' ausgeben
				foreach (self::buendleAbsenzAnfrageHalbtage($anfragenVonLehrling) as $anfrage) {
					$html .= self::html_anfrage($anfrage);
				}
				
				$html .= "<p>&nbsp;</p>";
			}
		}
		
		return $html;
	}
	
	static function html_anfrage($anfrage)
	{
		$ersteabsenz = $anfrage[0];
		$letzteabsenz = $anfrage[count($anfrage) - 1];
		
		// Ausgabe der Anfrage
		$html = "<div class='flex-row absenz'>
				<div class='absenz1'><p>" . _Absenz::get_absenzen($ersteabsenz->anfrage) . "</p>
				<p class='kommentar'>" . $ersteabsenz->anfrage_kommentar . "</p></div>";
		
		// Datum
		
		// Maximal 1 Tag
		if ($ersteabsenz->tag == $letzteabsenz->tag) {
			
			// Halbtag
			if ($ersteabsenz->halbtag == $letzteabsenz->halbtag)
				$html .= "<div class='absenz2'><p>" . _Content::html_datum($ersteabsenz->tag) . " (" . ucfirst($ersteabsenz->halbtag) . ")</p></div>";
			
			// Ganztag
			else 
				$html .= "<div class='absenz2'><p>" . _Content::html_datum($ersteabsenz->tag) . " (ganzer Tag)</p></div>";
		}
		
		// mehrere Tage
		else {
			
			// ganze Tage
			if ($ersteabsenz->halbtag == "vormittag" && $letzteabsenz->halbtag == "nachmittag")
				$html .= "<div class='absenz2'><p>" . _Content::html_datum($ersteabsenz->tag) . " - " . _Content::html_datum($letzteabsenz->tag) . "</p></div>";
			
			// erster oder letzter Tag angeschnitten
			else 
				$html .= "<div class='absenz2'><p>" . _Content::html_datum($ersteabsenz->tag) . " (" . ucfirst($ersteabsenz->halbtag)
					. ") - " . _Content::html_datum($letzteabsenz->tag) . " (" . ucfirst($letzteabsenz->halbtag) . ")</p></div>";
		}
		
		// Dritte Spalte
		
		if ($_SESSION['rolle'] == "lehrling") {
			
			// Abgelehnt
			if ($anfrage[0]->signiert_praxisbildner == "abgelehnt" || $anfrage[0]->signiert_berufsbildner == "abgelehnt") {
				if ($anfrage[0]->signiert_berufsbildner == "abgelehnt") {
					$abgelehnt = "Berufsbildner";
					$datum = strftime("%d.%m.%Y um %H:%M", strtotime($anfrage[0]->signiert_berufsbildner_datum));
				}
				else {
					$abgelehnt = "Praxisbildner";
					$datum = strftime("%d.%m.%Y um %H:%M", strtotime($anfrage[0]->signiert_praxisbildner_datum));
				}
				$html .= "<div class='absenz3'><p class='danger'><span class='glyphicon glyphicon-remove-circle'></span> $abgelehnt am $datum</p></div>";
			}
			// Signiert
			if ($anfrage[0]->signiert_berufsbildner == "ja") {
				$datum = strftime("%d.%m.%Y um %H:%M", strtotime($anfrage[0]->signiert_berufsbildner_datum));
				$html .= "<div class='absenz3'><p class='success'><span class='glyphicon glyphicon-ok-circle'></span> Berufsbildner am $datum</p></div>";
			}
			// Offen
			if ($anfrage[0]->signiert_praxisbildner != "abgelehnt" && $anfrage[0]->signiert_berufsbildner == "offen") {
				$datum = strftime("%d.%m.%Y um %H:%M", strtotime($anfrage[0]->anfrage_datum));
				$html .= "<div class='absenz3'><p>Anfrage vom $datum</p></div>";
			}
		}
		
		if ($_SESSION['rolle'] == "praxisbildner") {
			
			// Offen
			if ($anfrage[0]->signiert_praxisbildner == "offen") {
				$html .= "<div class='absenz3 flex-row flex-end'>"
					. _Form::button("<span class='glyphicon glyphicon-ok'></span> Signieren", "absenzSignieren_" . $ersteabsenz->id . "_" . $letzteabsenz->id, "btn-primary")
					. _Form::button("<span class='glyphicon glyphicon-remove'></span> Ablehnen", "absenzAblehnen_" . $ersteabsenz->id . "_" . $letzteabsenz->id, "btn-default")
					. "</div>";
			}
			// Signiert
			if ($anfrage[0]->signiert_praxisbildner == "ja") {
				$datum = strftime("%d.%m.%Y um %H:%M", strtotime($anfrage[0]->signiert_praxisbildner_datum));
				$html .= "<div class='absenz3'><p>Signiert am  $datum</p></div>";
			}
			// Abgelehnt
			if ($anfrage[0]->signiert_praxisbildner == "abgelehnt") {
				$datum = strftime("%d.%m.%Y um %H:%M", strtotime($anfrage[0]->signiert_praxisbildner_datum));
				$html .= "<div class='absenz3'><p>Abgelehnt am  $datum</p></div>";
			}
		}
		
		if ($_SESSION['rolle'] == "berufsbildner") {
			
			// Offen
			if ($anfrage[0]->signiert_berufsbildner == "offen") {
				$html .= "<div class='absenz3 flex-row flex-end'>"
					. _Form::button("<span class='glyphicon glyphicon-ok'></span> Signieren", "absenzSignieren_" . $ersteabsenz->id . "_" . $letzteabsenz->id, "btn-primary")
					. _Form::button("<span class='glyphicon glyphicon-remove'></span> Ablehnen", "absenzAblehnen_" . $ersteabsenz->id . "_" . $letzteabsenz->id, "btn-default")
					. "</div>";
			}
			// Signiert
			if ($anfrage[0]->signiert_berufsbildner == "ja") {
				$datum = strftime("%d.%m.%Y um %H:%M", strtotime($anfrage[0]->signiert_berufsbildner_datum));
				$html .= "<div class='absenz3'><p>Signiert am  $datum</p></div>";
			}
			// Abgelehnt
			if ($anfrage[0]->signiert_berufsbildner == "abgelehnt") {
				$datum = strftime("%d.%m.%Y um %H:%M", strtotime($anfrage[0]->signiert_berufsbildner_datum));
				$html .= "<div class='absenz3'><p>Abgelehnt am  $datum</p></div>";
			}
		}
		$html .= "</div>";
		
		return $html;
	}
	
	static function html_ferienUebersicht()
	{
		$html = "<h1>Ferien&uuml;bersicht</h1>
				<p>&nbsp;</p>";
		
		$aktivelehrlinge = _Lehrling::get_aktiveLehrlingeHeute();
		
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
			$html .= "<a href='?page=ferien_" . $lehrling . "'>" . $title . "</a>";
			$letter = $firstletter;
		}
		$html .= "</div>";
		
		return $html;
	}
	
	static function html_ferien()
	{
		switch ($_SESSION['rolle']) {
			case "lehrling" :
				$id = $_SESSION['id'];
				break;
			case "berufsbildner" :
			case "verwaltung" :
				if (isset($_SESSION['page'][1])) $id = $_SESSION['page'][1];
				break;
		}
		
		// Alle Ferien / Ferienanfragen holen
		$sql = "SELECT halbtag.id, halbtag.tag, halbtag.halbtag FROM halbtag 
				WHERE halbtag.lehrling = $id
				AND (halbtag.absenz = 'FER' OR halbtag.id IN 
					(SELECT absenz_anfrage.id FROM absenz_anfrage 
					WHERE absenz_anfrage.anfrage = 'FER' 
					AND absenz_anfrage.signiert_praxisbildner != 'abgelehnt' 
					AND absenz_anfrage.signiert_berufsbildner = 'offen') 
				) ORDER BY halbtag.tag ASC, halbtag.halbtag ASC;";
		$result = _Database::query($sql);
		
		// Ferienhalbtage nach Lehrjahr aufteilen
		$lehrling = new Lehrling($id);
		$lehrjahre = $lehrling->get_property("lehrjahre");
		$ferienlehrjahre = array();
		
		for ($i=0; $i<count($lehrjahre); $i++) {
			
			$ferienlehrjahre[$i] = array();
			
			foreach ($result as $ferienhalbtag) {
				if (strtotime($ferienhalbtag->tag) >= strtotime($lehrjahre[$i]->get_property("beginn")) 
				&& strtotime($ferienhalbtag->tag) <= strtotime($lehrjahre[$i]->get_property("ende"))) {
					
					$ferienlehrjahre[$i][] = $ferienhalbtag;
				}
			}
		}
		
		// Ferienübersicht
		$html = "<h1>Ferien&uuml;bersicht</h1>
				<h2>" . _Lehrling::get_lehrlinge($id)[1] . "</h2>";
		
		if ($_SESSION['rolle'] != "lehrling") $html .= "<div class='button-row'><a class='btn btn-default' href='?page=ferien'>Zur&uuml;ck</a></div>";
		
		$html .= "<p>&nbsp;</p>";
		
		for ($i=count($lehrjahre) - 1; $i>=0; $i--) {
			
			// Feriensaldo der vorigen Jahre berechnen
			$saldobisher = 0;
			for ($n=0; $n<$i; $n++) {
				$saldobisher += $lehrjahre[$n]->get_property("ferientage");
				$saldobisher -= (0.5 * count($ferienlehrjahre[$n]));
			}
			
			// dieses Jahr
			$guthaben = $lehrjahre[$i]->get_property("ferientage");
			$saldo = $guthaben + $saldobisher;
			$verbraucht = 0.5 * count($ferienlehrjahre[$i]);
			$uebrig = $saldo - $verbraucht;
			
			// Lehrjahrtitel und -saldo anzeigen
			$html .= "<h3>Lehrjahr " . substr($lehrjahre[$i]->get_property("jahr"), 2, 2) . "/" . (substr($lehrjahre[$i]->get_property("jahr"), 2, 2) + 1) . "</h3>
					<div class='ferien0'>
					<p>Guthaben: " . $lehrjahre[$i]->get_property("ferientage");
			
			if ($i != 0) {
				if ($saldobisher < 0) $html .= " - " . abs($saldobisher) . " = $saldo";
				else $html .= " + $saldobisher = $saldo";
			}	
			$html .= " Tage</p>
					<p>Verbraucht: $verbraucht Tage</p>
					<p>&Uuml;brig: $uebrig Tage</p>
					</div>";
			
			// Ferienhalbtage bündeln
			$ferienlehrjahr = self::buendleFerienHalbtage($ferienlehrjahre[$i]);
			
			// einzelne Ferien anzeigen
			foreach ($ferienlehrjahr as $ferien) {
				$erstertag = $ferien[0];
				$letztertag = $ferien[count($ferien) - 1];
				
				$html .= "<div class='flex-row ferien'>
						<div class='ferien1'>";
				
				if ($erstertag->tag == $letztertag->tag) {
					if ($erstertag->halbtag == $letztertag->halbtag)
						$html .= _Content::html_datum($erstertag->tag) . " (" . ucfirst($erstertag->halbtag) . ")";
					else 
						$html .= _Content::html_datum($erstertag->tag) . " (ganzer Tag)";
				}
				else {
					if ($erstertag->halbtag == "vormittag" && $letztertag->halbtag == "nachmittag")
						$html .= _Content::html_datum($erstertag->tag) . " - " . _Content::html_datum($letztertag->tag);
					else 
						$html .= _Content::html_datum($erstertag->tag) . " (" . ucfirst($erstertag->halbtag) . ") - "
							. _Content::html_datum($letztertag->tag) . " (" . ucfirst($letztertag->halbtag) . ")";
				}
				
				$html .= "</div>
						<div class='ferien2'>" . (0.5 * count($ferien)) . " Tage</div>
						</div>";
			}
			$html .= "<p>&nbsp;</p>";
		}
		
		return $html;
	}
	
}

?>

