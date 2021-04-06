<?php

class _Praxiseinsatz
{
	
	/**
	 * Gibt ein Array mit Beziehungen des Lehrling zu Praxisbildnern zurück
	 * 
	 * [][0]	id
	 * [][1]	startdatum beziehung (bsp: 2016-09-01)
	 * [][2]	enddatum beziehung (bsp: 2017-01-31)
	 * [][3]	praxisbildner-id
	 * 
	 */
	static function get_praxiseinsaetzeVonLehrling($lehrling)
	{
		$praxiseinsaetze = array();
		
		$sql = "SELECT * FROM praxiseinsatz WHERE lehrling = $lehrling ORDER BY startdatum;";
		$result = _Database::query($sql);
		
		if (_Database::$result_num_rows) {
			foreach ($result as $result) {
				$praxiseinsaetze[] = array($result->id, $result->startdatum, $result->enddatum, $result->praxisbildner);
			}
		}
		return $praxiseinsaetze;
	}
	
	static function get_praxisbildnerAmTag($lehrling, $tag)
	{
		$tag = strtotime($tag);
		
		foreach (self::get_praxiseinsaetzeVonLehrling($lehrling) as $praxisbildner) {
			$startdatum = strtotime($praxisbildner[1]);
			$enddatum = strtotime($praxisbildner[2]);
			
			if ($tag >= $startdatum && $tag <= $enddatum) {
				return $praxisbildner[3];
			}
		}
		return false;
	}
	
	/**
	 * Gibt alle Praxisbildner eines Lehrlings in einem bestimmten Monat zurück
	 * falls noch nicht für alle Tage des Monats ein Praxisbildner existiert, wird zusätzlich ein "false" mitgegeben
	 * 
	 * @param int $lehrling
	 * @param $monat
	 * @return array $praxisbildner
	 */
	static function get_praxisbildnerImMonat($lehrling, $monat)
	{
		$praxisbildner = array();
	
		$sql = "SELECT DISTINCT praxisbildner, startdatum, enddatum FROM praxiseinsatz 
				WHERE lehrling = $lehrling
				AND '$monat' >= DATE(DATE_FORMAT(startdatum ,'%Y-%m-01')) 
				AND '$monat' <= DATE(DATE_FORMAT(enddatum ,'%Y-%m-01'))
				ORDER BY startdatum;";
		$result = _Database::query($sql);
		
		$gesamttage = date("t", strtotime($monat));
		$tage = 0;
		
		for ($i=0; $i<count($result); $i++) {
			
			$praxisbildner[] = $result[$i]->praxisbildner;
			
			// Startdatum festlegen
			
			// Prüfen ob Startdatum vor Monat
			if (strtotime($result[$i]->startdatum) < strtotime($monat)) $startdatum = new DateTime($monat);
			else $startdatum = new DateTime($result[$i]->startdatum);
			
			// Prüfen ob Lehrbeginn nach Startdatum
			if ($i == 0) {
				$lehrbeginn = new DateTime(_Lehrling::get_lehrlinge($lehrling)[4]);
				if ($lehrbeginn->format('U') >= strtotime($monat) && $lehrbeginn->format('U') < strtotime("$monat +1 month") && $lehrbeginn->format('U') >= $startdatum->format('U')) {
					$gesamttage -= $lehrbeginn->diff(new DateTime($monat))->days;
					$startdatum = $lehrbeginn;
				}
			}
			
			// Enddatum festlegen
			
			// Prüfen ob Enddatum nach Monat
			$enddatum = new DateTime();
			if (strtotime($result[$i]->enddatum) >= strtotime("$monat +1 month")) $enddatum->setTimestamp(strtotime("$monat +1 month"));
			else $enddatum->setTimestamp(strtotime($result[$i]->enddatum . " +1 day"));
			
			// Prüfen ob Lehrende vor Enddatum
			if ($i == count($result) - 1) {
				$lehrende = new DateTime(_Lehrling::get_lehrlinge($lehrling)[5]);
				if ($lehrende->format('U') >= strtotime($monat) && $lehrende->format('U') < strtotime("$monat +1 month") && $lehrende->add(new DateInterval('P1D'))->format('U') <= $enddatum->format('U')) {
					$monatsende = new DateTime(strftime("%Y-%m-01", strtotime("$monat +1 month")));
					$gesamttage -= $monatsende->diff($lehrende)->days;
					$enddatum = $lehrende;
				}
			}
			
			// Tage summieren
			$tage += $enddatum->diff($startdatum)->days;
			
		}
		
		// Prüfen ob Monat bezüglich Praxisbildner komplett
		if ($tage != $gesamttage) $praxisbildner[] = false;
		
		return $praxisbildner;
	}
	
