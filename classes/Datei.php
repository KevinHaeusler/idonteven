<?php

class Datei
{
	private $path;
	private $filename;
	private $file;
	static public $basepath = "../files/";
	
	
	function __construct($typ, $filter)
	{
		// charset zur Ausgabe von Dateiname/-inhalt auf 'latin1' ändern
		_Database::set_charset('latin1');
		
		// Dateiname und -inhalt erzeugen "Statistik Verbundfirmen"
		if ($typ == "verbundfirmen") {
			$lehrling = $filter[0];
			$monat = $filter[1];
			
			$folder = strftime("%Y%m", strtotime($monat));
			$filename_basis = "zeitkontrolle";
			$filename_monat = strftime("%Y-%m", strtotime($monat));
			$filename_name = str_replace(", ", "", _Lehrling::get_lehrlinge($lehrling)[2]);
			$filename = $filename_basis . "_" . $filename_monat . "_" . $filename_name . ".csv";
			
			ob_start(); $array = $this->generate_statistikVerbundfirmen($filter); ob_clean();
			$string = $this->arrayToCSV($array);
		}
		
		// Dateiname und -inhalt erzeugen "Statistik Buchhaltung"
		if ($typ == "buchhaltung") {
			$monat_von = $filter[0][0];
			$monat_bis = $filter[0][1];
			
			$folder = strftime("%Y%m");
			$filename_basis = "statistik";
			$filename_monat_von = strftime("%Y-%m", strtotime($monat_von));
			$filename_monat_bis = strftime("%Y-%m", strtotime($monat_bis));
			$filename = $filename_basis . "_" . $filename_monat_von . "_" . $filename_monat_bis . ".csv";
			
			ob_start(); $array = $this->generate_statistikBuchhaltung($filter); ob_clean();
			$string = $this->arrayToCSV($array);
		}
		
		// CSV-File und (sofern nötig) Verzeichnis erzeugen
		$this->path = self::$basepath . $typ . "/" . $folder;
		$this->filename = $filename;
		$this->file = $this->path . "/" . $this->filename;
		
		if (!file_exists($this->path)) mkdir($this->path, 0711, true);
		file_put_contents($this->file, $string);
		
		// Wiederaufnahme charset 'utf8'
		_Database::set_charset('utf8');
	}
	
	function open()
	{
		if (file_exists($this->file)) {
		    header("Content-Description: File Transfer");
		    header("Content-Type: application/octet-stream");
		    header("Content-Disposition: attachment; filename='" . basename($this->file) . "'");
		    header("Expires: 0");
		    header("Cache-Control: must-revalidate");
		    header("Pragma: public");
		    header("Content-Length: " . filesize($this->file));
		    readfile($this->file);
		    exit;
		}
	}
	
	function arrayToCSV($array)
	{
		$string = "";
		
		foreach ($array as $line) {
			
			foreach ($line as $cell) {
				if ($cell == null) $string .= ";";
				else $string .= "\"" . $cell . "\"" . ";";
			}
			$string .= "\r\n";
		}
		
		return $string;
	}
	
