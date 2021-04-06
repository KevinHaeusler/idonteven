<?php

class Absenz
{
	private $id;
	private $absenz;
	private $absenz_kommentar;
	private $anfrage;
	private $anfrage_kommentar;
	private $signiert_praxisbildner;
	private $signiert_praxisbildner_datum;
	private $signiert_praxisbildner_nachricht;
	private $signiert_berufsbildner;
	private $signiert_berufsbildner_datum;
	private $signiert_berufsbildner_nachricht;
	
	private $lehrling;
	private $tag;
	private $halbtag;
	
	private $tag_zahl;
	private $monat_zahl;
	private $jahr_zahl;
	private $monat;
	
	
	function __construct($id)
	{
		$this->id = $id;
		
		// Lehrling, Datum und Absenz einlesen
		
		$sql = "SELECT lehrling, tag, halbtag, absenz, absenz_kommentar FROM halbtag WHERE id = ?;";
		$vars = array();
		$vars[] = array("i", $this->id);
		$result = _Database::query($sql, $vars);
		
		$this->lehrling = $result[0]->lehrling;
		$this->tag = $result[0]->tag;
		$this->halbtag = $result[0]->halbtag;
		
		$this->tag_zahl = date("j", strtotime($this->tag));
		$this->monat_zahl = date("n", strtotime($this->tag));
		$this->jahr_zahl = date("Y", strtotime($this->tag));
		$this->monat = $this->jahr_zahl . "-" . $this->monat_zahl . "-01";

		$this->absenz = $result[0]->absenz;
		$this->absenz_kommentar = $result[0]->absenz_kommentar;
		
		// Anfrage suchen und allenfalls einlesen
		
		$sql = "SELECT * FROM absenz_anfrage WHERE id = ?;";
		$vars = array();
		$vars[] = array("i", $this->id);
		$result = _Database::query($sql, $vars);
		
		if (_Database::$result_num_rows) {
			$this->anfrage = $result[0]->anfrage;
			$this->anfrage_kommentar = $result[0]->anfrage_kommentar;
			$this->signiert_praxisbildner = $result[0]->signiert_praxisbildner;
			$this->signiert_praxisbildner_datum = $result[0]->signiert_praxisbildner_datum;
			$this->signiert_praxisbildner_nachricht = $result[0]->signiert_praxisbildner_nachricht;
			$this->signiert_berufsbildner = $result[0]->signiert_berufsbildner;
			$this->signiert_berufsbildner_datum = $result[0]->signiert_berufsbildner_datum;
			$this->signiert_berufsbildner_nachricht = $result[0]->signiert_berufsbildner_nachricht;
		}
		
	}

	function anfragen()
	{
		// Halbtag gefragt?
		if (isset($_POST['halbtag_halbtag'])) {
			if (in_array($this->tag_zahl . "_" . substr($this->halbtag, 0, 1), $_POST['halbtag_halbtag'])) {
				
				// Fall : Anfrage speichern
				if ($_POST['button'][0] == "absenzSpeichern") {
					
					$anfrage = $_POST['button'][1];
					$datum = strftime("%Y-%m-%d %H:%M:%S", time());
					
					// Kommentar setzen
					$kommentar = null;
					if (isset($_POST['halbtag_kommentar'])) { $kommentar = $_POST['halbtag_kommentar']; }
					
					// Falls noch keine Anfrage -> insert
					if (!isset($this->anfrage)) {
						
						// Nur falls anders als Absenz
						if ($anfrage != $this->absenz) {
							$sql = "INSERT INTO absenz_anfrage (id, anfrage, anfrage_kommentar, anfrage_datum) VALUES ($this->id, ?, ?, '$datum');";
							$vars = array();
							$vars[] = array("s", $anfrage);
							$vars[] = array("s", $kommentar);
							_Database::query($sql, $vars);
						}
					}
					
					// Falls bereits Anfrage -> update
					else {
						
						// falls noch nicht signiert -> löschen möglich
						if ($anfrage == "KAB" && $this->signiert_praxisbildner != "ja" && $this->signiert_berufsbildner != "ja" && $this->absenz == "KAB") {
							$sql = "DELETE FROM absenz_anfrage WHERE id = $this->id;";
							_Database::query($sql);
						}
						
						// anfrage überschreiben mit neuer anfrage
						else {
							$sql = "UPDATE absenz_anfrage SET anfrage = ?, anfrage_kommentar = ?, anfrage_datum = '$datum', 
									signiert_praxisbildner = 'offen', signiert_berufsbildner = 'offen', 
									signiert_praxisbildner_nachricht = NULL, signiert_berufsbildner_nachricht = NULL 
									WHERE id = $this->id;";
							$vars = array();
							$vars[] = array("s", $anfrage);
							$vars[] = array("s", $kommentar);
							_Database::query($sql, $vars);
						}
					}
				}
				
				// Fall : Kommentar speichern / löschen
				if ($_POST['button'][0] == "kommentarSpeichern" || $_POST['button'][0] == "kommentarLoeschen") {
					
					// Nur falls Absenz vorhanden
					if ($this->absenz != "KAB" || isset($this->anfrage)) {
						
						// Kommentar setzen
						$kommentar = null;
						if ($_POST['button'][0] == "kommentarSpeichern") { $kommentar = $_POST['halbtag_kommentar']; }
						
						$sql = "UPDATE absenz_anfrage SET anfrage_kommentar = ? WHERE id = $this->id;";
						$vars = array();
						$vars[] = array("s", $kommentar);
						_Database::query($sql, $vars);
					}
				}
			}
		}
		
	}
	