	/**
	 * Gibt ein Array mit Beziehungen des Praxisbildners zu Lehrlingen zurück
	 * 
	 * [][0]	Lehrling-id
	 * [][1]	startdatum beziehung (bsp: 2016-09-01)
	 * [][2]	enddatum beziehung (bsp: 2017-01-31)
	 * 
	 */
	static function get_praxiseinsaetzeVonPraxisbildner($praxisbildner)
	{
		$lehrlinge = array();
		
		$sql = "SELECT * FROM praxiseinsatz WHERE praxisbildner = $praxisbildner ORDER BY lehrling, startdatum;";
		$result = _Database::query($sql);
		
		foreach ($result as $result) {
			$lehrlinge[] = array($result->lehrling, $result->startdatum, $result->enddatum);
		}
		return $lehrlinge;
	}
	
	static function get_praxiseinsaetzeVonPraxisbildnerHeute($praxisbildner)
	{
		$lehrlinge = array();
		
		$datum = strftime("%Y-%m-%d");
		$sql = "SELECT lehrling FROM praxiseinsatz 
				WHERE praxisbildner = $praxisbildner AND '$datum' >= startdatum AND '$datum' <= enddatum 
				ORDER BY startdatum;";
		$result = _Database::query($sql);
		
		foreach ($result as $result) {
			$lehrlinge[] = $result->lehrling;
		}
		return $lehrlinge;
	}
	
	static function speichern()
	{
		$lehrling = $_SESSION['page'][2];
		
		$lehrbeginn = _Lehrling::get_lehrlinge($lehrling)[4];
		$lehrende = _Lehrling::get_lehrlinge($lehrling)[5];
		
		$praxiseinsaetze = self::get_praxiseinsaetzeVonLehrling($lehrling);
		if (!count($praxiseinsaetze)) { $startdatum = $lehrbeginn; }
		else {
			$letztesenddatum = $praxiseinsaetze[count($praxiseinsaetze) - 1][2];
			$startdatum = strftime("%Y-%m-%d", strtotime("$letztesenddatum +1 day"));
		}
		$enddatum = _Form::datepickerToIso($_POST['praxiseinsatz_enddatum']);
		
		// Prüfen ob Enddatum gültig
		if (!_Content::checkIsoDate($enddatum))
			throw new Exception("Praxiseinsatz kann nicht gespeichert werden. Datum ist ung&uuml;ltig");
		
		// Prüfen dass Enddatum nicht vor Startdatum
		if (strtotime($enddatum) < strtotime($startdatum))
			throw new Exception("Praxiseinsatz kann nicht gespeichert werden. Enddatum darf nicht vor Startdatum sein.");
		
		// Prüfen dass Enddatum nicht nach Lehrende
		if (strtotime($enddatum) > strtotime($lehrende))
			throw new Exception("Praxiseinsatz kann nicht gespeichert werden. Enddatum darf nicht nach Lehrende sein.");
		
		// Speichern
		$sql = "INSERT INTO praxiseinsatz (lehrling, startdatum, enddatum, praxisbildner) VALUES ($lehrling, '$startdatum', '$enddatum', ?);";
		$vars = array();
		$vars[] = array("i", $_POST['button'][1]);
		_Database::query($sql, $vars);
		
	}
	
