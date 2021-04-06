<?php

class _Schulferien
{
	static private $schulort = array();
	static private $schulferien = array();
	
	
	/**
	 * Holt alle Schulorte :
	 * 
	 * $array[][0] = id
	 * $array[][1] = Schulort
	 * 
	 */
	static function get_schulort($id = null)
	{
		if (empty(self::$schulort)) {
			
			$schulort = array();
			$sql = "SELECT * FROM _schulort;";
			$result = _Database::query($sql);
		
			foreach ($result as $result) {
				$schulort[] = array($result->id, $result->schulort);
			}
			self::$schulort = $schulort;
		}
		
		if ($id) {
			foreach (self::$schulort as $schulort) {
				if ($schulort[0] == $id) return $schulort;
			}
			return false;
		}
		
		return self::$schulort;
	}
	
	static function get_schulortSelectOptions()
	{
		$selectoptions = array();
		$selectoptions[] = array("null", "--- Bitte w&auml;hlen ---");
		
		foreach (self::get_schulort() as $schulort) {
			$selectoptions[] = array($schulort[0], $schulort[1]);
		}
		return $selectoptions;
	}
	
	/**
	 * Gibt ein Array mit den Schulferien eines Schulorts zurück, sortiert nach Startdatum:
	 * 
	 * [][0]	id
	 * [][1]	startdatum (bsp: 2016-09-01)
	 * [][2]	enddatum (bsp: 2017-01-31)
	 * [][3]	schulferien
	 * 
	 */
	static function get_schulferienVonSchulort($schulort)
	{
		if (empty(self::$schulferien)) {
			
			$schulferien = array();
			$schulorte = self::get_schulort();
			
			foreach (self::get_schulort() as $schulorte) {
				
				$id = $schulorte[0];
				$schulferien[$id] = array();
				
				$sql = "SELECT * FROM schulferien WHERE schulort = $id ORDER BY startdatum ASC;";
				$result = _Database::query($sql);
				
				foreach ($result as $result) {
					$schulferien[$id][] = array($result->id, $result->startdatum, $result->enddatum, $result->schulferien);
				}
			}
			
			self::$schulferien = $schulferien;
		}
		
		return self::$schulferien[$schulort];
	}
	
	/**
	 * Gibt ein Array mit den Schulferien eines Schulorts zurück, sortiert nach Startdatum:
	 * 
	 * [][0]	id
	 * [][1]	startdatum (bsp: 2016-09-01)
	 * [][2]	enddatum (bsp: 2017-01-31)
	 * [][3]	schulferien
	 * 
	 */
	static function get_schulferienVonSchulortAbHeute($schulort)
	{
		$schulferien = array();
		
		$heute = strftime("%Y-%m-%d");
		
		$sql = "SELECT * FROM schulferien WHERE schulort = $schulort AND enddatum >= '$heute' ORDER BY startdatum ASC;";
		$result = _Database::query($sql);
		
		if (_Database::$result_num_rows) {
			foreach ($result as $result) {
				$schulferien[] = array($result->id, $result->startdatum, $result->enddatum, $result->schulferien);
			}
		}
		return $schulferien;
	}
	
	static function speichern()
	{
		$startdatum = _Form::datepickerToIso($_POST['schulferien_startdatum']);
		$enddatum = _Form::datepickerToIso($_POST['schulferien_enddatum']);
		
		// Prüfen ob Startdatum gültig
		if (!_Content::checkIsoDate($startdatum))
			throw new Exception("Schulferien k&ouml;nnen nicht gespeichert werden. Startdatum ist ung&uuml;ltig");
		
		// Prüfen ob Enddatum gültig
		if (!_Content::checkIsoDate($enddatum))
			throw new Exception("Schulferien k&ouml;nnen nicht gespeichert werden. Enddatum ist ung&uuml;ltig");
			
		// Prüfen dass Enddatum nicht vor Startdatum
		if (strtotime($enddatum) < strtotime($startdatum))
			throw new Exception("Schulferien k&ouml;nnen nicht gespeichert werden. Enddatum darf nicht vor Startdatum sein.");
		
		// Prüfen dass Startdatum nicht schon vorhanden
		foreach (self::get_schulferienVonSchulort($_POST['button'][1]) as $schulferien) {
			
			if (strtotime($schulferien[1]) == strtotime($startdatum))
				throw new Exception("Schulferien k&ouml;nnen nicht gespeichert werden. Das Startdatum ist bereits vorhanden.");
		}
		
		// Speichern
		$sql = "INSERT INTO schulferien (schulort, startdatum, enddatum, schulferien) VALUES (?, '$startdatum', '$enddatum', ?);";
		$vars = array();
		$vars[] = array("i", $_POST['button'][1]);
		$vars[] = array("s", $_POST['schulferien_schulferien']);
		_Database::query($sql, $vars);
		
	}
	
