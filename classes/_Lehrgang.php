<?php

class _Lehrgang
{
	static private $lehrgaenge = array();
	static private $kostenstellen = array();
	
	
	/**
	 * Gibt einen oder alle Lehrgänge zurück, alphabetisch sortiert
	 * 
	 * $array[][0] = Lehrgang-id
	 * $array[][1] = Lehrgang (Name)
	 * $array[][2] = Lehrdauer
	 * $array[][3] = Lehrberuf-id
	 * $array[][4] = Lehrberuf (Name)
	 * $array[][5] = Kostenstellen-id
	 * $array[][6] = Kostenstelle (Name)
	 * 
	 */
	static function get_lehrgaenge($id = null)
	{
		if (empty(self::$lehrgaenge)) {
			
			$lehrgaenge = array();
			$sql = "SELECT _lehrgang.id, _lehrgang.lehrgang, _lehrgang.lehrdauer, 
					_lehrberuf.id as id2, _lehrberuf.lehrberuf as lehrberuf2,
					_kostenstelle.id as id3, _kostenstelle.kostenstelle as kostenstelle2 
					FROM _lehrgang, _lehrberuf, _kostenstelle 
					WHERE _lehrgang.lehrberuf = _lehrberuf.id
					AND _lehrgang.kostenstelle = _kostenstelle.id 
					ORDER BY _lehrgang.lehrgang;";
			$result = _Database::query($sql);
			
			foreach ($result as $result) {
				$lehrgaenge[] = array($result->id, $result->lehrgang, $result->lehrdauer, $result->id2, $result->lehrberuf2, $result->id3, $result->kostenstelle2);
			}
			self::$lehrgaenge = $lehrgaenge;
		}
		
		if ($id) {
			foreach (self::$lehrgaenge as $lehrgang) {
				if ($lehrgang[0] == $id) return $lehrgang;
			}
			return false;
		}
		
		return self::$lehrgaenge;
	}
	
	static function get_selectOptions($ofgroup = null)
	{
		$selectoptions = array();
		$selectoptions[] = array("null", "--- Bitte w&auml;hlen ---");
		
		foreach (self::get_lehrgaenge() as $lehrgang) {
			if ($ofgroup) {
				if ($lehrgang[4] == $ofgroup) $selectoptions[] = array($lehrgang[0], $lehrgang[1]);
			}
			else $selectoptions[] = array($lehrgang[0], $lehrgang[1], $lehrgang[4]);
		}
		return $selectoptions;
	}
	
	static function get_kostenstellen($id = null)
	{
		if (empty(self::$kostenstellen)) {
			
			$kostenstellen = array();
			$sql = "SELECT * FROM _kostenstelle 
					ORDER BY _kostenstelle.kostenstelle;";
			$result = _Database::query($sql);
			
			foreach ($result as $result) {
				$kostenstellen[] = array($result->id, $result->kostenstelle);
			}
			self::$kostenstellen = $kostenstellen;
		}
		
		if ($id) {
			foreach (self::$kostenstellen as $kostenstelle) {
				if ($kostenstelle[0] == $id) return $kostenstelle[1];
			}
			return false;
		}
		
		return self::$kostenstellen;
	}
	
}

?>
