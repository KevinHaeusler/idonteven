<?php

class _Schuetze{
    static private $schuetzen = array();
    static private $alleschuetzen = array();



    /**
	 * Holt alle Schuetzen und setzt ein alphabetisch sortiertes Array:
	 *
	 * $array[][0] = id
	 * $array[][1] = Vorname Name
	 * $array[][2] = Name, Vorname
	 * $array[][3] = Jahrgang
	 * $array[][4] = Ort
	 *
	 */
    static function get_schuetzen($id = null){
        // falls noch nicht geschehen: alle Schuetzen laden
		if (empty(self::$schuetzen)) {
			
			$schuetzen = array();
			$sql = "SELECT schuetze.id, schuetze.vorname, schuetze.nachname, schuetze.jahrgang, schuetze.ort FROM schuetze ORDER BY schuetze.nachname, schuetze.vorname;";
                    
               
			$result = _Database::query($sql);
			foreach ($result as $result) {
				$schuetzen[] = array($result->id, $result->vorname . ", " . $result->nachname, $result->nachname . ", " . $result->vorname, $result->jahrgang, $result->ort);
			}
			self::$schuetzen = $schuetzen;
        }

        // nur einen bestimmten Schuetzen zurueckgeben
		if ($id) {
			foreach (self::$schuetzen as $schuetze) {
				if ($schuetze[0] == $id) return $schuetze;
			}
			return false;
        }
        return self::$schuetzen;
    }




		// DropDown Menu um Schütze bei Resultateingabe auszuwählen

			static function get_selectOptions()
			{
				$selectoptions = array();
				// $selectoptions[] = array("null", "--- Bitte w&auml;hlen ---");
		
				foreach (self::get_schuetzen() as $schuetzen) {
					$selectoptions[] = array($schuetzen[0], $schuetzen[2], $schuetzen[2][0]);
				}
				return $selectoptions;
			}



	static function get_veteranen($id = null)
	{
		$schuetzen = array();
		$sql = "SELECT schuetze.id, schuetze.vorname, schuetze.nachname, schuetze.jahrgang, schuetze.ort FROM schuetze
				WHERE schuetze.jahrgang < '1959'	 
				ORDER BY schuetze.nachname, schuetze.vorname;";
		$result = _Database::query($sql);
		
		foreach ($result as $result) {
			$schuetzen[] = $result->id;
		}
				
		if ($id) return in_array($id, $schuetzen);


		return $schuetzen;
	}

	


    static function get_alleschuetzen($id = null)
	{
		
		// falls noch nicht erstellt : $aktivelehrlinge erstellen
		if (empty(self::$alleschuetzen)) {	
			$schuetzen = array();
			
			$sql = "SELECT schuetze.id, schuetze.vorname, schuetze.nachname, schuetze.jahrgang, schuetze.ort FROM schuetze ORDER BY schuetze.nachname, schuetze.vorname;";
			$result = _Database::query($sql);
			
			foreach ($result as $result) {
				$schuetzen[] = $result->id;
			}
			self::$alleschuetzen = $schuetzen;
		}
		
		if ($id) return in_array($id, self::$alleschuetzen);
		
		return self::$alleschuetzen;
	}

	static function loeschen() 
	{ 
		// L�schen
		$sql = "DELETE FROM schuetze WHERE id = ?"; 
		$vars = array(); 
		$vars[] = array("i", $_POST['button'][1]); 
		_Database::query($sql, $vars); 
	}


    static function html_schuetzeAnzeigen(){

    // Alle Schuetzen
    if (!isset($_SESSION['page'][1])) {
        $html = "<h1>Alle Schützen</h1>
                <div class='flex-row button-row'>
                <a class='btn btn-primary' href='?page=schuetzenverwaltung_neu'><span class='glyphicon glyphicon-plus'></span> Schütze erfassen</a>
                <a class='btn btn-default' href='?page=schuetzenverwaltung_u65'><span class=''></span>&Uuml;ber 65 Jahre(Veteranen)</a>
                </div>
                <p>&nbsp;</p>";
        $schuetzen = _Schuetze::get_alleschuetzen();

    }
    else {
					
        // Ueber 65 
        if ($_SESSION['page'][1] == "u65") {
            $html = "<h1>&Uuml;ber 65 Jahre (Veteranen)</h1>
                    <div class='flex-row button-row'>
                    <a class='btn btn-default' href='?page=schuetzenverwaltung'>Zur&uuml;ck</a>
                    </div>
                    <p>&nbsp;</p>";
            $schuetzen = _Schuetze::get_veteranen();
        }
    }

    // Links zu den Anfangsbuchstaben 
        if (count($schuetzen) >= LINKBAR_EINBLENDEN_AB_ANZAHL) $html .= _Content::anchorlinkbar();
        // Auflistung schuetzen


	// Auflistung Schützen
		$letter = "";
		foreach ($schuetzen as $schuetze) {
			
			$schuetze = _Schuetze::get_schuetzen($schuetze);
			$firstletter = $schuetze[2][0];
			
			// Titel Buchstabe
			if ($firstletter != $letter) {
				$html .= "<h3 id='" . strtolower($firstletter) . "'>$firstletter</h3>";
			}
			

			
			$html .= "<div class='flex-row lehrling'>
					<div class='lehrling1'><a href='?page=schuetzenverwaltung_bearbeiten_" . $schuetze[0] . "'>" . $schuetze[2] . "</a></div>
					<div class='lehrling2'>Jahrgang $schuetze[3]</div>
					<div class='lehrling3'>$schuetze[4]</div></div>";			
			$letter = $firstletter;
        }
        return $html;
    }



	



 


}
?>