	function generate_statistikVerbundfirmen($filter)
	{
		$lehrling = $filter[0];
		$monat = $filter[1];
		$praxisbildner = $filter[2];
		
		$titel = "Zeitkontrolle " . strftime("%B %Y", strtotime($monat));
		
		
		// Benötigte Informationen aus der DB herauslesen (-1- bis -8-)
		
		// -1- Informationen zum Lehrling
		$sql = "SELECT benutzer.vorname, benutzer.name, lehrling.berufsbildner 
				FROM  benutzer, lehrling
				WHERE benutzer.id = lehrling.id 
				AND lehrling.id = $lehrling;";
		$result = _Database::query($sql);
		
		$lehrling_vorname = $result[0]->vorname;
		$lehrling_name = $result[0]->name;
		$berufsbildner = $result[0]->berufsbildner;
		
		// -2- Name des Berufsbildners
		$sql = "SELECT vorname, name FROM benutzer WHERE id = $berufsbildner;";
		$result = _Database::query($sql);
		
		$berufsbildner_vorname = $result[0]->vorname;
		$berufsbildner_name = $result[0]->name;
		
		// -3- Informationen zum Praxisbildner
		$sql = "SELECT benutzer.vorname, benutzer.name, praxisbetrieb.praxisbetrieb 
				FROM  benutzer, praxisbildner, praxisbetrieb 
				WHERE benutzer.id = praxisbildner.id 
				AND praxisbildner.id = $praxisbildner 
				AND praxisbildner.praxisbetrieb = praxisbetrieb.id;";
		$result = _Database::query($sql);
		
		$praxisbildner_vorname = $result[0]->vorname;
		$praxisbildner_name = $result[0]->name;
		$praxisbetrieb = $result[0]->praxisbetrieb;
		
		// -4- Informationen zum Lehrjahr / zu den Lehrjahren
		$sql = "SELECT lehrjahr.lehrgang, lehrjahr.schuljahr 
				FROM lehrjahr, lehrling 
				WHERE lehrling.id = $lehrling 
				AND lehrjahr.lehrling = lehrling.id 
				AND '$monat' >= DATE(DATE_FORMAT(DATE_ADD(lehrling.lehrbeginn_ganzesjahr, INTERVAL (lehrjahr.vertragsjahr - 1) YEAR), '%Y-%m-01')) 
				AND '$monat' <= DATE(DATE_FORMAT(DATE_SUB(DATE_ADD(lehrling.lehrbeginn_ganzesjahr, INTERVAL lehrjahr.vertragsjahr YEAR), INTERVAL 1 DAY), '%Y-%m-01'))
				ORDER BY lehrjahr.vertragsjahr;";
		$result = _Database::query($sql);
		
		// Lehrgang
		for ($i=0; $i<count($result); $i++) {
			if ($i == 0) $lehrgang = $result[$i]->lehrgang;
			elseif ($result[$i]->lehrgang != $result[$i - 1]->lehrgang) $lehrgang .= " | " . $result[$i]->lehrgang;
		}
		// Schuljahr
		for ($i=0; $i<count($result); $i++) {
			if ($i == 0) $schuljahr = $result[$i]->schuljahr;
			elseif ($result[$i]->schuljahr != $result[$i - 1]->schuljahr) $schuljahr .= " | " . $result[$i]->schuljahr;
		}
		
		// -5- Praxiseinsatz von / bis
		// Praxiseinsätze suchen, die diesen Monat 'berühren'
		$sql = "SELECT DISTINCT startdatum, enddatum FROM praxiseinsatz 
				WHERE lehrling = $lehrling 
				AND praxisbildner = $praxisbildner 
				AND DATE(DATE_FORMAT(startdatum ,'%Y-%m-01')) <= '$monat' 
				AND DATE(DATE_FORMAT(enddatum ,'%Y-%m-01')) >= '$monat' 
				ORDER BY startdatum;";
		$result = _Database::query($sql);
		
		$praxiseinsatz_von = $result[0]->startdatum;
		$praxiseinsatz_bis = $result[0]->enddatum;
		// Bei mehreren Praxiseinsätzen : 'von' des ersten / 'bis' des letzten
		if (_Database::$result_num_rows > 1) $praxiseinsatz_bis = $result[count($result) - 1]->enddatum;
		
		$praxiseinsatz = strftime("%d.%m.%Y", strtotime($praxiseinsatz_von)) . " - " . strftime("%d.%m.%Y", strtotime($praxiseinsatz_bis));
		
		// -6- Informationen zum Rapport
		$rapport = new Rapport($lehrling, $monat, $praxisbildner);
		
		$rechnungsnr = $rapport->get_property("rechnungsnr");
		if ($rapport->get_property("rechnungsdatum") == null) $rechnungsdatum = "";
		else $rechnungsdatum = strftime("%d.%m.%Y", strtotime($rapport->get_property("rechnungsdatum")));
		
		// -7- Tage definieren
		$zugehoerigetage = $rapport->get_zugehoerigeTage();
		
		// -8- Tage auslesen / Summen bilden
		
		// Tage-Array vorbereiten
		$tage = array();
		$daysinmonth = date("t", strtotime($monat));
		
		for ($i=1; $i<=31; $i++) {
			$datum = strftime("%Y-%m-", strtotime($monat)) . $i;
			if ($i <= $daysinmonth) $tage[$i] = array(strftime("%d.%m.%Y", strtotime($datum)), null, null, null);
			else $tage[$i] = array(null, null, null, null);
		}
		
		// Summen-Array vorbereiten
		$summen = array();
		
		foreach (_Taetigkeit::get_taetigkeiten() as $taetigkeit) { $summen[$taetigkeit[0]] = 0; }
		foreach (_Absenz::get_absenzen() as $absenz) { $summen[$absenz[0]] = 0; }
		
		// Zugehörige Tage durchlaufen
		foreach ($zugehoerigetage as $tag) {
			$kommentar = null;
			
			// Vormittag definieren
			$sql = "SELECT * FROM halbtag WHERE lehrling = $lehrling AND tag = '$tag' AND halbtag = 'vormittag';";
			$vormittag = _Database::query($sql)[0];
			
			if ($vormittag->absenz != "KAB") {
				$summen[$vormittag->absenz] += 0.5;
				$vormittag_wert = _Absenz::get_absenzen($vormittag->absenz);
				
				if ($vormittag->absenz_kommentar != null) $kommentar = $vormittag->absenz_kommentar;
			}
			else {
				$summen[$vormittag->taetigkeit] += 0.5;
				$vormittag_wert = _Taetigkeit::get_taetigkeiten($vormittag->taetigkeit);
				
				if ($vormittag->taetigkeit_kommentar != null) $kommentar = $vormittag->taetigkeit_kommentar;
			}
		
			// Nachmittag definieren
			$sql = "SELECT * FROM halbtag WHERE lehrling = $lehrling AND tag = '$tag' AND halbtag = 'nachmittag';";
			$nachmittag = _Database::query($sql)[0];
			
			if ($nachmittag->absenz != "KAB") {
				$summen[$nachmittag->absenz] += 0.5;
				$nachmittag_wert = _Absenz::get_absenzen($nachmittag->absenz);
				
				if ($nachmittag->absenz_kommentar != null) {
					if ($kommentar == null) $kommentar = "- | " . $nachmittag->absenz_kommentar;
					else $kommentar .= " | " . $nachmittag->absenz_kommentar;
				}
			}
			else {
				$summen[$nachmittag->taetigkeit] += 0.5;
				$nachmittag_wert = _Taetigkeit::get_taetigkeiten($nachmittag->taetigkeit);
				
				if ($nachmittag->taetigkeit_kommentar != null) {
					if ($kommentar == null) $kommentar = "- | " . $nachmittag->taetigkeit_kommentar;
					else $kommentar .= " | " . $nachmittag->taetigkeit_kommentar;
				}
			}
			
			// Tage in $tage aufnehmen (beim Index der Tageszahl)
			$tage[intval(strftime("%d", strtotime($tag)))] = array(strftime("%d.%m.%Y", strtotime($tag)), $vormittag_wert, $nachmittag_wert, $kommentar);
			
		}
		
		$gesamtsumme = 0;
		foreach ($summen as $summe) { $gesamtsumme += $summe; }
		
		
		// Array für CSV-File erzeugen
		$array = array();
		
		/* 01 */ $array[] = array($titel);
		/* 02 */ $array[] = array(null);
		/* 03 */ $array[] = array("Lernende/r", null, null, null, null, "Vormittag", "Nachmittag", "Kommentar");
		/* 04 */ $array[] = array("Name, Vorname", $lehrling_name . ", " . $lehrling_vorname, null, $tage[1][0], null, $tage[1][1], $tage[1][2], $tage[1][3]);
		/* 05 */ $array[] = array("Lehrgang", $lehrgang, null, $tage[2][0], null, $tage[2][1], $tage[2][2], $tage[2][3]);
		/* 06 */ $array[] = array("Schuljahr", $schuljahr, null, $tage[3][0], null, $tage[3][1], $tage[3][2], $tage[3][3]);
		/* 07 */ $array[] = array("Berufsbildner", $berufsbildner_vorname . " " . $berufsbildner_name, null, $tage[4][0], null, $tage[4][1], $tage[4][2], $tage[4][3]);
		/* 08 */ $array[] = array(null, null, null, $tage[5][0], null, $tage[5][1], $tage[5][2], $tage[5][3]);
		/* 09 */ $array[] = array("Praxiseinsatz", null, null, $tage[6][0], null, $tage[6][1], $tage[6][2], $tage[6][3]);
		/* 10 */ $array[] = array("Praxisbetrieb", $praxisbetrieb, null, $tage[7][0], null, $tage[7][1], $tage[7][2], $tage[7][3]);
		/* 11 */ $array[] = array("Praxisbildner", $praxisbildner_vorname . " " . $praxisbildner_name, null, $tage[8][0], null, $tage[8][1], $tage[8][2], $tage[8][3]);
		/* 12 */ $array[] = array("Praxiseinsatz", $praxiseinsatz, null, $tage[9][0], null, $tage[9][1], $tage[9][2], $tage[9][3]);
		/* 13 */ $array[] = array("Rechnungsnummer", $rechnungsnr, null, $tage[10][0], null, $tage[10][1], $tage[10][2], $tage[10][3]);
		/* 14 */ $array[] = array("Rechnungsdatum", $rechnungsdatum, null, $tage[11][0], null, $tage[11][1], $tage[11][2], $tage[11][3]);
		/* 15 */ $array[] = array(null, null, null, $tage[12][0], null, $tage[12][1], $tage[12][2], $tage[12][3]);
		/* 16 */ $array[] = array("Summe Tätigkeiten", null, null, $tage[13][0], null, $tage[13][1], $tage[13][2], $tage[13][3]);
		/* 17 */ $array[] = array("Praxis", $summen['PRA'], null, $tage[14][0], null, $tage[14][1], $tage[14][2], $tage[14][3]);
		/* 18 */ $array[] = array("Schule", $summen['SCH'], null, $tage[15][0], null, $tage[15][1], $tage[15][2], $tage[15][3]);
		/* 19 */ $array[] = array("ÜK", $summen['UEK'], null, $tage[16][0], null, $tage[16][1], $tage[16][2], $tage[16][3]);
		/* 20 */ $array[] = array("Seminar", $summen['SEM'], null, $tage[17][0], null, $tage[17][1], $tage[17][2], $tage[17][3]);
		/* 21 */ $array[] = array("Stützkurs", $summen['STU'], null, $tage[18][0], null, $tage[18][1], $tage[18][2], $tage[18][3]);
		/* 22 */ $array[] = array("Prozesseinheit", $summen['PEI'], null, $tage[19][0], null, $tage[19][1], $tage[19][2], $tage[19][3]);
		/* 23 */ $array[] = array("Kein Arbeitstag", $summen['KAR'], null, $tage[20][0], null, $tage[20][1], $tage[20][2], $tage[20][3]);
		/* 24 */ $array[] = array("Ferien", $summen['FER'], null, $tage[21][0], null, $tage[21][1], $tage[21][2], $tage[21][3]);
		/* 25 */ $array[] = array("Krank", $summen['KRA'], null, $tage[22][0], null, $tage[22][1], $tage[22][2], $tage[22][3]);
		/* 26 */ $array[] = array("Unfall", $summen['UNF'], null, $tage[23][0], null, $tage[23][1], $tage[23][2], $tage[23][3]);
		/* 27 */ $array[] = array("Sonderurlaub bezahlt", $summen['SOB'], null, $tage[24][0], null, $tage[24][1], $tage[24][2], $tage[24][3]);
		/* 28 */ $array[] = array("Sonderurlaub unbezahlt", $summen['SOU'], null, $tage[25][0], null, $tage[25][1], $tage[25][2], $tage[25][3]);
		/* 29 */ $array[] = array("Jugendurlaub", $summen['JUG'], null, $tage[26][0], null, $tage[26][1], $tage[26][2], $tage[26][3]);
		/* 30 */ $array[] = array("Militär", $summen['MIL'], null, $tage[27][0], null, $tage[27][1], $tage[27][2], $tage[27][3]);
		/* 31 */ $array[] = array("Sportkontingent", $summen['SPO'], null, $tage[28][0], null, $tage[28][1], $tage[28][2], $tage[28][3]);
		/* 32 */ $array[] = array(null, null, null, $tage[29][0], null, $tage[29][1], $tage[29][2], $tage[29][3]);
		/* 33 */ $array[] = array("Total", $gesamtsumme, null, $tage[30][0], null, $tage[30][1], $tage[30][2], $tage[30][3]);
		/* 34 */ $array[] = array(null, null, null, $tage[31][0], null, $tage[31][1], $tage[31][2], $tage[31][3]);
		
		return $array;
		
	}
	
