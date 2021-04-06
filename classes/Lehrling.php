<?php

class Lehrling extends Benutzer
{
	private $nr;
	private $lehrgang;
	private $berufsbildner;
	private $lehrbeginn;
	private $lehrende;
	private $lehrbeginn_ganzesjahr;
	private $schulort;
	
	private $anzahlvertragsjahre;
	private $lehrjahre = array();
	
	
	function __construct($id = null)
	{
		parent::__construct($id);
		
		if ($this->id) {
			
			// Lehrling einlesen
			$sql = "SELECT * FROM lehrling WHERE id = ?;";
			$vars = array();
			$vars[] = array("i", $this->id);
			$result = _Database::query($sql, $vars);
			
			$this->nr = $result[0]->nr;
			$this->lehrgang = $result[0]->lehrgang;
			$this->berufsbildner = $result[0]->berufsbildner;
			$this->lehrbeginn = $result[0]->lehrbeginn;
			$this->lehrende = $result[0]->lehrende;
			$this->lehrbeginn_ganzesjahr = $result[0]->lehrbeginn_ganzesjahr;
			$this->schulort = $result[0]->schulort;
			
			// Lehrjahre erzeugen
			$this->set_anzahlvertragsjahre();
			
			for ($vertragsjahr = 1; $vertragsjahr <= $this->anzahlvertragsjahre; $vertragsjahr++) {
				$this->lehrjahre[] = new Lehrjahr($this->id, $vertragsjahr);
			}
		}
	}
	
