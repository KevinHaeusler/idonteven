<?php

class Monat
{
	private $lehrling;
	private $monat;
	private $monatszahl;
	private $jahreszahl;
	private $anzahltage;
	private $halbtag = array();
	
	/**
	 * Erstellt ein Monats-Objekt und die dazugehörigen Halbtages-Objekte
	 * 
	 * @param int $lehrling - id: 101
	 * @param string $monat - Datum des Ersten im gewünschten Monat: 2016-09-01
	 * 
	 */
	function __construct(int $lehrling, string $monat)
	{
		$this->lehrling = $lehrling;
		$this->monat = $monat;
		$this->monatszahl = date("m", strtotime($this->monat));
		$this->jahreszahl = date("Y", strtotime($this->monat));
		$this->anzahltage = date("t", strtotime($this->monat));
		
		// Halbtage erstellen
		for($i=1; $i<=$this->anzahltage; $i++) {
			$this->halbtag[$i . "_v"] = new Halbtag($this->lehrling, $this->jahreszahl . "-" . $this->monatszahl . "-" . $i, "vormittag");
			$this->halbtag[$i . "_n"] = new Halbtag($this->lehrling, $this->jahreszahl . "-" . $this->monatszahl . "-" . $i, "nachmittag");
		}
	}
	
	function speichern()
	{
		try {
			foreach ($this->halbtag as $halbtag) {
				$halbtag->speichern();
			}
		} catch (Exception $e) {
			throw new Exception('Kann Monat nicht speichern. ' . $e->getMessage());
		}
		
		// falls Sekretariat Änderungen vornimmt, Rapport direkt wieder sperren
		if ($_SESSION['rolle'] == "verwaltung") {
			// Rapport::sperren();		// Ausgeschaltet für Migration
		}
	}
	
	function monatIstOffen()
	{
		$sql = "SELECT halbtag.id FROM halbtag, rapport, praxiseinsatz 
				WHERE halbtag.lehrling = $this->lehrling 
				AND halbtag.halbtag = 'vormittag' 
				AND halbtag.tag >= '$this->monat' AND halbtag.tag < ('$this->monat' + INTERVAL 1 MONTH) 
				AND halbtag.lehrling = praxiseinsatz.lehrling 
				AND '$this->monat' >= DATE(DATE_FORMAT(praxiseinsatz.startdatum ,'%Y-%m-01')) 
				AND '$this->monat' <= DATE(DATE_FORMAT(praxiseinsatz.enddatum ,'%Y-%m-01')) 
				AND halbtag.tag >= praxiseinsatz.startdatum AND halbtag.tag <= praxiseinsatz.enddatum 
				AND praxiseinsatz.praxisbildner = rapport.praxisbildner 
				AND rapport.lehrling = halbtag.lehrling 
				AND rapport.monat = '$this->monat' 
				AND rapport.signiert_lehrling = 'ja';";
		$result = _Database::query($sql);
		
		if (_Database::$result_num_rows == $this->anzahltage) return false;
		
		return true;
	}
	
	function pruefeRapport($praxisbildner)
	{
		foreach ($this->halbtag as $halbtag) {
			
			if ($halbtag->get_property("praxisbildner") == $praxisbildner) {
				
				// Alles ausgefüllt ?
				if ($halbtag->get_property("taetigkeit") == null) return false;
				
				// Existieren noch offene Absenzanfragen ?
				if ($halbtag->get_property("absenz_anfrage") != null) return false;
			}
		}
		
		return true;
	}
	
	function get_property($property)
	{
		return $this->{$property};
	}
	
