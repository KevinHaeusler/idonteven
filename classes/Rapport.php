<?php

class Rapport
{
	private $id;
	private $lehrling;
	private $monat;
	private $praxisbildner;
	private $signiert_lehrling;
	private $signiert_lehrling_datum;
	private $signiert_praxisbildner;
	private $signiert_praxisbildner_datum;
	private $signiert_berufsbildner;
	private $signiert_berufsbildner_datum;
	private $berufsbildner;
	private $rechnungsnr;
	private $rechnungsdatum;
	
	
	function __construct($lehrling, $monat, $praxisbildner)
	{
		$this->lehrling = $lehrling;
		$this->monat = $monat;
		$this->praxisbildner = $praxisbildner;
		
		// Rapport in DB suchen und auslesen
		$sql = "SELECT * FROM rapport WHERE lehrling = ? AND monat = ? AND praxisbildner = ?;";
		$vars = array();
		$vars[] = array("i", $this->lehrling);
		$vars[] = array("s", $this->monat);
		$vars[] = array("i", $this->praxisbildner);
		$result = _Database::query($sql, $vars);
		
		if (_Database::$result_num_rows) {
			$this->id = $result[0]->id;
			$this->signiert_lehrling = $result[0]->signiert_lehrling;
			$this->signiert_lehrling_datum = $result[0]->signiert_lehrling_datum;
			$this->signiert_praxisbildner = $result[0]->signiert_praxisbildner;
			$this->signiert_praxisbildner_datum = $result[0]->signiert_praxisbildner_datum;
			$this->signiert_berufsbildner = $result[0]->signiert_berufsbildner;
			$this->signiert_berufsbildner_datum = $result[0]->signiert_berufsbildner_datum;
			$this->berufsbildner = $result[0]->berufsbildner;
			$this->rechnungsnr = $result[0]->rechnungsnr;
			if ($result[0]->rechnungsdatum == null) $this->rechnungsdatum = strftime("%Y-%m-%d");
			else $this->rechnungsdatum = $result[0]->rechnungsdatum;
		}
		
		// Falls noch nicht vorhanden : Standardwerte erzeugen
		else {
			$this->signiert_lehrling = "offen";
			$this->signiert_lehrling_datum = null;
			$this->signiert_praxisbildner = "offen";
			$this->signiert_praxisbildner_datum = null;
			$this->signiert_berufsbildner = "offen";
			$this->signiert_berufsbildner_datum = null;
			$this->berufsbildner = null;
			$this->rechnungsnr = null;
			$this->rechnungsdatum = strftime("%Y-%m-%d");
		}
	}
	
	function get_zugehoerigeTage()
	{
		$tage = array();
		
		$sql = "SELECT DISTINCT startdatum, enddatum FROM praxiseinsatz 
				WHERE lehrling = $this->lehrling 
				AND praxisbildner = $this->praxisbildner 
				AND DATE(DATE_FORMAT(startdatum ,'%Y-%m-01')) <= '$this->monat' 
				AND DATE(DATE_FORMAT(enddatum ,'%Y-%m-01')) >= '$this->monat' 
				ORDER BY startdatum;";
		$result = _Database::query($sql);
		
		foreach ($result as $praxiseinsatz) {
			
			// Prüfen ob Startdatum vor Monat
			if (strtotime($praxiseinsatz->startdatum) < strtotime($this->monat)) $startdatum = $this->monat;
			else $startdatum = $praxiseinsatz->startdatum;
			
			// Prüfen ob Enddatum nach Monat
			if (strtotime($praxiseinsatz->enddatum) >= strtotime("$this->monat +1 month"))
				$enddatum = strftime("%Y-%m-" . date("t", strtotime($this->monat)), strtotime($this->monat));
			else
				$enddatum = $praxiseinsatz->enddatum;
			
			// Tage dem Array hinzufügen
			while (strtotime($startdatum) <= strtotime($enddatum)) {
				$tage[] = $startdatum;
				$startdatum = strftime("%Y-%m-%d", strtotime("$startdatum +1 day"));
			}
		}
		
		return $tage;
	}
	