	static function bearbeiten()
	{
		$ersteabsenz = $_POST['button'][1];
		$letzteabsenz = $_POST['button'][2];
		
		// Array mit betreffenden halbtages-ids erstellen
		$sql = "SELECT * FROM halbtag 
				WHERE lehrling = (SELECT lehrling FROM halbtag WHERE id = ?)
				AND tag >= (SELECT tag FROM halbtag WHERE id = ?) 
				AND tag <= (SELECT tag FROM halbtag WHERE id = ?)
				ORDER BY tag ASC, halbtag ASC;";
		$vars = array();
		$vars[] = array("s", $ersteabsenz);
		$vars[] = array("s", $ersteabsenz);
		$vars[] = array("s", $letzteabsenz);
		$result = _Database::query($sql, $vars);
		
		for ($i=0; $i<count($result); $i++) {
			
			// Prüfen ob $ersteabsenz nicht gleich erste absenz (, da am nachmittag) / $letzteabsenz nicht gleich letzte absenz (, da am vormittag)
			if ($i == 0 && $result[$i]->id != $ersteabsenz) continue;
			if ($i == (count($result) - 1) && $result[$i]->id != $letzteabsenz) continue;
			
			$absenz = new Absenz($result[$i]->id);
			if ($_POST['button'][0] == "absenzSignieren") $absenz->signieren();
			if ($_POST['button'][0] == "absenzAblehnen") $absenz->ablehnen();
		}
		
	}
	
	function signieren()
	{
		// Zeitstempel berechnen / Nachricht einlesen
		$datum = strftime("%Y-%m-%d %H:%M:%S", time());
		$nachricht = null;
		if (isset($_POST['absenzKommentar'])) $nachricht = $_POST['absenzKommentar'];
		
		// Fall : Praxisbildner
		if ($_SESSION['rolle'] == "praxisbildner") {
			
			// Signatur setzen
			$sql = "UPDATE absenz_anfrage SET signiert_praxisbildner = 'ja', signiert_praxisbildner_datum = '$datum', signiert_praxisbildner_nachricht = ?
					WHERE id = $this->id;";
			$vars = array();
			$vars[] = array("s", $nachricht);
			_Database::query($sql, $vars);
		}
		
		// Fall : Berufsbildner
		else if ($_SESSION['rolle'] == "berufsbildner") {
			
			// Absenz in Tabelle "halbtag" übertragen
			$sql = "UPDATE halbtag, absenz_anfrage SET halbtag.absenz = absenz_anfrage.anfrage, halbtag.absenz_kommentar = absenz_anfrage.anfrage_kommentar 
					WHERE halbtag.id = absenz_anfrage.id AND halbtag.id = $this->id;";
			_Database::query($sql);
			
			// Signatur setzen
			$sql = "UPDATE absenz_anfrage SET signiert_berufsbildner = 'ja', signiert_berufsbildner_datum = '$datum', signiert_berufsbildner_nachricht = ?
					WHERE id = $this->id;";
			$vars = array();
			$vars[] = array("s", $nachricht);
			_Database::query($sql, $vars);
		}
	}
	
	function ablehnen()
	{
		// Zeitstempel berechnen / Nachricht einlesen
		$datum = strftime("%Y-%m-%d %H:%M:%S", time());
		$nachricht = null;
		if (isset($_POST['absenzKommentar'])) $nachricht = $_POST['absenzKommentar'];
		
		// Fall : Praxisbildner
		if ($_SESSION['rolle'] == "praxisbildner") {
			
			// Ablehnen
			$sql = "UPDATE absenz_anfrage SET signiert_praxisbildner = 'abgelehnt', signiert_praxisbildner_datum = '$datum', signiert_praxisbildner_nachricht = ?
					WHERE id = $this->id;";
			$vars = array();
			$vars[] = array("s", $nachricht);
			_Database::query($sql, $vars);
		}
		
		// Fall : Berufsbildner
		else if ($_SESSION['rolle'] == "berufsbildner") {
			
			// Ablehnen
			$sql = "UPDATE absenz_anfrage SET signiert_berufsbildner = 'abgelehnt', signiert_berufsbildner_datum = '$datum', signiert_berufsbildner_nachricht = ?
					WHERE id = $this->id;";
			$vars = array();
			$vars[] = array("s", $nachricht);
			_Database::query($sql, $vars);
		}
	}
	
	function speichern()
	{
		
	}

	function get_property($property)
	{
		return $this->{$property};
	}

}

?>