	static function aendern()
	{
		// Update
		$sql = "UPDATE schulferien SET schulferien = ? WHERE id = ?;";
		$vars = array();
		$vars[] = array("s", $_POST['schulferien_schulferien']);
		$vars[] = array("i", $_POST['button'][1]);
		_Database::query($sql, $vars);
	}
	
	static function loeschen()
	{
		// Löschen
		$sql = "DELETE FROM schulferien WHERE id = ?;";
		$vars = array();
		$vars[] = array("i", $_POST['button'][1]);
		_Database::query($sql, $vars);
	}
	
	static function html_schulferienBearbeiten()
	{
		$html = "<h1>Schulferien</h1>
				<p>&nbsp;</p>";
		
		foreach (self::get_schulort() as $schulort) {
			
			$html .= "<h3>" . $schulort[1] . "</h3>
					<div class='flex-row button-row'>
					<a class='btn btn-primary' href='?page=schulferien_neu_" . $schulort[0] . "'><span class='glyphicon glyphicon-plus'></span> Neu</a>
					<a class='btn btn-default' href='?page=schulferien_fruehere_" . $schulort[0] . "'><span class='glyphicon glyphicon-eye-open'></span> Fr&uuml;here anzeigen</a>
					</div>";
			
			// Schulferien-Formular einblenden
			if (isset($_SESSION['page'][1]) && $_SESSION['page'][1] == "neu" && $_SESSION['page'][2] == $schulort[0]) {
				
				$html .= "<form method='POST'>
						<div class='flex-row form-row schulferien0'>"
						. _Form::input("Startdatum", "datepicker", "schulferien_startdatum", null, "schulferien1", null, true)
						. _Form::input("Enddatum", "datepicker", "schulferien_enddatum", null, "schulferien2", null, true)
						. _Form::input("Schulferien", "text", "schulferien_schulferien", null, "schulferien3", null, true)
						. _Form::button("Speichern", "schulferienSpeichern_" . $schulort[0], "btn-primary schulferien4")
						. "</div>
						</form>
						<p>&nbsp;</p>";
			}
			
			$html .= "<div class='flex-row form-row formlabel schulferien7'>
					<div class='schulferien8'>Zeitraum</div><div class='schulferien9'>Schulferien</div>
					</div>";
			
			$schulferien = self::get_schulferienVonSchulortAbHeute($schulort[0]);
			
			// Frühere Schulferien anzeigen
			
			// Falls "Frühere Anzeigen" angeklickt
			if (isset($_SESSION['page'][1]) && $_SESSION['page'][1] == "fruehere" && $_SESSION['page'][2] == $schulort[0])
				$schulferien = self::get_schulferienVonSchulort($schulort[0]);
			
			// Falls frühere Ferien im Bearbeitungsmodus
			if (isset($_SESSION['page'][1]) && $_SESSION['page'][1] == "bearbeiten") {
				
				foreach (self::get_schulferienVonSchulort($schulort[0]) as $ferien) {
					
					// Prüfen ob die zu bearbeitenden Ferien zu entsprechendem Schulort gehören
					if ($_SESSION['page'][2] == $ferien[0]) {
						
						// Prüfen ob die zu bearbeitenden Ferien nicht in Schulferien ab heute
						$abheute = false;
						foreach (self::get_schulferienVonSchulortAbHeute($schulort[0]) as $ferienabheute) {
							if ($_SESSION['page'][2] == $ferienabheute[0]) { $abheute = true; break; }
						}
						// Falls beide Prüfungen bestanden : Frühere Anzeigen
						if (!$abheute) { $schulferien = self::get_schulferienVonSchulort($schulort[0]); }
					}
				}
			}
			
			// Auflistung der Schulferien
			foreach ($schulferien as $schulferien) {
				
				$zeitraum = utf8_encode(strftime("%e. %b. %Y", strtotime($schulferien[1]))) . " - " . utf8_encode(strftime("%e. %b. %Y", strtotime($schulferien[2])));
				
				$html .= "<div class='flex-row form-row schulferien7'>
						<div class='schulferien10'>$zeitraum</div>
						<div class='schulferien11'>";
				
				// Inline-Formular falls Bearbeitung gewünscht
				if (isset($_SESSION['page'][1]) && $_SESSION['page'][1] == "bearbeiten" && $_SESSION['page'][2] == $schulferien[0])
					$html .= "<form class='flex-row' method='POST'>"
							. _Form::input(null, "text", "schulferien_schulferien", $schulferien[3], "", null, true)
							. _Form::button("Speichern", "schulferienAendern_" . $schulferien[0], "btn-primary")
							. _Form::button("L&ouml;schen", "schulferienLoeschen_" . $schulferien[0], "btn-danger")
							. "</form>";
				else
					$html .= "<a href='?page=schulferien_bearbeiten_" . $schulferien[0] . "'>" . $schulferien[3] . "</a>";
				
				$html .= "</div></div>";
			}
			
			$html .= "<p>&nbsp;</p><p>&nbsp;</p>";
		}
		
		return $html;
	}
	
}

?>
