<?php

class _Praxisbetrieb
{
	static private $praxisbetriebe = array();
	
	
	/**
	 * Holt alle Praxisbetriebe und setzt ein alphabetisch sortiertes Array:
	 * 
	 * $array[][0] = id
	 * $array[][1] = Praxisbetrieb
	 * 
	 */
	static function get_praxisbetriebe($id = null)
	{
		if (empty(self::$praxisbetriebe)) {
			
			$praxisbetriebe = array();
			
			$sql = "SELECT * FROM praxisbetrieb ORDER BY praxisbetrieb;";
			$result = _Database::query($sql);
		
			foreach ($result as $result) {
				$praxisbetriebe[] = array($result->id, $result->praxisbetrieb);
			}
			self::$praxisbetriebe =$praxisbetriebe;
		}
		
		if ($id) {
			foreach (self::$praxisbetriebe as $praxisbetrieb) {
				if ($praxisbetrieb[0] == $id) return $praxisbetrieb;
			}
			return false;
		}
		
		return self::$praxisbetriebe;
	}
	
	static function speichern()
	{
		// Prüfen ob Feld ausgefüllt
		if (empty($_POST['praxisbetriebVerwaltung_betrieb']))
			throw new Exception("Praxisbetrieb kann nicht gespeichert werden. Das Feld ist leer.");
		
		// Prüfen ob der Praxisbetrieb bereits existiert
		$sql = "SELECT * FROM praxisbetrieb WHERE praxisbetrieb = ?;";
		$vars = array();
		$vars[] = array("s", $_POST['praxisbetriebVerwaltung_betrieb']);
		$result = _Database::query($sql, $vars);
		
		if (_Database::$result_num_rows) {
			// Fall: Update
			if (isset($_POST['button'][1])) {
				if ($result[0]->id != $_POST['button'][1])
					throw new Exception("Praxisbetrieb kann nicht gespeichert werden. Ein Praxisbetrieb mit dem gleichen Namen existiert bereits.");
			}
			// Fall: Neuer Eintrag
			else throw new Exception("Praxisbetrieb kann nicht gespeichert werden. Ein Praxisbetrieb mit dem gleichen Namen existiert bereits.");
		}
		
		// Speichern
		if (isset($_POST['button'][1])) {
			$sql = "UPDATE praxisbetrieb SET praxisbetrieb = ? WHERE id = ?;";
			$vars = array();
			$vars[] = array("s", $_POST['praxisbetriebVerwaltung_betrieb']);
			$vars[] = array("i", $_POST['button'][1]);
			_Database::query($sql, $vars);
		}
		else {
			$sql = "INSERT INTO praxisbetrieb (praxisbetrieb) VALUES (?);";
			$vars = array();
			$vars[] = array("s", $_POST['praxisbetriebVerwaltung_betrieb']);
			_Database::query($sql, $vars);
		}
	}
	
	static function html_praxisbetriebeAnzeigen()
	{
		$html = "<h1>Alle Praxisbetriebe</h1>
				<form method='POST'>
				<div class='flex-row button-row'>"
				. _Form::input(null, "text", "praxisbetriebVerwaltung_betrieb", null, "", "Praxisbetrieb", true)
				. _Form::button("Speichern", "praxisbetriebVerwaltungSpeichern", "btn-primary")
				. "</div></form>
				<p>&nbsp;</p>";
		
		// Links zu den Anfangsbuchstaben
		if (count(self::get_praxisbetriebe()) >= LINKBAR_EINBLENDEN_AB_ANZAHL) $html .= _Content::anchorlinkbar();
		
		// Auflistung Praxisbetriebe
		$letter = "";
		foreach (self::get_praxisbetriebe() as $praxisbetrieb) {
			
			// Titel
			if ($praxisbetrieb[1][0] != $letter) $html .= "<h3 id='" . strtolower($praxisbetrieb[1][0]) . "'>" . $praxisbetrieb[1][0] . "</h3>";
			
			$html .= "<div class='flex-row praxisbildner'>
					<div class='praxisbildner1'>";
			
			// Praxisbetrieb ändern
			if (isset($_SESSION['page'][1]) && $_SESSION['page'][1] == $praxisbetrieb[0]) {
				
				$html .= "<form method='POST'><div class='flex-row button-row'>"
						. _Form::input(null, "text", "praxisbetriebVerwaltung_betrieb", $praxisbetrieb[1], "", null, true)
						. _Form::button("Speichern", "praxisbetriebVerwaltungSpeichern_" . $praxisbetrieb[0], "btn-primary")
						. "<a class='btn btn-default' href='?page=praxisbetriebe'>Abbrechen</a>
						</div></form>";
			}
			// Praxisbetrieb normal anzeigen
			else {
				// "Praxisbetrieb System" nicht änderbar
				if ($praxisbetrieb[1] == PRAXISBETRIEB_SYSTEM) $html .= $praxisbetrieb[1];
				
				else $html .= "<a href='?page=praxisbetriebe_" . $praxisbetrieb[0] . "'>" . $praxisbetrieb[1] . "</a>";
			}
			
			// Praxisbildner anzeigen
			$html .= "</div><div class='praxisbildner2'>";
			
			$zugehoerigepraxisbildner = array();
			foreach (_Praxisbildner::get_praxisbildner() as $praxisbildner) {
				if ($praxisbildner[3] == $praxisbetrieb[0]) $zugehoerigepraxisbildner[] = $praxisbildner[2];
			}
			
			for ($i=0; $i<count($zugehoerigepraxisbildner); $i++) {
				$html .= $zugehoerigepraxisbildner[$i];
				if ($i + 1 < count($zugehoerigepraxisbildner)) $html .= " | ";
			}
			if (!count($zugehoerigepraxisbildner)) $html .= "-";
			
			$html .= "</div></div>";
			$letter = $praxisbetrieb[1][0];
		}
		
		return $html;
	}
	
}

?>