	static function updaten()
	{
		$lehrling = $_SESSION['page'][2];
		
		$lehrende = _Lehrling::get_lehrlinge($lehrling)[5];
		
		$gewaehlterpraxiseinsatz = false;
		$praxiseinsaetze = self::get_praxiseinsaetzeVonLehrling($lehrling);
		
		foreach ($praxiseinsaetze as $praxiseinsatz) {
			if ($praxiseinsatz[0] == $_SESSION['page'][3]) {
				$gewaehlterpraxiseinsatz = $praxiseinsatz; break;
			}
		}
		$startdatum = $gewaehlterpraxiseinsatz[1];
		
		// falls letzter Praxiseinsatz: Enddatum einlesen
		if ($gewaehlterpraxiseinsatz[0] == $praxiseinsaetze[count($praxiseinsaetze) - 1][0]) {
			$enddatum = _Form::datepickerToIso($_POST['praxiseinsatz_enddatum']);
			
			// Prüfen ob Enddatum gültig
			if (!_Content::checkIsoDate($enddatum))
				throw new Exception("Praxiseinsatz kann nicht gespeichert werden. Datum ist ung&uuml;ltig");
			
			// Prüfen dass Enddatum nicht vor Startdatum
			if (strtotime($enddatum) < strtotime($startdatum))
				throw new Exception("Praxiseinsatz kann nicht gespeichert werden. Enddatum darf nicht vor Startdatum sein.");
			
			// Prüfen dass Enddatum nicht nach Lehrende
			if (strtotime($enddatum) > strtotime($lehrende))
				throw new Exception("Praxiseinsatz kann nicht gespeichert werden. Enddatum darf nicht nach Lehrende sein.");
			
			// Updaten
			$sql = "UPDATE praxiseinsatz SET enddatum = '$enddatum', praxisbildner = ? WHERE id = $gewaehlterpraxiseinsatz[0];";
			$vars = array();
			$vars[] = array("i", $_POST['button'][1]);
			_Database::query($sql, $vars);
		}
		
		// ohne Änderung von Enddatum
		else {
			
			// Updaten
			$sql = "UPDATE praxiseinsatz SET praxisbildner = ? WHERE id = $gewaehlterpraxiseinsatz[0];";
			$vars = array();
			$vars[] = array("i", $_POST['button'][1]);
			_Database::query($sql, $vars);
		}
	}
	
	static function loeschen()
	{
		$lehrling = $_SESSION['page'][2];
		$praxiseinsaetze = self::get_praxiseinsaetzeVonLehrling($lehrling);
		$gewaehlterpraxiseinsatz = false;
		
		foreach ($praxiseinsaetze as $praxiseinsatz) {
			if ($praxiseinsatz[0] == $_SESSION['page'][3]) {
				$gewaehlterpraxiseinsatz = $praxiseinsatz; break;
			}
		}
		
		// Löschen
		$sql = "DELETE FROM praxiseinsatz WHERE id = $gewaehlterpraxiseinsatz[0];";
		_Database::query($sql);
	}
	
