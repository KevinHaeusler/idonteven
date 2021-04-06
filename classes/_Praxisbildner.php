<?php

class _Praxisbildner
{
	static private $praxisbildner = array();
	static private $aktivepraxisbildner = array();
	
	
	/**
	 * Holt alle Praxisbildner und setzt ein alphabetisch sortiertes Array:
	 * 
	 * $array[][0] = id
	 * $array[][1] = Vorname Name
	 * $array[][2] = Name, Vorname
	 * $array[][3] = Praxisbetrieb-id
	 * $array[][4] = Praxisbetrieb (Name)
	 * $array[][5] = Archiviert-Status
	 * 
	 */
	static function get_praxisbildner($id = null)
	{
		if (empty(self::$praxisbildner)) {
			
			$praxisbildner = array();
					
			// PBs ohne Praxisbetrieb
			$sql = "SELECT benutzer.id, benutzer.vorname, benutzer.name, praxisbildner.archiviert FROM benutzer, praxisbildner 
					WHERE benutzer.id = praxisbildner.id AND praxisbildner.praxisbetrieb IS NULL 
					ORDER BY benutzer.name, benutzer.vorname;";
			$result = _Database::query($sql);
		
			foreach ($result as $result) {
				$praxisbildner[] = array($result->id, $result->vorname . " " . $result->name, $result->name . ", " . $result->vorname, null, "-", $result->archiviert);
			}
			
			// PBs mit Praxisbetrieb
			$sql = "SELECT benutzer.id, benutzer.vorname, benutzer.name, praxisbildner.archiviert, praxisbetrieb.id as id2, praxisbetrieb.praxisbetrieb 
					FROM benutzer, praxisbildner, praxisbetrieb 
					WHERE benutzer.id = praxisbildner.id AND praxisbildner.praxisbetrieb = praxisbetrieb.id 
					ORDER BY praxisbetrieb.praxisbetrieb, benutzer.name, benutzer.vorname;";
			$result = _Database::query($sql);
		
			foreach ($result as $result) {
				$praxisbildner[] = array($result->id, $result->vorname . " " . $result->name, $result->name . ", " . $result->vorname, $result->id2, $result->praxisbetrieb, $result->archiviert);
			}
			self::$praxisbildner = $praxisbildner;
		}
		
		if ($id) {
			foreach (self::$praxisbildner as $praxisbildner) {
				if ($praxisbildner[0] == $id) return $praxisbildner;
			}
			return false;
		}
		
		return self::$praxisbildner;
	}
	
	/**
	 * aktuelle Praxisbildner = nicht archivierte Praxisbildner
	 * 
	 * 
	 */
	static function get_aktuellePraxisbildner()
	{
		$aktuellepraxisbildner = array();
		
		foreach (self::get_praxisbildner() as $praxisbildner) {
			if (!$praxisbildner[5]) $aktuellepraxisbildner[] = $praxisbildner[0];
		}
		
		return $aktuellepraxisbildner;
	}
	
	static function get_archiviertePraxisbildner()
	{
		$archiviertepraxisbildner = array();
		
		foreach (self::get_praxisbildner() as $praxisbildner) {
			if ($praxisbildner[5]) $archiviertepraxisbildner[] = $praxisbildner[0];
		}
		
		return $archiviertepraxisbildner;
	}
	
	static function get_aktivePraxisbildnerHeute($id = null)
	{
		if (empty(self::$aktivepraxisbildner)) {
			
			$aktivepraxisbildner = array();
			
			$datum = strftime("%Y-%m-%d");
			$sql = "SELECT DISTINCT praxiseinsatz.praxisbildner FROM praxisbildner, praxiseinsatz 
					WHERE '$datum' >= praxiseinsatz.startdatum AND '$datum' <= praxiseinsatz.enddatum 
					AND praxisbildner.id = praxiseinsatz.praxisbildner AND praxisbildner.archiviert = 0;";
			$result = _Database::query($sql);
			
			foreach ($result as $result) {
				$aktivepraxisbildner[] = $result->praxisbildner;
			}
			self::$aktivepraxisbildner = $aktivepraxisbildner;
		}
		
		if ($id) return in_array($id, self::$aktivepraxisbildner);
		
		return self::$aktivepraxisbildner;
	}
	
	static function get_inaktivePraxisbildnerHeute($id = null)
	{
		$inaktivepraxisbildner = array();
		
		$datum = strftime("%Y-%m-%d");
		$sql = "SELECT DISTINCT id FROM praxisbildner 
				WHERE id NOT IN (SELECT DISTINCT praxisbildner FROM praxiseinsatz WHERE '$datum' >= startdatum AND '$datum' <= enddatum)
				AND archiviert = 0;";
		$result = _Database::query($sql);
		
		foreach ($result as $result) {
			$inaktivepraxisbildner[] = $result->id;
		}
		
		if ($id) return in_array($id, $inaktivepraxisbildner);
		
		return $inaktivepraxisbildner;
	}

	static function html_praxisbildnerAnzeigen()
	{
		// Aktuelle Praxisbildner
		if (!isset($_SESSION['page'][1])) {
			$html = "<h1>Aktuelle Praxisbildner</h1>
					<div class='flex-row button-row'>
					<a class='btn btn-primary' href='?page=praxisbildnerverwaltung_neu'><span class='glyphicon glyphicon-plus'></span> Neu</a>
					<a class='btn btn-default' href='?page=praxisbildnerverwaltung_archivierte'><span class='glyphicon glyphicon-eye-open'></span> Archivierte Praxisbildner</a>
					</div>
					<p>&nbsp;</p>";
			$praxisbildner = self::get_aktuellePraxisbildner();
		}
		
		// Archivierte Praxisbildner
		else if ($_SESSION['page'][1] == "archivierte") {
			$html = "<h1>Archivierte Praxisbildner</h1>
					<div class='flex-row button-row'>
					<a class='btn btn-default' href='?page=praxisbildnerverwaltung'>Zur&uuml;ck</a>
					</div>
					<p>&nbsp;</p>";
			$praxisbildner = self::get_archiviertePraxisbildner();
		}
		
		// Links zu den Anfangsbuchstaben
		if (count($praxisbildner) >= LINKBAR_EINBLENDEN_AB_ANZAHL) $html .= _Content::anchorlinkbar();
		
		// Auflistung Praxisbildner
		$firstletter = "";
		$titel = "";
		
		foreach ($praxisbildner as $praxisbildner) {
			
			$praxisbildner = _Praxisbildner::get_praxisbildner($praxisbildner);
			
			// Titel
			$id = "";
			if ($firstletter != $praxisbildner[4][0]) {
				$firstletter = $praxisbildner[4][0];
				$id = "id='$firstletter'";
			}
			
			if ($praxisbildner[4] != $titel) $html .= "<h3 $id>$praxisbildner[4]</h3>";
			
			$html .= "<div class='flex-row praxisbildner'>
					<div class='praxisbildner1'><a href='?page=praxisbildnerverwaltung_bearbeiten_" . $praxisbildner[0] . "'>" . $praxisbildner[2] . "</a></div>
					<div class='praxisbildner2'>";
			
			$lehrlinge = _Praxiseinsatz::get_praxiseinsaetzeVonPraxisbildnerHeute($praxisbildner[0]);
			
			for ($i=0; $i<count($lehrlinge); $i++) {
				$html .= _Lehrling::get_lehrlinge($lehrlinge[$i])[1];
				if ($i + 1 < count($lehrlinge)) $html .= " | ";
			}
			$html .= "</div></div>";
			
			$titel = $praxisbildner[4];
		}
		
		return $html;
	}
	
}

?>
