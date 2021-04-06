<?php

class _Taetigkeit
{
	static private $taetigkeiten = array();
	
	
	/**
	 * Gibt alle Taetigkeiten sortiert nach der Spalte reihenfolge zurück
	 *
	 * $array[][0] = id
	 * $array[][1] = Taetigkeit
	 *
	 */
	static function get_taetigkeiten($id = null)
	{
		if (empty(self::$taetigkeiten)) {
			
			$sql = "SELECT * FROM _taetigkeit ORDER BY reihenfolge;";
			$result = _Database::query($sql);
	
			$taetigkeiten = array();
			foreach ($result as $result) {
				$taetigkeiten[] = array($result->id, $result->taetigkeit);
			}
			self::$taetigkeiten = $taetigkeiten;
		}
		
		if ($id) {
			foreach (self::$taetigkeiten as $taetigkeit) {
				if ($taetigkeit[0] == $id) return $taetigkeit[1];
			}
			return false;
		}
		return self::$taetigkeiten;
	}
	
}

?>
