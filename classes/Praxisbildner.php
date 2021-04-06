<?php

class Praxisbildner extends Benutzer
{
	private $praxisbetrieb;
	private $archiviert;
	
	
	function __construct($id = null)
	{
		parent::__construct($id);
		
		if ($this->id) {
			
			// Praxisbildner einlesen
			$sql = "SELECT * FROM praxisbildner WHERE id = ?;";
			$vars = array();
			$vars[] = array("i", $this->id);
			$result = _Database::query($sql, $vars);
			
			$this->praxisbetrieb = $result[0]->praxisbetrieb;
			$this->archiviert = $result[0]->archiviert;
		}
	}
	
	function speichern()
	{
		$this->vorname = $_POST['benutzerVerwaltung_vorname'];
		$this->name = $_POST['benutzerVerwaltung_name'];
		$this->email = $_POST['benutzerVerwaltung_email'];
		
		// Exceptions werfen
		
		// Prüfen ob E-Mail-Adresse bereits vorhanden
		$sql = "SELECT id FROM benutzer WHERE email = ?;";
		$vars = array();
		$vars[] = array("s", $this->email);
		$result = _Database::query($sql, $vars);
		
		if (_Database::$result_num_rows) {
			// Praxisbildner wird das erste Mal gespeichert : E-Mail darf nicht schon vorhanden sein
			if (!$this->id)
				throw new Exception('Praxisbildner kann nicht gespeichert werden. Die E-Mail-Adresse existiert bereits.');
			
			// Praxisbildner bereits vorhanden : Exception falls E-Mail einem anderen Benutzer gehört
			else if ($result[0]->id != $this->id)
				throw new Exception('Praxisbildner kann nicht gespeichert werden. Die E-Mail-Adresse existiert bereits.');
		}
		
		// Speichern
		// Neuer Praxisbildner
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
			
			// Praxisbildner
			$sql = "INSERT INTO praxisbildner (id) VALUES ($this->id);";
			_Database::query($sql);
		}
		
		// Bestehender Praxisbildner
		else {
			
			// Benutzer
			$sql = "UPDATE benutzer SET vorname = ?, name = ?, email = ? WHERE id = $this->id;";
			$vars = array();
			$vars[] = array("s", $this->vorname);
			$vars[] = array("s", $this->name);
			$vars[] = array("s", $this->email);
			_Database::query($sql, $vars);
		}
	}
	
	function praxisbetriebSpeichern()
	{
		$sql = "UPDATE praxisbildner SET praxisbetrieb = ? WHERE id = $this->id;";
		$vars = array();
		$vars[] = array("i", $_POST['button'][2]);
		_Database::query($sql, $vars);
	}
	
	function get_property($property)
	{
		return $this->{$property};
	}
	
	function html_praxisbildnerErstellen()
	{
		$html = "<h1>Praxisbildner erstellen</h1>"
			. "<p>&nbsp;</p>"
			. "<form method='POST'>"
			. "<div class='flex-row form-row'>"
			. _Form::input("Vorname", "text", "benutzerVerwaltung_vorname", null, "personalien2", null, true)
			. _Form::input("Name", "text", "benutzerVerwaltung_name", null, "personalien3", null, true)
			. _Form::input("E-Mail", "text", "benutzerVerwaltung_email", null, "personalien4", null, true)
			. "</div>"
			. "<div class='flex-row button-row'>
			<a class='btn btn-default' href='?page=praxisbildnerverwaltung'>Abbrechen</a>"
			. _Form::button("Speichern", "praxisbildnerVerwaltungSpeichern", "btn-primary")
			. "</div>"
			. "</form>";
		
		return $html;
	}
	
	function html_praxisbildnerBearbeiten()
	{
		$html = "<h1>Praxisbildner bearbeiten</h1>"
			. "<h2>$this->vorname $this->name</h2>"
			. "<p>&nbsp;</p>";
		
		// Formular
		$html .= "<form method='POST'>
				<div class='flex-row form-row'>"
				. _Form::input("Vorname", "text", "benutzerVerwaltung_vorname", $this->vorname, "personalien2", null, true)
				. _Form::input("Name", "text", "benutzerVerwaltung_name", $this->name, "personalien3", null, true)
				. _Form::input("E-Mail", "text", "benutzerVerwaltung_email", $this->email, "personalien4", null, true)
				. "</div>
				<p>&nbsp;</p>
				<h3>Praxisbetrieb</h3>";
		
		// Praxisbetrieb zuordnen
		if ($this->praxisbetrieb)
			$html .= "<div class='flex-row form-row praxisbetrieb'><div class='praxisbetrieb1'>
					<a href='?page=praxisbildnerverwaltung_praxisbetrieb_$this->id'>" . _Praxisbetrieb::get_praxisbetriebe($this->praxisbetrieb)[1] . "</a></div></div>";
		else 
			$html .= "<div class='flex-row form-row praxisbetrieb'><div class='praxisbetrieb1'>
					<a href='?page=praxisbildnerverwaltung_praxisbetrieb_$this->id'>+ Praxisbetrieb zuordnen</a></div></div>";
		
		// Button
		$html .= "<p>&nbsp;</p>
				<div class='flex-row button-row'>
				<a class='btn btn-default' href='?page=praxisbildnerverwaltung'>Zur&uuml;ck</a>"
				. _Form::button("Speichern", "praxisbildnerVerwaltungSpeichern_" . $this->id, "btn-primary");
		
		if ($this->archiviert) $html .= _Form::button("Archivierung aufheben", "praxisbildnerVerwaltungArchivieren_" . $this->id, "btn-danger");
		else $html .= _Form::button("Praxisbildner archivieren", "praxisbildnerVerwaltungArchivieren_" . $this->id, "btn-danger");
		
		$html .= "</div>
				</form>";
		
		return $html;
	}
	
	function html_praxisbetriebBearbeiten()
	{
		$html = "<h2>Praxisbetrieb bearbeiten - $this->vorname $this->name</h2>
				<div class='flex-row button-row'><a class='btn btn-default' href='?page=praxisbildnerverwaltung_bearbeiten_$this->id'>Abbrechen</a></div>
				<p>&nbsp;</p>
				<form method='POST'>";
			
		// Links zu den Anfangsbuchstaben
		if (count(_Praxisbetrieb::get_praxisbetriebe()) >= LINKBAR_EINBLENDEN_AB_ANZAHL) $html .= _Content::anchorlinkbar();
		
		// Buttons Praxisbetriebe
		$letter = "";
		$html .= "<div>";
		
		foreach (_Praxisbetrieb::get_praxisbetriebe() as $praxisbetrieb) {
			
			// Buchstabe
			if (strtoupper($praxisbetrieb[1][0]) != $letter)
				$html .= "</div><h3 id='" . strtolower($praxisbetrieb[1][0]) . "'>" . $praxisbetrieb[1][0] . "</h3><div class='flex-row flex-wrap praxisbildner'>";
			
			// Praxisbetrieb
			$html .= _Form::button($praxisbetrieb[1], "praxisbetriebSpeichern_" . $this->id . "_" . $praxisbetrieb[0], "btn-link");
			
			$letter = strtoupper($praxisbetrieb[1][0]);
		}
		$html .= "</div></form>";
		
		return $html;
	}
	
}

?>