	static function anpassenAnLehrdauer($lehrling)
	{
		$lehrbeginn = _Lehrling::get_lehrlinge($lehrling)[4];
		$lehrende = _Lehrling::get_lehrlinge($lehrling)[5];
		
		// Praxiseinsätze, die komplett ausserhalb Lehre sind, löschen
		$praxiseinsaetze = self::get_praxiseinsaetzeVonLehrling($lehrling);
		for ($i=0; $i<count($praxiseinsaetze); $i++) {
			
			// vor Lehrbeginn
			if (strtotime($praxiseinsaetze[$i][1]) < strtotime($lehrbeginn) && strtotime($praxiseinsaetze[$i][2]) < strtotime($lehrbeginn)) {
				$sql = "DELETE FROM praxiseinsatz WHERE id = " . $praxiseinsaetze[$i][0] . ";";
				_Database::query($sql);
			}
			// nach Lehrende
			if (strtotime($praxiseinsaetze[$i][1]) > strtotime($lehrende) && strtotime($praxiseinsaetze[$i][2]) > strtotime($lehrende)) {
				$sql = "DELETE FROM praxiseinsatz WHERE id = " . $praxiseinsaetze[$i][0] . ";";
				_Database::query($sql);
			}
		}
		
		// Praxiseinsätze, die angeschnitten sind, anpassen
		$praxiseinsaetze = self::get_praxiseinsaetzeVonLehrling($lehrling);
		for ($i=0; $i<count($praxiseinsaetze); $i++) {
			
			// Erster Praxiseinsatz
			if ($i == 0) {
				// Beginnt zu früh
				if (strtotime($praxiseinsaetze[$i][1]) < strtotime($lehrbeginn)) {
					$sql = "UPDATE praxiseinsatz SET startdatum = '$lehrbeginn' WHERE id = " . $praxiseinsaetze[$i][0] . ";";
					_Database::query($sql);
				}
				// Beginnt zu spät
				if (strtotime($praxiseinsaetze[$i][1]) > strtotime($lehrbeginn)) {
					$sql = "UPDATE praxiseinsatz SET startdatum = '$lehrbeginn' WHERE id = " . $praxiseinsaetze[$i][0] . ";";
					_Database::query($sql);
				}
			}
			// Letzter Praxiseinsatz
			if ($i == count($praxiseinsaetze) - 1) {
				// Endet zu spät
				if (strtotime($praxiseinsaetze[$i][2]) > strtotime($lehrende)) {
					$sql = "UPDATE praxiseinsatz SET enddatum = '$lehrende' WHERE id = " . $praxiseinsaetze[$i][0] . ";";
					_Database::query($sql);
				}
			}
		}
	}
	
	static function praxiseinsaetzeSindKomplett($lehrling)
	{
		$lehrbeginn = _Lehrling::get_lehrlinge($lehrling)[4];
		$lehrende = _Lehrling::get_lehrlinge($lehrling)[5];
		
		$praxiseinsaetze = self::get_praxiseinsaetzeVonLehrling($lehrling);
		
		// Noch kein Praxiseinsatz
		if (count($praxiseinsaetze) == 0) return false;
		
		// Genau 1 Praxiseinsatz
		if (count($praxiseinsaetze) == 1) {
			if ($praxiseinsaetze[0][1] == $lehrbeginn && $praxiseinsaetze[0][2] == $lehrende) return true;
			else return false;
		}
		
		// Mehr als 1 Praxiseinsatz
		for ($i=0; $i<count($praxiseinsaetze); $i++) {
			
			$praxiseinsatz = $praxiseinsaetze[$i];
			
			// Ist der erste Praxiseinsatz nicht nach Lehrbeginn?
			if ($i == 0) {
				if (strtotime($praxiseinsatz[1]) > strtotime($lehrbeginn)) return false;
			}
			// Ist der letzte Praxiseinsatz nicht vor Lehrende?
			if ($i == (count($praxiseinsaetze) - 1)) {
				if (strtotime($praxiseinsatz[2]) < strtotime($lehrende)) return false;
			}
			// Gibt es keine Lücken zwischen den Praxiseinsätzen?
			if ($i > 0) {
				if (strtotime($praxiseinsatz[1]) > strtotime($praxiseinsaetze[$i - 1][2] . " +1 day")) return false;
			}
		}
		return true;
	}
	
