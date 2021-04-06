<?php

class _Lehrling
{
	static private $lehrlinge = array();
	static private $aktivelehrlinge = array();
	
	
	/**
	 * Holt alle Lehrlinge und setzt ein alphabetisch sortiertes Array:
	 *
	 * $array[][0] = id
	 * $array[][1] = Vorname Name
	 * $array[][2] = Name, Vorname
	 * $array[][3] = Schulort-id
	 * $array[][4] = Lehrbeginn
	 * $array[][5] = Lehrende
	 *
	 */
	static function get_lehrlinge($id = null)
	{
		// falls noch nicht geschehen: alle Lehrlinge laden
		if (empty(self::$lehrlinge)) {
			
			$lehrlinge = array();
			$sql = "SELECT benutzer.id, benutzer.vorname, benutzer.name, lehrling.schulort, lehrling.lehrbeginn, lehrling.lehrende FROM benutzer, lehrling
					WHERE benutzer.id = lehrling.id ORDER BY benutzer.name, benutzer.vorname;";
			$result = _Database::query($sql);
			
			foreach ($result as $result) {
				$lehrlinge[] = array($result->id, $result->vorname . " " . $result->name, $result->name . ", " . $result->vorname, $result->schulort, $result->lehrbeginn, $result->lehrende);
			}
			self::$lehrlinge = $lehrlinge;
		}
		
		// nur einen bestimmten Lehrling zur�ckgeben
		if ($id) {
			foreach (self::$lehrlinge as $lehrling) {
				if ($lehrling[0] == $id) return $lehrling;
			}
			return false;
		}
		
		// alle LL zur�ckgeben
		return self::$lehrlinge;
	}
	
	static function get_aktiveLehrlingeHeute($id = null)
	{
		
		// falls noch nicht erstellt : $aktivelehrlinge erstellen
		if (empty(self::$aktivelehrlinge)) {	
			$lehrlinge = array();
			
			$datum = strftime("%Y-%m-%d");
			$sql = "SELECT lehrling.id FROM benutzer, lehrling 
					WHERE '$datum' >= lehrling.lehrbeginn AND '$datum' <= lehrling.lehrende 
					AND lehrling.id = benutzer.id ORDER BY benutzer.name, benutzer.vorname;";
			$result = _Database::query($sql);
			
			foreach ($result as $result) {
				$lehrlinge[] = $result->id;
			}
			self::$aktivelehrlinge = $lehrlinge;
		}
		
		if ($id) return in_array($id, self::$aktivelehrlinge);
		
		return self::$aktivelehrlinge;
	}
	
	static function get_zukuenftigeLehrlingeHeute($id = null)
	{
		$zukuenftigelehrlinge = array();
		
		$datum = strftime("%Y-%m-%d");
		$sql = "SELECT lehrling.id FROM benutzer, lehrling 
				WHERE '$datum' < lehrling.lehrbeginn 
				AND lehrling.id = benutzer.id ORDER BY benutzer.name, benutzer.vorname;";
		$result = _Database::query($sql);
		
		foreach ($result as $result) {
			$zukuenftigelehrlinge[] = $result->id;
		}
		
		if ($id) return in_array($id, $zukuenftigelehrlinge);
		
		return $zukuenftigelehrlinge;
	}
	
	static function get_ehemaligeLehrlingeHeute($id = null)
	{
		$ehemaligelehrlinge = array();
		
		$datum = strftime("%Y-%m-%d");
		$sql = "SELECT lehrling.id FROM benutzer, lehrling 
				WHERE '$datum' > lehrling.lehrende 
				AND lehrling.id = benutzer.id ORDER BY benutzer.name, benutzer.vorname;";
		$result = _Database::query($sql);
		
		foreach ($result as $result) {
			$ehemaligelehrlinge[] = $result->id;
		}
		
		if ($id) return in_array($id, $ehemaligelehrlinge);
		
		return $ehemaligelehrlinge;
	}
	
	static function get_aktiveLehrlingeImMonat($monat)
	{
		$lehrlinge = array();
		
		$sql = "SELECT lehrling.id FROM benutzer, lehrling 
				WHERE '$monat' >= DATE(DATE_FORMAT(lehrling.lehrbeginn, '%Y-%m-01')) 
				AND '$monat' <= DATE(DATE_FORMAT(lehrling.lehrende, '%Y-%m-01')) 
				AND lehrling.id = benutzer.id ORDER BY benutzer.name, benutzer.vorname;";
		$result = _Database::query($sql);
		
		foreach ($result as $lehrling) {
			$lehrlinge[] = $lehrling->id;
		}
		return $lehrlinge;
	}
	
	static function get_aktiveLehrlingeImMonatZuBerufsbildner($monat, $berufsbildner)
	{
		$lehrlinge = array();
		
		$sql = "SELECT lehrling.id FROM benutzer, lehrling 
				WHERE lehrling.berufsbildner = $berufsbildner 
				AND '$monat' >= DATE(DATE_FORMAT(lehrling.lehrbeginn, '%Y-%m-01')) 
				AND '$monat' <= DATE(DATE_FORMAT(lehrling.lehrende, '%Y-%m-01')) 
				AND lehrling.id = benutzer.id ORDER BY benutzer.name, benutzer.vorname;";
		$result = _Database::query($sql);
		
		foreach ($result as $lehrling) {
			$lehrlinge[] = $lehrling->id;
		}
		return $lehrlinge;
	}
	
