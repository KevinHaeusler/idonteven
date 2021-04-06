<?php

class _Berufsbildner
{
	static private $berufsbildner = array();
	
	
	/**
	 * Holt alle Berufsbildner und setzt ein alphabetisch sortiertes Array:
	 * 
	 * $array[][0] = id
	 * $array[][1] = Vorname Name
	 * $array[][2] = Name, Vorname
	 * 
	 */
	static function get_berufsbildner($id = null)
	{
		if (empty(self::$berufsbildner)) {
			
			$berufsbildner = array();
			$sql = "SELECT benutzer.id, benutzer.vorname, benutzer.name FROM benutzer, berufsbildner
					WHERE benutzer.id = berufsbildner.id ORDER BY benutzer.name, benutzer.vorname;";
			$result = _Database::query($sql);
		
			foreach ($result as $result) {
				$berufsbildner[] = array($result->id, $result->vorname . " " . $result->name, $result->name . ", " . $result->vorname);
			}
			self::$berufsbildner = $berufsbildner;
		}
		
		if ($id) {
			foreach (self::$berufsbildner as $berufsbildner) {
				if ($berufsbildner[0] == $id) return $berufsbildner;
			}
			return false;
		}
		
		return self::$berufsbildner;
	}
	
	static function get_selectOptions()
	{
		$selectoptions = array();
		$selectoptions[] = array("null", "--- Bitte w&auml;hlen ---");
		
		foreach (self::get_berufsbildner() as $berufsbildner) {
			$selectoptions[] = array($berufsbildner[0], $berufsbildner[1]);
		}
		return $selectoptions;
	}
	
}

?>