	function speichern()
	{
		$this->vorname = $_POST['benutzerVerwaltung_vorname'];
		$this->name = $_POST['benutzerVerwaltung_name'];
		$this->email = $_POST['benutzerVerwaltung_email'];
		
		if (!empty($_POST['lehrlingVerwaltung_nr'])) $this->nr = $_POST['lehrlingVerwaltung_nr'];
		else $this->nr = null;
		
		// Meldung falls der Lehrgang ge�ndert wird
		if ($this->id) {
			if ($_POST['lehrlingVerwaltung_lehrgang'] != $this->lehrgang)
				_Meldung::set_hinweis("Der Lehrgang wurde angepasst. &Uuml;berpr&uuml;fe noch die Lehrg&auml;nge in den Lehrjahren.");
		}
		$this->lehrgang = $_POST['lehrlingVerwaltung_lehrgang'];
		$this->berufsbildner = $_POST['lehrlingVerwaltung_berufsbildner'];
		$this->lehrbeginn = _Form::datepickerToIso($_POST['lehrlingVerwaltung_lehrbeginn']);
		
		if (empty($_POST['lehrlingVerwaltung_regulaerjahrbeginn'])) $this->lehrbeginn_ganzesjahr = $this->lehrbeginn;
		else $this->lehrbeginn_ganzesjahr = _Form::datepickerToIso($_POST['lehrlingVerwaltung_regulaerjahrbeginn']);
		
		// Lehrende einlesen/berechnen
		if ($this->id) {
			$this->lehrende = _Form::datepickerToIso($_POST['lehrlingVerwaltung_lehrende']);
		}
		else {
			$lehrdauer = _Lehrgang::get_lehrgaenge($this->lehrgang)[2];
			
			if (strtotime($this->lehrbeginn) == strtotime($this->lehrbeginn_ganzesjahr))
				$this->lehrende = strftime("%Y-%m-%d", strtotime("$this->lehrbeginn +$lehrdauer year -1 day"));
			else
				$this->lehrende = strftime("%Y-%m-%d", strtotime("$this->lehrbeginn_ganzesjahr +" . ($lehrdauer - 1)  . " year -1 day"));
		}
		
		$this->schulort = $_POST['lehrlingVerwaltung_schulort'];
		
		// Lehrjahre einlesen
		foreach ($this->lehrjahre as $lehrjahr) {
			$lehrjahr->einlesen();
		}
	
		// Exceptions werfen
		
		// Pr�fen ob Mitarbeiternummer bereits vorhanden
		$sql = "SELECT id FROM lehrling WHERE nr = ?;";
		$vars = array();
		$vars[] = array("s", $this->nr);
		$result = _Database::query($sql, $vars);
		
		if ($this->nr && _Database::$result_num_rows) {
			// Lehrling wird das erste Mal gespeichert : Mitarbeiternummer darf nicht schon vorhanden sein
			if (!$this->id)
				throw new Exception('Lehrling kann nicht gespeichert werden. Die Mitarbeiternummer existiert bereits.');
			
			// Lehrling bereits vorhanden : Exception falls Mitarbeiternummer einem anderen LL geh�rt
			else if ($result[0]->id != $this->id)
				throw new Exception('Lehrling kann nicht gespeichert werden. Die Mitarbeiternummer existiert bereits.');
		}
		
		// Pr�fen ob E-Mail-Adresse bereits vorhanden
		$sql = "SELECT id FROM benutzer WHERE email = ?;";
		$vars = array();
		$vars[] = array("s", $this->email);
		$result = _Database::query($sql, $vars);
		
		if (_Database::$result_num_rows) {
			// Lehrling wird das erste Mal gespeichert : E-Mail darf nicht schon vorhanden sein
			if (!$this->id)
				throw new Exception('Lehrling kann nicht gespeichert werden. Die E-Mail-Adresse existiert bereits.');
			
			// Lehrling bereits vorhanden : Exception falls E-Mail einem anderen Benutzer geh�rt
			else if ($result[0]->id != $this->id)
				throw new Exception('Lehrling kann nicht gespeichert werden. Die E-Mail-Adresse existiert bereits.');
		}
		
		// Pr�fen ob Berufsbildner gew�hlt
		if ($this->berufsbildner == "null") {
			throw new Exception('Lehrling kann nicht gespeichert werden. Bitte Berufsbildner w&auml;hlen.');
		}
			
		// Pr�fen ob Lehrgang gew�hlt
		if ($this->lehrgang == "null") {
			throw new Exception('Lehrling kann nicht gespeichert werden. Bitte Lehrgang w&auml;hlen.');
		}
		if ($this->id) {
			foreach ($this->lehrjahre as $lehrjahr) {
				if ($lehrjahr->get_property("lehrgang") == "null") {
					throw new Exception('Lehrling kann nicht gespeichert werden. Bitte &uuml;berall einen Lehrgang w&auml;hlen.');
				}
			}
		}
		
		// Pr�fen ob Schulort gew�hlt
		if ($this->schulort == "null") {
			throw new Exception('Lehrling kann nicht gespeichert werden. Bitte Schulort w&auml;hlen.');
		}
		
		// Pr�fen ob Lehrbeginn angegeben
		if (!_Content::checkIsoDate($this->lehrbeginn)) {
			throw new Exception('Lehrling kann nicht gespeichert werden. Es wurde kein Lehrbeginn gew&auml;hlt.');
		}
		
		// Pr�fen ob Regul�rjahrbeginn nach Lehrbeginn
		if (strtotime($this->lehrbeginn_ganzesjahr) < strtotime($this->lehrbeginn)) {
			throw new Exception('Lehrling kann nicht gespeichert werden. Der Lehrbeginn der ganzen Jahre muss nach Lehrbeginn sein.');
		}
	
		// Pr�fen ob Lehrende nach Regul�rjahrbeginn
		if (strtotime($this->lehrende) < strtotime($this->lehrbeginn_ganzesjahr)) {
			throw new Exception('Lehrling kann nicht gespeichert werden. Das Lehrende muss nach Lehrbeginn sein.');
		}
	
		// Pr�fen ob die Schuljahre pro Lehrjahr um h�chstens 1 Jahr anwachsen
		if ($this->id) {
			for ($i = 1; $i < count($this->lehrjahre); $i++) {
				
				// Kein �berspringen
				if ($this->lehrjahre[$i]->get_property("schuljahr") > $this->lehrjahre[$i - 1]->get_property("schuljahr") + 1)
					throw new Exception('Lehrling kann nicht gespeichert werden. Schuljahre k&ouml;nnen nicht &uuml;bersprungen werden.');
				
				// Kein kleiner werden
				if ($this->lehrjahre[$i]->get_property("schuljahr") < $this->lehrjahre[$i - 1]->get_property("schuljahr"))
					throw new Exception('Lehrling kann nicht gespeichert werden. Schuljahre d&uuml;rfen nicht kleiner werden.');
			}
		}
		
		// Speichern
		// Neuer Lehrling
		if (!$this->id) {
			
			$this->passwortGenerieren();
				
			// Benutzer
			$sql = "INSERT INTO benutzer (vorname, name, email, password_hash) VALUES (?, ?, ?, '$this->password_hash');";
			$vars = array();
			$vars[] = array("s", $this->vorname);
			$vars[] = array("s", $this->name);
			$vars[] = array("s", $this->email);
			_Database::query($sql, $vars);
			
			$this->id = _Database::get_insert_id();
			
			// Lehrling
			$sql = "INSERT INTO lehrling (id, nr, lehrgang, berufsbildner, lehrbeginn, lehrende, lehrbeginn_ganzesjahr, schulort) VALUES ($this->id, ?, ?, ?, ?, ?, ?, ?);";
			$vars = array();
			$vars[] = array("s", $this->nr);
			$vars[] = array("s", $this->lehrgang);
			$vars[] = array("i", $this->berufsbildner);
			$vars[] = array("s", $this->lehrbeginn);
			$vars[] = array("s", $this->lehrende);
			$vars[] = array("s", $this->lehrbeginn_ganzesjahr);
			$vars[] = array("i", $this->schulort);
			_Database::query($sql, $vars);
			
			// Lehrjahre
			$this->set_anzahlvertragsjahre();
			
			for ($vertragsjahr = 1; $vertragsjahr <= $this->anzahlvertragsjahre; $vertragsjahr++) {
				$this->lehrjahre[] = new Lehrjahr($this->id, $vertragsjahr);
			}
			foreach ($this->lehrjahre as $lehrjahr) {
				$lehrjahr->speichern();
			}
		}
		
		// Bestehender Lehrling
		else {
			
			// Benutzer
			$sql = "UPDATE benutzer SET vorname = ?, name = ?, email = ? WHERE id = $this->id;";
			$vars = array();
			$vars[] = array("s", $this->vorname);
			$vars[] = array("s", $this->name);
			$vars[] = array("s", $this->email);
			_Database::query($sql, $vars);
	
			// Lehrling
			$sql = "UPDATE lehrling SET nr = ?, lehrgang = ?, berufsbildner = ?, lehrbeginn = ?, lehrende = ?, lehrbeginn_ganzesjahr = ?, schulort = ? WHERE id = $this->id;";
			$vars = array();
			$vars[] = array("s", $this->nr);
			$vars[] = array("s", $this->lehrgang);
			$vars[] = array("i", $this->berufsbildner);
			$vars[] = array("s", $this->lehrbeginn);
			$vars[] = array("s", $this->lehrende);
			$vars[] = array("s", $this->lehrbeginn_ganzesjahr);
			$vars[] = array("i", $this->schulort);
			_Database::query($sql, $vars);
				
			// Lehrjahre
			$sql = "DELETE FROM lehrjahr WHERE lehrling = $this->id;";
			_Database::query($sql);
			
			$this->set_anzahlvertragsjahre();
			
			for ($vertragsjahr = 1; $vertragsjahr <= $this->anzahlvertragsjahre; $vertragsjahr++) {
				$this->lehrjahre[] = new Lehrjahr($this->id, $vertragsjahr);
			}
			
			foreach ($this->lehrjahre as $lehrjahr) {
				$lehrjahr->speichern();
			}
			
			// Praxiseins�tze anpassen (bei �nderungen an Lehrbeginn oder Lehrende)
			_Praxiseinsatz::anpassenAnLehrdauer($this->id);
		}
	}
	