	function html_monatAnzeigen()
	{
		// Berechtigung überprüfen
		if (!_Authorisation::verifyPermission_monat($this->lehrling, $this->monat)) {
			_Meldung::set_fehler("Zugriff verweigert. Sie besitzen nicht die n&ouml;tigen Rechte.");
			$html = "";
			
			return $html;
		}
		
		// Ausgabe des Monats
		
		$html = "<h1>" . utf8_encode(strftime("%B %Y", strtotime($this->monat))) . "</h1>"
			. "<h2>" . _Lehrling::get_lehrlinge($this->lehrling)[1] . "</h2><p>&nbsp;</p>";
		
		// Signaturen-Formular
		if ($_SESSION['rolle'] != "praxisbildner") {
			
			// Rapporte zu allen Praxisbildnern, die diesen Monat zugewiesen sind, anzeigen
			$praxisbildner = _Praxiseinsatz::get_praxisbildnerImMonat($this->lehrling, $this->monat);
			
			foreach ($praxisbildner as $praxisbildner) {
				if (!$praxisbildner) continue;
				$rapport = new Rapport($this->lehrling, $this->monat, $praxisbildner);
				$html .= $rapport->html_rapportSignieren();
			}
		}
		
		else {
			$rapport = new Rapport($this->lehrling, $this->monat, $_SESSION['id']);
			$html .= $rapport->html_rapportSignieren();
		}
		
		
		// Buttons zur Bearbeitung
		
		$html .= "<form method='POST'>";
		
		// Lehrling : Falls noch offene Rapporte existieren / Verwaltung : Falls Korrektur gewünscht
		if ($_SESSION['rolle'] == "lehrling" && $this->monatIstOffen() || $_SESSION['rolle'] == "verwaltung" && isset($_SESSION['sekretariat_korrektur_modus'])) {
			
			$html .= "<p>&nbsp;</p><p>&nbsp;</p>
					<div class='flex-row flex-wrap monatbuttons fixedbuttons'>
					<div class='btn-group'>
					<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
					T&auml;tigkeiten <span class='caret'></span></button>
					<ul class='dropdown-menu'>";
			
			foreach (_Taetigkeit::get_taetigkeiten() as $taetigkeit) {
				if ($taetigkeit[0] == "KAR")
					$html .= "<li role='separator' class='divider'></li>"
							. _Form::button($taetigkeit[1], "taetigkeitSpeichern_$taetigkeit[0]", "btn-link");
				else
					$html .= _Form::button($taetigkeit[1], "taetigkeitSpeichern_$taetigkeit[0]", "btn-link");
			}
			
			$html .= "</ul>
					</div>
					<div class='btn-group'>
					<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
					Absenzen <span class='caret'></span></button>
					<ul class='dropdown-menu'>";
			
			foreach (_Absenz::get_absenzen() as $absenz) {
				if ($absenz[0] == "KAB")
					$html .= "<li role='separator' class='divider'></li>"
							. _Form::button("Absenz l&ouml;schen", "absenzSpeichern_$absenz[0]", "btn-link");
				else
					$html .= _Form::button($absenz[1], "absenzSpeichern_$absenz[0]", "btn-link");
			}
			
			$html .= "</ul>
					</div>"
					. _Form::input(null, "text", "halbtag_kommentar", null, "kommentarfeld", "Kommentare")
					. _Form::button("<span class='glyphicon glyphicon-plus'></span> Kommentar", "kommentarSpeichern", "btn-default")
					. _Form::button("<span class='glyphicon glyphicon-minus'></span> Kommentar", "kommentarLoeschen", "btn-default")
					. "</div>";
		}
		
		$html .= "<p>&nbsp;</p>";
		
		// Tage des Monats
		for ($i=1; $i<=$this->anzahltage; $i++) {
			$html .= $this->html_tagAnzeigen($this->halbtag[$i . "_v"], $this->halbtag[$i . "_n"]);
		}
		$html .= "</form>
				<p>&nbsp;</p>";
		
		return $html;
	}
	
