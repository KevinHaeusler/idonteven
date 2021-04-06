<?php
class _Anlass {
    static private $anlaesse = array();
    static private $alleanlaesse = array();


    // static private $u65schuetzen = array();

    /**
	 * Holt alle Schuetzen und setzt ein alphabetisch sortiertes Array:
	 *
	 * $array[][0] = id
	 * $array[][1] = anlassname
	 * $array[][2] = datum
	 *
	 */



    static function get_anlaesse($id = null) {                                                                                                                                           

        if (empty(self::$anlaesse)) {

            $anlaesse = array();
            $sql = "SELECT anlass.id, anlass.anlassname, anlass.datum FROM anlass ORDER BY anlass.id;";

            $result = _Database::query($sql);
            foreach ($result as $result) {

                $anlaesse[] = array($result->id, $result->anlassname, $result->datum);
            }
                self::$anlaesse = $anlaesse;

        }


        // nur einen bestimmten Anlass zurueckgeben
		if ($id) {
			foreach (self::$anlaesse as $anlass) {
				if ($anlass[0] == $id) return $anlass;
			}
			return false;
        }
        return self::$anlaesse;


    }


    // DropDown Menu um Anlass in Resultateingabe auszuwählen
	static function get_selectOptions()
	{
		$selectoptions = array();
		// $selectoptions[] = array("null", "--- Bitte w&auml;hlen ---");
		
		foreach (self::get_anlaesse() as $anlaesse) {
			$selectoptions[] = array($anlaesse[0], $anlaesse[1], $anlaesse[2]);
		}
		return $selectoptions;
	}



    static function loeschen(){ 
        // L�schen
        $sql = "DELETE FROM anlass WHERE id = ?"; 
        $vars = array(); 
        $vars[] = array("i", $_POST['button'][1]); 
        _Database::query($sql, $vars); 
    }

    static function get_alleanlaesse($id = null)
	{
		
		// falls noch nicht erstellt : $aktiveAnlässe erstellen
		if (empty(self::$alleanlaesse)) {	
			$anlaesse = array();
			
			$sql = "SELECT anlass.id, anlass.anlassname, anlass.datum FROM anlass ORDER BY anlass.id;";
			$result = _Database::query($sql);
			
			foreach ($result as $result) {
				$anlaesse[] = $result->id;
			}
			self::$alleanlaesse = $anlaesse;
		}
		
		if ($id) return in_array($id, self::$alleanlaesse);
		
		return self::$alleanlaesse;
	}

    static function html_anlaesseAnzeigen(){

        // Alle Schuetzen
        if (!isset($_SESSION['page'][1])) {
            $html = "<h1>Alle Anlässe</h1>
                    <div class='flex-row button-row'>
                    <a class='btn btn-primary' href='?page=anlassverwaltung_neu'><span class='glyphicon glyphicon-plus'></span> Anlass erfassen</a>
                    </div>
                    <p>&nbsp;</p>";
            $anlaesse = _Anlass::get_alleanlaesse();
    
        }
    
        // Links zu den Anfangsbuchstaben 
            if (count($anlaesse) >= LINKBAR_EINBLENDEN_AB_ANZAHL) $html .= _Content::anchorlinkbar();
           
           
           
            // Auflistung Anlässe
    
            $letter = "";
            foreach ($anlaesse as $anlass) {
                
                $anlass = _Anlass::get_anlaesse($anlass);
                $firstletter = $anlass[2];
                
                  // Titel Buchstabe
                  if ($firstletter != $letter) {
                    $html .= "<h3 id='" . strtolower($firstletter) . "'>$firstletter</h3>";
                }
                
    
                
                $html .= "<div class='flex-row lehrling'>
                        <div class='lehrling1'><a href='?page=anlassverwaltung_bearbeiten_" . $anlass[0]. "'>" . $anlass[1]. "</a></div>
                        </div>";			
                $letter = $firstletter;
            }
            return $html;
        }

}

?>