	function set_anzahlvertragsjahre()
	{
		// "Normaler" Lehrbeginn
		if (strtotime($this->lehrbeginn) == strtotime($this->lehrbeginn_ganzesjahr)) {
			for ($this->anzahlvertragsjahre = 1; $this->anzahlvertragsjahre <= 5; $this->anzahlvertragsjahre++) {
				// Sobald das Lehrende eintrifft, oder �bertroffen wird (Lehraufl�sung), hat die Schlaufe die Anzahl Vertragsjahre erreicht
				if (strtotime("$this->lehrbeginn +$this->anzahlvertragsjahre year -1 day") >= strtotime($this->lehrende)) break;
			}
		}
		
		// Lehr�bernahme
		else {
			for ($this->anzahlvertragsjahre = 1; $this->anzahlvertragsjahre <= 5; $this->anzahlvertragsjahre++) {
				// Sobald das Lehrende eintrifft, oder �bertroffen wird (Lehraufl�sung), hat die Schlaufe die Anzahl Vertragsjahre erreicht
				if (strtotime("$this->lehrbeginn_ganzesjahr +" . ($this->anzahlvertragsjahre - 1) . " year -1 day") >= strtotime($this->lehrende)) break;
			}
		}		
	}
	
	function get_property($property)
	{
		return $this->{$property};
	}
	
