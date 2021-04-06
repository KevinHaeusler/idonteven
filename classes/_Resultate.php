<?php



class _Resultate{
	static private $resultate = array();
	static private $resultateAll = array();

	static private $rvSchuetze = 'Manuel Matter';
	static private $rvAnlass;


    // static private $u65schuetzen = array();

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

	// Auslesen der Werte für die Vereinsmeisterschaft
	static function get_vereinsmeisterschaft($id = null){

		if (empty(self::$resultate)) {

			$resultate = array();
			$sql = "SELECT resultate.id, schuetze.vorname, schuetze.nachname, anlass.datum, anlass.anlassname, resultate.vmReh1 FROM schuetze, resultate, anlass";

			$result = _Database::query($sql);
			foreach ($result as $result) {
				$resultate[] = array($result->id, $result->nachname . ", " . $result->vorname, $result->anlassname . ", " . $result->datum, $result->vmReh1);
			}
			self::$resultate = $resultate;
        }

        // nur einen bestimmten Schuetzen zurueckgeben
		if ($id) {
			foreach (self::$resultate as $resultat) {
				if ($resultat[0] == $id) return $resultat;
			}
			return false;
        }
        return self::$resultate;
    }

	static function get_vereinsmeisterschaftall($id = null)
	{

		// falls noch nicht erstellt : $aktivelehrlinge erstellen
		if (empty(self::$resultateAll)) {
			$resultate = array();

			$sql = "SELECT resultate.id, schuetze.vorname, schuetze.nachname, schuetze.jahrgang, schuetze.ort, anlass.anlassname, anlass.datum  FROM resultate, schuetze, anlass";
			$result = _Database::query($sql);

			foreach ($result as $result) {
				$resultate[] = $result->id;
			}
			self::$resultateAll = $resultate;
		}

		if ($id) return in_array($id, self::$resultateAll);

		return self::$resultateAll;
	}



	// Auslesen der Werte für den Fuchsstich
    static function get_fuchstich($id = null){

		if (empty(self::$resultate)) {

			$resultate = array();
			$sql = "SELECT resultate.id, resultate.stich1, resultate.stich2, resultate.stich3, resultate.tiefschussstich1, resultate.totalfs FROM resultate ORDER BY resultate.id;";


			$result = _Database::query($sql);
			foreach ($result as $result) {
				$resultate[] = array($result->id, $result->stich1 . $result->stich2 . $result->stich3 . ", " . $result->tiefschussstich1 . ", " . $result->totalfs);
			}
			self::$resultate = $resultate;
        }

		if ($id) {
			foreach (self::$resultate as $resultat) {
				if ($resultat[0] == $id) return $resultat;
			}
			return false;
        }
        return self::$resultate;
    }



	// Auslesen der Werte für die Schrotmeisterschaft
    static function get_schrotmeisterschaft($id = null){

		if (empty(self::$resultate)) {

			$resultate = array();
			$sql = "SELECT resultate.id, resultate.klapphassm, resultate.rollhassm, resultate.totalsm FROM resultate ORDER BY resultate.id;";


			$result = _Database::query($sql);
			foreach ($result as $result) {
				$resultate[] = array($result->id, $result->klapphassm . $result->rollhassm . ", " . $result->totalsm);
			}
			self::$resultate = $resultate;
        }

		if ($id) {
			foreach (self::$resultate as $resultat) {
				if ($resultat[0] == $id) return $resultat;
			}
			return false;
        }
        return self::$resultate;
    }


	// Löschfunktion
	static function loeschen()
	{
		$sql = "DELETE FROM schuetze WHERE id = ?";
		$vars = array();
		$vars[] = array("i", $_POST['button'][1]);
		_Database::query($sql, $vars);


	}




	static function suchen()
	{




		$_POST['resultatverwaltung_schuetze'] = '';

		$nr = 1;

		if (isset($_POST["resultatverwaltung_schuetze"]))
						{
						$rvSchuetze = $_POST['resultatverwaltung_schuetze'];

						$html = "<h2> Es wurden bereits Resultate erfasst für $rvSchuetze </h2> </br>"
						. "<div class='flex-row form-row'>"
						. "<a class='btn btn-primary' href='?page=resultatverwaltung_bearbeiten_" . $nr . "'><span class=''></span>Resultate Bearbeiten</a>";
						return $html;

						}
						else
						{
						$rvSchuetze = null;

						$html =  "<h2> Es wurden für diesen Schützen bisher keine Resultate erfasst </h2> </br>"
							. "<div class='flex-row form-row'>"
							. "<a class='btn btn-primary' href='?page=resultatverwaltung_neu'><span class='glyphicon glyphicon-plus'></span> Resultate erfassen</a>"
							. "</div>";
							return $html;
				}


	//	$nr = 1;
	//
	//	if ($result = 0) {
	//
	//		$html =  "<h2> Es wurden bisher keine Resultate erfasst </h2> </br>"
	//		. "<div class='flex-row form-row'>"
	//		. "<a class='btn btn-primary' href='?page=resultatverwaltung_neu'><span class='glyphicon glyphicon-plus'></span> Resultate erfassen</a>"
	//		. "</div>";
	//		return $html;
	//
	//
	//	} else {
	//
	//		$html = "<h2> Es wurden bereits Resultate erfasst </h2> </br>"
	//		. "<div class='flex-row form-row'>"
	//		. "<a class='btn btn-primary' href='?page=resultatverwaltung_bearbeiten_" . $nr . "'><span class=''></span>Resultate Bearbeiten</a>";
	//		return $html;
	//
	//
	//	}

	//	$sql = "SELECT resultate.id FROM resultate WHERE resultate.schuetze_id = $select1";
	//	$vars = array();
	//	$vars[] = array("i", $_POST['button'][0]);
	//	_Database::query($sql, $vars);

	}


	// Visuelle Darstellung der DropDown Menu
	static function html_resultateAuswerten()
	{

		$html =
			 "<p>&nbsp;</p>"
			. "<form method='POST'>"
			. "<div class='flex-row form-row'>"
			. _Form::select("<span class='select1' ></span> Schütze auswählen", "resultatverwaltung_schuetze", _Schuetze::get_selectOptions(), null, "personalien5")
			. _Form::select("<span class='select2' ></span> Anlass auswählen", "resultatverwaltung_anlass", _Anlass::get_selectOptions(), null, "personalien6")
			. _Form::button("Suchen", "resultatverwaltung_search_","btn-primary")

			. "<style>
					.btn-primary {

					margin-top: 25px;
					margin-left: 1px;
					margin-bottom: 25px;

				}
			  </style>"
			. "</div>"
			. "</form>";

		return $html;






    }


    static function html_resultateAnzeigen(){

	$auswertung = _Resultate::html_resultateAuswerten();

    if (!isset($_SESSION['page'][1])) {

        $html = "<h1>Resultate erfassen</h1>

			$auswertung ";

			$resultate = _Resultate::get_vereinsmeisterschaftall();

		}


        return $html;
    }


}
?>