	function generate_statistikBuchhaltung($filter)
	{
		$monat_von = $filter[0][0];
		$monat_bis = $filter[0][1];
		$lehrjahre_filter = $filter[1];
		$kostenstellen_filter = $filter[2];
		$lehrgaenge_filter = $filter[3];
		
		// Gewünschte Monate berechnen
		$monate = array();
		$monat_von_while = $monat_von;
		while (strtotime($monat_von_while) <= strtotime($monat_bis)) {
			$monate[] = $monat_von_while;
			$monat_von_while = strftime("%Y-%m-%d", strtotime("$monat_von_while +1 month"));
		}
		
		// Kostenstellen in Lehrgänge umwandeln
		if ($kostenstellen_filter != null) {
			
			$lehrgaenge_aus_kostenstellen = array();
			
			foreach (_Lehrgang::get_lehrgaenge() as $lehrgang) {
				if (in_array($lehrgang[5], $kostenstellen_filter)) $lehrgaenge_aus_kostenstellen[] = $lehrgang[0];
			}
			
			$kostenstellen_filter = $lehrgaenge_aus_kostenstellen;
		}
		
		
		
		// Filterung / Lehrlinge definieren
		
		$lehrlinge = array();
		
		foreach ($monate as $monat) {
			
			// Aktive Lehrlinge holen
			$aktivelehrlinge = _Lehrling::get_aktiveLehrlingeImMonat($monat);
			
			// Filterung vornehmen
			foreach ($aktivelehrlinge as $lehrling) {
				
				// Schuljahre / Lehrgänge berechnen
				$sql = "SELECT lehrjahr.lehrgang, lehrjahr.schuljahr 
						FROM lehrjahr, lehrling 
						WHERE lehrling.id = $lehrling 
						AND lehrjahr.lehrling = lehrling.id 
						AND '$monat' >= DATE(DATE_FORMAT(DATE_ADD(lehrling.lehrbeginn_ganzesjahr, INTERVAL (lehrjahr.vertragsjahr - 1) YEAR), '%Y-%m-01')) 
						AND '$monat' <= DATE(DATE_FORMAT(DATE_SUB(DATE_ADD(lehrling.lehrbeginn_ganzesjahr, INTERVAL lehrjahr.vertragsjahr YEAR), INTERVAL 1 DAY), '%Y-%m-01'))
						ORDER BY lehrjahr.vertragsjahr;";
				$result = _Database::query($sql);
				
				// Schuljahre
				$schuljahre = array();
				for ($i=0; $i<count($result); $i++) {
					if ($i == 0) $schuljahre[] = $result[$i]->schuljahr;
					elseif ($result[$i]->schuljahr != $result[$i - 1]->schuljahr) $schuljahre[] = $result[$i]->schuljahr;
				}
				// Lehrgänge
				$lehrgaenge = array();
				for ($i=0; $i<count($result); $i++) {
					if ($i == 0) $lehrgaenge[] = $result[$i]->lehrgang;
					elseif ($result[$i]->lehrgang != $result[$i - 1]->lehrgang) $lehrgaenge[] = $result[$i]->lehrgang;
				}
				
				// Filter prüfen - Lehrjahre
				$lehrjahre_filter_ok = false;
				
				foreach ($schuljahre as $schuljahr) {
					if (in_array($schuljahr, $lehrjahre_filter)) { $lehrjahre_filter_ok = true; break; }
				}
				
				if ($kostenstellen_filter == null && $lehrgaenge_filter == null) {
					if ($lehrjahre_filter_ok && !in_array($lehrling, $lehrlinge)) $lehrlinge[] = $lehrling;
				}
				
				// Filter prüfen - Kostenstellen
				if ($kostenstellen_filter != null) {
					
					$kostenstellen_filter_ok = false;
					
					foreach ($lehrgaenge as $lehrgang) {
						if (in_array($lehrgang, $kostenstellen_filter)) { $kostenstellen_filter_ok = true; break; }
					}
					
					if ($lehrjahre_filter_ok && $kostenstellen_filter_ok && !in_array($lehrling, $lehrlinge)) $lehrlinge[] = $lehrling;
				}
				
				// Filter prüfen - Lehrgänge
				if ($lehrgaenge_filter != null) {
					
					$lehrgaenge_filter_ok = false;
					
					foreach ($lehrgaenge as $lehrgang) {
						if (in_array($lehrgang, $lehrgaenge_filter)) { $lehrgaenge_filter_ok = true; break; }
					}
					
					if ($lehrjahre_filter_ok && $lehrgaenge_filter_ok && !in_array($lehrling, $lehrlinge)) $lehrlinge[] = $lehrling;
				}
			}
		}
		
		// Lehrlinge alphabetisch sortieren
		$unsortiertelehrlinge = $lehrlinge;
		$lehrlinge = array();
		
		foreach (_Lehrling::get_lehrlinge() as $lehrling) {
			if (in_array($lehrling[0], $unsortiertelehrlinge)) $lehrlinge[] = $lehrling[0];
		}
		
		
		
		// Daten berechnen und strukturieren
		
		$daten = array();
		
		foreach ($lehrlinge as $lehrling) {
			
			// Informationen holen
			$sql = "SELECT benutzer.vorname, benutzer.name, lehrling.nr, lehrling.lehrbeginn, lehrling.lehrende 
					FROM  benutzer, lehrling
					WHERE benutzer.id = lehrling.id 
					AND lehrling.id = $lehrling;";
			$result = _Database::query($sql);
			
			$vorname = $result[0]->vorname;
			$name = $result[0]->name;
			$nr = $result[0]->nr;
			$lehrbeginn = $result[0]->lehrbeginn;
			$lehrende = $result[0]->lehrende;
			
			// Zeitraum definieren und auf Lehrzeit beschränken
			$tag_von = $monat_von;
			if (strtotime($tag_von) < strtotime($lehrbeginn)) $tag_von = $lehrbeginn;
			$tag_bis = strftime("%Y-%m-" . date("t", strtotime($monat_bis)), strtotime($monat_bis));
			if (strtotime($tag_bis) > strtotime($lehrende)) $tag_bis = $lehrende;
			
			// Schuljahre innerhalb Zeitraum berechnen
			$schuljahre = array();
			
			$sql = "SELECT lehrjahr.schuljahr 
					FROM lehrjahr, lehrling 
					WHERE lehrling.id = $lehrling 
					AND lehrjahr.lehrling = lehrling.id 
					AND (
						'$monat_von' >= DATE(DATE_FORMAT(DATE_ADD(lehrling.lehrbeginn_ganzesjahr, INTERVAL (lehrjahr.vertragsjahr - 1) YEAR), '%Y-%m-01')) 
						AND '$monat_von' <= DATE(DATE_FORMAT(DATE_SUB(DATE_ADD(lehrling.lehrbeginn_ganzesjahr, INTERVAL lehrjahr.vertragsjahr YEAR), INTERVAL 1 DAY), '%Y-%m-01'))
					OR 
						'$monat_von' <= DATE(DATE_FORMAT(DATE_ADD(lehrling.lehrbeginn_ganzesjahr, INTERVAL (lehrjahr.vertragsjahr - 1) YEAR), '%Y-%m-01')) 
						AND '$monat_bis' >= DATE(DATE_FORMAT(DATE_SUB(DATE_ADD(lehrling.lehrbeginn_ganzesjahr, INTERVAL lehrjahr.vertragsjahr YEAR), INTERVAL 1 DAY), '%Y-%m-01'))
					OR 
						'$monat_bis' >= DATE(DATE_FORMAT(DATE_ADD(lehrling.lehrbeginn_ganzesjahr, INTERVAL (lehrjahr.vertragsjahr - 1) YEAR), '%Y-%m-01')) 
						AND '$monat_bis' <= DATE(DATE_FORMAT(DATE_SUB(DATE_ADD(lehrling.lehrbeginn_ganzesjahr, INTERVAL lehrjahr.vertragsjahr YEAR), INTERVAL 1 DAY), '%Y-%m-01'))
					)
					ORDER BY lehrjahr.vertragsjahr;";
			$result = _Database::query($sql);
			
			for ($i=0; $i<count($result); $i++) {
				if ($i == 0) $schuljahre[] = $result[$i]->schuljahr;
				elseif ($result[$i]->schuljahr != $result[$i - 1]->schuljahr) $schuljahre[] = $result[$i]->schuljahr;
			}
			
			foreach ($schuljahre as $schuljahr) {
				
				// Vertragsjahr/e des Schuljahres definieren
				$sql = "SELECT vertragsjahr FROM lehrjahr
						WHERE lehrling = $lehrling
						AND schuljahr = $schuljahr;";
				$result = _Database::query($sql);
				
				// Für jedes Vertragsjahr (Excel-Zeile) die Info 
				foreach ($result as $vertragsjahr) {
					
					$lehrjahr = new Lehrjahr($lehrling, $vertragsjahr->vertragsjahr);
					$lehrgang = $lehrjahr->get_property("lehrgang");
					$kostenstelle = _Lehrgang::get_lehrgaenge($lehrgang)[5];
					$beginn = $lehrjahr->get_property("beginn");
					$ende = $lehrjahr->get_property("ende");
					
					// Errechnung der eigentlichen Daten 
					
					// Arrays für Ergebnisse vorbereiten
					$summen = array();
					foreach (_Taetigkeit::get_taetigkeiten() as $taetigkeit) { $summen[$taetigkeit[0]] = 0; }
					foreach (_Absenz::get_absenzen() as $absenz) { $summen[$absenz[0]] = 0; }
					
					$summenKrankUnfall = array();
					foreach (_Taetigkeit::get_taetigkeiten() as $taetigkeit) { $summenKrankUnfall["KRA_" . $taetigkeit[0]] = 0; }
					foreach (_Taetigkeit::get_taetigkeiten() as $taetigkeit) { $summenKrankUnfall["UNF_" . $taetigkeit[0]] = 0; }
					
					// Zeitraum auf Vertragsjahr beschränken
					$tag_von_vertragsjahr = $tag_von;
					if (strtotime($tag_von_vertragsjahr) < strtotime($beginn)) $tag_von_vertragsjahr = $beginn;
					$tag_bis_vertragsjahr = $tag_bis;
					if (strtotime($tag_bis_vertragsjahr) > strtotime($ende)) $tag_bis_vertragsjahr = $ende;
					
					// SQL Statement
					$sql = "SELECT tag, halbtag, taetigkeit, absenz FROM halbtag
							WHERE lehrling = $lehrling
							AND tag >= '$tag_von_vertragsjahr'
							AND tag <= '$tag_bis_vertragsjahr';";
					$result = _Database::query($sql);
					
					// Halbtage aufaddieren
					foreach ($result as $result) {
						if ($result->absenz == "KAB") $summen[$result->taetigkeit] += 0.5;
						else $summen[$result->absenz] += 0.5;
						
						if ($result->absenz == "KRA") $summenKrankUnfall["KRA_" . $result->taetigkeit] += 0.5;
						if ($result->absenz == "UNF") $summenKrankUnfall["UNF_" . $result->taetigkeit] += 0.5;
					}
					
					$summenTotal = 0;
					foreach ($summen as $summe) { $summenTotal += $summe; }
					
					$summenKrankUnfallTotal = 0;
					foreach ($summenKrankUnfall as $summeKrankUnfall) { $summenKrankUnfallTotal += $summeKrankUnfall; }
					
					// Daten für die Erstellung des CSV-Arrays vorbereiten
					$daten[] = array($nr, $name . " " . $vorname, $lehrgang, $kostenstelle, $schuljahr, 
									$summen['PRA'], $summen['SCH'], $summen['UEK'], $summen['SEM'], $summen['STU'], $summen['PEI'], $summen['KAR'],
									$summen['FER'], $summen['KRA'], $summen['UNF'], $summen['SOB'], $summen['SOU'], $summen['JUG'], $summen['MIL'], $summen['SPO'],
									$summenTotal, null,
									$summenKrankUnfall["KRA_PRA"], $summenKrankUnfall["KRA_SCH"], $summenKrankUnfall["KRA_UEK"], 
									$summenKrankUnfall["KRA_SEM"] + $summenKrankUnfall["KRA_STU"] + $summenKrankUnfall["KRA_PEI"],
									$summenKrankUnfall["UNF_PRA"], $summenKrankUnfall["UNF_SCH"], $summenKrankUnfall["UNF_UEK"], 
									$summenKrankUnfall["UNF_SEM"] + $summenKrankUnfall["UNF_STU"] + $summenKrankUnfall["UNF_PEI"],
									$summenKrankUnfallTotal);
				}
			}
		}
		
		
		
		// Array für CSV-File erzeugen
		$array = array();
		
		$array[] = array("Nr", "Name Vorname", "Lehrgang", "Kostenstelle", "Lehrjahr", 
						"Praxis", "Schule", "ÜK", "Seminar", "Stützkurs", "Prozesseinheit", "Kein Arbeitstag",
						"Ferien", "Krank", "Unfall", "Sonderurlaub bezahlt", "Sonderurlaub unbezahlt", "Jugendurlaub", "Militär", "Sportkontingent",
						"Total", null, 
						"Krank Praxis", "Krank Schule", "Krank ÜK", "Krank diverse", "Unfall Praxis", "Unfall Schule", "Unfall ÜK", "Unfall diverse",
						"Total Krank und Unfall");
		
		foreach ($daten as $daten) { $array[] = $daten; }
		
		
		return $array;
		
	}
	
}

?>
