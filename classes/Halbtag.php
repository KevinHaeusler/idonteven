<?php

class Halbtag
{
	private $id;
	private $lehrling;
	private $tag;
	private $halbtag;
	private $praxisbildner;
	private $taetigkeit;
	private $taetigkeit_kommentar;
	private $absenz;
	private $absenz_kommentar;
	
	private $absenz_anfrage;
	private $absenz_kommentar_anfrage;
	private $absenz_anfrage_offen;
	
	private $monat;
	private $tag_zahl;
	private $monat_zahl;
	private $jahr_zahl;
	
	/**
	 * Erstellt ein Halbtages-Objekt, inkludiert Benutzereingaben
	 * 
	 * - Halbtag suchen, und einlesen falls vorhanden
	 * - Falls nicht vorhanden: Standardwerte inkl. Standard-Praxisbildner einlesen
	 * 
	 * @param int $lehrling - id: 1111
	 * @param string $tag - Datum: 2016-09-11
	 * @param string $halbtag - vormittag / nachmittag
	 * 
	 */
	function __construct(int $lehrling, string $tag, string $halbtag)
	{
		$this->lehrling = $lehrling;
		$this->tag = $tag;
		$this->halbtag = $halbtag;
		
		$this->tag_zahl = date("j", strtotime($this->tag));
		$this->monat_zahl = date("n", strtotime($this->tag));
		$this->jahr_zahl = date("Y", strtotime($this->tag));
		
		// Ersten des Monats berechnen
		$this->monat = strftime("%Y-%m-01", strtotime($this->tag));
		
		// Halbtag in DB suchen
		$sql = "SELECT * FROM halbtag WHERE lehrling = ? AND tag = ? AND halbtag = ?;";
		$vars = array();
		$vars[] = array("i", $this->lehrling);
		$vars[] = array("s", $this->tag);
		$vars[] = array("s", $this->halbtag);
		$result = _Database::query($sql, $vars);		
		
		// Datensatz bereits vorhanden: Properties einlesen
		if (_Database::$result_num_rows) {
			$this->id = $result[0]->id;
			$this->taetigkeit = $result[0]->taetigkeit;
			$this->taetigkeit_kommentar = $result[0]->taetigkeit_kommentar;
			$this->absenz = $result[0]->absenz;
			$this->absenz_kommentar = $result[0]->absenz_kommentar;
			
			// Absenz-Anfrage, falls vorhanden, einlesen
			$sql = "SELECT anfrage, anfrage_kommentar, signiert_berufsbildner FROM absenz_anfrage WHERE id = $this->id;";
			$result = _Database::query($sql);
			
			if (_Database::$result_num_rows) {
				$this->absenz_anfrage = $result[0]->anfrage;
				$this->absenz_kommentar_anfrage = $result[0]->anfrage_kommentar;
				if ($result[0]->signiert_berufsbildner == "offen") $this->absenz_anfrage_offen = true;
			}
			else {
				$this->absenz_anfrage_offen = false;
			}
		}
		
		// Datensatz nicht vorhanden: Standardwerte einlesen
		else {
			$this->id = null;			
			$this->taetigkeit = $this->rechneStandardTaetigkeit();
			$this->taetigkeit_kommentar = null;
			$this->absenz = "KAB";
			$this->absenz_kommentar = null;
			$this->absenz_anfrage_offen = false;
		}
		
		// Praxisbildner suchen
		$this->praxisbildner = _Praxiseinsatz::get_praxisbildnerAmTag($this->lehrling, $this->tag);
		
	}
	