	static function get_aktiveLehrlingeImMonatZuPraxisbildner($monat, $praxisbildner)
	{
		$lehrlinge = array();
		
		$sql = "SELECT DISTINCT lehrling.id FROM benutzer, lehrling, praxiseinsatz 
				WHERE '$monat' >= DATE(DATE_FORMAT(lehrling.lehrbeginn, '%Y-%m-01')) 
				AND '$monat' <= DATE(DATE_FORMAT(lehrling.lehrende, '%Y-%m-01')) 
				AND lehrling.id = praxiseinsatz.lehrling 
				AND praxiseinsatz.praxisbildner = $praxisbildner 
				AND '$monat' >= DATE(DATE_FORMAT(praxiseinsatz.startdatum, '%Y-%m-01')) 
				AND '$monat' <= DATE(DATE_FORMAT(praxiseinsatz.enddatum, '%Y-%m-01')) 
				AND lehrling.id = benutzer.id ORDER BY benutzer.name, benutzer.vorname;";
		$result = _Database::query($sql);
		
		foreach ($result as $lehrling) {
			$lehrlinge[] = $lehrling->id;
		}
		return $lehrlinge;
	}
	
	static function html_lernendeAnzeigen()
	{
		// Aktive Lernende
		if (!isset($_SESSION['page'][1])) {
			$html = "<h1>Aktive Lernende</h1>
					<div class='flex-row button-row'>
					<a class='btn btn-primary' href='?page=lehrlingverwaltung_neu'><span class='glyphicon glyphicon-plus'></span> Neu</a>
					<a class='btn btn-default' href='?page=lehrlingverwaltung_zukuenftige'><span class='glyphicon glyphicon-eye-open'></span> Zuk&uuml;nftige Lernende</a>
					<a class='btn btn-default' href='?page=lehrlingverwaltung_ehemalige'><span class='glyphicon glyphicon-eye-open'></span> Ehemalige Lernende</a>
					</div>
					<p>&nbsp;</p>";
			$lehrlinge = _Lehrling::get_aktiveLehrlingeHeute();
		}
		else {
					
			// Zuk�nftige Lernende
			if ($_SESSION['page'][1] == "zukuenftige") {
				$html = "<h1>Zuk&uuml;nftige Lernende</h1>
						<div class='flex-row button-row'>
						<a class='btn btn-default' href='?page=lehrlingverwaltung'>Zur&uuml;ck</a>
						</div>
						<p>&nbsp;</p>";
				$lehrlinge = _Lehrling::get_zukuenftigeLehrlingeHeute();
			}
			
			// Ehemalige Lernende
			if ($_SESSION['page'][1] == "ehemalige") {
				$html = "<h1>Ehemalige Lernende</h1>
						<div class='flex-row button-row'>
						<a class='btn btn-default' href='?page=lehrlingverwaltung'>Zur&uuml;ck</a>
						</div>
						<p>&nbsp;</p>";
				$lehrlinge = _Lehrling::get_ehemaligeLehrlingeHeute();
			}
		}
		
		// Links zu den Anfangsbuchstaben
		if (count($lehrlinge) >= LINKBAR_EINBLENDEN_AB_ANZAHL) $html .= _Content::anchorlinkbar();
		
		// Auflistung Lernende
		$letter = "";
		foreach ($lehrlinge as $lehrling) {
			
			$lehrling = _Lehrling::get_lehrlinge($lehrling);
			$firstletter = $lehrling[2][0];
			
			// Titel Buchstabe
			if ($firstletter != $letter) {
				$html .= "<h3 id='" . strtolower($firstletter) . "'>$firstletter</h3>";
			}
			
			// Heutigen Praxisbildner holen
			$praxisbildner = _Praxiseinsatz::get_praxisbildnerAmTag($lehrling[0], strftime("%Y-%m-%d"));
			if ($praxisbildner) $praxisbildnername = _Praxisbildner::get_praxisbildner($praxisbildner)[1];
			else $praxisbildnername = "+ Praxiseinsatz hinzuf&uuml;gen";
			
			// Lehrgang holen
			$lehrganglehrling = new Lehrling($lehrling[0]);
			$lehrgang =_Lehrgang::get_lehrgaenge($lehrganglehrling->get_property("lehrgang"))[4];
			
			$html .= "<div class='flex-row lehrling'>
					<div class='lehrling1'><a href='?page=lehrlingverwaltung_bearbeiten_" . $lehrling[0] . "'>" . $lehrling[2] . "</a></div>
					<div class='lehrling2'>$lehrgang</div>
					<div class='lehrling3'>$lehrgang</div></div>";
			
			$letter = $firstletter;
		}
		
		return $html;
	}
	
}

?>