	static function html_praxiseinsaetzeAnzeigen()
	{
		$lehrling = $_SESSION['page'][2];
		
		$html = "<h1>Praxiseins&auml;tze</h1>
				<h2>" . _Lehrling::get_lehrlinge($lehrling)[1] . "</h2>
				<p>&nbsp;</p>
				<div class='flex-row form-row formlabel praxiseinsatz'>
				<div class='praxiseinsatz1'>Praxisbildner</div><div class='praxiseinsatz2'>Praxisbetrieb</div><div class='praxiseinsatz3'>Zeitraum</div>
				</div>";
		
		$einsaetze = self::get_praxiseinsaetzeVonLehrling($lehrling);
		
		foreach ($einsaetze as $einsatz) {
			
			$praxisbildner = $einsatz[3];
			$praxisbildnername = _Praxisbildner::get_praxisbildner($einsatz[3])[1];
			$praxisbetrieb = _Praxisbildner::get_praxisbildner($einsatz[3])[4];
			$zeitraum = utf8_encode(strftime("%e. %b. %Y", strtotime($einsatz[1]))) . " - " . utf8_encode(strftime("%e. %b. %Y", strtotime($einsatz[2])));
			
			$html .= "<div class='flex-row form-row praxiseinsatz'>
					<div class='praxiseinsatz1'><a href='?page=lehrlingverwaltung_praxisbildner_" . $lehrling . "_" . $einsatz[0] . "'>$praxisbildnername</a></div>
					<div class='praxiseinsatz2'>$praxisbetrieb</div>
					<div class='praxiseinsatz3'>$zeitraum</div>
					</div>";
		}
		
		// Hinzufügen-Button falls Lehre nicht komplett
		if (!self::praxiseinsaetzeSindKomplett($lehrling)) {
			$html .= "<div class='flex-row form-row praxiseinsatz'><div class='praxiseinsatz1'>
					<a href='?page=lehrlingverwaltung_praxisbildner_" . $lehrling . "_neu'><span class='glyphicon glyphicon-plus'></span> Hinzuf&uuml;gen</a>
					</div></div>";
		}
		
		return $html;
	}
	
	static function html_praxiseinsatzErstellen()
	{
		$lehrling = $_SESSION['page'][2];
		
		$html = "<h2>Praxiseinsatz hinzuf&uuml;gen - " . _Lehrling::get_lehrlinge($lehrling)[1] . "</h2>
				<p>&nbsp;</p>";
		
		$lehrbeginn = strftime("%d.%m.%Y", strtotime(_Lehrling::get_lehrlinge($lehrling)[4]));
		$lehrende = strftime("%d.%m.%Y", strtotime(_Lehrling::get_lehrlinge($lehrling)[5]));
		
		$praxiseinsaetze = self::get_praxiseinsaetzeVonLehrling($lehrling);
		if (!count($praxiseinsaetze)) $letztesenddatum = $lehrbeginn;
		else $letztesenddatum = $praxiseinsaetze[count($praxiseinsaetze) - 1][2];
		
		$startdatum = strftime("%d.%m.%Y", strtotime("$letztesenddatum +1 day"));
		
		// Formular Enddatum
		$html .= "<form method='POST'>
				<div class='flex-row form-row formlabel2'>
				<div class='praxiseinsatz4'>Startdatum</div>
				<div class='praxiseinsatz5'>$startdatum</div>
				<div class='praxiseinsatz6'>Enddatum</div>"
				. _Form::input(null, "datepicker", "praxiseinsatz_enddatum", $lehrende, "praxiseinsatz7", null, true)
				. "</div><p>&nbsp;</p><p>&nbsp;</p>";
			
		// Links zu den Anfangsbuchstaben
		if (count(_Praxisbildner::get_aktuellePraxisbildner()) >= LINKBAR_EINBLENDEN_AB_ANZAHL) $html .= _Content::anchorlinkbar();
		
		// Buttons Praxisbildner
		$firstletter = "";
		$praxisbetrieb = "";
		$html .= "<div>";
		
		foreach (_Praxisbildner::get_aktuellePraxisbildner() as $praxisbildner) {
			
			$praxisbildner = _Praxisbildner::get_praxisbildner($praxisbildner);
			
			// Praxisbetrieb
			$id = "";
			if ($firstletter != $praxisbildner[4][0]) {
				$firstletter = $praxisbildner[4][0];
				$id = "id='$firstletter'";
			}
			
			if ($praxisbildner[4] != $praxisbetrieb)
				$html .= "</div><h3 $id>$praxisbildner[4]</h3><div class='flex-row flex-wrap praxisbildner'>";
			
			// Praxisbildner
			$html .= _Form::button($praxisbildner[2], "praxiseinsatzSpeichern_" . $praxisbildner[0], "btn-link");
			
			$praxisbetrieb = $praxisbildner[4];
		}
		$html .= "</div></form>";
		
		return $html;
	}
	