	function html_lehrlingErstellen()
	{
		$html = "<h1>Lernende/r erstellen</h1>"
			. "<p>&nbsp;</p>"
			. "<form method='POST'>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Pers-Nr", "text", "lehrlingVerwaltung_nr", null, "personalien1", null, false, true)
			. _Form::input("Vorname", "text", "benutzerVerwaltung_vorname", null, "personalien2", null, true)
			. _Form::input("Name", "text", "benutzerVerwaltung_name", null, "personalien3", null, true)
			. _Form::input("E-Mail", "text", "benutzerVerwaltung_email", null, "personalien4", null, true)
			. "</div>"
			. "<div class='flex-row form-row'>"
			. _Form::select("Berufsbildner", "lehrlingVerwaltung_berufsbildner", _Berufsbildner::get_selectOptions(), null, "personalien5")
			. _Form::select("Lehrgang", "lehrlingVerwaltung_lehrgang", _Lehrgang::get_selectOptions(), null, "personalien6")
			. _Form::select("Schulort", "lehrlingVerwaltung_schulort", _Schulferien::get_schulortSelectOptions(), null, "personalien7")
			. "</div>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Lehrbeginn", "datepicker", "lehrlingVerwaltung_lehrbeginn", null, "personalien8", null, true)
			. _Form::input("Optional: Lehrbeginn ganze Jahre", "datepicker", "lehrlingVerwaltung_regulaerjahrbeginn", null, "personalien9")
			. "</div>"
			. "<div class='flex-row button-row'>
			<a class='btn btn-default' href='?page=lehrlingverwaltung'>Abbrechen</a>"
			. _Form::button("Speichern", "lehrlingVerwaltungSpeichern", "btn-primary")
			. "</div>"
			. "</form>";
		
		return $html;
	}
	
	function html_lehrlingBearbeiten()
	{
		$html = "<h1>Lernende/r bearbeiten</h1>
			<h2>$this->vorname $this->name</h2>
			<p>&nbsp;</p>";
		
		// Formular
		$html .= "<form method='POST'>
				<div class='flex-row form-row'>"
				. _Form::input("Pers-Nr", "text", "lehrlingVerwaltung_nr", $this->nr, "personalien1", null, true)
				. _Form::input("Vorname", "text", "benutzerVerwaltung_vorname", $this->vorname, "personalien2", null, true)
				. _Form::input("Name", "text", "benutzerVerwaltung_name", $this->name, "personalien3", null, true)
				. _Form::input("E-Mail", "text", "benutzerVerwaltung_email", $this->email, "personalien4", null, true)
				. "</div>
				<div class='flex-row form-row'>"
				. _Form::select("Berufsbildner", "lehrlingVerwaltung_berufsbildner", _Berufsbildner::get_selectOptions(), $this->berufsbildner, "personalien5")
				. _Form::select("Lehrgang", "lehrlingVerwaltung_lehrgang", _Lehrgang::get_selectOptions(), $this->lehrgang, "personalien6")
				. _Form::select("Schulort", "lehrlingVerwaltung_schulort", _Schulferien::get_schulortSelectOptions(), $this->schulort, "personalien7")
				. "</div>
				<div class='flex-row form-row'>"
				. _Form::input("Lehrbeginn", "datepicker", "lehrlingVerwaltung_lehrbeginn", strftime("%d.%m.%Y", strtotime($this->lehrbeginn)), "personalien8", null, true)
				. _Form::input("Lehrende", "datepicker", "lehrlingVerwaltung_lehrende", strftime("%d.%m.%Y", strtotime($this->lehrende)), "personalien9", null, true)
				. _Form::input("Lehrbeginn ganze Jahre", "datepicker", "lehrlingVerwaltung_regulaerjahrbeginn", strftime("%d.%m.%Y", strtotime($this->lehrbeginn_ganzesjahr)), "personalien9", null, true)
				. "</div>
				<p>&nbsp;</p>";
		
		// Lehrjahre
		$html .= "<h3>Lehre</h3>
				<p>&nbsp;</p>
				<div class='flex-row form-row formlabel'>
				<div class='lehrjahr1'>Jahr</div><div class='lehrjahr2'>Schuljahr</div><div class='lehrjahr3'>Lehrgang</div><div class='lehrjahr4'>Ferientage</div>
				</div>";
		
		foreach ($this->lehrjahre as $lehrjahr) {
			
			$beginn = utf8_encode(strftime("%e. %b. %Y", strtotime($lehrjahr->get_property("beginn"))));
			$ende = utf8_encode(strftime("%e. %b. %Y", strtotime($lehrjahr->get_property("ende"))));
			$vertragsjahr = $lehrjahr->get_property("vertragsjahr");
			$schuljahr = $lehrjahr->get_property("schuljahr");
			$lehrgang = $lehrjahr->get_property("lehrgang");
			$ferientage = $lehrjahr->get_property("ferientage");
			
			$html .= "<div class='flex-row form-row'>"
				. _Form::input(null, "static", null, "$beginn - $ende", "lehrjahr1")
				. _Form::input(null, "number", "lehrlingVerwaltung_" . $vertragsjahr . "_schuljahr", $schuljahr, "lehrjahr2")
				. _Form::select(null, "lehrlingVerwaltung_" . $vertragsjahr . "_lehrgang", _Lehrgang::get_selectOptions(_Lehrgang::get_lehrgaenge($this->lehrgang)[4]), $lehrgang, "lehrjahr3")
				. _Form::input(null, "text", "lehrlingVerwaltung_" . $vertragsjahr . "_ferientage", $ferientage, "lehrjahr4")
				. "</div>";
		}
		
		// Button
		$html .= "<div class='flex-row button-row'>
				<a class='btn btn-default' href='?page=lehrlingverwaltung'>Zur&uuml;ck</a>"
				. _Form::button("Speichern", "lehrlingVerwaltungSpeichern_" . $this->id, "btn-primary")
				. _Form::button("Passwort zur&uuml;cksetzen", "lehrlingVerwaltungPasswortReset_" . $this->id, "btn-danger")
				. "</div>
				</form>";
		
		return $html;
	}
	
}

?>