	function speichern()
	{
		// Exceptions werfen
		if (isset($_POST['halbtag_halbtag'])) {
			if (in_array($this->tag_zahl . "_" . substr($this->halbtag, 0, 1), $_POST['halbtag_halbtag'])) {
					
				// Verhindern, dass bereits signierte Halbtage verändert werden können
				if ($_POST['button'][0] == "taetigkeitSpeichern" || $_POST['button'][0] == "absenzSpeichern" || $_POST['button'][0] == "kommentarSpeichern") {
					
					$rapport = new Rapport($this->lehrling, $this->monat, $this->praxisbildner);
					
					if ($_SESSION['rolle'] != "verwaltung" && $rapport->get_property("signiert_lehrling") == "ja") {
						throw new Exception('Am ' . $this->tag_zahl . '. kann nichts eingetragen werden. Ist bereits signiert.');
					}
				}
				
				// Fall : Tätigkeit einlesen
				if($_POST['button'][0] == "taetigkeitSpeichern") {
					// Sicherstellen, dass keine Absenz vorhanden ist
					if ($this->absenz != "KAB") {
						throw new Exception('Am ' . $this->tag_zahl . '. kann die T&auml;tigkeit nicht ver&auml;ndert werden. Die Absenz muss zuerst gel&ouml;scht werden.');
					}
					// Sicherstellen, dass keine Absenzanfrage vorhanden ist
					if (isset($this->absenz_anfrage)) {
						throw new Exception('Am ' . $this->tag_zahl . '. kann die T&auml;tigkeit nicht ver&auml;ndert werden. Es gibt eine offene Absenzanfrage.');
					}
					$this->taetigkeit = $_POST['button'][1];
					$this->taetigkeit_kommentar = $_POST['halbtag_kommentar'];
				}
				
				// Fall : Absenz einlesen
				if ($_POST['button'][0] == "absenzSpeichern") {
	
					// Sicherstellen, dass Tätigkeit ungleich "Kein Arbeitstag" vorhanden ist
					if ($this->taetigkeit == null || $this->taetigkeit == "KAR") {
						throw new Exception('Am ' . $this->tag_zahl . '. kann keine Absenz eingetragen werden. Absenzen brauchen eine T&auml;tigkeit.');
					}
				}
				
				// Fall : Kommentar speichern
				if ($_POST['button'][0] == "kommentarSpeichern") {
						
					// Sicherstellen, dass Tätigkeit vorhanden ist
					if ($this->taetigkeit == null) {
						throw new Exception('Am ' . $this->tag_zahl . '. kann kein Kommentar eingetragen werden. Keine T&auml;tigkeit vorhanden.');
					}
						
					// keine Absenz vorhanden -> Tätigkeitskommentar
					if ($this->absenz == "KAB" && !isset($this->absenz_anfrage)) {
						$this->taetigkeit_kommentar = $_POST['halbtag_kommentar'];
					}
				}
					
				// Fall : Kommentar löschen
				if ($_POST['button'][0] == "kommentarLoeschen") {
						
					// keine Absenz vorhanden -> Tätigkeitskommentar
					if ($this->absenz == "KAB" && !isset($this->absenz_anfrage)) {
						$this->taetigkeit_kommentar = null;
					}
				}
			}
		}
		// Fall : Kein Halbtag ausgewählt
		else {
			throw new Exception("Es wurde kein Halbtag ausgew&auml;hlt.");
		}
		
		// Speichern
		
		$sql = "SELECT id FROM halbtag WHERE lehrling = ? AND tag = ? AND halbtag = ?;";
		$vars = array();
		$vars[] = array("i", $this->lehrling);
		$vars[] = array("s", $this->tag);
		$vars[] = array("s", $this->halbtag);
		_Database::query($sql, $vars);
		
		// insert
		if (_Database::$result_num_rows == 0) {
			$sql = "INSERT INTO halbtag (lehrling, tag, halbtag, taetigkeit, taetigkeit_kommentar) 
			VALUES ($this->lehrling, '$this->tag', '$this->halbtag', ?, ?);";
			$vars = array();
			$vars[] = array("s", $this->taetigkeit);
			$vars[] = array("s", $this->taetigkeit_kommentar);
			_Database::query($sql, $vars);
		}
		
		// update
		else {
			$sql = "UPDATE halbtag SET taetigkeit = ?, taetigkeit_kommentar = ? WHERE id = $this->id;";
			$vars = array();
			$vars[] = array("s", $this->taetigkeit);
			$vars[] = array("s", $this->taetigkeit_kommentar);
			_Database::query($sql, $vars);
			
			// Absenz speichern / updaten
			$absenz = new Absenz($this->id);
			$absenz->anfragen();
		}
	}
	
	function rechneStandardTaetigkeit()
	{
		$time = strtotime($this->tag);
		$wochentag = date("N", $time);
		switch ($wochentag)
		{
			case 1: $taetigkeit = null; break;
			case 2: $taetigkeit = null; break;
			case 3: $taetigkeit = null; break;
			case 4: $taetigkeit = null; break;
			case 5: $taetigkeit = null; break;
			case 6: $taetigkeit = "KAR"; break;
			case 7: $taetigkeit = "KAR"; break;
		}
		return $taetigkeit;
	}
	
	static function get_nachfolger($tag, $halbtag)
	{
		if ($halbtag == "vormittag") {
			return array('tag' => $tag, 'halbtag' => "nachmittag");
		}
		else if ($halbtag == "nachmittag") {
			return array('tag' => strftime("%Y-%m-%d", strtotime("$tag +1 day")), 'halbtag' => "vormittag");
		}
	}
	
	function get_property($property)
	{
		return $this->{$property};
	}
	
}
	
?>