	static function html_praxiseinsatzBearbeiten()
	{
		$lehrling = $_SESSION['page'][2];
		
		$html = "<h2>Praxiseinsatz bearbeiten - " . _Lehrling::get_lehrlinge($lehrling)[1] . "</h2>
				<p>&nbsp;</p>";
		
		$gewaehlterpraxiseinsatz = false;
		$praxiseinsaetze = self::get_praxiseinsaetzeVonLehrling($lehrling);
		
		foreach ($praxiseinsaetze as $praxiseinsatz) {
			if ($praxiseinsatz[0] == $_SESSION['page'][3]) {
				$gewaehlterpraxiseinsatz = $praxiseinsatz; break;
			}
		}
		$startdatum = strftime("%d.%m.%Y", strtotime($gewaehlterpraxiseinsatz[1]));
		$enddatum = strftime("%d.%m.%Y", strtotime($gewaehlterpraxiseinsatz[2]));
		
		// Formular Enddatum
		$html .= "<form method='POST'>
				<div class='flex-row form-row formlabel2'>
				<div class='praxiseinsatz4'>Startdatum</div>
				<div class='praxiseinsatz5'>$startdatum</div>
				<div class='praxiseinsatz6'>Enddatum</div>";
		
		// Enddatum nur bei letztem Praxiseinsatz änderbar
		if ($gewaehlterpraxiseinsatz[0] == $praxiseinsaetze[count($praxiseinsaetze) - 1][0]) {
			$html .= _Form::input(null, "datepicker", "praxiseinsatz_enddatum", $enddatum, "praxiseinsatz7", null, true);
		}
		else {
			$html .= "<div class='praxiseinsatz7'>$enddatum</div>";
		}
		$html .= "</div><p>&nbsp;</p>
				<div class='flex-row form-row'>"
				. _Form::button("Speichern mit &quot;" . _Praxisbildner::get_praxisbildner($gewaehlterpraxiseinsatz[3])[1] . "&quot;", "praxiseinsatzUpdaten_" . $gewaehlterpraxiseinsatz[3], "btn-primary");
		
		// Löschen nur bei letztem Praxiseinsatz möglich
		if ($gewaehlterpraxiseinsatz[0] == $praxiseinsaetze[count($praxiseinsaetze) - 1][0]) {
			$html .= _Form::button("Praxiseinsatz l&ouml;schen", "praxiseinsatzLoeschen_" . $gewaehlterpraxiseinsatz[0], "btn-danger");
		}
		
		$html .= "</div><p>&nbsp;</p>";
		
		// Links zu den Anfangsbuchstaben
		if (count(_Praxisbildner::get_aktuellePraxisbildner()) >= LINKBAR_EINBLENDEN_AB_ANZAHL) $html .= _Content::anchorlinkbar();
		
		// Buttons Praxisbildner
		$firstletter = "";
		$praxisbetrieb = "";
		$html .= "<div>";
		
		foreach (_Praxisbildner::get_aktuellePraxisbildner() as $praxisbildner) {
			
			$praxisbildner = _Praxisbildner::get_praxisbildner($praxisbildner);
			
			// Praxisbetrieb
			$id = "";
			if ($firstletter != $praxisbildner[4][0]) {
				$firstletter = $praxisbildner[4][0];
				$id = "id='$firstletter'";
			}
			
			if ($praxisbildner[4] != $praxisbetrieb)
				$html .= "</div><h3 $id>$praxisbildner[4]</h3><div class='flex-row flex-wrap praxisbildner'>";
			
			// Praxisbildner
			$html .= _Form::button($praxisbildner[2], "praxiseinsatzUpdaten_" . $praxisbildner[0], "btn-link");
			
			$praxisbetrieb = $praxisbildner[4];
		}
		$html .= "</div></form>";
		
		return $html;
	}
	
}

?>