	/**
	 * Führt ein Signieren durch
	 * bei Signaturen von Lernenden wird der Rapport allenfalls neu in die DB geschrieben
	 * 
	 */
	function signieren()
	{
		// Zeitstempel berechnen
		$datum = strftime("%Y-%m-%d %H:%M:%S", time());
		
		switch ($_SESSION['rolle']) {
			
			// Fall Lehrling
			case "lehrling" :
				
				$monat = new Monat($this->lehrling, $this->monat);
				
				if ($monat->pruefeRapport($this->praxisbildner)) {
								
					// Existiert der Rapport bereits?
					$sql = "SELECT id FROM rapport WHERE lehrling = $this->lehrling AND monat = '$this->monat' AND praxisbildner = $this->praxisbildner;";
					$result = _Database::query($sql);
					
					// Ja : update
					if (_Database::$result_num_rows) {
						$id = $result[0]->id;
						
						$sql = "UPDATE rapport SET signiert_lehrling = 'ja', signiert_lehrling_datum = '$datum' 
								WHERE lehrling = $this->lehrling AND monat = '$this->monat' AND praxisbildner = $this->praxisbildner;";
						_Database::query($sql);
						
						// allfälliges 'rapport_abgelehnt' löschen
						$sql = "DELETE FROM rapport_abgelehnt WHERE id = $id;";
						_Database::query($sql);
					}
					
					// Noch nicht : Rapport neu in DB erstellen
					else {
						$sql = "INSERT INTO rapport (lehrling, monat, praxisbildner, signiert_lehrling, signiert_lehrling_datum) 
								VALUES ($this->lehrling, '$this->monat', $this->praxisbildner, 'ja', '$datum');";
						_Database::query($sql);
					}
					
					// Falls Lehrling in "Praxisbetrieb System" : Praxisbildner signiert auch direkt
					if (_Praxisbildner::get_praxisbildner($this->praxisbildner)[4] == PRAXISBETRIEB_SYSTEM) {
						
						$sql = "UPDATE rapport SET signiert_praxisbildner = 'ja', signiert_praxisbildner_datum = '$datum' 
								WHERE lehrling = $this->lehrling AND monat = '$this->monat' AND praxisbildner = $this->praxisbildner;";
						_Database::query($sql);
					}
					
				}
				
				// Exception falls Rapport noch nicht signiert werden kann
				else {
					throw new Exception('Der Rapport kann nicht signiert werden.
							<ul><li>Alle Halbtage m&uuml;ssen ausgef&uuml;llt sein</li>
							<li>Es darf keine offenen Absenzanfragen mehr haben</li></ul>');
				}
				break;
		
			// Fall Praxisbildner
			case "praxisbildner" :
				
				if ($this->signiert_lehrling == "ja") {
					
					// Signatur schreiben
					$sql = "UPDATE rapport SET signiert_praxisbildner = 'ja', signiert_praxisbildner_datum = '$datum' 
							WHERE lehrling = $this->lehrling AND monat = '$this->monat' AND praxisbildner = $this->praxisbildner;";
					_Database::query($sql);
				}
				break;
		
			// Fall Berufsbildner
			case "berufsbildner" :
				
				if ($this->signiert_praxisbildner == "ja") {
					$berufsbildner = $_SESSION['id'];
					
					// Signatur schreiben
					$sql = "UPDATE rapport SET signiert_berufsbildner = 'ja', signiert_berufsbildner_datum = '$datum', berufsbildner = $berufsbildner 
							WHERE lehrling = $this->lehrling AND monat = '$this->monat' AND praxisbildner = $this->praxisbildner;";
					_Database::query($sql);
				}
				break;
		}
	}
	
	/**
	 * Führt das Löschen der Signaturen durch und erstellt einen Eintrag in rapport_abgelehnt
	 * 
	 */
	function ablehnen()
	{
		// Falls Berufsbildner ablehnt, wird der ablehnende Berufsbildner vermerkt
		$berufsbildner = 'null';
		if ($_SESSION['rolle'] == "berufsbildner") {
			$berufsbildner = $_SESSION['id'];
		}
		
		// Signaturen löschen
		$sql = "UPDATE rapport SET signiert_lehrling = 'offen', signiert_lehrling_datum = null, 
				signiert_praxisbildner = 'offen', signiert_praxisbildner_datum = null, 
				signiert_berufsbildner = 'offen', signiert_berufsbildner_datum = null, 
				berufsbildner = $berufsbildner 
				WHERE lehrling = $this->lehrling AND monat = '$this->monat' AND praxisbildner = $this->praxisbildner;";
		_Database::query($sql);
		
		// rapport_abgelehnt hinzufügen
		if ($_SESSION['rolle'] != "lehrling") {
			
			$benutzer = $_SESSION['id'];
			$datum = strftime("%Y-%m-%d %H:%M:%S", time());
			
			// Werte in DB schreiben
			$sql = "INSERT INTO rapport_abgelehnt (id, benutzer, datum) VALUES ($this->id, $benutzer, '$datum');";
			_Database::query($sql);
		}
		
		// Falls Sekretariat Unterschriften zurückgesetzt hat, Rapport wieder sperren
		if ($_SESSION['rolle'] == "verwaltung") {
			Rapport::sperren();
		}
	}
	
	/**
	 * Rapport-id in Session-Korrekturmodus schreiben
	 * 
	 */
	function bearbeiten()
	{
		$minimalesDatum = strftime("%Y-%m-01", strtotime("-" . (int)RAPPORT_KORREKTUR_SPERREN_NACH_MONATEN . " month"));
		
		// Prüfe Berechtigung / ob Rapport nicht älter als 3 Monate
		if (in_array("RAP", $_SESSION['berechtigungen']) && strtotime($this->monat) >= strtotime($minimalesDatum)) {
			$_SESSION['sekretariat_korrektur_modus'] = $this->id;
		}
		else {
			_Meldung::set_fehler("Der Rapport kann nicht mehr bearbeitet werden. Er liegt schon &uuml;ber " . RAPPORT_KORREKTUR_SPERREN_NACH_MONATEN . " Monate zur&uuml;ck.");
		}
	}
	
	/**
	 * Session-Korrekturmodus löschen
	 * 
	 */
	static function sperren()
	{
		if (isset($_SESSION['sekretariat_korrektur_modus'])) {
			unset($_SESSION['sekretariat_korrektur_modus']);
		}
	}
	
	function rechnungsdatenSpeichern()
	{
		// Exceptions
		
		// Prüfen, dass Rechnungsnummer nicht schon vorhanden
		$sql = "SELECT id FROM rapport WHERE rechnungsnr = ?;";
		$vars = array();
		$vars[] = array("s", $_POST['rapport_rechnungsnr']);
		$result = _Database::query($sql, $vars);
		
		if (_Database::$result_num_rows && $result[0]->id != $this->id)
			throw new Exception("Rechnungsdaten k&ouml;nnen nicht gespeichert werden. Die eingegebene Rechnungsnummer wurde bereits f&uuml;r einen anderen Rapport verwendet.");
		
		// Datum auf Korrektheit prüfen
		if (!_Content::checkIsoDate(_Form::datepickerToIso($_POST['rapport_rechnungsdatum'])))
			throw new Exception("Rechnungsdaten k&ouml;nnen nicht gespeichert werden. Datum ung&uuml;ltig.");
		
		
		// Rapport in DB updaten
		$rechnungsnr = $_POST['rapport_rechnungsnr'];
		$rechnungsdatum = _Form::datepickerToIso($_POST['rapport_rechnungsdatum']);
		
		$sql = "UPDATE rapport SET rechnungsnr = ?, rechnungsdatum = '$rechnungsdatum' 
				WHERE id = $this->id;";
		$vars = array();
		$vars[] = array("s", $rechnungsnr);
		_Database::query($sql, $vars);
		
	}
	
	function get_property($property)
	{
		return $this->{$property};
	}
	
	function html_rapportSignieren()
	{
		$html = "<h3>Rapport f&uuml;r " . _Praxisbildner::get_praxisbildner($this->praxisbildner)[4] . "</h3>";
		
		// Meldung "Abgelehnt"
		$sql = "SELECT * FROM rapport_abgelehnt WHERE id = $this->id;";
		$rapportabgelehnt = _Database::query($sql);
		
		if (_Database::$result_num_rows) {
			$benutzer = $rapportabgelehnt[0]->benutzer;
			if ($benutzer == $this->praxisbildner) {
				$message = _Praxisbildner::get_praxisbildner($benutzer)[1] . " hat abgelehnt";
			}
			else if ($benutzer == $this->berufsbildner) {
				$message = _Berufsbildner::get_berufsbildner($benutzer)[1] . " hat abgelehnt";
			}
			else {
				$message = "Das Sekretariat hat die Unterschriften gel&ouml;scht";
			}
			$datum = strftime("%d.%m.%Y um %H:%M", strtotime($rapportabgelehnt[0]->datum));
			$html .= "<p class='danger'><span class='glyphicon glyphicon-remove-circle'></span> $message, $datum</p>";
		}
		
		// Meldung "noch nicht signiert"
		else if ($this->signiert_lehrling != "ja") {
			$html .= "<p><span class='glyphicon glyphicon-info-sign'></span> Ist noch nicht signiert.</p>";
		}
		
		// Übersicht Signaturen
		if ($this->signiert_lehrling == "ja") {
			$datum = strftime("%d.%m.%Y um %H:%M", strtotime($this->signiert_lehrling_datum));
			$html .= "<p class='success'><span class='glyphicon glyphicon-ok-circle'></span> "
				. "Signiert von " . _Lehrling::get_lehrlinge($this->lehrling)[1] . ", $datum</p>";
		}
		if ($this->signiert_praxisbildner == "ja") {
			$datum = strftime("%d.%m.%Y um %H:%M", strtotime($this->signiert_praxisbildner_datum));
			$html .= "<p class='success'><span class='glyphicon glyphicon-ok-circle'></span> "
				. "Signiert von " . _Praxisbildner::get_praxisbildner($this->praxisbildner)[1] . ", $datum</p>";
		}
		if ($this->signiert_berufsbildner == "ja") {
			$datum = strftime("%d.%m.%Y um %H:%M", strtotime($this->signiert_berufsbildner_datum));
			$html .= "<p class='success'><span class='glyphicon glyphicon-ok-circle'></span> "
				. "Signiert von " . _Berufsbildner::get_berufsbildner($this->berufsbildner)[1] . ", $datum</p>";
		}
		
		// Buttons zum Signieren oder Ablehnen
		$html .= "<form method='POST'>";
		
		switch ($_SESSION['rolle']) {
			
			// Fall Lehrling
			case "lehrling" :
				if ($this->signiert_lehrling != "ja") {
					$html .= _Form::button("<span class='glyphicon glyphicon-ok'></span> Signieren", "rapportSignieren_" . $this->praxisbildner, "btn-primary");
				}
				if ($this->signiert_lehrling == "ja" && $this->signiert_praxisbildner != "ja") {
					$html .= _Form::button("<span class='glyphicon glyphicon-refresh'></span> Korrigieren", "rapportAblehnen_" . $this->praxisbildner, "btn-default");
				}
				break;

			// Fall Praxisbildner
			case "praxisbildner" :
				if ($this->signiert_lehrling == "ja" && $this->signiert_praxisbildner != "ja") {
					$html .= "<div class='flex-row button-row'>"
						. _Form::button("<span class='glyphicon glyphicon-ok'></span> Signieren", "rapportSignieren_" . $this->praxisbildner, "btn-primary")
						. _Form::button("<span class='glyphicon glyphicon-remove'></span> Ablehnen", "rapportAblehnen_" . $this->praxisbildner, "btn-default")
						. "</div>";
				}
				break;

			// Fall Berufsbildner
			case "berufsbildner" :
				if ($this->signiert_praxisbildner == "ja" && $this->signiert_berufsbildner != "ja") {
					$html .= "<div class='flex-row button-row'>"
						. _Form::button("<span class='glyphicon glyphicon-ok'></span> Signieren", "rapportSignieren_" . $this->praxisbildner, "btn-primary")
						. _Form::button("<span class='glyphicon glyphicon-remove'></span> Ablehnen", "rapportAblehnen_" . $this->praxisbildner, "btn-default")
						. "</div>";
				}
				break;
			
			// Fall Sekretariat
			case "verwaltung" :
				if ($this->signiert_berufsbildner == "ja" && in_array("RAP", $_SESSION['berechtigungen'])) {
					
					if (isset($_SESSION['sekretariat_korrektur_modus']) && $_SESSION['sekretariat_korrektur_modus'] == $this->id) {
						
						$html .= "<div class='flex-row button-row'>"
							. _Form::button("<span class='glyphicon glyphicon-pencil'></span> Bearbeiten beenden", "rapportSperren_" . $this->praxisbildner, "btn-default")
							. _Form::button("<span class='glyphicon glyphicon-remove'></span> Signaturen l&ouml;schen", "rapportAblehnen_" . $this->praxisbildner, "btn-danger")
							. "</div>";
					}
					else {
						
						$html .= "<div class='flex-row button-row'>
							<a class='btn btn-primary' href='#' role='button' onclick='showConfirmation(\"confirmation-excel\")'><span class='glyphicon glyphicon-download-alt'></span> Excel &ouml;ffnen</a>"
							. _Form::button("<span class='glyphicon glyphicon-pencil'></span> Bearbeiten", "rapportBearbeiten_" . $this->praxisbildner, "btn-default")
							. "</div>";
						
						_Meldung::set_confirmation(
							"<div id='confirmation-excel' class='confirmation'>
								<div class='title'><h3>Erfassung von Rechnungsdaten</h3></div>
								<div class='text'><p></p></div>
								<form method='POST' onsubmit='hideConfirmation(\"confirmation-excel\")'>
									<div class='flex-row form-row form'>"
										. _Form::input("Rechnungsdatum", "datepicker", "rapport_rechnungsdatum", strftime("%d.%m.%Y", strtotime($this->rechnungsdatum)), "", null, true)
										. _Form::input("Rechnungsnummer", "text", "rapport_rechnungsnr", $this->rechnungsnr, "")
									. "</div>
									<div class='flex-row flex-end button-row'>"
										. _Form::button("Speichern und &ouml;ffnen", "rapportExcelOeffnen_" . $this->lehrling . "_" . $this->monat . "_" . $this->praxisbildner, "btn-primary")
										. "<a class='btn btn-default' href='#' role='button' onclick='hideConfirmation(\"confirmation-excel\")'>Abbrechen</a>
									</div>
								</form>
							</div>"
						);
					}
				}
				break;
		}
		
		$html .= "</form><p>&nbsp;</p>";
		
		return $html;
	}
	
	
}

?>