	function html_tagAnzeigen($vormittag, $nachmittag)
	{
		$tag = $vormittag->get_property("tag");
		$tag_zahl = $vormittag->get_property("tag_zahl");
		$wochentag = strftime("%a", strtotime($vormittag->get_property("tag")));
		$wochentag_zahl = strftime("%u", strtotime($vormittag->get_property("tag")));
		$wochenzahl = (int)strftime("%V", strtotime($vormittag->get_property("tag")));
		$praxisbildner = $vormittag->get_property('praxisbildner');
		
		// Prüfen ob Bearbeiten-Checkboxes aktiv
		$offen = false;
		
		switch ($_SESSION['rolle']) {
			
			// Falls der Rapport noch nicht unterschrieben ist
			case "lehrling" :
				if ($this->monatIstOffen()) {
					$rapport = new Rapport($this->lehrling, $this->monat, $praxisbildner);
					if ($rapport->get_property("signiert_lehrling") != "ja") $offen = true;
				}
				break;
				
			case "praxisbildner" :
			case "berufsbildner" :
				break;
				
			// Falls der Rapport im Korrektur-Modus ist
			case "verwaltung" :
				if (isset($_SESSION['sekretariat_korrektur_modus'])) {
					$rapport = new Rapport($this->lehrling, $this->monat, $praxisbildner);
					if ($rapport->get_property("id") == $_SESSION['sekretariat_korrektur_modus']) $offen = true;
				}
				break;
		}
		
		// Teil 1 : Datum, Wochentag
		
		// Bei Montag: Wochennummer anzeigen
		$mo= ""; $woche = "";
		if ($wochentag_zahl == 1) {	$mo = "mo"; $woche = "Woche $wochenzahl"; }
			
		// Bei Schulferien: CSS-klasse schulferien
		$schulferien = "";
		$schulort = _Lehrling::get_lehrlinge($this->lehrling)[3];
		
		foreach (_Schulferien::get_schulferienVonSchulort($schulort) as $ferien) {
			if (strtotime($tag) >= strtotime($ferien[1]) && strtotime($tag) <= strtotime($ferien[2])) { $schulferien = "schulferien"; break; }
		}
		
		// Falls Tag "offen": CSS-Klasse für Javascripts zum schnelleren auswählen
		$editable = "";
		if ($offen) $editable = "editable";
		
		$html = "<div class='tag $mo flex-row'>"
			. "<div class='tag0 flex-row center2 $editable week$wochenzahl $schulferien'>$woche</div>"
			. "<div class='tag1 flex-row center2 $editable day$tag_zahl $schulferien'>"
			. "<div class='wochentag'>$wochentag</div>"
			. "<div class='tag_zahl'>$tag_zahl</div>"
			. "</div>";
		
		// Tag wird grundsätzlich angezeigt
		$viewable = true;
		
		// Tag wird nicht angezeigt falls ausserhalb Lehre
		$lehrbeginn = _Lehrling::get_lehrlinge($this->lehrling)[4];
		$lehrende = _Lehrling::get_lehrlinge($this->lehrling)[5];
		if (strtotime($tag) < strtotime($lehrbeginn) || strtotime($tag) > strtotime($lehrende)) $viewable = false;
		
		// Tag wird nicht angezeigt falls nicht zugehörig zu Praxisbildner
		if ($_SESSION['rolle'] == "praxisbildner" && $_SESSION['id'] != $praxisbildner) $viewable = false;
		
		// Anzeige des Tages
		if ($viewable) {
			
			// Nicht-Wochenende deklarieren für Javascript-Schnellwahl
			$nichtwochenende = ""; if ($wochentag_zahl <= 5) $nichtwochenende = "nichtwochenende";
		
			// Teil 2 : Vormittag
			$taetigkeit = $vormittag->get_property('taetigkeit');
			$taetigkeit_kommentar = $vormittag->get_property('taetigkeit_kommentar');
			$absenz = $vormittag->get_property('absenz');
			$absenz_kommentar = $vormittag->get_property('absenz_kommentar');
			$absenz_anfrage = $vormittag->get_property('absenz_anfrage');
			$absenz_kommentar_anfrage = $vormittag->get_property('absenz_kommentar_anfrage');
			$absenz_anfrage_offen = $vormittag->get_property('absenz_anfrage_offen');
			
			$html .= "<div class='tag2 flex-column'>";
			$label = "<div class='halbtag $absenz $absenz_anfrage $taetigkeit'>";
			if ($absenz_anfrage_offen) {
				$label .= "Anfrage: " . _Absenz::get_absenzen($absenz_anfrage);
				if ($absenz_kommentar_anfrage != "") $label .= "<br><span class='kommentar'>" . $absenz_kommentar_anfrage . "</span>";
			}
			else if ($absenz != "KAB") {
				$label .= _Absenz::get_absenzen($absenz);
				if ($absenz_kommentar != "") $label .= "<br><span class='kommentar'>" . $absenz_kommentar . "</span>";
			}
			else {
				if ($taetigkeit == null) $label .= "&nbsp;";
				else $label .= _Taetigkeit::get_taetigkeiten($taetigkeit);
				if ($taetigkeit_kommentar != "") $label .= "<br><span class='kommentar'>" . $taetigkeit_kommentar . "</span>";
			}
			$label .= "</div>";
				
			// Mit oder ohne Checkbox?
			if ($offen) $html .= _Form::checkbox($label, "halbtag_halbtag[]", $tag_zahl . "_v", "flex-column week$wochenzahl day$tag_zahl $nichtwochenende");
			else $html .= "<div class='without-checkbox flex-row'><div></div>" . $label . "</div>";
			$html .= "</div>";
			
			// Teil 3 : Nachmittag
			$taetigkeit = $nachmittag->get_property('taetigkeit');
			$taetigkeit_kommentar = $nachmittag->get_property('taetigkeit_kommentar');
			$absenz = $nachmittag->get_property('absenz');
			$absenz_kommentar = $nachmittag->get_property('absenz_kommentar');
			$absenz_anfrage = $nachmittag->get_property('absenz_anfrage');
			$absenz_kommentar_anfrage = $nachmittag->get_property('absenz_kommentar_anfrage');
			$absenz_anfrage_offen = $nachmittag->get_property('absenz_anfrage_offen');
			
			$html .= "<div class='tag3 flex-column'>";
			$label = "<div class='halbtag $absenz $absenz_anfrage $taetigkeit'>";
			if ($absenz_anfrage_offen) {
				$label .= "Anfrage: " . _Absenz::get_absenzen($absenz_anfrage);
				if ($absenz_kommentar_anfrage != "") $label .= "<br><span class='kommentar'>" . $absenz_kommentar_anfrage . "</span>";
			}
			else if ($absenz != "KAB") {
				$label .= _Absenz::get_absenzen($absenz);
				if ($absenz_kommentar != "") $label .= "<br><span class='kommentar'>" . $absenz_kommentar . "</span>";
			}
			else {
				if ($taetigkeit == null) $label .= "&nbsp;";
				else $label .= _Taetigkeit::get_taetigkeiten($taetigkeit);
				if ($taetigkeit_kommentar != "") $label .= "<br><span class='kommentar'>" . $taetigkeit_kommentar . "</span>";
			}
			$label .= "</div>";
				
			// Mit oder ohne Checkbox?
			if ($offen) $html .= _Form::checkbox($label, "halbtag_halbtag[]", $tag_zahl . "_n", "flex-column week$wochenzahl day$tag_zahl $nichtwochenende");
			else $html .= "<div class='without-checkbox flex-row'><div></div>" . $label . "</div>";
			$html .= "</div>";
		}
		
		// Tag wird leer angezeigt
		else {
			$html .= "<div class='tag2 flex-column'><div class='without-checkbox flex-row'><div></div><div class='halbtag'>&nbsp;</div></div></div>"
			. "<div class='tag3 flex-column'><div class='without-checkbox flex-row'><div></div><div class='halbtag'>&nbsp;</div></div></div>";
		}
		
		$html .= "</div>";
		
		return $html;
	}
	
}

?>